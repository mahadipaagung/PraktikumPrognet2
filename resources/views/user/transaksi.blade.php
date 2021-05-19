@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
  <!-- Start All Title Box -->
  <div class="all-title-box">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <h2>Cek Riwayat Transaksi</h2>
                  <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">User</a></li>
                      <li class="breadcrumb-item active">Transaksi</li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- End All Title Box -->
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="cart_area">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>
                <strong style="color:Red;">Sisa Waktu Bayar</strong>
              </th>
              <th>
                <strong style="color:Red;">ID Transaksi</strong>
              </th>
              <th>
                <strong style="color:Red;">Alamat</strong>
              </th>
              <th>
                <strong style="color:Red;">Kota</strong>
              </th>
              <th>
                  <strong style="color:Red;">Provinsi</strong>
              </th>
              <th>
                  <strong style="color:Red;">Total Pembayaran</strong>
              </th>
              <th>
                  <strong style="color:Red;">Status</strong>
              </th>
              <th>
                <strong style="color:Red;">Aksi</strong>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksi as $item)
              <tr> 
                <td>
                  @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s') & is_null($item->proof_of_payment))
                    @php
                      date_default_timezone_set("Asia/Makassar");
                      $date1 = new DateTime($item->timeout);
                      $date2 = new DateTime(date('Y-m-d H:i:s'));
                      $tenggat = $date1->diff($date2);
                    @endphp
                      <span class="btn-sm btn-warning font-weight-bold">{{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                  @endif
                </td>               
                <td>
                    <strong style="color:Black;">{{$item->id}}</strong>
                </td>
                <td>
                    <strong style="color:Black;">{{$item->address}}</strong>
                </td>
                <td>
                    <strong style="color:Black;">{{$item->regency}}</strong>
                </td>
                <td>
                    <strong style="color:Black;">{{$item->province}}</strong>
                </td>
                <td>
                    <strong style="color:Black;">Rp{{number_format($item->total)}}</strong>
                </td>
                <td>
                  @if ($item->status == 'success')
                    <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1">{{$item->status}}</span>
                  @elseif ($item->status == 'delivered' || $item->status == 'verified' || $item->status == 'indelivery')
                    <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1">{{$item->status}}</span>
                  @else
                    <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1">{{$item->status}}</span>
                  @endif
                </td>
                <td>
                  <a href="/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection