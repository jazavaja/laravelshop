

<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/theme">تغییر دمو و رنگ</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/theme" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <div class="settingItem">
                <label for="">تغییر ویجت دمو</label>
                <select name="demo">
                    <option value="0" selected>انتخاب در صورت نیاز</option>
                    <option value="1">کلاسیک 1</option>
                    <option value="2">کلاسیک 2</option>
                    <option value="3">کلاسیک 3</option>
                    <option value="4">کلاسیک 4</option>
                </select>
            </div>
            <h3>حالت روشن</h3>
            <div class="settingItemPage">
                <div class="settingItem">
                    <label for="">رنگ پیشفرض (سبز)</label>
                    <input type="color" name="greenColorLight" value="<?php echo e($greenColorLight); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پیشفرض دوم(قرمز)</label>
                    <input type="color" name="redColorLight" value="<?php echo e($redColorLight); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه سایت</label>
                    <input type="color" name="backColorLight1" value="<?php echo e($backColorLight1); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت</label>
                    <input type="color" name="headerColorLight" value="<?php echo e($headerColorLight); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت 2</label>
                    <input type="color" name="headerColor2Light" value="<?php echo e($headerColor2Light); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه ویجت</label>
                    <input type="color" name="widgetColorLight" value="<?php echo e($widgetColorLight); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ باکس صفحه معرفی محصول</label>
                    <input type="color" name="singleColorLight" value="<?php echo e($singleColorLight); ?>">
                </div>
            </div>
            <h3>حالت دارک</h3>
            <div class="settingItemPage">
                <div class="settingItem">
                    <label for="">رنگ پیشفرض (سبز)</label>
                    <input type="color" name="greenColorDark" value="<?php echo e($greenColorDark); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پیشفرض دوم(قرمز)</label>
                    <input type="color" name="redColorDark" value="<?php echo e($redColorDark); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه سایت</label>
                    <input type="color" name="backColorDark1" value="<?php echo e($backColorDark1); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت</label>
                    <input type="color" name="headerColorDark" value="<?php echo e($headerColorDark); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت 2</label>
                    <input type="color" name="headerColor2Dark" value="<?php echo e($headerColor2Dark); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه ویجت</label>
                    <input type="color" name="widgetColorDark" value="<?php echo e($widgetColorDark); ?>">
                </div>
                <div class="settingItem">
                    <label for="">رنگ باکس صفحه معرفی محصول</label>
                    <input type="color" name="singleColorDark" value="<?php echo e($singleColorDark); ?>">
                </div>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/theme.blade.php ENDPATH**/ ?>