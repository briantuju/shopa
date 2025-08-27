<?php

use App\Enums\PaymentGateway;
use App\Enums\VendorSubscriptionStatus;
use App\Models\Package;
use App\Models\Vendor;
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
        Schema::create('vendor_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->timestamp('started_at');
            $table->timestamp('ends_at')->default(now()->addMonth());
            $table->timestamp('cancelled_at')->nullable(); // if vendor cancelled subscription
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('renewal_at'); // since all subscriptions are recurring
            $table->timestamp('last_payment_at')->nullable(); // if set, gateway_transaction_id must also be set
            $table->string('billing_cycle'); // selected cycle from package
            $table->decimal('price', 8, 2); // price locked at the time of subscription
            $table->boolean('last_payment_success')->nullable();
            $table->unsignedInteger('failed_payments_count')->default(0);
            $table->enum('status', VendorSubscriptionStatus::array());
            $table->enum('payment_gateway', PaymentGateway::array());
            $table->string('gateway_transaction_id')->nullable(); // transaction id from payment gateway
            $table->string('gateway_customer_id')->nullable(); // from payment gateways like stripe
            $table->json('package_snapshot'); // snapshot of package at the time of subscription
            $table->text('notes')->nullable();

            $table->foreignIdFor(Vendor::class)
                ->unique()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Package::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_subscriptions');
    }
};
