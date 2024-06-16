@extends('home.master')

@section('title' , __('messages.login_user') . ' - ')
@section('content')
<div class="allAuthIndex">
    <div class="authIndex">
        <div class="headerAuth">
            <h1>{{__('messages.login_user')}}</h1>
        </div>
        <div class="authItems level1">
            <div class="authItem">
                <label for="authNumber">{{__('messages.number_email')}} :</label>
                <input type="text" id="authNumber" name="authData" placeholder="{{__('messages.number_email')}}">
            </div>
            @if(\App\Models\Setting::where('key' , 'captchaStatus')->pluck('value')->first())
                <div class="authItem">
                    <label for="authCaptcha">{{__('messages.security_code')}} :</label>
                    <input type="text" id="authCaptcha" name="captcha" placeholder="{{__('messages.security_code')}}">
                </div>
                <div class="captchaQuick">
                    @if(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 0)
                        {!! \Mews\Captcha\Facades\Captcha::img('math') !!}
                    @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 1)
                        {!! \Mews\Captcha\Facades\Captcha::img('inverse') !!}
                    @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 2)
                        {!! \Mews\Captcha\Facades\Captcha::img('mini2') !!}
                    @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 3)
                        {!! \Mews\Captcha\Facades\Captcha::img('default') !!}
                    @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 4)
                        {!! \Mews\Captcha\Facades\Captcha::img('mini') !!}
                    @endif
                </div>
            @endif
            <button>{{__('messages.submit')}}</button>
        </div>
    </div>
</div>
@endsection

