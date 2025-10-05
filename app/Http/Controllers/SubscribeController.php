<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubscribeController extends Controller
{
    public function index(Request $request): View
    {
        return view('subscribe.index');
    }
}
