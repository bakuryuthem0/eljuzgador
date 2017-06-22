<?php

class AuthController extends BaseController {
	public function validateAndAttempt($data, $rules, $msg, $attr)
	{
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return $validator;
		}
		return true;
	}
	public function getStoreLogin()
	{
		$title = "Administración | El Juzgador";
		return View::make('admin.auth.login')
		->with('title',$title);
	}
	public function postAdminLogin()
	{
		$data = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);
		$rules = array(
			'username' => 'required|exists:users,username,role_id,1',
			'password' => 'required|min:8|max:16'
		);
		$msg = array();
		$attr = array(
			'password' => 'contraseña'
		);
		$validation = $this->validateAndAttempt($data, $rules, $msg, $attr);
		if($validation){
			if (Auth::attempt($data)) {
				return Response::json(array('type' => 'success','msg' => 'Se ha iniciado sesión satisfactoriamente. Espere mientra lo redireccionamos.'));
			}
			return Response::json(array('type' => 'danger','msg' => 'Error al tratar de iniciar sesión, usuario o contraseña incorrectos.'));
		}
		return Response::json(array('type' => 'danger','msg' => $validation->getMessageBag));
	}
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}