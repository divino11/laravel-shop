<div class="col-3 product-item">
    <a href=""><img src="<?php echo e(url('/images/' . $product->image)); ?>" class="img-fluid img-center"></a>
    <a href=""><p class="product-title"><?php echo e($product->name); ?></p></a>
    <a href="<?php echo e(route('category', $product->category->code)); ?>"><p
            class="product-title"><?php echo e($product->category->name); ?></p></a>
    <a href="">
        <div class="product-rating">297 отзывов</div>
    </a>
    <div class="product-price"><?php echo e($product->price); ?></div>
    <div class="row">
        <div class="col-6">
            <div
                class="product-available"><?php echo e($product->status === 1 ? 'Available' : 'Not available'); ?></div>
        </div>
        <div class="col-6">
            <form action="<?php echo e(route('basket-add', $product->id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /home/andreyvasyukov/projects/laravel-shop/resources/views/layout/products.blade.php ENDPATH**/ ?>