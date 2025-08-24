<?php

namespace Tests\Feature\Auth;

use App\Enums\BusinessType;
use App\Enums\Role;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(function () {
    // This runs before each test
});

test('vendor signup page can be rendered', function () {
    get(route('auth.vendor-signup-page'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('auth/Signup/VendorSignupPage')
            ->has('business_types', count(BusinessType::cases()))
        );
});

test('validation works for required fields', function () {
    post(route('auth.vendor-signup'), [])
        ->assertSessionHasErrors([
            'name',
            'email',
            'password',
            'business_name',
            'business_type',
            'store_name',
            'address_line',
        ]);
});

test('new vendors can register', function () {
    Event::fake();

    $response = post(route('auth.vendor-signup'), [
        'name' => 'Test Vendor',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'business_name' => 'Test Business',
        'business_type' => BusinessType::COMPANY->value,
        'store_name' => 'Test Store',
        'address_line' => '123 Test St',
    ]);

    $user = User::where('email', 'test@example.com')->first();
    $vendor = $user->vendor;

    // Assert the response
    $response->assertRedirect(route('home'));
    $response->assertSessionHas('flash_title', 'Account Created Successfully');

    // Assert the user was created
    expect($user)
        ->name->toBe('Test Vendor')
        ->email->toBe('test@example.com')
        ->and(Hash::check('password', $user->password))->toBeTrue()
        ->and($user->hasRole(Role::VENDOR->value))->toBeTrue()
        ->and($vendor)
        ->business_name->toBe('Test Business')
        ->store_name->toBe('Test Store')
        ->address_line->toBe('123 Test St');

    // Assert the user has the vendor role

    // Assert the vendor profile was created

    // Assert the registered event was dispatched
    Event::assertDispatched(Registered::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });

    // Assert the user is logged in
    assertAuthenticatedAs($user);
})->skip();
