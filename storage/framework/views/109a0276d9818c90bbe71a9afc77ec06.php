<section class="allSearchAdvance width">
    <div class="titleSearch"><?php echo e(__('messages.advance_search')); ?></div>
    <div class="sectionsBox">
        <div class="sectionBox">
            <div class="boxItem">
                <label for="search1"><?php echo e(__('messages.name_code')); ?></label>
                <input id="search1" name="search" type="text" placeholder="<?php echo e(__('messages.name_code')); ?>">
            </div>
        </div>
        <div class="sectionBox">
            <div class="boxItem">
                <label for="category1"><?php echo e(__('messages.cat_product')); ?></label>
                <select name="category" id="category1">
                    <option value="0" selected><?php echo e(__('messages.select_cat')); ?></option>
                    <?php $__currentLoopData = $catsIndex; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="boxItem">
                <label for="brand1"><?php echo e(__('messages.brand_product')); ?></label>
                <select name="brand" id="brand1">
                    <option value="0" selected><?php echo e(__('messages.select_brand')); ?></option>
                    <?php $__currentLoopData = $brandIndex; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if(\Illuminate\Support\Facades\App::getLocale() == 'fa'): ?>
            <div class="boxItem">
                <label for="state1">استان دلخواه</label>
                <select name="state" id="state1">
                    <option value="0">همه استان ها</option>
                    <option value="تهران">تهران</option>
                    <option value="خراسان رضوی">خراسان رضوی</option>
                    <option value="اصفهان">اصفهان</option>
                    <option value="فارس">فارس</option>
                    <option value="خوزستان">خوزستان</option>
                    <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                    <option value="مازندران">مازندران</option>
                    <option value="آذربایجان غربی">آذربایجان غربی</option>
                    <option value="کرمان">کرمان</option>
                    <option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
                    <option value="البرز">البرز</option>
                    <option value="گیلان">گیلان</option>
                    <option value="کرمانشاه">کرمانشاه</option>
                    <option value="گلستان">گلستان</option>
                    <option value="هرمزگان">هرمزگان</option>
                    <option value="لرستان">لرستان</option>
                    <option value="همدان">همدان</option>
                    <option value="کردستان">کردستان</option>
                    <option value="مرکزی">مرکزی</option>
                    <option value="قم">قم</option>
                    <option value="قزوین">قزوین</option>
                    <option value="اردبیل">اردبیل</option>
                    <option value="بوشهر">بوشهر</option>
                    <option value="یزد">یزد</option>
                    <option value="زنجان">زنجان</option>
                    <option value="چهارمحال و بختیاری">چهارمحال و بختیاری</option>
                    <option value="خراسان شمالی">خراسان شمالی</option>
                    <option value="خراسان جنوبی">خراسان جنوبی</option>
                    <option value="کهگیلویه و بویراحمد">کهگیلویه و بویراحمد</option>
                    <option value="سمنان">سمنان</option>
                    <option value="ایلام">ایلام</option>
                </select>
            </div>
            <?php endif; ?>
            <div class="boxItem">
                <label for="order1"><?php echo e(__('messages.order_product')); ?></label>
                <select name="order" id="order1">
                    <option value="0"><?php echo e(__('messages.order_new')); ?></option>
                    <option value="1"><?php echo e(__('messages.order_visit')); ?></option>
                    <option value="2"><?php echo e(__('messages.order_sell')); ?></option>
                    <option value="3"><?php echo e(__('messages.order_like')); ?></option>
                    <option value="4"><?php echo e(__('messages.order_cheap')); ?></option>
                    <option value="5"><?php echo e(__('messages.order_expensive')); ?></option>
                </select>
            </div>
        </div>
        <div class="sectionBox">
            <div class="boxItem">
                <label for="s1d" class="searchCheck">
                    <?php echo e(__('messages.order_exist')); ?>

                    <input id="s1d" type="checkbox" name="exist" class="switch" >
                </label>
            </div>
            <div class="boxItem">
                <label for="s5" class="searchCheck">
                    <?php echo e(__('messages.order_suggest')); ?>

                    <input id="s5" type="checkbox" name="suggest" class="switch" >
                </label>
            </div>
            <div class="boxItem">
                <label for="s2" class="searchCheck">
                    <?php echo e(__('messages.only_off')); ?>

                    <input id="s2" type="checkbox" name="off" class="switch" >
                </label>
            </div>
            <div class="boxItem">
                <label for="s3" class="searchCheck">
                    <?php echo e(__('messages.only_lottery')); ?>

                    <input id="s3" type="checkbox" name="lottery" class="switch" >
                </label>
            </div>
            <div class="boxItem">
                <label for="s4" class="searchCheck">
                    <?php echo e(__('messages.only_fast_buy')); ?>

                    <input id="s4" type="checkbox" name="quick" class="switch" >
                </label>
            </div>
        </div>
    </div>
    <div class="buttonSearch">
        <button><?php echo e(__('messages.search_product')); ?></button>
        <span>0 <?php echo e(__('messages.product')); ?></span>
    </div>
    <div class="searchProducts">
        <div class="titleResult"><?php echo e(__('messages.search_result')); ?></div>
        <div class="productLists"></div>
    </div>
</section>
<?php /**PATH /var/www/html/resources/views/home/index/searchAdvance.blade.php ENDPATH**/ ?>