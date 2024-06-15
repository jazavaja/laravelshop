<?php $__env->startSection('tab',9); ?>
<?php $__env->startSection('content'); ?>
    <div class="allCommentPanel">
        <div class="addComment">
            <div class="right">
                <div class="sendCommentItem">
                    <label for="status">وضعیت*</label>
                    <select name="status" id="status">
                        <option value="0">در حال بررسی</option>
                        <option value="1">تایید شده</option>
                    </select>
                </div>
                <div class="sendCommentItem">
                    <label for="title">عنوان*</label>
                    <input type="text" id="title" placeholder="عنوان را وارد کنید ..." value="<?php echo e($comment->title); ?>" name="title">
                    <div id="validation-title"></div>
                </div>
                <div class="sendCommentItem" id="goodContainer">
                    <div class="sendCommentItemTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#circle"></use>
                            </svg>
                        </i>
                        <label>نقاط قوت</label>
                    </div>
                    <label for="good">
                        <input type="text" id="good" placeholder="نقطه قوت را وارد کنید ..." name="good">
                        <i id="goodBtn">
                            <svg class="icon">
                                <use xlink:href="#plus2"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="sendCommentItem" id="badContainer">
                    <div class="sendCommentItemTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#circle"></use>
                            </svg>
                        </i>
                        <label>نقاط ضعف</label>
                    </div>
                    <label>
                        <input type="text" id="bad" placeholder="نقطه ضعف را وارد کنید" name="bad">
                        <i id="badBtn">
                            <svg class="icon">
                                <use xlink:href="#plus2"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="sendCommentItem">
                    <label for="bodyText">توضیحات*</label>
                    <textarea name="body" id="bodyText" placeholder="توضیحات را وارد کنید"><?php echo e($comment->body); ?></textarea>
                    <div id="validation-body"></div>
                </div>
            </div>
            <div>
                <div class="left">
                    <div class="titlePost">ثبت نظرات</div>
                    <h5>لطفا پیش از ارسال نظر، خلاصه قوانین زیر را مطالعه کنید</h5>
                    <ul>
                        <li>
                            لازم است محتوای ارسالی منطبق برعرف و شئونات جامعه و با بیانی رسمی
                            و عاری از لحن تند، تمسخرو توهین باشد
                        </li>
                        <li>
                            از ارسال لینک‌ سایت‌های دیگر و ارایه‌ی اطلاعات شخصی نظیر شماره تماس
                            ایمیل و آیدی شبکه‌های اجتماعی پرهیز کنید
                        </li>
                        <li>
                            در نظر داشته باشید هدف نهایی از ارائه‌ی نظر درباره‌ی کالا ارائه‌ی اطلاعات
                            مشخص و مفید برای راهنمایی سایر کاربران در فرآیند انتخاب و خرید یک
                            محصول است
                        </li>
                        <li>
                            در نظر داشته باشید هدف نهایی از ارائه‌ی نظر درباره‌ی کالا ارائه‌ی اطلاعات
                            مشخص و مفید برای راهنمایی سایر کاربران در فرآیند انتخاب و خرید یک
                            محصول است
                        </li>
                    </ul>
                    <div class="allCommentButtons">
                        <button id="createComment">ارسال</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var comment = <?php echo $comment->toJson(); ?>;
            $('.sendCommentItem select').val(comment.status);
            if(comment.good){
                $.each(JSON.parse(comment.good),function(){
                    $('#goodContainer').append(
                        $('<span>'+this+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click' , 'i',function(ss){
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                })
            }
            if(comment.bad){
                $.each(JSON.parse(comment.bad),function(){
                    $('#badContainer').append(
                        $('<span>'+this+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click' , 'i',function(ss){
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                })
            }

            $('#goodBtn').click(function(){
                if($("#good").val() != ''){
                    $('#goodContainer').append(
                        $('<span>'+$("#good").val()+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click' , 'i',function(ss){
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                    $('#good').val('');
                }
            })
            var keycode = 0;
            $('#good').keypress(function(event){
                if($("#good").val() != ''){
                    keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13') {
                        $('#goodContainer').append(
                            $('<span>' + $("#good").val() + '<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                                .on('click', 'i', function (ss) {
                                    ss.currentTarget.parentElement.remove();
                                })
                        );
                        $('#good').val('');
                    }
                }
            })
            $('#bad').keypress(function(event){
                if($("#bad").val() != ''){
                    keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13') {
                        $('#badContainer').append(
                            $('<span>' + $("#bad").val() + '<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                                .on('click', 'i', function (ss) {
                                    ss.currentTarget.parentElement.remove();
                                })
                        );
                        $('#bad').val('');
                    }
                }
            })
            $('#badBtn').click(function(){
                if($("#bad").val() != ''){
                    $('#badContainer').append(
                        $('<span>'+$("#bad").val()+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click' , 'i',function(ss){
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                    $('#bad').val('');
                }
            })
            $('.allCommentButtons #createComment').click(function (){
                var bads = [];
                var goods = [];
                var title = $("input[name='title']").val();
                var body = $("textarea[name='body']").val();
                var status = $("select[name='status']").val();
                $.each($('#badContainer span') , function (){
                    bads.push(this.textContent);
                })
                $.each($('#goodContainer span') , function (){
                    goods.push(this.textContent);
                })

                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "_method": "post",
                    title:title,
                    status:status,
                    body:body,
                    good:JSON.stringify(goods),
                    bad:JSON.stringify(bads),
                };

                $.ajax({
                    url: "/admin/comment/"+comment.id+'/edit',
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "دیدگاه بعد از تایید منتشر خواهد شد", // Text that is to be shown in the toast
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
                        window.location.href = '/admin/comment';
                    },
                    error: function (xhr) {
                        $.toast({
                            text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
                            heading: 'دقت کنید', // Optional heading to be shown on the toast
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
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">'+value+'</div');
                        });
                    }
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery.toast.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/comment/edit.blade.php ENDPATH**/ ?>