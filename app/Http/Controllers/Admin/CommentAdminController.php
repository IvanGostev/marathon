<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommentAdminController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->all()['type'] ?? 'all';
        if ($type == 'moderation') {
            $comments = Comment::where('status', 'moderation')->get();
        } else {
            $comments = Comment::all();
        }
        return view('admin.comment.index', compact('comments','type'));
    }
    public function approve(Comment $comment, Request $request): RedirectResponse
    {

        $comment['status'] = 'approve';
        $comment->update();
        return back();
    }
    public function reject(Comment $comment, Request $request): RedirectResponse
    {
        $comment['status'] = 'reject';
        $comment->update();
        return back();
    }
}
