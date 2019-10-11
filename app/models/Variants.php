<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    public $with = ['subvariants'];
    public function subvariants()
    {
        return $this->hasMany('App\models\SubVariant', 'variant_id');
    }

    /**
     * The products that belong to the user.
     */
    public function products()
    {
        return $this->belongsToMany('App\models\Product', 'product_variants');
    }
}
