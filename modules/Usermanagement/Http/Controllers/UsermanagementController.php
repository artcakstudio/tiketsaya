<?php namespace Modules\Usermanagement\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\usermanagement\entities\User;
use Modules\usermanagement\entities\Role;
use Modules\usermanagement\entities\Penggunaxrole;
use Datatables;
use Input;
use Session;
use Redirect;
use View;
class UsermanagementController extends Controller {
	
	public function index()
	{
		return view('usermanagement::index');
	}
	public function getUser()
    {
    	$users = User::select(['USERS_ID','USERS_NAME', 'USERS_EMAIL']);
        return Datatables::of($users)
         ->addColumn('action', function ($user) {
              //  return '<a href="#edit-'.$user->USERS_ID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#hapus-'.$user->USERS_ID.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Hapus</a>';
         		return '<li class="dropdown-no-type dropdown"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary " href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><a href="usermanagement/edit/'.$user->USERS_ID.'" class="btn  btn-primary">Edit</a></li><li><button class="btn btn-danger" id="'.$user->USERS_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
            ->make(true);
    }
    public function store()
    {
    	$data=Input::all();
    	unset($data['_token']);
    	$data['USERS_CREATEBY']=session::get('id');
    	User::insert($data);
    	return redirect::to('/usermanagement');
    }
    public function create()
    {
    	return View::make("usermanagement::adduser");
    }
    public function hapus(){
        $id=Input::get('USERS_ID');
    	$user=User::where('USERS_ID','=',$id);
    	$user->delete();
        
    	return back();
    }
  public  function edit($id)
    {
        $user=User::where('USERS_ID','=',$id)->first();
        $role=Role::penggunaxroles($id)->get();
        $userrole=Role::userRole($id)->get();
        
        return View::make('usermanagement::edituser',compact('user','role','userrole'));
    }
    function update()
    {
        $data=Input::all();
        unset($data['_token']);
        if (is_null($data['USERS_PASSWORD']))unset($data['USERS_PASSWORD']);
        $data['USERS_UPDATEBY']=session::get('id');
        $data['USERS_UPDATE']=date("Y-m-d H:i:s");
        $user=User::getUser($data['USERS_ID']);
        
        $user->update($data);
        return redirect::to('usermanagement');
    }
    /*AJAX Controller */
    public function hapusRoleUser()
    {
        $data=Input::all();
        print_r($data);
        $roles=penggunaxrole::hapusRoleUser($data['USERS_ID'],$data['ROLES_ID']);
        $data['pesan']='Roles berhasil di Hapus';
        $roles->delete();
        echo json_encode($data);
    }
    function tambahRole()
    {
        $data=Input::all();
        unset($data['_token']);
        penggunaxrole::insert($data);
        $data['pesan']='Data Berhasil Ditambahkan';
        echo json_encode($data);
    }
    /*AJAX Controller */
}