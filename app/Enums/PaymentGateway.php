<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PaymentGateway: string
{
    use EnumToArray;

    case STRIPE = 'STRIPE';

    case PAYPAL = 'PAYPAL';

    case MPESA = 'MPESA';
}
