<?php $__env->startSection('title', 'Create Product'); ?>

<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <input type="text" id="name" class="form-control" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Main image</label>
            <input type="file" name="main_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="count">Count</label>
            <input type="text" id="count" class="form-control" name="count" placeholder="Count">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" name="price" placeholder="Price">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1">Available</option>
                <option value="0">Not available</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Add</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/admin/product/create.blade.php ENDPATH**/ ?>