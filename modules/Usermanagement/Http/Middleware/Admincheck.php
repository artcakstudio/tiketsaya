<?php namespace Modules\Usermanagement\Http\Middleware; 

use Closure;
use Session;

class admincheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('hak')=='admin')
    	return $next($request);
        else
            return view('errors.404');
    }
    
}
