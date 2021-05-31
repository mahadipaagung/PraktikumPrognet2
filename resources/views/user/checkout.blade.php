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
              <td class="edd_cart_item_qty">
                {{$qty}}
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
              <td class="edd_cart_item_qty">
                {{$products->qty}}
              </td>
              @php
                $hargakali = $hargaawal * $products->qty;
                $subtotalbaru = $subtotalbaru + $hargakali;
                $beratkali = $beratawal * $products->qty;
                $beratakhir = $beratakhir + $beratkali;
                $jumlahproduk = 2;
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
      <div id="edd_checkout_form_wrap" class="edd_clearfix">
        <form action="/beli" method="post">
          @csrf
          <fieldset id="edd_checkout_user_info">
            <legend>Personal Info</legend>
            <p id="edd-email-wrap">
              <label class="edd-label" for="edd-email">
              Email Address <span class="edd-required-indicator">*</span></label>
              <input class="edd-input required" type="email" name="inemail" placeholder="Email" id="email" value="{{Auth::user()->email}}" required>
            </p>

            <p id="edd-first-name-wrap">
              <label class="edd-label" for="edd-first">
              Name <span class="edd-required-indicator">*</span>
              </label>
              <input class="edd-input required" type="text" name="inname" placeholder="Name" id="name" value="{{Auth::user()->name}}" required>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              Phone Number <span class="edd-required-indicator">*</span>
              </label>
              <input class="edd-input" type="number" name="phonenumber" id="number" placeholder="Phone Number" value="" required>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              Address <span class="edd-required-indicator">*</span>
              </label>
              <input class="edd-input" type="address" name="inaddress" id="address" placeholder="Address" value="" required>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              Province <span class="edd-required-indicator">*</span>
              </label>
              <select name="province" id="provinsi" class="form-select dropdown_item_select ongkir" required>
                <option value="0" >-Province-</option>
                @foreach ($provinsi as $prov)
                  <option value="{{$prov->id}}">{{$prov->title}}</option>
                @endforeach
              </select>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              City <span class="edd-required-indicator">*</span>
              </label>
              <select name="regency" id="kota" class="form-select dropdown_item_select ongkir" required>
                <option value="0" >-Select Province First!-</option>
              </select>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              Courier <span class="edd-required-indicator">*</span>
              </label>
              <select name="courier" id="kurir" class="form-select dropdown_item_select ongkir" required>
                <option value="0" >-Courier-</option>
                @foreach ($kurir as $k)
                    <option value="{{$k->id}}">{{$k->courier}}</option>
                @endforeach
              </select>
            </p>

            <p id="edd-last-name-wrap">
              <label class="edd-label" for="edd-first">
              Courier Service Plan <span class="edd-required-indicator">*</span>
              </label>
              <select name="courierplan" id="courierplan" class="form-select dropdown_item_select ongkir" required>
                <option value="0" >-Select Courier First!-</option>
              </select>
            </p>
            
          </fieldset>
          <fieldset id="edd_purchase_submit">
            <p id="edd_final_total_wrap">
              <strong>Delivery:</strong>
              <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99" id="hargaongkir"></span><br>
              <strong>Purchase Total (With Delivery):</strong>
              <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99" id="totalall"></span>
            </p>
            <input id="subtotalbaru" type="hidden" name="subtotal" value="{{$subtotalbaru}}">
            <input id="beratbarang" type="hidden" name="berat" value="{{$beratakhir}}">
            <input id="jumlahproduk" type="hidden" name="jumlah" value="{{$jumlahproduk}}">
            <input id="totalakhir" type="hidden" name="total" value="">
            <input id="hargadelivery" type="hidden" name="delivery" value="">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="product_id" value="{{$product_id}}">
            <input type="hidden" name="qty" value="{{$qty}}">
            <button type="submit" class="edd-submit button" id="edd-purchase-button" name="edd-purchase" disabled>Purchase</button>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $(document).ready(function(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function rubah(angka){
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan;
    }

    $('#provinsi').change(function(e){
      var id_provinsi = $('#provinsi').val()
      if(id_provinsi>0){
        $.ajax({
          url: '/kota/'+id_provinsi,
          type: "GET",
          dataType: "json",
          success:function(data){
            $("#edd-purchase-button").prop("disabled", true);
            $('#kota').empty();
            $('#kota').append('<option value="0">-Choose Your City Destination!-</option>');
            $.each(data, function(cityid,citytitle){
              $('#kota').append('<option value="'+cityid+'">'+citytitle+'</option>');
            });
          },
        });
      }else if(id_provinsi==0){        
        $('#kota').empty();
        $('#kota').append('<option value="0">-Select Province First!-</option>');
      }
    });

    $('.ongkir').change(function(e){
      var kurir = $('#kurir').val();
      var provinsi = $('#provinsi').val();
      var kota = $('#kota').val();
      var delivery = $('#courierplan').val();
      var berat = parseInt($('#beratbarang').val());

      if(delivery == 0 || kurir == 0 || provinsi==0 || kota== 0){
        $('#hargaongkir').text("");
        $('#totalall').text("");
        $("#edd-purchase-button").prop("disabled", true);
      }

      if(kurir < 1){
        $('#courierplan').empty();
        $('#courierplan').append('<option value="0">-Select Courier First!-</option>');
        $("#edd-purchase-button").prop("disabled", true);
      }else if(delivery > 0){
        $('#hargaongkir').text('Rp.'+ rubah(delivery));
        var subtotalbaru = $('#subtotalbaru').val();
        var totalakhir = parseInt(delivery) + parseInt(subtotalbaru);
        $('#totalall').text('Rp.'+ rubah(totalakhir));
        $('#totalakhir').val(totalakhir);
        $('#hargadelivery').val(delivery);
        $("#edd-purchase-button").removeAttr('disabled');
      }else if(provinsi>0 && kurir>0 && kota>0 && delivery <= 0){
        $.ajax({
          url: '/ongkir',
          method: 'POST',
          data: {
            destination: kota,
            weight: berat,
            courier: kurir,
            prov: provinsi, 
          },
          success: function(result){
            $("#edd-purchase-button").prop("disabled", true);
            $('#courierplan').empty();
            $('#courierplan').append('<option value="0">-Choose Your Plan!-</option>');
            $.each(result, function(key, value){
              $.each(value.costs, function(key1, value1){
                $.each(value1.cost, function(key2, value2){
                  $('#courierplan').append('<option value="'+ value2.value +'">' + value1.service + '-' + value1.description + '- Rp.' +value2.value+ '</option>');
                });
              });
            });
          }
        });
      }
    });
  });
</script>
@endsection