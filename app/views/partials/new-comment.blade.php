<div class="post">
	<div class="">
		@if(!is_null($comment->details))
			@if(!empty($comment->details->comment_name))
			@endif
			@if(!empty($comment->details->comment_email))
			@endif
		<hr>
		@endif
		<a href="#!"><h5>{{ $comment->comment }}.</h5></a>
		<ul class="list-inline pull-right">
			<li><i class="fa fa-calendar"></i><i class="fa fa-comment-o"></i> <p>{{ $comment->comment }}</li> 
			<li>
				<i class="fa fa-thumbs-o-up fa-comment-like" data-id="{{ $comment->id }}" data-target=".comment-likes-{{ $comment->id }}" data-to-remove="fa-thumbs-o-up" data-to-add="fa-thumbs-up" data-id="{{ $comment->id }}" data-toggle="popover" data-trigger="manual" data-placement="top" data-title="" data-content=""></i>
            	<img src="{{ asset('images/loader.gif') }}" class="miniLoader">		
            	<span class="comment-likes-{{ $comment->id }}"></span>
			</li>
		</ul>
	</div>
</div>
<hr>