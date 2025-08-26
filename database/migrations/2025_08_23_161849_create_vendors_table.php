<?php

use App\Enums\BusinessType;
use App\Enums\VendorStatus;
use App\Models\User;
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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            // Business Info
            $table->string('business_name');
            $table->string('slug')->unique();
            $table->enum('business_type', BusinessType::array());
            $table->string('registration_number')->nullable();
            $table->string('tax_id')->nullable();

            // Address
            $table->string('address_line')->nullable();
            $table->string('city')->nullable(); // e.g Nairobi West
            $table->string('state')->nullable(); // counties in Kenya, e.g Nairobi
            $table->string('country')->nullable(); // Kenya for now
            $table->string('postal_code')->nullable();

            // Storefront (public-facing)
            $table->string('store_name');
            $table->text('store_description')->nullable();
            $table->string('store_logo')->nullable();
            $table->string('store_banner')->nullable();

            // Vendor Status
            $table->enum('status', VendorStatus::array())
                ->default(VendorStatus::PENDING->value);

            $table->foreignIdFor(User::class)
                ->unique()
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
        Schema::dropIfExists('vendors');
    }
};
