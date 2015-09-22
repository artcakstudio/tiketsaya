<?php namespace Modules\Usermanagement\Http\Controllers;
use Pingpong\Modules\Routing\Controller;
use Modules\Usermanagement\Entities\User;
use Modules\Usermanagement\Entities\Role;
use Modules\Usermanagement\Entities\Penggunaxrole;
use Modules\Usermanagement\Entities\Submodule;
use Modules\Usermanagement\Entities\Module;
use Modules\Usermanagement\Entities\Hakakses;
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
         		//return '<li  class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="'.url('usermanagement/roles/'.$role->ROLES_ID.'/edit').'" class="btn  btn-primary">Edit</a></li><li><button onclick="hapusRole('.$role->ROLES_ID.')" class="btn btn-danger">Hapus</button></li></ul></li>';
                return '<a href="'.url('usermanagement/roles/'.$role->ROLES_ID.'/edit').'"><button class="btn  btn-xs btn-primary"><i class="fa fa-pencil"></i> </button></a><button class="btn  btn-xs btn-danger" id="'.$role->ROLES_ID.'" data-target="#hapusUser" onclick="hapusRole('.$role->ROLES_ID.')"><i class="fa fa-times"></i> </button>';
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
        $hak=Role::hapusHakAkses($data);
        $hak->delete();
        
    }
    public function tambahHakAkses()
    {
        $data=Input::all();
        print_r($data);
        unset($data['_token']);
        Hakakses::insert($data);
        return Redirect::back();    
    }
    public function tambahRoles()
    {
        $data=Input::all();
        print_r($data);
        unset($data['_token']);
        $data['ROLES_CREATEBY']=Session::get('id');
        Role::insert($data);
        return Redirect::back();    
    }
    function delete(){
        $data=Input::all();
        $role=Role::where('ROLES_ID','=',$data['ROLES_ID']);
        print_r($data);
        $role->delete();
        return  Redirect::back();
    }
}