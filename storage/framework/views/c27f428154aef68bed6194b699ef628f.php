<div class="collectionIndex width">
    <div class="collectionTitle">
        <h3><?php echo e($data['title']); ?></h3>
    </div>
    <div class="slider-collectionIndex owl-carousel owl-theme">
        <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="collectionItems">
                <a class="collectionItem" href="/pack/<?php echo e($item['slug']); ?>" title="<?php echo e($item['titleSeo']); ?>" name="<?php echo e($item['title']); ?>">
                    <article>
                        <div class="topCollect"><?php echo e($item['title']); ?></div>
                        <div class="offPrice"><?php echo e($item['off']); ?></div>
                        <div class="collectProducts">
                            <?php $__currentLoopData = $item['product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="/product/<?php echo e($value->slug); ?>" class="collectProduct">
                                    <figure class="pic">
                                        <?php if($value->image != '[]'): ?>
                                            <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="<?php echo e(json_decode($value->image)[0]); ?>" alt="<?php echo e($value->imageAlt); ?>">
                                        <?php endif; ?>
                                    </figure>
                                    <h4><?php echo e($value->title); ?></h4>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="botCollect">
                            <h5><?php echo e(number_format($item['price'])); ?> <?php echo e(__('messages.arz')); ?> </h5>
                            <a class="collectionItem" href="/pack/<?php echo e($item['slug']); ?>">
                                <?php echo e(__('messages.show_all')); ?>

                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </a>
                        </div>
                    </article>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/index/collectionIndex.blade.php ENDPATH**/ ?>