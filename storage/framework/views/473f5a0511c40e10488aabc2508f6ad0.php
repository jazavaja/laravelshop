<?php $__env->startSection('tab',9); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/comment">دیدگاه</a>
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
                    <form method="GET" action="/admin/comment" class="filterContent">
                        <div class="filterContentItem">
                            <label>وضعیت ارسال</label>
                            <select name="status">
                                <option value="2">همه</option>
                                <option value="0">در حال بررسی</option>
                                <option value="1">تایید شده</option>
                            </select>
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
        <table>
            <tr>
                <th>آیدی</th>
                <th>تصویر</th>
                <th>عنوان</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td>
                        <?php if($item->product): ?>
                            <div class="pic">
                                <?php if($item->product->image != '[]'): ?>
                                    <img src="<?php echo e(json_decode($item->product->image)[0]); ?>" alt="<?php echo e($item->product->titleSeo); ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td>
                        <div class="buttons">
                            <a href="/admin/comment/<?php echo e($item->id); ?>/edit">ویرایش</a>
                            <button id="<?php echo e($item->id); ?>">حذف</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php echo e($comments->links('admin.paginate')); ?>

        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف دیدگاه مطمئن هستید؟</div>
                <p>با حذف دیدگاه اطلاعات دیدگاه به طور کامل حذف میشوند</p>
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
            $('.buttons').on('click' , 'button' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/comment/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/comment/index.blade.php ENDPATH**/ ?>