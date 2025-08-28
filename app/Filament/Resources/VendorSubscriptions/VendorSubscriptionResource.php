<?php

namespace App\Filament\Resources\VendorSubscriptions;

use App\Filament\Resources\VendorSubscriptions\Pages\ListVendorSubscriptions;
use App\Filament\Resources\VendorSubscriptions\Pages\ViewVendorSubscription;
use App\Filament\Resources\VendorSubscriptions\Schemas\VendorSubscriptionForm;
use App\Filament\Resources\VendorSubscriptions\Tables\VendorSubscriptionsTable;
use App\Models\VendorSubscription;
use BackedEnum;
use Exception;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class VendorSubscriptionResource extends Resource
{
    protected static ?string $model = VendorSubscription::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static string|UnitEnum|null $navigationGroup = 'Sales';

    protected static ?string $navigationLabel = 'Subscriptions';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return VendorSubscriptionForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return VendorSubscriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVendorSubscriptions::route('/'),
            'view' => ViewVendorSubscription::route('/{record}'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
