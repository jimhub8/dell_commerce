<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'about_us', 'user_id',
    ];
}
