<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Promocode;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PromocodeAdminController extends Controller
{
    public function index(Request $request): View
    {

        $promocodes = Promocode::all();
        return view('admin.promocode.index', compact('promocodes'));
    }
    public function store(Request $request): RedirectResponse
    {
        $arr = $request->all();
        unset($arr['_token']);
        Promocode::firstOrCreate($arr);
        return back();
    }
    public function delete(Promocode $promocode): RedirectResponse
    {
        $promocode->delete();
        return back();
    }

}
