<?php

namespace App\Filament\Vendor\Pages\Subscriptions;

use App\Models\Package;
use App\Models\VendorSubscription;
use Filament\Pages\Page;

class CreateVendorSubscriptionPage extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.vendor.pages.subscriptions.create-vendor-subscription-page';

    protected static ?string $title = 'Subscribe to start selling';

    protected static ?string $slug = 'create-subscription';

    public ?VendorSubscription $subscription;

    /** @var array<Package> */
    public $packages;

    public function mount(): void
    {
        $this->subscription = auth()->user()->vendor?->subscription;

        $this->packages = Package::whereHas('prices')
            ->with('prices')
            ->with('entitlements')
            ->get();
    }

    public function subscribe(int $price_id)
    {
        $this->js("alert('Not implemented $price_id')");
    }
}
