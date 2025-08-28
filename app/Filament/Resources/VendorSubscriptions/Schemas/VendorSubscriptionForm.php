<?php

namespace App\Filament\Resources\VendorSubscriptions\Schemas;

use App\Enums\PaymentGateway;
use App\Enums\VendorSubscriptionStatus;
use App\Filament\Resources\VendorSubscriptions\Schemas\Components\CustomDateTimePicker;
use Exception;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class VendorSubscriptionForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    CustomDateTimePicker::make('started_at')
                        ->prefix('Starts')
                        ->maxDate(now()->addYear())
                        ->required(),
                    CustomDateTimePicker::make('ends_at')
                        ->prefix('Ends')
                        ->required(),
                    CustomDateTimePicker::make('cancelled_at')
                        ->prefix('Cancelled'),
                    CustomDateTimePicker::make('trial_ends_at')
                        ->prefix('Trial Ends'),
                    CustomDateTimePicker::make('renewal_at')
                        ->prefix('Renewal')
                        ->required(),
                    CustomDateTimePicker::make('last_payment_at')
                        ->prefix('Last Payment'),
                ])
                    ->columnSpanFull()
                    ->columns(['base' => 1, 'md' => 2, 'xl' => 3]),
                TextInput::make('billing_cycle')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Toggle::make('last_payment_success')
                    ->inline(false),
                TextInput::make('failed_payments_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(VendorSubscriptionStatus::class)
                    ->required(),
                Select::make('payment_gateway')
                    ->options(PaymentGateway::class)
                    ->required(),
                TextInput::make('gateway_transaction_id'),
                TextInput::make('gateway_customer_id'),
                KeyValue::make('package_snapshot'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('vendor_id')
                    ->relationship('vendor', 'id')
                    ->required(),
                Select::make('package_id')
                    ->relationship('package', 'name')
                    ->required(),
            ]);
    }
}
