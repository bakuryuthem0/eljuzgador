<?php

class AdminController extends BaseController {
	public function getIndex()
	{
		$title = "Administración | eljuzgador.com";
		return View::make('admin.home.index')
		->with('title',$title);
	}
	public function getNewCat()
 	{
 		$title = "Nueva Categoría | Escuela de Alta Costura";
 		return View::make('admin.category.new')
 		->with('title',$title);
 	}
 	public function postNewCat()
	{
		$data  = Input::all();
 		$rules = array(
 			'name'  => 'required|min:4|max:50',
 		);
 		$msg   = array();
 		$attr  = array(
 			'name' => 'nombre de la categoría',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Redirect::back()->withErrors($validator)->withInput();
 		}
		$cat = new Categoria;
		$cat->slug         = str_replace(' ','-',strtolower($data['name']));
		$cat->description  = $data['name'];
		if ($cat->save()) {
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function getCats()
	{
		$title = "Ver categorías | nombredelapagina";
		$cat = Categoria::orderBy('id','DESC')
		->get();
		return View::make('admin.category.show')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function getCat($id)
	{
		$cat = Categoria::find($id);
		$title = "Modificar categoría: ".$cat->description_es.' | nombredelapagina';
		return View::make('admin.category.self')
		->with('cat',$cat)
		->with('title',$title);
	}
	public function postMdfCat($id)
	{
		$data  = Input::all();
 		$rules = array(
 			'name'  => 'required|min:4|max:50',
 		);
 		$msg   = array();
 		$attr  = array(
 			'name' => 'nombre de la categoría',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Redirect::back()->withErrors($validator)->withInput();
 		}
		$cat   = Categoria::find($id);
		$cat->slug        = str_replace(' ','-',strtolower($data['name']));
		$cat->description = $data['name'];
		if ($cat->save()) {
			Session::flash('success','Se ha modificado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function postElimCat()
	{
		$data  = Input::all();
 		$rules = array(
 			'cat_id'  => 'required|exists:categorias,id',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg' => $validator->getMessageBag()->toArray()
 			));
 		}
		$id  = Input::get('cat_id');
		$cat = Categoria::find($id)->delete();
		return Response::json(array('type' => 'success','msg' => 'Se ha eliminado la categoría satisfactoriamente.'));
		
	}
}