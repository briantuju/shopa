<?php

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
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();

            $table->string('value'); // e.g. "Red", "Small", 512

            $table->foreignIdFor(\App\Models\Attribute::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();

            // Ensure unique combination of attribute_id and value
            $table->unique(['attribute_id', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};
