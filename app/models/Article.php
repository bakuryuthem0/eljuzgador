<?php

class Article extends Eloquent {
	public function pretitle()
	{
		return $this->hasOne('Pretitle','article_id');
	}
	public function subtitle()
	{
		return $this->hasOne('Subtitle','article_id');
	}
	public function category()
	{
		return $this->belongsTo('Categoria','cat_id');
	}
	public function images()
	{
		return $this->hasMany('ArticleImages','article_id');
	}
}
