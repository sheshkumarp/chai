<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Web\AssetRequest;

use App\Models\AssetModel;
use App\Models\AssetHasImagesModel;
use App\Models\TeamModel;
use App\Models\CategoryModel;
use App\Models\AssetTypesModel;
use App\Models\UserHasMovementHistoryModel;
use App\User as UserModel;

use Illuminate\Support\Str;
use Mail;
use Auth;
use DB;
use Hash;
use Storage;
use Image;
use DNS1D;


class AssetController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;

    public function __construct(
        
        AssetModel $AssetModel,
        UserModel $UserModel,
        TeamModel $TeamModel,
        CategoryModel $CategoryModel,
        AssetTypesModel $AssetTypesModel,
        AssetHasImagesModel $AssetHasImagesModel,
        UserHasMovementHistoryModel $UserHasMovementHistoryModel

    ) {

        $this->BaseModel     = $AssetModel;
        $this->UserModel     = $UserModel;
        $this->TeamModel     = $TeamModel;
        $this->CategoryModel = $CategoryModel;
        $this->AssetTypesModel = $AssetTypesModel;
        $this->AssetHasImagesModel = $AssetHasImagesModel;
        $this->UserHasMovementHistoryModel = $UserHasMovementHistoryModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleTitle = 'Asset';
        $this->ModuleView = 'web.asset.';
        $this->ModulePath = 'web.asset.';
    }

    public function index()
    {
        // Default site settings
        $this->ViewData['moduleTitle'] = 'Manage ' . $this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Manage ' . $this->ModuleTitle;
        $this->ViewData['modulePath'] = $this->ModulePath;

        // view file with data
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    public function create()
    {
        // Default site settings
        $this->ViewData['moduleTitle'] = 'Manage ' . $this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Create ' . $this->ModuleTitle;
        $this->ViewData['modulePath'] = $this->ModulePath;

        // All 
        $this->ViewData['teams']        = $this->TeamModel->get();
        $this->ViewData['categories']   = $this->CategoryModel->get();
        $this->ViewData['assetTypes']       = $this->AssetTypesModel->get();

        // path 
        $this->ViewData['moduleUploadFiles']    = $this->ModulePath.'uploadfiles';
        $this->ViewData['moduleRemoveFiles']    = $this->ModulePath.'removefiles';
        $this->ViewData['moduleMediaFiles']     = $this->ModulePath.'mediafiles';

        return view($this->ModuleView . 'create', $this->ViewData);
    }

    public function store(AssetRequest $request)
    {
        DB::beginTransaction();

        $this->JsonData['status'] = __('admin.RESP_ERROR');
        $this->JsonData['msg'] = 'Failed to create '.$this->ModuleTitle.', Something went wrong on server.';

        $collection = new $this->BaseModel;

        try 
        {  

            $collection = self::_storeOrUpdate($collection, $request);

            if ($collection) 
            {
                DB::commit();

                $this->JsonData['status'] = __('admin.RESP_SUCCESS');
                $this->JsonData['url'] = route($this->ModulePath . 'index');
                $this->JsonData['msg'] = 'Asset Created Successfully';
                $this->JsonData['asset_id'] = $collection->id;
            } 
            else 
            {
                DB::rollback();
            }

        } catch (\Exception $e) 
        {
            $this->JsonData['exception'] = $e->getMessage();

            DB::rollback();
        }

        return response()->json($this->JsonData);
    }

    public function show($encID)
    {
    
        $id = base64_decode(base64_decode($encID));

        // Default site settings
        $this->ViewData['moduleTitle'] = 'Manage ' . $this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'View ' . $this->ModuleTitle;
        $this->ViewData['modulePath'] = $this->ModulePath;
        
        // All 
        $this->ViewData['teams']        = $this->TeamModel->get();
        $this->ViewData['categories']   = $this->CategoryModel->get();
        $this->ViewData['assetTypes']   = $this->AssetTypesModel->get();
        $this->ViewData['object']       = $this->BaseModel->find($id);

        // path 
        $this->ViewData['moduleUploadFiles']    = $this->ModulePath.'uploadfiles';
        $this->ViewData['moduleRemoveFiles']    = $this->ModulePath.'removefiles';
        $this->ViewData['moduleMediaFiles']     = $this->ModulePath.'mediafiles';  

        // view file with data
        return view($this->ModuleView . 'view', $this->ViewData);
    }

    public function edit($encID)
    {
        $id = base64_decode(base64_decode($encID));

        // Default site settings
        $this->ViewData['moduleTitle'] = 'Manage ' . $this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Update ' . $this->ModuleTitle;
        $this->ViewData['modulePath'] = $this->ModulePath;
        
        // All 
        $this->ViewData['teams']        = $this->TeamModel->get();
        $this->ViewData['categories']   = $this->CategoryModel->get();
        $this->ViewData['assetTypes']   = $this->AssetTypesModel->get();
        $this->ViewData['object']       = $this->BaseModel->find($id);

        // path 
        $this->ViewData['moduleUploadFiles']    = $this->ModulePath.'uploadfiles';
        $this->ViewData['moduleRemoveFiles']    = $this->ModulePath.'removefiles';
        $this->ViewData['moduleMediaFiles']     = $this->ModulePath.'mediafiles';

        return view($this->ModuleView . 'edit', $this->ViewData);
    }

    public function update(AssetRequest $request, $endID)
    {
        DB::beginTransaction();

        $this->JsonData['status'] = __('admin.RESP_ERROR');
        $this->JsonData['msg'] = 'Failed to update '.$this->ModuleTitle.', , Something went wrong on server.';

        $id = base64_decode(base64_decode($endID));

        $collection = $this->BaseModel->find($id);

        // check movement history
        if ($collection->asset_location != $request->asset_location) {
            
            $UserHasMovementHistoryModel = new $this->UserHasMovementHistoryModel;
            $UserHasMovementHistoryModel->fk_user_id    = auth()->user()->id;
            $UserHasMovementHistoryModel->fk_asset_id   = $id;
            $UserHasMovementHistoryModel->moved_from    = $collection->asset_location ?? 'NA';
            $UserHasMovementHistoryModel->moved_to      = $request->asset_location ?? 'NA';
            $UserHasMovementHistoryModel->save();
        }

        try 
        {
            $collection = self::_storeOrUpdate($collection, $request);

            if ($collection) 
            {
                $this->JsonData['status'] = __('admin.RESP_SUCCESS');
                $this->JsonData['url'] = route($this->ModulePath . 'index');
                $this->JsonData['msg'] = 'Asset updated successfully';
                $this->JsonData['asset_id'] = $collection->id;

                DB::commit();
            } 
            else
            {
                DB::rollback();
            }

        } 
        catch (\Exception $e)
        {
            $this->JsonData['exception'] = $e->getMessage();
            DB::rollback();
        }
        return response()->json($this->JsonData);
    }

    public function destroy($encID)
    {
        $this->JsonData['status'] = 'error';
        $this->JsonData['msg'] = 'Failed to delete '.$this->ModuleTitle.', Something went wrong on server.';

        $id = base64_decode(base64_decode($encID));

        if ((int) $id === (int) auth()->user()->id) 
        {
            $this->JsonData['status']  = __('admin.RESP_ERROR');     
            $this->JsonData['msg'] = __('admin.ERR_CUSTOMER_DELETED');
            return response()->json($this->JsonData);
            exit;
        }

        $BaseModel = $this->BaseModel->find($id);
        $BaseModel->syncRoles([]);

        if ($BaseModel->delete()) 
        {         
            $this->JsonData['status']   = __('admin.RESP_SUCCESS');                  
            $this->JsonData['msg']      = __('admin.CUSTOMER_DELETED');
        }
        return response()->json($this->JsonData);
    }

    public function getRecords(Request $request)
    {
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
            1 => 'fk_team_id',
            2 => 'id',
            3 => 'equipment_description',
            4 => 'invoice',
            5 => 'id'
        );

      
        $modelQuery = $this->BaseModel->where('fk_user_id', auth()->user()->id)->with(['category','team']);

      
        $countQuery = clone($modelQuery);   
        $totalData  = $countQuery->selectRaw('COUNT(DISTINCT(user_has_assets.id)) as cnt')->first();
        $totalData = $totalData->cnt;

        
        $custom_search = false;
        $totalFiltered = $totalData;
        if (!empty($request->custom)) 
        {
            if (!empty($request->custom['id'])) 
            {
                $key = $request->custom['id'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->where('code_bar_id', 'LIKE', '%' . $key . '%');
            }

            if (!empty($request->custom['team'])) 
            {
                $key = $request->custom['team'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->whereHas('team', function($query) use($key)
                {
                    $query->where('title', 'LIKE', '%' . $key . '%');
                });
            }

            if (isset($request->custom['asset_type'])) 
            {
                $key = $request->custom['asset_type'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->whereHas('category', function($query) use($key)
                {
                    $query->where('name', 'LIKE', '%' . $key . '%');
                });
            }

            // if (isset($request->custom['invoice'])) 
            // {
            //     $key = $request->custom['invoice'];
            //     $custom_search = true;
            //     $modelQuery = $modelQuery
            //     ->where('invoice', 'LIKE', '%' . $key . '%');
            // }

            if (isset($request->custom['equipment_description'])) 
            {
                $key = $request->custom['equipment_description'];
                $custom_search = true;
                $modelQuery = $modelQuery                   
                ->where('equipment_description', 'LIKE', '%' . $key . '%');
            }

            $filteredQuery = clone($modelQuery);            
            $totalFiltered = $filteredQuery->selectRaw('COUNT(DISTINCT(user_has_assets.id)) as cnt')->first();
            $totalFiltered = $totalFiltered->cnt;         
        }

        $modelQuery = $modelQuery->orderBy($filter[$column], $dir);

        $object = $modelQuery
        ->skip($start)
        ->take($length)
        //->groupBy('user_has_assets.id')
        ->get();



        /*--------------------------------------
        |  data binding
        ------------------------------*/
        $data = [];

        if (!empty($object) && sizeof($object) > 0) 
        {
            $i = 1;
            foreach ($object as $key => $row) 
            {
                $data[$key]['id'] = '<div onclick="printDiv(this)" >
                                        <img id="logoprint" style="width:150px;height:150px;display:none" src="' . url(asset('assets/admin/images/CHAI-Logo.png')) . '" alt="barcode" />&nbsp;&nbsp;&nbsp;

                                        <img style="margin-bottom:25px" src="data:image/png;base64,' . DNS1D::getBarcodePNG((string)$row->code_bar_id, 'C39',1,100) . '" alt="barcode" />

                                    </div>
                                    ';

                // $data[$key]['id'] = '
                //     <table onclick="printDiv(this)" cellspacing="0" cellpadding="0" style="border: none;"  >
                //         <tr style="border: none;" >
                //             <td style="border: none;">
                //                 <img id="logoprint" style="width:150px;height:150px;display:none" src="' . url(asset('assets/admin/images/CHAI-Logo.png')) . '" alt="barcode" />
                //             </td style="border: none;" >
                //             <td>
                //                 <img style="margin-bottom:25px" src="data:image/png;base64,' . DNS1D::getBarcodePNG($row->id, 'C39',5,100) . '" alt="barcode" />
                //                 <small style="text-align:left">CHAI-KIN-RDC-FURNITURE-001<small>
                //             </td>
                //         </tr>
                //     </table>
                // ';

                $data[$key]['team'] = '<span title="' . ucfirst($row->team->title) . '">' . ucfirst($row->team->title). '</span>';

                $data[$key]['asset_type'] = '<span title="' . ucfirst($row->category->name) . '">' . ucfirst($row->category->name). '</span>';
                
                $data[$key]['equipment_description'] = '<span title="' . ucfirst($row->equipment_description) . '">' . ucfirst($row->equipment_description). '</span>';

                // $data[$key]['invoice'] = '<span title="' . ucfirst($row->invoice) . '">' . ucfirst($row->invoice). '</span>';


                $show = '<a href="' . route('web.asset.show', [base64_encode(base64_encode($row->id))]) . '"><img src="' . url('/assets/admin/images') . '/icons/eye.svg" alt=" edit"></a>';

                $edit = '<a href="' . route('web.asset.edit', [base64_encode(base64_encode($row->id))]) . '"><img src="' . url('/assets/admin/images') . '/icons/edit.svg" alt=" edit"></a>';

                $data[$key]['actions'] = '<div class="text-center">' . $show . $edit. '</div>';
            }
        }

        $searchHTML['id'] = '<input  name="id" id="id" value="' . ($request->custom['id'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';
        // $searchHTML['id'] = '';

        $searchHTML['team'] = '<input  name="team" id="team" value="' . ($request->custom['team'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

        $searchHTML['asset_type'] = '<input  name="asset_type" id="asset_type" value="' . ($request->custom['asset_type'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

        $searchHTML['equipment_description'] = '<input  name="equipment_description" id="equipment_description" value="' . ($request->custom['equipment_description'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

        // $searchHTML['invoice'] = '<input  name="invoice" id="invoice" value="' . ($request->custom['invoice'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

      
        if ($custom_search) 
        {
            $searchHTML['actions'] = '<a onclick="return removeSearch(this)" class="blue-btn-inverse">Remove Filter</a>';
        }
        else
        {
            $searchHTML['actions'] = '<a style="cursor:pointer;" onclick="return doSearch(this)" class="blue-btn">Search</a>';
        }

        array_unshift($data, $searchHTML);

        
        $this->JsonData['draw'] = intval($request->draw);
        $this->JsonData['recordsTotal'] = intval($totalData);
        $this->JsonData['recordsFiltered'] = intval($totalFiltered);
        $this->JsonData['data'] = $data;

        return response()->json($this->JsonData);
    }

    public function _storeOrUpdate($collection, $request)
    {

        $collection->fk_user_id             = auth()->user()->id;
        $collection->fk_team_id             = $request->fk_team_id;
        $collection->fa_type                = $request->fa_type ?? '';
        $collection->fk_category_id         = $request->fk_category_id ?? '';
        
        $collection->equipment_description  = $request->equipment_description ?? '';
        $collection->acquisition_cost_local = $request->acquisition_cost_local ?? '';
        $collection->acquisition_cost_usd   = $request->acquisition_cost_usd ?? '';
        $collection->purchased_with_donor_funds = $request->purchased_with_donor_funds ?? '';
        $collection->project_id             = $request->project_id ?? '';
        $collection->in_country_location    = $request->in_country_location ?? '';
        $collection->invoice                = $request->invoice ?? '';
        $collection->manufacturer           = $request->manufacturer ?? '';
        $collection->confirmed_by           = $request->confirmed_by ?? '';
        $collection->model                  = $request->model ?? '';
        $collection->serial_vehicle_identification_logbook = $request->serial_vehicle_identification_logbook ?? '';
        $collection->comments               = $request->comments ?? '';
        $collection->still_with_chai        = $request->still_with_chai ?? '';
        $collection->asset_location        = $request->asset_location ?? '';

        if(!empty($request->inventory_confirmation_date))
        {
            $inventory_confirmation_date = date_create_from_format('m/d/Y',$request->inventory_confirmation_date);
            $inventory_confirmation_date = date_format($inventory_confirmation_date,"Y-m-d");
            $collection->inventory_confirmation_date   = Date('Y-m-d', strtotime($inventory_confirmation_date));
        } 

        if(!empty($request->acquisition_date))
        {
            $acquisition_date = date_create_from_format('m/d/Y',$request->acquisition_date);
            $acquisition_date = date_format($acquisition_date,"Y-m-d");
            $collection->acquisition_date   = Date('Y-m-d', strtotime($acquisition_date));
        } 

        if(!empty($request->disposal_date))
        {
            $disposal_date = date_create_from_format('m/d/Y',$request->disposal_date);
            $disposal_date = date_format($disposal_date,"Y-m-d");
            $collection->disposal_date   = Date('Y-m-d', strtotime($disposal_date));            
        }
        
        $collection->status = 'active';

        $collection->save();

        // get Category 
        $category = AssetTypesModel::where('id',$collection->fk_category_id)->first();
        
        $barcodeId = 'CHAI-KIN-RDC-'.strtoupper(\Str::slug($category->name)).'-0'.$collection->id;

        $collection->code_bar_id  = $barcodeId ?? '';

        $collection->save();


        /*document upload*/
        if ($request->has('invoice_document')) 
        {
            $object = $request->invoice_document;
            $name   = time().'-'.self::clean_string(strtolower($object->getClientOriginalName()));
            $path   = 'asset/invoice/'.$collection->id;
        
            $collection->invoice_document = Storage::disk('public')->putFileAs($path, $object, $name);
        }

        $collection->slug = Str::slug($collection->id.' '.$collection->equipment_description, '-');

        $collection->save();

        return $collection;
    }
   

    // Sub Function 
    public function uploadFiles(Request $request) 
    {
        try{

            if($request->file('file'))
            {
                $productId = $request->asset_id;

                $records = $request->file('file');

                foreach( $records as $record )
                {
    
                    $AssetHasImagesModel   = new $this->AssetHasImagesModel;

                    $object = $record;
                    $name   = time().'-'.self::clean_string(strtolower($object->getClientOriginalName()));
                    $path   = 'asset/image/'.$productId;
                  
                    $AssetHasImagesModel->fk_user_id   = auth()->user()->id;
                    $AssetHasImagesModel->fk_asset_id  = $productId;
                    $AssetHasImagesModel->image = Storage::disk('public')->putFileAs($path, $object, $name);

                    $thumbobject = Image::make($object)->resize(460,460)->orientate()->encode('jpg');
                    $thumbpath   = $path.'/thumb';
                    
                    if( Storage::disk('public')->put($thumbpath.'/'.$name, $thumbobject->getEncoded() ) ){
                        $AssetHasImagesModel->thumb = $thumbpath.'/'.$name;
                    }
        
                    $AssetHasImagesModel->save();
                }

                $this->JsonData['status'] = 'success';
                $this->JsonData['url'] = route($this->ModulePath.'index');
                $this->JsonData['msg'] = $this->ModuleTitle.' '. __('web/general.ADDED_SUCCESSFULLY');
            }
        } 
        catch(Exception $e) 
        {
            $this->JsonData['msg'] = $e->getMessage();
        }
    }

    public function removeFiles(Request $request)
    {
        $id = base64_decode(base64_decode($request->encID));

        $object = $this->AssetHasImagesModel->find($id);
        
        if (!empty($object->image)) 
        {                
            if(is_file(Storage::disk('public')->url($object->image)))
            {
                unlink(Storage::disk('public')->url($object->image));
            }
        }
        
        // delete Thumb file
        if (!empty($object->thumb)) 
        {                
            if(is_file(Storage::disk('public')->url($object->thumb)))
            {
                unlink(Storage::disk('public')->url($object->thumb));
            }
        }

        $this->AssetHasImagesModel->where('id', $object->id)->delete();
        
        return true;
    }

    public function mediaFiles(Request $request) 
    {
        $id = $request->asset_id;

        $output = '';

        if($id) 
        {
            $medias = $this->AssetHasImagesModel->where('fk_asset_id', $id)->get();

            $output = '<div class="row">';

            foreach($medias as $img)
            {
                $output .= '
                    <div class="col-md-2" style="margin-bottom:16px;" align="center"> 
                    <a href="'.Storage::disk('public')->url($img->image).'" >
                        <img src="'.Storage::disk('public')->url($img->thumb).'" class="img-thumbnail" width="200" height="200" />
                    </a>
                    <button type="button" class="btn btn-link remove_image" id="'.base64_encode(base64_encode($img->id)).'">Remove</button></div>';
            }

            $output .= '</div>';
        }

        $this->JsonData['output'] = $output;

        return response()->json($this->JsonData);

    }


    public function clean_string($string) 
    {
        $string = str_replace(' ', '-', $string); 
        $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string); 

        return preg_replace('/-+/', '-', $string); 
    }

}
