@extends('layouts.app')

@section('content')
@php
  $hargaawal = 0;
  $hargakali = 0;
  $subtotalbaru = 0;
@endphp
<section class="item content">
  <div class="container toparea">
    <div class="underlined-title">
      <div class="editContent">
        <h1 class="text-center latestitems">MAKE PAYMENT</h1>
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
      <form id="edd_checkout_cart_form" method="post">
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
                            @endphp
                        @else
                            <span class="price">
                                <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                            </span>
                            @php
                              $hargaawal = $products->price;
                            @endphp
                        @endif
                    @endforeach
                  @else
                      <span class="price">
                          <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                      </span>
                      @php
                        $hargaawal = $products->price;
                      @endphp
                  @endif
                </td>
                <td class="edd_cart_item_qty">
                  {{$qty}}
                </td>
                @php
                  $hargakali = $hargaawal * $qty;
                  $subtotalbaru = $subtotalbaru + $hargakali;
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
                            @endphp
                        @else
                            <span class="price">
                                <span class="edd_price">Rp.{{number_format($products->product->price)}}</span>
                            </span>
                            @php
                              $hargaawal = $products->product->price;
                            @endphp
                        @endif
                    @endforeach
                  @else
                      <span class="price">
                          <span class="edd_price">Rp.{{number_format($products->product->price)}}</span>
                      </span>
                      @php
                        $hargaawal = $products->product->price;
                      @endphp
                  @endif
                </td>
                <td class="edd_cart_item_qty">
                  {{$products->qty}}
                </td>
                @php
                  $hargakali = $hargaawal * $products->qty;
                  $subtotalbaru = $subtotalbaru + $hargakali;
                @endphp
              </tr>
            @endif
          @endforeach
          </tbody>
          <tfoot>
            <tr class="edd_cart_footer_row">
              <th colspan="5" class="edd_cart_total">
                Total: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">Rp.{{number_format($subtotalbaru)}}</span>
              </th>
            </tr>
          </tfoot>
          </table>
        </div>
      
        <div id="edd_checkout_form_wrap" class="edd_clearfix">
          <fieldset id="edd_checkout_user_info">
            <legend>Personal Info</legend>
            <p id="edd-email-wrap">
              <label class="edd-label" for="edd-email">
              Email Address <span class="edd-required-indicator">*</span></label>
              <input class="edd-input required" type="email" name="edd_email" placeholder="Email" id="email" value="{{Auth::user()->email}}" required>
            </p>

            <p id="edd-first-name-wrap">
              <label class="edd-label" for="edd-first">
              Name <span class="edd-required-indicator">*</span>
              </label>
              <input class="edd-input required" type="text" name="edd_first" placeholder="Name" id="name" value="{{Auth::user()->name}}" required>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-last">
              Phone Number </label>
              <input class="edd-input" type="number" name="edd_last" id="number" placeholder="Phone Number" value="" required>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-last">
              Address </label>
              <input class="edd-input" type="address" name="edd_last" id="number" placeholder="Address" value="" required>
            </p>

            <label class="edd-label" for="edd-last">Province </label>
            <select name="province" id="provinsi" class="form-select dropdown_item_select checkout_input cekongkir" required>
              <option value="0">Province Selection</option>
              @foreach ($provinsi as $prov)
                <option value="{{$prov->id}}">{{$prov->title}}</option>
              @endforeach
            </select>

            <label class="edd-label" for="edd-last">City </label>
            <select name="province" id="provinsi" class="form-select dropdown_item_select checkout_input cekongkir" required>
              <option value="0">City Selection</option>
              <option></option>
            </select>

            <label class="edd-label" for="edd-last">Courier</label>
            <select name="courier" id="kurir" class="form-select country_select dropdown_item_select checkout_input cekongkir" required>
              <option value="0">Courier Selection</option>
              @foreach ($kurir as $k)
                  <option value="{{$k->id}}">{{$k->courier}}</option>
              @endforeach
            </select>
            
          </fieldset>
          <fieldset id="edd_purchase_submit">
            <p id="edd_final_total_wrap">
              <strong>Purchase Total (With Delivery):</strong>
              <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">$11.99</span>
            </p>
            <input type="hidden" name="edd_action" value="purchase">
            <input type="hidden" name="edd-gateway" value="manual">
            <input type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase" value="Purchase">
          </fieldset>
        
      </div>
    </form>
  </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function(e){
        function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        $('#provinsi').change(function(e){
            var id_provinsi = $('#provinsi').val()
            if(id_provinsi>0){
                jQuery.ajax({
                    url: '/kota/'+id_provinsi,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kota').empty();
                        $.each(data, function(key,value){
                            $('#kota').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kota').empty();
            }
        });

        $('.cekongkir').change(function(e){
            var kurir = $('#kurir').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var berat = parseInt($('#weight').val());
            if(provinsi>0 && kurir>0){
                jQuery.ajax({
                    url: "{{url('/ongkir')}}",
                    method: 'POST',
                    data: {
                        _token: $('#signup-token').val(),
                        destination: kota,
                        weight: berat,
                        courier: kurir,
                        prov: provinsi, 
                    },
                    success: function(result){
                        console.log(result.success);
                        console.log(result.hasil["etd"]);
                        $('#biaya-ongkir').text('Rp'+ formatNumber(result.hasil["value"]));
                        $('#ongkir').val(result.hasil["value"]);
                        $('#biaya-ongkir').append('<input type="hidden" id="biaya-ongkir" value="'+result.hasil["value"]+'">');
                        $('#total-biaya').text( formatNumber({{$subtotal}}+result.hasil["value"]));
                        $('#totalbiaya').val({{$subtotal}}+result.hasil["value"]);
                    }
                });
            }else{
                console.log('wrong');
                console.log('provinsi: '+provinsi+' Kurir: '+kurir)
            }

        });

        $('#beli').click(function(e){
          var kurir = $('#kurir').val();
          var provinsi = $('#provinsi').val();
          var kota = $('#kota').val();
          var alamat = $('#alamat').val();
          var totals = parseInt($('#total-biaya').text());
          var subtotal = parseInt('{{$subtotal}}');
          var ongkir = $('#biaya-ongkir').val();
          var user = $('#user_id').val();
          console.log(totals)
          if(totals==0){
            alert('Tolong Lengkapi Masukan Data');
            return false;
          }
        });
    });
</script>
@endsection