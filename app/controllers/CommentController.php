<?php

class CommentController extends BaseController {
	public function getNewComment()
	{
		$data  = Input::all();
		$rules = array(
			'name'	  => 'sometimes|min:4',
			'email'   => 'sometimes|email',
			'comment' => 'required|min:4|max:400'
		);
		$msg  = array();
		$attr = array(
			'name'	    => 'nombre',
			'email'     => 'email',
			'comment'	=> 'comentario'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return View::make('partials.responseAjax')
			->with('errors',$validator->getMessageBag());
		}
		$comment = new Comment;
		$comment->article_id = $data['art_id'];
		$comment->comment 	 = $data['comment'];
		$comment->save();
		if (Input::has('name') || Input::has('email')) {
			$details = new CommentsDetail;
			if (Input::has('name')) {
				$details->comment_name = $data['name'];
			}
			if (Input::has('email')) {
				$details->comment_email = $data['email'];
			}
			$details->save();
		}
		$comment->with('details');
		return View::make('partials.new-comment')
		->with('comment',$comment);
	}
	public function getCommentLike()
	{
		$request 	= Request::instance();
		$request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
		$ip 		= $request->getClientIp();
		$comment_id = Input::get('comment_id');

		$aux 		= CommentsLike::where('comment_id','=',$comment_id)->where('ip','=',$ip)->get();
		if (count($aux) > 0) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => 'Ya a usted le gusta esto.'
			));
		}
		if (Input::has('comment_id')) {
			$like = new CommentsLike;
			$like->comment_id = $comment_id;
			$like->ip = $ip;
			$like->save();
			$count = CommentsLike::where('comment_id','=',$comment_id)
			->count();
			return Response::json(array(
				'type' => 'success',
				'msg'  => 'Gracias por su aporte',
				'count'=> $count
			));
		}
	}
}