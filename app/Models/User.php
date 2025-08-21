<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Database\Factories\UserFactory;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Get the products created by this User */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->email === config('customconfig.app.admin_email') && $this->hasVerifiedEmail();
        } elseif ($panel->getId() === 'vendor') {
            // return $this->role === Role::VENDOR->value && $this->hasVerifiedEmail();
            return true;
        }

        return true;
    }

    /** Check if the user is an admin */
    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN->value;
    }

    /** Check if the user is a vendor */
    public function isVendor(): bool
    {
        return $this->role === Role::VENDOR->value;
    }

    /** Check if the user is a client */
    public function isClient(): bool
    {
        return $this->role === Role::USER->value;
    }
}
