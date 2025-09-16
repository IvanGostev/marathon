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

class CoachController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $data = [
            'leader' => auth()->user()->id,
            'venerable' => $request->user_id,
            'type' => $request->type,
        ];
        Coach::create($data);
        return back();
    }

    public function action(Coach $coach, $status, Request $request): RedirectResponse
    {
        $coach->update([
            'status' => $status
        ]);
        return back();
    }




}
