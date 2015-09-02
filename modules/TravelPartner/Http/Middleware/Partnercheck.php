<?php namespace Modules\Travelpartner\Http\Middleware; 

use Closure;
use Session;
use Redirect;
use View;
class partnercheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('id') and Session::get('hak')=='partner_travel'){
    	return $next($request);
        }
        else{
            return view('errors.404');
        }
    }
    
}
