@extends('layouts.app')

@section('content')
    <section class="item content">
        <div class="container toparea">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems">OUR PRODUCTS</h1>
                </div>
                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h6 class="title">Search Product Name</h6>
                            <input type="text" id="prodname" name="product_name" placeholder="Product Name" value="">
                            <input type="button" id="prodnametombol" value="Search">
                        </div>
                    </div>
                    <br>
                    <div class="row text-center">
                        <h6 class="title">Categories</h6>
                        <div class="col-md-12">
                            <button type="button" name="category_id" value="0" class="btn default btn-block btnctgry">All Products</button>
                            <br>
                            @foreach ($categories as $category)
                                <button type="button" value="{{$category->id}}" class="btn default btn-block btnctgry">{{$category->category_name}}</button>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="filterswitch">
                    <div class="col-md-9">
                    @if($products->count())
                        @foreach ($products as $product)
                            <div class="col-md-4">
                                <div class="productbox">
                                    <div class="fadeshop">
                                        <div class="captionshop text-center" style="display: none;">
                                            <h3>{{$product->product_name}}</h3>
                                            <p>
                                                <a href="/product/{{$product->slug}}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
                                            </p>
                                        </div>
                                        @if($product->product_image->count())
                                            @foreach ($product->product_image as $image)
                                                <span class="maxproduct"><img src="/uploads/product_images/{{$image->image_name}}" alt=""></span>
                                                @break
                                            @endforeach
                                        @else
                                            <span class="maxproduct"><img src="/uploads/product_images/noimage.jpg" alt=""></span>
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <a href="/product/{{$product->slug}}">
                                            <h1>{{$product->product_name}}</h1>
                                        </a>
                                        @if($product->stock==0)
                                            <h4>Out of Stock!</h4>
                                        @endif

                                        @if($product->discount->count())
                                            @foreach($product->discount as $diskon)
                                                @if($diskon->start <= date('Y-m-d') && $diskon->end >= date('Y-m-d'))
                                                    <h4>-{{$diskon->percentage}}%</h4>
                                                    <span class="price">
                                                        <del class="edd_price">Rp.{{number_format($product->price)}}</del>
                                                    </span>
                                                    <span class="price">
                                                        <span class="edd_price">Rp.{{number_format($product->price * ((100 - $diskon->percentage) / 100))}}</span>
                                                    </span>
                                                @else
                                                    <span class="price">
                                                        <span class="edd_price">Rp.{{number_format($product->price)}}</span>
                                                    </span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="price">
                                                <span class="edd_price">Rp.{{number_format($product->price)}}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="col-md-12 text-center">
                            <h1>No Product Found!</h1>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">
                            Page : {{ $products->currentPage() }} || Item Per Page : {{ $products->perPage() }} <br/>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CALL TO ACTION =============================-->
    <section class="content-block" style="background-color:#00bba7;">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="item" data-scrollreveal="enter top over 0.4s after 0.1s">
                        <h1 class="callactiontitle"> Promote Items Area Give Discount to Buyers <span class="callactionbutton"><i class="fa fa-gift"></i> WOW24TH</span>
                        </h1>
                    </div>
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

        console.log($('.page-link').attr("href"));

        $('#prodnametombol').click(function(e){
            var index = $('#prodnametombol').val();
            console.log($('#prodname').val());
            $.ajax({
                url: '/shop/search',
                method: 'get',
                data: {
                    product_name: $('#prodname').val(),
                },
                success: function(result){
                    $('.filterswitch').html(result.hasil);
                }
            });
        });

        $('.btnctgry').click(function(e){
            var index = parseInt($('.btnctgry').index(this));
            console.log($('.btnctgry').index(this));
            $.ajax({
                url: '/shop/category',
                method: 'get',
                data: {
                    category_id: $('.btnctgry').index(this),
                },
                success: function(result){
                    $('.filterswitch').html(result.hasil);
                    
                }
            });
        });
    });
  </script>
@endsection