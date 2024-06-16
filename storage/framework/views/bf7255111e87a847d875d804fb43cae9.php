<section class="homeTopAdvertise width">
    <div class="advertiseSlider">
        <div class="slider owl-carousel owl-theme">
            <?php $__currentLoopData = json_decode($data['ads2']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <figure>
                    <a href="<?php echo e($item->address); ?>" id="<?php echo e($item->address); ?>">
                        <img lazy="loading" src="<?php echo e($item->image); ?>" alt="<?php echo e($item->address); ?>">
                    </a>
                </figure>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="advertiseItems">
        <?php $__currentLoopData = json_decode($data['ads3']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <figure class="advertiseItem">
                <a href="<?php echo e($item->address); ?>" id="<?php echo e($item->address); ?>">
                    <img lazy="loading" src="<?php echo e($item->image); ?>" alt="<?php echo e($item->address); ?>">
                </a>
            </figure>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/home/index/adsHooper.blade.php ENDPATH**/ ?>