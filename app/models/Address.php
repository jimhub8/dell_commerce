<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name', 'email', 'city', 'phone', 'additinal_phone', 'address', 'notes', 'user_id', 'postal_code', 'country',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
