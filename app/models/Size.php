<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\models\Product', 'size_products', 'size_id', 'product_id');
    }
}
