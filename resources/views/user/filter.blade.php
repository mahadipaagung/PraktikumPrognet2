@if ($status == 0)
<div class="products">
	<div class="container">
    <div class="row">
      @foreach ($kategori as $products)
        <div class="col-lg-3 col-md-6">
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
                  <i class="ti-eye"></i>
                </a>
                <a href="#">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="/product/{{$products->id}}" class="d-block">
                <h4>{{$products->product_name}}</h4>
              </a>
              <div class="mt-3">
                <div class="row m-auto">
                  <!-- <div class="col badge badge-primary mb-2">Rating: {{$products->product_rate}} <i class="fa fa-star"></i></div> -->
                  @if ($products->stock == 0)
                    <div class="col badge badge-danger mb-2 mr-4">Out Of Stock!</div>
                  @else
                    <div class="col"></div>
                  @endif
                  <div class="col"></div>
                </div>
                @php
									$home = new Home;
                  $harga = $home->diskon($products->discount,$products->price);
								@endphp
                @if ($harga != 0)	 
                  <del>Rp.{{number_format($products->price)}}</del>  
									<span class="mr-4">Rp.{{number_format($harga)}}</span>
								@else
                  <span class="mr-4">Rp.{{number_format($products->price)}}</span>
								@endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
	</div>
</div>
@else
<div class="products">
	<div class="container">
    <div class="row">
      @foreach ($kategori->product as $products)
        <div class="col-lg-3 col-md-6">
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
                  <i class="ti-eye"></i>
                </a>
                <a href="#">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="/product/{{$products->id}}" class="d-block">
                <h4>{{$products->product_name}}</h4>
              </a>
              <div class="mt-3">
                <div class="row m-auto">
                  <!-- <div class="col badge badge-primary mb-2">Rating: {{$products->product_rate}} <i class="fa fa-star"></i></div> -->
                  @if ($products->stock == 0)
                    <div class="col badge badge-danger mb-2 mr-4">Out Of Stock!</div>
                  @else
                    <div class="col"></div>
                  @endif
                    <div class="col"></div>
                </div>
                @php
                  $home = new Home;
                  $harga = $home->diskon($products->discount,$products->price);
                @endphp
                @if ($harga != 0)	 
                  <del>Rp.{{number_format($products->price)}}</del>  
                  <span class="mr-4">Rp.{{number_format($harga)}}</span>
                @else
                  <span class="mr-4">Rp.{{number_format($products->price)}}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
	</div>
</div>
@endif