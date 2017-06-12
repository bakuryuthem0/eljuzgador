@extends('layouts.default')

@section('content')
	@if(count($relevant) > 0 || count($main) > 0)
	<section class="row">
		<div class="no-padding col-xs-12 @if(count($relevant) > 0) col-md-8 @endif main-news zoom-container">
			<div class="zoom-caption">
				<div class="zoom-caption-inner">
					<div class="date-feat">
						<i class="fa fa-clock-o"></i>
						<span>26 Jan , 2016  </span>
						<i class="fa fa-video-camera"></i>
						<span>Video</span>
					</div>
					<h3>Video Post with Featured Image</h3> 
				</div>
			</div>
			<img src="{{ asset('templates/myafrica/images/12.jpg') }}" class="img-responsive">
		</div>
		<div class="no-padding col-xs-12 @if(count($main) > 0) col-md-4 @endif main-news">
			@foreach($relevant as $r)
			<div class="col-xs-4 col-md-12 col- side-news zoom-container">
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

<!-- /////////////////////////////////////////Content -->
	<div id="page-content" class="index-page">
		<div class="clearfix no-gutter">
			<div id="main-content" class="col-md-9 fix-right">
				<div class="gutter-7px grid">
					@foreach($news as $n)
						<div class="col-xs-12 col-sm-4 item">
							<article>
								<div class="entry-header">
									<div class="grid-cat"><a href="#">{{ $n->category->description }}</a></div>
									<h3 class="entry-title"><a href="#">{{ $n->title }}</a></h3>
									<span><i class="fa fa-heart"></i> 1,200 / <i class="fa fa-calendar"></i> {{ date('d-m-Y',strtotime($n->created_at)) }} / <i class="fa fa-comment-o"></i> 10 / <i class="fa fa-eye"></i> 945</span>
								</div>
								<div class="post-thumbnail-wrap">
									<a href="{{ URL::to('noticias/ver-noticia/'.$n->id) }}">
										@if(strpos($n->images->first()->image,"http://") === 0 || strpos($n->images->first()->image,"https://") === 0)
											<img src="{{ $n->images->first()->image }}">
										@else
											<img src="{{ asset('images/news/'.$n->id.'/'.$n->images->first()->image) }}">
										@endif
									</a>
								</div>
								<div class="entry-content">
									<p>{{ ucfirst(substr(strip_tags($n->description), 0, 100)) }}</p>
									<a href="single.html">Más...</a>
								</div>
							</article>
						</div>
					@endforeach
				</div>
				<div class="col-xs-12 text-center btn-load-more visible-sm">
					<button class="btn btn-info load-more" data-target=".gutter-7px" data-url="{{ URL::to('noticias/cargar-mobil') }}">Mas Noticias</button>
				</div>
			</div>
			<div id="sidebar" class="col-md-3 fix-left">
				<!---- Start Widget ---->
				<div class="widget wid-vid">
					<div class="heading">
						<h4>Videos</h4>
					</div>
					<div class="content">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#most">Most Plays</a></li>
							<li><a data-toggle="tab" href="#popular">Popular</a></li>
							<li><a data-toggle="tab" href="#random">Random</a></li>
						</ul>
						<div class="tab-content">
							<div id="most" class="tab-pane fade in active">
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/22.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/23.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/24.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
							</div>
							<div id="popular" class="tab-pane fade">
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/24.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/22.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/23.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
							</div>
							<div id="random" class="tab-pane fade">
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/23.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/24.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
								<div class="post wrap-vid">
									<div class="zoom-container">
										<div class="zoom-caption">
											<a href="single.html"></a>
										</div>
										<img src="{{ asset('templates/myafrica/images/22.jpg" />')}}
									</div>
									<div class="wrapper">
										<h5 class="vid-name"><a href="#">Video's Name</a></h5>
										<div class="info">
											<h6>By <a href="#">Kelvin</a></h6>
											<span><i class="fa fa-calendar"></i>25/3/2016</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-tags">
					<div class="heading"><h4>Search</h4></div>
					<div class="content">
						<form role="form" class="form-horizontal" method="post" action="">
							<input type="text" placeholder="Enter Search Keywords" value="" name="v_search" id="v_search" class="form-control">
						</form>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-tags">
					<div class="heading"><h4>Tags</h4></div>
					<div class="content">
						<a href="#">animals</a>
						<a href="#">cooking</a>
						<a href="#">countries</a>
						<a href="#">home</a>
						<a href="#">likes</a>
						<a href="#">photo</a>
						<a href="#">link</a>
						<a href="#">video</a>
						<a href="#">travel</a>
						<a href="#">images</a>
						<a href="#">love</a>
						<a href="#">lists</a>
						<a href="#">makeup</a>
						<a href="#">media</a>
						<a href="#">password</a>
						<a href="#">pagination</a>
						<a href="#">pictures</a>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-comment">
					<div class="heading"><h4>Top Comments</h4></div>
					<div class="content">
						<div class="post">
							<a href="single.html">
								<img src="{{ asset('templates/myafrica/images/ava-1.jpg')}}" class="img-circle"/>
							</a>
							<div class="wrapper">
								<a href="#"><h5>Curabitur tincidunt porta lorem.</h5></a>
								<ul class="list-inline">
									<li><i class="fa fa-calendar"></i>25/3/2016</li> 
									<li><i class="fa fa-thumbs-up"></i>1,200</li>
								</ul>
							</div>
						</div>
						<div class="post">
							<a href="single.html">
								<img src="{{ asset('templates/myafrica/images/ava-2.png')}}" class="img-circle"/>
							</a>
							<div class="wrapper">
								<a href="#"><h5>Curabitur tincidunt porta lorem.</h5></a>
								<ul class="list-inline">
									<li><i class="fa fa-calendar"></i>25/3/2016</li> 
									<li><i class="fa fa-thumbs-up"></i>1,200</li>
								</ul>
							</div>
						</div>
						<div class="post">
							<a href="single.html">
								<img src="{{ asset('templates/myafrica/images/ava-3.jpeg')}}" class="img-circle"/>
							</a>
							<div class="wrapper">
								<a href="#"><h5>Curabitur tincidunt porta lorem.</h5></a>
								<ul class="list-inline">
									<li><i class="fa fa-calendar"></i>25/3/2016</li> 
									<li><i class="fa fa-thumbs-up"></i>1,200</li>
								</ul>
							</div>
						</div>
						<div class="post">
							<a href="single.html">
								<img src="{{ asset('templates/myafrica/images/ava-4.jpg')}}" class="img-circle"/>
							</a>
							<div class="wrapper">
								<a href="#"><h5>Curabitur tincidunt porta lorem.</h5></a>
								<ul class="list-inline">
									<li><i class="fa fa-calendar"></i>25/3/2016</li> 
									<li><i class="fa fa-thumbs-up"></i>1,200</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-banner">
					<div class="content">
						<img src="{{ asset('templates/myafrica/images/banner-2.jpg')}}" class="img-responsive"/>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-categoty">
					<div class="heading"><h4>Category</h4></div>
					<div class="content">
						<select class="col-md-12">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-calendar">
					<div class="heading"><h4>Calendar</h4></div>
					<div class="content">
						<center><form action="" role="form">        
							<div class="">
								<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">                </div>
								<input type="hidden" id="dtp_input2" value="" /><br/>
							</div>
						</form></center>
					</div>
				</div>
				<!---- Start Widget ---->
				<div class="widget wid-tweet">
					<div class="heading"><h4>Tweet</h4></div>
					<div class="content">
						<div class="tweet-item">
							<p><i class="fa fa-twitter"></i> TLAS - Coming Soon PSD Mockup</p>
							<a>https://t.co/dLsNZYGVbJ</a>
							<a>#psd</a>
							<a>#freebie</a>
							<a>#freebie</a>
							<a>#dribbble</a>
							<span>July 15th, 2016</span>
						</div>
						<div class="tweet-item">
							<p><i class="fa fa-twitter"></i> Little Dude Character With Multiple Hairs</p>
							<a>https://t.co/dLsNZYGVbJ</a>
							<a>#freebie</a>
							<a>#design</a>
							<a>#illustrator</a>
							<a>#dribbble</a>
							<span>June 23rd, 2016</span>
						</div>
						<div class="tweet-item">
							<p><i class="fa fa-twitter"></i> Newsletter Subscription Form Mockup</p>
							<a>https://t.co/dLsNZYGVbJ</a>
							<a>#psd</a>
							<a>#freebie</a>
							<a>#freebie</a>
							<a>#dribbble</a>
							<span>June 22nd, 2016</span>
						</div>
						<p>Marshall, Will, and Holly on a routine expedition, met the greatest earthquake ever known. High on the rapids, it struck their tiny raft...</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('postscript')
{{ HTML::script("plugins/isotope/dist/isotope.pkgd.min.js")}}

<script type="text/javascript">
jQuery(document).ready(function($) {
	if ($(window).width() > 768) {
		$('.grid').isotope({
		  itemSelector: '.item',
		  layoutMode: 'masonry',
		})
	}
});
</script>
@stop