<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\AdminUserModel;
use Spatie\Permission\Models\Role;

// Request
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\AdminUpdatePasswordRequest;

// plugins
use Hash;
use DB;
use Auth;

class AdminController extends Controller
{
    public function __construct(
        AdminUserModel $AdminUserModel,
        Role $RoleModel
    )
    {
        $this->BaseModel  = $AdminUserModel;
        $this->AdminUserModel  = $AdminUserModel;
        $this->RoleModel  = $RoleModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleTitle = 'Admins';
        $this->ModuleView  = 'admin.records.';
        $this->ModulePath = 'admin.records';

        $this->middleware(['permission:manage-admins'], ['only' => ['edit','update','destroy','create','store']]);

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

    public function store(AdminRequest $request)
    {   

        DB::beginTransaction();
        
        $this->JsonData['status'] = __('admin.RESP_ERROR');
        $this->JsonData['msg'] = 'Failed to create Admin, Something went wrong on server';

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
              $this->JsonData['msg'] = 'Admin Created Successfully';

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

public function update(AdminRequest $request, $endID)
{
    DB::beginTransaction();

    $id = base64_decode(base64_decode($endID));

    $this->JsonData['status'] = __('admin.RESP_ERROR');
    $this->JsonData['msg'] = __('admin.FAIL_USER_CREATE');

    $collection = $this->BaseModel->find($id);

        // create username
    if(!$collection->hasRole('admin'))
    {
        $collection->status   = empty($request->status) ? 0 : 1;
        $collection->username   = strtolower($request->first_name.'-'.$request->last_name);
    }

    $collection = self::_storeOrUpdate($collection,$request);

    if ($collection) 
    {
            // attach role
        if(!empty($request->role))
        {
            $roleCollection = $this->RoleModel->where('id', base64_decode(base64_decode($request->role)))->first();

            try 
            {
                $collection->syncRoles(strtolower($roleCollection->name));
                try 
                {
                    $permissions = $request->except(['_token','_method','role','first_name','last_name','email','password','confirm_password','status','user_id' ]);

                    if($collection->syncPermissions($permissions))
                    {
                        $this->JsonData['status'] = __('admin.RESP_SUCCESS');
                        $this->JsonData['msg'] = __('admin.USER_UPDATED');
            
                        DB::commit();
                    }
                } catch (Exception $e) 
                {
                    $this->JsonData['exception'] = $e->getMessage();
                    DB::rollback();   
                }
            }
            catch(\Exception $e) {

                $this->JsonData['exception'] = $e->getMessage();
                DB::rollback();
            }
        }
        else
        {
            $this->JsonData['status'] = __('admin.RESP_SUCCESS');
            $this->JsonData['msg'] = __('admin.USER_UPDATED');
            DB::commit();
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

public function updatePassword(AdminUpdatePasswordRequest $request)
{
    $new_pasword = $request->password;
    if (!empty($new_pasword)) 
    {
        $collection = $this->BaseModel
        ->where('id', auth()->user()->id)
        ->where('email', auth()->user()->email)
        ->first();

        if (!empty($collection)) 
        {
            if (Hash::check($request->old_password, $collection->password))        
            {
                $collection->password   = Hash::make($new_pasword);
                $collection->str_password   = $new_pasword;
                
                if($collection->save())
                {
                    $this->JsonData['status'] = 'success';
                    $this->JsonData['msg'] = 'Password updated successfully.';
                }
                else
                {
                    $this->JsonData['status'] = 'error';
                    $this->JsonData['msg'] = 'Failed to update password, Something went wrong on server.';
                }
            }
            else
            {
                $this->JsonData['status'] = 'error';
                $this->JsonData['msg'] = 'Old password does not match with the password you logged in.';
            }
        }
        else
        {
            $this->JsonData['status'] = 'error';
            $this->JsonData['msg'] = 'Session timeout, Please try again after login.';
        }
    }
    else
    {
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] = 'New password field is required.';
    }

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
            4 => 'role',
            5 => 'status'
        );

        /*--------------------------------------
        |  Model query and filter
        ------------------------------*/

        // start model query
        $modelQuery =  $this->BaseModel
        ->leftjoin('model_has_permissions', 'model_has_permissions.model_id' , '=', 'users.id')
        ->whereHas('roles', function($query) {
            $query->where('guard_name', 'admin');
        });

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
                if (!$row->hasRole('super-admin') || auth()->user()->hasRole('super-admin')) 
                {

                    $data[$key]['id']           = $row->id;
                    $data[$key]['first_name']   = '<span title="'.ucfirst($row->first_name).'">'.ucfirst($row->first_name).'</span>';
                    $data[$key]['last_name']    = '<span title="'.ucfirst($row->last_name).'">'.ucfirst($row->last_name).'</span>';
                    $data[$key]['email']        = '<a title="'.$row->email.'" href="mailto:'.$row->email.'" target="_blank" >'.strtolower($row->email).'</a>';   


                    if(!empty($row->model_id))
                    {
                        $data[$key]['role']         = "<span class='theme-blue'>".ucfirst($row->getRoleNames()[0] ?? '')." * </span>";

                    }else{
                    $data[$key]['role']         = ucfirst($row->getRoleNames()[0] ?? ''); }

                    if (!empty($row->status)) 
                    {
                        $data[$key]['status'] = '<span class="theme-green semibold text-center f-18" >Active</i></span>';
                    }
                    else
                    {
                        $data[$key]['status'] = '<span class="theme-black-light semibold text-center f-18" >Inactive</i></span>';
                    }

                    $edit = '<a href="'.route('admin.records.edit', [ base64_encode(base64_encode($row->id))]).'"><img src="'.url('/assets/admin/images').'/icons/edit.svg" alt=" edit"></a>';
                   
                    $delete = '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="'.route('admin.records.destroy', [base64_encode(base64_encode($row->id))]) .'" ><img src="'.url('/assets/admin/images').'/icons/delete.svg" alt=" delete"></a>';

                    if ((int)$row->id === (int)auth()->user()->id) 
                    {
                        $delete = '';
                    }

                    $data[$key]['actions'] = '';
                    if(auth()->user()->can('manage-admins'))
                    {
                        $data[$key]['actions'] = '<div class="text-center">'.$edit.$delete.'</div>';
                    }

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
}
