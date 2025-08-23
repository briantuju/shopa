<?php

namespace App\Http\Controllers\Auth;

use App\Enums\BusinessType;
use App\Enums\Role;
use App\Enums\SessionFlash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VendorSignupRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Throwable;

class VendorSignupController extends Controller
{
    /** Get the vendor signup page */
    public function showPage()
    {
        return Inertia::render('auth/Signup/VendorSignupPage')
            ->with([
                'business_types' => BusinessType::values(),
            ]);
    }

    /** Handle creating a new vendor
     * @throws Throwable
     */
    public function signup(VendorSignupRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        // Create user
        $user = User::create($data);

        // Set the vendor role
        $user->syncRoles(Role::VENDOR->value);

        // Create the vendor profile
        $user->vendor()->create([
            'business_name' => $data['business_name'],
            'business_type' => $data['business_type'],
            'store_name' => $data['store_name'],
            'address_line' => $data['address_line'],
        ]);

        // Fire the user registered event
        event(new Registered($user));

        DB::commit();

        // Login the user
        Auth::loginUsingId($user->id);

        return redirect(route('me'))
            ->with([
                SessionFlash::FLASH_TITLE => 'Account Created Successfully',
                SessionFlash::FLASH_SUCCESS => 'Thank you for signing up to Shopa. Verify your email to get started.',
            ]);
    }
}
