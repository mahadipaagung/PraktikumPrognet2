<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
	<link rel="icon" href="{{ asset('thewayshop/images/favicon.ico') }}" type="image/png" />
	<title>TheGADGET 2</title>
	<link rel="stylesheet" href="{{ asset('thewayshop/css/bootstrap.min.css') }} ">
	<link rel="stylesheet" href="{{ asset('thewayshop/css/style.css') }} ">
	<link rel="stylesheet" href="{{ asset('thewayshop/css/responsive.css') }} ">
	<link rel="stylesheet" href="{{ asset('thewayshop/css/custom.css') }} ">
	
	<link rel="stylesheet" href="{{ asset('thewayshop/css/styles.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/css/bootstrap.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/css/font-awesome.min.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/css/themify-icons.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/css/flaticon.css') }} " />

	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/linericon/style.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/owl-carousel/owl.carousel.min.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/lightbox/simpleLightbox.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/nice-select/css/nice-select.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/animate-css/animate.css') }} " />
	<link rel="stylesheet" href="{{ asset('thewayshop/vendors/jquery-ui/jquery-ui.css') }} " />
	
	<link rel="stylesheet" type="text/css" href="{{ asset('user/product.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('user/product_responsive.css')}}">
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')
	<!-- ALL JS FILES -->
	<script src="{{ asset('thewayshop/js/jquery-3.2.1.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/popper.js') }} "></script>
	<script src="{{ asset('thewayshop/js/bootstrap.min.js') }} "></script>
	<!-- ALL PLUGINS -->
	<script src="{{ asset('thewayshop/js/jquery.superslides.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/bootstrap-select.js') }} "></script>
	<script src="{{ asset('thewayshop/js/inewsticker.js') }} "></script>
	<script src="{{ asset('thewayshop/js/bootsnav.js') }} "></script>
	<script src="{{ asset('thewayshop/js/images-loded.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/isotope.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/owl.carousel.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/baguetteBox.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/form-validator.min.js') }} "></script>
	<script src="{{ asset('thewayshop/js/contact-form-script.js') }} "></script>
	<script src="{{ asset('thewayshop/js/custom.js') }} "></script>

	<script src="{{ asset('thewayshop/js/stellar.js') }} "></script>
	<script src="{{ asset('thewayshop/js/mail-script.js') }} "></script>
	<script src="{{ asset('thewayshop/js/theme.js') }} "></script>

	<script src="{{ asset('thewayshop/vendors/lightbox/simpleLightbox.min.js') }} "></script>
	<script src="{{ asset('thewayshop/vendors/nice-select/js/jquery.nice-select.min.js') }} "></script>
	<script src="{{ asset('thewayshop/vendors/isotope/imagesloaded.pkgd.min.js') }} "></script>
	<script src="{{ asset('thewayshop/vendors/counter-up/jquery.waypoints.min.js') }} "></script>
	<script src="{{ asset('thewayshop/vendors/counter-up/jquery.counterup.js') }} "></script>

	<script src="{{ asset('user/product.js')  }}"></script>
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>

  	@yield('script')
</body>

</html>