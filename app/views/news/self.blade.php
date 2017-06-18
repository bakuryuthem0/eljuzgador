@extends('layouts.default')

@section('content')
{{ $navbar }}

<!-- /////////////////////////////////////////Content -->
<div id="page-content" class="single-page container">
	<div class="gutter-7px">
		<div id="main-content" class="col-md-8 fix-right">
			<article class="single-post">
				<div class="entry-header">
					@if(!is_null($art->pretitle))
						<h6>{{ ucfirst($art->pretitle->title) }}</h6>
					@endif
					<h1 class="entry-title"><a href="#!">{{ ucfirst($art->title) }}</a></h1>
					@if(!is_null($art->subtitle))
						<h6>{{ ucfirst($art->subtitle->title) }}</h6>
					@endif
					<span>
						<i class="fa {{ $fa }} fa-add-love" data-target=".likes-counter" data-to-remove="fa-heart-o" data-to-add="fa-heart" data-id="{{ $art->id }}" data-toggle="popover" data-trigger="manual" data-placement="top" data-title="" data-content=""></i>
                        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                        <span class="likes-counter">
						@if(!is_null($art->likes_count->first()) && $art->likes_count->first()->aggregate > 0) 
							{{ $art->likes_count->first()->aggregate }}
						@endif 
						</span>/ 
						<i class="fa fa-calendar"></i> {{ date('d/m/Y',strtotime($art->created_at)) }} / 
						<i class="fa fa-comment-o"></i> @if(!is_null($art->comments_count->first())) {{ $art->comments_count->first()->aggregate }} @endif / 
						<i class="fa fa-eye"></i> {{ $art->visits_count->first()->aggregate }}
					</span>
				</div>
				<div class="post-thumbnail-wrap">
					@if(strpos($art->images->first()->image,'http://') === 0 || strpos($art->images->first()->image,'https://') === 0)
						<img src="{{ $art->images->first()->image }}" />
					@else
						<img src="{{ asset('images/news/'.$art->id.'/'.$art->images->first()->image) }}" />
					@endif
				</div>
				<div class="l-share" style="padding: 20px 0;">
					<ul class="list-inline center">
						<li><!-- Your share button code -->
							<div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartir</a></div>
						</li>
						<li>
							<a class="twitter-share-button"
							  href="https://twitter.com/intent/tweet?text={{ $art->title }}" data-url="{{ Request::url() }}">
							Tweet</a>
						</li>
						<li><a href="#" class="btn btn-pinterest"><i class="fa fa-pinterest"></i> Tweet</a></li>
						<li><a href="#" class="btn btn-google"><i class="fa fa-google-plus-square"></i> Google+</a></li>
						<li><a href="#" class="btn btn-mail"><i class="fa fa-envelope-o"></i> E-mail</a></li>
					</ul>
				</div>
				<hr class="line">
				<div class="self-description entry-content">
					<p class="text-justify">{{ $art->description }}</p>
					<div class="vid-tags">
						@foreach($art->tags as $t)
							<a href="#">{{ $t->tag_name }}</a>
						@endforeach
					</div>
					<div class="line"></div>
					<div class="response-container"></div>
					<div class="comment">
						@foreach($art->comments as $c)
						<div class="post">
							<div class="">
								@if(!is_null($c->details))
									@if(!empty($c->details->comment_name))
									@endif
									@if(!empty($c->details->comment_email))
									@endif
								<hr>
								@endif
								<a href="#!"><h5><i class="fa fa-comment-o"></i> <p>{{ $c->comment }}</p></h5></a>

								<ul class="list-inline pull-right">
									<li><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($c->created_at)) }}</li> 
									<li>
										<i class="fa @if(!is_null($c->likes_count->first())) fa-thumbs-up @else fa-thumbs-o-up @endif fa-comment-like" data-id="{{ $c->id }}" data-target=".comment-likes-{{ $c->id }}" data-to-remove="fa-thumbs-o-up" data-to-add="fa-thumbs-up" data-id="{{ $c->id }}" data-toggle="popover" data-trigger="manual" data-placement="top" data-title="" data-content=""></i>
						            	<img src="{{ asset('images/loader.gif') }}" class="miniLoader">		
						            	<span class="comment-likes-{{ $c->id }}">
						            		@if(!is_null($c->likes_count->first()))
						            			{{ $c->likes_count->first()->aggregate }}
						            		@endif
						            	</span>
									</li>
								</ul>
							</div>
						</div>
						<hr>
						@endforeach
					</div>
					<div class="comment">
						<h3>Deja un comentario</h3>
						<form name="form1" method="post" action="" class="comment-form">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<input type="text" class="form-control input-lg comment_name" name="name" id="name" placeholder="Enter name" required="required" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" class="form-control input-lg validate-input comment_email" name="email" id="email" placeholder="Enter email"  />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="message" id="message" class="form-control validate-input comment_msg" rows="4" cols="25" required="required"
										placeholder="Message"></textarea>
									</div>						
									<button type="button" class="btn btn-4 btn-block send-comment" name="btnBooking" id="btnBbooking" disabled data-url="{{ URL::to('noticia/comentario/enviar') }}" data-target=".response-container">Enviar</button>
								</div>
							</div>
							{{ Form::token() }}

							<input type="hidden" class="art_id" value="{{ $art->id }}">
						</form>
					</div>
				</div>
			</article>
			
			<div class="box">
				<div class="box-header header-natural">
					<h2>Noticias Relacionadas</h2>
				</div>
				<div class="box-content">
					<div class="row">
						@foreach($related as $r)
						<div class="col-sm-4 col-md-4">
							<div class="wrap-vid">
								<div class="zoom-container">
									<div class="zoom-caption">
										<a href="{{ URL::to('noticias/ver-noticia/'.$r->id) }}"></a>
									</div>
									@if(strpos($r->images->first()->image,'http://') === 0 || strpos($r->images->first()->image,'https://') === 0)
										<img src="{{ $r->images->first()->image }}" />
									@else
										<img src="{{ asset('images/news/'.$r->id.'/'.$r->images->first()->image) }}" />
									@endif
								</div>
								<h3 class="vid-name"><a href="#">{{ $r->title }}</a></h3>
								<div class="info">
									<span><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($r->created_at)) }}</span> 
									@if(!is_null($r->likes_count->first()) && $r->likes_count->first()->aggregate > 0) 
									<span><i class="fa fa-heart"></i> {{ $r->likes_count->first()->aggregate > 0 }}</span>
									@endif
									@if(!is_null($r->visits_count->first()) && $r->visits_count->first()->aggregate > 0) 
									<i class="fa fa-eye"></i> {{ $r->visits_count->first()->aggregate }}
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		{{ $sideBar }}
	</div>
</div>
@stop
