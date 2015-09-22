<?php namespace Modules\Usermanagement\Http\Middleware; 

use Closure;

class admin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if(Session::has('id') and Session::get('hak')=='partner'){
        return $next($request);
        }
        else{
            return view('errors.404');
        }
    }
    
}
