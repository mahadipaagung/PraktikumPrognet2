@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div
        class="banner_content d-md-flex justify-content-between align-items-center"
      >
        <div class="mb-3 mb-md-0">
          <h2>Transaction</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="#">Transaction</a>
        </div>
      </div>
    </div>
  </div>
</section>
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
                <strong>Jatuh Tempo Pembayaran</strong>
              </th>
              <th>
                <strong>ID Transaksi</strong>
              </th>
              <th>
                <strong>Alamat</strong>
              </th>
              <th>
                <strong>Kota</strong>
              </th>
              <th>
                  <strong>Provinsi</strong>
              </th>
              <th>
                  <strong>Total Pembayaran</strong>
              </th>
              <th>
                  <strong>Status</strong>
              </th>
              <th>
                <strong>Opsi</strong>
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- single transaction -->
            <tr>
              <td>
                <p>Minimalistic shop for</p>
              </td>
              <td>
                <h5>1</h5>
              </td>
              <td>
                  Gang Bima no 7 Buruan
              </td>
              <td>
                <h5>Gianyar</h5>
              </td>
              <td>
                <h5>Bali</h5>
              </td>
              <td>
                  Rp.7000000
              </td>
              <td>
                <h5>inistatus</h5>
              </td>
              <td>
                <h5>detail</h5>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection