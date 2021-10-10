<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\AdminUserModel;
use Spatie\Permission\Models\Role;

// Request
use App\Http\Requests\Admin\UsersRequest;
use App\Models\AssetModel;

use Rap2hpoutre\FastExcel\FastExcel;

// plugins
use Hash;
use DB;
use Auth;

class UsersController extends Controller
{
    public function __construct(
        AdminUserModel $AdminUserModel,
        Role $RoleModel,
        AssetModel $AssetModel
    )
    {
        $this->BaseModel        = $AdminUserModel;
        $this->AdminUserModel   = $AdminUserModel;
        $this->RoleModel        = $RoleModel;
        $this->AssetModel       = $AssetModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleTitle = 'Users';
        $this->ModuleView  = 'admin.users.';
        $this->ModulePath = 'admin.users';

        $this->middleware(['permission:manage-users'], ['only' => ['edit','update','destroy','create','store']]);

    }

    public function index()
    {
        // Default site settings
        $this->ViewData['moduleTitle']  = 'Manage '.$this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Manage '.$this->ModuleTitle;
        $this->ViewData['modulePath']   = $this->ModulePath;

        // $this->ViewData['users'] = $this->AdminUserModel->orderBy('id', 'DESC')->get();

        // view file with data
        return view($this->ModuleView.'index', $this->ViewData);
    }

    public function create()
    {
        // Default site settings
        $this->ViewData['moduleTitle']  = 'Manage '.$this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Create '.str_singular($this->ModuleTitle);
        $this->ViewData['modulePath']   = $this->ModulePath;

        // All userdata
        $this->ViewData['users'] = $this->BaseModel->get();

        // view file with data
        return view($this->ModuleView.'create', $this->ViewData);
    }

    public function store(UsersRequest $request)
    {

        DB::beginTransaction();
        
        $this->JsonData['status'] = __('admin.RESP_ERROR');
        $this->JsonData['msg'] = __('admin.FAIL_USER_CREATE');

        $collection = new $this->BaseModel;

        $collection->username   = strtolower($request->first_name.'-'.$request->last_name);

        $collection = self::_storeOrUpdate($collection,$request);

        if ($collection) 
        {
            // attach role
            $role = $this->RoleModel->where('id', base64_decode(base64_decode($request->role)))
            ->pluck('name')
            ->first();


            try {

              $collection->assignRole(strtolower($role));

              DB::commit();


              $this->JsonData['status'] = __('admin.RESP_SUCCESS');
              $this->JsonData['msg'] = __('admin.USER_CREATED');

          }
          catch(\Exception $e) {

            $this->JsonData['exception'] = $e->getMessage();
            DB::rollback();
        }
    }
    else
    {
       DB::rollback();
   }

         // flush permission cache
   app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

   return response()->json($this->JsonData);
}

public function show($id)
{
    dd('show');
}

public function edit($encID)
{
        // Default site settings
    $this->ViewData['moduleTitle']  = 'Manage '.$this->ModuleTitle;
    $this->ViewData['moduleAction'] = 'Edit '.$this->ModuleTitle;
    $this->ViewData['modulePath']   = $this->ModulePath;

        // All userdata
    $id = base64_decode(base64_decode($encID));
    $this->ViewData['user'] = $this->BaseModel->find($id);

        // view file with data
    return view($this->ModuleView.'edit', $this->ViewData);
}

public function update(UsersRequest $request, $endID)
{
    DB::beginTransaction();

    $id = base64_decode(base64_decode($endID));

    $this->JsonData['status'] = __('admin.RESP_ERROR');
    $this->JsonData['msg'] = __('admin.FAIL_USER_CREATE');

    $collection = $this->BaseModel->find($id);

    $collection = self::_storeOrUpdate($collection,$request);

    if ($collection) 
    {
        $this->JsonData['status'] = __('admin.RESP_SUCCESS');
        $this->JsonData['msg'] = __('admin.USER_UPDATED');

        DB::commit();
    }
    else
    {
       DB::rollback();
   }

        // flush permission cache
   app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

   return response()->json($this->JsonData);
}


public function destroy($encID)
{
    $this->JsonData['status'] = 'error';
    $this->JsonData['msg'] = 'Failed to delete user, Something went wrong on server.';

    $id = base64_decode(base64_decode($encID));

    if ((int)$id === (int)auth()->user()->id) 
    {
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] = 'Can\'t delete current logged user';
        return response()->json($this->JsonData);
        exit;
    }

    $BaseModel = $this->BaseModel->find($id);
    $BaseModel->syncRoles([]);  
    if($BaseModel->delete())
    {
        $this->JsonData['status'] = 'success';
        $this->JsonData['msg'] = 'User deleted successfully.';
    }

    return response()->json($this->JsonData);
}

