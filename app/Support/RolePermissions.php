<?php

namespace App\Support;

use App\Enums\Permission;
use App\Enums\Resource;
use App\Enums\Role;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;

class RolePermissions
{
    /**
     * Get (and create if missing) permissions for the given resources.
     *
     * For each resource, this will generate permission names in the format
     * "ACTION Resource" (e.g. "CREATE Product", "VIEW Order").
     *
     * Usage:
     * - With full CRUD:
     *   RolePermissions::forResources([Resource::PRODUCT, Resource::PRODUCT_VARIANT]);
     *
     * - With specific permissions:
     *   RolePermissions::forResources([
     *       Resource::ORDER => [Permission::VIEW, Permission::CREATE],
     *   ]);
     *
     * @param  array<int, resource>|array<resource, array<Permission>>  $resources
     * @return Collection<SpatiePermission>
     */
    public static function forResources(array $resources): Collection
    {
        return collect($resources)
            ->flatMap(function ($perms, $resource) {
                // Case 1: numeric keys => full CRUD
                if (is_int($resource)) {
                    $resourceEnum = $perms;
                    $permissions = Permission::cases();
                } else {
                    // Case 2: keyed by resource => only selected permissions
                    $resourceEnum = $resource;
                    $permissions = $perms;
                }

                return collect($permissions)
                    ->map(fn (Permission $perm) => SpatiePermission::firstOrCreate(
                        ['name' => "$perm->value {$resourceEnum->label()}"]
                    ));
            });
    }

    /**
     * Seed all roles with their predefined permissions.
     */
    public static function seedAll(): void
    {
        foreach (Role::cases() as $roleEnum) {
            $role = SpatieRole::firstOrCreate(['name' => $roleEnum->value]);

            match ($roleEnum->value) {
                Role::VENDOR->value => $role->syncPermissions(
                    self::forResources([Resource::PRODUCT, Resource::PRODUCT_VARIANT])
                ),

                /*Role::USER => $role->syncPermissions(
                    self::forResources([
                        Resource::PRODUCT->value => [Permission::VIEW],
                    ])
                ),*/

                default => null, // do nothing for other roles
            };
        }
    }
}
