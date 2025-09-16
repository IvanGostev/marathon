<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Coach;
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
    public function index(Request $request, User $user): View
    {
        $posts = array_map(function ($item) {
             $item['type'] = 'post';
            return $item;
        }, Post::where('user_id', $user->id)->get()->toArray());

        $notes = array_map(function ($item) {
            return $item['type'] = 'note';
        }, Note::where('user_id', $user->id)->get()->toArray());

        $items = collect(array_merge($posts, $notes));

        $items = $items->sortBy('created_at');
        $offers = Coach::where('venerable', auth()->user()->id)->get();
        return view('post.index', compact('items', 'user', 'offers'));
    }


    public function store(Request $request): RedirectResponse
    {
        $data['text'] = $request->text;
        $data['title'] = $request->title;
        $data = $data + ['status' => 'moderation'];
        $data = $data + ['user_id' => auth()->user()->id];
        Post::create($data);
        return redirect()->route('post.index', auth()->user()->id);
    }


    public function view(Post $post, Request $request)
    {
        $post->update(['views' => $post['views']+1]);
        $comments = Comment::where('post_id', $post->id)->get();
        return view('post.view', compact('post', 'comments'));
    }



}
