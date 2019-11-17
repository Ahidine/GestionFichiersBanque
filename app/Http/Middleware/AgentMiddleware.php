<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AgentMiddleware
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
        if ( Auth::user()->profile !== "Ag") {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
