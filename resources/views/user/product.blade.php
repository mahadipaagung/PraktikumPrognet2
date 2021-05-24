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
              <input type="hidden" name="product_id" value="{{$products->id}}">
              <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
              <input type="hidden" name="weight" value="{{$products->weight}}">
              <input type="hidden" name="qty" class="qty" value="1" readonly>
              <button type="submit" class="btn btn-primary btn-lg btn-block">Purchase</button>
            </form>
            <br>
            <form action="/addcart" method="POST">
            @csrf
              <input type="hidden" name="product_id" value="{{$products->id}}">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="user_id">
              <input type="hidden" name="qty" class="qty" value="1" readonly>
              <button type="submit" class="btn btn-warning btn-lg btn-block">Add To Cart</button>
            </form>
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
<section>
  <div class="item content">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">
        <div class="slide-text">
          <div>
            <h2><span class="uppercase">Awesome Support</span></h2>
            <img src="http://wowthemes.net/demo/salique/salique-boxed/images/temp/avatar2.png" alt="Awesome Support">
            <p>
              The support... I can only say it's awesome. You make a product and you help people out any way you can even if it means that you have to log in on their dashboard to sort out any problems that customer might have. Simply Outstanding!
            </p>
            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Product Description Area =================-->
@endsection

@section('script')

<script>
  $(document).ready(function(e){
    $('#ajaxSubmit').click(function(e){
      e.preventDefault();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{url('/tambah_cart')}}",
        method: 'post',
        data: {
            product_id: $('#product_id').val(),
            user_id: $('#user_id').val(),
        },
        success: function(result){
            jQuery('#jumlahcart').text(result.jumlah);
        }
      });
    });
  });
</script>
@endsection