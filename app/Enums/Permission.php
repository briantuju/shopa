<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Permission: string
{
    use EnumToArray;

    /*
     * These are basically CRUD operations, but more may be added as needed
     */

    case CREATE = 'CREATE';

    case VIEW = 'VIEW';

    case UPDATE = 'UPDATE';

    case DELETE = 'DELETE';
}
