<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum VendorStatus: string
{
    use EnumToArray;

    case PENDING = 'pending';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    case SUSPENDED = 'suspended';
}
