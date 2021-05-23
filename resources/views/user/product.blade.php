@extends('layouts.app')

@section('content')
<!--================Single Product Area =================-->
<section class="item content">
  <div class="container toparea">
    <div class="underlined-title">
      <div class="editContent">
        <h1 class="text-center latestitems">{{$products->product_name}}</h1>
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
      <div class="col-md-8">
        @foreach ($products->product_image as $image)
          @if ($loop->first)
            <div class="col-md-8">
              <img class="d-block w-100" src="/uploads/product_images/{{$image->image_name}}" alt="First slide">
            </div>
            @break
          @endif
        @endforeach

        @foreach ($products->product_image as $image)
          @if ($loop->first)
            @continue
          @else
            <div class="col-md-4">
              <img class="d-block w-100" src="/uploads/product_images/{{$image->image_name}}" alt="Second slide">
            </div>
          @endif
        @endforeach
      </div>
      <div class="col-md-4">
        <div class="properties-box">
          <ul class="unstyle">
            
            @if($products->discount->count())
              @php
                $harga=0;
              @endphp
              @foreach($products->discount as $diskon)
                  @if($diskon->start <= date('Y-m-d') && $diskon->end >= date('Y-m-d'))
                      <h5>Discount : -{{$diskon->percentage}}%</h5>
                      <h5>Price : </h5>
                      <span class="price">
                          <del class="edd_price">Rp.{{number_format($products->price)}}</del>
                      </span>
                      <span class="price">
                          <span class="edd_price">Rp.{{number_format($products->price * ((100 - $diskon->percentage) / 100))}}</span>
                      </span>
                      @php
                        $harga=$products->price * ((100 - $diskon->percentage) / 100);
                      @endphp
                  @else
                      <h5>Price : </h5>
                      <span class="price">
                          <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                      </span>
                      @php
                        $harga=$products->price;
                      @endphp
                  @endif
              @endforeach
            @else
                <h5>Price : </h5>
                <span class="price">
                    <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                </span>
                @php
                  $harga=$products->price;
                @endphp
            @endif

            @if(!empty($products->stock))
              <h5>Stock : {{$products->stock}}</h5>
            @else
              <h5>Stock : Out of Stock!</h5>
            @endif

            @if(!empty($products->product_rate))
              <h5>Rating : {{$products->product_rate}}</h5>
            @else
              <h5>Rating : No Rating Yet!</h5>
            @endif

            <h5>Description: </h5>
            <p>
              {{$products->description}}
            </p>
          </ul>
        </div>
        <br>
        @if (!is_null(Auth::user()))
          @if($products->stock==0)
            <button type="button" class="btn btn-primary btn-lg btn-block" disabled>Purchase</button>
            <br>
            <button type="button" class="btn btn-warning btn-lg btn-block" disabled>Add To Cart</button>
          @else
            <form action="/checkout" method="POST">
            @csrf
              <input type="hidden" name="product_id" value="{{$products->id}}" id="product_id">
              <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
              <input type="hidden" name="weight" value="{{$products->weight}}">
              <input type="hidden" name="qty" class="qty" value="1" readonly>
              <button type="submit" class="btn btn-primary btn-lg btn-block">Purchase</button>
            </form>
            <br>
            <button type="button" class="btn btn-warning btn-lg btn-block">Add To Cart</button>
          @endif
        @else
          @if($products->stock==0)
            <button type="button" class="btn btn-primary btn-lg btn-block" disabled>Purchase</button>
            <br>
            <button type="button" class="btn btn-warning btn-lg btn-block" disabled>Add To Cart</button>
          @else
            <a href="/login" class="btn btn-primary btn-lg btn-block">Purchase</a>
            <br>
            <a href="/login" class="btn btn-warning btn-lg btn-block">Add To Cart</a>
          @endif
        @endif
      </div>
    </div>
  </div>
</section>
<!--================End Single Product Area =================-->

<!--================Product Review Area =================-->
<section class="product_description_area">
  <div class="container">
    <div class="card">
      <h5>Product Reviews</h5>
      <div class="col-md-12">
        @if (!$products->product_review->count())
          <div class="text-center">    
              <p><strong>Belum ada review produk.</strong></p> 
          </div>
        @else
          @foreach ($products->product_review as $item)
            <div class="row mb-5">
              <div class="col-sm-2 col-12 mb-3">
                <img src="{{asset('/uploads/avatars/'.$item->user->profile_image)}}" style="width:100px;height:100px;object-fit:cover;" alt="sample image" class="avatar rounded-circle z-depth-1-half">
              </div>
              <div class="col-sm-10 col-12">
                <a>

                  <h5 style="color:#333333" class="user-name font-weight-bold">{{$item->user->name}} 
                  </h5>
                </a>
                <ul class="rating">
                  <li>
                    @for ($i = 0; $i < $item->rate; $i++)
                      <i class="fa fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < 5-$item->rate; $i++)
                      <i class="fa fa-star-o"></i>
                    @endfor
                  </li>  
                </ul>
                <input type="hidden" class="rate{{$loop->iteration-1}}" value="{{$item->rate}}">
                <input type="hidden" class="content{{$loop->iteration-1}}" value="{{$item->content}}">
                <input type="hidden" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
                <div class="card-data">
                  <ul class="list-unstyled mb-1">
                    <li class="comment-date font-small grey-text">
                      <i class="fa fa-clock-o"></i> {{$item->created_at}}
                    </li>
                  </ul>
                </div>
                <p class="dark-grey-text article">{{$item->content}}</p>
              </div>
            </div>
            @if ($item->response->count())
              @foreach ($item->response as $balasan)
                <div class="row mb-5" style="margin-left: 5%">
                  <div class="col-sm-2 col-12 mb-3">
                    <img src="{{asset('/uploads/avatars/'.$balasan->admin->profile_image)}}" style="width:100px;height:100px;object-fit:cover;" alt="sample image" class="avatar rounded-circle z-depth-1-half">
                  </div>
                  <div class="col-sm-10 col-12">
                    <a>
                      <h5 style="color: #333333" class="user-name font-weight-bold"><span style="margin-right:5px;" class="badge badge-success">Admin</span>{{$balasan->admin->name}}</h5>
                    </a>
                    <div class="card-data">
                      <ul class="list-unstyled mb-1">
                        <li class="comment-date font-small grey-text">
                          <i class="fa fa-clock-o"></i> {{$balasan->created_at}}
                        </li>
                      </ul>
                    </div>
                    <p class="dark-grey-text article">{{$balasan->content}}</p>
                  </div>
                </div>
              @endforeach
            @endif
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>
<!--================End Product Description Area =================-->
@endsection

@section('script')

<script>
    jQuery(document).ready(function(e){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{url('/tambah_cart')}}",
                method: 'post',
                data: {
                    product_id: jQuery('#product_id').val(),
                    user_id: jQuery('#user_id').val(),
                },
                success: function(result){
                    jQuery('#jumlahcart').text(result.jumlah);
                }
            });
        });
    });
</script>
@endsection