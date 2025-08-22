<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        $user->syncRoles(Role::USER->value);

        DB::commit();

        // Login the user
        Auth::loginUsingId($user->id);

        return redirect(route('home'))->with([
            'flash_success' => 'Thank you for signing up to Shopa',
        ]);
    }
}
