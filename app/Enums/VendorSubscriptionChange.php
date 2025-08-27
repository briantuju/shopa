<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum VendorSubscriptionChange: string
{
    use EnumToArray;

    case CREATED = 'CREATED';

    case UPGRADED = 'UPGRADED';

    case DOWNGRADED = 'DOWNGRADED';

    case CANCELLED = 'CANCELLED';

    case RENEWED = 'RENEWED';

    case TRIAL_STARTED = 'TRIAL_STARTED';

}
