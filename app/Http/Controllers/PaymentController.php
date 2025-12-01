<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
//    public function main(string $subscribe, User $user)
//    {
//
//        header('Content-type:text/plain;charset=utf-8');
//
//        $linktoform = 'https://bru-ch.payform.ru//';
//
//        $secret_key = '4f7e6dd8f0cf25d38cb4001b1aaeac360e9f1cad10a5715353781aad975bbcb1';
//        $data = [
//            'order_id' => $user->id,
//
//            'customer_email' => $user->email,
//
//            'do' => 'pay',
//
//            'urlReturn' => 'https://bru-ch.com/subscribes',
//
//            'urlSuccess' => 'https://bru-ch.com/',
//
//            'urlNotification' => 'https://bru-ch.com/notification',
//
//            'sys' => 'bruch',
//
//        ];
//        if ($subscribe == 'base') {
//            $data['products'] = [
//                [
//                    'sku' => 1,
//                    'name' => 'Подписка на месяц',
//                    'price' => 200,
//                    'quantity' => 1,
//                ],
//            ];
//        } else {
//            $data['products'] = [
//                [
//                    'sku' => 1,
//                    'name' => 'Подписка на месяц c коучем',
//                    'price' => 500,
//                    'quantity' => 1,
//                ],
//            ];
//        }
//        $data['signature'] = HmacController::create($data, $secret_key);
//        $link = sprintf('%s?%s', $linktoform, http_build_query($data));
//        return redirect($link) ;
//
////        return view('payment', compact('link'));
//    }

    public function notification(Request $request)
    {
        $message = json_encode($request->all());
        Mail::to('ivangostev07@gmail.com')->send(new PaymentMail($message));
        $data = $request->all();
        dd($data);

        $orderData = explode('-', $data['order_num']);

        if ($data['payment_status'] === 'success') {
            $user = User::where('id', $orderData[0])->first();
            $date = Carbon::now();
            $date->addDays(30);
            $user->update(['subscribe_date' => $date, 'subscribe' => $orderData[1]]);
            return http_response_code(200);
        }
    }
}
