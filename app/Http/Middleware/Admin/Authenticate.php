<?php

namespace App\Http\Middleware\Admin;

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
            if (auth()->user()->roles->pluck('guard_name')->first() === 'admin') 
            {

                if (auth()->user()->status) 
                {
                    $allRoles = $this->RoleModel
                                ->where('guard_name', 'admin')
                                ->where('name', '!=', 'super-admin')
                                ->orderBy('name', 'ASC')
                                ->get();

                    view()->share('roles', $allRoles);
                    return $next($request);
                
                }
                else
                {
                    auth()->logout();
                    return redirect('/admin/login');
                }

            }
            else
            {
                auth()->logout();
                return redirect('/admin/login');
            }

        }
        else
        {
            return redirect('/admin/login');
        }
    }
}
