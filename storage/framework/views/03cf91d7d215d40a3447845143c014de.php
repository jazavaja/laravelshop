<div class="singleNotification">
    <div class="singleNotificationItems">
        <div class="singleNotificationTitle">
            <h3><?php echo e(__('messages.note_suggest')); ?></h3>
        </div>
        <i>
            <svg class="icon">
                <use xlink:href="#bell2"></use>
            </svg>
        </i>
        <div class="singleNotificationData">
            <div class="singleNotificationItem">
                <label for="پیامک">
                    <input id="پیامک" type="checkbox">
                    <?php echo e(__('messages.note_suggest2')); ?>

                </label>
            </div>
            <div class="singleNotificationItem">
                <label for="ایمیل">
                    <input id="ایمیل" type="checkbox">
                    <?php echo e(__('messages.note_suggest3')); ?>

                </label>
            </div>
        </div>
        <div class="singleNotificationButtons">
            <button id="sendNot"><?php echo e(__('messages.send')); ?></button>
            <button id="cancelNot"><?php echo e(__('messages.cancel')); ?></button>
        </div>
    </div>
</div>

<?php $__env->startSection('script2'); ?>
    <script>
        $(document).ready(function(){
            var product_id = <?php echo $product_id; ?>;
            var checked = [];
            $.each($('.singleNotificationItems input'),function(){
                $(this).prop('checked', false);
            });
            $('.singleNotificationItems #sendNot').prop('disabled', true);
            $('.singleNotificationItem input').on('change' ,function (){
                checked = [];
                $.each($('.singleNotificationItems input'),function(){
                    if(this.checked){
                        checked.push($(this).attr('id'))
                    }
                });
                if(checked.length){
                    $('.singleNotificationItems #sendNot').prop('disabled', false);
                }else{
                    $('.singleNotificationItems #sendNot').prop('disabled', true);
                }
            });

            $('.singleNotificationButtons #cancelNot').click(function (){
                $('.allNotification').hide();
            });
            var success1 = <?php echo json_encode(__('messages.success'), JSON_HEX_TAG); ?>;
            var notice_suggest1 = <?php echo json_encode(__('messages.notice_suggest'), JSON_HEX_TAG); ?>;
            var need_login2 = <?php echo json_encode(__('messages.need_login2'), JSON_HEX_TAG); ?>;
            var log_first = <?php echo json_encode(__('messages.log_first'), JSON_HEX_TAG); ?>;
            $('.singleNotificationButtons #sendNot').click(function (){
                if(checked.length) {
                    var form = {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "product_id": product_id,
                        "datas": JSON.stringify(checked),
                    };

                    $.ajax({
                        url: "/send-report",
                        type: "post",
                        data: form,
                        success: function (data) {
                            if (data == 'success') {
                                $.toast({
                                    text: notice_suggest1, // Text that is to be shown in the toast
                                    heading: success1, // Optional heading to be shown on the toast
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
                                $('.allNotification').hide();
                            }
                            if (data == 'noUser') {
                                $.toast({
                                    text: log_first, // Text that is to be shown in the toast
                                    heading: need_login2, // Optional heading to be shown on the toast
                                    icon: 'error', // Type of toast icon
                                    showHideTransition: 'fade', // fade, slide or plain
                                    allowToastClose: true, // Boolean value true or false
                                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                    textAlign: 'left',
                                    loader: true,
                                    loaderBg: '#c60000',
                                });
                            }
                        },
                    });
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php /**PATH /var/www/html/resources/views/home/single/notification.blade.php ENDPATH**/ ?>