public function getRecords(Request $request)
{
        /*--------------------------------------
        |  Variables
        ------------------------------*/

            // skip and limit
        $start = $request->start;
        $length = $request->length;

            // serach value
        $search = $request->search['value']; 

            // order
        $column = $request->order[0]['column'];
        $dir = $request->order[0]['dir'];

            // filter columns
        $filter = array(
            0 => 'id',
            1 => 'first_name',
            2 => 'last_name',
            3 => 'email',
            4 => 'password',
            5 => 'status'
        );

        /*--------------------------------------
        |  Model query and filter
        ------------------------------*/

        // start model query
        $modelQuery =  $this->BaseModel->with('assets')->has('roles', '<', 1);


        
        // get total count 
        $countQuery = clone($modelQuery);            
        $totalData  = $countQuery->count();

            // filter options
        if (!empty($search) || $search == '0') 
        {

            $modelQuery = $modelQuery->where(function ($query) use($search)
            {
                $query->orwhere('first_name', 'LIKE', '%'.$search.'%');   
                $query->orwhere('last_name', 'LIKE', '%'.$search.'%');   
                $query->orwhere('email', 'LIKE', '%'.$search.'%');   
                $query->orwhere('status', 'LIKE', '%'.$search.'%');   
            });
        }

            // get total filtered
        $filteredQuery = clone($modelQuery);            
        $totalFiltered  = $filteredQuery->count();

            // offset and limit
        $object = $modelQuery->orderBy($filter[$column], $dir)
        ->skip($start)
        ->take($length)
        ->get();            

        /*--------------------------------------
        |  data binding
        ------------------------------*/
        $data = [];
        if (!empty($object) && sizeof($object) > 0) 
        {
            foreach ($object as $key => $row) 
            {
                $data[$key]['id']           = $row->id;
                $data[$key]['first_name']   = '<span title="'.ucfirst($row->first_name).'">'.ucfirst($row->first_name).'</span>';
                $data[$key]['last_name']    = '<span title="'.ucfirst($row->last_name).'">'.ucfirst($row->last_name).'</span>';
                $data[$key]['email']        = '<a title="'.$row->email.'" href="mailto:'.$row->email.'" target="_blank" >'.strtolower($row->email).'</a>';   
                $data[$key]['password']         = "<span class='theme-blue'>".$row->str_password."</span>";

                if (!empty($row->status)) 
                {
                    $data[$key]['status'] = '<span class="theme-green semibold text-center f-18" >Active</i></span>';
                }
                else
                {
                    $data[$key]['status'] = '<span class="theme-black-light semibold text-center f-18" >Inactive</i></span>';
                }


                $download = '';
                if(!empty($row->assets) && sizeof($row->assets) > 0)
                {

                    $download = '<a title="Download Assets of User" href="'.route('admin.users.downloadAssetsRecords', [ base64_encode(base64_encode($row->id))]).'">
                    <img style="width:35px;height:35px" src="'.url('/assets/admin/images').'/sheet.jpeg" alt=" edit"></a>';
                }


                $edit = '<a href="'.route('admin.users.edit', [ base64_encode(base64_encode($row->id))]).'"><img src="'.url('/assets/admin/images').'/icons/edit.svg" alt=" edit"></a>';
               
                $delete = '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="'.route('admin.users.destroy', [base64_encode(base64_encode($row->id))]) .'" ><img src="'.url('/assets/admin/images').'/icons/delete.svg" alt=" delete"></a>';

                if ((int)$row->id === (int)auth()->user()->id) 
                {
                    $delete = '';
                }

                $data[$key]['actions'] = '';
                if(auth()->user()->can('manage-users'))
                {
                    $data[$key]['actions'] = '<div class="text-center">'.$download.$edit.$delete.'</div>';
                }
            }
        }

            // wrapping up
        $this->JsonData['draw']             = intval($request->draw);
        $this->JsonData['recordsTotal']     = intval($totalData);
        $this->JsonData['recordsFiltered']  = intval($totalFiltered);
        $this->JsonData['data']             = $data;

        return response()->json($this->JsonData);
    }    

    public function _storeOrUpdate($collection, $request)
    {
        $collection->first_name = $request->first_name;
        $collection->last_name  = $request->last_name;
        $collection->email      = $request->email;
        
        // get ip address
        $collection->last_ip    = request()->ip();

        // generate password
        if(!empty($request->password))
        {
            $collection->password   = Hash::make($request->password);
            $collection->str_password   = $request->password;
        }

        $collection->save();
        
        return $collection;
    }


    public function downloadAssetsRecords($encID)
    {

        $id = base64_decode(base64_decode($encID));

        $data = $this->AssetModel->where('fk_user_id', $id)
                                ->with(['category', 'team'])
                                ->orderBy('created_at', 'DESC')
                                ->get();

        return (new FastExcel($data))->download('assets.csv', function ($object) {

                    return [
                        'Team'                  => ucfirst($object->team->title),
                        'Asset Type'            => ucfirst($object->category->name),
                        'Code Bar ID'           => $object->code_bar_id,
                        'Equipment Description' => ucfirst($object->equipment_description),
                        'Acquisition Date'      => date('d/m/Y', strtotime($object->acquisition_date)),
                        'Acquisition Cost Local'=> number_format($object->acquisition_cost_local, 2),
                        'Acquisition Cost USD'  => number_format($object->acquisition_cost_usd, 2),
                        'Purchased With Donor Funds' => $object->purchased_with_donor_funds,
                        'Project ID'            => $object->project_id,
                        'In Country Location'   => $object->in_country_location,
                        'Invoice Number'        => $object->invoice,
                        'Manufacturer'          => ucfirst($object->manufacturer),
                        'Model'                 => ucfirst($object->model),
                        'Inventory Confirmation Date' => date('d/m/Y', strtotime($object->inventory_confirmation_date)),
                        'Confirmed By'          => ucfirst($object->confirmed_by),
                        'Serial/Vehicle/Identification/Logbook' => $object->serial_vehicle_identification_logbook,
                        'Comments'              => ucfirst($object->comments),
                        'Still With Chai'       => $object->still_with_chai,
                        'Disposal Date (If NO longer with CHAI)' => date('d/m/Y', strtotime($object->disposal_date))
                    ];
            
                });
    }
}
