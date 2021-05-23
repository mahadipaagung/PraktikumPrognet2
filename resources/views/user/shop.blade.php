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
                            <form action="/shop/search" method="GET">
                                <input type="text" name="product_name" placeholder="Product Name" value="">
                                <input type="submit" value="Search">
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row text-center">
                        <h6 class="title">Categories</h6>
                        <div class="col-md-12">
                            <form action="/shop/category" method="GET">
                                <button type="submit" name="category_id" value="all_categories" class="btn default btn-block">All Products</button>
                            </form>
                            <br>
                            @foreach ($category as $categories)
                                @if ($categories->product->count())
                                    <form action="/shop/category" method="GET">
                                        <button type="submit" name="category_id" value="{{$categories->id}}" class="btn default btn-block">{{$categories->category_name}}</button>
                                    </form>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="filterswitch">
                    <div class="col-md-9">
                        @foreach ($product as $products)
                            <div class="col-md-4">
                                <div class="productbox">
                                    <div class="fadeshop">
                                        <div class="captionshop text-center" style="display: none;">
                                            <h3>{{$products->product_name}}</h3>
                                            <p>
                                                <a href="/product/{{$products->id}}" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
                                            </p>
                                        </div>
                                        @foreach ($products->product_image as $image)
                                            <span class="maxproduct"><img src="/uploads/product_images/{{$image->image_name}}" alt=""></span>
                                            @break
                                        @endforeach
                                    </div>
                                    <div class="product-details">
                                        <a href="/product/{{$products->id}}">
                                            <h1>{{$products->product_name}}</h1>
                                        </a>
                                        @if($products->stock==0)
                                            <h4>Out of Stock!</h4>
                                        @endif

                                        @if($products->discount->count())
                                            @foreach($products->discount as $diskon)
                                                @if($diskon->start <= date('Y-m-d') && $diskon->end >= date('Y-m-d'))
                                                    <h4>-{{$diskon->percentage}}%</h4>
                                                    <span class="price">
                                                        <del class="edd_price">Rp.{{number_format($products->price)}}</del>
                                                    </span>
                                                    <span class="price">
                                                        <span class="edd_price">Rp.{{number_format($products->price * ((100 - $diskon->percentage) / 100))}}</span>
                                                    </span>
                                                @else
                                                    <span class="price">
                                                        <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                                                    </span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="price">
                                                <span class="edd_price">Rp.{{number_format($products->price)}}</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                Page : {{ $product->currentPage() }} || Item Per Page : {{ $product->perPage() }} <br/>
                {{ $product->links() }}
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