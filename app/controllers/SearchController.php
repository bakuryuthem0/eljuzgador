<?php

class SearchController extends BaseController {
	public function getSearch($slug = null)
	{
		$data  			 = Input::all();
		$title 			 = "Busqueda | El Juzgador";
		$paginatorFilter = "";

		$view 			 = View::make('news.search');
		$news 			 = Article::with('category')
		->with('images')
		->with('likesCount')
		->with('visitsCount')
		->with('commentsCount');
		if (Input::has('busq')) {
			$news = $news->withAnyTag(array($data['busq']))
			->orWhere(function($query) use($data){
				$query->where('title','LIKE',$data['busq'].'%')
				->orWhere('title','LIKE','%'.$data['busq'].'%')
				->orWhere('title','LIKE','%'.$data['busq'])
				->orWhere('description','LIKE',$data['busq'].'%')
				->orWhere('description','LIKE','%'.$data['busq'].'%')
				->orWhere('description','LIKE','%'.$data['busq']);
			});
			$paginatorFilter .= '&busq='.$data['busq'];
		}		
		if (!is_null($slug)) {
			$cat = Categoria::where('slug','=',$slug)->first();
			$news->where('cat_id','=',$cat->id);
			View::share('slug',$slug);
			$view = $view->with('slug',$slug);
			$paginatorFilter .= '&slug='.$slug;
		}
		
		$news = $news
		->orderBy('id','DESC')
		->paginate(9);
		$view = $view
		->with('title',$title)
		->with('news',$news)
		->with('paginatorFilter',$paginatorFilter);
		return $view
		->nest('navbar','partials.sub-navbar')
		->nest('sideBar','partials.sideBar');
	}
}