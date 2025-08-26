<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Enums\VendorStatus;
use App\Filament\Resources\Vendors\VendorResource;
use App\Models\Vendor;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /** @param  array{status: VendorStatus}  $data */
    protected function handleRecordUpdate(Vendor|Model $record, array $data): Model
    {
        $record->update($data);

        // The status is not mass assignable, so we need to update it separately
        $record->status = $data['status']->value;
        $record->save();

        return $record;
    }
}
