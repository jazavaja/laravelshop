<div class="showAllShare">
    <div class="showAllShareHome">
        <div class="showAllShareTop">
            <h4><?php echo e(__('messages.social2')); ?></h4>
        </div>
        <div class="showAllShareItems">
            <div class="showAllShareItem">
                <div class="showAllShareItemName">
                    <h4><?php echo e(__('messages.twitter1')); ?></h4>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank">https://twitter.com/intent/tweet?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?></a>
                </div>
                <a href="https://twitter.com/intent/tweet?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank" title="<?php echo e(__('messages.twitter1')); ?>" name="<?php echo e(__('messages.twitter1')); ?>">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#twitter2"></use>
                        </svg>
                    </i>
                </a>
            </div>
            <div class="showAllShareItem">
                <div class="showAllShareItemName">
                    <h4><?php echo e(__('messages.telegram1')); ?></h4>
                    <a href="https://telegram.me/share/url?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank">https://telegram.me/share/url?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?></a>
                </div>
                <a href="https://telegram.me/share/url?url=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank" title="<?php echo e(__('messages.telegram1')); ?>" name="<?php echo e(__('messages.telegram1')); ?>">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#telegram2"></use>
                        </svg>
                    </i>
                </a>
            </div>
            <div class="showAllShareItem">
                <div class="showAllShareItemName">
                    <h4><?php echo e(__('messages.face1')); ?></h4>
                    <a href="https://www.facebook.com/sharer/sharer.php?m2w&s=100&p[url]=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank">https://www.facebook.com/sharer/sharer.php?m2w&s=100&p[url]=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?></a>
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?m2w&s=100&p[url]=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank" title="<?php echo e(__('messages.face1')); ?>" name="<?php echo e(__('messages.face1')); ?>">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#facebook"></use>
                        </svg>
                    </i>
                </a>
            </div>
            <div class="showAllShareItem">
                <div class="showAllShareItemName">
                    <h4><?php echo e(__('messages.whatsapp1')); ?></h4>
                    <a href="https://api.whatsapp.com/send/?phone&text=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank">https://api.whatsapp.com/send/?phone&text=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?></a>
                </div>
                <a href="https://api.whatsapp.com/send/?phone&text=<?php echo e(url('')); ?>/productID/<?php echo e($slug); ?>" target="_blank" title="<?php echo e(__('messages.whatsapp1')); ?>" name="<?php echo e(__('messages.whatsapp1')); ?>">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#whatsapp"></use>
                        </svg>
                    </i>
                </a>
            </div>
        </div>
        <div class="showAllShareTag">
            <i>
                <svg class="icon">
                    <use xlink:href="#tag"></use>
                </svg>
            </i>
            <h4><?php echo e(url('')); ?>/productID/<?php echo e($slug); ?></h4>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/home/single/share.blade.php ENDPATH**/ ?>