<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Vehicle\Entities\City;
use Modules\Travel\Entities\LinkTravel;
class pageCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $link_travel=LinkTravel::all();
        $city=City::all();
        return view('page.index',compact('city','link_travel'));
    }
}
