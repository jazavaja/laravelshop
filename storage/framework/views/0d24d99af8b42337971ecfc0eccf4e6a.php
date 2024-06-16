<?php $__env->startSection('tab',1); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/product">فرم تغییر پیشرفته</a>
            </div>
            <div class="allTopTableItem">
                <div></div>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/product" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="title" placeholder="عنوان یا آیدی را وارد کنید" value="<?php echo e($title); ?>">
                        </div>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
            </div>
        </div>
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <div class="allData">
            <table class="changeT">
                <tr class="trT">
                    <th>عنوان</th>
                    <th>عنوان انگلیسی</th>
                    <th>عنوان سئو</th>
                    <th>کلمات کلیدی</th>
                    <th>alt تصویر</th>
                    <th>پیوند(slug)</th>
                    <th>موجودی</th>
                    <th>قیمت پایه</th>
                    <th>تخفیف</th>
                    <th>امتیاز</th>
                    <th>وزن</th>
                    <th>حداکثر در سبد خرید</th>
                    <th>وضعیت</th>
                    <th>ویترین</th>
                    <th>اصل</th>
                    <th>استعلام اجباری</th>
                    <th>نکته مهم</th>
                </tr>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr id="<?php echo e($item->id); ?>">
                        <td>
                            <textarea name="title"><?php echo e($item->title); ?></textarea>
                        </td>
                        <td>
                            <textarea name="titleEn"><?php echo e($item->titleEn); ?></textarea>
                        </td>
                        <td>
                            <textarea name="titleSeo"><?php echo e($item->titleSeo); ?></textarea>
                        </td>
                        <td>
                            <textarea name="keywordSeo"><?php echo e($item->keywordSeo); ?></textarea>
                        </td>
                        <td>
                            <textarea name="imageAlt"><?php echo e($item->imageAlt); ?></textarea>
                        </td>
                        <td>
                            <textarea name="slug"><?php echo e($item->slug); ?></textarea>
                        </td>
                        <td>
                            <textarea name="count"><?php echo e($item->count); ?></textarea>
                        </td>
                        <td>
                            <textarea name="offPrice"><?php echo e($item->offPrice); ?></textarea>
                        </td>
                        <td>
                            <textarea name="off"><?php echo e($item->off); ?></textarea>
                        </td>
                        <td>
                            <textarea name="score"><?php echo e($item->score); ?></textarea>
                        </td>
                        <td>
                            <textarea name="weight"><?php echo e($item->weight); ?></textarea>
                        </td>
                        <td>
                            <textarea name="maxCart"><?php echo e($item->maxCart); ?></textarea>
                        </td>
                        <td>
                            <select name="status">
                                <option value="0" <?php echo e($item->status == 0? 'selected':''); ?>>پیشنویس</option>
                                <option value="1" <?php echo e($item->status == 1? 'selected':''); ?>>منتشر شده</option>
                            </select>
                        </td>
                        <td>
                            <input type="checkbox" name="showcase" <?php echo e($item->showcase == 1? 'checked':''); ?>>
                        </td>
                        <td>
                            <input type="checkbox" name="original" <?php echo e($item->original == 1? 'checked':''); ?>>
                        </td>
                        <td>
                            <input type="checkbox" name="inquiry" <?php echo e($item->inquiry == 1? 'checked':''); ?>>
                        </td>
                        <td>
                            <textarea name="note" placeholder="نکات"><?php echo e($item->note); ?></textarea>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <div class="floatButton">ذخیره</div>
        </div>
        <?php echo e($products->links('admin.paginate')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
            $('.floatButton').click(function (){
                var products = [];
                $(".allData tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var product = {
                            id : this.id,
                            title : '',
                            titleEn : '',
                            titleSeo : '',
                            keywordSeo : '',
                            imageAlt : '',
                            slug : '',
                            count : '',
                            offPrice : '',
                            off : '',
                            score : '',
                            weight : '',
                            maxCart : '',
                            status : '',
                            showcase : '',
                            original : '',
                            inquiry : '',
                            note : '',
                        }
                        $(this).find("select").each(function(){
                            if (this.name == 'status') {
                                product.status = this.value;
                            }
                        })
                        $(this).find("input").each(function(){
                            if (this.name == 'showcase') {
                                product.showcase = $(this).is(":checked");
                            }
                            if (this.name == 'original') {
                                product.original = $(this).is(":checked");
                            }
                            if (this.name == 'inquiry') {
                                product.inquiry = $(this).is(":checked");
                            }
                        })
                        $(this).find("textarea").each(function(){
                            if (this.name == 'title') {
                                product.title = this.value;
                            }
                            if (this.name == 'titleEn') {
                                product.titleEn = this.value;
                            }
                            if (this.name == 'titleSeo') {
                                product.titleSeo = this.value;
                            }
                            if (this.name == 'keywordSeo') {
                                product.keywordSeo = this.value;
                            }
                            if (this.name == 'imageAlt') {
                                product.imageAlt = this.value;
                            }
                            if (this.name == 'slug') {
                                product.slug = this.value;
                            }
                            if (this.name == 'count') {
                                product.count = this.value;
                            }
                            if (this.name == 'offPrice') {
                                product.offPrice = this.value;
                            }
                            if (this.name == 'off') {
                                product.off = this.value;
                            }
                            if (this.name == 'score') {
                                product.score = this.value;
                            }
                            if (this.name == 'weight') {
                                product.weight = this.value;
                            }
                            if (this.name == 'maxCart') {
                                product.maxCart = this.value;
                            }
                            if (this.name == 'note') {
                                product.note = this.value;
                            }
                        })
                        products.push(product);
                    }
                });

                console.log(products);
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    products:JSON.stringify(products),
                };

                $.ajax({
                    url: "/admin/product/change",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "تغییر محصولات انجام شد", // Text that is to be shown in the toast
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
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/post/change.blade.php ENDPATH**/ ?>