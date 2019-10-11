<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function sizes()
    {
        return $this->belongsTo('App\models\Product', 'product_id');
    }
}
