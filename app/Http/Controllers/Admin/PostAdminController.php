<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostAdminController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->all()['type'] ?? 'all';
        if ($type == 'moderation') {
            $posts = Post::where('status', 'moderation')->get();
        } else {
            $posts = Post::all();
        }
        return view('admin.post.index', compact('posts','type'));
    }
    public function approve(Post $post, Request $request): RedirectResponse
    {

        $post['status'] = 'approve';
        $post->update();
        return back();
    }
    public function reject(Post $post, Request $request): RedirectResponse
    {
        $post['status'] = 'reject';
        $post->update();
        return back();
    }
}
