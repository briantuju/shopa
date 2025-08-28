<?php

namespace App\Filament\Resources\VendorSubscriptions\Tables;

use App\Enums\VendorSubscriptionStatus;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VendorSubscriptionsTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('billing_cycle')
                    ->searchable(),
                TextColumn::make('vendor.business_name')
                    ->searchable(),
                TextColumn::make('package.name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('gateway_transaction_id')
                    ->label('Transaction ID')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors(
                        fn (VendorSubscriptionStatus $state) => match ($state->value) {
                            'ACTIVE' => ['success'],
                            'EXPIRED', 'CANCELED' => ['warning'],
                            'TRIAL' => ['info'],
                            'PAST_DUE' => ['gray'],
                            default => ['primary'],
                        }
                    ),
                TextColumn::make('payment_gateway'),
                TextColumn::make('started_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('ends_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('cancelled_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('trial_ends_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('renewal_at')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('last_payment_at')
                    ->dateTime('y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('last_payment_success')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('failed_payments_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gateway_customer_id')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
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
            ->groups([
                'billing_cycle',
                'vendor.business_name',
                'package.name',
                'status',
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
