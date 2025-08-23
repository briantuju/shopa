<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum BusinessType: string
{
    use EnumToArray;

    case INDIVIDUAL = 'individual';

    case COMPANY = 'company';
}
