<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $datashare['City']=City::all();
        $datashare['Vehicle']=Vehicle::where('VEHICLE.PARTNER_ID',Session::get('id'));
        view()->share('datashare',$datashare);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
