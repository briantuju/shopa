<?php

namespace App\Filament\Resources\Packages\Pages;

use App\Filament\Resources\Packages\PackageResource;
use BackedEnum;
use Exception;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManagePackageEntitlements extends ManageRelatedRecords
{
    protected static string $resource = PackageResource::class;

    protected static ?string $navigationLabel = 'What\'s included';

    protected static string $relationship = 'entitlements';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required(),
                TextInput::make('value')
                    ->required(),
            ]);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('key')
            ->columns([
                TextColumn::make('key')
                    ->searchable(),
                TextColumn::make('value'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
