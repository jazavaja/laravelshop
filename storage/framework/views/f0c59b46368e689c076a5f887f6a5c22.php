<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/file">تنظیمات فایل</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/file" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <h3>مدیریت فایل</h3>
            <div class="settingItem">
                <label for="">کد های css فرانت در حالت لایت</label>
                <textarea style="direction: ltr;height: 40rem;" name="lightHomeCss"><?php echo e($lightHomeCss); ?></textarea>
            </div>
            <div class="settingItem">
                <label for="">کد های css فرانت در حالت دارک</label>
                <textarea style="direction: ltr;height: 40rem;" name="darkHomeCss"><?php echo e($darkHomeCss); ?></textarea>
            </div>
            <div class="settingItem">
                <label for="">کد های css ادمین</label>
                <textarea style="direction: ltr;height: 40rem;" name="adminCss"><?php echo e($adminCss); ?></textarea>
            </div>
            <div class="settingItem">
                <label for="">کد های robots.txt</label>
                <textarea style="direction: ltr;height: 40rem;" name="robot"><?php echo e($robot); ?></textarea>
            </div>
            <div class="settingItem">
                <label for="">کد های htaccess</label>
                <textarea style="direction: ltr;height: 40rem;" name="htaccess"><?php echo e($htaccess); ?></textarea>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/file.blade.php ENDPATH**/ ?>