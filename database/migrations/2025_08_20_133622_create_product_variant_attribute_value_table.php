<?php

use App\Models\AttributeValue;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variant_attribute_value', function (Blueprint $table) {
            $table->foreignIdFor(ProductVariant::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(AttributeValue::class)
                ->constrained()
                ->cascadeOnDelete();
            // If you need to store free-form values not in attribute_values, uncomment below:
            // $table->text('value')->nullable(); // For cases where value is not predefined

            $table->primary(['product_variant_id', 'attribute_value_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attribute_value');
    }
};
