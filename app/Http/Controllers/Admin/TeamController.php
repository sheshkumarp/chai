<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamModel as BaseModel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Storage;
use Image;

class TeamController extends Controller
{
    private $BaseModel;   
    private $ViewData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;
    private $JsonData;
    
    public function __construct(BaseModel $BaseModel)
    {

        $this->BaseModel     = $BaseModel;            
        $this->ViewData     = [];
        $this->ResultData   = [];
        
        $this->ModuleTitle = 'Teams';
        $this->ModuleView  = 'admin.teams';
        $this->ModulePath = 'admin.teams.';

        $this->middleware(['permission:manage-teams'], ['only' => ['edit','update','destroy','create','store']]);
    }

    public function index()
    {
        $this->ViewData['moduleTitle']  = 'Manage '.$this->ModuleTitle;
        $this->ViewData['moduleAction'] = 'Manage '.$this->ModuleTitle;
        $this->ViewData['modulePath']   = $this->ModulePath;


        return view($this->ModuleView.".index" , $this->ViewData);
    }
  
    public function store(Request $request)
    {
     

        $collection = new $this->BaseModel;
        $collection = self::_storeOrUpdate($collection,$request);
       
        if($collection){
            $this->JsonData['status'] = __('success');
            $this->JsonData['msg'] = __(trim($request->name) .' '.$this->ModuleTitle.' has been added');
        }else{
            $this->JsonData['status'] = __('error');
            $this->JsonData['msg'] = __('something went wrong');  
        }
         return response()->json($this->JsonData);
    }

    public function update(Request $request,$endID)
    {

        $id = base64_decode(base64_decode($endID));
        $collection = $this->BaseModel->find($id);
        $collection = self::_storeOrUpdate($collection,$request);
       
        if($collection){
            $this->JsonData['status'] = __('success');
            $this->JsonData['msg'] = __(trim($request->name) .' '.$this->ModuleTitle.' has been added');
        }else{
            $this->JsonData['status'] = __('error');
            $this->JsonData['msg'] = __('something went wrong');  
        }
        
        return response()->json($this->JsonData);  
    }
  

    public function destroy($endID)
    {
        DB::beginTransaction();
        
        $id = base64_decode(base64_decode($endID));

        $this->JsonData['status'] = __('admin.RESP_ERROR');
        $this->JsonData['msg'] = 'Failed to delete '.$this->ModuleTitle;
        
        $collection = $this->BaseModel->find($id)->delete();
        if ($collection) 
        {
            DB::commit();

            $this->JsonData['status'] = __('admin.RESP_SUCCESS');
            $this->JsonData['msg'] = $this->ModuleTitle.' deleted successfully';            
        }
        else
        {
             DB::rollback();
        }
        
        return response()->json($this->JsonData);
    }

    public function getRecords(Request $request)
    {

        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value']; 
        $column = $request->order[0]['column'];
        $dir = $request->order[0]['dir'];

        $filter = array(
            0 => 'id',
            1 => 'title',
            2 => 'created_at'
        );

        $modelQuery =  $this->BaseModel;
           
        $countQuery = clone($modelQuery);            
        $totalData  = $countQuery->count();

        if (!empty($search) || $search == '0') 
        {

            $modelQuery = $modelQuery->where(function ($query) use($search)
            {
                $query->orwhere('title', 'LIKE', '%'.$search.'%');   
            });
        }

        $filteredQuery = clone($modelQuery);            
        $totalFiltered  = $filteredQuery->count();

        $object = $modelQuery->orderBy($filter[$column], $dir)
        ->skip($start)
        ->take($length)
        ->get();            

        $data = [];
        if (!empty($object) && sizeof($object) > 0) 
        {

            foreach ($object as $key => $row) 
            {
                $data[$key]['id']           = $key+1;
                $data[$key]['title']        = '<span title="'.ucfirst($row->title).'">'.ucfirst($row->title).'</span>';
                $data[$key]['created_at']   = Date('Y-m-d', strtotime($row->created_at));
                
                $edit  = '<a  href="javascript:void(0)" onclick="return updateCollection(this)" data-href="'.route('admin.teams.update', [base64_encode(base64_encode($row->id))]) .'" data-title="'.$row->title.'" ><img src="'.url('/assets/admin/images').'/icons/edit.svg" alt=" edit"></a>';
               
                $delete = '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="'.route('admin.teams.destroy', [base64_encode(base64_encode($row->id))]) .'" ><img src="'.url('/assets/admin/images').'/icons/delete.svg" alt=" delete"></a>';

                $data[$key]['actions'] = '<div class="text-center">'.$edit.$delete.'</div>';
            }
        }

        $this->JsonData['draw']             = intval($request->draw);
        $this->JsonData['recordsTotal']     = intval($totalData);
        $this->JsonData['recordsFiltered']  = intval($totalFiltered);
        $this->JsonData['data']             = $data;

        return response()->json($this->JsonData);
    }    

    public function _storeOrUpdate($collection, $request)
    {
        $collection->title = $request->title;
        $collection->save();
        
        return $collection;
    }

}
