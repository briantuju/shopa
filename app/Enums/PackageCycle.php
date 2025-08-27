<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PackageCycle: string
{
    use EnumToArray;

    case MONTHLY = 'MONTHLY';

    case YEARLY = 'YEARLY';
}
