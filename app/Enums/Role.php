<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Role: string
{
    use EnumToArray;

    /*
     * Admin role is reserved for the administrators only.
     * */
    const ADMIN = 'ADMIN';

    /*
     * Vendor role is used for identifying vendors in the system.
     * */
    const VENDOR = 'VENDOR';

    /*
     * The USER role is used for regular users.
     * */
    const USER = 'USER';
}
