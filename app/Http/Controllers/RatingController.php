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

    protected function get_start_date()
    {
        $lastAward = \App\Models\AwardHistory::latest()->first();
        return $lastAward ? $lastAward->created_at : \Carbon\Carbon::now()->startOfMonth();
    }

    protected function OfDays($id)
    {
//        dd(Note::where('user_id', $id)->select(DB::raw('DATE(created_at) as day'))->groupBy('day')->get());
        return count(Note::where('user_id', $id)->where('created_at', '>=', $this->get_start_date())->select(DB::raw('DATE(created_at) as day'))->groupBy('day')->get());
    }

    # По количеству комментариев
    protected function OfComments($id)
    {
        return Comment::where('user_id', $id)->where('created_at', '>=', $this->get_start_date())->count();
    }

    # По количеству просмотров
    protected function OfViews($id)
    {
        $startDate = $this->get_start_date();
        $postViews = Post::where('user_id', $id)->where('created_at', '>=', $startDate)->sum('views');
        $noteViews = Note::where('user_id', $id)->where('created_at', '>=', $startDate)->sum('views');
        return $postViews + $noteViews;
    }

    protected function sum($id)
    {
        return Comment::where('user_id', $id)->where('created_at', '>=', $this->get_start_date())->selectRaw('SUM(first_stars) as first', 'SUM(second_stars) as second')->get()[0]['total'];
    }


    public function index(Request $request): View
    {
        if ($request->search) {
            $users = User::where('name', 'LIKE', '%' . $request->search . '%' )->get();
        } else {
            $users = User::all();
        }


        foreach ($users as &$user) {
            $user['OfDay'] = $this->ofDays($user['id']);
            $user['OfComment'] = $user->my_total_marks_for_month();
            $user['OfView'] = $this->OfViews($user['id']);
        }

        $type = $request->all()['type'] ?? 'persistent';
        if ($type == 'persistent') {
            $users = $users->sortBy('OfDay', SORT_REGULAR, true);
        } else if ($type == 'inspiring') {
            $users = $users->sortBy('OfComment', SORT_REGULAR, true);
        } else if ($type == 'popular') {
            $users = $users->sortBy('OfView', SORT_REGULAR, true);
        }
        return view('rating.index', compact('users'));
    }

}
