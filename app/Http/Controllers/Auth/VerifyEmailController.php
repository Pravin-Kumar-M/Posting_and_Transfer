<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Check email domain validity
        $emailDomain = explode('@', $request->user()->email)[1] ?? null;

        if (!$emailDomain || !checkdnsrr($emailDomain, 'MX')) {
            return redirect()->route('login')->withErrors([
                'email' => 'The email address has an invalid domain and cannot be verified.',
            ]);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
