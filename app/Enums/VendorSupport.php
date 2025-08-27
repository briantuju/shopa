<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum VendorSupport: string
{
    use EnumToArray;

    case NONE = 'NONE';

    case EMAIL = 'EMAIL';

    case CHAT = 'CHAT';

    case PHONE = 'PHONE';

    case ALL = 'ALL';
}
