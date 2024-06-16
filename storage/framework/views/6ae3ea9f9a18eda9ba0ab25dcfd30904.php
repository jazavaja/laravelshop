<?php $__env->startSection('tab',8); ?>
<?php $__env->startSection('content'); ?>
    <div class="allTank">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/tank">همه انبار ها</a>
            </div>
            <div class="allTopTableItem">
                <div class="groupEdits">افزودن انبار</div>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/tank" class="filterContent" style="display: none">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="title" placeholder="عنوان یا آیدی را وارد کنید" value="<?php echo e($title); ?>">
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
            <?php $__currentLoopData = $tanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem" id="<?php echo e($item->id); ?>">
                    <h3><?php echo e($item->name); ?></h3>
                    <h5>
                        تعداد ورودی :
                        <span><?php echo e(\App\Models\Tank::where('parent_id' , $item->id)->where('type' , 1)->sum('count')); ?></span>
                    </h5>
                    <h5>
                        تعداد خروجی :
                        <span><?php echo e(\App\Models\Tank::where('parent_id' , $item->id)->where('type' , 0)->sum('count')); ?></span>
                    </h5>
                    <h5>
                        تعداد محصول :
                        <span><?php echo e(count(\App\Models\Tank::where('parent_id' , $item->id)->where('product_id' , '>=' ,1)->select('product_id')->distinct()->get())); ?></span>
                    </h5>
                    <a class="show" target="_blank" href="/admin/tank/<?php echo e($item->id); ?>/edit" title="جزییات">جزییات و ویرایش انبار</a>
                    <div class="delete" id="<?php echo e($item->id); ?>">حذف انبار</div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <form class="tankCreate" action="/admin/tank" method="post" style="display:none;">
            <?php echo csrf_field(); ?>
            <div class="allCreatePostDetailItem">
                <label>نام انبار* :</label>
                <input type="text" name="name" placeholder="نام را وارد کنید">
                <div id="validation-name"></div>
            </div>
            <button class="button">ایجاد انبار</button>
        </form>
        <?php echo e($tanks->links('admin.paginate')); ?>

        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف انبار مطمئن هستید؟</div>
                <p>با حذف انبار اطلاعات انبار به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var post = 0;
            var checked = 0;
            $('.popUp').hide();
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.groupEdits').click(function(){
                $('.allReturnedPay').toggle();
                $('.tankCreate').toggle();
            });
            $('.allReturnedPay .postItem').on('click' , '.delete' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/tank/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/tank/index.blade.php ENDPATH**/ ?>