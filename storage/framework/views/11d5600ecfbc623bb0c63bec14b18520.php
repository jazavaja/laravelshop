<?php $__env->startSection('title' , __('messages.order_status1') . ' - '); ?>
<?php $__env->startSection('content'); ?>
    <main class="buyIndex">
        <div class="allBuyItems">
            <?php if($pay->status == 100 || $pay->status == 50 || $pay->status == 10): ?>
                <div class="allBuySuccessItemTitle">
                    <h3><?php echo e(__('messages.order_status1')); ?></h3>
                </div>
            <?php else: ?>
                <div class="allBuyFailItemTitle">
                    <h3><?php echo e(__('messages.order_status1')); ?></h3>
                </div>
            <?php endif; ?>
            <div class="allBuyItem">
                <label><?php echo e(__('messages.order_created')); ?></label>
                <h4><?php echo e($pay->created_at); ?></h4>
            </div>
            <?php if(auth()->user()): ?>
                <div class="allBuyItem">
                    <label><?php echo e(__('messages.order_name')); ?></label>
                    <h4><?php echo e(auth()->user()->name); ?></h4>
                </div>
            <?php elseif($pay->address()->pluck('name')->first()): ?>
                <div class="allBuyItem">
                    <label><?php echo e(__('messages.order_name')); ?></label>
                    <h4><?php echo e($pay->address()->pluck('name')->first()); ?></h4>
                </div>
            <?php else: ?>
                <div class="allBuyItem">
                    <label><?php echo e(__('messages.order_track')); ?></label>
                    <h4><?php echo e(__('messages.order_call')); ?></h4>
                </div>
            <?php endif; ?>
            <div class="allBuyItem">
                <label><?php echo e(__('messages.order_price')); ?></label>
                <?php if($pay->method == 2): ?>
                    <h4><?php echo e(number_format($pay->deposit)); ?> <?php echo e(__('messages.arz')); ?></h4>
                <?php elseif($pay->method == 3): ?>
                    <h4><?php echo e(__('messages.wait1')); ?></h4>
                <?php else: ?>
                    <h4><?php echo e(number_format($pay->price)); ?> <?php echo e(__('messages.arz')); ?></h4>
                <?php endif; ?>
            </div>
            <div class="allBuyItem">
                <?php if($pay->method == 6): ?>
                    <label><?php echo e(__('messages.prop_payment')); ?></label>
                <?php else: ?>
                    <label><?php echo e(__('messages.order_property')); ?></label>
                <?php endif; ?>
                <h4><?php echo e($pay->property); ?></h4>
            </div>
            <div class="allBuyItem">
                <label><?php echo e(__('messages.order_status')); ?></label>
                <?php if($pay->status == 100 || $pay->status == 50): ?>
                    <h4><?php echo e(__('messages.order_success')); ?></h4>
                <?php elseif($pay->status == 10): ?>
                    <h4><?php echo e(__('messages.wait1')); ?></h4>
                <?php else: ?>
                    <h4><?php echo e(__('messages.order_fail')); ?></h4>
                <?php endif; ?>
            </div>
            <div class="allBuyButton">
                <a href="/" title="<?php echo e(__('messages.back_home')); ?>" name="<?php echo e(__('messages.back_home')); ?>"><?php echo e(__('messages.back_home')); ?></a>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/cart/buy.blade.php ENDPATH**/ ?>