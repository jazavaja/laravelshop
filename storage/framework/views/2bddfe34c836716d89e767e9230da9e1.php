<?php $__env->startSection('title' , 'خرید بعدی - '); ?>
<?php $__env->startSection('content'); ?>
    <main class="allCartIndex width">
        <?php if(\Session::has('message')): ?>
            <div class="alert">
                <?php echo \Session::get('message'); ?>

            </div>
        <?php endif; ?>
        <?php if(\Session::has('success')): ?>
            <div class="success">
                <?php echo \Session::get('success'); ?>

            </div>
        <?php endif; ?>
        <div class="cartTab">
            <div class="tabs">
                <a class="tab nextCart" href="/cart">
                    سبد خرید
                    <span class="notification"><?php echo e($count2); ?></span>
                </a>
                <a class="tab active" href="/cart/next">
                    خرید بعدی
                    <span class="notification"><?php echo e($count); ?></span>
                </a>
            </div>
        </div>
        <?php if(count($carts) >= 1): ?>
            <div class="cartIndex">
                <section class="right">
                    <form class="cartItems">
                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cartItem" id="<?php echo e($item['slug']); ?>">
                                <div class="cartPic">
                                    <a href="/product/<?php echo e($item['slug']); ?>">
                                        <?php if($item['image'] != '[]'): ?>
                                            <img src="<?php echo e(json_decode($item['image'])[0]); ?>" alt="<?php echo e($item['title']); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="cartSubject">
                                    <div class="titleCart">
                                        <a href="/product/<?php echo e($item['slug']); ?>"><?php echo e($item['title']); ?></a>
                                        <button id="deleteCart" count="<?php echo e($item['count']); ?>" price="<?php echo e($item['price']); ?>" size="<?php echo e($item['size']); ?>" color="<?php echo e($item['color']); ?>" guarantee="<?php echo e($item['guarantee_id']); ?>" product="<?php echo e($item['product']); ?>">حذف</button>
                                    </div>
                                    <?php if($item['user']): ?>
                                        <div class="cartData">
                                            <h4>فروشنده :</h4>
                                            <span><?php echo e($item['user']['name']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item['size']): ?>
                                        <div class="cartData">
                                            <h4>سایز :</h4>
                                            <span><?php echo e($item['size']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item['color']): ?>
                                        <div class="cartData">
                                            <h4>رنگ :</h4>
                                            <span><?php echo e($item['color']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item['guarantee']): ?>
                                        <div class="cartData">
                                            <h4>گارانتی :</h4>
                                            <span><?php echo e($item['guarantee']['name']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($item['inquiry'] == 0): ?>
                                        <div class="inquiryData">در حال دریافت استعلام موجود بودن محصول</div>
                                    <?php endif; ?>
                                    <div class="productCount">
                                        <div class="rightCount">
                                            <span class="minus" id="<?php echo e($item['slug']); ?>">-</span>
                                            <span id="countInput" name="<?php echo e($item['product']); ?>"><?php echo e($item['count']); ?></span>
                                            <span class="add" id="<?php echo e($item['slug']); ?>">+</span>
                                        </div>
                                        <div class="leftCount">
                                            <div class="price"><?php echo e(number_format($item['price']*$item['count'])); ?></div>
                                        </div>
                                        <div class="nextCount" count="<?php echo e($item['count']); ?>" price="<?php echo e($item['price']); ?>" size="<?php echo e($item['size']); ?>" color="<?php echo e($item['color']); ?>" guarantee="<?php echo e($item['guarantee_id']); ?>" product="<?php echo e($item['product']); ?>">
                                            انتقال به سبد خرید
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#left"></use>
                                                </svg>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                </section>
                <div class="left">
                    <div class="cartNext">
                        <div class="cartPriceItem" id="allPrice1">
                            <h4>مبلغ سبد خرید :</h4>
                            <span><?php echo e(number_format($prices)); ?> تومان </span>
                        </div>
                        <div class="cartPriceItem" id="allCountCart">
                            <h4>تعداد محصول :</h4>
                            <span><?php echo e($count); ?></span>
                        </div>
                        <div class="cartPriceItem" id="allPrice2">
                            <h4>مبلغ قابل پرداخت :</h4>
                            <h3 id="<?php echo e($prices); ?>"><?php echo e(number_format($prices)); ?></h3>
                        </div>
                        <div class="nextItem">
                            <a>انتقال همه به سبد خرید</a>
                        </div>
                    </div>
                    <div class="scoreProduct">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#score"></use>
                            </svg>
                        </i>
                        <span>
                            دریافت
                            <span><?php echo e($scores); ?></span>
                            امتیاز با خرید این محصولات
                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="allCartIndexEmpty" style="display:none">
            <i>
                <svg class="icon">
                    <use xlink:href="#cart"></use>
                </svg>
            </i>
            <h3>خرید بعدی شما خالی است</h3>
        </div>
    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script1'); ?>
    <script>
        $(document).ready(function(){
            var carts = <?php echo json_encode($carts, JSON_HEX_TAG); ?>;
            if(carts.length == 0){
                $('.allCartIndexEmpty').show();
            }
            $('.cartItems .add').on('click',function(){
                var $countInput = $(this.previousElementSibling);
                var currentVal = parseInt($countInput.text());
                var addData = $(this);
                $('.allLoading').show();
                if (!isNaN(currentVal)) {
                    $countInput.text(currentVal + 1);
                    var counts = [];
                    $.each($(".cartItems .cartItem #countInput") , function(){
                        counts.push($(this).text());
                    })

                    var form = {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "count": JSON.stringify(counts),
                    };
                    $.ajax({
                        url: "/change-cart",
                        type: "post",
                        data: form,
                        success: function (data) {
                            $('.allLoading').hide();
                            if(data != 'success'){
                                $countInput.text(currentVal);
                                $.toast({
                                    text: data, // Text that is to be shown in the toast
                                    heading: 'موجودی ناکافی', // Optional heading to be shown on the toast
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
                                var cartCounts = $('.cartShowBtn h5').text();
                                var priceItem = $('#showCartLi #'+$(addData[0]).attr('id')).attr('price');
                                $('.cartShowBtn h5').text(parseInt(cartCounts) + 1);
                                $('.tabs .active span').text(parseInt(cartCounts) +1);
                                $('#allCountCart span').text(parseInt(cartCounts) + 1);
                                $('#showCartLi #'+$(addData[0]).attr('id') + ' .countCart').text('- ' + (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')) +1) + ' عدد');
                                $('#showCartLi #'+$(addData[0]).attr('id')).attr('count' , parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')) +1);
                                $('#showCartLi #'+$(addData[0]).attr('id')+' .cartPrice span').text(makePrice(priceItem * (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')))));
                                $('.cartItems #'+$(addData[0]).attr('id')+' .leftCount .price').text(makePrice(priceItem * (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')))));
                                $('.cartItems #'+$(addData[0]).attr('id')+' #deleteCart').attr('count',parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')));
                                $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) + parseInt(priceItem)));
                                $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) + parseInt(priceItem)) + ' تومان');
                                $('#allPrice2 h3').attr('id' , parseInt($('#allPrice2 h3').attr('id')) + parseInt(priceItem));
                            }
                        },
                    });
                }
            });
            $('.cartItems .minus').on('click',function(){
                var $countInput = $(this.nextElementSibling);
                var currentVal = parseInt($countInput.text());
                var addData = $(this);
                $('.allLoading').show();
                if (!isNaN(currentVal) && currentVal >= 2) {
                    $countInput.text(currentVal - 1);
                    var counts = [];
                    $.each($(".cartItems .cartItem #countInput") , function(){
                        counts.push($(this).text());
                    })

                    var form = {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "count": JSON.stringify(counts),
                    };
                    $.ajax({
                        url: "/change-cart",
                        type: "post",
                        data: form,
                        success: function (data) {
                            $('.allLoading').hide();
                            if(data != 'success'){
                                $.toast({
                                    text: data, // Text that is to be shown in the toast
                                    heading: 'موجودی ناکافی', // Optional heading to be shown on the toast
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
                                $countInput.text(currentVal);
                            }else{
                                var priceItem = $('#showCartLi #'+$(addData[0]).attr('id')).attr('price');
                                var cartCounts = $('.cartShowBtn h5').text();
                                $('.cartShowBtn h5').text(parseInt(cartCounts) - 1);
                                $('#allCountCart span').text(parseInt(cartCounts) - 1);
                                $('.tabs .active span').text(parseInt(cartCounts) -1);
                                $('#showCartLi #'+$(addData[0]).attr('id') + ' .countCart').text('- ' + (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')) -1) + ' عدد');
                                $('#showCartLi #'+$(addData[0]).attr('id')).attr('count' , parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')) -1);
                                $('#showCartLi #'+$(addData[0]).attr('id')+' .cartPrice span').text(makePrice(priceItem * (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')))));
                                $('.cartItems #'+$(addData[0]).attr('id')+' .leftCount .price').text(makePrice(priceItem * (parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')))));
                                $('.cartItems #'+$(addData[0]).attr('id')+' #deleteCart').attr('count',parseInt($('#showCartLi #'+$(addData[0]).attr('id')).attr('count')));
                                $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(priceItem)));
                                $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(priceItem)) + ' تومان');
                                $('#allPrice2 h3').attr('id' , parseInt($('#allPrice2 h3').attr('id')) - parseInt(priceItem));
                            }
                        },
                    });
                }
            });
            $('.cartItems .cartItem').on('click' , '#deleteCart',function(ss){
                ss.preventDefault();
                var buttonItem = $(this);
                ss.currentTarget.parentElement.parentElement.parentElement.remove();
                $('.allLoading').show();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "color": $(this).attr('color'),
                    "size": $(this).attr('size'),
                    "guarantee": $(this).attr('guarantee'),
                    "product": $(this).attr('product'),
                };

                $.ajax({
                    url: "/delete-cart",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.allLoading').hide();
                        if(data == 'success'){
                            var cartCounts = $('.cartShowBtn h5').text();
                            $('.cartShowBtn h5').text(cartCounts - buttonItem.attr('count'));
                            $('#allCountCart span').text(cartCounts - buttonItem.attr('count'));
                            $('.tabs .active span').text(cartCounts - buttonItem.attr('count'));
                            $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price'))));
                            $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price'))) + ' تومان');
                            $('#allPrice2 h3').text(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price')));
                            $('#allPrice1 span').text(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price')));
                            $('.showCart #showCartLi #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                            if($('.cartShowBtn h5').text() <= 0){
                                $('.showCartEmpty').show();
                                $('.allCartIndexEmpty').show();
                                $('.cartIndex').hide();
                                $('.topCartIndex').hide();
                            }
                        }
                    },
                });
            })
            $('.cartItems .cartItem').on('click' , '.nextCount',function(ss){
                ss.preventDefault();
                var buttonItem = $(this);
                ss.currentTarget.parentElement.parentElement.parentElement.remove();
                $('.allLoading').show();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "color": $(this).attr('color'),
                    "size": $(this).attr('size'),
                    "guarantee": $(this).attr('guarantee'),
                    "product": $(this).attr('product'),
                };

                $.ajax({
                    url: "/back-cart",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.allLoading').hide();
                        if(data == 'success'){
                            var cartCounts = $('.tabs .active span').text();
                            $('.tabs .active span').text(cartCounts - buttonItem.attr('count'));
                            var cartCounts2 = $('.nextCart .notification').text();
                            $('#allCountCart span').text(cartCounts - buttonItem.attr('count'));
                            $('.nextCart .notification').text(parseInt(cartCounts2) + parseInt(buttonItem.attr('count')));
                            $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price'))));
                            $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price'))) + ' تومان');
                            $('#allPrice2 h3').text(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price')));
                            $('#allPrice1 span').text(parseInt($('#allPrice2 h3').attr('id')) - parseInt(buttonItem.attr('count') * buttonItem.attr('price')));
                            $('.showCart #showCartLi #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                            if($('.cartShowBtn h5').text() <= 0){
                                $('.showCartEmpty').show();
                                $('.allCartIndexEmpty').show();
                                $('.cartIndex').hide();
                                $('.topCartIndex').hide();
                            }
                        }
                    },
                });
            })
            $('.cartNext a').on('click',function(ss){
                ss.preventDefault();
                $('.allLoading').show();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                };

                $.ajax({
                    url: "/all-back-cart",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.allLoading').hide();
                        if(data == 'success'){
                            window.location.href = '/cart';
                        }
                    },
                });
            })
            function makePrice(price){
                price += '';
                x = price.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/cart/cartNextIndex.blade.php ENDPATH**/ ?>