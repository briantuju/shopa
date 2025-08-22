<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class SignupController extends Controller
{
    /**
     * @throws Throwable
     */
    public function signup(SignupRequest $request)
    {
        $data = $request->validated();

        // Create user within a transaction
        DB::beginTransaction();

        $user = User::create($data);

        DB::commit();

        return redirect()->route('auth.login-page');
    }
}
