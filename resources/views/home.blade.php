@extends('layouts.app')

@section('content')
	<div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
        <li class="text-left">
            <img src="{{ asset('thewayshop/images/banner-01.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Selamat datang di <br>TheGADGET 2</strong></h1>
                        <p class="m-b-40">Selamat berbelanja di website kami. <br> Anda dapat berbelanja beraneka ragam produk elektronik.</p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-center">
            <img src="{{ asset('thewayshop/images/banner-02.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Selamat datang di <br>TheGADGET 2</strong></h1>
                        <p class="m-b-40">Selamat berbelanja di website kami. <br> Anda dapat berbelanja beraneka ragam produk elektronik.</p>
                    </div>
                </div>
            </div>
        </li>
        <li class="text-right">
            <img src="{{ asset('thewayshop/images/banner-03.jpg') }}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Selamat datang di <br>TheGADGET 2</strong></h1>
                        <p class="m-b-40">Selamat berbelanja di website kami. <br> Anda dapat berbelanja beraneka ragam produk elektronik.</p>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
  </div>

  <div class="categories-shop">
    <div class="container">
			<div class="row">
          <div class="col-lg-12">
              <div class="title-all text-center">
                  <h1>Kategori Produk</h1>
                  <p>Pilihlah salah satu kategori produk yang dapat kami tawarkan kepada anda.</p>
              </div>
          </div>
      </div>
			<div class="row justify-content-center">
				<div class="col-lg-12">
					<ul class="nav nav-tabs" >
						<div class="container">
							<div class="row">
								<div class="col-sm d-flex justify-content-center">
									<div class="form-group">
										<input class="form-check-input radiobtn" name="group100" type="radio" id="radio100" selected checked value="0">
										<label for="radio100" class="form-check-label dark-grey-text ">Semua Produk</label>
									</div>
								</div>
								<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
								@foreach ($category as $item)
									@if ($item->product->count())
										<div class="col-sm d-flex justify-content-center">
											<div class="form-group">
												<input class="form-check-input radiobtn" name="group100" type="radio" id="radio10{{$loop->iteration}}" value="{{$item->id}}">
												<label for="radio10{{$loop->iteration}}" class="form-check-label dark-grey-text">{{$item->category_name}}</label>
											</div>
										</div>
									@else
										<input type="hidden" id="radio10{{$loop->iteration}}" class="radiobtn">
									@endif
								@endforeach
							</div>
						</div>
					</ul>
				</div>
			</div>
      		<div class="ganti">
				<div class="products">
					<div class="row">
						@foreach ($product as $products)
							<div class="col-lg-3 col-m-4">
								<div class="single-product">
									<div class="product-img">
										@foreach ($products->product_image as $image)
											<img class="img-fluid w-100" src="/uploads/product_images/{{$image->image_name}}" alt="" />
											@break
										@endforeach
										@php
											$home = new Home;
											$disc = $home->tampildiskon($products->discount);
										@endphp
										@if($disc!=0)
											<div style="background-color:red;"class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
										@endif
										<div class="p_icon">
											<a href="/product/{{$products->id}}">
												<i class="ti-shopping-cart"></i>
											</a>
										</div>
									</div>
									<div class="product-btm text-center">
										<a href="/product/{{$products->id}}" class="d-block">
											<h4>{{$products->product_name}}</h4>
										</a>
										<div class="mt-3">
											<div class="row m-auto">
											@if ($products->stock == 0)
												<div class="col badge badge-danger mb-2 mr-4">Stok Habis!</div>
											@else
												<div class="col"></div>
											@endif
											</div>	
											@php
												$home = new Home;
												$harga = $home->diskon($products->discount,$products->price);
											@endphp
											@if ($harga != 0)	 
												<del>Rp.{{number_format($products->price)}}</del>  
												<span>Rp.{{number_format($harga)}}</span>
											@else
											<span>Rp.{{number_format($products->price)}}</span>
											@endif
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- End Categories -->
@endsection

@section('script')
<script>
    jQuery(document).ready(function(e){
        jQuery('.radiobtn').click(function(e){
            var index = $('.radiobtn').index(this);
            console.log(jQuery('#radio10'+index).val());
            jQuery.ajax({
                url: "{{url('/show_categori')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: jQuery('#radio10'+index).val(),
                },
                success: function(result){
                    $('.ganti').html(result.hasil);
                }
            });
        });
    });
  </script>
@endsection