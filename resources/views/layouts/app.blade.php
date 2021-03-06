<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<title>Repositori Metadata dan Direktori Layanan - Ristekdikti</title>
		<link rel="icon" href="static/img/kemenristekdikti.png">
		
		<!-- <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css"> -->
		<!-- <link rel="stylesheet" type="text/css" href="static/css/custom.css"> -->
		{!! Html::style('css/bootstrap.min.css'); !!}
		{!! Html::style('css/custom-public.css'); !!}
		@stack('link')

		{!! Html::script('js/jquery.min.js'); !!}
		{!! Html::script('js/bootstrap.min.js'); !!}

		
		<!-- <script type="text/javascript" src="static/js/jquery.min.js"></script> -->
		<!-- <script type="text/javascript" src="static/js/bootstrap.min.js"></script> -->
		<script type="text/javascript">
			$( document ).ready(function() {
			    $('#nav_big').affix({
					offset: {
						top: $('header').height()+$('#nav_mini').height()
					}
				});	
			});
		</script>
	</head>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div style="float:left">
						<img src="{{URL::asset('img/kemenristekdikti.png')}}" id="img-head">
					</div>
					<h3>Repository Metadata dan Direktori Layanan</h3>
					<p>Kementerian Riset Teknologi dan Pendidikan Tinggi</p>
				</div>
			</div>
		</div>
	</header>
	<nav class="navbar navbar-default hidden-xs" id="nav_mini">
		<div class="container">
			<div class="col-xs-12">
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					<li><a href="{{ url('/login') }}">&nbsp;&nbsp;Login&nbsp;&nbsp;</a></li>
					<li><a href="{{ url('/register') }}" style="border-right: 1px solid #AAA">Register</a></li>
					@else
					<li><a href="{{ url('/dashboard') }}">&nbsp;&nbsp;Dashboard&nbsp;&nbsp;</a></li>
					<li><a href="{{ url('/logout') }}">&nbsp;&nbsp;Logout&nbsp;&nbsp;</a></li>
					@endif
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<nav class="navbar navbar-default" id="nav_big">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">RISTEKDIKTI</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('frontdataset') }}">Dataset</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Organisasi <span class="caret"></span></a>
						<ul class="dropdown-menu">
							@foreach($nama_org as $key)
							<li><a href="{{ url('profil/'.$key->name) }}">{{ $key->name }}</a></li>
							@endforeach
							<!-- <li role="separator" class="divider"></li> -->
						</ul>
					</li>
					<li><a href="{{ url('news') }}">News</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<body>
		@yield('content')
		<div class="push"></div>		
		@stack('scripts')
	</body>
	<footer style="padding:20px; background-color: white; border-top: 4px solid #0060AA">
		<div class="text-center">
			<a href="">Dataset</a> | <a href="">Organisasi</a> | <a href="">Peta Situs</a> | <a href="">Kontak</a>	
			<p>&copy 2016 - sekarang. Kementerian Riset Teknologi dan Pendidikan Tinggi.<br /> 	 
			Hak Cipta dilindungi Undang - Undang</p>
		</div>
	</footer>
</html> 