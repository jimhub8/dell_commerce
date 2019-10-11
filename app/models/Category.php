<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $with = ['subCategories', 'products'];
    public function brands()
    {
        return $this->hasMany('App\models\Brand', 'category_id');
    }
    public function subCategories()
    {
        return $this->hasMany('App\models\SupCategory', 'category_id');
    }
    public function menu()
    {
        return $this->belongsTo('App\models\Menu', 'menu_id');
    }  
    public function products()
    {
        // return $this->hasManyThrough('App\models\Product', 'App\models\SupCategory', 'category_id', 'subcategory_id');
            return $this->hasMany('App\models\Product', 'category_id');
        
    }
}
