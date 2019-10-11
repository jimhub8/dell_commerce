<?php

namespace App\models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;
    use HasRoles, HasApiTokens;
    protected $guard_name = 'clients';
    protected $fillable = [
        'name', 'email', 'password', 'user_id', 'client_id', 'company_name', 'phone', 'work_phone', 'address', 'display_name', 'city', 'country_id'
    ];
    protected $appends = ['is_client', 'is_admin'];


    public function orders()
    {
        return $this->hasMany('App\models\Sale', 'client_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	/**
	 * Get all user permissions.
	 *
	 * @return bool
	 */
	public function getAllPermissionsAttribute()
	{
		return $this->getAllPermissions();
    }

    public function getIsAdminAttribute()
    {
        return false;
    }

    public function getIsClientAttribute()
    {
        return true;
    }
}
