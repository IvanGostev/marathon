<?php

namespace App\Observers;

use App\Models\Notification;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {
        $user = $notification->user;
        if (!$user)
            return;

        $data = [];
        if ($notification->type === 'system') {
            $data['title'] = 'Системное уведомление';
            $data['text'] = $notification->message;
        } elseif ($notification->type === 'post') {
            $comment = $notification->comment();
            if ($comment && $comment->user) {
                $data['title'] = 'Новый комментарий';
                $data['text'] = $comment->user->name . ' к вашему посту написали новый комментарий';
            }
        } elseif ($notification->type === 'note') {
            $comment = $notification->comment();
            if ($comment && $comment->user) {
                $data['title'] = 'Новый комментарий';
                $data['text'] = $comment->user->name . ' к вашему отчету написали новый комментарий';
            }
        }

        if (!empty($data)) {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\NotificationEmail($data));
        }
    }

    /**
     * Handle the Notification "updated" event.
     */
    public function updated(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     */
    public function deleted(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     */
    public function restored(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     */
    public function forceDeleted(Notification $notification): void
    {
        //
    }
}
