<?php $__env->startSection('title', 'All Product'); ?>

<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="row col-lg-12">
            <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Image</td>
            <td>Name</td>
            <td>Description</td>
            <td>Count</td>
            <td>Price</td>
            <td>Status</td>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($value->id); ?></td>
                <td><?php echo e($value->image); ?></td>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->description); ?></td>
                <td><?php echo e($value->count); ?></td>
                <td><?php echo e($value->price); ?></td>
                <td><?php echo e($value->status === 1 ? 'Available' : 'Not available'); ?></td>
                <td>
                    <form action="<?php echo e(route('products.destroy', $value->id)); ?>" method="post">
                        <a class="btn btn-small btn-success" href="<?php echo e(route('products.show', $value->id)); ?>">Show</a>
                        <a class="btn btn-small btn-info" href="<?php echo e(route('products.edit', $value->id)); ?>">Edit</a>
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-small btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <td colspan="7" style="text-align: center">None of one product not found</td>
        <?php endif; ?>
        </tbody>
    </table>

    <?php echo $products->links(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/admin/product/index.blade.php ENDPATH**/ ?>