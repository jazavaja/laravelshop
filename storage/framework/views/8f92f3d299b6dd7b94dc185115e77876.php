<?php $__env->startSection('tab' , 8); ?>
<?php $__env->startSection('content'); ?>
    <div class="allInventoryIndex">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <?php if($inventory == 1): ?>
                    <a href="/admin/inventory">انبارداری</a>
                <?php else: ?>
                    <a href="/admin/empty">محصولات ناموجود</a>
                <?php endif; ?>
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
                    <form method="GET" action="/admin/inventory" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="title" placeholder="مثال: 10" value="<?php echo e($title); ?>">
                        </div>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="allTableContainer">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem">
                    <div class="postTop">
                        <div class="postPic">
                            <?php if($item->image != '[]'): ?>
                            <img src="<?php echo e(json_decode($item->image)[0]); ?>" alt="<?php echo e($item->title); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="postTitle">
                            <h3>
                                <?php echo e($item->title); ?>

                                <?php if($item->count >= 1): ?>
                                    <span class="count">(<?php echo e($item->count); ?> مورد)</span>
                                <?php else: ?>
                                    <span>(ناموجود)</span>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="postOptions">
                            <a title="ویرایش محصول" href="/admin/product/<?php echo e($item->id); ?>/edit">
                                <svg class="icon">
                                    <use xlink:href="#edit"></use>
                                </svg>
                            </a>
                            <a href="/admin/product/<?php echo e($item->id); ?>/show" title="نمایش محصول">
                                <svg class="icon">
                                    <use xlink:href="#eye"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>رنگ :</span>
                                <?php if($item->colors && $item->colors != '[]'): ?>
                                <div>
                                    <?php $__currentLoopData = json_decode($item->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span>
                                            <?php if($value->count >= 1): ?>
                                                <span class="count"><?php echo e($value->name); ?> (<?php echo e($value->count); ?> مورد)</span>
                                            <?php else: ?>
                                                <span><?php echo e($value->name); ?> (ناموجود)</span>
                                            <?php endif; ?>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php else: ?>
                                    <div>
                                        <span>بدون رنگ</span>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span>سایز :</span>
                                <?php if($item->size && $item->size != '[]'): ?>
                                    <div>
                                        <?php $__currentLoopData = json_decode($item->size); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span>
                                                <?php if($value->count >= 1): ?>
                                                    <span class="count"><?php echo e($value->name); ?> (<?php echo e($value->count); ?> مورد)</span>
                                                <?php else: ?>
                                                    <span><?php echo e($value->name); ?> (ناموجود)</span>
                                                <?php endif; ?>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <div>
                                        <span>بدون سایز</span>
                                    </div>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($products->links('admin.paginate')); ?>

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

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/inventory/index.blade.php ENDPATH**/ ?>