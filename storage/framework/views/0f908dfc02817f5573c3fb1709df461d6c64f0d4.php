<?php $__env->startSection('title', 'Basket'); ?>

<?php $__env->startSection('categories'); ?>
    <?php echo $__env->make('layout.categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td>Image</td>
            <td>Count</td>
            <td>Price</td>
            <td>Total</td>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><a href="#"><?php echo e($product->name); ?></a></td>
                <td><img style="width: 100px" src="<?php echo e(url('images/' . $product->image)); ?>" alt=""></td>
                <td>
                    <div class="badge"><?php echo e($product->count); ?></div>
                    <a href="#"><i class="fas fa-minus-circle"></i></a>
                    <form action="<?php echo e(route('basket-add', $product)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <button type="submit"><i class="fas fa-plus-circle"></i></button>
                    </form>
                </td>
                <td><?php echo e($product->price); ?></td>
                <td><?php echo e($product->price); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <td colspan="5" style="text-align: center">None of one product in basket not found</td>
        <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/basket.blade.php ENDPATH**/ ?>