<?php

namespace App\Filament\Resources\VendorSubscriptions\Pages;

use App\Enums\VendorSubscriptionChange;
use App\Filament\Resources\VendorSubscriptions\VendorSubscriptionResource;
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
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
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
        return $schema
            ->components([
                Select::make('change_type')
                    ->options(VendorSubscriptionChange::class)
                    ->required(),
                DateTimePicker::make('effective_at')
                    ->required(),
                DateTimePicker::make('previous_ends_at'),
                TextInput::make('previous_price')
                    ->numeric(),
                TextInput::make('new_price')
                    ->numeric(),
                TextInput::make('billing_cycle'),
                TextInput::make('previous_billing_cycle'),
                TextInput::make('previous_package_snapshot'),
                TextInput::make('gateway_transaction_id'),
                TextInput::make('new_package_snapshot'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('vendor_id')
                    ->relationship('vendor', 'id')
                    ->required(),
                Select::make('package_id')
                    ->relationship('package', 'name'),
            ]);
    }

    /**
     * @throws Exception
     */
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('change_type'),
            ]);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('change_type')
            ->columns([
                TextColumn::make('change_type'),
                TextColumn::make('effective_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('previous_ends_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('previous_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('new_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('billing_cycle')
                    ->searchable(),
                TextColumn::make('previous_billing_cycle')
                    ->searchable(),
                TextColumn::make('gateway_transaction_id')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('vendor.id')
                    ->searchable(),
                TextColumn::make('package.name')
                    ->searchable(),
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
                ViewAction::make(),
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
