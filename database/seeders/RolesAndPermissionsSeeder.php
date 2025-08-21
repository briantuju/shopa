<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role;
use App\Support\ModelDiscovery;
use App\Support\RolePermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
         * This is a seeder that creates roles and permissions for the application.
         * More may be added as needed via the admin/seller panel
         * */

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

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
