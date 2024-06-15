<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/float">تنظیمات شناور</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <div class="settingMangeItems">
            <div class="abilityPost">
                <div class="abilityTitle">
                    <label>لینک ها</label>
                    <i id="addColor">
                        <svg class="icon">
                            <use xlink:href="#add"></use>
                        </svg>
                    </i>
                </div>
                <table class="abilityTable" id="colors">
                    <tr>
                        <th>نوع</th>
                        <th>عنوان</th>
                        <th>لینک</th>
                        <th>آیکن</th>
                        <th>حذف</th>
                    </tr>
                </table>
            </div>
            <button name="createPost">ثبت اطلاعات</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function() {
            var floats = <?php echo $floats->toJson(); ?>;
            if(floats.length) {
                $.each(floats,function(){
                    $('#colors').append(
                        $('<tr><td>' +
                            '<select name="type">' +
                            '<option value="0"'+(this.type == 0 ? 'selected': '')+'>شبکه اجتماعی</option>' +
                            '<option value="1"'+(this.type == 1 ? 'selected': '')+'>لینک</option></select>' +
                            '</td><td><input type="text" placeholder="عنوان" value="'+this.title+'" name="title"></td><td><input type="text" placeholder="لینک را وارد کنید ..." name="link" value="'+this.link+'"></td><td>' +
                            '<select name="icon">' +
                            '<option value="0" '+(this.icon == 0 ? 'selected': '')+'>اینستاگرام</option>' +
                            '<option value="1"'+(this.icon == 1 ? 'selected': '')+'>واتساپ</option>' +
                            '<option value="2" '+(this.icon == 2 ? 'selected': '')+'>تلگرام</option>' +
                            '<option value="3" '+(this.icon == 3 ? 'selected': '')+'>تماس</option>' +
                            '<option value="4" '+(this.icon == 4 ? 'selected': '')+'>برگه</option>' +
                            '<option value="5" '+(this.icon == 5 ? 'selected': '')+'>لینک</option>' +
                            '<option value="6" '+(this.icon == 6 ? 'selected': '')+'>خانه</option>' +
                            '</select></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></td></tr>')
                            .on('click' , '#deleteColor',function(ss){
                                ss.currentTarget.parentElement.parentElement.remove();
                            })
                    );
                })
            }
            $("button[name='createPost']").click(function (event) {
                $(this).text('منتظر بمانید');

                var colors = [];
                $("#colors tr").each(function () {
                    if ($(this).find("input").length >= 1) {
                        var color = {
                            title: "",
                            type: "",
                            icon: "",
                            link: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'title') {
                                color.title = this.value;
                            }
                            if (this.name == 'link') {
                                color.link = this.value;
                            }
                        })
                        $(this).find("select").each(function () {
                            if (this.name == 'type') {
                                color.type = this.value;
                            }
                            if (this.name == 'icon') {
                                color.icon = this.value;
                            }
                        })
                        colors.push(color);
                    }
                });
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    colors: JSON.stringify(colors),
                };

                $.ajax({
                    url: "/admin/setting/float",
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
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">' + value + '</div');
                        });
                        $("button[name='createPost']").text('ثبت اطلاعات');
                    }
                });
            });
            $('#addColor').click(function () {
                $('#colors').append(
                    $(
                        '<tr><td><select name="type"><option value="0">شبکه اجتماعی</option><option value="1">لینک</option></select></td><td><input type="text" placeholder="عنوان" name="title"></td><td><input type="text" placeholder="لینک را وارد کنید ..." name="link"></td><td><select name="icon"><option value="0">اینستاگرام</option><option value="1">واتساپ</option><option value="2">تلگرام</option><option value="3">تماس</option><option value="4">برگه</option><option value="5">لینک</option><option value="6">خانه</option></select></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></td></tr>')
                        .on('click', '#deleteColor', function (ss) {
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
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


<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/float.blade.php ENDPATH**/ ?>