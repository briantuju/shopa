<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Throwable;

class ConfigureAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:configure-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure the application admin user';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(): void
    {
        // get admin email
        $admin_email = config('customconfig.app.admin_email');
        if (! $admin_email) {
            $this->fail('❌ Admin email is not configured');
        }

        // create admin user
        $admin = User::where('email', $admin_email)->first();
        if ($admin) {
            $admin->email_verified_at = now();
            $admin->save();

            // sync the admin role
            $admin->syncRoles(Role::ADMIN->value);

            $this->info('✔ Admin user configured successfully');
        } else {
            $this->fail('❌ No admin user found with email: '.$admin_email);
        }
    }
}
