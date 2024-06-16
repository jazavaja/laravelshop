<?php $__env->startSection('tab',8); ?>
<?php $__env->startSection('content'); ?>
    <div class="allTank">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="#">جزییات <?php echo e($tank->name); ?></a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form class="createTank" method="post" action="/admin/tank/<?php echo e($tank->id); ?>/edit" style="grid-template-columns: 1fr auto">
            <?php echo csrf_field(); ?>
            <div class="allCreatePostItem">
                <label>نام* :</label>
                <input type="text" name="name" value="<?php echo e($tank->name); ?>" placeholder="نام* را وارد کنید">
            </div>
            <button>ویرایش انبار</button>
        </form>
        <form class="createTank" method="post" action="/admin/tank/add-detail">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="tank_id" value="<?php echo e($tank->id); ?>">
            <div class="allCreatePostItem">
                <label>تعداد* :</label>
                <input type="text" name="count" placeholder="تعداد* را وارد کنید">
                <div id="validation-price"></div>
            </div>
            <div class="allCreatePostItem">
                <label>نوع :</label>
                <select name="type">
                    <option value="1" selected>افزایش</option>
                    <option value="0">کاهش</option>
                </select>
            </div>
            <div class="allCreatePostItem">
                <label>نام محصول :</label>
                <input type="text" name="name" placeholder="نام را وارد کنید">
            </div>
            <div class="allCreatePostItem">
                <label>محصول :</label>
                <select name="product_id">
                    <option value="0" selected>محصول موجود نیست</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $el): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($el->id); ?>"><?php echo e($el->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button>افزودن جزییات</button>
        </form>
        <div class="allReturnedPay">
            <?php $__currentLoopData = $tanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem">
                    <h4 class="<?php echo e($item->type == 0 ? '' : 'active'); ?>">
                        <?php if($item->product_id >= 1 && $item->product): ?>
                            <?php echo e($item->product->title); ?>

                        <?php else: ?>
                            <?php echo e($item->name); ?>

                        <?php endif; ?>
                    </h4>
                    <?php if($item->type == 0): ?>
                        <h5>
                            تعداد خروجی :
                            <span><?php echo e($item->count); ?></span>
                        </h5>
                    <?php else: ?>
                        <h5>
                            تعداد ورودی :
                            <span><?php echo e($item->count); ?></span>
                        </h5>
                    <?php endif; ?>
                    <h5>
                        زمان ثبت :
                        <span><?php echo e($item->created_at); ?></span>
                    </h5>
                    <div class="delete" id="<?php echo e($item->id); ?>">حذف</div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف جزییات مطمئن هستید؟</div>
                <p>اطلاعات جزییات به طور کامل حذف میشوند</p>
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
            $('.allReturnedPay .postItem').on('click' , '.delete' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/tank/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/tank/show.blade.php ENDPATH**/ ?>