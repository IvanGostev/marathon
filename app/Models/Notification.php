<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = false;
    public function comment() {
        return Comment::where('id', $this->comment_id)->first();
    }
}
