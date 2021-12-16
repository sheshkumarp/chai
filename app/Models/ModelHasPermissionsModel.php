<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;

class ModelHasPermissionsModel extends Model
{
    protected $table = 'model_has_permissions';  

    public function permissions()
    {
    	return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
