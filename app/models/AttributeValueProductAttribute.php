<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueProductAttribute extends Model
{
    protected $table = 'attribute_value_product_attribute';

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes_value()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
