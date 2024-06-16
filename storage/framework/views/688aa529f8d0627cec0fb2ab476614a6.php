<?php $__env->startSection('title' , $archive->name .' - '); ?>
<?php $__env->startSection('content'); ?>
    <div class="allProductArchive width">
        <div class="productArchive">
            <div class="showFilterContent">
                <?php echo e(__('messages.show_filter')); ?>

                <i>
                    <svg class="icon">
                        <use xlink:href="#down"></use>
                    </svg>
                </i>
            </div>
            <div class="filterArchive">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        <span><?php echo e(__('messages.filter_price')); ?></span>
                    </div>
                    <div class="priceItems">
                        <div class="nstSlider" data-range_min="<?php echo e($minPrice); ?>" data-range_max="<?php echo e($maxPrice); ?>"
                             data-cur_min="<?php echo e($getshowmin); ?>"    data-cur_max="<?php echo e($getshowmax); ?>">

                            <div class="bar"></div>
                            <div class="leftGrip"></div>
                            <div class="rightGrip"></div>
                        </div>
                        <div class="priceItem">
                            <label for="min_price"><?php echo e(__('messages.from')); ?></label>
                            <input type="number" name="min_price" class="min_price"/>
                        </div>
                        <div class="priceItem">
                            <label for="max_price"><?php echo e(__('messages.to')); ?></label>
                            <input type="number" name="max_price" class="max_price"/>
                        </div>
                        <button class="priceFilter"><?php echo e(__('messages.filter_price')); ?></button>
                    </div>
                </div>
                <?php if(count($cats) >= 1): ?>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        <span><?php echo e(__('messages.cat_product')); ?></span>
                    </div>
                    <div class="filterCategories">
                        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="/category/<?php echo e($item->slug); ?>">
                                <span><?php echo e($item->name); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(count($brands) >= 1): ?>
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span><?php echo e(__('messages.brand_product')); ?></span>
                        </div>
                        <div class="filterCategories">
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="/brand/<?php echo e($item->slug); ?>" title="<?php echo e($item->nameSeo); ?>"><span><?php echo e($item->name); ?></span></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(count($color) >= 1): ?>
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span><?php echo e(__('messages.color_product')); ?></span>
                        </div>
                        <div class="filterContainer" id="colors">
                            <?php $__currentLoopData = $color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="allProductArchiveFiltersItem">
                                    <label for="<?php echo e($item); ?>">
                                        <input id="<?php echo e($item); ?>" name="color" type="checkbox">
                                        <?php echo e($item); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(count($size) >= 1): ?>
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span><?php echo e(__('messages.size_product')); ?></span>
                        </div>
                        <div class="filterContainer" id="sizes">
                            <?php $__currentLoopData = $size; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="allProductArchiveFiltersItem">
                                    <label for="<?php echo e($item); ?>">
                                        <input id="<?php echo e($item); ?>" name="size" type="checkbox">
                                        <?php echo e($item); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="productContainer">
                <div class="productTitle">
                    <div class="right">
                        <div class="name">
                            <span><?php echo e(__('messages.products')); ?></span>
                            <h1><?php echo e($archive->name); ?></h1>
                        </div>
                    </div>
                    <div class="left">
                        <div class="top">
                            <span>0</span>
                        </div>
                        <h4><?php echo e(__('messages.product')); ?></h4>
                    </div>
                </div>
                <div class="searchProduct">
                    <label for="filterSearch">
                        <input id="filterSearch" type="text" name="searchData" value="<?php echo e($getsearch); ?>" placeholder="<?php echo e(__('messages.filter_search_archive')); ?>">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#search"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="productOrder">
                    <span><?php echo e(__('messages.order_product')); ?> : </span>
                    <ul>
                        <li class="0">
                            <?php if($getshow == 0): ?>
                                <span class="active"><?php echo e(__('messages.order_new')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_new')); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="1">
                            <?php if($getshow == 1): ?>
                                <span class="active"><?php echo e(__('messages.order_visit')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_visit')); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="2">
                            <?php if($getshow == 2): ?>
                                <span class="active"><?php echo e(__('messages.order_sell')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_sell')); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="3">
                            <?php if($getshow == 3): ?>
                                <span class="active"><?php echo e(__('messages.order_like')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_like')); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="4">
                            <?php if($getshow == 4): ?>
                                <span class="active"><?php echo e(__('messages.order_cheap')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_cheap')); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="5">
                            <?php if($getshow == 5): ?>
                                <span class="active"><?php echo e(__('messages.order_expensive')); ?></span>
                                <?php else: ?>
                                <span class="unActive"><?php echo e(__('messages.order_expensive')); ?></span>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
                <div class="productLists"></div>
            </div>
        </div>
        <div class="description">
            <h3><?php echo e($archive->name); ?></h3>
            <div><p><?php echo $archive->body; ?></p></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script1'); ?>
    <script>
        $(document).ready(function(){
            if(window.innerWidth <= 800) {
                $('.filterArchive').hide();
                $('.showFilterContent').show();
            }else{
                $('.filterArchive').show();
                $('.showFilterContent').hide();
            }
            var urlpages = <?php echo json_encode($urlpages, JSON_HEX_TAG); ?>;
            var show = <?php echo json_encode($getshow, JSON_HEX_TAG); ?>;
            var colors = [];
            var sizes = [];
            $('.nstSlider').nstSlider({
                "left_grip_selector": ".leftGrip",
                "right_grip_selector": ".rightGrip",
                "value_bar_selector": ".bar",
                "value_changed_callback": function(cause, leftValue, rightValue) {
                    $(this).parent().find('.min_price').val(leftValue);
                    $(this).parent().find('.max_price').val(rightValue);
                }
            });
            $('.showFilterContent').click(function(){
                $('.filterArchive').toggle();
            })
            var max = $(".priceItem input[name='max_price']").val();
            var min = $(".priceItem input[name='min_price']").val();
            $.each($("#sizes input[name='size']") , function (){
                if(this.checked){
                    sizes.push(this.id);
                }
            });
            $(document).on('keypress',function(e) {
                if(e.which == 13) {
                    getUrl();
                }
            });
            $.each($("#colors input[name='color']") , function (){
                if(this.checked){
                    colors.push(this.id);
                }
            });
            $("#colors input[name='color']").on('change',function (){
                colors = [];
                $.each($("#colors input[name='color']") , function (){
                    if(this.checked){
                        colors.push(this.id);
                    }
                });
                getUrl();
            })
            $(".priceItems .priceFilter").click(function (){
                getUrl();
            })
            $("#sizes input[name='size']").on('change',function (){
                sizes = [];
                $.each($("#sizes input[name='size']") , function (){
                    if(this.checked){
                        sizes.push(this.id);
                    }
                });
                getUrl();
            })
            $(".productOrder ul li").on('click',function (){
                show = $(this).attr('class');
                $(".productOrder ul li .active").attr('class' , 'unActive')
                $(this).children('span').attr('class' , 'active');
                getUrl();
            })
            getUrl();
            function getUrl(){
                $('.allLoading').show();
                if(window.innerWidth <= 800) {
                    $('.filterArchive').hide();
                    $('.showFilterContent').show();
                }
                $(".allPaginateHome").remove();
                max = $(".priceItem input[name='max_price']").val();
                min = $(".priceItem input[name='min_price']").val();
                var searchData = $("input[name='searchData']").val();
                window.history.pushState("", "", '?min='+min+'&max='+max+'&show='+show+'&search='+searchData+'&allSize='+sizes.join()+'&allColor='+colors.join());
                $(".productLists").children(".productList").remove();
                $.ajax({
                    url: urlpages+'?min='+min+'&max='+max+'&show='+show+'&search='+searchData+'&allSize='+sizes.join()+'&allColor='+colors.join(),
                    type: "get",
                    success: function (data) {
                        $('.allLoading').hide();
                        getData(data.data);
                        setTimeout( function(){
                            $('.countdown').each(function() {
                                    var $this = $(this), finalDate = $(this).attr('data-time');
                                    $this.countdown(finalDate, function(event) {
                                            $this.html(event.strftime(''
                                                + '<span class="countdown-section"><span class="countdown-time">%D</span></span>'
                                                + '<span class="countdown-section"><span class="countdown-time">%H</span></span>'
                                                + '<span class="countdown-section"><span class="countdown-time">%M</span></span>'
                                                + '<span class="countdown-section"><span class="countdown-time">%S</span></span>'));
                                        }
                                    );
                                }
                            );
                        }  , 100 );
                        $('.left .top span').text(data.total);
                        $('.productContainer').append(
                            $(
                                (data.last_page >= 2 ?
                                    '<div class="allPaginateHome">'+
                                        '<div class="pages"></div>'+
                                    '</div>'
                                : '')
                            )
                        );
                        $.each(data.links , function() {
                            if (this.label == 'قبلی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                        $(".productLists").children(".productList").remove();
                                        $.ajax({
                                            url: $(this).attr('name'),
                                            type: "get",
                                            success: function (data) {
                                                getData(data.data);
                                                $.each(data.links , function() {
                                                    if (this.label == 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                                        )
                                                    }
                                                    if (this.label == 'بعدی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                                        );
                                                    }
                                                    if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                                        );
                                                    }
                                                    $(".allPaginateHome .pages :first").remove();
                                                })
                                                setTimeout( function(){
                                                    $('.countdown').each(function() {
                                                            var $this = $(this), finalDate = $(this).attr('data-time');
                                                            $this.countdown(finalDate, function(event) {
                                                                    $this.html(event.strftime(''
                                                                        + '<span class="countdown-section"><span class="countdown-time">%D</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%H</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%M</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%S</span></span>'));
                                                                }
                                                            );
                                                        }
                                                    );
                                                }  , 100 );
                                            }
                                        })
                                    });
                            }
                            if (this.label == 'بعدی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                        $(".productLists").children(".productList").remove();
                                        $.ajax({
                                            url: $(this).attr('name'),
                                            type: "get",
                                            success: function (data) {
                                                getData(data.data);
                                                $.each(data.links , function() {
                                                    if (this.label == 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                                        )
                                                    }
                                                    if (this.label == 'بعدی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                                        );
                                                    }
                                                    if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                                        $('.allPaginateHome .pages').append(
                                                            '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                                        );
                                                    }
                                                    $(".allPaginateHome .pages :first").remove();
                                                })
                                                setTimeout( function(){
                                                    $('.countdown').each(function() {
                                                            var $this = $(this), finalDate = $(this).attr('data-time');
                                                            $this.countdown(finalDate, function(event) {
                                                                    $this.html(event.strftime(''
                                                                        + '<span class="countdown-section"><span class="countdown-time">%D</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%H</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%M</span></span>'
                                                                        + '<span class="countdown-section"><span class="countdown-time">%S</span></span>'));
                                                                }
                                                            );
                                                        }
                                                    );
                                                }  , 100 );
                                            }
                                        })
                                    });
                            }
                            if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                $('.allPaginateHome .pages').append(
                                    '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                )
                                    .on('click' , '#'+this.label , function() {
                                    });
                            }
                        })
                    },
                });
                $(document).on('click', '.allPaginateHome .pages div', function(){
                    $(".productLists").children(".productList").remove();
                    $(".allPaginateHome").remove();
                    $('.allLoading').show();
                    window.history.pushState("", "", '?min='+min+'&max='+max+'&show='+show+'&search='+searchData+'&allSize='+sizes.join()+'&allColor='+colors.join()+'&page='+$(this).attr('id'));
                    $.ajax({
                        url: $(this).attr('name'),
                        type: "get",
                        success: function (data) {
                            $('.allLoading').hide();
                            getData(data.data)
                            $('.productContainer').append(
                                $(
                                    (data.last_page >= 2 ?
                                        '<div class="allPaginateHome">'+
                                        '<div class="pages"></div>'+
                                        '</div>'
                                        : '')
                                )
                            );
                            $.each(data.links , function() {
                                if (this.label == 'قبلی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#right"></use></svg></div>'
                                    )
                                }
                                if (this.label == 'بعدی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'"><svg class="icon"><use xlink:href="#left"></use></svg></div>'
                                    );
                                }
                                if (this.label != 'بعدی' && this.label != 'قبلی' && this.url != null){
                                    $('.allPaginateHome .pages').append(
                                        '<div class="' + this.active + '" id="' + this.label + '" name="'+this.url+'">'+this.label+'</div>'
                                    );
                                }
                            })
                        }
                    })
                });
                var suggest_product1 = <?php echo json_encode(__('messages.suggest_product1'), JSON_HEX_TAG); ?>;
                var order_method41 = <?php echo json_encode(__('messages.order_method4'), JSON_HEX_TAG); ?>;
                var add_cart1 = <?php echo json_encode(__('messages.add_cart'), JSON_HEX_TAG); ?>;
                var counseling_fast = <?php echo json_encode(__('messages.counseling_fast'), JSON_HEX_TAG); ?>;
                var compare_product = <?php echo json_encode(__('messages.compare_product'), JSON_HEX_TAG); ?>;
                function getData(data){
                    $.each(data, function () {
                        $('.productLists').append(
                            $(
                                '<div class="productList">'+
                                '<a href="/product/'+this.slug+'" title="'+this.titleSeo+'" name="'+this.title+'">'+
                                '<article>'+
                                (this.suggest ? '<img src="/img/SpecialSell.svg" alt="'+suggest_product1+'" class="specialSell">': '')+
                                (this.image != '[]' ? '<figure class="pic"><img class="zoom lazyload" lazy="loading" src="/img/404Image.png" data-src="'+JSON.parse(this.image)[0]+'" alt="'+this.imageAlt+'"></figure>': '')+
                                (this.lotteryStatus == 1 ? '<div class="lotteryStatus"><svg class="icon"><use xlink:href="#lotteryShow"></use></svg></div>': '')+
                                '<div class="options">'+
                                '<div class="optionItem" name="quickBuy" title="'+order_method41+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#time-fast"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="addCart" title="'+add_cart1+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#add-cart"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="counselingBtn" title="'+counseling_fast+'" data="'+this.title+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#counseling"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="compareBtn" title="'+compare_product+'" id="'+this.product_id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#chart"></use>'+
                                '</svg>'+
                                '</div>'+
                                '</div>'+
                                '<h3>'+this.title+'</h3>'+
                                '<div class="price">'+
                                (this.off ? '<s>'+makePrice(this.offPrice)+'</s><div class="offProduct"><div class="offProductItem"><svg class="icon"><use xlink:href="#off-tag"></use></svg><div><span>%'+this.off+'</span></div></div></div>': '')+
                                '<h5>'+makePrice(this.price)+'</h5>'+
                                '</div>'+
                                (this.note ?
                                        '<div class="note">'+
                                        '<h4>'+this.note+'</h4>'+
                                        '</div>'
                                        :
                                        `<div class="optionDown">
                                        <div class="optionItem" name="addCart" title="${add_cart1}" id="${this.id}">
                                            <svg class="icon">
                                                <use xlink:href="#add-cart"></use>
                                            </svg>
                                            ${add_cart1}
                                        </div>
                                        <div class="optionItem" name="counselingBtn" title="${counseling_fast}" data="${this.title}" id="${this.id}">
                                            <svg class="icon">
                                                <use xlink:href="#counseling"></use>
                                            </svg>
                                        </div>
                                    </div>`
                                )+
                                '</article>'+
                                '</a>'+
                                '</div>'
                            )
                        );
                    })
                    let lazy = lazyload();
                    $("img.lazyload").lazyload();
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
                    return x1 + x2;
                }
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.nstSlider.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.nstSlider.min.css"/>
    <link rel="stylesheet" href="/css/jquery-ui.min.css"/>
    <script src="/js/countdown.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/archive/product.blade.php ENDPATH**/ ?>