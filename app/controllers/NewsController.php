<?php

class NewsController extends BaseController {
	public function getNewNews()
	{
		$title  = "Nueva Noticia | El Juzgador";
		$cat 	= Categoria::get();
		return View::make('admin.news.new')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function postNewNews()
	{
		$data 	= Input::all();
		$imgVal = ImageController::imageValidation($data);
		$rules 	= array_merge(
			array(
				'category'		=> 'required|exists:categorias,id',
				'title'    		=> 'required|max:100|unique:articles,title',
				'pretitle'    	=> 'sometimes|max:100',
				'subtitle'    	=> 'sometimes|max:100',
				'mainorrelevant'=> 'sometimes|in:relevant,main,no',
				'description' 	=> 'required',
			),
			$imgVal['rules']
		);
		$msg 	= array(
		);
		$attr 	= array_merge(
			array(
				'category'		=> 'categoría',
				'title'	   		=> 'titulo',
				'description'   => 'descripción'
			),
			$imgVal['attr']
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$news = new Article;
		$news->slug        = str_replace(' ','-',strtolower($data['title']));
		$news->cat_id      = $data['category'];
		$news->title       = $data['title'];
		
		$news->description = $data['description'];
		if (Input::has('mainorrelevant') && Input::get('mainorrelevant') == "relevant") {
			$aux = Article::where('is_relevant','=',1);
			if ($aux->count() >= 6) {
				$last = $aux->orderBy('id','ASC')->first();
				$last->is_relevant = 0;
				$last->save();
			}
			$news->is_relevant = 1;
		}
		if (Input::has('mainorrelevant') && Input::get('mainorrelevant') == "main") {
			$aux = Article::where('is_main','=',1);
			if ($aux->count() > 0) {
				$main = $aux->first();
				$main->is_main = 0;
				$main->save();
			}
			$news->is_main = 1;
		}
		$news->save();
		if (Input::has('pretitle')) {
			$pretitle = new Pretitle;
			$pretitle->article_id = $news->id;
			$pretitle->title 	  = $data['pretitle'];
			$pretitle->save();
		}
		if (Input::has('subtitle')) {
			$subtitle = new Subtitle;
			$subtitle->article_id = $news->id;
			$subtitle->title 	  = $data['subtitle'];
			$subtitle->save();
		}
		if (Input::has('tags')) {
			$news->retag($data['tags']);
		}
		$ruta 	 = "images/news/".$news->id."/";
		$file = Input::file();
		if (Input::hasFile('img')) {
			foreach($file['img'] as $f)
			{
				$img = new ArticleImages;
				$img->article_id = $news->id;
				$img->image   	  = ImageController::upload_image($f, $f->getClientOriginalName(),$ruta);
				$img->save();
			}
		}
		if (Input::has('img_url')) {
			foreach($data['img_url'] as $f)
			{
				$img = new ArticleImages;
				$img->article_id  = $news->id;
				$img->image   	  = $f;
				$img->save();
			}
		}
		Session::flash('success','Articulo creado satisfactoriamente.');
		return Redirect::to('administrador/noticias/ver-noticias');
	}
	public function getNews()
	{
		$title = "Ver articulos | El Juzgador";
		$articles = Article::orderBy('id','DESC')->get();
		return View::make('admin.news.show')
		->with('title',$title)
		->with('articles',$articles);

	}
	public function getNewsDescription()
	{
		$id = Input::get('id');
		$article = Article::find($id);
		return View::make('admin.news.description')
		->with('article',$article);
	}
	public function showArt($id)
	{
		$articulo = Articulo::with('imagenes')->find($id);
		$title = "Ver artículo: ".$articulo->title." | El Juzgador";
		return View::make('admin.article.view')
		->with('title',$title)
		->with('articulo',$articulo);
	}
	public function getProy()
	{
		$id = Input::get('id');
		$cat = Categoria::where('tipo','=',$id)->get();
		return Response::json(array(
			'data' => $cat,
			'type' => 'success',
			
		));
	}
	public function postElimArticle()
	{
		$data  = Input::all();
 		$rules = array(
 			'id'  => 'required|exists:articles,id',
 		);
 		$msg   = array();
 		$attr  = array(
 			'id' => 'id de la noticia',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg'  => $validator->getMessageBag()
 			));
 		}
 		$id = Input::get('id');
		$img = ArticleImages::where('article_id','=',$id);
		foreach ($img->get() as $i) {
			File::delete('images/news/'.$id.'/'.$i->image);
		}
		$img->delete();
		$pretitle = Pretitle::where('article_id','=',$id)->delete();
		$art = Article::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg' => 'Se ha eliminado la noticia',
		));
	}
	public function getMdfNews($id)
	{
		$article = Article::with('category')
		->with('images')
		->with('pretitle')
		->with('tags')
		->find($id);
		$title = "Modificar Noticia: ".$article->title." | El Juzgador";
		$cat = Categoria::get();
		return View::make('admin.news.mdf')
		->with('title',$title)
		->with('article',$article)
		->with('cat',$cat);
	}
	public function postMdfArt($id)
	{
		$data 	= Input::all();
		$imgVal = ImageController::imageValidation($data);
		$rules 	= array_merge(
			array(
				'category'		=> 'required|exists:categorias,id',
				'title'    		=> 'required|max:100|unique:articles,title',
				'pretitle'    	=> 'sometimes|max:100',
				'subtitle'    	=> 'sometimes|max:100',
				'mainorrelevant'=> 'sometimes|in:relevant,main,no',
				'description' 	=> 'required',
			),
			$imgVal['rules']
		);
		$msg 	= array(
		);
		$attr 	= array_merge(
			array(
				'category'		=> 'categoría',
				'title'	   		=> 'titulo',
				'description'   => 'descripción'
			),
			$imgVal['attr']
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$news = Article::find($id);
		$news->cat_id      = $data['category'];
		$news->slug        = str_replace(' ','-',strtolower($data['title']));
		$news->title       = $data['title'];
		
		$news->description = $data['description'];
		if (Input::has('mainorrelevant') && Input::get('mainorrelevant') == "relevant") {
			$aux = Article::where('is_relevant','=',1);
			if ($aux->count() >= 6) {
				$last = $aux->orderBy('id','ASC')->first();
				$last->is_relevant = 0;
				$last->save();
			}
			$news->is_relevant = 1;
		}
		elseif (Input::has('mainorrelevant') && Input::get('mainorrelevant') == "main") {
			$aux = Article::where('is_main','=',1);
			if ($aux->count() > 0) {
				$main = $aux->first();
				$main->is_main = 0;
				$main->save();
			}
			$news->is_main = 1;
		}
		elseif(!Input::has('mainorrelevant') || Input::get('mainorrelevant') == "no")
		{
			$news->is_relevant = 0;
			$news->is_main = 0;
		}
		$news->save();
		if (Input::has('pretitle')) {
			$pretitle = Pretitle::where('article_id','=',$news->id);
			if ($pretitle->count() > 0) {
				$pretitle = $pretitle->first();
				$pretitle->title 	  = $data['pretitle'];
			}else
			{
				$pretitle = new Pretitle;
				$pretitle->article_id = $news->id;
			}
			$pretitle->save();
		}
		if (Input::has('subtitle')) {
			$subtitle = Subtitle::where('article_id','=',$news->id);
			if ($subtitle->count() > 0) {
				$subtitle = $subtitle->first();
				$subtitle->title 	  = $data['subtitle'];
			}else
			{
				$subtitle = new subtitle;
				$subtitle->article_id = $news->id;
			}
			$subtitle->save();
		}
		if (Input::has('tag')) {
			$news->retag($data['tag']);
		}
		$ruta 	 = "images/news/".$news->id."/";
		$file = Input::file();
		if (Input::hasFile('img')) {
			foreach($file['img'] as $file_id => $f)
			{
				if (!is_null($f)) {
					$img 				 = ArticleImages::where('id','=',$file_id)->where('article_id','=',$id);
					if ($img->count() < 1) {
						$img = new ArticleImages;
						$img->article_id = $id;
					}else
					{
						$img = $img->first();
						File::delete('images/publication/'.$id.'/'.$img->image);
					}
					$img->image   		 = ImageController::upload_image($f,$f->getClientOriginalName(),$ruta);
					$img->save();
				}
			}
		}
		if (Input::has('img_url')) {
			foreach($data['img_url'] as $file_id => $f)
			{
				if (!is_null($f)) {
					$img 				 = ArticleImages::where('id','=',$file_id)->where('article_id','=',$id);
					if ($img->count() < 1) {
						$img = new ArticleImages;
						$img->article_id = $id;
					}else
					{
						$img = $img->first();
						File::delete('images/publication/'.$id.'/'.$img->image);
					}
					$img->image   		 = $f;
					$img->save();
				}
			}
		}

		Session::flash('success','Articulo creado satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimNewsImage()
	{
		$data  = Input::all();
 		$rules = array(
 			'id'  => 'required|exists:article_images,id',
 		);
 		$msg   = array();
 		$attr  = array(
 			'id' => 'id de la imagen',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg'  => $validator->getMessageBag()
 			));
 		}
 		$id = Input::get('id');
		$img = ArticleImages::find($id);
		File::delete('images/news/'.$img->article_id.'/'.$img->image);
		$img->delete();
		return Response::json(array(
			'type' => 'success',
			'msg' => 'Se ha eliminado la imagen',
		));
	}
	public function getNewRelevant()
	{
		$id = Input::get('id');
		$aux = Article::where('is_relevant','=',1);
		$response = array();
		$response['status'] = 1;
		if ($aux->count() >= 6) {
			$last = $aux->orderBy('updated_at','ASC')->first();
			$last->is_relevant = 0;
			$last->save();
			$response['last'] = $last->id;
			$response['status'] = 2;
		}
		$art =  Article::find($id);
		if ($art->is_relevant == 1) {
			$art->is_relevant = 0;
			$response['status'] = 3;
		}else
		{
			$art->is_relevant = 1;
		}
		$art->save();
		$response['type'] = "success";
		$response['msg']  = "Se ha cambiado la noticia relevante.";
		return Response::json($response);
	}
	public function getNewsSelf($slug)
	{
		$request = Request::instance();
		$request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
		$ip = $request->getClientIp();
		
		$art = Article::with('category')
		->with('images')
		->with('pretitle')
		->with('subtitle')
		->with('likesCount')
		->with('visitsCount')
		->with('commentsCount')
		->with('tags')
		->with(array('comments' => function($comments){
			$comments
			->with('details')
			->with('likesCount');
		}))
		->where('slug','=',$slug)
		->first();

		$visit = new Visitor;
		$visit->article_id = $art->id;
		$visit->ip         = $ip;
		$visit->save();

		$aux = Like::where('article_id','=',$art->id)->where('ip','=',$ip)->get();
		if (count($aux) > 0) {
			$fa = 'fa-heart';
		}else
		{
			$fa = 'fa-heart-o';
		}

		$title = $art->title." | El Juzgador";
		
		$related = Article::where('id','!=',$art->id)
		->take(3)
		->with('images')
		->with('likesCount')
		->with('visitsCount')
		->with('commentsCount')
		->withAnyTag($art->tagNames())
		->get();
		return View::make('news.self')
		->with('title',$title)
		->with('art',$art)
		->with('related',$related)
		->with('fa',$fa)
		->nest('navbar','partials.sub-navbar')
		->nest('sideBar','partials.sideBar');
	}
	public function getNewLike()
	{
		$request = Request::instance();
		$request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
		$ip = $request->getClientIp();
		$art_id = Input::get('art_id');

		$aux = Like::where('article_id','=',$art_id)->where('ip','=',$ip)->get();
		if (count($aux) > 0) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => 'Ya a usted le gusta esto.'
			));
		}
		if (Input::has('art_id')) {
			$like = new Like;
			$like->article_id = $art_id;
			$like->ip = $ip;
			$like->save();
			$count = Like::where('article_id','=',$art_id)
			->count();
			return Response::json(array(
				'type' => 'success',
				'msg'  => 'Gracias por su aporte',
				'count'=> $count
			));
		}
	}
}