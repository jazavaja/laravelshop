<header class="allHeaderIndex2">
    <?php if($adHeaderStatus == 1): ?>
    <a class="topFixed" href="<?php echo e($linkHeader); ?>" style="background-image:url(<?php echo e($imageHeader); ?>);height: <?php echo e($heightHeader); ?>px"></a>
    <?php endif; ?>
    <div class="headerFix">
        <div class="headerTop">
            <div class="block width">
                <div class="right">
                    <a href="tel:<?php echo e(\App\Models\Setting::where('key' , 'number')->pluck('value')->first()); ?>" class="option">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#phone-call"></use>
                            </svg>
                        </i>
                        <div class="des"><?php echo e(\App\Models\Setting::where('key' , 'number')->pluck('value')->first()); ?></div>
                    </a>
                    <a href="mailto:<?php echo e(\App\Models\Setting::where('key' , 'email')->pluck('value')->first()); ?>" class="option">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#email"></use>
                            </svg>
                        </i>
                        <div class="des"><?php echo e(\App\Models\Setting::where('key' , 'email')->pluck('value')->first()); ?></div>
                    </a>
                    <div class="option">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#location"></use>
                            </svg>
                        </i>
                        <div class="des">
                            <?php echo e(\Illuminate\Support\Facades\App::getLocale() == 'fa' ? \App\Models\Setting::where('key' , 'address')->pluck('value')->first():''); ?>

                            <?php echo e(\Illuminate\Support\Facades\App::getLocale() == 'en' ? \App\Models\Setting::where('key' , 'addressEn')->pluck('value')->first():''); ?>

                            <?php echo e(\Illuminate\Support\Facades\App::getLocale() == 'ar' ? \App\Models\Setting::where('key' , 'addressAr')->pluck('value')->first():''); ?>

                            <?php echo e(\Illuminate\Support\Facades\App::getLocale() == 'tr' ? \App\Models\Setting::where('key' , 'addressTr')->pluck('value')->first():''); ?>

                        </div>
                    </div>
                </div>
                <div class="left">
                    <ul>
                        <li>
                            <a href="<?php echo e($telegram); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#telegram"></use>
                                    </svg>
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($facebook); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#facebook"></use>
                                    </svg>
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($instagram); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#instagram"></use>
                                    </svg>
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($twitter); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#twitter"></use>
                                    </svg>
                                </i>
                            </a>
                        </li>
                    </ul>
                    <?php if(\App\Models\Setting::where('key' , 'languageStatus')->pluck('value')->first() == 1): ?>
                        <div class="flagHeader">
                            <div class="flag">
                                <?php if(empty(request()->cookie('language'))): ?>
                                    <img src="/img/fa.png" alt="iran">
                                <?php else: ?>
                                    <img src="/img/<?php echo e(request()->cookie('language')); ?>.png" alt="<?php echo e(request()->cookie('language')); ?>">
                                <?php endif; ?>
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#down"></use>
                                    </svg>
                                </i>
                            </div>
                            <div class="flagList" style="display: none">
                                <div class="item" id="fa">
                                    <img src="/img/fa.png" alt="iran">
                                </div>
                                <div class="item" id="en">
                                    <img src="/img/en.png" alt="english">
                                </div>
                                <div class="item" id="ar">
                                    <img src="/img/ar.png" alt="arabia">
                                </div>
                                <div class="item" id="tr">
                                    <img src="/img/tr.png" alt="turkey">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <form action="/search" method="GET" class="searchData" style="display:none">
                <label for="search1">
                    <input type="text" id="search1" name="search" placeholder="<?php echo e(__('messages.search_product')); ?>">
                </label>
                <button>
                    <svg class="icon">
                        <use xlink:href="#search"></use>
                    </svg>
                </button>
                <i id="btnSearchClose">
                    <svg class="icon">
                        <use xlink:href="#cancel"></use>
                    </svg>
                </i>
            </form>
            <div class="categoryHeaderResponsive">
                <div class="title">
                    <span><?php echo e(__('messages.header_menu')); ?></span>
                    <i id="btnShowMenu">
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </div>
                <ul class="allCats">
                    <li>
                        <div class="allCatsTitle">
                            <a href="/login" name="<?php echo e(__('messages.login_user')); ?>" title="<?php echo e(__('messages.login_user')); ?>"><?php echo e(__('messages.login_user')); ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="allCatsTitle">
                            <a href="/order-tracking" name="<?php echo e(__('messages.header_track')); ?>" title="<?php echo e(__('messages.header_track')); ?>">
                                <?php echo e(__('messages.header_track')); ?>

                            </a>
                        </div>
                    </li>
                    <?php $__currentLoopData = $catHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="allCatsTitle">
                                <a href="/category/<?php echo e($lists->slug); ?>" name="<?php echo e($lists->name); ?>" title="<?php echo e($lists->name); ?>"><?php echo e($lists->name); ?></a>
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#down"></use>
                                    </svg>
                                </i>
                            </div>
                            <ul class="allCatsList">
                                <?php $__currentLoopData = $lists->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <div class="allCatsTitle">
                                            <a href="/category/<?php echo e($list->slug); ?>" name="<?php echo e($list->name); ?>" title="<?php echo e($list->name); ?>"><?php echo e($list->name); ?></a>
                                        </div>
                                        <ul>
                                            <?php $__currentLoopData = $list->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <div class="allCatsTitle">
                                                        <a href="/category/<?php echo e($item->slug); ?>" name="<?php echo e($item->name); ?>" title="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></a>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="allCatsTitle">
                                <a href="<?php echo e($lists->slug); ?>" name="<?php echo e($lists->name); ?>" title="<?php echo e($lists->name); ?>">
                                    <?php echo e($lists->name); ?>

                                </a>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="headerBot">
            <nav class="width">
                <div class="logo">
                    <a href="/" title="<?php echo e($title); ?>" name="<?php echo e($name); ?>" class="pic">
                        <img class="lazyload" src="/img/404Image.png" data-src="<?php echo e($logo); ?>" alt="<?php echo e($title); ?>">
                    </a>
                </div>
                <ul class="headerList">
                    <li class="allHeaderHomeBlockBotCategory">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#align"></use>
                            </svg>
                        </i>
                        <?php echo e(__('messages.header_cat')); ?>

                        <div class="allHeaderHomeBlockBotCategoryItems width">
                            <?php $__currentLoopData = $catHeader; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="allHeaderHomeBlockBotCategoryItem">
                                    <a href="/category/<?php echo e($lists->slug); ?>" name="<?php echo e($lists->name); ?>" title="<?php echo e($lists->name); ?>" class="allHeaderHomeBlockBotCategoryItemTitle">
                                        <?php echo e($lists->name); ?>

                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#left"></use>
                                            </svg>
                                        </i>
                                    </a>
                                    <div class="allHeaderHomeBlockBotCategoryItemLists">
                                        <?php $__currentLoopData = $lists->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="allHeaderHomeBlockBotCategoryItemList">
                                                <a href="/category/<?php echo e($list->slug); ?>" name="<?php echo e($list->name); ?>" title="<?php echo e($list->name); ?>" class="active">
                                                    <?php echo e($list->name); ?>

                                                    <i>
                                                        <svg class="icon">
                                                            <use xlink:href="#left"></use>
                                                        </svg>
                                                    </i>
                                                </a>
                                                <?php $__currentLoopData = $list->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="/category/<?php echo e($val->slug); ?>" name="<?php echo e($val->name); ?>" title="<?php echo e($val->name); ?>"><?php echo e($val->name); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                    <?php if(auth()->user()): ?>
                        <?php if(auth()->user()->admin == 1): ?>
                            <li class="linkHead">
                                <a href="/admin"><?php echo e(__('messages.header_dashboard')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="linkHead">
                            <a href="<?php echo e($lists->slug); ?>" name="<?php echo e($lists->name); ?>" title="<?php echo e($lists->name); ?>">
                                <?php echo e($lists->name); ?>

                            </a>
                            <?php if($lists->tooltip): ?>
                                <div class="tooltip"><?php echo e($lists->tooltip); ?></div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="left">
                    <div class="searchHead resSearch">
                        <i>
                            <svg>
                                <use xlink:href="#search"></use>
                            </svg>
                        </i>
                    </div>
                    <?php if(\App\Models\Setting::where('key' , 'darkStatus')->pluck('value')->first() == 1): ?>
                        <div class="themeButton1">
                            <button class="theme-toggle  js-theme-toggle"
                                    aria-label="auto"
                                    aria-live="polite">
                                <svg>
                                    <use xlink:href="#sun"></use>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="headerCart">
                        <div class="headerCartItems">
                            <div class="cartShowBtn">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                </i>
                                <h5>0</h5>
                            </div>
                            <div class="showCart2">
                                <div class="showCartContainer">
                                    <div class="liCart">
                                        <ul id="showCartLi"></ul>
                                        <div class="showCartEmpty">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#cart"></use>
                                                </svg>
                                            </i>
                                            <h3><?php echo e(__('messages.empty_cart')); ?></h3>
                                        </div>
                                    </div>
                                    <div class="showCartBot">
                                        <a href="/cart"><?php echo e(__('messages.show_cart')); ?></a>
                                        <a href="/checkout"><?php echo e(__('messages.checkout_cart')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(auth()->user()): ?>
                        <div class="user">
                            <div class="pic" id="userPic2" aria-haspopup="true">
                                <?php if(auth()->user()->profile): ?>
                                    <img src="<?php echo e(auth()->user()->profile); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                                <?php else: ?>
                                    <img src="/img/user.png" alt="<?php echo e(auth()->user()->name); ?>">
                                <?php endif; ?>
                            </div>
                            <ul id="showUser2">
                                <li>
                                    <div class="picUser">
                                        <img src="/img/user.png" alt="user">
                                    </div>
                                    <div class="infoUser">
                                        <span><?php echo e(auth()->user()->name); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <a href="/profile">
                                        <?php echo e(__('messages.panel_user')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/bookmark">
                                        <?php echo e(__('messages.bookmark_user')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/like">
                                        <?php echo e(__('messages.like_user')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/pay">
                                        <?php echo e(__('messages.order_user')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a href="/logout">
                                        <?php echo e(__('messages.exit_user')); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="/login" class="login" name="<?php echo e(__('messages.login_user')); ?>" title="<?php echo e(__('messages.login_user')); ?>">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#user"></use>
                                </svg>
                            </i>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
        <div class="allSearchData">
            <form action="/search" method="GET" class="searchData">
                <label for="search1">
                    <input type="text" id="searching" name="search" placeholder="<?php echo e(__('messages.search_product')); ?>">
                    <button id="btnSearchData">
                        <svg class="icon">
                            <use xlink:href="#search"></use>
                        </svg>
                    </button>
                    <i style="display: none" class="searchLoad">
                        <svg class="loading">
                            <use xlink:href="#loading"></use>
                        </svg>
                    </i>
                    <i id="btnSearchClose">
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </label>
            </form>
        </div>
    </div>
</header>

<script>
    $(document).mouseup(function(e)
    {
        var container = $(".showCart2");
        var container1 = $(".flagHeader");
        var container2 = $(".searchData");
        if (container.is(e.target) && container.has(e.target).length == 0)
        {
            $('.showCart2').hide();
        }
        if (!container1.is(e.target) && container1.has(e.target).length == 0)
        {
            $('.flagList').hide();
        }
        if (!container2.is(e.target) && container2.has(e.target).length == 0)
        {
            $('.allSearchData').hide();
        }
    });
    $(document).ready(function (){
        var arz1 = <?php echo json_encode(__('messages.arz'), JSON_HEX_TAG); ?>;
        var themes = <?php echo json_encode($theme, JSON_HEX_TAG); ?>;
        $.cookie('theme' , themes , { path: '/' });
        $(".allBigIndex").css({"margin-top": "0"});
        $('.allHeaderIndex2 #userPic2').click(function (){
            $('.allHeaderIndex2 #showUser2').toggle(50);
            $('.allHeaderIndex2 .showCart2').hide();
        })
        $('.allHeaderIndex2 .cartShowBtn').click(function(){
            $('.allHeaderIndex2 #showUser2').hide();
            $('.allHeaderIndex2 .showCart2').toggle();
        })
        $('.allHeaderIndex2 .flagHeader').click(function(){
            $('.allHeaderIndex2 .flagHeader .flagList').toggle();
        })
        $('.allHeaderIndex2 .allCats li').on('click' ,function(){
            $($(this).children()[1]).toggle();
        })
        $('.allHeaderIndex2 .categoryHeaderResponsive #btnShowMenu').on('click' ,function(){
            $('.allHeaderIndex2 .categoryHeaderResponsive').toggle();
        })
        $('.flagHeader .flagList .item').on('click' ,function(){
            $.cookie('language' , $(this).attr('id'));
            $('.allLoading').show();
            window.location.href = '/';
        })
        $('.resAlign').on('click' ,function(){
            $('.allHeaderIndex2 .categoryHeaderResponsive').toggle();
        })
        $('.resSearch,.allSearchData #btnSearchClose').click(function(){
            $('.allHeaderIndex2 .allSearchData').toggle();
        })
        var typingTimer;
        var doneTypingInterval = 500;
        var $input = $('.allHeaderIndex2 .allSearchData #searching');
        $input.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });
        $input.on('keydown', function () {
            clearTimeout(typingTimer);
        });
        function doneTyping () {
            $('.allHeaderIndex2 .allSearchData form ul').remove();
            if($(".allHeaderIndex2 .allSearchData input[name='search']").val().length >= 1){
                $('.allHeaderIndex2 .allSearchData .searchLoad').show();
                $('.allHeaderIndex2 .allSearchData #btnSearchData').hide();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    'search' : $(".allHeaderIndex2 .allSearchData input[name='search']").val(),
                    'categorySearch' : $(".allHeaderIndex2 .allSearchData select[name='categorySearch']").val()
                };
                $.ajax({
                    url: "/search",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.allHeaderIndex2 .allSearchData .searchLoad').hide();
                        $('.allHeaderIndex2 .allSearchData #btnSearchData').show();
                        $('.allHeaderIndex2 .allSearchData form').append(
                            '<ul></ul>'
                        );
                        $.each(data,function(){
                            $('.allHeaderIndex2 .allSearchData form ul').append(
                                '<li>'+
                                    '<a href="/product/'+this.slug+'">'+
                                    '<div class="pic">'+
                                    '<img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'">'+
                                    '</div>'+
                                    '<div class="subject">'+
                                    '<h3>'+this.title+'</h3>'+
                                    '<h5>'+this.product_id+'</h5>'+
                                    '</div>'+
                                    '<div class="price">'+makePrice(this.price) + arz1 +' </div>'+
                                    '</a>'+
                                '</li>'
                            );
                        })
                    },
                });
            }
        }
        function makePrice(price){
            price += '';
            x = price.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            finalPrice = x1 + x2;
            return finalPrice;
        }
        $('.allHeaderIndex2 .js-theme-toggle').on('click' , function(){
            theme.value = theme.value === 'light'
                ? 'dark'
                : 'light'
            if(theme.value == 'dark'){
                $.cookie('theme' , true , { path: '/' });
                $('head').append('<link rel="stylesheet" href="/css/dark-home.css?v=11" type="text/css" />');
                var greenColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'greenColorDark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var redColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'redColorDark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var backColor1 = <?php echo json_encode(\App\Models\Setting::where('key' , 'backColorDark1')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var headerColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'headerColorDark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var headerColor2 = <?php echo json_encode(\App\Models\Setting::where('key' , 'headerColor2Dark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var widgetColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'widgetColorDark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var singleColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'singleColorDark')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                document.documentElement.style.setProperty('--green-color', greenColor);
                document.documentElement.style.setProperty('--red-color', redColor);
                document.documentElement.style.setProperty('--header-color', headerColor);
                document.documentElement.style.setProperty('--header2-color', headerColor2);
                document.documentElement.style.setProperty('--widget-color', widgetColor);
                document.documentElement.style.setProperty('--single-color', singleColor);
                document.documentElement.style.setProperty('--back4-color', backColor1);
            }else{
                $.cookie('theme' , false , { path: '/' });
                $('head').append('<link rel="stylesheet" href="/css/home.css?v=11" type="text/css" />');
                var greenColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'greenColorLight')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var redColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'redColorLight')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var backColor1 = <?php echo json_encode(\App\Models\Setting::where('key' , 'backColorLight1')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var headerColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'headerColorLight')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var headerColor2 = <?php echo json_encode(\App\Models\Setting::where('key' , 'headerColor2Light')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var widgetColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'widgetColorLight')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                var singleColor = <?php echo json_encode(\App\Models\Setting::where('key' , 'singleColorLight')->pluck('value')->first(), JSON_HEX_TAG); ?>;
                document.documentElement.style.setProperty('--green-color', greenColor);
                document.documentElement.style.setProperty('--red-color', redColor);
                document.documentElement.style.setProperty('--header-color', headerColor);
                document.documentElement.style.setProperty('--header2-color', headerColor2);
                document.documentElement.style.setProperty('--widget-color', widgetColor);
                document.documentElement.style.setProperty('--single-color', singleColor);
                document.documentElement.style.setProperty('--back4-color', backColor1);
            }
            setPreference()
        })

        const getColorPreference = () => {
            return themes == 1 ? 'dark' : 'light'
        }

        const setPreference = () => {
            reflectPreference()
        }

        const reflectPreference = () => {
            if(theme.value == 'dark'){
                $('.js-theme-toggle svg').remove();
                $('.js-theme-toggle').append(
                    $('<svg class="dark"><use xlink:href="#moon"></use></svg>')
                )
            }else{
                $('.js-theme-toggle svg').remove();
                $('.js-theme-toggle').append(
                    $('<svg class="light"><use xlink:href="#sun"></use></svg>')
                )
            }
            document.firstElementChild
                .setAttribute('color-scheme', theme.value)

            document
                .querySelector('.js-theme-toggle')
                ?.setAttribute('aria-label', theme.value)
        }
        var gg = $("body").height();
        var st = $("body").scrollTop();
        $.each($(".allIndex .indexData"),function (){
            if(window.innerWidth >= 800){
                if (st + gg  + 100 >= $(this).offset().top && $(this).attr('id') != 'done') {
                    $(this).attr('id','done');
                    $(this).animate({"opacity":"1","margin-top":"2rem"},500);
                }
            }else{
                $(this).attr('id','done');
                $(this).animate({"opacity":"1","margin-top":"2rem"},500);
            }
        })
        const theme = {
            value: getColorPreference(),
        }
        reflectPreference()

        window.onload = () => {
            reflectPreference()
        }
        window
            .addEventListener('change', ({matches:isDark}) => {
                theme.value = isDark ? 'dark' : 'light'
                setPreference()
            })
    })
    var lastScrollTop = 0;
    var dd = 0;
    $(window).scroll(function(event){
        var gg = $(this).height();
        var st = $(this).scrollTop();
        $(".allHeaderIndex2 #showUser2").hide();
        $('.allHeaderIndex2 .flagHeader .flagList').hide();
        if(st >= 800){
            $(".topFixed").css({"display": "none"});
            $(".headerFix").css({"top": "0","position": "fixed","right": "0","left": "0","z-index": "100"});
            $("main").css({"padding-top": "7rem"});
            // if (st > lastScrollTop){
            //     if(dd == 0){
            //         $(".headerFix .headerBot").animate({"margin-top": "-10rem"},300);
            //     }
            //     dd = 1;
            // }else{
            //     if(dd == 1) {
            //         $(".headerFix .headerBot").animate({"margin-top": "0"}, 300);
            //     }
            //     dd = 0;
            // }
        }
        else{
            $(".topFixed").css({"display": "grid"});
            $(".headerFix").css({"position": "relative"});
            $("main").css({"padding-top": "0"});
            // if (st > lastScrollTop){
            //     if(dd == 0){
            //         $(".headerFix .headerBot").animate({"margin-top": "-10rem"},300);
            //     }
            //     dd = 1;
            // }else{
            //     if(dd == 1) {
            //         $(".headerFix .headerBot").animate({"margin-top": "0"}, 300);
            //     }
            //     dd = 0;
            // }
        }
        lastScrollTop = st;
        $.each($(".allIndex .indexData"),function (){
            if (st + gg >= $(this).offset().top && $(this).attr('id') != 'done') {
                $(this).attr('id','done');
                $(this).animate({"opacity":"1","margin-top":"2"},500);
            }
        })
    });
</script>
<?php /**PATH /var/www/html/resources/views/home/header/headerIndex2.blade.php ENDPATH**/ ?>