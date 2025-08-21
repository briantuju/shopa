<?php

namespace App\Enums;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Traits\EnumToArray;

enum Resource: string
{
    use EnumToArray;

    /*
     * This is a list of models that are used in the system
     * */

    case ATTRIBUTE = Attribute::class;

    case ATTRIBUTE_VALUE = AttributeValue::class;

    case BRAND = Brand::class;

    case CATEGORY = Category::class;

    case PRODUCT = Product::class;

    case PRODUCT_VARIANT = ProductVariant::class;

    case USER = User::class;

    public function label(): string
    {
        return class_basename($this->value); // "User", "Product"
    }
}
