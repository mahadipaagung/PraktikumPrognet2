@extends('layouts.app')

@section('content')
	<!-- STEPS =============================-->
	<div class="item content">
		<div class="container toparea">
			<div class="row text-center">
				<div class="col-md-4">
					<div class="col editContent">
						<span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
						<h3 class="numbertext">Choose our Products</h3>
						<p>
							Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
						</p>
					</div>
					<!-- /.col-md-4 -->
				</div>
				<!-- /.col-md-4 col -->
				<div class="col-md-4 editContent">
					<div class="col">
						<span class="numberstep"><i class="fa fa-gift"></i></span>
						<h3 class="numbertext">Pay with PayPal or Card</h3>
						<p>
							Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
						</p>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.col-md-4 col -->
				<div class="col-md-4 editContent">
					<div class="col">
						<span class="numberstep"><i class="fa fa-download"></i></span>
						<h3 class="numbertext">Get Instand Download</h3>
						<p>
							Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- LATEST ITEMS =============================-->
	<section class="item content">
		<div class="container">
			<div class="underlined-title">
				<div class="editContent">
					<h1 class="text-center latestitems">LATEST ITEMS</h1>
				</div>
				<div class="wow-hr type_short">
					<span class="wow-hr-h">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					</span>
				</div>
			</div>
			<div class="row">
			@foreach ($product as $products)
				<div class="col-md-4">
					<div class="productbox">
						<div class="fadeshop">
							<div class="captionshop text-center" style="display: none;">
								<h3>{{$products->product_name}}</h3>
								<p>
									<a href="/product/{{$products->id}}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
								</p>
							</div>
							@if($products->product_image->count())
								@foreach ($products->product_image as $image)
									<span class="maxproduct"><img src="/uploads/product_images/{{$image->image_name}}" alt=""></span>
									@break
								@endforeach
							@else
								<span class="maxproduct"><img src="/uploads/product_images/noimage.jpg" alt=""></span>
							@endif
						</div>
						<div class="product-details">
							<a href="/product/{{$products->id}}">
								<h1>{{$products->product_name}}</h1>
							</a>
							@if($products->stock==0)
								<h4>Out of Stock!</h4>
							@endif

							@if($products->discount->count())
								@foreach($products->discount as $diskon)
									<h4>-{{$diskon->percentage}}%</h4>
									<span class="price">
										<del class="edd_price">Rp.{{number_format($products->price)}}</del>
									</span>
									<span class="price">
										<span class="edd_price">Rp.{{number_format($products->price * ((100 - $diskon->percentage) / 100))}}</span>
									</span>
								@endforeach
							@else
								<span class="price">
									<span class="edd_price">Rp.{{number_format($products->price)}}</span>
								</span>
							@endif
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
	</section>

	<!-- BUTTON =============================-->
	<div class="item content">
		<div class="container text-center">
			<a href="/shop" class="homebrowseitems">Browse All Products
			<div class="homebrowseitemsicon">
				<i class="fa fa-star fa-spin"></i>
			</div>
			</a>
		</div>
	</div>
	<br/>

	<!-- CALL TO ACTION =============================-->
	<section class="content-block" style="background-color:#00bba7;">
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="item" data-scrollreveal="enter top over 0.4s after 0.1s">
					<h1 class="callactiontitle"> Promote Items Area Give Discount to Buyers <span class="callactionbutton"><i class="fa fa-gift"></i> WOW24TH</span>
					</h1>
				</div>
			</div>
		</div>
	</div>
	</section>
@endsection