<?php $__env->startSection('tab',1); ?>
<?php $__env->startSection('content'); ?>
    <div class="allShowBrand">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/product">همه محصولات</a>
                <span>/</span>
                <a href="/admin/product/<?php echo e($posts->id); ?>/show">آمار محصولات</a>
            </div>
        </div>
        <div class="showData">
            <div class="pic">
                <?php if($posts->image != '[]'): ?>
                    <img src="<?php echo e(json_decode($posts->image)[0]); ?>" alt="<?php echo e($posts->title); ?>">
                <?php else: ?>
                    <img src="/img/user.png" alt="<?php echo e($posts->name); ?>">
                <?php endif; ?>
            </div>
            <div class="showDataItems">
                <div class="showDataItem">
                    <h3>آیدی</h3>
                    <h4><?php echo e($posts->id); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>عنوان</h3>
                    <h4><?php echo e($posts->title); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>پیوند</h3>
                    <h4><?php echo e($posts->slug); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>تعداد موجود</h3>
                    <h4><?php echo e($posts->count); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>تعداد علاقه مندی</h3>
                    <h4><?php echo e($posts->like_count); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>تعداد دیدگاه</h3>
                    <h4><?php echo e($posts->comments_count); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>تعداد نشانه ها</h3>
                    <h4><?php echo e($posts->bookmark_count); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>کد محصول</h3>
                    <h4><?php echo e($posts->product_id); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>تخفیف</h3>
                    <?php if($posts->off): ?>
                        <h4><?php echo e($posts->off); ?></h4>
                    <?php else: ?>
                        <h4>بدون تخفیف</h4>
                    <?php endif; ?>
                </div>
                <div class="showDataItem">
                    <h3>مبلغ</h3>
                    <h4><?php echo e(number_format($posts->price)); ?> تومان </h4>
                </div>
                <div class="showDataItem">
                    <h3>وضعیت محصول</h3>
                    <?php if($posts->status == 1): ?>
                        <h4>منتشر شده</h4>
                    <?php else: ?>
                        <h4>پیشنویس</h4>
                    <?php endif; ?>
                </div>
                <?php if(count($posts->brand)>=1): ?>
                    <div class="showDataItem">
                        <h3>برند</h3>
                        <?php $__currentLoopData = $posts->brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4><?php echo e($item->name); ?></h4>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(count($posts->category)>=1): ?>
                    <div class="showDataItem">
                        <h3>دسته بندی</h3>
                        <?php $__currentLoopData = $posts->category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4><?php echo e($item->name); ?></h4>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(count($posts->time)>=1): ?>
                    <div class="showDataItem">
                        <h3>زمان تحویل</h3>
                        <?php $__currentLoopData = $posts->time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4><?php echo e($item->name); ?></h4>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(count($posts->guarantee)>=1): ?>
                    <div class="showDataItem">
                        <h3>گارانتی</h3>
                        <?php $__currentLoopData = $posts->guarantee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4><?php echo e($item->name); ?></h4>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/post/show.blade.php ENDPATH**/ ?>