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
	}