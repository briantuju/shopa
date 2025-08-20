<?php

namespace App\Models;

use Database\Factories\AttributeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    /** @use HasFactory<AttributeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_filterable',
    ];

    /** Get the values for this Attribute */
    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
