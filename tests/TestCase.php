<?php

namespace Tests;

use App\Enums\Permission;
use App\Enums\Role;
use App\Support\ModelDiscovery;
use App\Support\RolePermissions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Clear permission cache
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Create roles
        foreach (Role::cases() as $roleEnum) {
            SpatieRole::firstOrCreate(['name' => $roleEnum->value]);
        }

        // Create permissions for each resource and operation
        foreach (ModelDiscovery::all(modelOnly: true) as $model) {
            foreach (Permission::cases() as $permEnum) {
                $name = "$permEnum->value $model";
                SpatiePermission::firstOrCreate(['name' => $name]);
            }
        }

        // Seed roles and permissions
        RolePermissions::seedAll();
    }
}
