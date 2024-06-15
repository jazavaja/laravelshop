<div class="allCounseling">
    <form class="counselingFast">
        <div class="title">
            <h3>{{__('messages.counseling_fast')}}</h3>
            <i class="closeCounseling">
                <svg class="icon">
                    <use xlink:href="#cancel"></use>
                </svg>
            </i>
        </div>
        <div class="counselingTitleProduct"></div>
        <div class="counselingFastData">
            <label for="counselingNumber">{{__('messages.number1')}} :</label>
            @if (auth()->user())
                <input name="counselingNumber" id="counselingNumber" type="text" placeholder="{{__('messages.buyer_number')}}" value="{{auth()->user()->number}}">
            @else
                <input name="counselingNumber" id="counselingNumber" type="text" placeholder="{{__('messages.buyer_number')}}">
            @endif
        </div>
        <div class="counselingFastData">
            <label for="counselingDescription">{{__('messages.ticket2')}} :</label>
            <textarea name="counselingDescription" id="counselingDescription" placeholder="{{__('messages.ticket2')}}"></textarea>
        </div>
        @if(\App\Models\Setting::where('key' , 'captchaStatus')->pluck('value')->first())
            <div class="counselingFastData">
                <label for="captcha">{{__('messages.security_code')}}</label>
                <input type="text" id="captcha" name="captcha" placeholder="{{__('messages.security_code')}}">
            </div>
            <div class="captchaQuick">
                {!! $captcha !!}
            </div>
        @endif
        <button>{{__('messages.send_ticket1')}}</button>
    </form>
</div>

<script>
    $(document).ready(function(){
        var product = '';
        var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
        var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
        var send_ticket1 = {!! json_encode(__('messages.send_ticket1'), JSON_HEX_TAG) !!};
        var fast_answer = {!! json_encode(__('messages.fast_answer'), JSON_HEX_TAG) !!};
        var login_attention = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
        var fill_data = {!! json_encode(__('messages.fill_data'), JSON_HEX_TAG) !!};
        $(document).on('click',"div[name='counselingBtn']",function(event){
            event.preventDefault();
            $('.allCounseling').show();
            $('.counselingFast').show(100);
            $('.allCounseling .counselingTitleProduct').text($(this).attr('data'));
            product = $(this).attr('id');
        })
        $('.allCounseling .closeCounseling').click(function(){
            $(".counselingFast input[name='counselingNumber']").val('');
            $(".counselingFast input[name='counselingDescription']").val('');
            $('.allCounseling').hide();
            $('.counselingFast').hide();
        })
        $('.counselingFast button').click(function(event){
            event.preventDefault();
            var buttonCounseling = $(this);
            buttonCounseling.text(wait1)
            var form = {
                "_token": "{{ csrf_token() }}",
                "number": $(".counselingFast input[name='counselingNumber']").val(),
                "body": $(".counselingFast textarea[name='counselingDescription']").val(),
                "product": product,
                'captcha' : $(".counselingFast input[name='captcha']").val()
            };
            $.ajax({
                url: "/send-counseling",
                type: "post",
                data: form,
                success: function (data) {
                    $.toast({
                        text: fast_answer, // Text that is to be shown in the toast
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
                    $(".counselingFast input[name='counselingNumber']").val('');
                    $(".counselingFast input[name='counselingDescription']").val('');
                    $('.allCounseling').hide();
                    $('.counselingFast').hide();
                    buttonCounseling.text(send_ticket1);
                },
                error: function (xhr) {
                    buttonCounseling.text(send_ticket1);
                    $.toast({
                        text: fill_data, // Text that is to be shown in the toast
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
    })
</script>
