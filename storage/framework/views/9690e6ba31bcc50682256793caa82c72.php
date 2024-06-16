<?php $__env->startSection('tab' , 8); ?>
<?php $__env->startSection('content'); ?>
    <div class="profileIndexTicket">
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <table>
            <tr>
                <th>کاربر</th>
                <th>محصول</th>
                <th>سایز</th>
                <th>رنگ</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <span><?php echo e($item->user->name); ?></span>
                    </td>
                    <td>
                        <span><?php echo e($item->product->title); ?></span>
                    </td>
                    <td>
                        <span><?php echo e($item->size); ?></span>
                    </td>
                    <td>
                        <span><?php echo e($item->color); ?></span>
                    </td>
                    <td>
                        <span><?php echo e($item->created_at); ?></span>
                    </td>
                    <td>
                        <div class="buttons">
                            <button id="<?php echo e($item->id); ?>" class="accept" status="2">موجود</button>
                            <button id="<?php echo e($item->id); ?>" class="reject" status="1">ناموجود</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.buttons button').on('click' ,function(ss){
                ss.currentTarget.parentElement.parentElement.parentElement.remove();
                post = this.id;
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "post": post,
                    "status": $(this).attr('status'),
                };
                $.ajax({
                    url: "/admin/inquiry/change",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if (data == 'ok') {
                            $.toast({
                                text: "اطلاعات ثبت شد", // Text that is to be shown in the toast
                                heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });

                        }
                    },
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/inventory/inquiry.blade.php ENDPATH**/ ?>