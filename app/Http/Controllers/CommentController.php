<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\NotificationEmail;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommentController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        if (isset($data['number'])) {
            $number = $data['number'];
            unset($data['number']);
        } else {
            $number = 2;
        }
        $data = $data + ['status' => 'moderation'];
        $data = $data + ['user_id' => auth()->user()->id];
        $comment = Comment::create($data);

        if (isset($data['post_id'])) {
            $type = 'post';
            $id = Post::where('id', $data['post_id'])->first()->user_id;
            $user = User::where('id', $id)->first();
            Mail::to($user->email)->send(new NotificationEmail([
                'title' => 'Новый комментарий',
                'text' => $user->name .' к вашему посту написали новый комментарий'
            ]));

        } else {
            $type = 'note';
            $note = Note::where('id', $data['note_id'])->first();
            $note->update(['count_comments' => $note->count_comments+1]);
            $id = $note->user_id;
            $user = User::where('id', $id)->first();
            Mail::to($user->email)->send(new NotificationEmail([
                'title' => 'Новый комментарий',
                'text' => $user->name . ' к вашему отчету написали новый комментарий'
            ]));
        }
        $notification['type'] = $type;
        $notification['comment_id'] = $comment->id;
        $notification['user_id'] = $id;

        Notification::create($notification);

        if ($number > 1) {
            return redirect()->route('note.index');
        } else {
            return redirect()->route('note.rating', $number+1);
        }

    }
}
