<?php

namespace App\Filament\Resources\VendorSubscriptions\Schemas;

use App\Filament\Resources\VendorSubscriptions\Schemas\Components\CustomDateTimePicker;
use Exception;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class VendorSubscriptionHistoryForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('change_type'),
                CustomDateTimePicker::make('effective_at')
                    ->prefix('Effective at'),
                CustomDateTimePicker::make('previous_ends_at')
                    ->prefix('Ended at'),
                TextInput::make('previous_price')
                    ->prefix('$')
                    ->numeric(),
                TextInput::make('new_price')
                    ->prefix('$')
                    ->numeric(),
                TextInput::make('billing_cycle'),
                TextInput::make('previous_billing_cycle'),
                TextInput::make('gateway_transaction_id')
                    ->label('Transaction ID'),
                KeyValue::make('previous_package_snapshot'),
                KeyValue::make('new_package_snapshot'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Group::make([
                    Select::make('user_id')
                        ->relationship('user', 'name'),
                    Select::make('vendor_id')
                        ->relationship('vendor', 'business_name'),
                    Select::make('package_id')
                        ->relationship('package', 'name'),
                ])
                    ->columnSpanFull()
                    ->columns(['base' => 1, 'md' => 2, 'xl' => 3]),
            ]);
    }
}
