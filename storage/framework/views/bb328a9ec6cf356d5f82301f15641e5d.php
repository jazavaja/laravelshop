<div class="allFloatBtn">
    <nav class="social">
        <ul>
            <?php $__currentLoopData = \App\Models\FloatAccess::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($item->link); ?>">
                        <?php if($item->icon == 6): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#home2"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 5): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#tag"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 4): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#tag"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 1): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#whatsapp"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 2): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#telegram"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 3): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#phone-call"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php if($item->icon == 0): ?>
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#instagram"></use>
                                </svg>
                            </i>
                        <?php endif; ?>
                        <?php echo e($item->title); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
</div>
<?php /**PATH /var/www/html/resources/views/home/floatBtn.blade.php ENDPATH**/ ?>