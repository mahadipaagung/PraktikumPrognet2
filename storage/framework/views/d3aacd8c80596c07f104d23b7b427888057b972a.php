
<?php $__env->startSection('page-contents'); ?>
<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>PHONE STORE</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="services">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
            <?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="col-md-7">
             <div>
                <img src="<?php echo e(asset('product_images/'.$image->image_name)); ?>" alt class="img-fluid wc-image">
                    <div class="single-gallery-image" style="background: url(<?php echo e(asset('product_images/'.$image->image_name)); ?>);"></div>
                </=>
                </div>
		    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <br>
        </div>
        <div class="col-md-5 col-3">
          <div class="sidebar-item recent-posts">
          <h4><?php echo e($product->product_name); ?></h4>
            <p>
                <?php echo e($product->description); ?>

            </p>
            <br>
            <br>
            <form action="" method="post">
                <?php echo csrf_field(); ?>
            <div class="card_area">
                <div class="product_count_area">
                    <p>Quantity</p>
                    <input type="text" name="user_id" value="<?php echo e($user->id); ?>" hidden />
                    <input type="text" name="product_id"  value="<?php echo e($product->id); ?>" hidden />
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                        <input class="product_count_item input-number" name="qty" type="text" value="1" min="0" max="10">
                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                    </div>
                <p>Rp. <?php echo e(number_format($product->price)); ?></p>
                </div>
                <br>
              <div class="form-group">
                  <a href="#" class="filled-button">Add to Cart</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
 	<div class="whole-wrap">
		<div class="container box_1170">
            <div class="section-top-border">
        <h3 class="mb-30">Review</h3>
        <div class="row">
          
          <?php if($user_review==null): ?>
            <div class="col-lg-12 col-md-12">
						  <form action="<?php echo e(route('review_product',['id'=>$product->id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="text" name="user_id" value="<?php echo e($user->id); ?>" hidden />
                <input type="text" name="product_id"  value="<?php echo e($product->id); ?>" hidden />
                <div class="input-group-icon mt-10">
                  <div class="icon"><i class="fa fa-star" aria-hidden="true"></i></div>
                  <div class="form-select" id="default-select">
                  <select name="rate">
                          <option disabled selected>Rating</option>
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="mt-20">
                  <input type="text" name="content" placeholder="Content"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Content'" required
                    class="single-input">
                </div>
                <br>
                <div class="button-group-area mt-10">
                  <input type="submit" class="genric-btn success radius" value="Submit" />
                </div>  
              </form>
          </div>
          <?php endif; ?>
					
        </div>
        <br>
        <br>
        	<?php $__currentLoopData = $product_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="row">
					
					
					<div class="col-md-9 mt-sm-20">
            <h4 style=""><?php echo e($item->user->name); ?></h4>
            <p>
              <?php for($i = 1; $i <= $item->rate; $i++): ?>
                  ★
              <?php endfor; ?>
            </p>
            <p><?php echo e($item->content); ?></p>
					</div>
        </div>
          <?php
              $responses = DB::table('response')->where('review_id','=',$item->id)->get();
              
          ?>        
          <?php if(!$responses->isEmpty()): ?>
               <?php $__currentLoopData = $responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $respon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <br>
              <h5 class="mb-30">Response Admin</h5>
                <div class="row">
                  <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                      <?php echo e($respon->content); ?>

                    </blockquote>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        
			</div>
			
        </div>
 	</div>   
  <!--================End Single Product Area =================-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/user/productuser.blade.php ENDPATH**/ ?>