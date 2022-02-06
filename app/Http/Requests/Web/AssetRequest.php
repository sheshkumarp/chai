<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fk_team_id'                => 'required',
            // 'fa_type'                   => 'required',

            'code_bar_id'               => 'nullable',
            
            'fk_category_id'            => 'required',
            'equipment_description'     => 'required',
            'asset_location'            => 'required',

            'acquisition_date'          => 'required',
            
            'acquisition_cost_local'    => 'nullable|numeric',
            'acquisition_cost_usd'      => 'nullable|numeric',

            'purchased_with_donor_funds'=> 'nullable',
            'project_id'                => 'nullable',
            'in_country_location'       => 'nullable',
            
            'invoice'                   => 'required',
            
            'invoice_document'          => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf',

            'manufacturer'              => 'nullable',
            'model'                     => 'nullable',
            'serial_vehicle_identification_logbook' => 'nullable',
            'confirmed_by'                  => 'nullable',

            'inventory_confirmation_date'   => 'nullable',
            'comments'                      => 'nullable',
            'still_with_chai'               => 'nullable',
            
            'disposal_date'                 => 'nullable'
        ];
    }

    public function messages()
    {
        return [

            'acquisition_cost_local.regex'      => 'Please enter valid price.',
            'acquisition_cost_usd.regex'        => 'Please enter valid price.',
            'fk_team_id.required'               => 'Please select Zone.',

           
        ];
    }
}
