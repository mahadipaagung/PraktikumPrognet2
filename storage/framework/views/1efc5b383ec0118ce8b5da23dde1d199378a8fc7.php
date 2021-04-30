
<?php $__env->startSection('page-contents'); ?>
<style>
.row{
  margin: 10px;
}

.bmd-label-floating{
  margin-bottom: 5px;
}
</style>
 <div class="content">
  <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"> Edit Product</h3>
    </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="panel-body">
                <div class="card-header card-header-primary>
                  <h4 class="card-title> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
					            	</div>
                    </div>
                  <form action="<?php echo e(route('product.edit',['id'=>$product->id])); ?>" method="POST" class="form">
                        <?php echo csrf_field(); ?>
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input type="text" name="product_name" value="<?php echo e($product->product_name); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">price</label>
                                    <input type="text" name="price" value="<?php echo e($product->price); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <input type="text" name="description" value="<?php echo e($product->description); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Rate</label>
                                    <input type="text" name="product_rate" value="<?php echo e($product->product_rate); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Stock</label>
                                    <input type="text" name="stock" value="<?php echo e($product->stock); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Weight</label>
                                    <input type="text" name="weight" value="<?php echo e($product->weight); ?>"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        
                        <input type="submit" value="Change" class="btn btn-success pull-right">
                    </form>
                </div>
              </div>
            </div>
            
            
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Images</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <form action="<?php echo e(route('product.add_image',['id'=>$product->id])); ?>" method="POST" enctype="multipart/form-data" class="form">
                        <?php echo csrf_field(); ?>
                         <div class="row">
                            <div class="col-md-12">
                              <div class="form-group bmd-form-group form-file-upload form-file-multiple">
                                <input type="file" multiple="" name="product_images[]" class="inputFileHidden">
                                <input type="submit" name="submit" value="Add Image" class="btn btn-success pull-right">
                              </div>
                            </div>
                         </div>  
                      </form>
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Image
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                       <?php if($image->isEmpty()): ?>
                           <tr>
                             <td>
                               Gambar kosong
                             </td>
                           </tr>
                       <?php else: ?>
                            <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                          <td>
                            <?php echo e($loop->iteration); ?>

                          </td>
                          <td>
                            <img src="<?php echo e(asset('storage/img/gambarproduk/'.$i->image_name)); ?>" style="width:260px;" alt="">
                           
                          </td>
                          <td class="td-actions text-left" >
                            <form style="display:inline-block;" action="<?php echo e(route('product.delete_image',['id'=>$i->id])); ?>" method="post">
                              
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php endif; ?>
                      </tbody>
                     </table>
                      <?php echo e($image->links()); ?>

                    </div>
                  </div>
                </div>
              </div>
            

             
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Categories</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="<?php echo e(route('product.add_cat',['id'=>$product->id])); ?>" method="post"  class="form">
                      <?php echo csrf_field(); ?>
                      <div class="form-group">
                        <select  class="form-control" name="product_category" data-style=" btn btn-link">
                          <?php if($product_categories->isEmpty()): ?>
                              <option disabled>Category Product</option>
                          <?php else: ?>
                               <option selected disabled>-- Category Product --</option>
                              <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pc->id); ?>"><?php echo e($pc->category_name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        </select>
                        <br>
                        <input type="submit" name="submit" value="Add Category" class="btn btn-success pull-right">
                      </div>
                    </form>

                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Name Category
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                       <?php if($product_category_details->isEmpty()): ?>
                           
                       <?php else: ?>
                        <?php $__currentLoopData = $product_category_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                        <tr>
                          <td>
                          <?php echo e($loop->iteration); ?>

                          </td>
                          <td>
                            
                            <?php echo e($det->product_categories->category_name); ?>

                          </td>
                          <td class="td-actions text-left" >
                            <form style="display:inline-block;" action="<?php echo e(route('product.delete_image',['id'=>$i->id])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                          </td>
                        </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php echo e($product_category_details->links()); ?>

                </div>
              </div>
            </div>
            


            
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Review</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          User Name
                        </th>
                        <th>
                          Rate
                        </th>
                        <th>
                          Comment
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                       <?php if($product_review->isEmpty()): ?>
                           <tr>
                             <td>
                               <p>Data is empty</p>
                             </td>
                           </tr>
                       <?php else: ?>
                        <?php $__currentLoopData = $product_review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                        <tr>
                          <td>
                          <?php echo e($loop->iteration); ?>

                          </td>
                          <td>
                            <?php echo e($review->user->name); ?>

                          </td>
                          <td>
                            <?php echo e($review->rate); ?>

                          </td>
                          <td>
                            <?php echo e($review->content); ?>

                          </td>
                          <td class="td-actions text-left" >
                            <a href="<?php echo e(route('response.add_response',$review)); ?>"  rel="tooltip" title="Review Product" class="btn btn-primary btn-sm">
                              <span class="lnr lnr-pencil"> Add Response</span>
                                </a>
                          </td>
                        </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php echo e($product_review->links()); ?>

                </div>
              </div>
            </div>
            

            
              <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">Discount</h4>
                 <a href="<?php echo e(route('discount.add',['id'=>$product->id])); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Discount</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                   <?php if($discount->isEmpty()): ?>
                   <tr>
                    <td>
                      <p>Data is empty</p>
                    </td>
                  </tr>
                  <?php else: ?>
                    <table class="table">
                      <thead class=" text-info">
                        <th>
                          ID
                        </th>
                        <th>
                         Product
                        </th>
                        <th>
                          Precentage
                        </th>
                        <th>
                          Start
                        </th>
                        <th>
                          End
                        </th>
                        <th>
                          Action
                        </th>
                        
                      </thead>
                      <tbody>   
                        <?php $__currentLoopData = $discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><?php echo e($item->product->product_name); ?></td>
                          <td><?php echo e($item->percentage); ?></td>
                          <td><?php echo e($item->start); ?></td>
                          <td><?php echo e($item->end); ?></td>
                          <td class="td-actions text-left">
                                
                                <form style="display:inline-block;" action="<?php echo e(route('discount.destroy',['id'=>$item->id])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o">  Delete</i>
                                  </button>
                                </form>
                                <a href="<?php echo e(route('discount.edit',$item->id)); ?>"  rel="tooltip" title="Review Product" class="btn btn-primary btn-sm">
                                  <span class="lnr lnr-pencil"> Edit</span>
                                </a>
                            
                              </td>
                          </tr>
                          <?php echo e($discount->links()); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                    
                  </div>
                    <?php endif; ?>   
                </div>
              </div>
            </div>
            
            
          </div>


        </div>
      </div>
      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/product/editproduct.blade.php ENDPATH**/ ?>