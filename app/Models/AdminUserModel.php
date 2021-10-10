<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use App\Models\AssetModel;

class AdminUserModel extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table 		= 'users'; 

    protected $guard_name 	= 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function assets()
    {
        return $this->hasMany(AssetModel::class, 'fk_user_id', 'id');
    }
}
