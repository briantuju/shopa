<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::firstOrCreate(['name' => 'Color'], [
            'type' => 'radio',
            'is_filterable' => true,
        ]);

        Attribute::firstOrCreate(['name' => 'Size'], [
            'type' => 'radio',
            'is_filterable' => true,
        ]);

        Attribute::firstOrCreate(['name' => 'Material'], [
            'type' => 'select',
            'is_filterable' => true,
        ]);

        Attribute::firstOrCreate(['name' => 'Storage'], [
            'type' => 'select',
            'is_filterable' => true,
        ]);

        Attribute::firstOrCreate(['name' => 'RAM'], [
            'type' => 'select',
            'is_filterable' => true,
        ]);

        Attribute::firstOrCreate(['name' => 'Display Size'], [
            'type' => 'select',
            'is_filterable' => true,
        ]);
    }
}
