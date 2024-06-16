<?php $__env->startSection('title' , __('messages.order_user') . ' - '); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProfileIndex width">
        <?php echo $__env->make('home.profile.list' , ['tab' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="profileIndexPay">
            <table>
                <tr>
                    <th><?php echo e(__('messages.order_deliver')); ?></th>
                    <th><?php echo e(__('messages.order_property')); ?></th>
                    <th><?php echo e(__('messages.buy_status')); ?></th>
                    <th><?php echo e(__('messages.order_created')); ?></th>
                    <th><?php echo e(__('messages.action1')); ?></th>
                </tr>
                <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($item->deliver == 0): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver1')); ?></span>
                            <?php endif; ?>
                            <?php if($item->deliver == 1): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver2')); ?></span>
                            <?php endif; ?>
                            <?php if($item->deliver == 2): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver3')); ?></span>
                            <?php endif; ?>
                            <?php if($item->deliver == 3): ?>
                                <span class="unActive"><?php echo e(__('messages.order_deliver4')); ?></span>
                            <?php endif; ?>
                            <?php if($item->deliver == 4): ?>
                                <span class="active"><?php echo e(__('messages.order_deliver5')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span><?php echo e($item->property); ?></span>
                        </td>
                        <td>
                            <?php if($item->status == 100): ?>
                                <span class="active"><?php echo e(__('messages.order_status2')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 50): ?>
                                <span class="active"><?php echo e(__('messages.order_status3')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 20): ?>
                                <span class="active"><?php echo e(__('messages.order_status4')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 10): ?>
                                <span class="unActive"><?php echo e(__('messages.order_status5')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 0): ?>
                                <span class="unActive"><?php echo e(__('messages.order_status6')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 1): ?>
                                <span class="unActive"><?php echo e(__('messages.order_status7')); ?></span>
                            <?php endif; ?>
                            <?php if($item->status == 2): ?>
                                <span class="unActive"><?php echo e(__('messages.order_status8')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span><?php echo e($item->created_at); ?></span>
                        </td>
                        <td>
                            <a href="/show-pay/<?php echo e($item->property); ?>">
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/profile/pay.blade.php ENDPATH**/ ?>