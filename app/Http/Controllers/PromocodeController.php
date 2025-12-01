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
        $subscribe['price'] = $request->subscribe == 'base' ? 200 : 500;
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
        $subscribe['price'] = $request->subscribe == 'base' ? 200 : 500;
        return view('promocode.modal', compact('subscribe'))->render();
    }
}
