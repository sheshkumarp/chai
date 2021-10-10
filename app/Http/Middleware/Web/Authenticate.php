<?php

namespace App\Http\Middleware\Web;

use Closure;

use Session;

// Models
use Spatie\Permission\Models\Role;

class Authenticate
{
    public function __construct(Role $RoleModel)
    {
        $this->RoleModel  = $RoleModel;
    }

    public function handle($request, Closure $next)
    {
        if(auth()->check())
        {   
            if (auth()->user()->has('roles', '<', 1)) 
            {
                return $next($request);  
            }
            else
            {
                auth()->logout();
                return redirect('/login');
            }

        }
        else
        {
            return redirect('/login');
        }
    }
}
