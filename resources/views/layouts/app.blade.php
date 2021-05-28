<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
	<link rel="icon" href="{{ asset('thewayshop/images/favicon.ico') }}" type="image/png" />
	<meta name="generator" content="">

	<title>TheGADGET 2</title>

	<link href="{{ asset('scorilo/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('scorilo/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('scorilo/css/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('scorilo/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')
	<!-- SCRIPTS =============================-->
	<script src="{{ asset('scorilo/js/jquery-.js') }}"></script>
	<script src="{{ asset('scorilo/js/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('scorilo/js/owl.carousel.js') }}"></script>
	<script src="{{ asset('scorilo/js/owl.carousel.min.js') }}"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="{{ asset('scorilo/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('scorilo/js/anim.js') }}"></script>

	<script>
	//----HOVER CAPTION---//	  
	$(document).ready(function ($) {
		$('.fadeshop').hover(
			function(){
				$(this).find('.captionshop').fadeIn(150);
			},
			function(){
				$(this).find('.captionshop').fadeOut(150);
			}
		);
	});
	</script>

	@yield('script')

</body>

</html>