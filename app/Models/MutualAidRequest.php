<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutualAidRequest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'file_paths' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
