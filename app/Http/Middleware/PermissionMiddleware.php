<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null ): Response
    {

        if(!auth()->user()->hasPermissionTo($permission)){
            abort(404);
        }

        return $next($request);
    }
}
