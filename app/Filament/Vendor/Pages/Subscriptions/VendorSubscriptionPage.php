<?php

namespace App\Filament\Vendor\Pages\Subscriptions;

use App\Models\VendorSubscription;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class VendorSubscriptionPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CreditCard;

    protected static string|UnitEnum|null $navigationGroup = 'My Account';

    protected static ?string $navigationLabel = 'Subscription';

    protected static ?string $title = 'My Subscription';

    protected string $view = 'filament.vendor.pages.subscriptions.vendor-subscription-page';

    public ?VendorSubscription $subscription = null;

    public function mount(): void
    {
        $vendor = auth()->user()->vendor;
        $this->subscription = $vendor->subscription;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('upgrade')
                ->label('Upgrade / Change Plan')
                ->icon('heroicon-o-arrow-up-right')
                ->action(fn () => $this->js("alert('Not implemented')")),

            Action::make('cancel')
                ->label('Cancel Subscription')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn () => $this->js("alert('Not implemented')")),
        ];
    }
}
