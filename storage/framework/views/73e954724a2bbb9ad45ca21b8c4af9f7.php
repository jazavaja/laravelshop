<?php $__env->startSection('tab',20); ?>
<?php $__env->startSection('content'); ?>
    <div class="allExcelPanel">
        <div class="allExcelPanelTop">
            <h1>درون ریزی</h1>
            <div class="allExcelPanelTitle">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/import">درون ریزی</a>
            </div>
        </div>
        <div class="items">
            <div class="item import1">
                <div class="abilityPost">
                    <div class="abilityTitle">
                        <label>چینش اکسل محصولات</label>
                    </div>
                    <table class="abilityTable" id="pays">
                        <tr>
                            <th>1-عنوان</th>
                            <th>2-کد محصول</th>
                            <th>3-مبلغ اصلی</th>
                            <th>4-تخفیف</th>
                            <th>5-تعداد</th>
                            <th>6-تصویر (با , جدا کنید)</th>
                            <th>7-توضیح اجمالی</th>
                            <th>8-توضیح کامل</th>
                            <th>9- پیوند (slug)</th>
                        </tr>
                    </table>
                </div>
                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="sendImage">
                        <input type="file" id="post_cover" class="dropify" name="image"/>
                    </div>
                    <button type="submit" id="upload-image">آپلود</button>
                </form>
            </div>
            <div class="item import2">
                <div class="abilityPost">
                    <div class="abilityTitle">
                        <label>چینش اکسل بلاگ</label>
                    </div>
                    <table class="abilityTable" id="blogs">
                        <tr>
                            <th>1- عنوان</th>
                            <th>2- پیوند (slug)</th>
                            <th>3- تصویر</th>
                            <th>4- توضیحات اجمالی</th>
                            <th>5- توضیحات کامل</th>
                        </tr>
                    </table>
                </div>
                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="sendImage">
                        <input type="file" id="post_cover" class="dropify" name="image"/>
                    </div>
                    <button type="submit" id="upload-image">آپلود</button>
                </form>
            </div>
            <div class="item import3">
                <div class="abilityPost">
                    <div class="abilityTitle">
                        <label>چینش اکسل کاربران</label>
                    </div>
                    <table class="abilityTable" id="users">
                        <tr>
                            <th>1- نام</th>
                            <th>2- شماره</th>
                            <th>3- ایمیل</th>
                            <th>4- تصویر</th>
                        </tr>
                    </table>
                </div>
                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="sendImage">
                        <input type="file" id="post_cover" class="dropify" name="image"/>
                    </div>
                    <button type="submit" id="upload-image">آپلود</button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts4'); ?>
    <script>
        $(document).ready(function(){
            $('.import1 #upload-image-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('.import1 #upload-image').text('صبر کنید ..');
                $.ajax({
                    type:'POST',
                    url: `/admin/import-product`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.import1 #upload-image').text('آپلود');
                        alert('محصول منتقل شد')
                    },
                    error: function(response){
                        $('.import1 #upload-image').text('آپلود');
                        $('#image-input-error').text(response.responseJSON.errors.file);
                    }
                });
            });
            $('.import2 #upload-image-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('.import2 #upload-image').text('صبر کنید ..');
                $.ajax({
                    type:'POST',
                    url: `/admin/import-blog`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.import2 #upload-image').text('آپلود');
                        alert('بلاگ منتقل شد')
                    },
                    error: function(response){
                        $('.import2 #upload-image').text('آپلود');
                        $('#image-input-error').text(response.responseJSON.errors.file);
                    }
                });
            });
            $('.import3 #upload-image-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('.import3 #upload-image').text('صبر کنید ..');
                $.ajax({
                    type:'POST',
                    url: `/admin/import-user`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('.import3 #upload-image').text('آپلود');
                        alert('بلاگ منتقل شد')
                    },
                    error: function(response){
                        $('.import3 #upload-image').text('آپلود');
                        $('#image-input-error').text(response.responseJSON.errors.file);
                    }
                });
            });

            $('.dropify').dropify({
                messages: {
                    default: "بکشید و رها کنید یا برای انتخاب کلیک کنید.",
                    replace: "برای جایگزین کردن تصویر بکشید و رها کنید.",
                    remove: "حذف تصویر",
                    error: "خطایی به وجود آمده است. دوباره تلاش کنید.",
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('links2'); ?>
    <link rel="stylesheet" href="/css/dropify.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript2'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/dropify.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/excel/import.blade.php ENDPATH**/ ?>