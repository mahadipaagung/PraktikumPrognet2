
<?php $__env->startSection('css'); ?>
<style>
    .dataTables_filter {
        float: right !important;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-contents'); ?>
  <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-tittle">Edit Product Categories</h3>
    </div>
 <div class="panel-body">
<form action="/categories/<?php echo e($dataCategory->id); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('PUT')); ?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Category Name</label>
        <div class="col-sm-10">
            <input name="category_name" type="text" class="form-control" value="<?php echo e($dataCategory->category_name); ?>">
        </div>
    </div>

    <br>

    <div class="panel-body">
        <a href="/categories" class="btn btn-danger">Kembali
        </a>
        <button value="submit" type="submit" class="btn btn-info">Ubah</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/categories/editcategories.blade.php ENDPATH**/ ?>