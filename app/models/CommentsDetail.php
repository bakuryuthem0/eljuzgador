<?php

class CommentsDetail extends Eloquent {
	public function comment()
	{
		return $this->belongsTo('Comment','comment_id');
	}
}
