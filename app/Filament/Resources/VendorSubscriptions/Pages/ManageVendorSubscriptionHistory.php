<?php

namespace App\Filament\Resources\VendorSubscriptions\Pages;

use App\Filament\Resources\VendorSubscriptions\Schemas\VendorSubscriptionHistoryForm;
use App\Filament\Resources\VendorSubscriptions\Tables\VendorSubscriptionHistoryTable;
use App\Filament\Resources\VendorSubscriptions\VendorSubscriptionResource;
use BackedEnum;
use Exception;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ManageVendorSubscriptionHistory extends ManageRelatedRecords
{
    protected static string $resource = VendorSubscriptionResource::class;

    protected static string $relationship = 'history';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QueueList;

    protected static ?string $title = 'Subscription History';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return VendorSubscriptionHistoryForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return VendorSubscriptionHistoryTable::configure($table);
    }
}
