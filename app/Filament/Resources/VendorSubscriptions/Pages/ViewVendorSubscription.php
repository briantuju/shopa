<?php

namespace App\Filament\Resources\VendorSubscriptions\Pages;

use App\Filament\Resources\VendorSubscriptions\VendorSubscriptionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewVendorSubscription extends ViewRecord
{
    protected static string $resource = VendorSubscriptionResource::class;

    protected static ?string $title = 'Subscription Details';

    protected function getHeaderActions(): array
    {
        return [
            // Add actions for editable data here
        ];
    }
}
