<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Enums\Resource;
use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /*
     * !!! IMPORTANT !!!
     *
     * We do not explicitly check for the user's role here.
     * Always make sure that the user is logged in as a VENDOR before
     * allowing them to do anything with a product, or they are an ADMIN
     * */

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(Permission::VIEW->value.' '.Resource::PRODUCT->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return $user->can(Permission::VIEW->value.' '.Resource::PRODUCT->value)
            && $product->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(Permission::CREATE->value.' '.Resource::PRODUCT->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->can(Permission::UPDATE->value.' '.Resource::PRODUCT->value)
            && $product->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->can(Permission::DELETE->value.' '.Resource::PRODUCT->value)
            && $product->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->can(Permission::CREATE->value.' '.Resource::PRODUCT->value)
            && $product->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->can(Permission::CREATE->value.' '.Resource::PRODUCT->value)
            && $product->user_id === $user->id;
    }
}
