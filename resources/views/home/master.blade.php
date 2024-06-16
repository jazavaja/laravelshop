<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') {{$title}}</title>
    {!! SEO::generate() !!}
    @laravelPWA
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(\Illuminate\Support\Facades\App::getLocale() == 'fa')
        @if(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 0)
            <link rel="stylesheet" href="/css/font-iransans.css" type="text/css"/>
        @elseif(\App\Models\Setting::where('key' , 'font')->pluck('value')->first() == 1)
            <link rel="stylesheet" href="/css/font-vazir.css" type="text/css"/>
        @else
            <link rel="stylesheet" href="/css/font-sahel.css" type="text/css"/>
        @endif
    @endif
    @if($theme == 1)
        <link rel="stylesheet" href="/css/dark-home.css?v=sa3" type="text/css"/>
    @else
        <link rel="stylesheet" href="/css/home.css?v=sa3" type="text/css"/>
    @endif
    <script src="/js/jquery-3.6.1.min.js"></script>
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/lazyload.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.cookie.js"></script>
    @yield('jsScript')
    @yield('jsScript2')
    @yield('torobTag')
    {!! $headScript !!}
    @yield('mapLink')
</head>
    <body style="opacity: 0">
        @yield('map')
        @include('icons')
        @include('home.allLoading')
        @if(\App\Models\Setting::where('key' , 'headerDesign')->pluck('value')->first())
            @include('home.header.headerIndex2' , ['catHeader' => $catHeader,'catTop' => $catTop,'theme' => $theme,'stateContainer' => $stateContainer,'name' => $name,'title' => $title,'logo' => $logo,'heightHeader' => $heightHeader,'imageHeader' => $imageHeader,'linkHeader' => $linkHeader,'adHeaderStatus' => $adHeaderStatus])
        @else
            @include('home.header.headerIndex' , ['catHeader' => $catHeader,'catTop' => $catTop,'theme' => $theme,'stateContainer' => $stateContainer,'name' => $name,'title' => $title,'logo' => $logo,'heightHeader' => $heightHeader,'imageHeader' => $imageHeader,'linkHeader' => $linkHeader,'adHeaderStatus' => $adHeaderStatus])
        @endif
        @yield('content')
        @if(\App\Models\Setting::where('key' , 'footerDesign')->pluck('value')->first())
            @include('home.footer.footer2' , ['telegram' => $telegram,'twitter' => $twitter,'instagram' => $instagram,'etemad' => $etemad,'fanavari' => $fanavari,'facebook' => $facebook,'name' => $name,])
        @else
            @include('home.footer.footerIndex' , ['telegram' => $telegram,'twitter' => $twitter,'instagram' => $instagram,'etemad' => $etemad,'fanavari' => $fanavari,'facebook' => $facebook,'name' => $name,])
        @endif
        @include('home.floatBtn')
        @if(\App\Models\Setting::where('key' , 'textFloat')->pluck('value')->first())
            <div class="textFloat">
                <span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#bell2"></use>
                        </svg>
                    </i>
                    {{\Illuminate\Support\Facades\App::getLocale() == 'fa' ? \App\Models\Setting::where('key' , 'textFloat')->pluck('value')->first():''}}
                    {{\Illuminate\Support\Facades\App::getLocale() == 'en' ? \App\Models\Setting::where('key' , 'textFloatEn')->pluck('value')->first():''}}
                    {{\Illuminate\Support\Facades\App::getLocale() == 'ar' ? \App\Models\Setting::where('key' , 'textFloatAr')->pluck('value')->first():''}}
                    {{\Illuminate\Support\Facades\App::getLocale() == 'tr' ? \App\Models\Setting::where('key' , 'textFloatTr')->pluck('value')->first():''}}
                </span>
            </div>
        @endif
        @include('home.quickBuy' , ['captcha' => $captcha])
        @include('home.counselingFast' , ['captcha' => $captcha])
        {!! $bodyScript !!}
        @yield('script1')
        @yield('script2')
        @yield('jsBody')
        @yield('script3')
    </body style="opacity: 1">
</html>

