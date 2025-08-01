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
}
