<?php $__env->startSection('tab' , 34); ?>
<?php $__env->startSection('content'); ?>
    <div class="allPayPanel">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <span>مرجوعی ها</span>
            </div>
            <div class="allTopTableItem">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/pay/returned" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر نام محصول</label>
                            <input type="text" name="title" placeholder="نام" value="<?php echo e($title); ?>">
                        </div>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <div class="allReturnedPay">
            <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem" id="<?php echo e($item->id); ?>">
                    <a href="/product/<?php echo e($item->product->slug); ?>" target="_blank" class="pic">
                        <img src="<?php echo e(json_decode($item->product->image)[0]); ?>">
                    </a>
                    <h3><?php echo e($item->product->title); ?></h3>
                    <h5>
                        رنگ :
                        <?php if($item->color): ?>
                            <span><?php echo e($item->color); ?></span>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </h5>
                    <h5>
                        سایز :
                        <?php if($item->size): ?>
                            <span><?php echo e($item->size); ?></span>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </h5>
                    <h5>
                        کاربر :
                        <?php if($item->user): ?>
                            <span><?php echo e($item->user->name); ?></span>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </h5>
                    <h5>
                        تعداد مرجوعی :
                        <span><?php echo e($item->count); ?> عدد</span>
                    </h5>
                    <h5>
                        مبلغ :
                        <span><?php echo e(number_format($item->price)); ?> تومان</span>
                    </h5>
                    <a class="show" target="_blank" href="/admin/pay/<?php echo e($item->pay->id); ?>" title="مشاهده سفارش">مشاهده سفارش</a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($pays->links('admin.paginate')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pay/returned.blade.php ENDPATH**/ ?>