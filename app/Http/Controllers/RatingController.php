<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Note;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RatingController extends Controller
{
    # Количество дней с отчетами
    # Мне нужно получить для каждого пользователя количество отчетов написанного в разные дни
    # 1. Количество отчетов написанных в разные дни
// SELECT DATE(`created_at`) AS `day`
// FROM
// `posts`
// GROUP BY
// `day`;
    # 2. Количество отчетов написанных в разные дни

    protected function OfDays($id)
    {
        return count(Post::where('user_id', $id)->select(DB::raw('DATE(created_at) as day'))->groupBy('day')->get());
    }

    # По количеству комментариев
    protected function OfComments($id)
    {
        return Comment::where('user_id', $id)->count();
    }

    # По количеству просмотров
    protected function OfViews($id)
    {
        $f =  Post::where('user_id', $id)->selectRaw('SUM(views) as total')->get()[0]['total'];
        return $f + Note::where('user_id', $id)->selectRaw('SUM(views) as total')->get()[0]['total'];
    }

    protected function sum($id)
    {
        return Comment::where('user_id', $id)->selectRaw('SUM(first_stars) as first', 'SUM(second_stars) as second')->get()[0]['total'];
    }


    public function index(Request $request): View
    {


        $users = User::all();

        foreach ($users as &$user) {
            $user['OfDay'] = $this->ofDays($user['id']);
            $user['OfComment'] = $this->OfComments($user['id']);
            $user['OfView'] = $this->OfViews($user['id']);
        }

        $type = $request->all()['type'] ?? 'persistent';
        if ($type == 'persistent') {


        } else if ($type == 'inspiring') {

        } else if ($type == 'popular') {

        }
        return view('rating.index', compact('users', 'type'));
    }

}
