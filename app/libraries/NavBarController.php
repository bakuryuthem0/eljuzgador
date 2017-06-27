<?php
	Class NavBarController
	{
		function __construct() {
		}
		public static function getMenuCat()
		{
			$cat = Categoria::get();

			return $cat;
		}		
		public static function getMarquee()
		{
			$art = Article::where('show_marquee','=',1)->get();
			return $art;
		}
	}