<?php

use App\Enums\Role;
use App\Filament\Resources\Attributes\AttributeResource;
use App\Models\User;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $admin = User::factory()->asUser(Role::ADMIN)->create([
        'email' => config('customconfig.app.admin_email'),
    ]);

    actingAs($admin);
});

test('can access the admin panel for attributes', function () {
    $response = $this->get(AttributeResource::getUrl());

    $response->assertOk();
});
