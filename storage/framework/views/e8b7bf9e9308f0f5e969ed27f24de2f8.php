<?php $__env->startSection('tab',22); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/sellers">همه فروشندگان</a>
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
                    <form method="GET" action="/admin/sellers" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر نام و آیدی و شماره و ایمیل</label>
                            <input type="text" name="title" placeholder="جستجو ..." value="<?php echo e($title); ?>">
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
        <div class="allTableContainer">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem">
                    <div class="postTop">
                        <div class="postTitle">
                            <div class="postImages">
                                <div class="postImage">
                                    <img src="/img/user.png" alt="<?php echo e($item->title); ?>">
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <span>نام فروشگاه :</span>
                                    <span><?php echo e($item->name); ?></span>
                                </li>
                                <li>
                                    <span>آیدی کاربر :</span>
                                    <span><?php echo e($item->id); ?></span>
                                </li>
                                <li>
                                    <span>درآمد :</span>
                                    <span><?php echo e(number_format($item->cooperation2_count)); ?> تومان </span>
                                </li>
                            </ul>
                        </div>
                        <div class="postOptions">
                            <?php if(count($item->document) >= 1): ?>
                                <a href="/admin/document/<?php echo e($item->document[0]->id); ?>/edit" title="ویرایش فروشنده">
                                    <svg class="icon">
                                        <use xlink:href="#edit"></use>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <i title="حذف کاربر" class="deleteUser" id="<?php echo e($item->id); ?>">
                                <svg class="icon">
                                    <use xlink:href="#trash"></use>
                                </svg>
                            </i>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>شماره تماس :</span>
                                <span><?php echo e($item->number); ?></span>
                            </li>
                            <li>
                                <span>ایمیل :</span>
                                <span><?php echo e($item->email); ?></span>
                            </li>
                            <li>
                                <span>زمان ثبت :</span>
                                <span><?php echo e($item->created_at); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($users->links('admin.paginate')); ?>

        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف فروشنده مطمئن هستید؟</div>
                <p>با حذف فروشنده کاربر حذف نخواهد شد و صرفا از بخش فروشندگی خارج میشود</p>
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
            $('.popUp').hide();
            $('.filterContent').hide();
            $('.filemanager').show();
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
            $('.allTableContainer .postItem').on('click' , '.deleteUser' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/sellers/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/seller/index.blade.php ENDPATH**/ ?>