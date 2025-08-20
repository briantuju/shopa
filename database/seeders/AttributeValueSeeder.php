<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get common attributes (assuming they exist from AttributeSeeder)
        $colorAttribute = Attribute::where('name', 'Color')->first();
        $sizeAttribute = Attribute::where('name', 'Size')->first();
        $materialAttribute = Attribute::where('name', 'Material')->first();
        $storageAttribute = Attribute::where('name', 'Storage')->first();
        $ramAttribute = Attribute::where('name', 'RAM')->first();

        // Seed Color Values
        if ($colorAttribute) {
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Red']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Blue']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Green']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Black']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'White']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Silver']);
            AttributeValue::firstOrCreate(['attribute_id' => $colorAttribute->id, 'value' => 'Space Gray']);
        }

        // Seed Size Values
        if ($sizeAttribute) {
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'XS']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'S']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'M']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'L']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'XL']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'XXL']);
            AttributeValue::firstOrCreate(['attribute_id' => $sizeAttribute->id, 'value' => 'One Size']); // For hats, etc.
        }

        // Seed Material Values
        if ($materialAttribute) {
            AttributeValue::firstOrCreate(['attribute_id' => $materialAttribute->id, 'value' => 'Cotton']);
            AttributeValue::firstOrCreate(['attribute_id' => $materialAttribute->id, 'value' => 'Polyester']);
            AttributeValue::firstOrCreate(['attribute_id' => $materialAttribute->id, 'value' => 'Leather']);
            AttributeValue::firstOrCreate(['attribute_id' => $materialAttribute->id, 'value' => 'Plastic']);
            AttributeValue::firstOrCreate(['attribute_id' => $materialAttribute->id, 'value' => 'Metal']);
        }

        // Seed Storage Values (for electronics)
        if ($storageAttribute) {
            AttributeValue::firstOrCreate(['attribute_id' => $storageAttribute->id, 'value' => '64GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $storageAttribute->id, 'value' => '128GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $storageAttribute->id, 'value' => '256GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $storageAttribute->id, 'value' => '512GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $storageAttribute->id, 'value' => '1TB']);
        }

        // Seed RAM Values (for electronics)
        if ($ramAttribute) {
            AttributeValue::firstOrCreate(['attribute_id' => $ramAttribute->id, 'value' => '4GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $ramAttribute->id, 'value' => '8GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $ramAttribute->id, 'value' => '16GB']);
            AttributeValue::firstOrCreate(['attribute_id' => $ramAttribute->id, 'value' => '32GB']);
        }
    }
}
