<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SessionFlash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmailVerificationController extends Controller
{
    public function show(Request $request)
    {
        if ($request->user()->email_verified_at) {
            return to_route('home')
                ->with(SessionFlash::FLASH_MESSAGE, 'You have already verified your email');
        }

        return Inertia::render('auth/Email/VerifyEmailPage');
    }

    /** Attempt to verify the user's email */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect(route('home'))
            ->with(SessionFlash::FLASH_SUCCESS, 'Your email has been successfully verified');

    }

    /** Resend the email verification to the user */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(SessionFlash::FLASH_MESSAGE, 'Verification link sent!');
    }
}
