<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SupCategory extends Model
{
    // public $with = ['products'];
    public function category()
    {
        return $this->belongsTo('App\models\Category', 'category_id');
    }

    public function products()
    {
        return $this->hasMany('App\models\Product', 'subCategory_id');
    }
}
