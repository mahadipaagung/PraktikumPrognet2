
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
        <h3 class="panel-title"> Add Discount</h3>
    </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose">
                  <h4 class="card-title "> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
					            	</div>
                    </div>
                  <form action="<?php echo e(route('discount.store')); ?>" method="POST" class="form">
                        <?php echo csrf_field(); ?>
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    
                                    <input type="hidden" name="id_product"  value="<?php echo e($id); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Percentage</label>
                                    <input type="number" name="percentage"  step="0.01" min="0" max="99" value="<?php echo e(old('percentage')); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Start</label>
                                    <input type="date" name="start" value="<?php echo e(old('start')); ?>"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">End</label>
                                    <input type="date" name="end" value="<?php echo e(old('end')); ?>"  class="form-control" >
                                </div>
                              </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="submit" value="Tambah" class="btn btn-success pull-right">
                    </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("start")[0].setAttribute('min', today);
        document.getElementsByName("end")[0].setAttribute('min', today);
      </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/discount/discount.blade.php ENDPATH**/ ?>