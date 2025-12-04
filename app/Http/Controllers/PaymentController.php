<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function notification(Request $request)
    {
        $message = json_encode($request->all());
        Mail::to('ivangostev07@gmail.com')->send(new PaymentMail($message));
        $data = $request->all();
        $orderData = explode('-', $data['order_num']);

        $date = Carbon::now();
        if ($data['payment_status'] == 'success' and $date == Carbon::parse($data['date'])) {
            $user = User::where('id', $orderData[0])->first();
            $date->addDays(30);
            $user->update(['subscribe_date' => $date, 'subscribe' => $orderData[1]]);
            return http_response_code(200);
        }
    }
}
