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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email:dns',
                function ($attribute, $value, $fail) {
                    $disposableDomains = ['tempmail.com', 'mailinator.com'];
                    $domain = substr(strrchr($value, "@"), 1);

                    if (in_array($domain, $disposableDomains)) {
                        $fail('The email domain is not allowed.');
                    }
                },
            ],
            'password' => [
                'required',
                'string',
                'max:8',
                'regex:/^(?=.*[A-Z])(?=.*[\W]).+$/',
                'confirmed',
            ],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one special character, and be a maximum of 8 characters long.',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to the dashboard or any intended route
        return redirect()->route('dashboard')->with('status', 'Registration successful!');
    }
}
