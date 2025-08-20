<?php

namespace App\Filament\Resources\Attributes\Pages;

use App\Filament\Resources\Attributes\AttributeResource;
use App\Models\Attribute;
use Exception;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageAttributes extends ManageRecords
{
    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->using(function (CreateAction $action, array $data, string $model): Model {
                    try {
                        /** @var Attribute $model */
                        return $model::create($data);
                    } catch (Exception $ex) {
                        Notification::make()
                            ->warning()
                            ->title('Failed to create attribute')
                            ->body($ex->getMessage())
                            ->send();

                        $action->halt();
                    }
                }),
        ];
    }
}
