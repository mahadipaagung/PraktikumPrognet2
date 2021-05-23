@extends('layouts.app')

@section('content')
@php
	$total = 0;
@endphp 
<!--================Cart Area =================-->
<section class="cart_area ganti">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <!-- single product -->
            @forelse ($cart as $isi)
            <tr>
              <td>
                <div class="media">
                  <input type="hidden" class="id_cart{{$loop->iteration-1}}" value="{{$isi->id}}">
                  <input type="hidden" id="user_id" value="{{$isi->user_id}}">
                  <input type="hidden" class="stock{{$loop->iteration-1}}" value="{{$isi->product->stock}}">
                  @foreach ($isi->product->product_image as $image)
                  <img class="w-25" src="/uploads/product_images/{{$image->image_name}}" alt="">
                  @break
							    @endforeach
                  <div class="media-body">
                    <p>{{$isi->product->product_name}}</p>
                  </div>
                </div>
              </td>
              <td>
                @php
                  $home = new Home;
                  $harga = $home->diskon($isi->product->discount,$isi->product->price);
                @endphp
                @if ($harga != 0)
                  <div class="cart_item_price">
                    Rp<span class="float-lef grey-text">{{number_format($harga)}}</li>
                    Rp<span class="float-lef grey-text"><small><s>{{number_format($isi->product->price)}}</s></small></span>
                    <span class="hide float-lef grey-text price{{$loop->iteration-1}}">{{$harga}}</li>
                  </div>
                @else
                  <div class="cart_item_price">
                    Rp<span class="float-lef grey-text">{{number_format($isi->product->price)}}</li>
                    <span class="hide float-lef grey-text price{{$loop->iteration-1}}">{{$isi->product->price}}</li>
                  </div>
                @endif
              </td>
              <td>
                <p class="text-danger" style="display:none" id="notif{{$loop->iteration-1}}"></p>
                
                <div class="btn-group radio-group ml-2" data-toggle="buttons">
                  <span class="qty{{$loop->iteration-1}} mr-3">{{$isi->qty}} </span>
                  <button class="btn btn-sm btn-primary btn-rounded tombol-kurang">-
                  </button>
        
                  <button class="btn btn-sm btn-success btn-rounded tombol-tambah" >+
                  </button>

                  <button type="button" class="fa fa-trash btn btn-sm btn-danger tombolhapus" data-toggle="tooltip" data-placement="top" title="Remove item">
                </div>
              </td>
              <td>
                @if ($harga != 0)
                  <strong>Rp</strong><strong class="cart_item_total sub-total{{$loop->iteration-1}}">{{number_format($harga*$isi->qty)}}</strong>
                  @php
                    $total = $total + ($harga*$isi->qty);
                  @endphp
                @else
                  <strong>Rp</strong><strong class="cart_item_total sub-total{{$loop->iteration-1}}">{{number_format($isi->product->price*$isi->qty)}}</strong>
                  @php
                    $total = $total + ($isi->product->price*$isi->qty);
                  @endphp
                @endif
              </td>
            </tr>
            @empty
            <tr>
            <td colspan="4" style="text-align:center">
				      <p class="fa fa-shopping-cart m-auto" style="font-size:50px;"><br><br>Cart Kosong!</p>
              </td>
            </tr>
            @endforelse
            <!-- end single product -->
            <tr>
              <td></td>
              <td></td>
              <td>
                <h5>Subtotal</h5>
              </td>
              <td>
                <span class="font-weight-bold text-dark">Rp</span><span class="totalShow font-weight-bold text-dark">{{number_format($total)}}</span>
                <h5 class="hide total">{{$total}}</h5>
                <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
              </td>
            </tr>
            <tr><td></td>
              <td></td><td></td>
              <td></td></tr>
          </tbody>
        </table>
        <div class="d-flex flex-row-reverse">
        <div class="checkout_btn_inner">
          <form action="/checkout" method="POST">
            @csrf
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="sub_total" id="hiddentotalpost" value="{{$total}}">
              @if ($total == 0)
                <button type="submit" class="btn btn-danger" disabled>Lanjut Pembayaran
                    <i class="fa fa-angle-right right"></i>
                </button>
              @else
                <button type="submit" class="btn btn-danger">Lanjut Pembayaran
                    <i class="fa fa-angle-right right"></i>
                </button>
              @endif
          </form>
        </div>
        <a href="/home" class="gray_btn mx-3">Kembali Berbelanja</a>
      </div>
    </div>
  </div>
