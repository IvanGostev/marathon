<?php

use App\Models\Award;
use App\Models\Coach;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Collection;

function notifications() {
    return Notification::where('user_id', auth()->user()->id)->latest('created_at')->get();
}
function formatDate($obj) {
    $obj = new Carbon($obj);
    return $obj->format('d.m.Y H:i');
}
function admissionRequest($leader, $venerable) {
    return Coach::where('leader', $leader)->where('venerable', $venerable)->count() == 0;
}

function checkWinner($extended) {
    $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString();
    $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();
    if (!$extended) {
        return Award::where('user_id', auth()->user()->id)->whereBetween('created_at', [$firstDayofPreviousMonth,$lastDayofPreviousMonth])->count() > 0;
    } else {
        return Award::where('user_id', auth()->user()->id)->whereBetween('created_at', [$firstDayofPreviousMonth,$lastDayofPreviousMonth])->where('title_system', 'reader_month')->count() > 0;
    }
}
function getLastUserForRewarded($role) {
    $award = Award::where('title_system', $role)->latest()->first();
    if ($award) {
        return $award->user();
    } else {
        return null;
    }
}
