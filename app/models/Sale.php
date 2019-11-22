<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $with = ['product'];
    public function product()
    {
        return $this->belongsTo('App\models\Product', 'product_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
