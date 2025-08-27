<?php

use App\Enums\PackageCycle;
use App\Models\Package;
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
        Schema::create('package_prices', function (Blueprint $table) {
            $table->id();

            $table->enum('billing_cycle', PackageCycle::array());
            $table->decimal('price', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->boolean('on_promotion')->default(false);
            $table->timestamp('promotion_starts_at')->nullable();
            $table->timestamp('promotion_ends_at')->nullable();

            $table->foreignIdFor(Package::class)
                ->constrained()
                ->cascadeOnDelete();

            // enforce uniqueness: one billing cycle per package
            $table->unique(['package_id', 'billing_cycle']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_prices');
    }
};
