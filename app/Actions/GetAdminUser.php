<?php

namespace App\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAdminUser
{
    use AsAction;

    public function handle(): ?User
    {
        return User::where('email', config('customconfig.app.admin_email'))
            ->first();
    }
}
