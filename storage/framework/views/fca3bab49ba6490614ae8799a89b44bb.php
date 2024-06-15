<?php $__env->startSection('tab',1); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/product">همه محصول ها</a>
            </div>
            <div class="allTopTableItem">
                <div class="groupEdits" style="display:none;">ویرایش گروهی</div>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/product" class="filterContent" style="display: none">
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
        <div class="productItems">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="<?php echo e($item->id); ?>" class="postItem newTr">
                    <div class="postTop">
                        <div class="postTitle">
                            <div class="postImages">
                                <?php $__currentLoopData = json_decode($item->image); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->index <= 1): ?>
                                        <div class="postImage">
                                            <img src="<?php echo e($image); ?>" alt="<?php echo e($item->title); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if($loop->index == 2): ?>
                                        <div class="postMore">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#more"></use>
                                                </svg>
                                            </i>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <ul>
                                <li>
                                    <span>عنوان :</span>
                                    <span><?php echo e($item->title); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="postOptions">
                            <a href="/admin/product/<?php echo e($item->id); ?>/show" title="آمارگیری محصول">آمارگیری</a>
                            <a href="/admin/product/<?php echo e($item->id); ?>/edit" title="ویرایش محصول">ویرایش</a>
                            <a href="/admin/product/<?php echo e($item->id); ?>/copy" title="کپی محصول">کپی</a>
                            <button title="حذف محصول" class="deletePay" id="<?php echo e($item->id); ?>">حذف</button>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>کد محصول :</span>
                                <span><?php echo e($item->product_id); ?></span>
                            </li>
                            <li>
                                <span>آیدی محصول :</span>
                                <span><?php echo e($item->id); ?></span>
                            </li>
                            <li>
                                <span>موجودی :</span>
                                <span><?php echo e($item->count); ?></span>
                            </li>
                            <li>
                                <span>قیمت :</span>
                                <span><?php echo e(number_format($item->price)); ?> تومان</span>
                            </li>
                            <li>
                                <span>تخفیف :</span>
                                <?php if($item->off >= 1): ?>
                                <span>%<?php echo e($item->off); ?></span>
                                <?php else: ?>
                                    <span>-</span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span>دسته بندی :</span>
                                <?php if(count($item->category) >= 1): ?>
                                    <span><?php echo e($item->category()->pluck('name')->first()); ?></span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span>زمان ثبت :</span>
                                <span><?php echo e($item->created_at); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($products->links('admin.paginate')); ?>

        </div>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف محصول مطمئن هستید؟</div>
                <p>با حذف محصول اطلاعات محصول به طور کامل حذف میشوند</p>
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
        <div class="allGroupEdit" style="display:none;">
            <div class="groupEditPanel">
                <div class="titleGroupEdit">
                    ویرایش گروهی
                    <i>
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </div>
                <div class="groupEditData"></div>
                <button class="btnSendEdit">ثبت ویرایش گروهی</button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts3'); ?>
    <script>
        $(document).ready(function(){
            var post = 0;
            var checked = 0;
            $('.popUp').hide();
            $('.filterContent').hide();
            $('.filemanager').show();
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
            $('.allGroupEdit .groupEditPanel .titleGroupEdit i').click(function(){
                $('.allGroupEdit').hide();
                $.each($(".allGroupEdit .groupEditItems") , function(){
                    $(this).remove();
                })
            });
            $(".productItems .newTr").on('click',function(){
                if($(this).attr('class') == 'postItem newTr checked'){
                    $(this).attr('class' , 'postItem newTr');
                    checked = parseInt(checked) - 1;
                    if(checked == 0){
                        $('.groupEdits').hide();
                    }
                }else{
                    $(this).attr('class' , 'postItem newTr checked');
                    checked = parseInt(checked) + 1;
                    $('.groupEdits').show();
                }
            })
            $('.groupEdits').on('click' , function(){
                $('.allGroupEdit').show();
                var products = [];
                $.each($('.productItems .checked'),function(){
                    products.push($(this).attr('id'));
                })
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    products:JSON.stringify(products),
                };

                $.ajax({
                    url: "/admin/edit-products",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.each(data,function(){
                            $('.allGroupEdit .groupEditPanel .groupEditData').append(
                                $('<div class="groupEditItems" id="'+this.id+'">'+
                                '<div class="groupEditItem">'+
                                '<label>عنوان* :</label>'+
                                '<input type="text" value="'+this.title+'" name="title" placeholder="عنوان را وارد کنید">'+
                                '<div id="validation-title"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>عنوان انگلیسی* :</label>'+
                                '<input type="text" value="'+this.titleEn+'" name="titleEn" placeholder="عنوان را وارد کنید">'+
                                '<div id="validation-titleEn"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>عنوان سئو :</label>'+
                                '<input type="text" name="titleSeo" value="'+this.titleSeo+'" placeholder="عنوان را وارد کنید">'+
                                '<div id="validation-titleSeo"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>کلمات کلیدی :</label>'+
                                '<input type="text" name="keywordSeo" value="'+this.keywordSeo+'" placeholder="با , جدا کنید">'+
                                '<div id="validation-keywordSeo"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>alt تصویر :</label>'+
                                '<input type="text" name="imageAlt" value="'+this.imageAlt+'" placeholder="عنوان را وارد کنید">'+
                                '<div id="validation-imageAlt"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>وزن :</label>'+
                                '<input type="text" name="weight" value="'+this.weight+'" placeholder="وزن را وارد کنید">'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>پیوند(slug) :</label>'+
                                '<input type="text" name="slug" value="'+this.slug+'" placeholder="پیوند را وارد کنید">'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>درصد تخفیف(50) :</label>'+
                                '<input type="text" name="off" value="'+(this.off ? this.off: '')+'" placeholder="تخفیف را وارد کنید">'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>قیمت* :</label>'+
                                '<input type="text" name="price" value="'+this.price+'" placeholder="قیمت را وارد کنید">'+
                                '<div id="validation-price"></div>'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>مبلغ پیش خرید(تومان) :</label>'+
                                '<input type="text" name="prePrice" value="'+this.prePrice+'" placeholder="مبلغ را وارد کنید">'+
                                '</div>'+
                                '<div class="groupEditItem">'+
                                '<label>تعداد* :</label>'+
                                '<input type="text" name="count" value="'+this.count+'" placeholder="تعداد را وارد کنید">'+
                                '<div id="validation-count"></div>'+
                                '</div></div>')
                            );
                        })
                    },
                });
            });
            $('.allGroupEdit .btnSendEdit').on('click' ,function(){
                var productDatas = [];
                $.each($(".allGroupEdit .groupEditItems") , function(){
                    var productData = {
                        product:$(this).attr('id'),
                        title:"",
                        titleEn:"",
                        titleSeo:"",
                        keywordSeo:"",
                        imageAlt:"",
                        weight:"",
                        slug:"",
                        off:"",
                        price:"",
                        prePrice:"",
                        count:"",
                    };
                    $(this).find("input").each(function () {
                        if (this.name == 'title') {
                            productData.title = this.value;
                        }
                        if (this.name == 'titleEn') {
                            productData.titleEn = this.value;
                        }
                        if (this.name == 'titleSeo') {
                            productData.titleSeo = this.value;
                        }
                        if (this.name == 'keywordSeo') {
                            productData.keywordSeo = this.value;
                        }
                        if (this.name == 'imageAlt') {
                            productData.imageAlt = this.value;
                        }
                        if (this.name == 'weight') {
                            productData.weight = this.value;
                        }
                        if (this.name == 'slug') {
                            productData.slug = this.value;
                        }
                        if (this.name == 'off') {
                            productData.off = this.value;
                        }
                        if (this.name == 'price') {
                            productData.price = this.value;
                        }
                        if (this.name == 'prePrice') {
                            productData.prePrice = this.value;
                        }
                        if (this.name == 'count') {
                            productData.count = this.value;
                        }
                    })
                    productDatas.push(productData);
                })
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    productDatas:JSON.stringify(productDatas),
                };

                $.ajax({
                    url: "/admin/update-products",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'no'){
                            $.toast({
                                text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
                                heading: 'دقت کنید', // Optional heading to be shown on the toast
                                icon: 'error', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }else{
                            $.toast({
                                text: "ویرایش محصولات انجام شد", // Text that is to be shown in the toast
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
                            $.each($(".allGroupEdit .groupEditItems") , function(){
                                $(this).remove();
                            })
                            $('.allGroupEdit').hide();
                        }
                    },
                });
            });
            $('.productItems .postOptions').on('click' , 'button' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/product/' + post+'/delete');
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/post/index.blade.php ENDPATH**/ ?>