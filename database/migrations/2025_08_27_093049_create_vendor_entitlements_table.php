<?php

use App\Models\Vendor;
use App\Models\VendorSubscription;
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
        Schema::create('vendor_entitlements', function (Blueprint $table) {
            $table->id();

            $table->string('key'); // vendor override of subscription entitlement
            $table->json('value');
            $table->string('source')->nullable(); // source of entitlement (manual, promo, etc)

            $table->foreignIdFor(VendorSubscription::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['vendor_subscription_id', 'key']); // avoid duplicate keys per subscription
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_entitlements');
    }
};
