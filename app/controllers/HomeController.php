<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$title = "Inicio | El Juzgador";

		$news = Article::where('is_relevant','=',0)
		->where('is_main','=',0)
		->with('category')
		->with('images')
		->with('likesCount')
		->with('visitsCount')
		->with('commentsCount')
		->orderBy('id','DESC')
		->paginate(9);
		$relevant = Article::where('is_relevant','=',1)
		->with('category')
		->with('images')
		->take(3)
		->get();
		$main = Article::where('is_main','=',1)
		->with('category')
		->with('images')
		->orderBy('id','DESC')
		->first();
		return View::make('home.index')
		->with('title',$title)
		->with('news',$news)
		->with('relevant',$relevant)
		->with('main',$main)
		->nest('navbar','partials.sub-navbar')
		->nest('sideBar','partials.sideBar');
	}
	public function getMoreNews()
	{
		$news = Article::where('is_relevant','=',0)
		->where('is_main','=',0)
		->with('category')
		->with('images')
		->with('likesCount')
		->with('visitsCount')
		->with('commentsCount')
		->orderBy('id','DESC')
		->paginate(8);

		return View::make('partials.more-news')
		->with('news',$news);
	}
	public function getPaginateState()
	{
		$page = Input::get('page');
		$news = Article::where('is_relevant','=',0)
		->orderBy('id','DESC')
		->paginate(8);
		$status = 0;
		if ($page == $news->getLastPage()) {
			$status = 1;
		}
		return Response::json(array(
			'type'    => 'success',
			'estado'  => $status,
			'current' => $page+1,
			'last'    => $news->getLastPage()
		));
	}
	
}
