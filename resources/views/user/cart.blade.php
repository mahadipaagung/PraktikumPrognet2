@extends('layouts.app')

@section('content')
@php
  $jumlahproduk = 0;
  $beratawal = 0;
  $beratkali = 0;
  $beratakhir = 0;
  $hargaawal = 0;
  $hargakali = 0;
  $subtotalbaru = 0;
@endphp
<section class="item content">
  <div class="container toparea">
    <div class="underlined-title">
      <div class="editContent">
        <h1 class="text-center latestitems">YOUR CART</h1>
      </div>
      <div class="wow-hr type_short">
        <span class="wow-hr-h">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        </span>
      </div>
    </div>
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
          @if (is_null($products->product))
            <tr class="edd_cart_item" id="edd_cart_item_0_25" data-download-id="25">
              <td class="edd_cart_item_name">
                <div class="edd_cart_item_image">
                    @foreach($products->product_image as $image)
                      <img width="100" height="100" src="/uploads/product_images/{{$image->image_name}}" alt="">
                      @break
                    @endforeach
                </div>
                <span class="edd_checkout_cart_item_title">{{$products->product_name}}</span>
              </td>
              <td class="edd_cart_item_price">
                @if($products->discount->count())
                  @foreach($products->discount as $diskon)
                      @if($diskon->start <= date('Y-m-d') && $diskon->end >= date('Y-m-d'))
                          <span class="price">
                              <del class="edd_price">Rp.{{number_format($products->price)}}</del>
                          </span>
                          <span class="price">
                              <span class="edd_price">Rp.{{number_format($products->price * ((100 - $diskon->percentage) / 100))}}</span>
                          </span>
                          @php
                            $hargaawal = $products->price * ((100 - $diskon->percentage) / 100);
                            $beratawal = $products->weight;
                          @endphp
                      @else
                          <span class="price">
                              <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                          </span>
                          @php
                            $hargaawal = $products->price;
                            $beratawal = $products->weight;
                          @endphp
                      @endif
                  @endforeach
                @else
                    <span class="price">
                        <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                    </span>
                    @php
                      $hargaawal = $products->price;
                      $beratawal = $products->weight;
                    @endphp
                @endif
              </td>
              <td class="edd_cart_item_qty kuantiti">
                {{$qty}}
              </td>
              <td class="edd_cart_item_qty">
                <i class="fa fa-plus-circle" aria-hidden="true" onclick="plus({{$products->id}})"></i>
                <i class="fa fa-minus-circle" aria-hidden="true" onclick="minus({{$products->id}})"></i>
                <i class="fa fa-trash" aria-hidden="true" onclick="hapus({{$products->id}})"></i>
              </td>
              @php
                $hargakali = $hargaawal * $qty;
                $subtotalbaru = $subtotalbaru + $hargakali;
                $beratkali = $beratawal * $qty;
                $beratakhir = $beratakhir + $beratkali;
                $jumlahproduk = $jumlahproduk + 1;
              @endphp
            </tr>
          @else
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
                {{$products->qty}}
              </td>
              <td class="edd_cart_item_qty">
                <i class="fa fa-plus-circle" aria-hidden="true" onclick="plus({{$products->id}})"></i>
                <i class="fa fa-minus-circle" aria-hidden="true" onclick="minus({{$products->id}})"></i>
                <i class="fa fa-trash" aria-hidden="true" onclick="hapus({{$products->id}})"></i>
              </td>
              @php
                $hargakali = $hargaawal * $products->qty;
                $subtotalbaru = $subtotalbaru + $hargakali;
                $beratkali = $beratawal * $products->qty;
                $beratakhir = $beratakhir + $beratkali;
                $jumlahproduk = $jumlahproduk + 1;
              @endphp
            </tr>
          @endif
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
</section>
@endsection

@section('after-script')
<script>
	$(document).ready(function(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function minus(id){
      var qty = $('.kuantiti').val();
      var qtybaru = $('.kuantiti').val() + 1;
      $('.kuantiti').text(qtybaru);
    }

    function plus(id){
      var qty = $$('.kuantiti').val();
      if (qty==1){
        var qtybaru = $$('.kuantiti').val() - 1;
        $('.kuantiti').text(qtybaru);
      }
    }

    function hapus(id){
      
    }

	});
</script>
@endsection