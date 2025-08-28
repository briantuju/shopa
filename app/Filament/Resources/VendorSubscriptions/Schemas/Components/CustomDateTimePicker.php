<?php

namespace App\Filament\Resources\VendorSubscriptions\Schemas\Components;

use Exception;
use Filament\Forms\Components\DateTimePicker;

class CustomDateTimePicker
{
    /**
     * @throws Exception
     */
    public static function make(string $name): DateTimePicker
    {
        return DateTimePicker::make($name)
            ->seconds(false)
            ->native(false)
            ->closeOnDateSelection()
            ->minDate(now());
    }
}
