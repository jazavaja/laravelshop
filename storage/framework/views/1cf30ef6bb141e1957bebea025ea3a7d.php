<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/payment">تنظیمات درگاه</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <form method="post" action="/admin/setting/payment" class="settingMangeItems">
            <?php echo csrf_field(); ?>
            <div class="settingItem">
                <label>کد مرچنت زرینپال</label>
                <input type="text" name="zarinpal" value="<?php echo e($zarinpal); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کد مرچنت زیبال</label>
                <input type="text" name="zibal" value="<?php echo e($zibal); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کد مرچنت آیدی پی</label>
                <input type="text" name="idpay" value="<?php echo e($idpay); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کد مرچنت نکست پی</label>
                <input type="text" name="nextpay" value="<?php echo e($nextpay); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کد مرچنت سامان</label>
                <input type="text" name="samansep" value="<?php echo e($samansep); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>ترمینال آیدی به پرداخت</label>
                <input type="text" name="terminalBeh" value="<?php echo e($terminalBeh); ?>" placeholder="ترمینال آیدی را وارد کنید">
            </div>
            <div class="settingItem">
                <label>نام کاربری به پرداخت</label>
                <input type="text" name="userBeh" value="<?php echo e($userBeh); ?>" placeholder="نام کاربری را وارد کنید">
            </div>
            <div class="settingItem">
                <label>رمز به پرداخت</label>
                <input type="text" name="passwordBeh" value="<?php echo e($passwordBeh); ?>" placeholder="رمز را وارد کنید">
            </div>
            <div class="settingItem">
                <label>مرچنت پاسارگاد</label>
                <input type="text" name="merchantPasargad" value="<?php echo e($merchantPasargad); ?>" placeholder="مرچنت را وارد کنید">
            </div>
            <div class="settingItem">
                <label>ترمینال پاسارگاد</label>
                <input type="text" name="terminalPasargad" value="<?php echo e($terminalPasargad); ?>" placeholder="ترمینال را وارد کنید">
            </div>
            <div class="settingItem">
                <label>مدرک به صورت متن پاسارگاد</label>
                <input type="text" name="certificatePasargad" value="<?php echo e($certificatePasargad); ?>" placeholder="مدرک به صورت متن را وارد کنید">
            </div>
            <div class="settingItem">
                <label>مرچنت آسان پرداخت</label>
                <input type="text" name="terminalAsan" value="<?php echo e($terminalAsan); ?>" placeholder="مرچنت را وارد کنید">
            </div>
            <div class="settingItem">
                <label>نام کاربری آسان پرداخت</label>
                <input type="text" name="userAsan" value="<?php echo e($userAsan); ?>" placeholder="نام کاربری را وارد کنید">
            </div>
            <div class="settingItem">
                <label>رمز آسان پرداخت</label>
                <input type="text" name="passwordAsan" value="<?php echo e($passwordAsan); ?>" placeholder="رمز را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کلید سداد</label>
                <input type="text" name="keySadad" value="<?php echo e($keySadad); ?>" placeholder="کد را وارد کنید">
            </div>
            <div class="settingItem">
                <label>کد پذیرنده سداد</label>
                <input type="text" name="merchantSadad" value="<?php echo e($merchantSadad); ?>" placeholder="مرچنت آیدی را وارد کنید">
            </div>
            <div class="settingItem">
                <label>پایانه سداد</label>
                <input type="text" name="terminalSadad" value="<?php echo e($terminalSadad); ?>" placeholder="ترمینال آیدی را وارد کنید">
            </div>
            <div class="settingItem">
                <label>درگاه خود را انتخاب کنید</label>
                <select name="choicePay">
                    <option value="0">زرینپال</option>
                    <option value="1">زیبال</option>
                    <option value="2">نکست پی</option>
                    <option value="3">آیدی پی</option>
                    <option value="4">به پرداخت ملت</option>
                    <option value="5">سداد</option>
                </select>
            </div>
            <div class="settingItem">
                <label for="">اطلاعات حساب شما جهت خرید</label>
                <textarea name="cardText" class="editors" placeholder="اطلاعات حساب را وارد کنید"><?php echo e($cardText); ?></textarea>
            </div>
            <div class="allCreatePostDetailItem">
                <label for="s1d" class="allCreatePostDetailItemData">
                    پرداخت اقساطی
                    <input id="s1d" type="checkbox" name="installment" class="switch" >
                </label>
                <label for="s2d" class="allCreatePostDetailItemData">
                    پرداخت در محل
                    <input id="s2d" name="spot" type="checkbox" class="switch" >
                </label>
                <label for="s3d" class="allCreatePostDetailItemData">
                    پرداخت از درگاه
                    <input id="s3d" type="checkbox" name="gateway" class="switch" >
                </label>
                <label for="s4d" class="allCreatePostDetailItemData">
                    خرید کارت به کارت
                    <input id="s4d" type="checkbox" name="card" class="switch" >
                </label>
                <label for="zarinpalStatus1" class="allCreatePostDetailItemData">
                    امکان خرید از زرینپال
                    <input id="zarinpalStatus1" type="checkbox" name="zarinpalStatus" class="switch" >
                </label>
                <label for="zibalStatus1" class="allCreatePostDetailItemData">
                    امکان خرید از زیبال
                    <input id="zibalStatus1" type="checkbox" name="zibalStatus" class="switch" >
                </label>
                <label for="nextpayStatus1" class="allCreatePostDetailItemData">
                    امکان خرید از نکست پی
                    <input id="nextpayStatus1" type="checkbox" name="nextpayStatus" class="switch" >
                </label>
                <label for="idpayStatus1" class="allCreatePostDetailItemData">
                    امکان خرید از آیدی پی
                    <input id="idpayStatus1" type="checkbox" name="idpayStatus" class="switch" >
                </label>
                <label for="statusBeh1" class="allCreatePostDetailItemData">
                    امکان خرید از به پرداخت ملت
                    <input id="statusBeh1" type="checkbox" name="statusBeh" class="switch" >
                </label>
                <label for="statusSadad1" class="allCreatePostDetailItemData">
                    امکان خرید از سداد
                    <input id="statusSadad1" type="checkbox" name="statusSadad" class="switch" >
                </label>
                <label for="statusAsan1" class="allCreatePostDetailItemData">
                    امکان خرید از آسان پرداخت
                    <input id="statusAsan1" type="checkbox" name="statusAsan" class="switch" >
                </label>
                <label for="statusAsan2" class="allCreatePostDetailItemData">
                    امکان خرید از پاسارگاد
                    <input id="statusAsan2" type="checkbox" name="statusPasargad" class="switch" >
                </label>
                <label for="statusSaman1" class="allCreatePostDetailItemData">
                    امکان خرید از سامان(سپ)
                    <input id="statusSaman1" type="checkbox" name="statusSaman" class="switch" >
                </label>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $(".editors").ckeditor();
            var choicePay = <?php echo json_encode($choicePay, JSON_HEX_TAG); ?>;
            var spot = <?php echo json_encode($spot, JSON_HEX_TAG); ?>;
            var installment = <?php echo json_encode($installment, JSON_HEX_TAG); ?>;
            var gateway = <?php echo json_encode($gateway, JSON_HEX_TAG); ?>;
            var card = <?php echo json_encode($card, JSON_HEX_TAG); ?>;
            var zarinpalStatus = <?php echo json_encode($zarinpalStatus, JSON_HEX_TAG); ?>;
            var zibalStatus = <?php echo json_encode($zibalStatus, JSON_HEX_TAG); ?>;
            var nextpayStatus = <?php echo json_encode($nextpayStatus, JSON_HEX_TAG); ?>;
            var idpayStatus = <?php echo json_encode($idpayStatus, JSON_HEX_TAG); ?>;
            var statusBeh = <?php echo json_encode($statusBeh, JSON_HEX_TAG); ?>;
            var statusSadad = <?php echo json_encode($statusSadad, JSON_HEX_TAG); ?>;
            var statusAsan = <?php echo json_encode($statusAsan, JSON_HEX_TAG); ?>;
            var statusPasargad = <?php echo json_encode($statusPasargad, JSON_HEX_TAG); ?>;
            var statusSaman = <?php echo json_encode($statusSaman, JSON_HEX_TAG); ?>;
            $("select[name='choicePay']").val(choicePay);
            if(spot == 1){
                $("input[name='spot']").prop("checked", true );
            }
            if(installment == 1){
                $("input[name='installment']").prop("checked", true );
            }
            if(gateway == 1){
                $("input[name='gateway']").prop("checked", true );
            }
            if(card == 1){
                $("input[name='card']").prop("checked", true );
            }
            if(zarinpalStatus == 1){
                $("input[name='zarinpalStatus']").prop("checked", true );
            }
            if(zibalStatus == 1){
                $("input[name='zibalStatus']").prop("checked", true );
            }
            if(nextpayStatus == 1){
                $("input[name='nextpayStatus']").prop("checked", true );
            }
            if(idpayStatus == 1){
                $("input[name='idpayStatus']").prop("checked", true );
            }
            if(statusBeh == 1){
                $("input[name='statusBeh']").prop("checked", true );
            }
            if(statusSadad == 1){
                $("input[name='statusSadad']").prop("checked", true );
            }
            if(statusAsan == 1){
                $("input[name='statusAsan']").prop("checked", true );
            }
            if(statusPasargad == 1){
                $("input[name='statusPasargad']").prop("checked", true );
            }
            if(statusSaman == 1){
                $("input[name='statusSaman']").prop("checked", true );
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/payment.blade.php ENDPATH**/ ?>