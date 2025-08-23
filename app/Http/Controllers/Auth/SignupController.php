<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Enums\SessionFlash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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

        // Set the default user role
        $user->syncRoles(Role::USER->value);

        // Trigger user registered event
        event(new Registered($user));

        DB::commit();

        // Login the user
        Auth::loginUsingId($user->id);

        return redirect(route('me'))
            ->with([
                SessionFlash::FLASH_SUCCESS => 'Thank you for signing up to Shopa',
            ]);
    }
}
