<?php $__env->startSection('tab' , 3); ?>
<?php $__env->startSection('content'); ?>
<div class="allWidgetIndex">
    <div class="topProductIndex">
        <div class="right">
            <a href="/admin">داشبورد</a>
            <span>/</span>
            <a href="/admin/widget">ویجت ها</a>
            <span>/</span>
            <a href="/admin/widget/create">افزودن ویجت</a>
        </div>
    </div>
    <div class="allWidget">
        <table>
            <thead>
                <tr>
                    <th>نوع</th>
                    <th>عنوان</th>
                    <th>زبان</th>
                    <th>وضعیت نمایش</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody id="sort-1">
                <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td id="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->language); ?></td>
                        <td>
                            <?php if($item->status == 0): ?>
                                پیشنویس
                            <?php else: ?>
                                منتشر شده
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="buttons">
                                <a href="/admin/widget/<?php echo e($item->id); ?>/edit">ویرایش</a>
                                <button class="deleteUser" id="<?php echo e($item->id); ?>">حذف</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="popUp" style="display:none;">
        <div class="popUpItem">
            <div class="title">آیا از حذف ویجت مطمئن هستید؟</div>
            <p>با حذف ویجت اطلاعات ویجت به طور کامل حذف میشوند</p>
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
            var typeWidget = <?php echo json_encode($type, JSON_HEX_TAG); ?>;
            $('.popUp').hide();
            $( "#sort-1" ).sortable({
                update: function(event, ui) {
                    var data = [];
                    $('tbody tr').each(function(){
                        data.push(this.firstElementChild.id);
                    })
                    var form = {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        widget:data,
                        type:typeWidget,
                    };

                    $.ajax({
                        url: "/admin/widget",
                        type: "post",
                        data: form,
                    });
                }
            });
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('table tr').on('click' , '.deleteUser' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/widget/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery-ui.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/widget/index.blade.php ENDPATH**/ ?>