<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{    
    public function handle($request, Closure $next, $guard = 'web')
    {

        if(auth()->check())
        {            
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
