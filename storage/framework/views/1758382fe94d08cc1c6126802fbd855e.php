<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allCategorySetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/category">تنظیمات دسته بندی</a>
            </div>
        </div>
        <div class="settingItems">
            <div class="right">
                <div class="item">
                    دسته بندی هدر
                    <i>
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
            </div>
            <div class="left">
                <div class="leftItems">
                    <div class="leftItem">
                        <h4>دسته بندی های شما</h4>
                        <ul id="sortable1" class="connectedSortable">
                            <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="ui-state-default"><?php echo e($item->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="leftItem">
                        <h4>دسته بندی انتخابی</h4>
                        <ul id="sortable2" class="connectedSortable">
                            <?php $__currentLoopData = $catHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="ui-state-default"><?php echo e($item); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
<script>
    $(document).ready(function() {
        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable",
            update: function(event, ui) {

                var catHeader = [];
                $("#sortable2 li").each(function(){
                    catHeader.push(this.textContent);
                });

                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    catHeader:catHeader.join(','),
                };

                $.ajax({
                    url: "/admin/setting/category",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "تنظیمات ثبت شد", // Text that is to be shown in the toast
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
                    },
                });
            }
        }).disableSelection();
    })
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/category.blade.php ENDPATH**/ ?>