@extends('home.master')

@section('title' , $archive->name .' - ')
@section('content')
    <div class="allProductArchive width">
        <div class="productArchive">
            <div class="showFilterContent">
                {{__('messages.show_filter')}}
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
                        <span>{{__('messages.filter_price')}}</span>
                    </div>
                    <div class="priceItems">
                        <div class="nstSlider" data-range_min="{{$minPrice}}" data-range_max="{{$maxPrice}}"
                             data-cur_min="{{$getshowmin}}"    data-cur_max="{{$getshowmax}}">

                            <div class="bar"></div>
                            <div class="leftGrip"></div>
                            <div class="rightGrip"></div>
                        </div>
                        <div class="priceItem">
                            <label for="min_price">{{__('messages.from')}}</label>
                            <input type="number" name="min_price" class="min_price"/>
                        </div>
                        <div class="priceItem">
                            <label for="max_price">{{__('messages.to')}}</label>
                            <input type="number" name="max_price" class="max_price"/>
                        </div>
                        <button class="priceFilter">{{__('messages.filter_price')}}</button>
                    </div>
                </div>
                @if(count($cats) >= 1)
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        <span>{{__('messages.cat_product')}}</span>
                    </div>
                    <div class="filterCategories">
                        @foreach($cats as $item)
                            <a href="/category/{{$item->slug}}">
                                <span>{{$item->name}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(count($brands) >= 1)
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span>{{__('messages.brand_product')}}</span>
                        </div>
                        <div class="filterCategories">
                            @foreach($brands as $item)
                                <a href="/brand/{{$item->slug}}" title="{{$item->nameSeo}}"><span>{{$item->name}}</span></a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($color) >= 1)
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span>{{__('messages.color_product')}}</span>
                        </div>
                        <div class="filterContainer" id="colors">
                            @foreach($color as $item)
                                <div class="allProductArchiveFiltersItem">
                                    <label for="{{$item}}">
                                        <input id="{{$item}}" name="color" type="checkbox">
                                        {{$item}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($size) >= 1)
                    <div class="filterItems">
                        <div class="filterTitle">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#filter"></use>
                                </svg>
                            </i>
                            <span>{{__('messages.size_product')}}</span>
                        </div>
                        <div class="filterContainer" id="sizes">
                            @foreach($size as $item)
                                <div class="allProductArchiveFiltersItem">
                                    <label for="{{$item}}">
                                        <input id="{{$item}}" name="size" type="checkbox">
                                        {{$item}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="productContainer">
                <div class="productTitle">
                    <div class="right">
                        <div class="name">
                            <span>{{__('messages.products')}}</span>
                            <h1>{{$archive->name}}</h1>
                        </div>
                    </div>
                    <div class="left">
                        <div class="top">
                            <span>0</span>
                        </div>
                        <h4>{{__('messages.product')}}</h4>
                    </div>
                </div>
                <div class="searchProduct">
                    <label for="filterSearch">
                        <input id="filterSearch" type="text" name="searchData" value="{{$getsearch}}" placeholder="{{__('messages.filter_search_archive')}}">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#search"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="productOrder">
                    <span>{{__('messages.order_product')}} : </span>
                    <ul>
                        <li class="0">
                            @if($getshow == 0)
                                <span class="active">{{__('messages.order_new')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_new')}}</span>
                            @endif
                        </li>
                        <li class="1">
                            @if($getshow == 1)
                                <span class="active">{{__('messages.order_visit')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_visit')}}</span>
                            @endif
                        </li>
                        <li class="2">
                            @if($getshow == 2)
                                <span class="active">{{__('messages.order_sell')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_sell')}}</span>
                            @endif
                        </li>
                        <li class="3">
                            @if($getshow == 3)
                                <span class="active">{{__('messages.order_like')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_like')}}</span>
                            @endif
                        </li>
                        <li class="4">
                            @if($getshow == 4)
                                <span class="active">{{__('messages.order_cheap')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_cheap')}}</span>
                            @endif
                        </li>
                        <li class="5">
                            @if($getshow == 5)
                                <span class="active">{{__('messages.order_expensive')}}</span>
                                @else
                                <span class="unActive">{{__('messages.order_expensive')}}</span>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="productLists"></div>
            </div>
        </div>
        <div class="description">
            <h3>{{$archive->name}}</h3>
            <div><p>{!! $archive->body !!}</p></div>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            if(window.innerWidth <= 800) {
                $('.filterArchive').hide();
                $('.showFilterContent').show();
            }else{
                $('.filterArchive').show();
                $('.showFilterContent').hide();
            }
            var urlpages = {!! json_encode($urlpages, JSON_HEX_TAG) !!};
            var show = {!! json_encode($getshow, JSON_HEX_TAG) !!};
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
                var suggest_product1 = {!! json_encode(__('messages.suggest_product1'), JSON_HEX_TAG) !!};
                var order_method41 = {!! json_encode(__('messages.order_method4'), JSON_HEX_TAG) !!};
                var add_cart1 = {!! json_encode(__('messages.add_cart'), JSON_HEX_TAG) !!};
                var counseling_fast = {!! json_encode(__('messages.counseling_fast'), JSON_HEX_TAG) !!};
                var compare_product = {!! json_encode(__('messages.compare_product'), JSON_HEX_TAG) !!};
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
@endsection

@section('jsScript')
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.nstSlider.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.nstSlider.min.css"/>
    <link rel="stylesheet" href="/css/jquery-ui.min.css"/>
    <script src="/js/countdown.min.js"></script>
@endsection
