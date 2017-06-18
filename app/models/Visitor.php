<?php

class Visitor extends Eloquent {
	public function article()
	{
		return $this->belongsTo('Article','article_id');
	}
}