</section>
<!--================End Cart Area =================-->
@endsection

@section('script')
<script>
	jQuery(document).ready(function(e){
    $(".hide").hide();
    
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

		jQuery('.tombol-tambah').click(function(e){
      var index = $(".tombol-tambah").index(this);
		  var jumlah = $(".qty"+index).text();
		  var jumlah = parseInt(jumlah)+1
		  $(".qty"+index).text(jumlah);
		  var price = $('.price'+index).text();
		  console.log('price: '+price);
  
		  if(parseInt(jumlah) > parseInt($(".stock"+index).val())){
			  $("#notif"+index).css('display','inline');
			  $("#notif"+index).text('Jumlah stock melebihi stock produk');
			  $("#notif"+index).append('<br>');
			  $(".qty"+index).text(jumlah-1);
		  }else{
        var subtotal = parseInt(jumlah)*parseInt(price);
        console.log('subtotal: ', + subtotal)
        $(".sub-total"+index).text(formatNumber(subtotal));
        var total = parseInt($(".total").text());
        total = total + parseInt(price);
        $(".total").text(total);
        $(".totalShow").text(formatNumber(total));
        $("#notif"+index).css('display','none');
  
        jQuery.ajax({
          url: "{{url('/update_qty')}}",
          method: 'post',
          data: {
            _token: $('#signup-token').val(),
            id: $('.id_cart'+index).val(),
            qty: 1
          },
          success: function(result){
            location.reload();
            console.log(result.success);
          }
        });
		  }
		});
  
		jQuery('.tombol-kurang').click(function(e){
		  var index = $(".tombol-kurang").index(this);
		  var jumlah = $(".qty"+index).text();
		  var jumlah = parseInt(jumlah)-1
		  $(".qty"+index).text(jumlah);
		  var price = $('.price'+index).text();
		  console.log('price: '+price);
  
		  if(parseInt(jumlah) == 0){
			  $("#notif"+index).css('display','inline');
			  $("#notif"+index).text('Tolong stock tidak boleh 0');
			  $("#notif"+index).append('<br>');
			  $(".qty"+index).text(1);
		  }else{
			var subtotal = parseInt(jumlah)*parseInt(price);
			console.log('subtotal: ', + subtotal)
			$(".sub-total"+index).text(formatNumber(subtotal));   
			var total = parseInt($(".total").text());
			total = total - parseInt(price);
			$(".total").text(total);
      $(".totalShow").text(formatNumber(total));
			$("#notif"+index).css('display','none');
			jQuery.ajax({
				url: "{{url('/update_qty')}}",
				method: 'post',
				data: {
					_token: $('#signup-token').val(),
					id: $('.id_cart'+index).val(),
					qty: -1
				},
				success: function(result){
          location.reload();
					console.log(result.success);
				}
			});
		  }
		});
  
		jQuery('.tombolhapus').click(function(e){
		  var index = $(".tombolhapus").index(this);
		  var konfirmasi = confirm('Apakah anda yakin ingin menghapus produk dari keranjang?');
		  if(konfirmasi == true){
			jQuery.ajax({
				url: "{{url('/update_qty')}}",
				method: 'post',
				data: {
					_token: $('#signup-token').val(),
					id: $('.id_cart'+index).val(),
					user_id: $('#user_id').val(),
					qty: 0
				},
				success: function(result){
					$('.ganti').html(result.hasil);
          location.reload();
					jQuery('#jumlahcart').text(result.jumlah);
					console.log(result.success);
				}
			});
		  }
		});
	});
  </script>
@endsection