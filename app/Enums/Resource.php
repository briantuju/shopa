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

    case Product = 'Product';

    case Product_Variant = 'ProductVariant';

    case User = 'User';

    public function label(): string
    {
        return class_basename($this->value); // "User", "Product"
    }
}
