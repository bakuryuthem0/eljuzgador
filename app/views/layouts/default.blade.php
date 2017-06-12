<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by 365Bootstrap dot com - Free Responsive Html5 Templates">
    <meta name="author" content="http://www.365bootstrap.com">
	
    <title>{{ $title }}</title>
	
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('templates/myafrica/css/bootstrap.min.css' )}}"  type="text/css">
	
	<!-- Owl Carousel Assets -->
    <link href="{{ asset('templates/myafrica/owl-carousel/owl.carousel.css') }}" rel="stylesheet" media="screen">
    <!-- <link href="owl-carousel/owl.theme.css" rel="stylesheet"> -->
	
	<!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('templates/myafrica/css/style.css') }}" rel="stylesheet" media="screen">
	 <link href="{{ asset('templates/myafrica/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
	
	<!-- Custom Fonts -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/font-awesome/css/font-awesome.min.css') }}"  type="text/css">
		
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
	<!-- jQuery and Modernizr-->
	<script src="{{ asset('templates/myafrica/js/jquery-2.1.1.js') }}"></script>
	
	<!-- Core JavaScript Files -->  	 
    <script src="{{ asset('templates/myafrica/js/bootstrap.min.js') }}"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="index-page">
	<input type="hidden" class="baseUrl" value="{{ URL::to('/') }}">
	<header>
		<!--Top-->
		<nav id="top">
			<div class="container">
				<div class="row">
					<div class="col-xs12 col-md-4 visible-lg">
					</div>
					<div class="col-xs12 col-md-4">
						<img src="{{ asset('images/logo.png') }}" class="logo center-block">
					</div>
					<div class="col-xs-12 visible-xs text-center social-icons margin-bottom-1">
						<i class="fa fa-facebook dark-gray"></i>
						<i class="fa fa-twitter dark-gray"></i>
						<i class="fa fa-instagram dark-gray"></i>
					</div>
					<div class="col-xs12 col-md-4">
						<div class="container-fluid">
							<button class="btn btn-flat btn-menu" data-toggle="collapse" data-target="#menu-options">
								<i class="fa fa-navicon"></i>
							</button>
							<ul class="list-inline top-link link navbar-collapse collapse" id="menu-options">
								<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
								<li><a href="contact.html"><i class="fa fa-comments"></i> Contact</a></li>
								<li><a href="#"><i class="fa fa-question-circle"></i> FAQ</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	
	@yield('content')

	<footer>
		<div class="wrap-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-footer footer-1">
						<div class="footer-heading"><h1><span style="color: #fff;">MYAFRICA</span></h1></div>
						<div class="content">
							<p>Never missed any post published in our site. Subscribe to our daly newsletter now.</p>
							<strong>Email address:</strong>
							<form action="#" method="post">
								<input type="text" name="your-name" value="" size="40" placeholder="Your Email" />
								<input type="submit" value="SUBSCRIBE" class="btn btn-3" />
							</form>
						</div>
					</div>
					<div class="col-md-4 col-footer footer-2">
						<div class="footer-heading"><h4>Tags</h4></div>
						<div class="content">
							<a href="#">animals</a>
							<a href="#">cooking</a>
							<a href="#">countries</a>
							<a href="#">city</a>
							<a href="#">children</a>
							<a href="#">home</a>
							<a href="#">likes</a>
							<a href="#">photo</a>
							<a href="#">link</a>
							<a href="#">law</a>
							<a href="#">shopping</a>
							<a href="#">skate</a>
							<a href="#">scholl</a>
							<a href="#">video</a>
							<a href="#">travel</a>
							<a href="#">images</a>
							<a href="#">love</a>
							<a href="#">lists</a>
							<a href="#">makeup</a>
							<a href="#">media</a>
							<a href="#">password</a>
							<a href="#">pagination</a>
							<a href="#">wildlife</a>
						</div>
					</div>
					<div class="col-md-4 col-footer footer-3">
						<div class="footer-heading"><h4>Link List</h4></div>
						<div class="content">
							<ul>
								<li><a href="#">MOST VISITED COUNTRIES</a></li>
								<li><a href="#">5 PLACES THAT MAKE A GREAT HOLIDAY</a></li>
								<li><a href="#">PEBBLE TIME STEEL IS ON TRACK TO SHIP IN JULY</a></li>
								<li><a href="#">STARTUP COMPANY’S CO-FOUNDER TALKS ON HIS NEW PRODUCT</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copy-right">
			<p>Copyright 2016 - <a href="http://www.365bootstrap.com" target="_blank" rel="nofollow">Bootstrap Themes</a> Designed by <a href="http://www.365bootstrap.com" target="_blank" rel="nofollow">365BOOTSTRAP</a></p>
		</div>
	</footer>
	<!-- Footer -->
	
	<!-- JS -->
	<script src="{{ asset('templates/myafrica/owl-carousel/owl.carousel.js')}}"></script>
    <script>
    $(document).ready(function() {
      $("#owl-slide").owlCarousel({
       autoPlay: 3000,
			items : 4,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768, 2],
			itemsMobile : [479, 1],
			navigation: true,
			navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
			pagination: false
      });
    });
    </script>
	
	
	<script type="text/javascript" src="{{ asset('templates/myafrica/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
	<script type="text/javascript" src="{{ asset('templates/myafrica/js/locales/bootstrap-datetimepicker.fr.js')}}" charset="UTF-8"></script>
	<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

@yield('postscript')
</body>
</html>
