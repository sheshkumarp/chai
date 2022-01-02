<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\User as BaseModel;

use \Carbon\Carbon;

use Validator;

use App\Models\AssetModel;

use App\Models\UserHasMovementHistoryModel;

// use AmrShawky\LaravelCurrency\Facade\Currency;
use AmrShawky\Currency;

use Auth;

use DB;



// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
        

class DashboardController extends Controller
{

    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;

    public function __construct()
    {
        $this->ViewData = [];
        $this->JsonData = [];
        $this->todosByDate= [];

        $this->ModuleTitle  = 'Dashboard';
        $this->ModuleView   = 'web.dashboard.';
        $this->ModulePath   = 'web.dashboard';
    }

    public function index()
    {

        $this->ViewData['moduleTitle']  = $this->ModuleTitle;
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['modulePath']   = $this->ModulePath;


        $this->ViewData['totalAsset']       = AssetModel::where('fk_user_id', auth()->user()->id)->count();
        $this->ViewData['totalCostLocal']   = AssetModel::where('fk_user_id', auth()->user()->id)->sum('acquisition_cost_local');
        $this->ViewData['totalCostUSD']     = AssetModel::where('fk_user_id', auth()->user()->id)->sum('acquisition_cost_usd');
        

       $currentDate      = date('Y-m-d');

        // check expired assets and delete
        AssetModel::where('fk_user_id', auth()->user()->id)
                    ->whereIn('fk_category_id',[2,3])
                    ->where(DB::raw('DATE_ADD(DATE(acquisition_date), INTERVAL 3 YEAR)'),'>',$currentDate)
                    ->whereDate('acquisition_date','>',$currentDate)->delete();


        AssetModel::where('fk_user_id', auth()->user()->id)
                    ->where(DB::raw('DATE_ADD(DATE(acquisition_date), INTERVAL 5 YEAR)'),'>',$currentDate)
                    ->whereIn('fk_category_id',[2,3])
                    ->whereDate('acquisition_date','>',$currentDate)->delete();


        $this->ViewData['soonExpire'] = null;


        $soonExpire1 = AssetModel::where('fk_user_id', auth()->user()->id)->with('category')
                                            ->where(DB::raw('DATE_SUB( DATE_ADD(DATE(acquisition_date), INTERVAL 3 YEAR), INTERVAL -3 MONTH )'),'>',$currentDate)
                                            ->whereIn('fk_category_id',[2,3])
                                            ->orderBy('id','ASC')
                                            ->first();

        if(!empty($soonExpire1))
        {

            $this->ViewData['soonExpire'] = $soonExpire1;
        }

        $soonExpire2 = AssetModel::where('fk_user_id', auth()->user()->id)->with('category')
                                            ->where(DB::raw('DATE_SUB( DATE_ADD(DATE(acquisition_date), INTERVAL 5 YEAR), INTERVAL -3 MONTH )'),'>',$currentDate)
                                            ->whereIn('fk_category_id',[4,5])
                                            ->orderBy('id','ASC')
                                            ->first();

        if(!empty($soonExpire2))
        {

            $this->ViewData['soonExpire'] = $soonExpire2;
        }

        // self::_getAuthenticationForToken();
        return view($this->ModuleView.'index', $this->ViewData);
    }


    public function convertmoney(Request $request)
    {
        // dd($request->all());

        $amount = $request->currency;


        $converted = Currency::convert()
                            ->from('CDF')
                            ->to('USD')
                            ->amount($amount)
                            ->round(2)
                            ->get();
        

        return response()->json(['output' => $converted]);
    }


    public function getMovementRecords(Request $request)
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

      
        $modelQuery = UserHasMovementHistoryModel::where('fk_user_id', auth()->user()->id)->with(['asset']);

      
        $countQuery = clone($modelQuery);   
        $totalData  = $countQuery->selectRaw('COUNT(DISTINCT(user_assets_has_movement.id)) as cnt')->first();
        $totalData = $totalData->cnt;

        
        $custom_search = false;
        $totalFiltered = $totalData;
        if (!empty($request->custom)) 
        {
            if (!empty($request->custom['asset_name'])) 
            {
                $key = $request->custom['asset_name'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->whereHas('asset', function($query) use($key)
                {
                    $query->where('equipment_description', 'LIKE', '%' . $key . '%');
                });
            }

            if (!empty($request->custom['moved_from'])) 
            {
                $key = $request->custom['moved_from'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->where('moved_from', 'LIKE', '%' . $key . '%');
            }

            if (!empty($request->custom['moved_to'])) 
            {
                $key = $request->custom['moved_to'];
                $custom_search = true;
                $modelQuery = $modelQuery
                ->where('moved_to', 'LIKE', '%' . $key . '%');
            }
            $filteredQuery = clone($modelQuery);            
            $totalFiltered = $filteredQuery->selectRaw('COUNT(DISTINCT(user_assets_has_movement.id)) as cnt')->first();
            $totalFiltered = $totalFiltered->cnt;         
        }

        $modelQuery = $modelQuery->orderBy($filter[$column], $dir);

        $object = $modelQuery
        ->skip($start)
        ->take($length)
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
                // $data[$key]['id'] = $row->id;

                $data[$key]['asset_name'] = '<span title="' . ucfirst($row->asset->equipment_description) . '">' . ucfirst($row->asset->equipment_description). '</span>';

                $data[$key]['moved_from'] = '<span title="' . ucfirst($row->moved_from) . '">' . ucfirst($row->moved_from). '</span>';
                
                $data[$key]['moved_to'] = '<span title="' . ucfirst($row->moved_to) . '">' . ucfirst($row->moved_to). '</span>';

                $data[$key]['date'] = '<span>' . date('d/m/Y H:i A',strtotime($row->created_at)). '</span>';
            }
        }

        $searchHTML['asset_name'] = '<input  name="asset_name" id="asset_name" value="' . ($request->custom['asset_name'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

        $searchHTML['moved_from'] = '<input  name="moved_from" id="moved_from" value="' . ($request->custom['moved_from'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';

        $searchHTML['moved_to'] = '<input  name="moved_to" id="moved_to" value="' . ($request->custom['moved_to'] ?? '') . '" type="text" class="form-control break-word" placeholder="Search...">';
      
        if ($custom_search) 
        {
            $searchHTML['date'] = '<a onclick="return removeSearch(this)" class="blue-btn-inverse">Remove Filter</a>';
        }
        else
        {
            $searchHTML['date'] = '<a style="cursor:pointer;" onclick="return doSearch(this)" class="blue-btn">Search</a>';
        }

        array_unshift($data, $searchHTML);

        
        $this->JsonData['draw'] = intval($request->draw);
        $this->JsonData['recordsTotal'] = intval($totalData);
        $this->JsonData['recordsFiltered'] = intval($totalFiltered);
        $this->JsonData['data'] = $data;

        return response()->json($this->JsonData);
    }
    
}