<script>
    $(document).ready(function (){
        $('body').css({'opacity':1});
        var theme = {!! json_encode($theme, JSON_HEX_TAG) !!};
        if(theme == 1){
            var greenColor = {!! json_encode(\App\Models\Setting::where('key' , 'greenColorDark')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var redColor = {!! json_encode(\App\Models\Setting::where('key' , 'redColorDark')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var backColor1 = {!! json_encode(\App\Models\Setting::where('key' , 'backColorDark1')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var headerColor = {!! json_encode(\App\Models\Setting::where('key' , 'headerColorDark')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var headerColor2 = {!! json_encode(\App\Models\Setting::where('key' , 'headerColor2Dark')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var widgetColor = {!! json_encode(\App\Models\Setting::where('key' , 'widgetColorDark')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var singleColor = {!! json_encode(\App\Models\Setting::where('key' , 'singleColorDark')->pluck('value')->first(), JSON_HEX_TAG) !!};
        }else{
            var greenColor = {!! json_encode(\App\Models\Setting::where('key' , 'greenColorLight')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var redColor = {!! json_encode(\App\Models\Setting::where('key' , 'redColorLight')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var backColor1 = {!! json_encode(\App\Models\Setting::where('key' , 'backColorLight1')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var headerColor = {!! json_encode(\App\Models\Setting::where('key' , 'headerColorLight')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var headerColor2 = {!! json_encode(\App\Models\Setting::where('key' , 'headerColor2Light')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var widgetColor = {!! json_encode(\App\Models\Setting::where('key' , 'widgetColorLight')->pluck('value')->first(), JSON_HEX_TAG) !!};
            var singleColor = {!! json_encode(\App\Models\Setting::where('key' , 'singleColorLight')->pluck('value')->first(), JSON_HEX_TAG) !!};
        }
        document.documentElement.style.setProperty('--green-color', greenColor);
        document.documentElement.style.setProperty('--red-color', redColor);
        document.documentElement.style.setProperty('--header-color', headerColor);
        document.documentElement.style.setProperty('--header2-color', headerColor2);
        document.documentElement.style.setProperty('--widget-color', widgetColor);
        document.documentElement.style.setProperty('--single-color', singleColor);
        document.documentElement.style.setProperty('--back4-color', backColor1);

        var number1 = {!! json_encode(__('messages.number'), JSON_HEX_TAG) !!};
        var arz1 = {!! json_encode(__('messages.arz'), JSON_HEX_TAG) !!};
        var add_cart21 = {!! json_encode(__('messages.add_cart2'), JSON_HEX_TAG) !!};
        var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
        var no_count = {!! json_encode(__('messages.no_count'), JSON_HEX_TAG) !!};
        var count1 = {!! json_encode(__('messages.count1'), JSON_HEX_TAG) !!};
        var error1 = {!! json_encode(__('messages.error1'), JSON_HEX_TAG) !!};
        var login_attention = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
        var myLang = {!! json_encode(request()->cookie('language'), JSON_HEX_TAG) !!};
        $.ajax({
            url: "/get-cart",
            type: "get",
            success: function (data) {
                var count = 0;
                $.each(data,function(){
                    count = parseInt(count) + parseInt(this.count);
                    var prices = makePrice(this.price*this.count);
                    $('#showCartLi').append(
                    $('<li id="'+this.slug+'" pack="'+this.pack+'" count="'+this.count+'" price="'+this.price+'"><div class="cartPic">' +
                        (this.pack == 1 ? '<a href="/pack/'+this.slug+'"><img src="'+this.image+'" alt="'+this.title+'"></a>':'<a href="/product/'+this.slug+'"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'"></a>') +
                        '</div><div class="cartText"><div class="cartTitle"><h4>'+this.title+
                        (this.color ? '<h4> - '+this.color+'</h4>': '')+
                        (this.size ? '<h4> - '+this.size+'</h4>': '') +
                        (this.count ? '<h4 class="countCart"> - '+this.count+number1+' </h4>': '') +
                        '</h4><i id="deleteCart" pack="'+this.pack+'" size="'+this.size+'" color="'+this.color+'" guarantee="'+this.guarantee_id+'" product="'+this.product+'"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></div><div class="cartTextItem"><div class="cartPrice"><span>'+prices+arz1+'</span></div></div></div></li>')
                    .on('click' , '#deleteCart',function(ss){
                        $('.allLoading').show();
                            var form = {
                                "_token": "{{ csrf_token() }}",
                                "color": $(this).attr('color'),
                                "size": $(this).attr('size'),
                                "guarantee": $(this).attr('guarantee'),
                                "pack": $(this).attr('pack'),
                                "product": $(this).attr('product'),
                            };

                            $.ajax({
                                url: "/delete-cart",
                                type: "post",
                                data: form,
                                success: function (data) {
                                    $('.allLoading').hide();
                                    if(window.location.pathname == '/checkout'){
                                        window.location.reload();
                                    }else{
                                        var cartCounts = $('.cartShowBtn h5').text();
                                        $('.cartShowBtn h5').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                        $('#allCountCart span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                        $('.tabs .active span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                        $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                        $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))) + ' ' + arz1);
                                        $('#allPrice2 h3').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                        $('#allPrice1 span').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                        $('.cartIndex .cartItems #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                                        if($('.cartShowBtn h5').text() <= 0){
                                            $('.showCartEmpty').show();
                                            $('.allCartIndexEmpty').show();
                                            $('.cartIndex').hide();
                                            $('.topCartIndex').hide();
                                        }
                                        ss.currentTarget.parentElement.parentElement.parentElement.remove();
                                    }
                                },
                            });
                        })
                    );
                })
                if(data.length){
                    $('.headerCart .showCartEmpty').hide();
                }
                $('.cartShowBtn h5').text(parseInt(count));
                $('.postCount span').text(parseInt(count));
            },
        });
        if(!myLang){
            $.cookie('language' , 'fa');
        }
        $('.allIndex').click(function(){
            $('.showCart').hide(300);
            $('#showUser').hide(300);
        })
        $('.headerBot').click(function(){
            $('.showCart').hide(300);
            $('#showUser').hide(300);
        })
        $(document).on('click',".options div[name='compareBtn']",function(event){
            event.preventDefault();
            window.location.href = '/compare?product=' + $(this).attr('id');
        })
        $(document).on('click',"div[name='addCart']",function(event){
            event.preventDefault();
            $('.allLoading').show();
            var form = {
                "_token": "{{ csrf_token() }}",
                "product": $(this).attr('id'),
            };
            $.ajax({
                url: "/add-cart-fast",
                type: "post",
                data: form,
                success: function (data) {
                    $('.allLoading').hide();
                    if(data[0] == 'success'){
                        $.toast({
                            text: add_cart21, // Text that is to be shown in the toast
                            heading: success1, // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#9EC600',
                        });
                        $.each($('#showCartLi li'), function(key,value) {
                            this.remove();
                        });
                        var count = 0;
                        $.each(data[1],function(){
                            count = parseInt(count) + parseInt(this.count);
                            var prices = makePrice(this.price*this.count);
                            $('#showCartLi').append(
                                $('<li id="'+this.slug+'" pack="'+this.pack+'" count="'+this.count+'" price="'+this.price+'"><div class="cartPic">' +
                                    (this.pack == 1 ? '<a href="/pack/'+this.slug+'"><img src="'+this.image+'" alt="'+this.title+'"></a>':'<a href="/product/'+this.slug+'"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'"></a>') +
                                    '</div><div class="cartText"><div class="cartTitle"><h4>'+this.title+
                                    (this.color ? '<h4> - '+this.color+'</h4>': '')+
                                    (this.size ? '<h4> - '+this.size+'</h4>': '') +
                                    (this.count ? '<h4 class="countCart"> - '+this.count+number1+' </h4>': '') +
                                    '</h4><i id="deleteCart" pack="'+this.pack+'" size="'+this.size+'" color="'+this.color+'" guarantee="'+this.guarantee_id+'" product="'+this.product+'"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></div><div class="cartTextItem"><div class="cartPrice"><span>'+prices+arz1+'</span></div></div></div></li>')
                                    .on('click' , '#deleteCart',function(ss){
                                        $('.allLoading').show();
                                        var form = {
                                            "_token": "{{ csrf_token() }}",
                                            "color": $(this).attr('color'),
                                            "pack": $(this).attr('pack'),
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
                                                if(window.location.pathname == '/checkout'){
                                                    window.location.reload();
                                                }else{
                                                    var cartCounts = $('.cartShowBtn h5').text();
                                                    $('.cartShowBtn h5').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allCountCart span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('.tabs .active span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))) + ' ' + arz1);
                                                    $('#allPrice2 h3').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('.cartIndex .cartItems #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                                                    if($('.cartShowBtn h5').text() <= 0){
                                                        $('.showCartEmpty').show();
                                                        $('.allCartIndexEmpty').show();
                                                        $('.cartIndex').hide();
                                                        $('.topCartIndex').hide();
                                                    }
                                                    ss.currentTarget.parentElement.parentElement.parentElement.remove();
                                                }
                                            },
                                        });
                                    })
                            );
                        })
                        if(data[1].length){
                            $('.headerCart .showCartEmpty').hide();
                        }
                        $('.cartShowBtn h5').text(parseInt(count));
                        $('.postCount span').text(parseInt(count));
                    }
                    else{
                        $.toast({
                            text: no_count, // Text that is to be shown in the toast
                            heading: count1, // Optional heading to be shown on the toast
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
                    }
                },
                error: function (xhr) {
                    $('.allLoading').hide();
                    $.toast({
                        text: error1, // Text that is to be shown in the toast
                        heading: login_attention, // Optional heading to be shown on the toast
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
                }
            });
        })
        $(document).on('click',".addCollect",function(event){
            event.preventDefault();
            $('.allLoading').show();
            var form = {
                "_token": "{{ csrf_token() }}",
                "collect": $(this).attr('id'),
            };
            $.ajax({
                url: "/add-pack",
                type: "post",
                data: form,
                success: function (data) {
                    $('.allLoading').hide();
                    if(data[0] == 'success'){
                        $.toast({
                            text: add_cart21, // Text that is to be shown in the toast
                            heading: success1, // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#9EC600',
                        });
                        $.each($('#showCartLi li'), function(key,value) {
                            this.remove();
                        });
                        var count = 0;
                        $.each(data[1],function(){
                            count = parseInt(count) + parseInt(this.count);
                            var prices = makePrice(this.price*this.count);
                            $('#showCartLi').append(
                                $('<li id="'+this.slug+'" pack="'+this.pack+'" count="'+this.count+'" price="'+this.price+'"><div class="cartPic">' +
                                    (this.pack == 1 ? '<a href="/pack/'+this.slug+'"><img src="'+this.image+'" alt="'+this.title+'"></a>':'<a href="/product/'+this.slug+'"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'"></a>') +
                                    '</div><div class="cartText"><div class="cartTitle"><h4>'+this.title+
                                    (this.color ? '<h4> - '+this.color+'</h4>': '')+
                                    (this.size ? '<h4> - '+this.size+'</h4>': '') +
                                    (this.count ? '<h4 class="countCart"> - '+this.count+number1+' </h4>': '') +
                                    '</h4><i id="deleteCart" pack="'+this.pack+'" size="'+this.size+'" color="'+this.color+'" guarantee="'+this.guarantee_id+'" product="'+this.product+'"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></div><div class="cartTextItem"><div class="cartPrice"><span>'+prices+arz1+'</span></div></div></div></li>')
                                    .on('click' , '#deleteCart',function(ss){
                                        $('.allLoading').show();
                                        var form = {
                                            "_token": "{{ csrf_token() }}",
                                            "color": $(this).attr('color'),
                                            "size": $(this).attr('size'),
                                            "pack": $(this).attr('pack'),
                                            "guarantee": $(this).attr('guarantee'),
                                            "product": $(this).attr('product'),
                                        };

                                        $.ajax({
                                            url: "/delete-cart",
                                            type: "post",
                                            data: form,
                                            success: function (data) {
                                                $('.allLoading').hide();
                                                if(window.location.pathname == '/checkout'){
                                                    window.location.reload();
                                                }else{
                                                    var cartCounts = $('.cartShowBtn h5').text();
                                                    $('.cartShowBtn h5').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allCountCart span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('.tabs .active span').text(parseInt(cartCounts) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')));
                                                    $('#allPrice2 h3').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').text(makePrice(parseInt($('#allPrice2 h3').attr('id')) - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))) + ' ' + arz1);
                                                    $('#allPrice2 h3').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('#allPrice1 span').attr('id',parseInt($('#allPrice2 h3').attr('id') - parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('count')) * parseInt($(ss.currentTarget.parentElement.parentElement.parentElement).attr('price'))));
                                                    $('.cartIndex .cartItems #'+$(ss.currentTarget.parentElement.parentElement.parentElement).attr('id')).remove();
                                                    if($('.cartShowBtn h5').text() <= 0){
                                                        $('.showCartEmpty').show();
                                                        $('.allCartIndexEmpty').show();
                                                        $('.cartIndex').hide();
                                                        $('.topCartIndex').hide();
                                                    }
                                                    ss.currentTarget.parentElement.parentElement.parentElement.remove();
                                                }
                                            },
                                        });
                                    })
                            );
                        })
                        if(data[1].length){
                            $('.headerCart .showCartEmpty').hide();
                        }
                        $('.cartShowBtn h5').text(parseInt(count));
                        $('.postCount span').text(parseInt(count));
                    }
                    else{
                        $.toast({
                            text: no_count, // Text that is to be shown in the toast
                            heading: count1, // Optional heading to be shown on the toast
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
                    }
                },
                error: function (xhr) {
                    $('.allLoading').hide();
                    $.toast({
                        text: error1, // Text that is to be shown in the toast
                        heading: login_attention, // Optional heading to be shown on the toast
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
                }
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
        let lazy = lazyload();
        $("img.lazyload").lazyload();
    })
</script>
