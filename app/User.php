<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquen;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order', 'buyer_id');
    }

    /**
     * Get all user permissions.
     *
     * @return bool
     */
    public function getAllPermissionsAttribute()
    {
        return $this->getAllPermissions();
    }


    // public static function boot() {

    //     parent::boot();

    //     static::created(function($shipment) {
    //         Event::fire('shipment.created', $shipment);
    //     });

    //     static::updated(function($shipment) {
    //         Event::fire('shipment.updated', $shipment);
    //     });

    //     static::deleted(function($shipment) {
    //         Event::fire('shipment.deleted', $shipment);
    //     });

    //     static::creating(function($shipment) {
    //         Event::fire('shipment.creating', $shipment);
    //     });
    // }

}
