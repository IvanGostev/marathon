<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    //    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
    protected $guarded = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function my_total_marks_for_month()
    {
        $stars = 0;
        $notes = Note::where('user_id', $this->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
        foreach ($notes as $note) {
            $stars += Comment::where('note_id', $note->id)->sum('stars');
        }
        return $stars + $this->count_comments() + $this->my_count_comments();
    }

    public function count_comments()
    {
        $count_comments = 0;
        $notes = Note::where('user_id', $this->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->get();
        foreach ($notes as $note) {
            $count_comments += Comment::where('note_id', $note->id)->count();
        }
        return $count_comments;
    }

    public function my_count_comments()
    {
        return Comment::where('user_id', $this->id)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
    }

    public function awards()
    {
        return Award::where('user_id', $this->id)->get();
    }

    public function checkSubscribe()
    {
        if (Carbon::now() <= $this->subscribe_date) {
            return true;
        }
        return false;
    }
}
