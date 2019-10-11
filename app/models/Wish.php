<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    public $with = ['product'];
    public function product()
    {
        return $this->belongsTo('App\models\Product', 'product_id');
    }

    public function user()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
