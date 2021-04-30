
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
        <h3 class="panel-tittle">Edit Courier</h3>
    </div>
 <div class="panel-body">
<form action="/courier/<?php echo e($courier->id); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('PUT')); ?>

    <div class="form-group row">
        <label class="col-sm-1 col-form-label">Courier</label>
        <div class="col-sm-10">
            <input name="courier" type="text" class="form-control" value="<?php echo e($courier->courier); ?>">
        </div>
    </div>

    <br>

    <div class="panel-body">
        <a href="/courier" class="btn btn-danger">Kembali</a>
        <button value="submit" type="submit" class="btn btn-info">Ubah</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamp\htdocs\pratikumPrognet\resources\views/courier/editcourier.blade.php ENDPATH**/ ?>