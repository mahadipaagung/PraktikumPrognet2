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
</div>
<div class="row">
    <div class="col-md-12 text-center">
        Page : {{ $products->currentPage() }} || Item Per Page : {{ $products->perPage() }} <br/>
        {{ $products->links() }}
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