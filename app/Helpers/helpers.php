<?php

use App\Models\Notification;
use Carbon\Carbon;

function notifications() {
    return Notification::where('user_id', auth()->user()->id)->latest('created_at')->get();
}
function formatDate($obj) {
    $obj = new Carbon($obj);
    return $obj->format('d.m.Y H:i');
}