@section('script1')
<script>
    $(document).ready(function(){
        var submit1 = {!! json_encode(__('messages.submit'), JSON_HEX_TAG) !!};
        var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
        var login_fill1 = {!! json_encode(__('messages.login_fill'), JSON_HEX_TAG) !!};
        var login_attention1 = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
        var login_pass1 = {!! json_encode(__('messages.login_pass'), JSON_HEX_TAG) !!};
        var login_sign1 = {!! json_encode(__('messages.login_sign'), JSON_HEX_TAG) !!};
        var login_forget1 = {!! json_encode(__('messages.login_forget'), JSON_HEX_TAG) !!};
        var done1 = {!! json_encode(__('messages.done'), JSON_HEX_TAG) !!};
        var login_error1 = {!! json_encode(__('messages.login_error1'), JSON_HEX_TAG) !!};
        var login_signup1 = {!! json_encode(__('messages.login_signup'), JSON_HEX_TAG) !!};
        var login_pass_error1 = {!! json_encode(__('messages.login_pass_error'), JSON_HEX_TAG) !!};
        var verification_code1 = {!! json_encode(__('messages.verification_code'), JSON_HEX_TAG) !!};
        var login_confirm1 = {!! json_encode(__('messages.login_confirm'), JSON_HEX_TAG) !!};
        var login_time1 = {!! json_encode(__('messages.login_time'), JSON_HEX_TAG) !!};
        var login_timeout1 = {!! json_encode(__('messages.login_timeout'), JSON_HEX_TAG) !!};
        var name1 = {!! json_encode(__('messages.name'), JSON_HEX_TAG) !!};
        var user_name1 = {!! json_encode(__('messages.user_name'), JSON_HEX_TAG) !!};
        var identification_code1 = {!! json_encode(__('messages.identification_code'), JSON_HEX_TAG) !!};
        var verification_code2 = {!! json_encode(__('messages.verification_code2'), JSON_HEX_TAG) !!};
        var login_ban1 = {!! json_encode(__('messages.login_ban'), JSON_HEX_TAG) !!};
        var login_ban2 = {!! json_encode(__('messages.login_ban2'), JSON_HEX_TAG) !!};
        var login_captcha1 = {!! json_encode(__('messages.login_captcha'), JSON_HEX_TAG) !!};
        number = $("input[name='authData']").val('');
        var number ='';
        var code ='';
        var buttons = '';
        $('.level1 button').click(function(){
            $(this).text(wait1);
            buttons = $(this);
            if(number == ''){
                number = $("input[name='authData']").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    "authData": number,
                    'captcha' : $(".authItems input[name='captcha']").val()
                };

                $.ajax({
                    url: "/check-auth",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data[1] == 0){
                            number = '';
                            buttons.text(submit1);
                            $.toast({
                                text: login_fill1,
                                heading: login_attention1,
                                icon: 'error',
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3000,
                                stack: 5,
                                position: 'bottom-left',
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                        else{
                            if(data == 'exist'){
                                $('.level1').remove();
                                $('.authIndex').append(
                                    $('<div class="authItems level2">'+
                                        '<div class="authItem">'+
                                        '<label for="authPassword">'+login_pass1+'</label>'+
                                        '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                        '</div>'+
                                        '<div class="buttons">'+
                                        '<button class="enter">'+login_sign1+'</button>'+
                                        '<button class="forget">'+login_forget1+'</button>'+
                                        '</div>'+
                                        '</div>')
                                        .on('click' , '.enter',function(ss){
                                            var password = $("input[name='password']").val();
                                            var form = {
                                                "_token": "{{ csrf_token() }}",
                                                "authData": number,
                                                "password": password,
                                            };
                                            $.ajax({
                                                url: "/enter-auth",
                                                type: "post",
                                                data: form,
                                                success: function (data) {
                                                    if(data == 'success'){
                                                        $.toast({
                                                            heading: done1,
                                                            text: login_signup1,
                                                            icon: 'success',
                                                            showHideTransition: 'fade',
                                                            allowToastClose: true,
                                                            hideAfter: 3000,
                                                            stack: 5,
                                                            position: 'bottom-left',
                                                            textAlign: 'left',
                                                            loader: true,
                                                            loaderBg: '#9EC600',
                                                        });
                                                        window.location.href="/profile";
                                                    }
                                                    if(data == 'format'){
                                                        $.toast({
                                                            heading: login_error1,
                                                            text: login_fill1,
                                                            icon: 'error',
                                                            showHideTransition: 'fade',
                                                            allowToastClose: true,
                                                            hideAfter: 3000,
                                                            stack: 5,
                                                            position: 'bottom-left',
                                                            textAlign: 'left',
                                                            loader: true,
                                                            loaderBg: '#c60000',
                                                        });
                                                    }
                                                    if(data == 'no'){
                                                        $.toast({
                                                            heading: login_error1,
                                                            text: login_pass_error1,
                                                            icon: 'error',
                                                            showHideTransition: 'fade',
                                                            allowToastClose: true,
                                                            hideAfter: 3000,
                                                            stack: 5,
                                                            position: 'bottom-left',
                                                            textAlign: 'left',
                                                            loader: true,
                                                            loaderBg: '#c60000',
                                                        });
                                                    }
                                                },
                                            })
                                        })
                                        .on('click' , '.forget',function(ss){
                                            var form = {
                                                "_token": "{{ csrf_token() }}",
                                                "authData": number,
                                            };
                                            $.ajax({
                                                url: "/change-password",
                                                type: "post",
                                                data: form,
                                                success: function (data) {
                                                    $('.authIndex .level2').remove();
                                                    $('.authIndex').append(
                                                        $(
                                                            '<div class="authItems level2">'+
                                                            '<div class="authItem">'+
                                                            '<label for="authNumber">'+verification_code1+'</label>'+
                                                            '<input type="text" id="authNumber" name="code" placeholder="'+verification_code1+'">'+
                                                            '</div>'+
                                                            '<button>'+submit1+'</button>'+
                                                            '</div>')
                                                            .on('click' , 'button',function(){
                                                                code=$("input[name='code']").val();
                                                                var form = {
                                                                    "_token": "{{ csrf_token() }}",
                                                                    "authData": number,
                                                                    "code": code,
                                                                };
                                                                $.ajax({
                                                                    url: "/check-pass-code",
                                                                    type: "post",
                                                                    data: form,
                                                                    success: function (data) {
                                                                        if(data == 'ok'){
                                                                            $('.level2').remove();
                                                                            $('.authIndex').append(
                                                                                $(
                                                                                    '<div class="authItems level3">'+
                                                                                    '<div class="authItem">'+
                                                                                    '<label for="authPassword">'+login_pass1+'</label>'+
                                                                                    '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="authItem">'+
                                                                                    '<label for="authConfirmed">'+login_confirm1+'</label>'+
                                                                                    '<input type="password" id="authConfirmed" name="confirmed" placeholder="'+login_confirm1+'">'+
                                                                                    '</div>'+
                                                                                    '<button>'+submit1+'</button>'+
                                                                                    '</div>')
                                                                                    .on('click' , 'button',function(){
                                                                                        var form = {
                                                                                            "_token": "{{ csrf_token() }}",
                                                                                            "authData": number,
                                                                                            "code": code,
                                                                                            "password": $("input[name='password']").val(),
                                                                                            "confirmed": $("input[name='confirmed']").val(),
                                                                                        };
                                                                                        $.ajax({
                                                                                            url: "/change-user-password",
                                                                                            type: "post",
                                                                                            data: form,
                                                                                            success: function (data) {
                                                                                                if(data == 'time'){
                                                                                                    $.toast({
                                                                                                        heading: login_time1,
                                                                                                        text: login_timeout1,
                                                                                                        icon: 'error',
                                                                                                        showHideTransition: 'fade',
                                                                                                        allowToastClose: true,
                                                                                                        hideAfter: 3000,
                                                                                                        stack: 5,
                                                                                                        position: 'bottom-left',
                                                                                                        textAlign: 'left',
                                                                                                        loader: true,
                                                                                                        loaderBg: '#c60000',
                                                                                                    });
                                                                                                }
                                                                                                if(data == 'format'){
                                                                                                    $.toast({
                                                                                                        heading: login_error1,
                                                                                                        text: login_fill1,
                                                                                                        icon: 'error',
                                                                                                        showHideTransition: 'fade',
                                                                                                        allowToastClose: true,
                                                                                                        hideAfter: 3000,
                                                                                                        stack: 5,
                                                                                                        position: 'bottom-left',
                                                                                                        textAlign: 'left',
                                                                                                        loader: true,
                                                                                                        loaderBg: '#c60000',
                                                                                                    });
                                                                                                }
                                                                                                if(data == 'success'){
                                                                                                    $.toast({
                                                                                                        heading: done1,
                                                                                                        text: login_signup1,
                                                                                                        icon: 'success',
                                                                                                        showHideTransition: 'fade',
                                                                                                        allowToastClose: true,
                                                                                                        hideAfter: 3000,
                                                                                                        stack: 5,
                                                                                                        position: 'bottom-left',
                                                                                                        textAlign: 'left',
                                                                                                        loader: true,
                                                                                                        loaderBg: '#9EC600',
                                                                                                    });
                                                                                                    window.location.href="/profile";
                                                                                                }
                                                                                            },
                                                                                            error: function (errors) {
                                                                                                if(errors.responseJSON.errors['password']){
                                                                                                    $.toast({
                                                                                                        heading: login_pass1,
                                                                                                        text: errors.responseJSON.errors['password'],
                                                                                                        icon: 'error',
                                                                                                        showHideTransition: 'fade',
                                                                                                        allowToastClose: true,
                                                                                                        hideAfter: 3000,
                                                                                                        stack: 5,
                                                                                                        position: 'bottom-left',
                                                                                                        textAlign: 'left',
                                                                                                        loader: true,
                                                                                                        loaderBg: '#c60000',
                                                                                                    });
                                                                                                }
                                                                                                if(errors.responseJSON.errors['name']){
                                                                                                    $.toast({
                                                                                                        text: name1,
                                                                                                        heading: errors.responseJSON.errors['name'],
                                                                                                        icon: 'error',
                                                                                                        showHideTransition: 'fade',
                                                                                                        allowToastClose: true,
                                                                                                        hideAfter: 3000,
                                                                                                        stack: 5,
                                                                                                        position: 'bottom-left',
                                                                                                        textAlign: 'left',
                                                                                                        loader: true,
                                                                                                        loaderBg: '#c60000',
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                    })
                                                                            );
                                                                        }else{
                                                                            $.toast({
                                                                                text: verification_code1,
                                                                                title: verification_code2,
                                                                                icon: 'error',
                                                                                showHideTransition: 'fade',
                                                                                allowToastClose: true,
                                                                                hideAfter: 3000,
                                                                                stack: 5,
                                                                                position: 'bottom-left',
                                                                                textAlign: 'left',
                                                                                loader: true,
                                                                                loaderBg: '#c60000',
                                                                            });
                                                                        }
                                                                    },
                                                                    error: function (xhr) {
                                                                        $.toast({
                                                                            text: verification_code2, // Text that is to be shown in the toast
                                                                            heading: login_attention1, // Optional heading to be shown on the toast
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
                                                                })
                                                            })
                                                    );
                                                },
                                            })
                                        })
                                );
                            }
                            if(data == 'code'){
                                $('.level1').remove();
                                $('.authIndex').append(
                                    $(
                                        '<div class="authItems level2">'+
                                        '<div class="authItem">'+
                                        '<label for="authNumber">'+verification_code1+'</label>'+
                                        '<input type="text" id="authNumber" name="code" placeholder="'+verification_code1+'">'+
                                        '</div>'+
                                        '<button>'+submit1+'</button>'+
                                        '</div>')
                                        .on('click' , 'button',function(){
                                            code=$("input[name='code']").val();
                                            var form = {
                                                "_token": "{{ csrf_token() }}",
                                                "authData": number,
                                                "code": code,
                                            };
                                            $.ajax({
                                                url: "/check-code",
                                                type: "post",
                                                data: form,
                                                success: function (data) {
                                                    if(data == 'ok'){
                                                        $('.level2').remove();
                                                        $('.authIndex').append(
                                                            $(
                                                                '<div class="authItems level3">'+
                                                                '<div class="authItem">'+
                                                                '<label for="authUser">'+user_name1+'</label>'+
                                                                '<input type="text" id="authUser" name="name" placeholder="'+user_name1+'">'+
                                                                '</div>'+
                                                                '<div class="authItem">'+
                                                                '<label for="referral">'+identification_code1+'</label>'+
                                                                '<input type="text" id="referral" name="referral" placeholder="'+identification_code1+'">'+
                                                                '</div>'+
                                                                '<div class="authItem">'+
                                                                '<label for="authPassword">'+login_pass1+'</label>'+
                                                                '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                                                '</div>'+
                                                                '<div class="authItem">'+
                                                                '<label for="authConfirmed">'+login_confirm1+'</label>'+
                                                                '<input type="password" id="authConfirmed" name="confirmed" placeholder="'+login_confirm1+'">'+
                                                                '</div>'+
                                                                '<button>'+submit1+'</button>'+
                                                                '</div>')
                                                                .on('click' , 'button',function(){
                                                                    $(this).text(wait1);
                                                                    buttons = $(this);
                                                                    var form = {
                                                                        "_token": "{{ csrf_token() }}",
                                                                        "authData": number,
                                                                        "code": code,
                                                                        "user": $("input[name='name']").val(),
                                                                        "password": $("input[name='password']").val(),
                                                                        "confirmed": $("input[name='confirmed']").val(),
                                                                        "referral": $("input[name='referral']").val(),
                                                                    };
                                                                    $.ajax({
                                                                        url: "/add-user",
                                                                        type: "post",
                                                                        data: form,
                                                                        success: function (data) {
                                                                            if(data == 'time'){
                                                                                $.toast({
                                                                                    heading: login_time1,
                                                                                    text: login_timeout1,
                                                                                    icon: 'error',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#c60000',
                                                                                });
                                                                            }
                                                                            if(data == 'format'){
                                                                                $.toast({
                                                                                    heading: login_error1,
                                                                                    text: login_fill1,
                                                                                    icon: 'error',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#c60000',
                                                                                });
                                                                            }
                                                                            if(data == 'success'){
                                                                                $.toast({
                                                                                    heading: done1,
                                                                                    text: login_signup1,
                                                                                    icon: 'success',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#9EC600',
                                                                                });
                                                                                window.location.href="/profile";
                                                                            }
                                                                        },
                                                                        error: function (errors) {
                                                                            buttons.text(submit1);
                                                                            if(errors.responseJSON.errors['password']){
                                                                                $.toast({
                                                                                    heading: login_pass1,
                                                                                    text: errors.responseJSON.errors['password'],
                                                                                    icon: 'error',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#c60000',
                                                                                });
                                                                            }
                                                                            if(errors.responseJSON.errors['user']){
                                                                                $.toast({
                                                                                    heading: name1,
                                                                                    text: errors.responseJSON.errors['user'],
                                                                                    icon: 'error',
                                                                                    showHideTransition: 'fade',
                                                                                    allowToastClose: true,
                                                                                    hideAfter: 3000,
                                                                                    stack: 5,
                                                                                    position: 'bottom-left',
                                                                                    textAlign: 'left',
                                                                                    loader: true,
                                                                                    loaderBg: '#c60000',
                                                                                });
                                                                            }
                                                                        }
                                                                    })
                                                                })
                                                        );
                                                    }else{
                                                        $.toast({
                                                            heading: verification_code1,
                                                            text: verification_code2,
                                                            icon: 'error',
                                                            showHideTransition: 'fade',
                                                            allowToastClose: true,
                                                            hideAfter: 3000,
                                                            stack: 5,
                                                            position: 'bottom-left',
                                                            textAlign: 'left',
                                                            loader: true,
                                                            loaderBg: '#c60000',
                                                        });
                                                    }
                                                },
                                                error: function (xhr) {
                                                    $.toast({
                                                        text: verification_code2, // Text that is to be shown in the toast
                                                        heading: login_attention1, // Optional heading to be shown on the toast
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
                                            })
                                        })
                                );
                            }
                            if(data == 'ban'){
                                $.toast({
                                    text: login_ban1,
                                    heading: login_ban2,
                                    icon: 'error',
                                    showHideTransition: 'fade',
                                    allowToastClose: true,
                                    hideAfter: 3000,
                                    stack: 5,
                                    position: 'bottom-left',
                                    textAlign: 'left',
                                    loader: true,
                                    loaderBg: '#c60000',
                                });
                            }
                        }
                    },
                    error: function (xhr) {
                        buttons.text(submit1);
                        number = '';
                        if(xhr.responseJSON.errors['captcha']){
                            $.toast({
                                text: login_captcha1,
                                heading: login_attention1,
                                icon: 'error',
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3000,
                                stack: 5,
                                position: 'bottom-left',
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                        else{
                            $.toast({
                                text: login_fill1,
                                heading: login_attention1,
                                icon: 'error',
                                showHideTransition: 'fade',
                                allowToastClose: true,
                                hideAfter: 3000,
                                stack: 5,
                                position: 'bottom-left',
                                textAlign: 'left',
                                loader: true,
                                loaderBg: '#c60000',
                            });
                        }
                    }
                });
            }
        })
    });
</script>
@endsection

@section('jsScript')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
@endsection
