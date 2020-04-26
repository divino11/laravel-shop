<div class="list-group list-group-flush">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="list-group-item list-group-item-action" href="<?php echo e(route('category', $category->code)); ?>"><?php echo e($category->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/layout/categories.blade.php ENDPATH**/ ?>