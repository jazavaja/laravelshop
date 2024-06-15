<?php $__env->startSection('tab',4); ?>

<?php $__env->startSection('content'); ?>
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/manage">تنظیمات سایت</a>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <div class="forms">
            <div>
                <form method="post" action="/admin/setting/manage" class="settingMangeItems">
                    <?php echo csrf_field(); ?>
                    <h3>مدیریت سایت</h3>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">نام وبسایت (فارسی)</label>
                            <input type="text" name="name" value="<?php echo e($name); ?>" placeholder="نام را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">عنوان فعالیت (فارسی)</label>
                            <input type="text" name="title" value="<?php echo e($title); ?>" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">نام وبسایت (عربی)</label>
                            <input type="text" name="nameAr" value="<?php echo e($nameAr); ?>" placeholder="نام را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">عنوان فعالیت (عربی)</label>
                            <input type="text" name="titleAr" value="<?php echo e($titleAr); ?>" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">نام وبسایت (انگلیسی)</label>
                            <input type="text" name="nameEn" value="<?php echo e($nameEn); ?>" placeholder="نام را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">عنوان فعالیت (انگلیسی)</label>
                            <input type="text" name="titleEn" value="<?php echo e($titleEn); ?>" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">نام وبسایت (ترکی)</label>
                            <input type="text" name="nameTr" value="<?php echo e($nameTr); ?>" placeholder="نام را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">عنوان فعالیت (ترکی)</label>
                            <input type="text" name="titleTr" value="<?php echo e($titleTr); ?>" placeholder="عنوان را وارد کنید">
                        </div>
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <div class="settingItem">
                        <label for="">ایمیل وبسایت</label>
                        <input type="text" name="email" value="<?php echo e($email); ?>" placeholder="email@example.ir">
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">آدرس شرکت (فارسی)</label>
                            <input type="text" name="address" value="<?php echo e($address); ?>" placeholder="تهران">
                        </div>
                        <div class="settingItem">
                            <label for="">آدرس شرکت (انگلیسی)</label>
                            <input type="text" name="addressEn" value="<?php echo e($addressEn); ?>" placeholder="تهران">
                        </div>
                        <div class="settingItem">
                            <label for="">آدرس شرکت (عربی)</label>
                            <input type="text" name="addressAr" value="<?php echo e($addressAr); ?>" placeholder="تهران">
                        </div>
                        <div class="settingItem">
                            <label for="">آدرس شرکت (ترکی)</label>
                            <input type="text" name="addressTr" value="<?php echo e($addressTr); ?>" placeholder="تهران">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">رنگ هدر</label>
                            <input type="color" name="headerColor" value="<?php echo e($headerColor); ?>" placeholder="کد را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">رنگ ساید بار</label>
                            <input type="color" name="sideColor" value="<?php echo e($sideColor); ?>" placeholder="کد را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">کد نماد فناوری اطلاعات</label>
                            <input type="text" name="fanavari" value="<?php echo e($fanavari); ?>" placeholder="کد را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">کد نماد اعتماد</label>
                            <input type="text" name="etemad" value="<?php echo e($etemad); ?>" placeholder="کد را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">شماره تماس</label>
                            <input type="text" name="number" value="<?php echo e($number); ?>" placeholder="شماره را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">حروف قبل کد محصول</label>
                            <input type="text" name="productId" value="<?php echo e($productId); ?>" placeholder="DM">
                        </div>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">صفحه فیسبوک</label>
                            <input type="text" name="facebook" value="<?php echo e($facebook); ?>" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه اینستاگرام</label>
                            <input type="text" name="instagram" value="<?php echo e($instagram); ?>" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه توییتر</label>
                            <input type="text" name="twitter" value="<?php echo e($twitter); ?>" placeholder="لینک را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">صفحه تلگرام</label>
                            <input type="text" name="telegram" value="<?php echo e($telegram); ?>" placeholder="لینک را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItem">
                        <label for="">درباره ما(فارسی)</label>
                        <textarea name="about" placeholder="توضیحات را وارد کنید"><?php echo e($about); ?></textarea>
                    </div>
                    <div class="settingItem">
                        <label for="">درباره ما(انگلیسی)</label>
                        <textarea name="aboutEn" placeholder="توضیحات را وارد کنید"><?php echo e($aboutEn); ?></textarea>
                    </div>
                    <div class="settingItem">
                        <label for="">درباره ما(عربی)</label>
                        <textarea name="aboutAr" placeholder="توضیحات را وارد کنید"><?php echo e($aboutAr); ?></textarea>
                    </div>
                    <div class="settingItem">
                        <label for="">درباره ما(ترکی)</label>
                        <textarea name="aboutTr" placeholder="توضیحات را وارد کنید"><?php echo e($aboutTr); ?></textarea>
                    </div>
                    <div class="settingItemPage">
                        <div class="settingItem">
                            <label for="">متن شناور سمت چپ(فارسی)</label>
                            <input type="text" name="textFloat" value="<?php echo e($textFloat); ?>" placeholder="متن را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">متن شناور سمت چپ(انگلیسی)</label>
                            <input type="text" name="textFloatEn" value="<?php echo e($textFloatEn); ?>" placeholder="متن را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">متن شناور سمت چپ(عربی)</label>
                            <input type="text" name="textFloatAr" value="<?php echo e($textFloatAr); ?>" placeholder="متن را وارد کنید">
                        </div>
                        <div class="settingItem">
                            <label for="">متن شناور سمت چپ(ترکی)</label>
                            <input type="text" name="textFloatTr" value="<?php echo e($textFloatTr); ?>" placeholder="متن را وارد کنید">
                        </div>
                    </div>
                    <div class="settingItem">
                        <label>درصد شارژ حساب معرف در هر خرید زیرمجموعه معرف</label>
                        <input type="text" name="cooperationPercent" value="<?php echo e($cooperationPercent); ?>" placeholder="مثال : 2">
                    </div>
                    <div class="settingItem">
                        <label>حداکثر کد تخفیف در جعبه جادویی</label>
                        <input type="text" name="giftDis" value="<?php echo e($giftDis); ?>" placeholder="مثال : 2">
                    </div>
                    <div class="settingItem">
                        <label for="">مالیات / افزایش قیمت (0 - 100)</label>
                        <input type="text" name="tax" value="<?php echo e($tax); ?>" placeholder="مثال : 20">
                    </div>
                    <div class="settingItem">
                        <label>روز های تعطیل هفته</label>
                        <select class="free-multiple" name="holidays[]" multiple="multiple">
                            <option value="شنبه">شنبه</option>
                            <option value="یکشنبه">یکشنبه</option>
                            <option value="دوشنبه">دوشنبه</option>
                            <option value="سه شنبه">سه شنبه</option>
                            <option value="چهارشنبه">چهارشنبه</option>
                            <option value="پنجشنبه">پنجشنبه</option>
                            <option value="جمعه">جمعه</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>محدودیت زمانی دریافت جایزه</label>
                        <input type="text" name="maxGift" value="<?php echo e($maxGift); ?>" placeholder="مثال : 7">
                    </div>
                    <div class="settingItem">
                        <label>نوع نمایش  صفحه معرفی محصول</label>
                        <select name="singleDesign">
                            <option value="0">سه ردیف</option>
                            <option value="1">دو ردیف</option>
                            <option value="2">تصویر وسط</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>فونت سایت</label>
                        <select name="font">
                            <option value="0">ایران سانس</option>
                            <option value="1">وزیر</option>
                            <option value="2">ساحل</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>نوع نمایش هدر سایت</label>
                        <select name="headerDesign">
                            <option value="0">هدر 1</option>
                            <option value="1">هدر 2</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>نوع نمایش فوتر سایت</label>
                        <select name="footerDesign">
                            <option value="0">فوتر 1</option>
                            <option value="1">فوتر 2</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>نوع نمایش صفحه لاگین</label>
                        <select name="loginDesign">
                            <option value="0">لاگین 1</option>
                            <option value="1">لاگین 2</option>
                        </select>
                    </div>
                    <div class="settingItem">
                        <label>نوع کپچا</label>
                        <select name="captchaType">
                            <option value="0">ریاضی</option>
                            <option value="1">پیچیده</option>
                            <option value="2">سه حرفی</option>
                            <option value="3">حروف زیاد واضح</option>
                            <option value="4">کوچیک</option>
                        </select>
                    </div>
                    <div class="settingItemChecked">
                        <label for="cooperationStatus" class="item">
                            دریافت پورسانت از زیرمجموعه گیری(با ثبت سفارش زیرمجموعه)
                            <input id="cooperationStatus" type="checkbox" name="cooperationStatus" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="minifySource" class="item">
                            مینیفای کردن سورس
                            <input id="minifySource" type="checkbox" name="minifySource" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="google" class="item">
                            ورود با جیمیل
                            <input id="google" type="checkbox" name="google" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="github" class="item">
                            ورود با گیت هاب
                            <input id="github" type="checkbox" name="github" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="captchaStatus" class="item">
                            اجبار کپچا
                            <input id="captchaStatus" type="checkbox" name="captchaStatus" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="languageStatus" class="item">
                            دو زبانه
                            <input id="languageStatus" type="checkbox" name="languageStatus" class="switch">
                        </label>
                    </div>
                    <div class="settingItemChecked">
                        <label for="darkStatus" class="item">
                            دارک و لایت
                            <input id="darkStatus" type="checkbox" name="darkStatus" class="switch">
                        </label>
                    </div>
                    <button>ثبت اطلاعات</button>
                </form>
            </div>
            <div>
                <form method="post" action="/admin/setting/ads-header" class="settingMangeItems">
                    <?php echo csrf_field(); ?>
                    <h3>تنظیمات تبلیغ بالا هدر</h3>
                    <div class="settingItem">
                        <label>ارتفاع تبلیغ بالا هدر(px)</label>
                        <input type="text" name="heightHeader" value="<?php echo e($heightHeader); ?>" placeholder="مثال : 5">
                    </div>
                    <div class="settingItem">
                        <label>لینک تصویر را قرار بدید</label>
                        <input type="text" name="imageHeader" value="<?php echo e($imageHeader); ?>" placeholder="مثال : example.com/test.jpg">
                    </div>
                    <div class="settingItem">
                        <label>آدرس (url)</label>
                        <input type="text" name="linkHeader" value="<?php echo e($linkHeader); ?>" placeholder="مثال : example.com/products">
                    </div>
                    <div class="settingItemChecked">
                        <label for="s2" class="item">
                            فعال شدن تبلیغ بالا سایت
                            <input id="s2" type="checkbox" name="adHeaderStatus" class="switch">
                        </label>
                    </div>
                    <button>ثبت اطلاعات</button>
                </form>
                <form method="post" action="/admin/setting/pop-up" class="settingMangeItems">
                    <?php echo csrf_field(); ?>
                    <h3>تنظیمات پاپ آپ</h3>
                    <div class="settingItem">
                        <label>لینک تصویر را قرار بدید</label>
                        <input type="text" name="imagePopUp" value="<?php echo e($imagePopUp); ?>" placeholder="مثال : example.com/test.jpg">
                    </div>
                    <div class="settingItem">
                        <label>عنوان پاپ آپ*</label>
                        <input type="text" name="titlePopUp" value="<?php echo e($titlePopUp); ?>" placeholder="مثال : عنوان">
                    </div>
                    <div class="settingItem">
                        <label>آدرس (url) انتقال</label>
                        <input type="text" name="addressPopUp" value="<?php echo e($addressPopUp); ?>" placeholder="مثال : example.com/products">
                    </div>
                    <div class="settingItem">
                        <label>توضیحات پاپ آپ</label>
                        <textarea name="descriptionPopUp" placeholder="توضیحات را وارد کنید ..."><?php echo e($descriptionPopUp); ?></textarea>
                    </div>
                    <div class="settingItem">
                        <label>عنوان دکمه</label>
                        <input type="text" name="buttonPopUp" value="<?php echo e($buttonPopUp); ?>" placeholder="مثال : مشاهده">
                    </div>
                    <div class="settingItemChecked">
                        <label for="s3" class="item">
                            فعال شدن پاپ آپ
                            <input id="s3" type="checkbox" name="popUpStatus" class="switch">
                        </label>
                    </div>
                    <button>ثبت اطلاعات</button>
                </form>
            </div>
        </div>
        <div class="filemanager">
            <?php echo $__env->make('admin.filemanager', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var images = <?php echo json_encode($logo, JSON_HEX_TAG); ?>;
            var adHeaderStatus = <?php echo json_encode($adHeaderStatus, JSON_HEX_TAG); ?>;
            var popUpStatus = <?php echo json_encode($popUpStatus, JSON_HEX_TAG); ?>;
            var cooperationStatus = <?php echo json_encode($cooperationStatus, JSON_HEX_TAG); ?>;
            var minifySource = <?php echo json_encode($minifySource, JSON_HEX_TAG); ?>;
            var holidays = <?php echo json_encode($holidays, JSON_HEX_TAG); ?>;
            var singleDesign = <?php echo json_encode($singleDesign, JSON_HEX_TAG); ?>;
            var font = <?php echo json_encode($font, JSON_HEX_TAG); ?>;
            var headerDesign = <?php echo json_encode($headerDesign, JSON_HEX_TAG); ?>;
            var loginDesign = <?php echo json_encode($loginDesign, JSON_HEX_TAG); ?>;
            var google = <?php echo json_encode($google, JSON_HEX_TAG); ?>;
            var github = <?php echo json_encode($github, JSON_HEX_TAG); ?>;
            var captchaStatus = <?php echo json_encode($captchaStatus, JSON_HEX_TAG); ?>;
            var captchaType = <?php echo json_encode($captchaType, JSON_HEX_TAG); ?>;
            var footerDesign = <?php echo json_encode($footerDesign, JSON_HEX_TAG); ?>;
            var languageStatus = <?php echo json_encode($languageStatus, JSON_HEX_TAG); ?>;
            var darkStatus = <?php echo json_encode($darkStatus, JSON_HEX_TAG); ?>;
            $("select[name='singleDesign']").val(singleDesign);
            $("select[name='font']").val(font);
            $("select[name='headerDesign']").val(headerDesign);
            $("select[name='captchaType']").val(captchaType);
            $("select[name='loginDesign']").val(loginDesign);
            $("select[name='footerDesign']").val(footerDesign);
            var holidays1 = [];
            if(holidays){
                $.each(JSON.parse(holidays),function(){
                    holidays1.push(this);
                });
                $('.free-multiple').val(holidays1);
            }
            $('.free-multiple').select2({
                placeholder: 'روز های تعطیل را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            if(adHeaderStatus == 1){
                $("input[name='adHeaderStatus']").prop("checked", true );
            }else{
                $("input[name='adHeaderStatus']").prop("checked", false );
            }
            if(popUpStatus == 1){
                $("input[name='popUpStatus']").prop("checked", true );
            }else{
                $("input[name='popUpStatus']").prop("checked", false );
            }
            if(cooperationStatus == 1){
                $("input[name='cooperationStatus']").prop("checked", true );
            }else{
                $("input[name='cooperationStatus']").prop("checked", false );
            }
            if(minifySource == 1){
                $("input[name='minifySource']").prop("checked", true );
            }else{
                $("input[name='minifySource']").prop("checked", false );
            }
            if(google == 1){
                $("input[name='google']").prop("checked", true );
            }else{
                $("input[name='google']").prop("checked", false );
            }
            if(github == 1){
                $("input[name='github']").prop("checked", true );
            }else{
                $("input[name='github']").prop("checked", false );
            }
            if(captchaStatus == 1){
                $("input[name='captchaStatus']").prop("checked", true );
            }else{
                $("input[name='captchaStatus']").prop("checked", false );
            }
            if(languageStatus == 1){
                $("input[name='languageStatus']").prop("checked", true );
            }else{
                $("input[name='languageStatus']").prop("checked", false );
            }
            if(darkStatus == 1){
                $("input[name='darkStatus']").prop("checked", true );
            }else{
                $("input[name='darkStatus']").prop("checked", false );
            }
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            if(images){
                $('.getImageItem').append(
                    $('<div class="getImagePic"><input type="hidden" name="image" value="'+images+'"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+images+'"></div>')
                        .on('click' , '.deleteImg',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
                $("input[name='image']").val(images);
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/select2.min.js"></script>
    <link rel="stylesheet" href="/css/select2.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/manage.blade.php ENDPATH**/ ?>