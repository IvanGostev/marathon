<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Note;
use App\Models\Promocode;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubscribeController extends Controller
{
    public function index(Request $request): View
    {
        $promocodes = Promocode::all();
        return view('subscribe.index');
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        $subscribe = $request->subscribe;

        header('Content-type:text/plain;charset=utf-8');

        $linktoform = 'https://bru-ch.payform.ru/';

        $secret_key = '4f7e6dd8f0cf25d38cb4001b1aaeac360e9f1cad10a5715353781aad975bbcb1';
        $data = [
            'order_id' => implode('-', [$user->id, $subscribe]),

            'customer_email' => $user->email,

            'do' => 'pay',

            'urlReturn' => 'https://bru-ch.com/subscribes',

            'urlSuccess' => 'https://bru-ch.com/dashboard',

            'urlNotification' => 'https://bru-ch.com/notification',

            'sys' => 'bruch',

        ];

        $promocode = Promocode::where('name', $request->promocode)->first();
        if ($promocode) {
            if (!((Carbon::now() < $promocode->finish) and ($promocode->count > 0))) {
                $promocode = null;
            } else {
                $promocode->update(['count' => $promocode->count - 1]);
            }
        }

        if ($subscribe == 'base') {
            $price = 1990;
        } else if ($subscribe == 'winner') {
            $price = 950;
        } else if ($subscribe == 'champion') {
            $price = 190;
        }

        $data['products'] = [
            [
                'sku' => 1,
                'name' => 'Подписка на месяц',
                'price' => $promocode ? $price - ($price * ($promocode->discount / 100)) : $price,
                'quantity' => 1,
            ],
        ];

        $data['signature'] = HmacController::create($data, $secret_key);
        $link = sprintf('%s?%s', $linktoform, http_build_query($data));
        return redirect($link);
    }
}
