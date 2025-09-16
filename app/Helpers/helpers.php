<?php

use App\Models\Coach;
use App\Models\Notification;
use Carbon\Carbon;

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
