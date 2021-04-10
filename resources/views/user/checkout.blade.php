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
          <h2>Product Checkout</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="checkout.html">Product Checkout</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <div class="row">
        <div class="col-lg-6">
          <h3>Billing Details</h3>
          <form
            class="row contact_form"
            action="#"
            method="post"
            novalidate="novalidate"
          >
            <div class="col-md-12 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                placeholder="Name"
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="number"
                name="number"
                placeholder="Phone Number"
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="email"
                name="compemailany"
                placeholder="Email Address"
              />
            </div>
            <div class="col-md-12 form-group p_star">
              <select class="country_select">
                <option value="1">Province</option>
                <option value="2">Province</option>
                <option value="4">Province</option>
              </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <select class="country_select">
                <option value="1">City</option>
                <option value="2">City</option>
                <option value="4">City</option>
              </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                placeholder="Address"
              />
            </div>
            <div class="col-md-12 form-group p_star">
              <select class="country_select">
                <option value="1">Kurir</option>
                <option value="2">Kurir</option>
                <option value="4">Kurir</option>
              </select>
            </div>
          </form>
        </div>
        <div class="col-lg-6">
          <div class="order_box">
            <h2>Your Order</h2>
            <ul class="list">
              <li>
                <a href="#"
                  >Product
                  <span>Total</span>
                </a>
              </li>
              <li>
                <a href="#"
                  >Fresh Blackberry
                  <span class="middle">x 02</span>
                  <span class="last">$720.00</span>
                </a>
              </li>
            </ul>
            <ul class="list list_2">
              <li>
                <a href="#"
                  >Subtotal
                  <span>$2160.00</span>
                </a>
              </li>
            </ul>
            <a class="main_btn" href="#">Proceed to Payment</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection