<div class="allCompareIndex width">
    <div class="title">
        <h3><?php echo e($data['title']); ?></h3>
    </div>
    <div class="slider-compare">
        <?php $__currentLoopData = \App\Models\CompareProduct::latest()->where('language' , request()->cookie('language')??'fa')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="compareItem">
                <figure style="--fraction: 50%">
                    <div class="before"><?php echo e($item->text1); ?></div>
                    <div class="after"><?php echo e($item->text2); ?></div>
                    <img src="<?php echo e($item->image1); ?>" alt="<?php echo e($item->text1); ?>">
                    <img src="<?php echo e($item->image2); ?>" alt="<?php echo e($item->text2); ?>">
                    <input
                            type="range"
                            oninput="this.parentNode.style.setProperty('--fraction', this.value + '%')"
                            min="0"
                            max="100"
                            step="0.1"
                            value="50"
                    />
                </figure>
                <a href="<?php echo e($item->link); ?>" class="detail"><?php echo e($item->title); ?></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/index/compareIndex.blade.php ENDPATH**/ ?>