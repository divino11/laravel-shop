<?php $__env->startSection('title', 'Create Product'); ?>

<?php $__env->startSection('content'); ?>
    <?php if($message = Session::get('error')): ?>
        <div class="alert alert-warning">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('products.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" value="<?php echo e($product->name); ?>" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="description">Main image</label>
            <input type="file" name="main_image" class="form-control">
            <img src="<?php echo e(url('images/' . $product->image)); ?>" class="img-size-s" alt="">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" placeholder="Description"><?php echo e($product->description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="count">Count</label>
            <input type="text" id="count" class="form-control" value="<?php echo e($product->count); ?>" name="count" placeholder="Count">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" value="<?php echo e($product->price); ?>" name="price" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" <?php echo e($product->status === 1 ? 'selected' : ''); ?>>Available</option>
                <option value="0" <?php echo e($product->status === 0 ? 'selected' : ''); ?>>Not available</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Add</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/admin/product/edit.blade.php ENDPATH**/ ?>