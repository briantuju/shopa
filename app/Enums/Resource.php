<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Resource: string
{
    use EnumToArray;

    /*
     * This is a hard coded list of models that are used in the system
     * */

    case Attribute = 'Attribute';

    case Attribute_Value = 'AttributeValue';

    case Brand = 'Brand';

    case Category = 'Category';

    case Package = 'Package';

    case PackageEntitlement = 'PackageEntitlement';

    case PackagePrice = 'PackagePrice';

    case Product = 'Product';

    case ProductVariant = 'ProductVariant';

    case User = 'User';

    case Vendor = 'Vendor';

    case VendorEntitlement = 'VendorEntitlement';

    case VendorSubscription = 'VendorSubscription';

    case VendorSubscriptionHistory = 'VendorSubscriptionHistory';

    public function label(): string
    {
        return class_basename($this->value); // "User", "Product"
    }
}
