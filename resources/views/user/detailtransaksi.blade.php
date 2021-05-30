@extends('layouts.app')

@section('content')
<!--================Checkout Area =================-->
@if(isset($transaction))
  <section class="checkout_area section_gap">
    <div class="container toparea">
      <div class="underlined-title">
          <div class="editContent text-center">
              <h1 class="text-center latestitems">TRANSACTIONS DETAIL</h1>
              @if ($transaction->status == 'success')
                <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1"><strong>{{$transaction->status}}</strong></span>
              @elseif ($transaction->status == 'waiting approval' || $transaction->status == 'delivered' || $transaction->status == 'verified' || $transaction->status == 'indelivery')
                <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1"><strong>{{$transaction->status}}</strong></span>
              @else
                <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1"><strong>{{$transaction->status}}</strong></span>
              @endif
          </div>
          <div class="wow-hr type_short">
              <span class="wow-hr-h">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              </span>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-12 row contact_form">
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Name</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{Auth::user()->name}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Phone Number</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{$transaction->telp}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Email</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{Auth::user()->email}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Province</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{$transaction->province}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>City</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{$transaction->regency}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Address</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{$transaction->address}}"disabled/>
              </div>
            </div>
            <div class="col-md-12 form-group p_star">
              <div class="col-md-3">
                <label>Courier</label>
              </div>
              <div class="col-md-9">
                <input class="form-control" type="text" value="{{$transaction->courier->courier}}"disabled/>
              </div>
            </div>
          </div>
          
          <div class="col-lg-12">
            <div class="text-center">
              <br>
              <h1 class="text-center latestitems">ITEM DETAIL</h1>
            </div>
            <div id="edd_checkout_cart_wrap">
              <table id="edd_checkout_cart" class="ajaxed">
                <thead>
                  <tr class="edd_cart_header_row">
                    <th class="edd_cart_item_name">
                      Item Name
                    </th>
                    <th class="edd_cart_item_price">
                      Item Price (Selling Price)
                    </th>
                    <th class="edd_cart_item_qty">
                      Item Qty
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transaction->transaction_detail as $item)
                  <tr class="edd_cart_item" id="edd_cart_item_0_25" data-download-id="25">
                    <td class="edd_cart_item_name">
                      <div class="edd_cart_item_image">
                        @foreach($item->product->product_image as $image)
                          <img width="100" height="100" src="/uploads/product_images/{{$image->image_name}}" alt="">
                          @break
                        @endforeach
                      </div>
                      <span class="edd_checkout_cart_item_title">{{$item->product->product_name}}</span>
                    </td>
                    <td class="edd_cart_item_price">
                      <span class="edd_price">Rp.{{number_format($item->selling_price)}}</span>
                    </td>
                    <td class="edd_cart_item_qty">
                      <span class="edd_price">{{($item->qty)}}</span>
                    </td>
                  <tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="edd_cart_footer_row">
                    <th colspan="5" class="edd_cart_total">
                      Subtotal: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">Rp.{{number_format($transaction->sub_total)}}</span> ||
                      Delivery: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">Rp.{{number_format($transaction->shipping_cost)}}</span> ||
                      Total: <span class="edd_cart_amount" data-subtotal="11.99" data-total="11.99">Rp.{{number_format($transaction->total)}}</span><br>
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="text-center">
              <br>
              <h1 class="text-center latestitems">PAYMENT DETAIL</h1>
            </div>
            @if (is_null($transaction->proof_of_payment))
              <div class="col-md-3">
                <img width="300" height="300" src="/uploads/product_images/noimage.jpg" alt="">
              </div>
            @else
              <div class="col-md-3">
                <img width="300" height="300" src="/proof_payment/{{$transaction->proof_of_payment}}" alt="">
              </div>
            @endif
            <div class="col-md-9">
              <strong>Proof Of Payment</strong><br>
              @if ($transaction->status == 'unverified' && is_null($transaction->proof_of_payment))
                <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$transaction->id}}">
                  <input type="file" name="file" class="form-control-file" id="form19" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required><br>
                  <button type="submit" class="text-white btn btn-info btn-lg btn-block">Send Proof</button>
                </form>
              @endif
              @if (!is_null($transaction->proof_of_payment))
                <span class = "text-white btn-sm btn-success font-weight-bold btn-lg btn-block">Proof Already Uploaded</span>
                @if($transaction->status == 'rejected')
                <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$transaction->id}}">
                  <input type="file" name="file" class="form-control-file" id="form19" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required><br>
                  <button type="submit" class="text-white btn btn-info btn-lg btn-block">Upload New Proof</button>
                </form>
                @endif
              @endif
            </div>
          </div>
          <div class="text-center">
            <br>
            <h1 class="text-center latestitems">REVIEW</h1>
          </div>
          <div class="col-md-12">
          @if ($transaction->status == 'success')
            @foreach ($transaction->transaction_detail as $item)
              @php
                $status = 0;
              @endphp
              @foreach ($reviews as $review)
                @php
                  if($item->product->id == $review->product_id && $review->user_id == Auth::user()->id && $review->transaction_id == $transaction->id){
                    $status = $status + 1;
                  }
                @endphp
              @endforeach
              @if ($status == 0)
                <div class="text-center">
                  <p><strong>{{$item->product->product_name}}</strong></p>
                </div>
                <form action="/transaksi/detail/review" method="POST">
                  @csrf
                  <div class="info-icons text-center">
                    <strong>RATE</strong>
                    <br>
                    <!-- <i class="fa fa-star-o ratingproduct star1" style="font-size:48px;"></i>
                    <i class="fa fa-star-o ratingproduct star2" style="font-size:48px;"></i>
                    <i class="fa fa-star-o ratingproduct star3" style="font-size:48px;"></i>
                    <i class="fa fa-star-o ratingproduct star4" style="font-size:48px;"></i>
                    <i class="fa fa-star-o ratingproduct star5" style="font-size:48px;"></i> -->
                    <input type="number" name="rate" value="1" min="1" max="5" required>
                  </div>
                  <div class="text-center">
                    <strong>CONTENT</strong>
                    <br>
                    <input type="text" class="form-control" id="content" name="content" value="" required>
                  </div>
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <!-- <input type="hidden" name="rate" value="0"> -->
                  <input type="hidden" name="product_id" value="{{$item->product->id}}">
                  <input type="hidden" name="trans_id" value="{{$transaction->id}}">

                  <br>
                  <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Send Review ({{$item->product->product_name}})</button>
                  </div>
                  <br>
                </form>
              @else
                @foreach ($reviews as $review)
                  @if($item->product->id == $review->product_id && $review->user_id == Auth::user()->id && $review->transaction_id == $transaction->id)
                    <div class="text-center">
                      <p><strong>{{$item->product->product_name}}</strong></p>
                    </div>
                    <form action="/transaksi/detail/review" method="POST">
                      @csrf
                      <div class="info-icons text-center">
                        <strong>RATE</strong>
                        <br>
                        <!-- <i class="fa fa-star-o ratingproduct star1" style="font-size:48px;"></i>
                        <i class="fa fa-star-o ratingproduct star2" style="font-size:48px;"></i>
                        <i class="fa fa-star-o ratingproduct star3" style="font-size:48px;"></i>
                        <i class="fa fa-star-o ratingproduct star4" style="font-size:48px;"></i>
                        <i class="fa fa-star-o ratingproduct star5" style="font-size:48px;"></i> -->
                        <input type="number" name="rate" value="{{$review->rate}}" min="1" max="5">
                      </div>
                      <div class="text-center">
                        <strong>CONTENT</strong>
                        <br>
                        <input type="text" class="form-control" id="content" name="content" value="{{$review->content}}" required>
                      </div>
                      <input type="hidden" name="user_id" value="{{$review->user_id}}">
                      <!-- <input type="hidden" name="rate" value="0"> -->
                      <input type="hidden" name="product_id" value="{{$review->product_id}}">
                      <input type="hidden" name="trans_id" value="{{$transaction->id}}">

                      <br>
                      <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Update Review ({{$item->product->product_name}})</button>
                      </div>
                      <br>
                    </form>
                  @endif
                @endforeach
              @endif
            @endforeach
          @else
            <div class="text-center">
              <p><strong>Finish Your Transaction To Review!</strong></p>
            </div>
          @endif
          </div>
          
          <div class="col-md-12">
            @if ($transaction->status == 'unverified' && is_null($transaction->proof_of_payment))
              <form id="cancel" action="/transaksi/detail/status" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$transaction->id}}">
                <input type="hidden" name="status" value="1">
                <br>
                <div class="text-center">
                  <button id="tb_cancel" type="button" class="btn btn-danger btn-lg btn-block">Cancel Order</button>
                </div>
                <br>
              </form>
            @else
              @if ($transaction->status == 'delivered')
                <form id="jadi" action="/transaksi/detail/status" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{$transaction->id}}">
                  <input type="hidden" name="status" value="2">
                  <br>
                  <div class="text-center">
                    <button id="tb_jadi" type="button" class="btn btn-danger btn-lg">Finish Order</button>
                  </div>
                </form>
              @endif
            @endif
          </div>
        </div>
      </div>
      <br>
      
    </div>
  </section>
