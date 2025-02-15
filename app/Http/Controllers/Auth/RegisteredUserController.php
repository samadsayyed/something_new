<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'recites_quran' => 'required|in:Y,N'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'mobile_number' => $request->mobile_number,
            'recites_quran' => $request->recites_quran
        ]);

        event(new Registered($user));

        $encryptedEmail = Crypt::encryptString($user->email);

        $enableUrl = route('account.verify', ['token' => $encryptedEmail]);

    // Send the email
    Mail::send('account.enable', ['user' => $user, 'url' => $enableUrl], function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Enable Your Account');
    });

        // Redirect to the login page instead of the dashboard
        return redirect()->route('login');
    }

}
