<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/message">تنظیمات پیامک</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/message" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <div class="settingItem">
                <label for="">کد پترن برای ثبتنام (یک متغیر : متغیر اول کد یکبار مصرف)</label>
                <input type="text" name="messageAuth" value="<?php echo e($messageAuth); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن ثبت سفارش (دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageSuccess" value="<?php echo e($messageSuccess); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن اطلاع از فروش ویژه(دو متغیر : متغیر اول نام کاربر و متغیر دوم نام محصول)</label>
                <input type="text" name="messageSuggest" value="<?php echo e($messageSuggest); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن لغو سفارش(دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageCancel" value="<?php echo e($messageCancel); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن بازگشت پول(سه متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش و متغیر سوم مبلغ)</label>
                <input type="text" name="messageBack" value="<?php echo e($messageBack); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن اطلاع به مدیر از ثبت سفارش(سه متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش و متغیر سوم مبلغ)</label>
                <input type="text" name="messageManager" value="<?php echo e($messageManager); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت در انتظار بررسی(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus0" value="<?php echo e($messageStatus0); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت بسته بندی شده(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus1" value="<?php echo e($messageStatus1); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت تحویل پیک(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus2" value="<?php echo e($messageStatus2); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت تکمیل شده(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus3" value="<?php echo e($messageStatus3); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن مشاوره فوری(دو متغیر : متغیر اول شماره تماس و متغیر دوم عنوان محصول)</label>
                <input type="text" name="messageCounseling" value="<?php echo e($messageCounseling); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن خوش آمدگویی(یک متغیر : متغیر اول نام کاربر)</label>
                <input type="text" name="messageRegister" value="<?php echo e($messageRegister); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن ارسال کد رهگیری(دو متغیر : متغیر اول نام کاربر و متغیر دوم کد رهگیری)</label>
                <input type="text" name="messageTrack" value="<?php echo e($messageTrack); ?>" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری ملی پیامک</label>
                <input type="text" name="userSms" value="<?php echo e($userSms); ?>" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور ملی پیامک</label>
                <input type="text" name="passSms" value="<?php echo e($passSms); ?>" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">کلید کاوه نگار</label>
                <input type="text" name="kaveKey" value="<?php echo e($kaveKey); ?>" placeholder="API Key">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری فراز</label>
                <input type="text" name="userFaraz" value="<?php echo e($userFaraz); ?>" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور فراز</label>
                <input type="text" name="passFaraz" value="<?php echo e($passFaraz); ?>" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">شماره تماس فراز</label>
                <input type="text" name="numberFaraz" value="<?php echo e($numberFaraz); ?>" placeholder="شماره">
            </div>
            <div class="settingItem">
                <label for="">سامانه پیامکی شما</label>
                <select name="typeSms">
                    <option value="0">قاصدک</option>
                    <option value="1">ملی پیامک</option>
                    <option value="2">کاوه نگار</option>
                    <option value="3">فراز اس ام اس</option>
                </select>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var typeSms = <?php echo json_encode($typeSms, JSON_HEX_TAG); ?>;
            $("select[name='typeSms']").val(typeSms);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/message.blade.php ENDPATH**/ ?>