<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommentController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data = $data + ['status' => 'moderation'];
        $data = $data + ['user_id' => auth()->user()->id];
        $comment = Comment::create($data);

        if (isset($data['post_id'])) {
            $type = 'post';
            $id = Post::where('id', $data['post_id'])->first()->user_id;
        } else {
            $type = 'note';
            $id = Note::where('id', $data['note_id'])->first()->user_id;
        }
        $notification['type'] = $type;
        $notification['comment_id'] = $comment->id;
        $notification['user_id'] = $id;
        Notification::create($notification);

        return redirect()->route('note.index');
    }
}
