@php
  $jumlahproduk = 0;
  $beratawal = 0;
  $beratkali = 0;
  $beratakhir = 0;
  $hargaawal = 0;
  $hargakali = 0;
  $subtotalbaru = 0;
@endphp
<script>
	$(document).ready(function(e){

    $('.tambah').click(function(e){
      var index = $(".tambah").index(this);
      var indexbaru = index + 1;
      console.log(index);
      var cart_ids = parseInt($('.cartid'+indexbaru).val());
      console.log(cart_ids);
      var user_ids = parseInt($('.userid'+indexbaru).val());
      console.log(user_ids);
      var product_id = $('.pid'+indexbaru).val();
      console.log(product_id);
      var product_name = $('.name'+indexbaru).val();
      console.log(product_name);
      var qty = parseInt($('.qty'+indexbaru).text());
      console.log(qty);
      var stok = parseInt($('.stok'+indexbaru).val());
      console.log(stok);
      var newjumlah = parseInt(parseInt(qty)+1);
      console.log(newjumlah);
      if(parseInt(stok) >= parseInt(newjumlah)){
        $('.qty'+indexbaru).text(newjumlah);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '/updatecart',
            method: 'post',
            data: {
              action: 1,
              user_id: $('.userid'+indexbaru).val(),
              cart_id: $('.cartid'+indexbaru).val(),
            },
            success: function(result){
              $('.cartswitch').html(result.hasil);
            }
        });
      }else{
        alert("Stok Produk "+ product_name +" Hanya "+ stok +" buah");
      }
    });

    $('.kurang').click(function(e){
      var index = $(".kurang").index(this);
      var indexbaru = index + 1;
      console.log(index);
      var product_id = $('.pid'+indexbaru).val();
      console.log(product_id);
      var product_name = $('.name'+indexbaru).val();
      console.log(product_name);
      var qty = parseInt($('.qty'+indexbaru).text());
      console.log(qty);
      var stok = parseInt($('.stok'+indexbaru).val());
      console.log(stok);
      var newjumlah = parseInt(parseInt(qty)-1);
      console.log(newjumlah);
      if(0 >= parseInt(newjumlah)){
        alert("Tidak bisa mengurangi produk lagi.");
      }else{
        $('.qty'+indexbaru).text(newjumlah);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '/updatecart',
            method: 'post',
            data: {
              action: 2,
              user_id: $('.userid'+indexbaru).val(),
              cart_id: $('.cartid'+indexbaru).val(),
            },
            success: function(result){
              $('.cartswitch').html(result.hasil);
            }
        });
      }
    });

    $('.hapus').click(function(e){
      var index = $(".hapus").index(this);
      var indexbaru = index + 1;
      console.log(index);
      var product_id = $('.pid'+indexbaru).val();
      console.log(product_id);
      var product_name = $('.name'+indexbaru).val();
      console.log(product_name);
      var qty = parseInt($('.qty'+indexbaru).text());
      console.log(qty);
      var stok = parseInt($('.stok'+indexbaru).val());
      console.log(stok);
      var newjumlah = parseInt(parseInt(qty)-1);
      console.log(newjumlah);
      var konfirmasi = confirm('Apakah anda yakin ingin menghapus produk dari keranjang?');
		  if(konfirmasi == true){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/updatecart',
          method: 'post',
          data: {
            action: 3,
            user_id: $('.userid'+indexbaru).val(),
            cart_id: $('.cartid'+indexbaru).val(),
          },
          success: function(result){
            $('.cartswitch').html(result.hasil);
          }
        });
      }
    });

	});
