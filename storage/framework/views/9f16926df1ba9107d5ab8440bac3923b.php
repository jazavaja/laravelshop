<?php $__env->startSection('tab',2); ?>

<?php $__env->startSection('content'); ?>
    <div class="allShowBrand">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a>تاکسونامی</a>
                <span>/</span>
                <a href="/admin/category/<?php echo e($categories->id); ?>/show">دسته بندی</a>
            </div>
        </div>
        <div class="showData">
            <div class="pic">
                <?php if($categories->image): ?>
                    <img src="<?php echo e($categories->image); ?>" alt="<?php echo e($categories->name); ?>">
                <?php else: ?>
                    <img src="/img/user.png" alt="<?php echo e($categories->name); ?>">
                <?php endif; ?>
            </div>
            <div class="showDataItems">
                <div class="showDataItem">
                    <h3>آیدی</h3>
                    <h4><?php echo e($categories->id); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>عنوان</h3>
                    <h4><?php echo e($categories->name); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>پیوند</h3>
                    <h4><?php echo e($categories->slug); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>توضیحات سئو</h3>
                    <h4><?php echo e($categories->bodySeo); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>عنوان سئو</h3>
                    <h4><?php echo e($categories->nameSeo); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>توضیحات</h3>
                    <h4><?php echo e($categories->body); ?></h4>
                </div>
                <div class="showDataItem">
                    <h3>کلمات کلیدی</h3>
                    <h4><?php echo e($categories->keyword); ?></h4>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>آیدی</th>
                <th>تصویر</th>
                <th>عنوان</th>
                <th>مبلغ</th>
                <th>تعداد موجود</th>
            </tr>
            <?php $__currentLoopData = $categories->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td>
                        <div class="pic">
                            <?php if($item->image != '[]'): ?>
                                <img src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->title); ?>">
                            <?php endif; ?>
                        </div>
                    </td>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e(number_format($item->price)); ?> تومان </td>
                    <td><?php echo e($item->count); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/taxonomy/show/category.blade.php ENDPATH**/ ?>