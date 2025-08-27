<?php

namespace App\Filament\Resources\Packages\Schemas;

use Exception;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PackageForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required(),
            Textarea::make('description')
                ->columnSpanFull(),
            TextInput::make('grace_period_days')
                ->minValue(0)
                ->numeric()
                ->default(0),
            TextInput::make('trial_period_days')
                ->minValue(0)
                ->numeric()
                ->default(0),
            Toggle::make('is_default')
                ->required(),
        ]);
    }
}
