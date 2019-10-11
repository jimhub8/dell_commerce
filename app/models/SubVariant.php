<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SubVariant extends Model
{
    public function variant()
    {
        return $this->belongsTo('App\models\Variants', 'variant_id');
    }
}
