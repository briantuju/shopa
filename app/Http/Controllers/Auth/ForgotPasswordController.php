<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SessionFlash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /** Send the password reset email */
    public function sendResetEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with([SessionFlash::FLASH_MESSAGE => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
