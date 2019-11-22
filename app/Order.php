<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'buyer_id');
    }
    public function sales()
    {
        return $this->hasMany('App\models\Sale', 'order_id');
    }
}
