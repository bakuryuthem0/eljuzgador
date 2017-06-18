<?php

class Article extends Eloquent {
	use Conner\Tagging\TaggableTrait;
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
	public function likes()
	{
		return $this->hasMany('Like','article_id');
	}
	public function likesCount()
	{
	  return $this->likes()
	    ->selectRaw('article_id,count(*) as aggregate')
	    ->groupBy('article_id');
	}
	public function visits()
	{
		return $this->hasMany('Visitor','article_id');
	}
	public function visitsCount()
	{
	  return $this->visits()
	    ->selectRaw('article_id,count(*) as aggregate')
	    ->groupBy('article_id');
	}
	public function comments()
	{
		return $this->hasMany('Comment','article_id');
	}
	public function commentsCount()
	{
	  return $this->comments()
	    ->selectRaw('article_id,count(*) as aggregate')
	    ->groupBy('article_id');
	}
	public function tags()
	{
		return $this->hasMany('Tags','taggable_id');
	}
}
