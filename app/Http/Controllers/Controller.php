<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use Exception;
use Illuminate\Support\Facades\Mail;

abstract class Controller
{
    public function test() {
        try{
            Mail::to('ivangostev07@gmail.com')->send(new NotificationEmail([
                'title' => 'Hello bro',
                'text' => 'Google Создан пароль приложения, который будет использоваться для входа в ваш аккаунт'
            ]));
        }
        catch(Exception $e){
           dd($e->getMessage());
        }
        return 1;
    }

}
