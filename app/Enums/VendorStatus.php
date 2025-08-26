<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum VendorStatus: string
{
    use EnumToArray;

    case PENDING = 'PENDING';

    case APPROVED = 'APPROVED';

    case REJECTED = 'REJECTED';

    case SUSPENDED = 'SUSPENDED';
}
