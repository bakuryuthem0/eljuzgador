<?php

class Comment extends Eloquent {
	public function article()
	{
		return $this->belongsTo('Article','article_id');
	}
	public function details()
	{
		return $this->hasOne('CommentsDetail','comment_id');
	}
	public function likes()
	{
		return $this->hasMany('CommentsLike','comment_id');
	}
	public function likesCount()
	{
	  return $this->likes()
	  	->orderBy('aggregate')
	    ->groupBy('comment_id')
	    ->selectRaw('comment_id,count(*) as aggregate');
	}
}
