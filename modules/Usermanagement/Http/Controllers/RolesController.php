<?php namespace Modules\Usermanagement\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\usermanagement\entities\User;
use Modules\usermanagement\entities\Role;
use Modules\usermanagement\entities\Penggunaxrole;
use Modules\usermanagement\entities\Submodule;
use Modules\usermanagement\entities\Module;
use Modules\usermanagement\entities\Hakakses;
use Datatables;
use Input;
use Session;
use Redirect;
use View;

class RolesController extends Controller {
	
	public function index()
	{
		return view('usermanagement::roles.listRoles');
	}
	public function getRoles()
    {
    	$roles = Role::select(['ROLES_NAME','ROLES_ID']);
        return Datatables::of($roles)
         ->addColumn('action', function ($role) {
              //  return '<a href="#edit-'.$user->USERS_ID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#hapus-'.$user->USERS_ID.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Hapus</a>';
         		return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="'.url('usermanagement/roles/'.$role->ROLES_ID.'/edit').'" class="btn  btn-primary">Edit</a></li><li><button onclick="hapusRole('.$role->ROLES_ID.')" class="btn btn-danger">Hapus</button></li></ul></li>';
            })
            ->make(true);
    }
    public function edit ($id){
        //$modul=Submodule::getModuleNotIn($id)->get();
        $modul=Submodule::getModule($id)->get();
        $allmodul=Module::getAllModule();

        return view::make('usermanagement::roles.editRoles', compact('modul','allmodul','id'));
    }
    public function hapusHakAkses()
    {
        $data=Input::all();
        $hak=Hakakses::hapusHakAkses($data);
        $hak->delete();
        unset($data);
    }
    public function tambahHakAkses()
    {
        $data=Input::all();
        print_r($data);
        unset($data['_token']);
        Hakakses::insert($data);
    }
}