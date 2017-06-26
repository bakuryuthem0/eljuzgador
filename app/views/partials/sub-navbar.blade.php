<!--Navigation-->
<nav id="menu" class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
	</div>

<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			@foreach(NavBarController::getMenuCat() as $c)
				<li><a href="{{ URL::to('noticias/busqueda/'.$c->slug) }}">{{ $c->description }}</a></li>
			@endforeach
			<li><a href="contact.html"><i class="fa fa-envelope"></i> Contact</a></li>
		</ul>
		<div class="col-sm-3 col-md-3 navbar-right">
			@if(!isset($slug))
			<form class="navbar-form" role="search" method="GET" action="{{ URL::to('noticias/busqueda') }}">
			@else
			<form class="navbar-form" role="search" method="GET" action="{{ URL::to('noticias/busqueda/'.$slug) }}">
			@endif
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Buscador" name="busq">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
			</form>
		</div>
	</div><!-- /.navbar-collapse -->
</nav>
<!-- /////////////////////////////////////////Content -->