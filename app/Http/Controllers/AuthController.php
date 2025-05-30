<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        // Get logged-in user
        $user = Auth::user();

        // Validate OTP input
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Check if the OTP is correct and not expired
        if ($user->otp == $request->otp && now()->isBefore($user->otp_expiry)) {
            // OTP is valid, redirect based on user role
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('staff.dashboard');
            }
        } else {
            // OTP is invalid or expired
            return redirect()->route('verify-otp')->withErrors(['otp' => 'Invalid or expired OTP']);
        }
    }
}
