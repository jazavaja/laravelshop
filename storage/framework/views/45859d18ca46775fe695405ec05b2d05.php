<section class="categoryPostIndex width">
    <div class="slider-category-post owl-carousel owl-theme">
        <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="productItem">
                    <div class="topProduct">
                        <h3><?php echo e($item['title']); ?></h3>
                        <h4><?php echo e(__('messages.best_cat')); ?></h4>
                    </div>
                    <div class="products">
                        <ul>
                            <?php $__currentLoopData = $item['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="/product/<?php echo e($product->slug); ?>" title="<?php echo e($product->titleSeo); ?>" name="<?php echo e($product->title); ?>">
                                        <figure>
                                            <?php if($product->image != '[]'): ?>
                                                <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="<?php echo e(json_decode($product->image)[0]); ?>" alt="<?php echo e($product->imageAlt); ?>">
                                            <?php endif; ?>
                                        </figure>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="botProduct">
                        <a href="/category/<?php echo e($item['slug']); ?>">
                            <?php echo e(__('messages.show_all')); ?>

                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/home/index/categoryPost.blade.php ENDPATH**/ ?>