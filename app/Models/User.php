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
            'subscribe_date' => 'datetime',
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

    public function groupedAwards()
    {
        $awards = $this->awards();

        return $awards->groupBy(function ($award) {
            // Удаляем пунктуацию, приводим к нижнему регистру
            $cleanTitle = mb_strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $award->title));
            // Разбиваем по пробелам
            $words = preg_split('/\s+/u', trim($cleanTitle), -1, PREG_SPLIT_NO_EMPTY);
            return implode(' ', array_slice($words, 0, 2));
        })->map(function ($group) {
            // Берем самую новую награду для отображения (tooltip, картинка)
            $latest = $group->sortByDesc('created_at')->first();
            $latest->count = $group->count();
            return $latest;
        });
    }

    public function checkSubscribe()
    {
        if (!$this->subscribe_date) {
            return false;
        }
        return Carbon::now() <= Carbon::parse($this->subscribe_date)->endOfDay();
    }

    public function current_coach_count()
    {
        return Coach::where('leader', $this->id)->where('type', 'coach')->where('status', 'active')->count();
    }

    public function current_assistant_count()
    {
        return Coach::where('leader', $this->id)->where('type', 'partner')->where('status', 'active')->count();
    }

    public function can_be_coach()
    {
        $isActive = ($this->is_coach === 'active' || ($this->role === 'admin' && $this->is_coach !== 'false'));
        $limit = intval($this->max_coach_count ?: 10);
        return $isActive && $this->current_coach_count() < $limit;
    }

    public function can_be_assistant()
    {
        $isActive = ($this->is_assistant === 'active' || ($this->role === 'admin' && $this->is_assistant !== 'false'));
        $limit = intval($this->max_assistant_count ?: 10);
        return $isActive && $this->current_assistant_count() < $limit;
    }
}