</script>
<div id="edd_checkout_wrap" class="col-md-8 col-md-offset-2">
  <div id="edd_checkout_cart_wrap">
    <table id="edd_checkout_cart" class="ajaxed">
    <thead>
    <tr class="edd_cart_header_row">
      <th class="edd_cart_item_name">
        Item Name
      </th>
      <th class="edd_cart_item_price">
        Item Price
      </th>
      <th class="edd_cart_item_qty">
        Item Qty
      </th>
      <th class="edd_cart_item_qty">
        Action
      </th>
    </tr>
    </thead>
    <tbody>
    @foreach($cart as $products)
      <tr class="edd_cart_item" id="edd_cart_item_0_25" data-download-id="25">
        <td class="edd_cart_item_name">
          <div class="edd_cart_item_image">
              @foreach($products->product->product_image as $image)
                <img width="100" height="100" src="/uploads/product_images/{{$image->image_name}}" alt="">
                @break
              @endforeach
          </div>
          <span class="edd_checkout_cart_item_title">{{$products->product->product_name}}</span>
        </td>
        <td class="edd_cart_item_price">
          @if($products->product->discount->count())
            @foreach($products->product->discount as $diskon)
                @if($diskon->start <= date('Y-m-d') && $diskon->end >= date('Y-m-d'))
                    <span class="price">
                        <del class="edd_price">Rp.{{number_format($products->product->price)}}</del>
                    </span>
                    <span class="price">
                        <span class="edd_price">Rp.{{number_format($products->product->price * ((100 - $diskon->percentage) / 100))}}</span>
                    </span>
                    @php
                      $hargaawal = $products->product->price * ((100 - $diskon->percentage) / 100);
                      $beratawal = $products->product->weight;
                    @endphp
                @else
                    <span class="price">
                        <span class="edd_price">Rp.{{number_format($products->product->price)}}</span>
                    </span>
                    @php
                      $hargaawal = $products->product->price;
                      $beratawal = $products->product->weight;
                    @endphp
                @endif
            @endforeach
          @else
              <span class="price">
                  <span class="edd_price">Rp.{{number_format($products->product->price)}}</span>
              </span>
              @php
                $hargaawal = $products->product->price;
                $beratawal = $products->product->weight;
              @endphp
          @endif
        </td>
        <td class="edd_cart_item_qty kuantiti">
          <span class="qty{{$loop->iteration}}">{{$products->qty}}</span>
        </td>
        <td class="edd_cart_item_qty">
          <input type="hidden" class="cartid{{$loop->iteration}}" name="cartid" value="{{$products->id}}">
          <input type="hidden" class="userid{{$loop->iteration}}" name="userid" value="{{Auth::user()->id}}">
          <input type="hidden" class="stok{{$loop->iteration}}" name="stok" value="{{$products->product->stock}}">
          <input type="hidden" class="pid{{$loop->iteration}}" name="pid" value="{{$products->product->id}}">
          <input type="hidden" class="name{{$loop->iteration}}" name="name" value="{{$products->product->product_name}}">
          <button type="button" class="tambah"> + </button>
          <button type="button" class="kurang"> - </button>
          <button type="button" class="hapus"> DELETE </button>
        </td>
        @php
          $hargakali = $hargaawal * $products->qty;
          $subtotalbaru = $subtotalbaru + $hargakali;
          $beratkali = $beratawal * $products->qty;
          $beratakhir = $beratakhir + $beratkali;
          $jumlahproduk = $jumlahproduk + 1;
        @endphp
      </tr>
    @endforeach
    </tbody>
    <tfoot>
      <tr class="edd_cart_footer_row">
        <th colspan="5" class="edd_cart_total">
          Weight: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">{{$beratakhir}} Gram</span>
          || Total: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">Rp.{{number_format($subtotalbaru)}}</span>
        </th>
      </tr>
    </tfoot>
    </table>
  </div>
</div>
<div id="edd_checkout_form_wrap" class="edd_clearfix text-center">
  <fieldset id="edd_purchase_submit">
    <form action="/checkout" method="POST">
      @csrf
        @if ($subtotalbaru == 0)
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
          <button type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase" disabled>Checkout
              <i class="fa fa-angle-right right"></i>
          </button>
        @else
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
          <button type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase">Checkout
              <i class="fa fa-angle-right right"></i>
          </button>
        @endif
    </form>
    <a href="/shop">Back to Shopping</a>
  </fieldset>
</div>