<?php if($paginator->hasPages()): ?>
    <div class="pagination">
        <?php if(!$paginator->onFirstPage()): ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="prev">
                <svg class="icon">
                    <use xlink:href="#right"></use>
                </svg>
            </a>

        <?php endif; ?>
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <a href="javascript:void(0)"><?php echo e($element); ?></a>
            <?php endif; ?>
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <a href="javascript:void(0)" class="active-page"><?php echo e($page); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="next">
                <svg class="icon">
                    <use xlink:href="#left"></use>
                </svg>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/paginate.blade.php ENDPATH**/ ?>