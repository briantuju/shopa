<?php

use App\Enums\VendorSubscriptionChange;
use App\Models\Package;
use App\Models\User;
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
        Schema::create('vendor_subscription_histories', function (Blueprint $table) {
            $table->id();

            $table->enum('change_type', VendorSubscriptionChange::array());
            $table->timestamp('effective_at'); // when the change took effect, (e.g. started_at in the vendor_subscriptions table)
            $table->timestamp('previous_ends_at')->nullable(); // previous subscription end date
            $table->decimal('previous_price', 8, 2)->nullable();
            $table->decimal('new_price', 8, 2)->nullable();
            $table->string('billing_cycle')->nullable();
            $table->string('previous_billing_cycle')->nullable();
            $table->json('previous_package_snapshot')->nullable();
            $table->string('gateway_transaction_id')->nullable(); // transaction associated with the change
            $table->json('new_package_snapshot')->nullable();
            $table->text('notes')->nullable(); // admin notes or reason for change

            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete(); // who processed the change
            $table->foreignIdFor(Vendor::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(VendorSubscription::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Package::class)
                ->nullable(); // the package being switched to (null if not coming from a package, e.g. on create)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_subscription_histories');
    }
};
