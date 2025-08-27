<?php

namespace App\Actions\AdminPanel;

use App\Models\PackagePrice;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePackagePrice
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(Action $action, array $data)
    {
        try {
            return PackagePrice::create($data);
        } catch (Exception $exception) {
            Notification::make('create_failed')
                ->color('danger')
                ->title('An error occurred')
                ->body($exception->getMessage())
                ->duration(10000)
                ->send();

            $action->halt();
        }
    }
}
