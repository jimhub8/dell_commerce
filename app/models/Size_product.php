<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Size_product extends Model
{
    protected $table = 'size_products';
	protected $fillable = [
		'size_id', 'product_id',
	];
}
