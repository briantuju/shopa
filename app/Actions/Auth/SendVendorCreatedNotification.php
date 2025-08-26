<?php

namespace App\Actions\Auth;

use App\Actions\GetAdminUser;
use App\Filament\Resources\Vendors\Pages\EditVendor;
use App\Models\Vendor;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Lorisleiva\Actions\Concerns\AsAction;

class SendVendorCreatedNotification
{
    use AsAction;

    public function handle(Vendor $vendor): void
    {
        $recipient = GetAdminUser::run();

        Notification::make()
            ->title('Vendor Signup')
            ->body('A new vendor has signed up to Shopa.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(EditVendor::getUrl(parameters: ['record' => $vendor->id]), shouldOpenInNewTab: true)
                    ->close(),
            ])
            ->broadcast($recipient)
            ->sendToDatabase($recipient);
    }
}
