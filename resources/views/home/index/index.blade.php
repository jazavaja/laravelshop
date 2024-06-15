@extends('home.master')

@section('content')
    <main class="allIndex">
        <h1 class="hiddenSeo">{{$title1}}</h1>
        @foreach($widget as $item)
            @if($item['name'] == 'تبلیغ اسلایدری')
                <div class="indexData">
                    @include('home.index.adsHooper' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'استوری')
                <div class="indexData">
                    @include('home.index.storyIndex' , ['data' => $item ,'storySeen' => $storySeen])
                </div>
            @endif
            @if($item['name'] == 'جشنواره')
                <div class="indexData">
                    @include('home.index.festivalIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'سوال متداول')
                <div class="indexData">
                    @include('home.index.faqIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'جستجو2')
                <div class="indexData">
                    @include('home.index.fastSearch' , ['data' => $item, 'categories' => $catsIndex])
                </div>
            @endif
            @if($item['name'] == 'تبلیغ ساده')
                <div class="indexData">
                    @include('home.index.adIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'وام')
                <div class="indexData">
                    @include('home.index.loanIndex' , ['data' => $item,'maxPriceLoan' => $maxPriceLoan,'maxMonthLoan' => $maxMonthLoan])
                </div>
            @endif
            @if($item['name'] == 'پک محصولات')
                <div class="indexData">
                    @include('home.index.collectionIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'اسلایدر بزرگ')
                <div class="indexData">
                    @include('home.index.bigIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'فروشندگان')
                <div class="indexData">
                    @include('home.index.sellerIndex' , ['sellers' => $sellers,'data' => $item])
                </div>
            @endif
            @if($item['name'] == 'جستجو')
                <div class="indexData">
                    @include('home.index.searchAdvance' , ['brandIndex' => $brandIndex,'catsIndex' => $catsIndex])
                </div>
            @endif
            @if($item['name'] == 'بهترین ها' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.bestIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'محصول عرضی' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.advanceProduct' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'گردونه دسته بندی' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.circleProduct' , ['data' => $item,])
                </div>
            @endif
            @if($item['name'] == 'محصولات اسلایدری' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.productList' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'محصول2' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.sliderIndex2' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'محصول3' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.sliderIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'محصولات با پس زمینه' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.backProduct' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'مقایسه')
                <div class="indexData">
                    @include('home.index.compareIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'محصولات عمودی با پس زمینه' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.digiProduct' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'پیشنهاد لحظه ای' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.momentProduct' , ['data' => $item , 'moment' => $moment])
                </div>
            @endif
            @if($item['name'] == 'دسته بندی')
                <div class="indexData">
                    @include('home.index.categoryPost' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'لیستی' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.offProduct' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'شگفت انگیز' && count($item['post']) >= 1)
                <div class="indexData">
                    @include('home.index.suggestIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'متن')
                <div class="indexData">
                    @include('home.index.textIndex' , ['data' => $item])
                </div>
            @endif
            @if($item['name'] == 'خبر')
                <div class="indexData">
                    @include('home.index.newsIndex' , ['data' => $item])
                </div>
            @endif
        @endforeach
        @if($popUp == 1)
            @include('home.index.popUp',['imagePopUp' => $imagePopUp,'descriptionPopUp' => $descriptionPopUp,'buttonPopUp' => $buttonPopUp,'titlePopUp' => $titlePopUp,'addressPopUp' => $addressPopUp,'popUpStatus'=>$popUpStatus])
        @endif
    </main>
@endsection

@section('jsScript')
    <link rel="stylesheet" href="/css/owl.carousel.min.css"/>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/countdown.min.js"></script>
@endsection

@section('script1')
<script>
    $(document).mouseup(function(e)
    {
        var container = $(".storyFixed");
        if (container.is(e.target) && container.has(e.target).length === 0)
        {
            container.hide();
        }
    });
    $(document).ready(function(){
        var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
        var day1 = {!! json_encode(__('messages.day1'), JSON_HEX_TAG) !!};
        var hour1 = {!! json_encode(__('messages.hour1'), JSON_HEX_TAG) !!};
        var month1 = {!! json_encode(__('messages.month'), JSON_HEX_TAG) !!};
        var min1 = {!! json_encode(__('messages.min1'), JSON_HEX_TAG) !!};
        var sec1 = {!! json_encode(__('messages.sec1'), JSON_HEX_TAG) !!};
        var suggest_product1 = {!! json_encode(__('messages.suggest_product1'), JSON_HEX_TAG) !!};
        var order_method4 = {!! json_encode(__('messages.order_method4'), JSON_HEX_TAG) !!};
        var add_cart = {!! json_encode(__('messages.add_cart'), JSON_HEX_TAG) !!};
        var compare = {!! json_encode(__('messages.compare'), JSON_HEX_TAG) !!};
        var counseling_fast = {!! json_encode(__('messages.counseling_fast'), JSON_HEX_TAG) !!};
        var no_product1 = {!! json_encode(__('messages.no_product'), JSON_HEX_TAG) !!};
        var unavailable1 = {!! json_encode(__('messages.unavailable1'), JSON_HEX_TAG) !!};
        var arz1 = {!! json_encode(__('messages.arz'), JSON_HEX_TAG) !!};
        var loan_p1 = {!! json_encode(__('messages.loan_p'), JSON_HEX_TAG) !!};
        var search_product1 = {!! json_encode(__('messages.search_product'), JSON_HEX_TAG) !!};
        var product1 = {!! json_encode(__('messages.product'), JSON_HEX_TAG) !!};
        var ticket_submit1 = {!! json_encode(__('messages.ticket_submit'), JSON_HEX_TAG) !!};
        var need_login1 = {!! json_encode(__('messages.need_login'), JSON_HEX_TAG) !!};
        var need_login2 = {!! json_encode(__('messages.need_login2'), JSON_HEX_TAG) !!};
        var loan_wait1 = {!! json_encode(__('messages.loan_wait'), JSON_HEX_TAG) !!};
        var login_attention1 = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
        var req_field1 = {!! json_encode(__('messages.req_field'), JSON_HEX_TAG) !!};
        var fail1 = {!! json_encode(__('messages.fail'), JSON_HEX_TAG) !!};
        var storySeen = {!! json_encode($storySeen, JSON_HEX_TAG) !!};
        var profitLoan = {!! json_encode($profitLoan, JSON_HEX_TAG) !!};
        var catFast = [];
        var brandFast = [];
        var optionFast = 0;
        $(".allLoanIndex input[name='amount']").val(0);
        $(".allLoanIndex input[name='month']").val(1);
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
        $('.countdown2').each(function() {
                var $this = $(this), finalDate = $(this).attr('data-time');
                $this.countdown(finalDate, function(event) {
                        $this.html(event.strftime(''
                            + '<span class="countdown-section"><span class="countdown-time">%D</span><span class="countdown-label">'+day1+'</span></span>'
                            + '<span class="countdown-section"><span class="countdown-time">%H</span><span class="countdown-label">'+hour1+'</span></span>'
                            + '<span class="countdown-section"><span class="countdown-time">%M</span><span class="countdown-label">'+min1+'</span></span>'
                            + '<span class="countdown-section"><span class="countdown-time">%S</span><span class="countdown-label">'+sec1+'</span></span>'));
                    }
                );
            }
        );
        var form = {
            "_token": "{{ csrf_token() }}",
            "productId": 0,
        };

        $.ajax({
            url: "/view",
            type: "post",
            data: form,
        });
        $('.addCartSlide .add').on('click',function(e){
            e.preventDefault();
            var $countInput = $(this.previousElementSibling);
            var parents1 = $(this.parentElement);
            var max1 = parents1.attr('data-max');
            if(parents1.attr('data-max') >= parents1.attr('data-count')){
                max1 = parents1.attr('data-count');
            }
            var currentVal = parseInt($countInput.text());
            if (!isNaN(currentVal) && max1 > currentVal) {
                $countInput.text(currentVal + 1);
            }
        });
        $('.addCartSlide .minus').on('click',function(e){
            e.preventDefault();
            var $countInput = $(this.nextElementSibling);
            var parents1 = $(this.parentElement);
            var min1 = parents1.attr('data-min');
            var currentVal = parseInt($countInput.text());
            if (!isNaN(currentVal) && currentVal > min1) {
                $countInput.text(currentVal - 1);
            }
        });
        $('.addCartSlide .showAddData .addData').on('click',function(e){
            e.preventDefault();
            var btnAdd = $(this).find('.textCart');
            btnAdd.text(wait1);
            var form = {
                "_token": "{{ csrf_token() }}",
                product: $(this).attr('data-id'),
                count: $(this.parentElement).find('.cartWant').text(),
            };

            $.ajax({
                url: "/add-cart-fast2",
                type: "post",
                data: form,
                success: function (res) {
                    window.location.href = '/cart';
                },
                error:function (err){
                    btnAdd.text(add_cart);
                }
            });
        });
        $('.allCircleProduct .circle-container').find('a').click(function(event) {
            event.preventDefault();
        });
        $('.allCircleProduct .circle-container').find('li').hover(function() {
            $('.allCircleProduct .circle-container').find('li').removeClass('active');
            $(this).addClass('active');
            $('.allCircleProduct .services-container').find('li.active').removeClass('active animated fadeIn');
            $(".allCircleProduct .services-container").find('li').eq($(this).data('id')).addClass('active animated fadeIn');
        });
        $('.allStoryIndex .storyItem').on('click',function(event) {
            storySeen.push($(this).attr('id'));
            $('.allStoryIndex .storyItems #'+$(this).attr('id')+' .storyPic').attr('class' , 'storyPic unActive');
            $.cookie('story',storySeen);
            $('.allStoryIndex .storyFixed').show();
            $('.allStoryIndex .storyShow').show(100);
        });
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

        $('.allSearchAdvance .buttonSearch button').click(function() {
            $(".allSearchAdvance .productLists").children(".productList").remove();
            var btnS = $(this);
            btnS.text(wait1);
            var categorySearch = $(".allSearchAdvance select[name='category']").val();
            var brandSearch = $(".allSearchAdvance select[name='brand']").val();
            var orderSearch = $(".allSearchAdvance select[name='order']").val();
            var stateSearch = $(".allSearchAdvance select[name='state']").val();
            var searchSearch = $(".allSearchAdvance input[name='search']").val();
            var existSearch = $(".allSearchAdvance input[name='exist']").is(":checked");
            var suggestSearch = $(".allSearchAdvance input[name='suggest']").is(":checked");
            var offSearch = $(".allSearchAdvance input[name='off']").is(":checked");
            var lotterySearch = $(".allSearchAdvance input[name='lottery']").is(":checked");
            var quickSearch = $(".allSearchAdvance input[name='quick']").is(":checked");
            var form = {
                "_token": "{{ csrf_token() }}",
                category: categorySearch != '0' ? categorySearch: '',
                brand: brandSearch != '0' ? brandSearch : '',
                show: orderSearch,
                state: stateSearch != '0' ? stateSearch : '',
                search: searchSearch ? searchSearch : '',
                count: existSearch ? 1 : '',
                suggest: suggestSearch ? 1: '',
                off: offSearch ? 1: '',
                lottery: lotterySearch ? 1: '',
                quick: quickSearch ? 1: '',
            };

            $.ajax({
                url: "/search-advance",
                type: "post",
                data: form,
                success: function (res) {
                    btnS.text(search_product1);
                    $('.allSearchAdvance .buttonSearch span').text(res.length + ' '+product1);
                    $.each(res , function(){
                        $('.allSearchAdvance .productLists').append(
                            $(
                                '<div class="productList">'+
                                '<a href="/product/'+this.slug+'" title="'+this.titleSeo+'" name="'+this.title+'">'+
                                '<article>'+
                                (this.suggest ? '<img src="/img/SpecialSell.svg" alt="'+suggest_product1+'" class="specialSell">': '')+
                                (this.image != '[]' ? '<figure class="pic"><img src="'+JSON.parse(this.image)[0]+'" alt="'+this.imageAlt+'"></figure>': '')+
                                (this.lotteryStatus == 1 ? '<div class="lotteryStatus"><svg class="icon"><use xlink:href="#lotteryShow"></use></svg></div>': '')+
                                '<div class="options">'+
                                '<div class="optionItem" name="quickBuy" title="'+order_method4+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#time-fast"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="addCart" title="'+add_cart+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#add-cart"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="counselingBtn" title="'+compare+'" data="'+this.title+'" id="'+this.id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#counseling"></use>'+
                                '</svg>'+
                                '</div>'+
                                '<div class="optionItem" name="compareBtn" title="'+counseling_fast+'" id="'+this.product_id+'">'+
                                '<svg class="icon">'+
                                '<use xlink:href="#chart"></use>'+
                                '</svg>'+
                                '</div>'+
                                '</div>'+
                                '<h3>'+this.title+'</h3>'+
                                '<div class="price">'+
                                (this.off ? '<s>'+makePrice(this.offPrice)+'</s>': '')+
                                '<h5>'+makePrice(this.price)+'</h5>'+
                                '</div>'+
                                '</article>'+
                                '</a>'+
                                '</div>'
                            )
                        );
                    })
                    if(res.length == 0){
                        $.toast({
                            text: no_product1, // Text that is to be shown in the toast
                            heading: unavailable1, // Optional heading to be shown on the toast
                            icon: 'warning', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#c6bc00',  // Background color of the toast loader
                        });
                        $('.allSearchAdvance .searchProducts').hide();
                    }else{
                        $('.allSearchAdvance .searchProducts').show();
                    }
                },
            });
        });
        $('.AllPopUpIndex').click(function(){
            this.remove();
            $.cookie('popUp' , 1);
        })
        $(".allLoanIndex input[name='amount']").on('change',function(){
            var amount = $(".allLoanIndex input[name='amount']").val();
            var month = $(".allLoanIndex input[name='month']").val();
            $('.allLoanIndex .loanDetail #amountLoan1').text(makePrice(amount)+' '+arz1);
            $('.allLoanIndex .loanDetail #monthLoan1').text(month+' '+month1);
            $('.allLoanIndex .loanDetail').show();
            var allProfit = month * profitLoan;
            var priceProfit = (amount * allProfit) / 100 ;
            $('.allLoanIndex .loanDetail #profitLoan').text(allProfit);
            $('.allLoanIndex .loanDetail #monthLoan2').text(makePrice(Math.round((parseInt(priceProfit) + parseInt(amount)) / month))+' '+arz1);
            $('.allLoanIndex .loanDetail #refundLoan').text(makePrice(parseInt(priceProfit) + parseInt(amount))+' '+arz1);
        })
        $(".allLoanIndex input[name='month']").on('change',function(){
            var amount = $(".allLoanIndex input[name='amount']").val();
            var month = $(".allLoanIndex input[name='month']").val();
            $('.allLoanIndex .loanDetail #amountLoan1').text(makePrice(amount)+' ' + arz1);
            $('.allLoanIndex .loanDetail #monthLoan1').text(month+' '+month1);
            $('.allLoanIndex .loanDetail').show();
            var allProfit = month * profitLoan;
            var priceProfit = (amount * allProfit) / 100 ;
            $('.allLoanIndex .loanDetail #profitLoan').text(allProfit);
            $('.allLoanIndex .loanDetail #monthLoan2').text(makePrice(Math.round((parseInt(priceProfit) + parseInt(amount)) / month))+' ' + arz1);
            $('.allLoanIndex .loanDetail #refundLoan').text(makePrice(parseInt(priceProfit) + parseInt(amount))+' ' + arz1);
        })
        $(".allLoanIndex .loanRecord button").on('click',function(){
            var amount = $(".allLoanIndex input[name='amount']").val();
            var month = $(".allLoanIndex input[name='month']").val();
            var form = {
                "_token": "{{ csrf_token() }}",
                amount: amount,
                month: month,
            };

            $.ajax({
                url: "/loan-record",
                type: "post",
                data: form,
                success: function (res) {
                    if(res == 'success'){
                        $.toast({
                            text: loan_p1, // Text that is to be shown in the toast
                            heading: ticket_submit1, // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#c6bc00',  // Background color of the toast loader
                        });
                    }
                    if(res == 'noUser'){
                        $.toast({
                            text: need_login1, // Text that is to be shown in the toast
                            heading: need_login2, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#c6bc00',  // Background color of the toast loader
                        });
                    }
                    if(res == 'loan'){
                        $.toast({
                            text: loan_wait1, // Text that is to be shown in the toast
                            heading: wait1, // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#c6bc00',  // Background color of the toast loader
                        });
                    }
                },
                error: function (xhr) {
                    $.toast({
                        text: login_attention1, // Text that is to be shown in the toast
                        heading: req_field1, // Optional heading to be shown on the toast
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
        $('.allFastSearch .firstTax .choiceCat').click(function (){
            $('.allFastSearch .firstTax').hide();
            $('.allFastSearch .secTax').show();
        })
        $('.allFastSearch .firstTax .cancelCat').click(function (){
            $('.allFastSearch .firstTax').hide();
            $('.allFastSearch .secTax').show();
            catFast = [];
            $('.allFastSearch .taxChoice .categories').children('.cat').attr('class','cat')
        })
        $('.allFastSearch .secTax .choiceCat').click(function (){
            $('.allFastSearch .secTax').hide();
            $('.allFastSearch .thirdTax').show();
        })
        $('.allFastSearch .secTax .cancelCat').click(function (){
            $('.allFastSearch .secTax').hide();
            $('.allFastSearch .thirdTax').show();
            brandFast = [];
            $('.allFastSearch .taxChoice .categories').children('.brand').attr('class','brand')
        })
        $('.allFastSearch .taxChoice .categories .cat').click(function (){
            if($(this).attr('class') == 'cat active'){
                $(this).attr('class' , 'cat');
                var datas = $(this).attr('data');
                catFast = $.grep(catFast, function(value) {
                    return value != datas;
                });
                if(catFast.length == 0){
                    $('.allFastSearch .firstTax .choiceCat').prop('disabled',true);
                }
            }else{
                $(this).attr('class' , 'cat active');
                catFast.push($(this).attr('data'));
                $('.allFastSearch .firstTax .choiceCat').prop('disabled',false);
            }
        })
        $('.allFastSearch .taxChoice .categories .brand').click(function (){
            if($(this).attr('class') == 'brand active'){
                $(this).attr('class' , 'brand');
                var datas = $(this).attr('data');
                brandFast = $.grep(brandFast, function(value) {
                    return value != datas;
                });
                if(brandFast.length == 0){
                    $('.allFastSearch .secTax .choiceCat').prop('disabled',true);
                }
            }else{
                $(this).attr('class' , 'brand active');
                brandFast.push($(this).attr('data'));
                $('.allFastSearch .secTax .choiceCat').prop('disabled',false);
            }
        })
        $('.allFastSearch .thirdTax .categories .brand').click(function (){
            $('.allFastSearch .thirdTax .categories').children('.brand').attr('class','brand');
            optionFast = $(this).attr('data');
            $(this).attr('class' , 'brand active');
            $('.allFastSearch .thirdTax .choiceCat').prop('disabled',false);
        })
        $('.allFastSearch .thirdTax .choiceCat').click(function (){
            $('.allFastSearch .thirdTax').hide();
            var form = {
                "_token": "{{ csrf_token() }}",
                "_method": "post",
                catFast: JSON.stringify(catFast),
                brandFast: JSON.stringify(brandFast),
                optionFast: optionFast,
            };

            $.ajax({
                url: "/help-search",
                type: "post",
                data: form,
                success: function (data) {
                    $('.allFastSearch .productShow').show();
                    if(data.length >= 1){
                        $(".allFastSearch .productShow .rightProduct a").attr('href' , '/product/'+data[0]['slug']);
                        $(".allFastSearch .productShow .rightProduct img").attr('src' , JSON.parse(data[0]['image'])[0]);
                        $(".allFastSearch .productShow .rightProduct h4").text(data[0]['title']);
                        $(".allFastSearch .productShow .rightProduct h5").text(makePrice(data[0]['price']));
                        $(".allFastSearch .productShow .rightProduct .buttons div[name='quickBuy']").attr('id',data[0]['id']);
                        $(".allFastSearch .productShow .rightProduct .buttons div[name='addCart']").attr('id',data[0]['id']);
                        if(data[0]['off']){
                            $(".allFastSearch .productShow .rightProduct s").text(makePrice(data[0]['offPrice']));
                        }else{
                            $(".allFastSearch .productShow .rightProduct s").hide();
                        }
                    }
                    $.each(data,function (){
                        $('.leftProduct .slider-fastSearch').append(
                            '<a class="productItem" title="'+this.title+'" href="'+'/product/'+this.slug+'">'+
                            '<figure class="productPic">'+
                            '<img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'">'+
                            '</figure>'+
                            '<h4>'+this.title+'</h4>'+
                            '<div class="price">'+
                            (this.off ? '<s>'+makePrice(this.offPrice)+'</s>' : '')+
                            '<h5>'+makePrice(this.price)+'</h5>'+
                            '</div>'+
                            '<div class="buttons options">'+
                            '<div name="quickBuy" id="'+this.id+'">'+order_method4+'</div>'+
                            '<div name="addCart" id="'+this.id+'">'+add_cart+'</div>'+
                            '</div>'+
                            '</a>'
                        )
                    })
                    if(data.length >= 1) {
                        $('.leftProduct .slider-fastSearch .productItem')[0].remove();
                        $('.slider-fastSearch').owlCarousel({
                            loop:false,
                            rtl:true,
                            touchDrag: true,
                            lazyLoad: true,
                            nav:true,
                            dots:false,
                            responsive:{
                                0:{
                                    items:1,
                                    nav:true
                                },
                                800:{
                                    items:3,
                                    nav:true,
                                    loop:false
                                }
                            }
                        })
                    }else{
                        $.toast({
                            text: no_product1, // Text that is to be shown in the toast
                            heading: fail1, // Optional heading to be shown on the toast
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
                        $('.allFastSearch .firstTax').show();
                        $('.allFastSearch .secTax').hide();
                        $('.allFastSearch .productShow').hide();
                    }
                },
                error: function (xhr) {
                    $('.allFastSearch .firstTax').hide();
                    $('.allFastSearch .secTax').show();
                    $('.allFastSearch .productShow').hide();
                    $.toast({
                        text: no_product1, // Text that is to be shown in the toast
                        heading: fail1, // Optional heading to be shown on the toast
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
        $('.slider').owlCarousel({
            loop:false,
            rtl:true,
            margin:10,
            nav:true,
            lazyLoad: true,
            touchDrag: true,
            dots:false,
            items:1
        })
        $('.slider-moment').owlCarousel({
            loop:false,
            rtl:true,
            margin:10,
            nav:true,
            lazyLoad: true,
            touchDrag: true,
            dots:false,
            items:1
        })
        $('.slider-moment2').owlCarousel({
            loop:true,
            rtl:true,
            lazyLoad: true,
            touchDrag: false,
            mouseDrag: false,
            pullDrag: false,
            items:1,
            autoplay:true,
            dots:false,
            autoplayTimeout:10000,
        })
        $('.slider-bigIndex').owlCarousel({
            loop:true,
            rtl:true,
            lazyLoad: true,
            dots:false,
            touchDrag: true,
            mouseDrag: true,
            pullDrag: true,
            nav:true,
            items:1,
            autoplay:true,
            autoplayTimeout:7000,
        })
        var owlStory = $('.slider-story').owlCarousel({
            rtl:true,
            lazyLoad: true,
            touchDrag: true,
            mouseDrag: true,
            pullDrag: true,
            nav:true,
            items:1,
            dots:false,
            URLhashListener:true,
            startPosition: 'URLHash',
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                800:{
                    items:1,
                    nav:true,
                    loop:false
                }
            }
        })
        owlStory.on('changed.owl.carousel', function(event) {
            storySeen.push(window.location.hash.substring(1));
            $('.allStoryIndex .storyItems #'+window.location.hash.substring(1)+' .storyPic').attr('class' , 'storyPic unActive');
            $.cookie('story',storySeen);
        })
        $('.slider-category-post').owlCarousel({
            loop:false,
            rtl:true,
            margin:0,
            nav:true,
            lazyLoad: true,
            touchDrag: true,
            dots:false,
            items:4,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                800:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.slider-advance0').owlCarousel({
            loop:false,
            rtl:true,
            margin:20,
            nav:true,
            lazyLoad: true,
            touchDrag: true,
            dots:false,
            responsive:{
                0:{
                    items:1,
                },
                800:{
                    items:2,
                    loop:false
                }
            }
        })
        $('.slider-advance1').owlCarousel({
            loop:false,
            rtl:true,
            margin:20,
            nav:true,
            lazyLoad: true,
            touchDrag: true,
            autoplay:true,
            dots:false,
            autoplayHoverPause:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:1,
                },
                800:{
                    items:2,
                    loop:false
                }
            }
        })
        $('.move-suggest0').owlCarousel({
            loop:false,
            rtl:true,
            margin:10,
            touchDrag: true,
            dots:false,
            nav:true,
            lazyLoad: true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.move-suggest1').owlCarousel({
            loop:false,
            rtl:true,
            margin:10,
            touchDrag: true,
            nav:true,
            lazyLoad: true,
            items:5,
            dots:false,
            autoplayHoverPause:true,
            autoplay:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.slider-bestIndex').owlCarousel({
            loop:false,
            rtl:true,
            margin:30,
            touchDrag: true,
            dots:false,
            nav:true,
            lazyLoad: true,
            items:4,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                800:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.slider-collectionIndex').owlCarousel({
            loop:false,
            rtl:true,
            margin:30,
            dots:false,
            touchDrag: true,
            nav:true,
            lazyLoad: true,
            items:4,
            responsive:{
                0:{
                    items:1,
                },
                800:{
                    items:4,
                }
            }
        })
        $('.move-productList0').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            items:6,
            dots:false,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.move-productList1').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            items:6,
            autoplayHoverPause:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.move-products0').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            items:6,
            dots:false,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.move-products1').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            items:6,
            autoplayHoverPause:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.move-backProduct0').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            dots:false,
            margin: 10,
            responsive:{
                0:{
                    items:2,
                },
                800:{
                    items:5,
                }
            }
        })
        $('.move-backProduct1').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            nav:true,
            items:6,
            autoplayHoverPause:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        $('.slider-sellers').owlCarousel({
            loop:false,
            rtl:true,
            touchDrag: true,
            lazyLoad: true,
            dots:false,
            margin:15,
            autoplay:true,
            autoplayTimeout:5000,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    margin:0,
                },
                800:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
    })
</script>
@endsection

