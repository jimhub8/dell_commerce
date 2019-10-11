<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * @var string
     */
    protected $table = 'attributes';
    public $with = ['values'];
    /**
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'frontend_type', 'is_filterable', 'is_required'
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'is_filterable' =>  'boolean',
        'is_required'   =>  'boolean',
    ];
    // public function products()
    // {
    //     return $this->belongsToMany('App\models\Product');
    // }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
