<div class="allNewsIndex width">
    <div class="title">
        <h3><?php echo e($data['title']); ?></h3>
        <a href="/blogs"><?php echo e(__('messages.show_all')); ?></a>
    </div>
    <ul>
        <?php $__currentLoopData = $data['post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="/blog/<?php echo e($item['slug']); ?>" title="<?php echo e($item->titleSeo); ?>">
                    <article>
                        <figure class="pic">
                            <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['imageAlt']); ?>">
                        </figure>
                        <h4><?php echo e($item['title']); ?></h4>
                    </article>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /var/www/html/resources/views/home/index/newsIndex.blade.php ENDPATH**/ ?>