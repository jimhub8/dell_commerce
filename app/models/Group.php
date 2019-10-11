<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $with = ['products'];
    public function products()
    {
        return $this->hasMany('App\models\Product', 'group_id');
    }
    
    /**
     * The variants that belong to the user.
     */
    public function variants()
    {
        return $this->belongsToMany('App\models\Variant', 'product_variants');
    }
}
