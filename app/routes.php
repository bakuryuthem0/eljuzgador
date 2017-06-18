<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');

Route::get('/', 'HomeController@getIndex');
Route::group(array('before' =>'csrf'),function(){
	Route::get('noticias/obtener-pagina','HomeController@getPaginateState');
	Route::get('noticias/cargar-mas','HomeController@getMoreNews');
	Route::get('agregar-love','NewsController@getNewLike');
	Route::get('agregar-like','CommentController@getCommentLike');
	Route::post('noticia/comentario/enviar','CommentController@getNewComment');
});

Route::get('noticias/ver-noticia/{slug}','NewsController@getNewsSelf');
Route::get('noticias/busqueda','SearchController@getSearch');
Route::get('noticias/busqueda/{slug}','SearchController@getSearch');

Route::group(array('before' => 'no_auth'),function()
{
	Route::get('administrador/login','AuthController@getStoreLogin');
	Route::group(array('before' =>'csrf'),function(){
		Route::post('administrador/login/enviar','AuthController@postAdminLogin');
	});

});

Route::group(array('before' => 'auth_admin'), function(){
	Route::get('administrador','AdminController@getIndex');
	Route::get('administrador/inicio','AdminController@getIndex');
	//perfil
	Route::get('administrador/usuario/perfil','UserController@getProfile');
	//usuarios
	Route::get('administrador/usuario/nuevo','UserController@getNewUser');
	Route::get('administrador/ver-usuarios','UserController@getUsers');

	//categorias
	Route::get('administrador/categoria/nueva','AdminController@getNewCat');
	Route::get('administrador/categorias/ver-categorias','AdminController@getCats');
	Route::get('administrador/categorias/ver-categorias/{id}','AdminController@getCat');
	//noticias
	Route::get('administrador/noticia/nueva','NewsController@getNewNews');
	Route::get('administrador/noticias/ver-noticias','NewsController@getNews');
	Route::get('administrador/noticia/modificar/{id}','NewsController@getMdfNews');
	Route::group(array('before' =>'csrf'),function(){
		//perfil
		Route::post('administrador/usuario/perfil/cambiar-contrasena/enviar','UserController@postAdminPass');
		Route::post('administrador/usuario/perfil/enviar','UserController@postAdminProfile');
		//usuarios
		Route::post('administrador/usuario/nuevo/enviar','UserController@postNewUser');
		Route::post('administrador/cambiar-password','UserController@poastChangePass');	
		Route::post('administrador/eliminar-usuario','UserController@postUserElim');
		//categorias				
		Route::post('administrador/categoria/nueva/enviar','AdminController@postNewCat');
		Route::post('administrador/categorias/ver-categorias/{id}/enviar','AdminController@postMdfCat');
		Route::post('administrador/categorias/eliminar','AdminController@postElimCat');
		Route::get('activar-categorias-menu','AdminController@activateCat');
		//Noticias
		Route::post('administrador/noticia/nuevo/enviar','NewsController@postNewNews');
		Route::get('administracion/publicaciones/cargar-detalles','NewsController@getNewsDescription');
		Route::post('administrador/ver-articulos/eliminar','NewsController@postElimArticle');
		Route::post('administrador/noticia/modificar/{id}/enviar','NewsController@postMdfArt');
		Route::post('administracion/noticias/imagen/eliminar-imagen','NewsController@postElimNewsImage');
		Route::get('administrador/noticias/activar-relevante','NewsController@getNewRelevant');
	});
});