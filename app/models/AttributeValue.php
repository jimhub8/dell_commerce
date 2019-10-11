<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'attribute_values';
    public $with = ['attributes'];

    /**
     * @var array
     */
    protected $fillable = [
        'attribute_id', 'value', 'price'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'attribute_id'  =>  'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class);
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(AttributeValueProductAttribute::class);
    }
}
