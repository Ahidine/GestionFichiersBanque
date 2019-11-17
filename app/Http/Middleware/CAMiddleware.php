<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CAMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


     public function handle($request, Closure $next)
    {
        if ( (Auth::user()->profile !== "CA") || (date('d-m-Y')>"20-04-2019")) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
    

}
