<?php $__env->startSection('tab',6); ?>
<?php $__env->startSection('content'); ?>
    <div class="allBrandPanel">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/discount">کد تخفیف</a>
            </div>
            <div class="allTopTableItem">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/discount" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="titleSearch" placeholder="عنوان یا آیدی را وارد کنید" value="<?php echo e($title); ?>">
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
        <div class="allTables">
            <div>
                <table>
                    <tr>
                        <th>آیدی</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->title); ?></td>
                            <td>
                                <div class="buttons">
                                    <button id="<?php echo e($item->id); ?>" class="editButton">ویرایش</button>
                                    <button id="<?php echo e($item->id); ?>" class="deleteButton">حذف</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php echo e($discounts->links('admin.paginate')); ?>

            </div>
            <div>
                <form action="/admin/discount" class="createFilled" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="title" placeholder="عنوان را وارد کنید">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="filledItem">
                        <label>کد*</label>
                        <input type="text" name="code" placeholder="کد را وارد کنید">
                        <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="filledItem">
                        <label>درصد تخفیف* (1,99)</label>
                        <input type="text" name="percent" placeholder="درصد تخفیف را وارد کنید">
                        <?php $__errorArgs = ['percent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="filledItem">
                        <label>تعداد استفاده*</label>
                        <input type="text" name="count" placeholder="تعداد را وارد کنید">
                        <?php $__errorArgs = ['count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="filledItem">
                        <label>تاریخ انقضا*</label>
                        <input type="text" class="example1" placeholder="تاریخ را وارد کنید" name="day"/>
                    </div>
                    <div class="filledItem">
                        <label>محصول</label>
                        <select name="product_id">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="">همه محصولات</option>
                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="filledItem">
                        <label>وضعیت*</label>
                        <select name="status" id="status">
                            <option value="0">پیشنویس</option>
                            <option value="1" selected>منتشر شده</option>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف کد تخفیف مطمئن هستید؟</div>
                <p>با حذف کد تخفیف اطلاعات کد تخفیف به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var post = 0;
            $(".example1").persianDatepicker({
                showGregorianDate: true,
                formatPersian: false,
                months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
                shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
                persianNumbers: true,
                responsive:true,
                isRTL: true,
                persianDigit: false,
                selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                selectedBefore: false,
                selectedDate: null,
                startDate: null,
                endDate: null,
                theme: 'default',
                alwaysShow: false,
                selectableYears: null,
                cellWidth: 25,
                cellHeight: 20,
                fontSize: 13,
                format: 'YYYY-MM-DD H:m:ss',
                observer: true,
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    },
                },
            });
            $("input[name='title']").val('');
            $("input[name='code']").val('');
            $("input[name='percent']").val('');
            $("input[name='count']").val('');
            $("input[name='day']").val('');
            $("select[name='product_id']").val('');
            $("select[name='status']").val('');
            $('.popUp').hide();
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/discount/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                post = this.id;
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    discount:post,
                };
                $.ajax({
                    url: "/admin/discount/" + post + "/edit",
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/discount/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('<?php echo method_field('put'); ?>')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/discount/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='title']").val('');
                                $("input[name='code']").val('');
                                $("input[name='percent']").val('');
                                $("input[name='count']").val('');
                                $("input[name='day']").val('');
                                $("select[name='product_id']").val('');
                                $("select[name='status']").val('');
                            })
                        )
                        $("input[name='title']").val(data[0].title);
                        $("input[name='code']").val(data[0].code);
                        $("input[name='percent']").val(data[0].percent);
                        $("input[name='count']").val(data[0].count);
                        $("input[name='day']").val(data[1]);
                        $("select[name='product_id']").val(data[0].product_id);
                        $("select[name='status']").val(data[0].status);
                    },
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" href="/css/persian-datepicker.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/discount/index.blade.php ENDPATH**/ ?>