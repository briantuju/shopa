<?php

use App\Enums\Role;
use App\Filament\Resources\Brands\BrandResource;
use App\Models\User;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $admin = User::factory()->asUser(Role::ADMIN)->create([
        'email' => config('customconfig.app.admin_email'),
    ]);

    actingAs($admin);
});

test('can access the admin panel for brands', function () {
    $response = $this->get(BrandResource::getUrl());

    $response->assertOk();
});
