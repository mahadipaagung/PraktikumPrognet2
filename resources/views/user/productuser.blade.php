@extends('user')
@section('page-contents')
<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>PHONE STORE</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="services">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
            @foreach ($product_images as $image)
            
            <div class="col-md-7">
             <div>
                <img src="{{asset('product_images/'.$image->image_name)}}" alt class="img-fluid wc-image">
                    <div class="single-gallery-image" style="background: url({{asset('product_images/'.$image->image_name)}});"></div>
                </=>
                </div>
		    </div>
            @endforeach
            <br>
        </div>
        <div class="col-md-5 col-3">
          <div class="sidebar-item recent-posts">
          <h4>{{$product->product_name}}</h4>
            <p>
                {{$product->description}}
            </p>
            <br>
            <br>
            <form action="" method="post">
                @csrf
            <div class="card_area">
                <div class="product_count_area">
                    <p>Quantity</p>
                    <input type="text" name="user_id" value="{{$user->id}}" hidden />
                    <input type="text" name="product_id"  value="{{$product->id}}" hidden />
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                        <input class="product_count_item input-number" name="qty" type="text" value="1" min="0" max="10">
                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                    </div>
                <p>Rp. {{number_format($product->price)}}</p>
                </div>
                <br>
              <div class="form-group">
                  <a href="#" class="filled-button">Add to Cart</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
 	<div class="whole-wrap">
		<div class="container box_1170">
            <div class="section-top-border">
        <h3 class="mb-30">Review</h3>
        <div class="row">
          
          @if ($user_review==null)
            <div class="col-lg-12 col-md-12">
						  <form action="{{route('review_product',['id'=>$product->id])}}" method="POST">
                @csrf
                <input type="text" name="user_id" value="{{$user->id}}" hidden />
                <input type="text" name="product_id"  value="{{$product->id}}" hidden />
                <div class="input-group-icon mt-10">
                  <div class="icon"><i class="fa fa-star" aria-hidden="true"></i></div>
                  <div class="form-select" id="default-select">
                  <select name="rate">
                          <option disabled selected>Rating</option>
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="mt-20">
                  <input type="text" name="content" placeholder="Content"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Content'" required
                    class="single-input">
                </div>
                <br>
                <div class="button-group-area mt-10">
                  <input type="submit" class="genric-btn success radius" value="Submit" />
                </div>  
              </form>
          </div>
          @endif
					
        </div>
        <br>
        <br>
        	@foreach ($product_reviews as $item)
         <div class="row">
					{{-- <div class="col-md-3">
          {{-- <img src="{{asset('image_user/'.$item->user->profile_image)}}" style="width: 200px; height:200px; padding:15px;" alt="" class="img-fluid"> --}}
					{{-- </div> --}}
					<div class="col-md-9 mt-sm-20">
            <h4 style="">{{$item->user->name}}</h4>
            <p>
              @for ($i = 1; $i <= $item->rate; $i++)
                  ★
              @endfor
            </p>
            <p>{{$item->content}}</p>
					</div>
        </div>
          @php
              $responses = DB::table('response')->where('review_id','=',$item->id)->get();
              
          @endphp        
          @if (!$responses->isEmpty())
               @foreach ($responses as $respon)
               <br>
              <h5 class="mb-30">Response Admin</h5>
                <div class="row">
                  <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                      {{$respon->content}}
                    </blockquote>
                  </div>
                </div>
                @endforeach
          @endif
        @endforeach
        
        
			</div>
			
        </div>
 	</div>   
  <!--================End Single Product Area =================-->
@endsection