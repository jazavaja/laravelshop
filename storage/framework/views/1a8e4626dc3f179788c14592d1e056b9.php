<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/script">تنظیمات اسکریپت</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/script" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <h3>مدیریت اسکریپت</h3>
            <div class="settingItem">
                <label for="">اسکریپت یا کد html در تگ Head</label>
                <textarea name="headScript" placeholder="با Enter میتوانید جدا کنید"><?php echo e($headScript); ?></textarea>
            </div>
            <div class="settingItem">
                <label for="">اسکریپت یا کد html در تگ Body</label>
                <textarea name="bodyScript" placeholder="با Enter میتوانید جدا کنید"><?php echo e($bodyScript); ?></textarea>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/script.blade.php ENDPATH**/ ?>