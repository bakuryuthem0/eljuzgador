<div id="sidebar" class="col-md-3 fix-left">
	<!---- Start Widget ---->
	<div class="widget wid-banner">
		<div class="content">
			<img src="images/banner-2.jpg" class="img-responsive"/>
		</div>
	</div>
	<!---- Start Widget ---->
	<div class="widget wid-follow">
		<div class="heading"><h4>Siguenos</h4></div>
		<div class="content">
			<ul class="list-inline">
				<li>
					<a href="http://facebook.com/">
						<div class="box-facebook">
							<span class="fa fa-facebook fa-2x"></span>
							<span>1250</span>
							<span>Fans</span>
						</div>
					</a>
				</li>
				<li>
					<a href="http://twitter.com/">
						<div class="box-twitter">
							<span class="fa fa-twitter fa-2x"></span>
							<span>1250</span>
							<span>Fans</span>
						</div>
					</a>
				</li>
				<li>
					<a href="http://instagram.com/">
						<div class="box-google">
							<span class="fa fa-instagram fa-2x"></span>
							<span>1250</span>
							<span>Fans</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!---- Start Widget ---->
	<div class="widget wid-vid">
		<div class="heading">
			<h4>Videos</h4>
		</div>
		<div class="content">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#most">Mas Vistos</a></li>
				<li><a data-toggle="tab" href="#popular">Popular</a></li>
				<li><a data-toggle="tab" href="#random">Random</a></li>
			</ul>
			<div class="tab-content">
				<div id="most" class="tab-pane fade in active">
					@foreach(SideBarController::getMostPopulars() as $a)
					<div class="post wrap-vid">
						<div class="col-xs-4 col-sm-6 zoom-container">
							<div class="zoom-caption">
								<a href="{{ URL::to('noticias/ver-noticia/'.$a->article->slug) }}"></a>
							</div>
							@if(strpos($a->article->images->first()->image,'http://') === 0 || strpos($a->article->images->first()->image,'https://') === 0)
								<img src="{{ $a->article->images->first()->image }}">
							@else
								<img src="{{ asset('images/news/'.$a->article->id.'/'.$a->article->images->first()->image) }}">
							@endif
						</div>
						<div class="col-xs-8 col-sm-6 wrapper">
							<h5 class="vid-name"><a href="#">{{ $a->article->title }}</a></h5>
							<div class="info">
								<span><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($a->article->created_at)) }}</span> 
								@if(!is_null($a->article->likes_count->first()))
									<span><i class="fa fa-heart"></i> {{ $a->article->likes_count->first()->aggregate }}</span>
								@endif
								@if(!is_null($a->article->comments_count->first()))
									<span><i class="fa fa-comment-o"></i> {{ $a->article->comments_count->first()->aggregate }}</span>
								@endif
								@if(!is_null($a->article->visits_count->first()))
									<span><i class="fa fa-eye"></i> {{ $a->article->visits_count->first()->aggregate }}</span>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!---- Start Widget ---->
	<div class="widget wid-tags">
		<div class="heading"><h4>Busqueda</h4></div>
		<div class="content">
			@if(!isset($slug))
			<form role="form" class="form-horizontal" method="GET" action="{{ URL::to('noticias/busqueda') }}">
			@else
			<form role="form" class="form-horizontal" method="GET" action="{{ URL::to('noticias/busqueda/'.$slug) }}">
			@endif
				<input type="text" placeholder="Buscador" value="" name="busq" id="v_search" class="form-control">
			</form>
		</div>
	</div>
	<!---- Start Widget ---->
	<div class="widget wid-tags">
		<div class="widget wid-comment">
			<div class="heading"><h4>Top Comments</h4></div>
			<div class="content">
				@foreach(SideBarController::getTopComments() as $top)
				<div class="post">
					<div class="">
						<a href="{{ URL::to('noticias/ver-noticia/'.$top->comment->article->slug) }}"><h5><i class="fa fa-comment"></i> {{ $top->comment->comment }}</h5></a>
						<ul class="list-inline pull-right">
							<li><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($top->comment->created_at)) }}</li> 
							<li><i class="fa fa-thumbs-up"></i>{{ $top->top_comment }}</li>
						</ul>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<!---- Start Widget ---->
		<div class="widget wid-recent-post">
			<div class="heading"><h4>Recent Posts</h4></div>
			<div class="content">
				<span>Creativity is about the journey <a href="#">your mind takes</a></span>
				<span>About the journey <a href="#">your mind</a></span>
				<span>The journey <a href="#">your</a></span>
				<span>Journey is about the journey <a href="#">your mind mind</a></span>
				<span>Creativity is about the journey <a href="#">your mind takes</a></span>
				<span>About the journey <a href="#">your mind</a></span>
				
			</div>
		</div>
	</div>
</div>