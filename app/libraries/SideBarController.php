<?php
	Class SideBarController
	{
		function __construct() {
		}
		public static function getTopComments()
		{
			$comments = CommentsLike::groupBy('comment_id')
			->take(4)
			->orderBy('top_comment','DESC')
			->selectRaw('count(comment_id) as top_comment, comment_id')
			->with(array('comment' => function($comment){
				$comment->with('article');
			}))
			->get();
			return $comments;
		}
		public static function getMostViewed()
		{
			$articles = Visitor::groupBy('article_id')
			->take(4)
			->orderBy('top_articles','DESC')
			->with(array('article' => function($article){
				$article->with('images')
				->with('likesCount')
				->with('visitsCount')
				->with('commentsCount');
			}))
			->selectRaw('count(article_id) as top_articles, article_id')
			->get();
			return $articles;
		}
		public static function getMostPopulars()
		{
			$articles = Like::groupBy('article_id')
			->take(4)
			->orderBy('top_articles','DESC')
			->with(array('article' => function($article){
				$article->with('images')
				->with('likesCount')
				->with('visitsCount')
				->with('commentsCount');
			}))
			->selectRaw('count(article_id) as top_articles, article_id')
			->get();
			return $articles;
		}
	}