<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }
    public function create(Request $request): View
    {
        return view('post.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data = $data + ['status' => 'moderation'];
        Post::create($data);
        return redirect()->route('note.index');
    }

}
