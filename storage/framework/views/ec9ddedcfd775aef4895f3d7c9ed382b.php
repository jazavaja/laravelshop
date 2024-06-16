<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/seo">تنظیمات سئو</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/seo" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <div class="settingItem">
                <label for="">عنوان فعالیت سایت</label>
                <input type="text" name="titleSeo" value="<?php echo e($titleSeo); ?>" placeholder="نام را وارد کنید">
            </div>
            <div class="settingItem">
                <label for="">کلمات کلیدی سایت</label>
                <input type="text" name="keyword" value="<?php echo e($keyword); ?>" placeholder="با , جدا کنید">
            </div>
            <div class="settingItem">
                <label for="">توضیحات سئو سایت</label>
                <textarea name="aboutSeo" placeholder="توضیحات را وارد کنید"><?php echo e($aboutSeo); ?></textarea>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/seo.blade.php ENDPATH**/ ?>