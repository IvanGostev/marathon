<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    protected $guarded = false;
    public function user() {
        return User::where('id', $this->user_id)->first();
    }
    public function note() {
        return Note::where('id', $this->note_id)->first();
    }
}
