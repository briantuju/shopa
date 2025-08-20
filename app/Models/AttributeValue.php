<?php

namespace App\Models;

use Database\Factories\AttributeValueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeValue extends Model
{
    /** @use HasFactory<AttributeValueFactory> */
    use HasFactory;

    protected $fillable = [
        'value',
        'attribute_id',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