@else
  <section class="item content">
    <div class="container toparea">
      <div class="underlined-title">
        <div class="editContent">
          <h1 class="text-center latestitems">Transaction Detail Not Found!</h1>
        </div>
        <div class="wow-hr type_short">
          <span class="wow-hr-h">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          </span>
        </div>
      </div>
    </div>
  </section>
  <script>
    alert("Transaction Detail Not Found! Redirecting Back to Home.");
    window.location.href = '/';
  </script>
@endif
<!--================End Checkout Area =================-->
@endsection

@section('script')
<script>
  // $(document).ready(function(e){
  //   $('.ratingproduct').click(function(e){
  //     var index = parseInt($(".ratingproduct").index(this))+1;
  //     var indextidaak = index+1;      
  //     var i;

  //     for (i = 1; i <= index; i++) {
  //       $(".star"+i).attr("class","fa fa-star ratingproduct star"+i);
  //     }
  //     for (indexno = indextidaak; indexno<= 5; indexno++){
  //       $(".star"+indexno).attr("class","fa fa-star-o ratingproduct star"+indexno);
  //     }

  //     $("#rateval").val(index);
  //   });
  // });
  $(document).ready(function(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#tb_cancel').click(function(e){
      swal({
        title: "Are you sure to cancel this order?",
        text: "You will not be able to undo this action!",
        icon: "warning",
        buttons: [
          'No',
          'Yes!'
        ],
        dangerMode: true,
      }).then(function(isConfirm) {
        if (isConfirm) {
          $( "#cancel" ).submit();
        } else {
          swal("Order Status", "Your order is still up!", "error");
        }
      });
    });

    $('#tb_jadi').click(function(e){
      swal({
        title: "Finish This Order?",
        text: "You will not be able to undo this action!",
        icon: "warning",
        buttons: [
          'No',
          'Yes!'
        ],
        dangerMode: true,
      }).then(function(isConfirm) {
        if (isConfirm) {
          $( "#jadi" ).submit();
        } else {
          swal("Order Status", "Your order is not finished yet!", "error");
        }
      });
    });
  });
</script>
@endsection