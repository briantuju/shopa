<?php

namespace App\Filament\Resources\Packages;

use App\Filament\Resources\Packages\Pages\ManagePackages;
use App\Filament\Resources\Packages\Schemas\PackageForm;
use App\Filament\Resources\Packages\Tables\PackagesTable;
use App\Models\Package;
use BackedEnum;
use Exception;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Trophy;

    protected static string|UnitEnum|null $navigationGroup = 'Sales';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return PackageForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return PackagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePackages::route('/'),
        ];
    }
}
