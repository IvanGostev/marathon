<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        \App\Models\Notification::where('user_id', auth()->user()->id)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
