<?php

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
        Schema::create('package_entitlements', function (Blueprint $table) {
            $table->id();

            $table->string('key'); // "products.max", "featured.enabled", "api.rate_limit"
            $table->json('value'); // "10", "true", "priority", or JSON if complex

            $table->foreignIdFor(Package::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['package_id', 'key']); // one entitlement per key per package
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_entitlements');
    }
};
