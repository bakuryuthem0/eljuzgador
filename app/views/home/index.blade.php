@extends('layouts.default')

@section('content')
	@if(count($relevant) > 0 || count($main) > 0)
	<section class="row important-news-container">
		@if(!empty($main))
		<div class="no-padding col-xs-12 @if(count($relevant) > 0) col-sm-6 col-md-8 @endif main-news zoom-container relevant-news" data-url="{{ URL::to('noticias/ver-noticia/'.$main->slug) }}">
			<div class="zoom-caption">
				<div class="zoom-caption-inner">
					<div class="date-feat">
						<i class="fa fa-clock-o"></i>
						<span>{{ date('d/m/Y',strtotime($main->created_at)) }}</span>
						<i class="fa fa-video-camera"></i>
						<span>Video</span>
					</div>
					<h3>{{ $main->title }}</h3> 
				</div>
			</div>
			@if(strpos($main->images->first()->image,'http://') === 0 || strpos($main->images->first()->image,'https://') === 0)
				<img src="{{ $main->images->first()->image }}" class="img-responsive">
			@else	
				<img src="{{ asset('images/news/'.$main->id.'/'.$main->images->first()->image) }}" class="img-responsive">
			@endif
		</div>
		@endif
		<div class="no-padding col-xs-12 @if(count($main) > 0) col-sm-6 col-md-4 @endif main-news">
			@foreach($relevant as $r)
			<div class="col-xs-4 col-sm-12 side-news zoom-container relevant-news" data-url="{{ URL::to('noticias/ver-noticia/'.$r->slug) }}">
				<div class="zoom-caption">
					<div class="zoom-caption-inner">
						<div class="date-feat">
							<i class="fa fa-clock-o"></i>
							<span>{{ date('d-M-Y',strtotime($r->created_at)) }}</span>
							<i class="fa fa-video-camera"></i>
							<span>Video</span>
						</div>
						<h3>{{ $r->title }}</h3> 
					</div>
				</div>
				@if(strpos($r->images->first()->image,'http://') === 0 || strpos($r->images->first()->image,'https://') === 0)
					<img src="{{ $r->images->first()->image }}" class="img-responsive">
				@else
					<img src="{{ asset('images/news/'.$r->id.'/'.$r->images->first()->image) }}" class="img-responsive">
				@endif
			</div>
			@endforeach
		</div>
	</section>
	@endif
	{{ $navbar }}
	<div id="page-content" class="index-page">
		<div class="clearfix no-gutter">
			<div id="main-content" class="col-md-9 fix-right">
				<div class="gutter-7px grid">
					@foreach($news as $n)
						<div class="col-xs-12 col-sm-4 item">
							<article>
								<div class="entry-header">
									<div class="grid-cat"><a href="{{ URL::to('noticias/ver-noticia/'.$n->slug) }}">{{ $n->category->description }}</a></div>
									<h3 class="entry-title"><a href="{{ URL::to('noticias/ver-noticia/'.$n->slug) }}">{{ $n->title }}</a></h3>
									<span>
										@if(!is_null($n->likes_count->first()))<i class="fa fa-heart"></i> {{ $n->likes_count->first()->aggregate }} / @endif
										<i class="fa fa-calendar"></i> {{ date('d-m-Y',strtotime($n->created_at)) }} / 
										@if(!is_null($n->comments_count->first()))<i class="fa fa-comment-o"></i> {{ $n->comments_count->first()->aggregate }} / @endif
										@if(!is_null($n->visits_count->first()))<i class="fa fa-eye"></i> {{ $n->visits_count->first()->aggregate }}@endif
									</span>
								</div>
								<div class="post-thumbnail-wrap">
									<a href="{{ URL::to('noticias/ver-noticia/'.$n->slug) }}">
										@if(!is_null($n->images->first()))
											@if(strpos($n->images->first()->image,"http://") === 0 || strpos($n->images->first()->image,"https://") === 0)
												<img src="{{ $n->images->first()->image }}" alt="{{ $n->title }}">
											@else
												<img src="{{ asset('images/news/'.$n->id.'/'.$n->images->first()->image) }}" alt="{{ $n->title }}">
											@endif
										@else
											<img src="{{ asset('images/logo.png') }}" alt="{{ $n->title }}">
										@endif
									</a>
								</div>
								<div class="entry-content">
									<p>{{ ucfirst(substr(strip_tags($n->description), 0, 100)) }}</p>
									<a href="{{ URL::to('noticias/'.$n->slug) }}">Más...</a>
								</div>
							</article>
						</div>
					@endforeach
				</div>
				@if($news->getLastPage() > 1)
				<div class="col-xs-12 text-center btn-load-more">
					<button class="btn btn-info load-more" data-target=".gutter-7px" data-url="{{ URL::to('noticias/cargar-mas').'?page='.($news->getCurrentPage()+1) }}" data-current="{{ $news->getCurrentPage()+1 }}">
						Mas Noticias
					</button>
				</div>
				@endif
			</div>
			{{ $sideBar }}
		</div>
	</div>
	{{ Form::token() }}
@stop

@section('postscript')
{{ HTML::script("plugins/isotope/dist/isotope.pkgd.min.js")}}

<script type="text/javascript">
jQuery(document).ready(function($) {
	if ($(window).width() >= 768) {
		$('.grid').isotope({
		  itemSelector: '.item',
		  layoutMode: 'masonry',
		})
	}
});
</script>
@stop