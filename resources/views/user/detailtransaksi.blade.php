@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
  <!-- Start All Title Box -->
  <div class="all-title-box">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <h2>Cek Detail Transaksi</h2>
                  <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">User</a></li>
                      <li class="breadcrumb-item active">Detail Transaksi</li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- End All Title Box -->
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <h3>Billing Details</h3>
      <div class="row">
        <div class="col-lg-6 row contact_form">
          <div class="col-md-12 form-group p_star">
            <label>Nama</label>
            <input
              type="text"
              class="form-control text-dark"
              id="name"
              name="name"
              placeholder="Name"
              value="{{Auth::user()->name}}"disabled
            />
          </div>
          <div class="col-md-6 form-group p_star">
            <label>No Telp</label>
            <input
              type="text"
              class="form-control text-dark"
              value="{{$transaksi->telp}}"disabled
            />
          </div>
          <div class="col-md-6 form-group p_star">
            <label>Email</label>
            <input
              type="text"
              class="form-control text-dark"
              id="email"
              name="compemailany"
              placeholder="Email Address"
              value="{{Auth::user()->email}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Provinsi</label>
            <input
              type="text"
              class="form-control text-dark"
              name="compemailany"
              value="{{$transaksi->province}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Kota</label>
            <input
              type="text"
              class="form-control text-dark"
              name="compemailany"
              value="{{$transaksi->regency}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Alamat</label>
            <input
              type="text"
              class="form-control text-dark"
              id="address"
              name="address"
              value="{{$transaksi->address}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Kurir</label>
            <input
              type="text"
              class="form-control text-dark"
              value="{{$transaksi->courier->courier}}"disabled
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="order_box">
            <h2>Your Order</h2>
            <ul class="list">
              @php
                if($transaksi->status == 'unverified' && !is_null($transaksi->proof_of_payment))
                {$transaksi->status = 'Menunggu Verifikasi';}
              @endphp
              <li>
                <a href="#">
                  Status
                  @if ($transaksi->status == 'success')
                    <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1">{{$transaksi->status}}</span>
                  @elseif ($transaksi->status == 'Menunggu Verifikasi' || $transaksi->status == 'delivered' || $transaksi->status == 'verified' || $transaksi->status == 'indelivery')
                    <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1">{{$transaksi->status}}</span>
                  @else
                    <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1">{{$transaksi->status}}</span>
                  @endif
                </a>
              </li>
              @foreach ($transaksi->transaction_detail as $item)
              <li>
                <a href="#">
                <input type="hidden" name="id" id="product_id{{$loop->iteration-1}}" value="{{$item->product->id}}">
                {{$item->product->product_name}}<span class="middle">x {{$item->qty}}</span>
                <span>Rp{{number_format($item->selling_price*(100-$item->discount)/100)}}</span>
                @if ($transaksi->status == 'success')
              <div>
                  @php
                      $status = 0;
                  @endphp
                  @foreach ($review as $pr)
                       @php
                           if($item->product->id == $pr->product_id){
                              $status = $status + 1;
                           }else{
                              $status = $status;
                           }
                       @endphp
                  @endforeach
                  @if ($status != 0)
                      
                      <button class="btn btn-sm btn-success tambah-review" data-toggle="modal" data-target="#modalTambahReview" disabled>Review telah diberikan</button>
                      
                  @else
                      <button class="btn btn-sm btn-success tambah-review" data-toggle="modal" data-target="#modalTambahReview">+Tambah Review</button>
                      
                  @endif
              </div>    
              @endif
                </a>
              </li>
              @endforeach
              <li>
                <a href="#"
                  >Sub Total
                  <span>Rp{{number_format($transaksi->sub_total)}}</span>
                </a>
              </li>
              <li>
                <a href="#"
                  >Shipping
                  <span>Rp{{number_format($transaksi->shipping_cost)}}</span>
                </a>
              </li>
            </ul>
            <ul class="list list_2">
              <li>
                <a href="#"
                  >Total
                  <span class = "font-weight-bold">Rp{{number_format($transaksi->total)}}</span>
                </a>
              </li>
              <li>
                <a href="">
                  Proof Of Payment
                  @if (is_null($transaksi->proof_of_payment) && $transaksi->status == 'unverified')
                    <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="file" name="file" id="form19" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required>
                      <span> 
                        <button type="submit" class="text-white btn btn-info font-weight-bold  mt-2">Send</button>
                      </span>
                    </form>
                  @elseif ($transaksi->proof_of_payment)
                    <span class = "text-white btn-sm btn-success font-weight-bold  mt-2">Sudah diupload</span>
                  @endif
                </a>
              </li>
              <li>
                @if ($transaksi->status == 'unverified' && is_null($transaksi->proof_of_payment))
                  <div class="d-flex justify-content-center mt-5">
                    <form action="/transaksi/detail/status" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="hidden" name="status" value="1">
                      <button style="color:white;margin-left:10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa yakin ingin membatalkan pesanan ini?')">Batalkan Pesanan</button>
                    </form>
                  </div>  
                @else
                  @if ($transaksi->status == 'delivered')
                  <a href="">
                    <form action="/transaksi/detail/status" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="hidden" name="status" value="2">
                      <span><button type="submit" class="text-white btn-sm btn-primary font-weight-bold  mt-2">Pesanan Sudah Sampai</button></span>
                    </form>
                  </a>
                  @endif
                @endif
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalTambahReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
      <!-- Content -->
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header light-blue darken-3 white-text">
          <h4 class="">Tambah Rating dan Review Produk</h4>
          <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Body -->
        <div class="modal-body mb-0">
            <input type="hidden" name="product_id" id="product_id" value="">
            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
          <div class="md-form form-sm">
            Masukkan Rate untuk Produk
            <select name="rate" id="rate" class="form-control form-control-sm">
              @for ($i = 0; $i < 6; $i++)
              <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
          <br><br>
          <div class="md-form form-sm">
            <textarea type="text" id="content" class="md-textarea form-control form-control-sm" rows="3" required></textarea>
          </div>
          <br><br>
          <div class="text-center mt-1-half">
            <button type="submit" class="btn btn-info mb-2" id="kirim-review">Send</button>
          </div>
        </div>
      </div>
      <!-- Content -->
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('script')
<script>
  $(document).ready(function(e){
       $(".tambah-review").click(function(e){
        var index = $(".tambah-review").index(this);
        var product_id = $("#product_id"+index).val();
        $("#product_id").val(product_id);
      });

      $("#kirim-review").click(function(e){
        jQuery.ajax({
              url: "{{url('/transaksi/detail/review')}}",
              method: 'post',
              data: {
                  _token: $('#signup-token').val(),
                  product_id: $("#product_id").val(),
                  user_id: $("#user_id").val(),
                  rate: $("#rate").val(),
                  content: $("#content").val(),
              },
              success: function(result){
                $('#modalTambahReview').modal('hide');
                alert('Berhasil Menambah Review');
                location.reload();
              }
          });
      });    
  });
</script>
@endsection