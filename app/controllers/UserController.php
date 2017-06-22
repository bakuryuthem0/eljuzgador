<?php

class UserController extends BaseController {
	public function getNewUser()
	{
		$roles = Role::get();
		$title = "Crear nuevo usuario | El Juzgador";
		return View::make('admin.user.new')
		->with('title',$title)
		->with('roles',$roles);
	}
	public function postNewUser()
	{
		$data  = Input::all();
		$rules = array(
			'username' 				=> 'required|min:5|unique:users,username',
			'password'  			=> 'required|min:6|max:16|confirmed',
			'password_confirmation' => 'required',
			'role'					=> 'required|exists:roles,id'
		);
		$msg = array();
		$attr = array(
			'password' 				=> 'contraseña',
			'password_confirmation' => 'confirmación de la contraseña',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$user = new User;
		$user->username = $data['username'];
		$user->password = Hash::make($data['password']);
		$user->role_id  = $data['role'];
		if ($user->save()) {
			Session::flash('success','Se ha creado el usuario satisfactoriamente.');
			return Redirect::back();
		}
 	}
 	public function getUsers()
 	{
 		$title = "Ver Usuarios | El Juzgador";
 		$users = User::with('roles')
 		->where('id','!=',Auth::id())
 		->orderBy('id','DESC')
 		->get();
 		return View::make('admin.user.show')
 		->with('title',$title)
 		->with('users',$users);
 	}
 	public function poastChangePass()
 	{
 		$data = Input::all();
 		$rules = array(
 			'user_id'  => 'required|exists:users,id',
 			'password' => 'required|min:8|max:16|confirmed',
			'password_confirmation' => 'required',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg' => $validator->getMessageBag()->toArray()
 			));
 		}
 		$id = Input::get('user_id');
 		$user = User::find($id);
 		$user->password = Hash::make($data['password']);
 		$user->save();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'Se ha cambiado la contraseña satisfactoriamente.'
 		));
 	}
 	public function postUserElim()
 	{
 		$data = Input::all();
 		$rules = array(
 			'id'  => 'required|exists:users,id',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg' => $validator->getMessageBag()->toArray()
 			));
 		}
 		$id = $data['id'];
 		$user = User::find($id);
 		if (count($user) < 1) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg'  => 'Error, el usuario ya fue borrado.',
 			));
 		}
 		if ($user->avatar != "avatar5.png") {
 			File::delete('images/avatars/'.$user->avatar);
 		}
 		$user->delete();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'El usuario se ha eliminado satisfactoriamente.'
 		));
 	}
	public function getProfile()
	{
		$title = "Perfil de usuario | nombredelapagina";
		return View::make('admin.user.profile')
		->with('title',$title);
	}
	public function postAdminProfile()
	{
		Session::flash('act','perfil');
		$data  = Input::all();
		$rules = array(
			'name'  	=> 'required',
			'lastname'  => 'required',
		);
		$msg = array();
		$cus = array(
			'name' 		=> 'nombre',
			'lastname'	=> 'apellido'
		);
		$validator = Validator::make($data, $rules, $msg, $cus);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$name  		= Input::get('name');
		$lastname 	= Input::get('lastname');
		$user  		= User::find(Auth::id());
		if ($name != Auth::user()->name) {
		 	$user->name = $name;
	 	} 
	 	if ($lastname != Auth::user()->lastname) {
		 	$user->lastname = $lastname;
	 	}
	 	if (Input::hasFile('avatar')) {
	 		$img = Input::file('avatar');
	 		$user->avatar = $this->upload_image($img,'images/avatars');
	 	}
	 	if ($user->save()) {
	 		Session::flash('success','Se actualizaron los datos satisfactoriamente.');
	 	 	return Redirect::back();
	 	 } 
	}
	public function postAdminPass()
	{
		Session::flash('act','pass');
		$data = Input::all();
		Validator::extend('checkCurrentPass', function($attribute, $value, $parameters)
		{
		    if( ! Hash::check( $value , $parameters[0] ) )
		    {
		        return false;
		    }
		    return true;
		});
		$rules = array(
			'password_old' 			=> 'required|checkCurrentPass:'.Auth::user()->password,
			'password'	   			=> 'required|max:16|confirmed',
			'password_confirmation' => 'required',
		);
		$msg = array();
		$attr = array(
			'password_old' 			=> 'contraseña actual',
			'password'	   			=> 'nueva contraseña',
			'password_confirmation' => 'confirmación de la contraseña'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$user = User::find(Auth::id());
		$user->password = Hash::make($data['password']);
		$user->save();
		Session::flash('success','Se ha cambiado su contraseña satisfactoriamente.');
		return Redirect::back();
	}
}