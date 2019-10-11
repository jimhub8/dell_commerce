<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Productimg extends Model
{
    public function product()
    {
        return $this->belongsTo('App\models\Product', 'product_id');
    }
}
