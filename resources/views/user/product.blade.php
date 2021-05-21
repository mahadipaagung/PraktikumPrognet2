@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Detail Produk</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Produk</a></li>
                        <li class="breadcrumb-item active">Detail Produk </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <!-- Product Image -->
        <div class="col-lg-12">
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
                    <div style="background-color:red;" class="product_extra product_new"><a href="#">-{{$disc}}%</a></div>
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
      <div class="col-lg-6">
        <div class="single-product-details">
          <h3 style="color:Black;"><strong>{{$products->product_name}}</strong></h3>
          @php
            $home = new Home;
            $harga = $home->diskon($products->discount,$products->price);
          @endphp
          @if ($harga != 0)
            <del><h4>Rp{{number_format($products->price)}}</h4></del>
            <h2>Rp{{number_format($harga)}}</h2>
          @else
            <h2>Rp{{number_format($products->price)}}</h2>
          @endif
          @if (!empty($products->product_rate))
            <strong style="color:Black;">Rating    : </strong><strong style="color:Red;">{{($products->product_rate)}}</strong><br>
          @else
          <strong style="color:Black;">Rating    : </strong><strong style="color:Red;">Belum Ada Rating</strong><br>
          @endif
            <strong style="color:Black;">Ketersediaan    :</strong>
          @if ($products->stock <= 0)
            <span style="color:red;"><strong>Stok Kosong!</strong></span>
          @else
            @if ($products->stock <= 5) 
              <span style="color:red;"><strong>Barang Langka!</strong></span> <br>
              <span style="color:black;">Hanya {{$products->stock}} tersisa!</span>
            @else
              <span style="color:Green;"><strong>Ada</strong></span> <br>
              <span style="color:black;">{{$products->stock}} barang</span>
            @endif
          @endif
          <p>{{$products->description}}</p>
          <div class="card_area">
            <div class="product_quantity_container">
              @if (is_null(Auth::user()))
                @if ($products->stock < 1)
                  <button class="btn btn-danger mr-2" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Beli Langsung</button>
                  <button class="btn btn-secondary" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Tambah ke Keranjang</button>
                @else
                  <a href="/login" class="btn btn-danger mr-2"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Beli Langsung</a>
                  <a href="/login" class="btn btn-secondary"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Tambah ke Keranjang</a>
                @endif
              @else
                @if ($products->stock < 1)
                  <button class="btn btn-danger mr-2" class="tombol1" disabled>
                    <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> Beli Langsung
                  </button>
                  <button class="btn btn-secondary" id="ajaxSubmit" disabled>
                    <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Tambah ke Keranjang
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
                        <button type="submit" class="btn btn-danger mr-2" class="tombol1">
                          <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Beli Langsung
                        </button>
                      </form>
                    </td>
                    <td>
                      <input type="hidden" value="{{$products->id}}" id="product_id">
                      <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                      <button class="btn btn-secondary" id="ajaxSubmit">
                        <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Tambah ke Keranjang
                      </button>
                    </td>
                  </table>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
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