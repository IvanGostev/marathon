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
        $notes = Note::where('user_id', auth()->user()->id)->get();
        $dates = Note::where('user_id', auth()->user()->id)->pluck('created_at')->all();

        return view('note.index', compact('notes', 'dates'));
    }

    public function create(Request $request): View
    {
        $books = Book::all();
        return view('note.create', compact('books'));
    }

    public function view(Note $note): View
    {
        $comments = Comment::where('note_id', $note->id)->get();
        return view('note.view', compact('note', 'comments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data = $data + ['status' => 'moderation'];
        $data = $data + ['user_id' => auth()->user()->id];
        Note::create($data);
        return redirect()->route('note.index');
    }

}
