@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Product Details</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="single-product.html">Product Details</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <!-- Product Image -->
        <div class="col-lg-11">
          @php
            $i=1;
            $j=1;
          @endphp
          <div class="details_image w-100" x-data="{ image: 'image1' }">
            <div>
              <div>
                @foreach ($products->product_image as $jpg)
                  <img class="w-100" src="/uploads/product_images/{{$jpg->image_name}}" alt="" x-show="image === 'image{{$i}}'">
                  @php
                    $home = new Home;
                    $disc = $home->tampildiskon($products->discount);
                  @endphp
                  @if($disc!=0)
                    <div style="background-color:red;" class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
                  @endif
                  @php
                    $i++;
                  @endphp
                @endforeach
              </div>
              @foreach ($products->product_image as $jpg)
                <a class="col-sm" href="#" @click.prevent="image = 'image{{$j}}'">
                  <img class="w-25" :class="{ 'border border-info' : image === 'image{{$j}}'}" src="/uploads/product_images/{{$jpg->image_name}}" alt="">
                </a>
                @php
                  $j++;
                @endphp
              @endforeach
            </div>             
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3>{{$products->product_name}}</h3>
          @php
            $home = new Home;
            $harga = $home->diskon($products->discount,$products->price);
          @endphp
          @if ($harga != 0)
            <del><h4>Rp.{{number_format($products->price)}}</h3></del>
            <h2>Rp.{{number_format($harga)}}</h2>
          @else
            <h2>Rp.{{number_format($products->price)}}</h2>
          @endif
          <div class="in_stock_container">
            <span >Availability    :</span>
            @if ($products->stock <= 0)
              <span style="color:red;">Out of Stock!</span>
              @else
                @if ($products->stock <= 5) 
                <span style="color:red;">Hurry Up!</span> <br>
                <span style="color:black;">Only {{$products->stock}} left!</span>
              @else
                <span>In Stock</span> <br>
                <span style="color:black;">{{$products->stock}} left</span>
              @endif
                    @endif
          </div>
          <p>{{$products->description}}</p>
          <div class="card_area">
            <div class="product_quantity_container">
              @if (is_null(Auth::user()))
                @if ($products->stock<1)
                  <button class="btn btn-primary btn-success tombol1" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                  <button class="btn btn-primary btn-rounded tombol1" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                @else
                  <button class="btn btn-primary btn-success tombol1"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                  <button class="btn btn-primary btn-rounded tombol1"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                @endif
              @else -->
                @if ($products->stock<1)
                  <button class="btn btn-primary btn-success" class="tombol1" disabled>
                    <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> Purchase
                  </button>
                  <button class="btn btn-primary btn-rounded" id="ajaxSubmit" disabled>
                    <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                  </button>
                @else
                  <table>
                    <td>
                      <form action="/checkout" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$products->id}}" id="product_id">
                        @if ($harga != 0)
                          <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
                        @else
                          <input type="hidden" name="subtotal" id="subtotal" value="{{$products->price}}">
                        @endif
                        <input type="hidden" name="weight" value="{{$products->weight}}">
                        <input type="hidden" name="qty" class="qty" value="1" readonly>
                        <button type="submit" class="btn btn-success" class="tombol1">
                        <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                      </form>
                    </td>
                    <td>
                      <input type="hidden" value="{{$products->id}}" id="product_id">
                      <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                      <button class="btn btn-primary btn-rounded" id="ajaxSubmit">
                        <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                      </button>
                    </td>
                  </table>
                @endif
              @endif
            </div>
            <a class="icon_btn mt-3" href="#">
              <i class="lnr lnr lnr-diamond"></i>
            </a>
            <a class="icon_btn" href="#">
              <i class="lnr lnr lnr-heart"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Review Area =================-->
<section class="product_description_area">
  <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <span
          class="nav-link active"
          id="review-tab"
          data-toggle="tab"
          href="#review"
          role="tab"
          aria-controls="review"
          aria-selected="false"
          >Reviews</span
        >
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      @if (!$products->product_review->count())
      <div class="d-flex justify-content-center">    
        <div class="row mb-5">
            <p><strong>Belum ada review produk.</strong></p> 
        </div>
      </div>
      @else
      @foreach ($products->product_review as $item)
        <!-- First row -->
        <div class="row mb-5">
        
        <!-- Image column -->
        <div class="col-sm-2 col-12 mb-3">
  
          <img src="{{asset('/uploads/avatars/'.$item->user->profile_image)}}" style="width:100px;height:100px;object-fit:cover;" alt="sample image" class="avatar rounded-circle z-depth-1-half">
  
        </div>
        <!-- Image column -->
  
        <!-- Content column -->
        <div class="col-sm-10 col-12">
  
          <a>
          {{-- @php
            dd(Auth::user()->id);
          @endphp --}}
          <h5 style="color:#333333" class="user-name font-weight-bold">{{$item->user->name}} 
          </h5>
  
          </a>
  
          <!-- Rating -->
          <ul class="rating">
            <li>
          @for ($i = 0; $i < $item->rate; $i++)
            
            <i class="fa fa-star checked"></i>
            
          @endfor
          @for ($i = 0; $i < 5-$item->rate; $i++)
            
            <i class="fa fa-star"></i>
            
          @endfor
          </li>  
          </ul>
          <input type="hidden" class="rate{{$loop->iteration-1}}" value="{{$item->rate}}">
          <input type="hidden" class="content{{$loop->iteration-1}}" value="{{$item->content}}">
          <input type="hidden" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
          <div class="card-data">
          <ul class="list-unstyled mb-1">
            <li class="comment-date font-small grey-text">
            <i class="fa fa-clock-o"></i> {{$item->created_at}}</li>
          </ul>
          </div>
  
          <p class="dark-grey-text article">{{$item->content}}</p>
  
        </div>
        <!-- Content column -->
  
        </div>
        <!-- First row -->
          @if ($item->response->count())
          <!-- Balasan -->
          @foreach ($item->response as $balasan)
          <div class="row mb-5" style="margin-left: 5%">
            
            <!-- Image column -->
            <div class="col-sm-2 col-12 mb-3">
  
            <img src="{{asset('/uploads/avatars/'.$balasan->admin->profile_image)}}" style="width:100px;height:100px;object-fit:cover;" alt="sample image" class="avatar rounded-circle z-depth-1-half">
  
            </div>
            <!-- Image column -->
  
            <!-- Content column -->
            <div class="col-sm-10 col-12">
  
            <a>
  
              <h5 style="color: #333333" class="user-name font-weight-bold"><span style="margin-right:5px;" class="badge badge-success">Admin</span>{{$balasan->admin->name}}</h5>
  
            </a>
            <!-- Rating -->
            <div class="card-data">
              <ul class="list-unstyled mb-1">
              <li class="comment-date font-small grey-text">
                <i class="fa fa-clock-o"></i> {{$balasan->created_at}}</li>
              </ul>
            </div>
  
            <p class="dark-grey-text article">{{$balasan->content}}</p>
  
            </div>
            <!-- Content column -->
  
          </div>
  
          @endforeach
          <!-- Balasan -->
  
          @endif
  
      @endforeach
  
      @endif
    </div>
  </div>
</section>
<!--================End Product Description Area =================-->
@endsection