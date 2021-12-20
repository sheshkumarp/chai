<?php

namespace App\Models;

use App\Models\AssetModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasMovementHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'user_assets_has_movement';  

    

    public function asset()
    {
        return $this->belongsTo(AssetModel::class, 'fk_asset_id', 'id');
    }
    
}
