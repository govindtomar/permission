<?php

namespace GovindTomar\Permission\Http\Middleware;

use Closure;
use Route;
use GovindTomar\Permission\Models\RolePermission;

class PermissionMiddleware
{

    public function handle($request, Closure $next)
    {
        $permission = RolePermission::Where('route', Route::currentRouteName())->first();
        $status = $permission ? $permission->status : 0 ;
        
        if ($status == 1) {
            return $next($request);
        }else{
            return redirect('/');            
        }        
    }

}
