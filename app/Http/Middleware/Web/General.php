<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Support\Facades\Auth;

class General
{
    public function __construct()
    {
        auth()->setDefaultDriver('web');
    }
    
    public function handle($request, Closure $next, $guard = 'web')
    {
        return $next($request);
    }
}
