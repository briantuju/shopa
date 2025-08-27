<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum VendorSubscriptionStatus: string
{
    use EnumToArray;

    case ACTIVE = 'ACTIVE';

    case EXPIRED = 'EXPIRED';

    case CANCELED = 'CANCELED';

    case TRIAL = 'TRIAL';

    case PAST_DUE = 'PAST_DUE';
}
