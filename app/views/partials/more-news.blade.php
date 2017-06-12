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