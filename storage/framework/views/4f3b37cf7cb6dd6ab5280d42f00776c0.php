<?php $__env->startSection('tab' , 7); ?>
<?php $__env->startSection('content'); ?>
    <div class="allPayPanel">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <?php if($delivery === 0): ?>
                    <a href="/admin/pay?delivery=0">دریافت سفارش</a>
                <?php endif; ?>
                <?php if($delivery == 1): ?>
                    <a href="/admin/pay?delivery=1">در انتظار بررسی</a>
                <?php endif; ?>
                <?php if($delivery == 2): ?>
                    <a href="/admin/pay?delivery=2">بسته بندی شده</a>
                <?php endif; ?>
                <?php if($delivery == 3): ?>
                    <a href="/admin/pay?delivery=3">تحویل پیک</a>
                <?php endif; ?>
                <?php if($delivery == 4): ?>
                    <a href="/admin/pay?delivery=4">تکمیل شده</a>
                <?php endif; ?>
                <?php if($delivery == 5 || !$delivery): ?>
                    <a href="/admin/pay">همه سفارشات</a>
                <?php endif; ?>
            </div>
            <div class="allTopTableItem">
                <div class="groupEdits" style="display:none;">چاپ گروهی</div>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/pay" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر حامل و شماره سفارش و آیدی کاربر و نام کاربری و آیدی</label>
                            <input type="text" name="title" placeholder="مثال: 10" value="<?php echo e($title); ?>">
                        </div>
                        <div class="filterContentItem">
                            <label>وضعیت ارسال</label>
                            <select name="delivery">
                                <option value="5">همه</option>
                                <option value="0">دریافت سفارش</option>
                                <option value="1">در انتظار بررسی</option>
                                <option value="2">بسته بندی شده</option>
                                <option value="3">تحویل پیک</option>
                                <option value="4">تکمیل شده</option>
                            </select>
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
        <?php if(count($pined) >= 1): ?>
            <div class="allTableContainer">
                <div class="titlePin">سفارشات پین شده</div>
                <?php $__currentLoopData = $pined; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="postItem" id="<?php echo e($item->id); ?>">
                        <div class="postTop">
                            <div class="postTitle">
                                <div class="postImages">
                                    <?php $__currentLoopData = $item['payMeta']->slice(0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="postImage">
                                            <?php if($post->product): ?>
                                                <img src="<?php echo e(json_decode($post->product->image)[0]); ?>" alt="<?php echo e($post->product->title); ?>">
                                            <?php endif; ?>
                                            <?php if($post->collection): ?>
                                                <img src="<?php echo e($post->collection->image); ?>" alt="<?php echo e($post->collection->title); ?>">
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($item['payMeta']) >= 4): ?>
                                        <div class="postMore">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#more"></use>
                                                </svg>
                                            </i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <ul>
                                    <li>
                                        <span>زمان ثبت :</span>
                                        <span><?php echo e($item->created_at); ?></span>
                                    </li>
                                    <li>
                                        <span>نام کاربری :</span>
                                        <span><?php echo e($item->user->name); ?></span>
                                    </li>
                                    <li>
                                        <span>نوع پرداخت :</span>
                                        <?php if($item->method == 0): ?>
                                            <span>پرداخت از درگاه</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 1): ?>
                                            <span>پرداخت از کیف پول</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 2): ?>
                                            <span>پرداخت در محل</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 3): ?>
                                            <span>پرداخت اقساطی</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 4): ?>
                                            <span>خرید فوری</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 5): ?>
                                            <span>کارت به کارت</span>
                                        <?php endif; ?>
                                        <?php if($item->method == 6): ?>
                                            <span>پرداخت مستقیم</span>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <span>درگاه :</span>
                                        <?php if($item->gate == 0): ?>
                                            <span>زرینپال</span>
                                        <?php elseif($item->gate == 1): ?>
                                            <span>زیبال</span>
                                        <?php elseif($item->gate == 2): ?>
                                            <span>نکست پی</span>
                                        <?php elseif($item->gate == 3): ?>
                                            <span>نکست پی</span>
                                        <?php elseif($item->gate == 4): ?>
                                            <span>آیدی پی</span>
                                        <?php elseif($item->gate == 5): ?>
                                            <span>به پرداخت ملت</span>
                                        <?php elseif($item->gate == 6): ?>
                                            <span>سداد ملی</span>
                                        <?php elseif($item->gate == 7): ?>
                                            <span>آسان پرداخت</span>
                                        <?php elseif($item->gate == 8): ?>
                                            <span>پاسارگاد</span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="postOptions">
                                <a href="/admin/pay/invoice/<?php echo e($item->id); ?>" title="پرینت خرید">
                                    <svg class="icon">
                                        <use xlink:href="#print"></use>
                                    </svg>
                                </a>
                                <a href="/admin/pay?pin=<?php echo e($item->id); ?>" title="<?php echo e($item->pin ? 'حذف پین' : 'پین کردن'); ?>">
                                    <svg class="icon">
                                        <use xlink:href="#pin"></use>
                                    </svg>
                                </a>
                                <a href="/admin/pay/<?php echo e($item->id); ?>" title="ویرایش خرید">
                                    <svg class="icon">
                                        <use xlink:href="#edit"></use>
                                    </svg>
                                </a>
                                <i title="حذف خرید" class="deletePay" id="<?php echo e($item->id); ?>">
                                    <svg class="icon">
                                        <use xlink:href="#trash"></use>
                                    </svg>
                                </i>
                            </div>
                        </div>
                        <div class="postBot">
                            <ul>
                                <?php if($item->method != 6): ?>
                                    <li>
                                        <span>نوع ارسال :</span>
                                        <span><?php echo e($item->carrier); ?></span>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <span>مبلغ پرداختی :</span>
                                    <?php if($item->status == 50): ?>
                                        <span><?php echo e(number_format($item->deposit)); ?> تومان</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 100): ?>
                                        <span><?php echo e(number_format($item->price)); ?> تومان</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 1): ?>
                                        <span>0</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 20): ?>
                                        <span>در حال پرداخت</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 10): ?>
                                        <span>اقساطی</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 0): ?>
                                        <span>0</span>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <span>شماره سفارش :</span>
                                    <span><?php echo e($item->property); ?></span>
                                </li>
                                <li>
                                    <span>وضعیت پرداخت :</span>
                                    <?php if($item->status == 100): ?>
                                        <span class="status100">پرداخت شده</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 50): ?>
                                        <span class="status50">پرداخت بیعانه</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 0): ?>
                                        <span class="status0">پرداخت نشده</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 20): ?>
                                        <span class="status20">در حال پرداخت</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 10): ?>
                                        <span class="status10">پرداخت اقساطی</span>
                                    <?php endif; ?>
                                    <?php if($item->status == 1): ?>
                                        <span class="status1">لغو شده</span>
                                    <?php endif; ?>
                                </li>
                                <?php if($item->method != 6): ?>
                                    <li>
                                        <span>وضعیت ارسال :</span>
                                        <?php if($item->deliver == 0): ?>
                                            <span class="unActive">دریافت سفارش</span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 1): ?>
                                            <span class="unActive">در انتظار بررسی</span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 2): ?>
                                            <span class="unActive">بسته بندی شده</span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 3): ?>
                                            <span class="unActive">تحویل پیک</span>
                                        <?php endif; ?>
                                        <?php if($item->deliver == 4): ?>
                                            <span class="activeStatus">تکمیل شده</span>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <i class="checks1">
                                <svg class="icon">
                                    <use xlink:href="#uncheck1"></use>
                                </svg>
                            </i>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="allTableContainer">
            <div class="titlePin">سفارشات شما</div>
            <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="postItem" id="<?php echo e($item->id); ?>">
                    <div class="postTop">
                        <div class="postTitle">
                            <div class="postImages">
                                <?php $__currentLoopData = $item['payMeta']->slice(0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="postImage">
                                    <?php if($post->product): ?>
                                        <img src="<?php echo e(json_decode($post->product->image)[0]); ?>" alt="<?php echo e($post->product->title); ?>">
                                    <?php endif; ?>
                                    <?php if($post->collection): ?>
                                        <img src="<?php echo e($post->collection->image); ?>" alt="<?php echo e($post->collection->title); ?>">
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($item['payMeta']) >= 4): ?>
                                    <div class="postMore">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#more"></use>
                                            </svg>
                                        </i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <ul>
                                <li>
                                    <span>زمان ثبت :</span>
                                    <span><?php echo e($item->created_at); ?></span>
                                </li>
                                <li>
                                    <span>نام کاربری :</span>
                                    <span><?php echo e($item->user->name); ?></span>
                                </li>
                                <li>
                                    <span>نوع پرداخت :</span>
                                    <?php if($item->method == 0): ?>
                                        <span>پرداخت از درگاه</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 1): ?>
                                        <span>پرداخت از کیف پول</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 2): ?>
                                        <span>پرداخت در محل</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 3): ?>
                                        <span>پرداخت اقساطی</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 4): ?>
                                        <span>خرید فوری</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 5): ?>
                                        <span>کارت به کارت</span>
                                    <?php endif; ?>
                                    <?php if($item->method == 6): ?>
                                        <span>پرداخت مستقیم</span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="postOptions">
                            <a href="/admin/pay/invoice/<?php echo e($item->id); ?>" title="پرینت خرید">
                                <svg class="icon">
                                    <use xlink:href="#print"></use>
                                </svg>
                            </a>
                            <a href="/admin/pay?pin=<?php echo e($item->id); ?>" title="<?php echo e($item->pin ? 'حذف پین' : 'پین کردن'); ?>">
                                <svg class="icon">
                                    <use xlink:href="#pin"></use>
                                </svg>
                            </a>
                            <a href="/admin/pay/<?php echo e($item->id); ?>" title="ویرایش خرید">
                                <svg class="icon">
                                    <use xlink:href="#edit"></use>
                                </svg>
                            </a>
                            <i title="حذف خرید" class="deletePay" id="<?php echo e($item->id); ?>">
                                <svg class="icon">
                                    <use xlink:href="#trash"></use>
                                </svg>
                            </i>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <?php if($item->method != 6): ?>
                                <li>
                                    <span>نوع ارسال :</span>
                                    <span><?php echo e($item->carrier); ?></span>
                                </li>
                            <?php endif; ?>
                            <li>
                                <span>مبلغ پرداختی :</span>
                                <?php if($item->status == 50): ?>
                                    <span><?php echo e(number_format($item->deposit)); ?> تومان</span>
                                <?php endif; ?>
                                <?php if($item->status == 100): ?>
                                    <span><?php echo e(number_format($item->price)); ?> تومان</span>
                                <?php endif; ?>
                                <?php if($item->status == 1 || $item->status == 2): ?>
                                    <span>0</span>
                                <?php endif; ?>
                                <?php if($item->status == 20): ?>
                                    <span>در حال پرداخت</span>
                                <?php endif; ?>
                                <?php if($item->status == 10): ?>
                                    <span>اقساطی</span>
                                <?php endif; ?>
                                <?php if($item->status == 0): ?>
                                    <span>0</span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span>شماره سفارش :</span>
                                <span><?php echo e($item->property); ?></span>
                            </li>
                            <li>
                                <span>وضعیت پرداخت :</span>
                                <?php if($item->status == 100): ?>
                                    <span class="status100">پرداخت شده</span>
                                <?php elseif($item->status == 50): ?>
                                    <span class="status50">پرداخت بیعانه</span>
                                <?php elseif($item->status == 0): ?>
                                    <span class="status0">پرداخت نشده</span>
                                <?php elseif($item->status == 20): ?>
                                    <span class="status20">در حال پرداخت</span>
                                <?php elseif($item->status == 10): ?>
                                    <span class="status10">پرداخت اقساطی</span>
                                <?php elseif($item->status == 1): ?>
                                    <span class="status1">لغو شده</span>
                                <?php elseif($item->status == 2): ?>
                                    <span class="status1">مرجوعی</span>
                                <?php endif; ?>
                            </li>
                            <?php if($item->method != 6): ?>
                                <li>
                                    <span>وضعیت ارسال :</span>
                                    <?php if($item->deliver == 0): ?>
                                        <span class="unActive">دریافت سفارش</span>
                                    <?php elseif($item->deliver == 1): ?>
                                        <span class="unActive">در انتظار بررسی</span>
                                    <?php elseif($item->deliver == 2): ?>
                                        <span class="unActive">بسته بندی شده</span>
                                    <?php elseif($item->deliver == 3): ?>
                                        <span class="unActive">تحویل پیک</span>
                                    <?php elseif($item->deliver == 4): ?>
                                        <span class="activeStatus">تکمیل شده</span>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <i class="checks1">
                            <svg class="icon">
                                <use xlink:href="#uncheck1"></use>
                            </svg>
                        </i>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($pays->links('admin.paginate')); ?>

        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف سفارش مطمئن هستید؟</div>
                <p>با حذف سفارش اطلاعات سفارش به طور کامل حذف میشوند</p>
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
            var checked = 0;
            var delivery = <?php echo json_encode($delivery, JSON_HEX_TAG); ?>;
            $(".filterContentItem select[name='delivery']").val(delivery?delivery:5)
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
            $('.allTableContainer .postItem').on('click' , '.deletePay' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/pay/' + post+'/delete');
            });
            $('.postItem').click(function(){
                if($(this).attr('class') == 'postItem checked'){
                    $(this).attr('class' , 'postItem');
                    $(this).find('.checks1 svg').remove();
                    $($(this).find('.checks1')[0]).append($(
                        `<svg class="icon">
                                <use xlink:href="#uncheck1"></use>
                            </svg>`
                    ));
                    checked = parseInt(checked) - 1;
                    if(checked == 0){
                        $('.groupEdits').hide();
                    }
                }else{
                    $(this).attr('class' , 'postItem checked');
                    checked = parseInt(checked) + 1;
                    $('.groupEdits').show();
                    $(this).find('.checks1 svg').remove();
                    $($(this).find('.checks1')[0]).append($(
                        `<svg class="icon">
                                <use xlink:href="#check1"></use>
                            </svg>`
                    ))
                }
            })
            $('.groupEdits').on('click' , function(){
                var products = [];
                $.each($('.allTableContainer .checked'),function(){
                    products.push($(this).attr('id'));
                })
                products.join(',');
                window.location.href = '/admin/invoice/group?pay='+products;
            });
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pay/index.blade.php ENDPATH**/ ?>