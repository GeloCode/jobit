<?php

namespace App\Http\Middleware;

use Closure;

class isSolicitante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check() && !Auth::user()->isEmpresa()) 
        {
            return $next($request);
        }
        return redirect('/login');
    }
}
