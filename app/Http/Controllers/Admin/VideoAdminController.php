<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\View\View;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class VideoAdminController extends Controller
{
    public function index(Request $request): View
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    public function store( Request $request): RedirectResponse
    {
        $data['text'] = $request->text;
        if (isset($data['file'])) {
            $data['src'] = $request->file('file')->store('uploads', 'public');
        }
        Video::create($data);
        return back();
    }

    public function delete(Book $book): RedirectResponse
    {
        $book->delete();
        return back();
    }

}
