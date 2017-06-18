<?php

class Like extends Eloquent {
	public function article()
	{
		return $this->belongsTo('Article','article_id');
	}
}