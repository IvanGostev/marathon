<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
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
        $books = Book::all();
        return view('note.demo', compact('books', 'data'));
    }

    public function view(Note $note): View
    {
        $note->update(['views' => $note['views'] + 1]);
        $comments = Comment::where('note_id', $note->id)->get();
        return view('note.view', compact('note', 'comments'));
    }

    public function store(Request $request): RedirectResponse|View
    {

        $data = [];
        if (isset($data['action']) and $data['action'] == 'back') {
            $books = Book::all();
            return view('note.create', compact('books', 'data'));
        }

        if (isset($request->mybook)) {
            $data['mybook'] = $request->mybook;
        } elseif ($request->book_id) {
            $data['book_id'] = $request->book_id;
        }

        $data['title'] = $request->title;
        $data['status'] = 'moderation';
        $data['user_id'] = auth()->user()->id;

        $text= $request->text;
        $dom = new \DomDocument();
        @$dom->loadHtml('<meta charset="utf8">' . $text);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $dataImg = $img->getAttribute('src');

            list($type, $dataImg) = explode(';', $dataImg);
            list($type, $dataImg) = explode(',', $dataImg);
            $dataImg = base64_decode($dataImg);

            $image_name= "/upload/" . time().$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $dataImg);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $data['text'] = $dom->saveHTML();

        Note::create($data);
        $myIdsNotes = Note::where('user_id', auth()->user()->id)->pluck('id');
        $note = Note::whereNotIn('id', $myIdsNotes)->inRandomOrder()->first();
        if (!$note) {
            return redirect()->route('note.index');
        }
        return redirect()->route('note.rating', 1);
    }

    public function rating($number, Request $request): RedirectResponse|View
    {
        $myIdsNotes = Note::where('user_id', auth()->user()->id)->pluck('id');
        $note = Note::whereNotIn('id', $myIdsNotes)->inRandomOrder()->first();
        if (!$note) {
            return redirect()->route('note.rating', 1);
        } else {

        }
        return view('note.rating', compact('number', 'note'));
    }
}
