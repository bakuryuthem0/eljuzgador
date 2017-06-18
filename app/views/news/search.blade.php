@extends('layouts.default')

@section('content')
{{ $navbar }}
<!-- /////////////////////////////////////////Content -->
<div id="page-content" class="index-page">
	<div class="clearfix no-gutter">
		<div id="main-content" class="col-md-9 fix-right">
			<div class="tag-title">
				<h2><i class="fa fa-tag"></i> Busqueda</h2>
			</div>
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
								<a href="{{ URL::to('noticias/'.$n->id) }}">Más...</a>
							</div>
						</article>
					</div>
				@endforeach
				@if(count($news) < 1)
				<h3>No se encontraron noticias para la busqueda. </h3>
				@endif
            </div>
			@if(count($news) > 0)
            <div class="blog-pagination col-xs-12">
                <nav role="navigation">
                    <?php  $presenter = new Illuminate\Pagination\BootstrapPresenter($news); ?>
                    @if ($news->getLastPage() > 1)
                        <ul class="pagination text-center center-block">
                        <?php
                            $beforeAndAfter = 3;
                            $currentPage = $news->getCurrentPage();
                            $lastPage = $news->getLastPage();
                            $start = $currentPage - $beforeAndAfter;
                            if($start < 1)
                            {
                                $pos = $start - 1;
                                $start = $currentPage - ($beforeAndAfter + $pos);
                            }
                            $end = $currentPage + $beforeAndAfter;
                            if($end > $lastPage)
                            {
                                $pos = $end - $lastPage;
                                $end = $end - $pos;
                            }
                            if ($currentPage <= 1)
                            {
                                echo '<li class="disabled"><a href="#!">&laquo;</a></li>';
                            }
                            else
                            {
                                $url = $news->getUrl(1);
                                echo '<li><a class="" href="'.$url.(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&laquo;</a></li>';
                            }
                            if (($currentPage-1) < $start) {
                                echo '<li class="disabled"><a href="#!">&laquo;</a></li>';   
                            }else
                            {
                                echo '<li><a href="'.$news->getUrl($currentPage-1).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&laquo;</a></li>';
                            }
                            for($i = $start; $i<=$end;$i++)
                            {
                                if ($currentPage == $i) {
                                    echo '<li class="active"><a href="#!">'.$i.'</a></li>';
                                }else
                                {
                                    echo '<li><a href="'.$news->getUrl($i).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">'.$i.'</a></li>';
                                }
                            }
                            if (($currentPage+1) > $end) {
                                echo '<li class="disabled"><a href="#!">&raquo;</a></li>' ;
                            }else
                            {
                                echo '<li><a href="'.$news->getUrl($currentPage+1).(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&raquo;</a></li>';
                            }
                            if ($currentPage >= $lastPage)
                            {
                                echo '<li class="disabled"><a href="#!">&raquo;</a></li>';
                            }
                            else
                            {
                                $url = $news->getUrl($lastPage);
                                echo '<li><a class="" href="'.$url.(isset($busq) ? '&busq='.$busq : "").$paginatorFilter.'">&raquo;</a></li>';
                            }
                        ?>
                        </ul>
                    @endif
                </nav>
            </div>
            @endif
		</div>
		{{ $sideBar }}
	</div>
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