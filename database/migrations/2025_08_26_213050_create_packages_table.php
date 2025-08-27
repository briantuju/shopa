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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            /* Check package_prices table for prices based on different factors */

            $table->string('name'); // "Free", "Pro"
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('grace_period_days')->default(0);
            $table->unsignedInteger('trial_period_days')->default(0);
            // the baseline package everyone should fall back to if no package is chosen.
            $table->boolean('is_default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
