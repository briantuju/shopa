<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Role: string
{
    use EnumToArray;

    /*
     * Admin role is reserved for the administrators only.
     * */
    case ADMIN = 'ADMIN';

    /*
     * Vendor role is used for identifying vendors in the system.
     * */
    case VENDOR = 'VENDOR';

    /*
     * The USER role is used for regular users.
     * */
    case USER = 'USER';
}
