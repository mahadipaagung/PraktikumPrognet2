
<div class="col-md-9">
    @if($product->count())
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
                        @if($products->product_image->count())
                            @foreach ($products->product_image as $image)
                                <span class="maxproduct"><img src="/uploads/product_images/{{$image->image_name}}" alt=""></span>
                                @break
                            @endforeach
                        @else
                            <span class="maxproduct"><img src="/uploads/product_images/noimage.jpg" alt=""></span>
                        @endif
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
    @else
        <div class="col-md-12 text-center">
            <h1>No Product Found!</h1>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12 text-center">
        Page : {{ $product->currentPage() }} || Item Per Page : {{ $product->perPage() }} <br/>
        {{ $product->links() }}
    </div>
</div>
<script>
	//----HOVER CAPTION---//	  
	$(document).ready(function ($) {
		$('.fadeshop').hover(
			function(){
				$(this).find('.captionshop').fadeIn(150);
			},
			function(){
				$(this).find('.captionshop').fadeOut(150);
			}
		);
	});
</script>