<?php

class CommentsLike extends Eloquent {
	public function comment()
	{
		return $this->belongsTo('Comment','comment_id');
	}
}
