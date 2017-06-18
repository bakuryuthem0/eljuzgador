@foreach($news as $n)
	<div class="col-xs-12 col-sm-4 item">
		<article>
			<div class="entry-header">
				@if(!is_null($n->likes_count->first()))<i class="fa fa-heart"></i> {{ $n->likes_count->first()->aggregate }} / @endif
				<i class="fa fa-calendar"></i> {{ date('d-m-Y',strtotime($n->created_at)) }} / 
				@if(!is_null($n->comments_count->first()))<i class="fa fa-comment-o"></i> {{ $n->comments_count->first()->aggregate }} / @endif
				@if(!is_null($n->visits_count->first()))<i class="fa fa-eye"></i> {{ $n->visits_count->first()->aggregate }}@endif
			</div>
			<div class="post-thumbnail-wrap">
				<a href="{{ URL::to('noticias/ver-noticia/'.$n->slug) }}">
					@if(strpos($n->images->first()->image,"http://") === 0 || strpos($n->images->first()->image,"https://") === 0)
						<img src="{{ $n->images->first()->image }}">
					@else
						<img src="{{ asset('images/news/'.$n->id.'/'.$n->images->first()->image) }}">
					@endif
				</a>
			</div>
			<div class="entry-content">
				<p>{{ ucfirst(substr(strip_tags($n->description), 0, 100)) }}</p>
				<a href="{{ URL::to('noticias/ver-noticia/'.$n->slug) }}">Más...</a>
			</div>
		</article>
	</div>
@endforeach