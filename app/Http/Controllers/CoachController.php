<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Coach;
use App\Models\Comment;
use App\Models\MutualAidRequest;
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
        // Check if connection already exists (any type)
        $existing = Coach::where('leader', auth()->id())
            ->where('venerable', $request->user_id)
            ->first();

        if ($existing) {
            return back()->with('error', 'Вы уже помогаете этому пользователю как ' . ($existing->type == 'coach' ? 'коуч' : 'напарник') . '.');
        }

        $data = [
            'leader' => auth()->user()->id,
            'venerable' => $request->user_id,
            'type' => $request->type,
            'status' => 'active'
        ];
        Coach::create($data);

        // If this help offer comes from a mutual aid request, fulfill it
        if ($request->has('request_id')) {
            MutualAidRequest::where('id', $request->request_id)->delete();
        }

        return back()->with('success', 'Вы успешно начали помогать пользователю!');
    }

    public function action(Coach $coach, $status, Request $request): RedirectResponse
    {
        $coach->update([
            'status' => $status
        ]);
        return back();
    }




}
