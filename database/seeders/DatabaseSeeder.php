<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         * This MUST be called first, because it creates the default roles.
         *
         * Failing to do so will result in the user factory not working
         * */
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class, // Should be called after UserFactory, CategorySeeder and BrandSeeder
            AttributeSeeder::class,
            AttributeValueSeeder::class, // Call after AttributeSeeder
        ]);
    }
}
