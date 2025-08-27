<?php

namespace App\Filament\Resources\Packages\Pages;

use App\Actions\AdminPanel\CreatePackagePrice;
use App\Actions\AdminPanel\UpdatePackagePrice;
use App\Enums\PackageCycle;
use App\Filament\Resources\Packages\PackageResource;
use App\Models\PackagePrice;
use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ManagePackagePrices extends ManageRelatedRecords
{
    protected static string $resource = PackageResource::class;

    protected static string $relationship = 'prices';

    protected static ?string $navigationLabel = 'Pricing';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('billing_cycle')
                    ->options(PackageCycle::class)
                    ->native(false)
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Toggle::make('is_active'),
                Toggle::make('on_promotion')
                    ->live(),
                TextEntry::make('info')
                    ->visibleOn('edit')
                    ->columnSpanFull()
                    ->state(
                        fn (): HtmlString => new HtmlString(
                            '<p>Turning promotion on will enable promotion dates, turning it off will disable them.</p>'.
                            '<p>If promotion is off, submitting the form will clear the promotion dates.</p>'
                        )
                    ),
                DateTimePicker::make('promotion_starts_at')
                    ->seconds(false)
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Starts')
                    ->minDate(now())
                    ->maxDate(now()->addYear())
                    ->required(fn (Get $get) => $get('on_promotion'))
                    ->disabled(fn (Get $get) => ! $get('on_promotion')), // disable if promotion is off,
                DateTimePicker::make('promotion_ends_at')
                    ->seconds(false)
                    ->native(false)
                    ->closeOnDateSelection()
                    ->prefix('Ends')
                    ->minDate(now())
                    ->maxDate(now()->addYear())
                    ->disabled(fn (Get $get) => ! $get('on_promotion')), // disable if promotion is off,
            ]);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('billing_cycle')
            ->columns([
                TextColumn::make('billing_cycle'),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('on_promotion')
                    ->boolean(),
                TextColumn::make('promotion_starts_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('promotion_ends_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                CreateAction::make()
                    ->using(
                        fn (Action $action, array $data) => CreatePackagePrice::run($action, array_merge($data, [
                            // $this->record refers to the package and is always available at this point
                            'package_id' => $this->record->id,
                        ]))
                    ),
                AssociateAction::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->slideOver()
                        ->using(fn (PackagePrice $record, array $data) => UpdatePackagePrice::run($record, $data)),
                    DissociateAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
