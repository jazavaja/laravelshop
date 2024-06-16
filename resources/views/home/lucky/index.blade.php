@extends('home.master')

@section('title' , __('messages.lucky_chance') . ' - ')
@section('content')
    <main class="allLuckyIndex width">
        @if($shareText)
            <div class="alert">{{$shareText}}</div>
        @endif
        <div class="promo-wrapper">
            <h1>{{__('messages.lucky_chance')}}</h1>
            <h3>{{__('messages.lucky_chance1')}}</h3>
        </div>
        <div class="deal-wheel">
            <ul class="spinner"></ul>
            <div class="ticker"></div>
            @if(!$shareText)
                <button class="btn-spin">{{__('messages.start_lucky')}}</button>
            @endif
        </div>
    </main>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var shareText = {!! json_encode($shareText, JSON_HEX_TAG) !!};
            const prizes = {!! json_encode(\App\Models\Lucky::latest()->get(), JSON_HEX_TAG) !!};
            const wheel = document.querySelector(".deal-wheel");
            const spinner = wheel.querySelector(".spinner");
            const trigger = wheel.querySelector(".btn-spin");
            const ticker = wheel.querySelector(".ticker");
            const prizeSlice = 360 / prizes.length;
            const prizeOffset = Math.floor(180 / prizes.length);
            const spinClass = "is-spinning";
            const selectedClass = "selected";
            const spinnerStyles = window.getComputedStyle(spinner);
            let tickerAnim;
            let rotation = 0;
            let currentSlice = 0;
            let prizeNodes;

            const createPrizeNodes = () => {
                prizes.forEach(({ name, color, reaction }, i) => {
                    const rotation = prizeSlice * i * -1 - prizeOffset;
                    spinner.insertAdjacentHTML(
                        "beforeend",
                        `<li class="prize" data-reaction=${reaction} style="--rotate: ${rotation}deg">
            <span class="text" style="color:${color}">${name}</span>
          </li>`
                    );
                });
            };

            const createConicGradient = () => {
                spinner.setAttribute(
                    "style",
                    `background: conic-gradient(
          from -90deg,
          ${prizes
                        .map(
                            ({ background }, i) =>
                                `${background} 0 ${(100 / prizes.length) * (prizes.length - i)}%`
                        )
                        .reverse()}
        );`
                );
            };

            const setupWheel = () => {
                createConicGradient();
                createPrizeNodes();
                prizeNodes = wheel.querySelectorAll(".prize");
            };

            const spinertia = (min, max) => {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            };

            const runTickerAnimation = () => {
                const values = spinnerStyles.transform.split("(")[1].split(")")[0].split(",");
                const a = values[0];
                const b = values[1];
                let rad = Math.atan2(b, a);

                if (rad < 0) rad += 2 * Math.PI;

                const angle = Math.round(rad * (180 / Math.PI));
                const slice = Math.floor(angle / prizeSlice);

                if (currentSlice !== slice) {
                    ticker.style.animation = "none";
                    setTimeout(() => (ticker.style.animation = null), 10);
                    currentSlice = slice;
                }
                tickerAnim = requestAnimationFrame(runTickerAnimation);
            };

            var fail_luck1 = {!! json_encode(__('messages.fail_luck'), JSON_HEX_TAG) !!};
            var empty1 = {!! json_encode(__('messages.empty'), JSON_HEX_TAG) !!};
            const selectPrize = () => {
                const selected = Math.floor(rotation / prizeSlice);
                prizeNodes[selected].classList.add(selectedClass);
                var form = {
                    "_token": "{{ csrf_token() }}",
                    "prize": prizes[selected]['id'],
                };
                $.ajax({
                    url: "/lucky",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(prizes[selected]['type'] == 2){
                            $.toast({
                                text: fail_luck1, // Text that is to be shown in the toast
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
                        }
                        else{
                            $.toast({
                                text: "", // Text that is to be shown in the toast
                                heading: data, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#38c600',
                            });
                        }
                    },
                });
                $('.btn-spin').remove();
            };
            if(!shareText){
                trigger.addEventListener("click", () => {
                    trigger.disabled = true;
                    rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));
                    prizeNodes.forEach((prize) => prize.classList.remove(selectedClass));
                    wheel.classList.add(spinClass);
                    spinner.style.setProperty("--rotate", rotation);
                    ticker.style.animation = "none";
                    runTickerAnimation();
                });
            }
            spinner.addEventListener("transitionend", () => {
                cancelAnimationFrame(tickerAnim);
                rotation %= 360;
                selectPrize();
                wheel.classList.remove(spinClass);
                spinner.style.setProperty("--rotate", rotation);
                trigger.disabled = false;
            });
            setupWheel();
        })
    </script>
@endsection
