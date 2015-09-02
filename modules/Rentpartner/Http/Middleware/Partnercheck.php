<?php namespace Modules\Rentpartner\Http\Middleware; 

use Closure;
use Session;
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
        if(Session::has('id') and Session::get('hak')=='partner_rent'){
        return $next($request);
        }
        else{
            return view('errors.404');
        }
    }
    
}
