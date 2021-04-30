<?php $__env->startSection('page-contents'); ?>
 <!-- slider Area Start -->
        
        <!-- slider Area End-->
 
        <!-- Latest Products Start -->
        <div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>PHONE STORE</h1>
                <span>Harga Terjangkau, Kualitas Terjamin</span>
              </div>
            </div>
          </div>
        </div>
        <div class="services">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="section-heading">
                  <h2>Our <em>Products</em></h2>
                </div>
             </div>
            <div class="col-md-10">
                        <div class="service-item">
                            
                        <div class="row">
                             <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <?php
                                            $image = DB::table('product_images')->where('product_id','=',$item->id)->get();
                                        ?>
                                        <img src="<?php echo e(asset('product_images/'.$image[0]->image_name)); ?>" alt="">
                                        
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <?php if($i<$item->product_rate): ?>
                                                    
                                                     <i class="fa fa-star"></i>
                                                <?php else: ?>
                                                     <i class="fa fa-star low-star"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </div>
                                      <h4><a href="<?php echo e(route('detail_product',['id'=>$item->id])); ?>"><?php echo e($item->product_name); ?></a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>Rp. <?php echo e(number_format($item->price)); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php echo e($product->links()); ?>

                        </div>
                    </div>

                    
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
       
        

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/home.blade.php ENDPATH**/ ?>