<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // public $with['categories'];
    public function categories()
    {
        return $this->hasMany('App\models\Category', 'menu_id');
    }
}
