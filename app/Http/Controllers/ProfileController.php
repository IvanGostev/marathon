<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {


        $validation = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['max:500'],
            'phone' => ['string', 'max:500'],
            'city' => ['string', 'max:500'],
            'hobby' => ['string', 'max:500'],
            'date' => ['required'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(auth()->user()->id),
            ],
        ]);
        $user = auth()->user();
        $all = $request->all();
        if (isset($all['img'])) {
            $all['img'] =  $request->file('img')->store('avatars', 'public');
        }

        $user->update($all);

//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }
//
//        $request->user()->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
