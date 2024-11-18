<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function home()
    {
        return view('home.index');
    }
    public function showLoginForm()
    {
        return view('auth.login'); // Return the login view
    }

    public function login(Request $request)
    {
        // Validate the input including CAPTCHA
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required',
        ]);

        // Validate CAPTCHA answer
        if ($request->input('captcha') != session('captcha_answer')) {
            return back()->withErrors(['captcha' => 'Incorrect answer to the CAPTCHA question.']);
        }

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('dashboard'); // Redirect to intended page or dashboard
        }

        // If login fails, throw validation exception
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to homepage or login page after logout
    }
}
