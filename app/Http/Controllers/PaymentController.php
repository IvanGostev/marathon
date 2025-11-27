<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function main(string $subscribe, User $user) {

        header('Content-type:text/plain;charset=utf-8');

        $linktoform = 'https://demo.payform.ru/';

        $secret_key = '2y2aw4oknnke80bp1a8fniwuuq7tdkwmmuq7vwi4nzbr8z1182ftbn6p8mhw3bhz';
        $data = [
//            'order_id' => 1,

            'customer_email' => $user->email,

            'products' => [
                [
                    'sku' => 1,

                    'name' => 'Подписка на месяц',

                    'price' => '1',

                    'quantity' => '1',
                ],
            ],

            'customer_extra' => 'Текст, который отобразится в поле "Дополнительные данные"',

            'do' => 'link',

            'urlReturn' => 'https://bru-ch.com/subscribes',

            'urlSuccess' => 'https://bru-ch.com/',

            'urlNotification' => 'https://bru-ch.com/notification',

            'sys' => 'bruch',

        ];

        $data['signature'] = HmacController::create($data, $secret_key);
        $link = sprintf('%s?%s', $linktoform, http_build_query($data));
        return view('payment', compact('link'));
    }
    public function notification(Request $request) {
        $message = json_encode($request->all());
        Mail::to('ivangostev07@gmail.com')->send(new PaymentMail($message));
    }
}
