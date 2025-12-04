<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\Promocode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PromocodeController extends Controller
{
    public function check(Request $request)
    {
        $promocode = Promocode::where('name', $request->promocode)->first();

        $subscribe['name'] = $request->subscribe;

        if ($request->subscribe == 'base') {
            $subscribe['price'] = 1990;
        } else if  ($request->subscribe == 'winner') {
            $subscribe['price'] = 950;
        } else if  ($request->subscribe == 'champion') {
            $subscribe['price'] = 190;
        }

        if ($promocode) {
            if ((Carbon::now() < $promocode->finish) and ($promocode->count > 0)) {
                return view('promocode.active', compact('promocode', 'subscribe'))->render();
            }
        }
        return view('promocode.error', compact('subscribe'))->render();
    }

    public function modal(Request $request)
    {
        $subscribe['name'] = $request->subscribe;

        if ($request->subscribe == 'base') {
            $subscribe['price'] = 1990;
        } else if  ($request->subscribe == 'winner') {
            $subscribe['price'] = 950;
        } else if  ($request->subscribe == 'champion') {
            $subscribe['price'] = 190;
        }

        return view('promocode.modal', compact('subscribe'))->render();
    }
}
