<?php

namespace App\Filament\Resources\VendorSubscriptions;

use App\Filament\Resources\VendorSubscriptions\Pages\ListVendorSubscriptions;
use App\Filament\Resources\VendorSubscriptions\Pages\ManageVendorSubscriptionHistory;
use App\Filament\Resources\VendorSubscriptions\Pages\ViewVendorSubscription;
use App\Filament\Resources\VendorSubscriptions\Schemas\VendorSubscriptionForm;
use App\Filament\Resources\VendorSubscriptions\Tables\VendorSubscriptionsTable;
use App\Models\VendorSubscription;
use Exception;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class VendorSubscriptionResource extends Resource
{
    protected static ?string $model = VendorSubscription::class;

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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ManageVendorSubscriptionHistory::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVendorSubscriptions::route('/'),
            'view' => ViewVendorSubscription::route('/{record}'),
            'history' => ManageVendorSubscriptionHistory::route('/{record}/history'),
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
