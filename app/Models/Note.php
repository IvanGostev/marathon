<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = false;

    public function book()
    {
        return Book::where('id', $this->book_id)->first();
    }
    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }
    public function files() {
        return NoteFile::where('note_id', $this->id)->get();
    }
}
