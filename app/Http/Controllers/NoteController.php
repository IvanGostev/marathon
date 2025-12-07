<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\NoteComment;
use App\Models\NoteFile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(Request $request): View
    {
        $notes = Note::where('user_id', auth()->user()->id)->latest()->get();
        $dates = Note::where('user_id', auth()->user()->id)->pluck('created_at')->all();

        return view('note.index', compact('notes', 'dates'));
    }

    public function create(Request $request): View
    {
        $books = Book::all();
        return view('note.create', compact('books'));
    }

    public function demo(Request $request): View
    {
        $data = $request->all();
        $files = [];
        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                $files[] = NoteFile::create(['src' => $file->store('uploads', 'public')]);
            }
        }
        if (isset($data['oldFilesIds'])) {
            foreach ($data['oldFilesIds'] as $fileId) {
                $files[] = NoteFile::where('id', $fileId)->first();
            }
        }
        $books = Book::all();
        return view('note.demo', compact('books', 'data', 'files'));
    }

    public function view(Note $note): View
    {

        $note->update(['views' => $note['views'] + 1]);
        $comments = Comment::where('note_id', $note->id)->where('status', 'approve')->get();
        return view('note.view', compact('note', 'comments'));
    }

    public function store(Request $request): RedirectResponse|View
    {

        $data = [];
        if (isset($request->action) and $request->action == 'back') {
            $data = $request->all();
            $books = Book::all();
            $filesIds = $request->filesIds;
            $files = [];

            if (isset($filesIds)) {
                foreach ($filesIds as $fileId) {
                    $files[] = NoteFile::where('id', $fileId)->first();
                }
            }
            $data['files'] = $files;
            return view('note.create', compact('books', 'data'));
        }

        if (isset($request->book)) {
            $book = Book::where('title', $request->book)->first();
            if ($book) {
                $data['book_id'] = $book->id;
            } else {
                $data['mybook'] = $request->book;
            }
        }

        $data['title'] = $request->title;
        $data['go'] = $request->go;
        $data['status'] = 'moderation';
        $data['user_id'] = auth()->user()->id;

        // TEXT
        $text = $request->text;
        $dom = new \DomDocument();
        @$dom->loadHtml('<meta charset="utf8">' . $text);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $dataImg = $img->getAttribute('src');

            list($type, $dataImg) = explode(';', $dataImg);
            list($type, $dataImg) = explode(',', $dataImg);
            $dataImg = base64_decode($dataImg);

            $image_name = "/upload/" . time() . $k . '.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $dataImg);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $data['text'] = $dom->saveHTML();
        // TEXT FINISH


        // RESULTS
        $results = $request->results;
        $dom = new \DomDocument();
        @$dom->loadHtml('<meta charset="utf8">' . $results);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $dataImg = $img->getAttribute('src');

            list($type, $dataImg) = explode(';', $dataImg);
            list($type, $dataImg) = explode(',', $dataImg);
            $dataImg = base64_decode($dataImg);

            $image_name = "/upload/" . time() . $k . '.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $dataImg);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $data['results'] = $dom->saveHTML();
        // RESULTS FINISH


        $note = Note::create($data);

        if (isset($filesIds)) {
            foreach ($filesIds as $fileId) {
                $file = NoteFile::where('id', $fileId)->first();
                $file->update(['note_id' => $note->id]);
            }
        }
        $idsRated = Comment::where('user_id', auth()->user()->id)->pluck('note_id');
        $note = Note::whereNot('user_id', auth()->user()->id)->whereNotIn('id', $idsRated)->inRandomOrder()->first();
        if (!$note) {
            return redirect()->route('note.index');
        }
        return redirect()->route('note.rating', 1);
    }

    public function rating($number, Request $request): RedirectResponse|View
    {
        $myIdsNotes = Note::where('user_id', auth()->user()->id)->pluck('id');
        $idsRated = Comment::where('user_id', auth()->user()->id)->pluck('note_id');
        $note = Note::whereNotIn('id', $myIdsNotes)->whereNotIn('id', $idsRated)->where('count_comments', '<=', 2)->orderBy('count_comments', 'asc')->first();
        if (!$note) {
            return redirect()->route('note.rating', 1);
        }
        return view('note.rating', compact('number', 'note'));
    }
}
