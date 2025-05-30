<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'captcha' => 'required',
        ]);

        // Validate CAPTCHA answer (Assuming you have a method for CAPTCHA validation)
        if ((int)$request->input('captcha') !== session('captcha_answer')) {
            return back()->withErrors(['captcha' => 'Incorrect CAPTCHA answer.']);
        }

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Regenerate the session ID to prevent session fixation attacks
            $request->session()->regenerate();

            // Generate OTP
            $otp = rand(100000, 999999); // Generate a 6-digit OTP

            // Store OTP and its expiry in the database
            $user = Auth::user();
            $user->otp = $otp;
            $user->otp_expiry = now()->addMinutes(1); // OTP expires in 1 minutes
            $user->save();


            // Send OTP to the user's email
            Mail::to($user->email)->send(new SendOtpMail($otp));
            dd('Redirecting to verify OTP page.');

            // Redirect to OTP verification page
            return redirect()->route('verify-otp');
        }

        // If login fails, throw validation exception with error message
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();

        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (now()->greaterThan($user->otp_expiry)) {
            return back()->withErrors(['otp' => 'OTP has expired.']);
        }

        // OTP is valid, clear OTP and redirect to dashboard or home page
        $user->otp = null;
        $user->otp_expiry = null;
        $user->save();

        return redirect()->route('/'); // Redirect to home or dashboard
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to homepage or login page after logout
    }

    private function validateCaptcha(string $captcha): bool
    {
        // Compare user input with the stored CAPTCHA answer
        return $captcha === session('captcha_answer');
    }
}
