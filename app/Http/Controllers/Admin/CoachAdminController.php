<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachAdminController extends Controller
{
    public function index()
    {
        // Get users who want to be coaches (status 'pending')
        $coaches = \App\Models\User::where('is_coach', 'pending')->get();
        return view('admin.coach.index', compact('coaches'));
    }

    public function approve(\App\Models\User $user)
    {
        $user->update(['is_coach' => 'active']);

        // Notify user
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'type' => 'system', // or 'coach_approved'
            'message' => 'Ваша заявка на статус Коуча одобрена!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Пользователь одобрен как коуч.');
    }

    public function reject(\App\Models\User $user)
    {
        $user->update(['is_coach' => 'false']);

        // Notify user
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'type' => 'system',
            'message' => 'Ваша заявка на статус Коуча отклонена.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Заявка отклонена.');
    }
}
