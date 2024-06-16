@extends('home.master')

@section('title' , __('messages.lucky_box') . ' - ')
@section('content')
    <main class="allGiftIndex width">
        <section class="selby-gifts-section">
            @if($shareText)
                <div class="alert">{{$shareText}}</div>
            @endif
            <div class="promo-wrapper">
                <h1>{{__('messages.gift1')}}</h1>
                <h3>{{__('messages.gift2')}}</h3>
            </div>
            <div class="gift-bubbles">
                <div class="gift-bubble-wrapper">
                    <div class="gift-bubble-item">?</div>
                </div>
                <div class="gift-bubble-wrapper">
                    <div class="gift-bubble-item">?</div>
                </div>
                <div class="gift-bubble-wrapper">
                    <div class="gift-bubble-item">?</div>
                </div>
                <div class="gift-bubble-wrapper">
                    <div class="gift-bubble-item">?</div>
                </div>
                <div class="gift-bubble-wrapper">
                    <div class="gift-bubble-item">?</div>
                </div>
            </div>
            <div class="christmas-gifts">
                <div class="gift-wrapper jump">
                    <div class="gift-ribbon"></div>
                    <div class="gift-box"><span></span></div>
                </div>
                <div class="gift-wrapper jump">
                    <div class="gift-ribbon"></div>
                    <div class="gift-box"><span></span></div>
                </div>
                <div class="gift-wrapper jump">
                    <div class="gift-ribbon"></div>
                    <div class="gift-box"><span></span></div>
                </div>
                <div class="gift-wrapper jump">
                    <div class="gift-ribbon"></div>
                    <div class="gift-box"><span></span></div>
                </div>
                <div class="gift-wrapper jump">
                    <div class="gift-ribbon"></div>
                    <div class="gift-box"><span></span></div>
                </div>
            </div>
            <div class="congrats-wrapper">
                <span>{{__('messages.gift3')}}</span>
                <span class="discount"></span>
                <span>{{__('messages.gift4')}}</span>
                <span class="codeword">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#loading"></use>
                        </svg>
                    </i>
                </span>
                <span>{{__('messages.gift5')}}</span>
            </div>
        </section>
    </main>
@endsection

@section('jsScript')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var giftDiscounts = {!! json_encode($giftDiscounts, JSON_HEX_TAG) !!};
            var no_dis1 = {!! json_encode(__('messages.no_dis'), JSON_HEX_TAG) !!};
            var empty1 = {!! json_encode(__('messages.empty1'), JSON_HEX_TAG) !!};
            $('.congrats-wrapper').css('display', 'none');
            var currentGift;
            var gifts = $('.gift-wrapper');
            var prizes = giftDiscounts;
            var boxes = [];
            var bubbles = $('.gift-bubble-item');
            function getRandomInt(min, max) {
                return Math.floor(Math.random() * (max - min)) + min;
            }
            var prizesLength = prizes.length;
            for (let i = 0; i < prizesLength; i++) {
                var item = prizes.splice(getRandomInt(0, prizes.length), 1)[0];
                boxes.push(item);
            }
            $(gifts).on('click', function showResult(event) {
                $.each(gifts, function(key) {
                    if (gifts[key] == event.currentTarget) {
                        currentGift = key;
                    }
                });
                $(gifts).off('click', showResult);

                $.each(bubbles, function(key, value) {
                    $(bubbles[key]).html(boxes[key][0]);
                });
                $(bubbles[currentGift]).css({
                    'textDecoration' : 'underline',
                    'color' : 'forestGreen'
                });
                $('.gift-wrapper').removeClass('jump');
                if(boxes[currentGift][0] != 'پوچ'){
                    $('.congrats-wrapper span').eq(1).html(boxes[currentGift][0]);
                    $('.christmas-question').css('display', 'none');
                    $('.congrats-wrapper').css('display', 'block');
                    var form = {
                        "_token": "{{ csrf_token() }}",
                        "discount": boxes[currentGift][0],
                    };
                    $.ajax({
                        url: "/gift",
                        type: "post",
                        data: form,
                        success: function (data) {
                            $('.congrats-wrapper span').eq(3).html(data);
                        },
                    });
                }else{
                    $.toast({
                        text: no_dis1, // Text that is to be shown in the toast
                        heading: empty1, // Optional heading to be shown on the toast
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
                    var form = {
                        "_token": "{{ csrf_token() }}",
                    };
                    $.ajax({
                        url: "/gift",
                        type: "post",
                        data: form,
                    });
                }
            });
        })
    </script>
@endsection
