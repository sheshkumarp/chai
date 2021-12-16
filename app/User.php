<?php

namespace App;

use App\Models\OrdersHasCreditCardDetails;
use App\Models\OrdersModel;
use App\Models\CustomerHasNotesModel;
use App\Models\StatesAdmittedModel;
use App\Models\StatesModel;
use App\Models\CountryModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasStatesAdmitted()
    {
        return $this->hasMany(StatesAdmittedModel::class, 'customer_id', 'id');
    }

    public function hasCreditDetails()
    {
        return $this->belongsTo(OrdersHasCreditCardDetails::class, 'id', 'customer_id');
    }

    public function hasOrders()
    {
        return $this->hasMany(OrdersModel::class, 'customer_id', 'id');
    }

    public function hasNotes()
    {
        return $this->hasMany(CustomerHasNotesModel::class, 'from_customer_id', 'id');
    }

     public function hasCountry()
    {
        return $this->belongsTo(CountryModel::class, 'country_id', 'id');
    }

     public function hasState()
    {
        return $this->belongsTo(StatesModel::class, 'state', 'id');
    }
}