<?php

use App\Models\Product;
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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->string('sku')->unique(); // Unique SKU for THIS specific variation
            $table->decimal('price', 8, 2); // Price for this specific variation
            $table->unsignedInteger('stock')->default(0);
            $table->string('image')->nullable(); // Optional: specific image for this variation

            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
