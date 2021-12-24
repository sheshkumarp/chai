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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        // $modelQuery =  $this->BaseModel->with('assets')->has('roles', '<', 1);
        $modelQuery =  $this->BaseModel->with('assets')->has('assets');

        // dd($modelQuery->get()->toArray());

        
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

                $edit = '';
                if(count($row->roles) == 0) {

                    $edit = '<a href="'.route('admin.users.edit', [ base64_encode(base64_encode($row->id))]).'"><img src="'.url('/assets/admin/images').'/icons/edit.svg" alt=" edit"></a>';
               
                }

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

        $collections = $this->AssetModel->where('fk_user_id', $id)
                                ->with(['category', 'team'])
                                ->orderBy('created_at', 'DESC')
                                ->get();


        if (!empty($collections) && sizeof($collections) > 0)
        {
            $spreadsheet = new Spreadsheet();

            $data = [];
                
            $data[] = array('Team',
                            'Asset Type',
                            'Code Bar ID',
                            'Equipment Description',
                            'Acquisition Date',
                            'Acquisition Cost (CDF)',
                            'Acquisition Cost (USD)',
                            'Purchased With Donor Funds',
                            'Project ID',
                            'In Country Location',
                            'Invoice Number',
                            'Manufacturer',
                            'Model',
                            'Inventory Confirmation Date',
                            'Confirmed By',
                            'Serial/Vehicle/Identification/Logbook',
                            'Comments',
                            'Still With Chai',
                            'Disposal Date (If NO longer with CHAI)'
                        );
            
            $data[] = [];

            foreach ($collections as $key => $object) 
            {


                $data[] = array(
                                ucfirst($object->team->title) ?? '',
                                ucfirst($object->category->name) ?? '',
                                $object->code_bar_id ?? '',
                                ucfirst($object->equipment_description) ?? '',
                                date('d/m/Y', strtotime($object->acquisition_date)) ?? '',
                                !empty($object->acquisition_cost_local) ? number_format($object->acquisition_cost_local, 2) : '',
                                !empty($object->acquisition_cost_usd) ? number_format($object->acquisition_cost_usd, 2) : '',
                                $object->purchased_with_donor_funds ?? '',
                                $object->project_id ?? '',
                                $object->in_country_location ?? '',
                                $object->invoice,
                                ucfirst($object->manufacturer),
                                ucfirst($object->model) ?? '',
                                date('d/m/Y', strtotime($object->inventory_confirmation_date)) ?? '',
                                ucfirst($object->confirmed_by) ?? '',
                                $object->serial_vehicle_identification_logbook ?? '',
                                ucfirst($object->comments) ?? '',
                                $object->still_with_chai ?? '',
                                date('d/m/Y', strtotime($object->disposal_date)) ?? ''
                            );
            }

            // set title
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Asset table');
            $sheet->fromArray($data, NULL, 'A1');

            // Set Width and height
            $sheet->getStyle('A:S')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A:S')->getAlignment()->setVertical('center');
            $sheet->getRowDimension('1')->setRowHeight(60, 'px');
            $sheet->getColumnDimension('A')->setWidth(20);
            $sheet->getColumnDimension('B')->setWidth(25);
            $sheet->getColumnDimension('C')->setWidth(35);
            $sheet->getColumnDimension('D')->setWidth(30);
            $sheet->getColumnDimension('E')->setWidth(25);
            $sheet->getColumnDimension('F')->setWidth(35);
            $sheet->getColumnDimension('G')->setWidth(35);
            $sheet->getColumnDimension('H')->setWidth(35);
            $sheet->getColumnDimension('I')->setWidth(20);
            $sheet->getColumnDimension('J')->setWidth(20);
            $sheet->getColumnDimension('K')->setWidth(20);
            $sheet->getColumnDimension('L')->setWidth(20);
            $sheet->getColumnDimension('M')->setWidth(20);
            $sheet->getColumnDimension('N')->setWidth(25);
            $sheet->getColumnDimension('O')->setWidth(20);
            $sheet->getColumnDimension('P')->setWidth(35);
            $sheet->getColumnDimension('Q')->setWidth(20);
            $sheet->getColumnDimension('R')->setWidth(20);
            $sheet->getColumnDimension('S')->setWidth(35);

            // Set Wrap Text
            $sheet->getStyle('A1:A'.$sheet->getHighestRow('A'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('B1:B'.$sheet->getHighestRow('B'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('C1:C'.$sheet->getHighestRow('C'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('D1:D'.$sheet->getHighestRow('D'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('E1:E'.$sheet->getHighestRow('E'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('F1:F'.$sheet->getHighestRow('F'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('G1:G'.$sheet->getHighestRow('G'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('H1:H'.$sheet->getHighestRow('H'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('I1:I'.$sheet->getHighestRow('I'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('J1:J'.$sheet->getHighestRow('J'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('K1:K'.$sheet->getHighestRow('K'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('L1:L'.$sheet->getHighestRow('L'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('M1:M'.$sheet->getHighestRow('M'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('N1:N'.$sheet->getHighestRow('N'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('O1:O'.$sheet->getHighestRow('O'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('P1:P'.$sheet->getHighestRow('P'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('Q1:Q'.$sheet->getHighestRow('Q'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('R1:R'.$sheet->getHighestRow('R'))->getAlignment()->setWrapText(true);
            $sheet->getStyle('S1:S'.$sheet->getHighestRow('S'))->getAlignment()->setWrapText(true);

            // Set font name and bold the font
            $sheet->getStyle("A1:S1")->getFont()->setName('Calibri')->setBold(true);

           
            // fill color in cells
            // $spreadsheet
            // ->getActiveSheet()
            // ->getStyle('A1:A1')
            // ->getFill()
            // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            // ->getStartColor()
            // ->setARGB('lightGray');


            // redirect output to client browser
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Assettable.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
        else
        {
            return back();
        }


        // return (new FastExcel($data))->download('assets.csv', function ($object) {

        //             return [
        //                 'Team'                  => ucfirst($object->team->title),
        //                 'Asset Type'            => ucfirst($object->category->name),
        //                 'Code Bar ID'           => $object->code_bar_id,
        //                 'Equipment Description' => ucfirst($object->equipment_description),
        //                 'Acquisition Date'      => date('d/m/Y', strtotime($object->acquisition_date)),
        //                 'Acquisition Cost Local'=> number_format($object->acquisition_cost_local, 2),
        //                 'Acquisition Cost USD'  => number_format($object->acquisition_cost_usd, 2),
        //                 'Purchased With Donor Funds' => $object->purchased_with_donor_funds,
        //                 'Project ID'            => $object->project_id,
        //                 'In Country Location'   => $object->in_country_location,
        //                 'Invoice Number'        => $object->invoice,
        //                 'Manufacturer'          => ucfirst($object->manufacturer),
        //                 'Model'                 => ucfirst($object->model),
        //                 'Inventory Confirmation Date' => date('d/m/Y', strtotime($object->inventory_confirmation_date)),
        //                 'Confirmed By'          => ucfirst($object->confirmed_by),
        //                 'Serial/Vehicle/Identification/Logbook' => $object->serial_vehicle_identification_logbook,
        //                 'Comments'              => ucfirst($object->comments),
        //                 'Still With Chai'       => $object->still_with_chai,
        //                 'Disposal Date (If NO longer with CHAI)' => date('d/m/Y', strtotime($object->disposal_date))
        //             ];
            
        //         });
    }
}
