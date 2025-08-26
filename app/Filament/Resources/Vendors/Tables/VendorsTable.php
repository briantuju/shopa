<?php

namespace App\Filament\Resources\Vendors\Tables;

use App\Enums\VendorStatus;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VendorsTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('store_logo')->circular(),
                TextColumn::make('store_name')->searchable()->sortable(),
                TextColumn::make('business_name')->searchable()->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors(fn (VendorStatus $state) => match ($state->value) {
                        'APPROVED' => ['success'],
                        'PENDING' => ['gray'],
                        'REJECTED' => ['warning'],
                        'SUSPENDED' => ['danger'],
                        default => ['primary'],
                    }),
                TextColumn::make('user.name')->label('Owner'),
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
                SelectFilter::make('status')
                    ->options(VendorStatus::class),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
