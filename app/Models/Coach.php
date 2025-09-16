<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $guarded = false;

    public function leader() {
        return User::where('id', $this->leader)->first();
    }
    public function venerable() {
        return User::where('id', $this->venerable)->first();
    }
}
