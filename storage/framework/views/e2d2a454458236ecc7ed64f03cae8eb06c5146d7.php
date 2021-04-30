

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
        <h3 class="panel-title"> Review</h3>
    </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
                      <tbody>
                             
                            <tr>
                                   <td>ID :</td>
                                   <td>
                                     <?php echo e($product_review[0]->id); ?>

                                    </td>
                              </tr>
                            <tr>
                                   <td>User name:</td>
                                   <td>
                                     <?php echo e($product_review[0]->user->name); ?>

                                    </td>
                            </tr>
                                
                            <tr>
                                   <td>Product :</td>
                                   <td>
                                     <?php echo e($product_review[0]->product->product_name); ?>

                                    </td>
                              </tr>
                              <tr>
                                   <td>Rate :</td>
                                   <td>
                                     <?php echo e($product_review[0]->rate); ?>

                                    </td>
                              </tr>
                              <tr>
                                   <td>Content :</td>
                                   <td>
                                     <?php echo e($product_review[0]->content); ?>

                                    </td>
                              </tr>
                 
                    </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
            

              
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Reponse</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="<?php echo e(route('response.store')); ?>" method="post"  class="form">
                      <?php echo csrf_field(); ?>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Review ID</label>
                      <input type="text" readonly name="review_id" value="<?php echo e($product_review[0]->id); ?>"  class="form-control" >
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Admin</label>
                        <input type="text" readonly name="admin_id" value="<?php echo e($admin->id); ?>"  class="form-control" >
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Content</label>
                       
                         <input type="text" name="content" value=""  class="form-control" >
                      </div>
                      <div class="form-group">
                        
                        <input type="submit" name="submit" value="Add Response" class="btn btn-success pull-right">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/response/response.blade.php ENDPATH**/ ?>