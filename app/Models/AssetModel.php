<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CategoryModel;
use App\Models\AssetTypesModel;
use App\Models\TeamModel;

use Illuminate\Database\Eloquent\SoftDeletes;


class AssetModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_has_assets';  

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(AssetTypesModel::class, 'fk_category_id', 'id');
    }  

    public function team()
    {
        return $this->belongsTo(TeamModel::class, 'fk_team_id', 'id');
    }
}
