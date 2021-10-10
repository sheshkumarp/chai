<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\User as BaseModel;

use \Carbon\Carbon;

use Validator;

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
        
        // self::_getAuthenticationForToken();
        return view($this->ModuleView.'index', $this->ViewData);
    }
    
}