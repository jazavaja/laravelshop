<?php $__env->startSection('tab',34); ?>
<?php $__env->startSection('content'); ?>
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>افزودن هزینه</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/pay">همه هزینه ها</a>
                    <span>/</span>
                    <a href="/admin/pay/create">افزودن هزینه</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>مبلغ کل (تومان)* :</label>
                        <input type="text" name="price" placeholder="قیمت را وارد کنید">
                        <div id="validation-price"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>درصد مالیات* :</label>
                        <input type="text" name="tax" placeholder="مثال : 10">
                        <div id="validation-tax"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیح* :</label>
                        <textarea name="note" placeholder="توضیحات"></textarea>
                        <div id="validation-note"></div>
                    </div>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            تاکسونامی
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>وضعیت پرداخت* :</label>
                                <select name="status" id="status">
                                    <option value="100" selected>پرداخت شده</option>
                                    <option value="0">پرداخت نشده</option>
                                    <option value="1">لغو شده</option>
                                </select>
                                <div id="validation-status"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>روش پرداخت* :</label>
                                <select name="methods" id="method">
                                    <option value="0" selected>پرداخت از درگاه</option>
                                    <option value="3">پرداخت اقساطی</option>
                                    <option value="5">کارت به کارت</option>
                                </select>
                                <div id="validation-methods"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="button" style="margin-top: 1rem;" name="createPost" type="submit">ارسال اطلاعات</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $("button[name='createPost']").click(function(event){
                $(this).text('منتظر بمانید');
                var price = $(".allCreatePostData input[name='price']").val();
                var tax = $(".allCreatePostData input[name='tax']").val();
                var status = $(".allCreatePostData select[name='status']").val();
                var methods = $(".allCreatePostData select[name='methods']").val();
                var note = $(".allCreatePostData textarea[name='note']").val();

                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    price:price,
                    tax:tax,
                    note:note,
                    status:status,
                    methods:methods,
                };
                $.ajax({
                    url: "/admin/cost/create",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "هزینه اضافه شد", // Text that is to be shown in the toast
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
                        window.location.href="/admin/cost";
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
                        $("button[name='createPost']").text('ثبت اطلاعات');
                    }
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/cost/create.blade.php ENDPATH**/ ?>