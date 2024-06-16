<?php $__env->startSection('title' ,  __('messages.login_user') . ' - '); ?>
<?php $__env->startSection('content'); ?>
<div class="allAuthIndex2">
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <div class="form authIndex">
                <h1><?php echo e(__('messages.login_user')); ?></h1>
                <div class="authItems level1">
                    <div class="social-container">
                        <?php if(\App\Models\Setting::where('key' , 'google')->pluck('value')->first()): ?>
                            <a href="/login-social/google" class="social" title="<?php echo e(__('messages.login_gmail')); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#google"></use>
                                    </svg>
                                </i>
                            </a>
                        <?php endif; ?>
                        <?php if(\App\Models\Setting::where('key' , 'github')->pluck('value')->first()): ?>
                            <a href="/login-social/github" class="social" title="<?php echo e(__('messages.login_git')); ?>">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#github"></use>
                                    </svg>
                                </i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <input type="text" name="authData" placeholder="<?php echo e(__('messages.number_email')); ?>">
                    <?php if(\App\Models\Setting::where('key' , 'captchaStatus')->pluck('value')->first()): ?>
                        <input type="text" name="captcha" placeholder="<?php echo e(__('messages.security_code')); ?>">
                        <div class="captchaQuick">
                            <?php if(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 0): ?>
                                <?php echo \Mews\Captcha\Facades\Captcha::img('math'); ?>

                            <?php elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 1): ?>
                                <?php echo \Mews\Captcha\Facades\Captcha::img('inverse'); ?>

                            <?php elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 2): ?>
                                <?php echo \Mews\Captcha\Facades\Captcha::img('mini2'); ?>

                            <?php elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 3): ?>
                                <?php echo \Mews\Captcha\Facades\Captcha::img('default'); ?>

                            <?php elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 4): ?>
                                <?php echo \Mews\Captcha\Facades\Captcha::img('mini'); ?>

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="buttons">
                        <button class="continue"><?php echo e(__('messages.submit')); ?></button>
                        <button class="first"><?php echo e(__('messages.login_once')); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <img class="lazyload" src="/img/404Image.png" data-src="<?php echo e(\App\Models\Setting::where('key' , 'logo')->pluck('value')->first()); ?>" alt="<?php echo e(\App\Models\Setting::where('key' , 'title')->pluck('value')->first()); ?>">
                    <h5><?php echo e(__('messages.login_welcome')); ?></h5>
                    <p><?php echo e(__('messages.login_welcome1')); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script1'); ?>
<script>
    $(document).ready(function(){
        var submit1 = <?php echo json_encode(__('messages.submit'), JSON_HEX_TAG); ?>;
        var wait1 = <?php echo json_encode(__('messages.wait'), JSON_HEX_TAG); ?>;
        var login_fill1 = <?php echo json_encode(__('messages.login_fill'), JSON_HEX_TAG); ?>;
        var login_attention1 = <?php echo json_encode(__('messages.login_attention'), JSON_HEX_TAG); ?>;
        var login_pass1 = <?php echo json_encode(__('messages.login_pass'), JSON_HEX_TAG); ?>;
        var login_sign1 = <?php echo json_encode(__('messages.login_sign'), JSON_HEX_TAG); ?>;
        var login_forget1 = <?php echo json_encode(__('messages.login_forget'), JSON_HEX_TAG); ?>;
        var done1 = <?php echo json_encode(__('messages.done'), JSON_HEX_TAG); ?>;
        var login_error1 = <?php echo json_encode(__('messages.login_error1'), JSON_HEX_TAG); ?>;
        var login_signup1 = <?php echo json_encode(__('messages.login_signup'), JSON_HEX_TAG); ?>;
        var login_pass_error1 = <?php echo json_encode(__('messages.login_pass_error'), JSON_HEX_TAG); ?>;
        var verification_code1 = <?php echo json_encode(__('messages.verification_code'), JSON_HEX_TAG); ?>;
        var login_confirm1 = <?php echo json_encode(__('messages.login_confirm'), JSON_HEX_TAG); ?>;
        var login_time1 = <?php echo json_encode(__('messages.login_time'), JSON_HEX_TAG); ?>;
        var login_timeout1 = <?php echo json_encode(__('messages.login_timeout'), JSON_HEX_TAG); ?>;
        var name1 = <?php echo json_encode(__('messages.name'), JSON_HEX_TAG); ?>;
        var user_name1 = <?php echo json_encode(__('messages.user_name'), JSON_HEX_TAG); ?>;
        var identification_code1 = <?php echo json_encode(__('messages.identification_code'), JSON_HEX_TAG); ?>;
        var verification_code2 = <?php echo json_encode(__('messages.verification_code2'), JSON_HEX_TAG); ?>;
        var login_ban1 = <?php echo json_encode(__('messages.login_ban'), JSON_HEX_TAG); ?>;
        var login_ban2 = <?php echo json_encode(__('messages.login_ban2'), JSON_HEX_TAG); ?>;
        var login_captcha1 = <?php echo json_encode(__('messages.login_captcha'), JSON_HEX_TAG); ?>;
        var login_once1 = <?php echo json_encode(__('messages.login_once'), JSON_HEX_TAG); ?>;
        var fields = <?php echo \App\Models\Field::where('status' , 0)->where('show_status' , 1)->get(); ?>;
        number = $("input[name='authData']").val('');
        var number ='';
        var code ='';
        var buttons = '';
        $('.level1 .continue').click(function(){
            $(this).text(wait1);
            buttons = $(this);
            if(number == ''){
                number = $("input[name='authData']").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
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
                                        '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                        '<div class="buttons">'+
                                        '<button class="enter">'+login_sign1+'</button>'+
                                        '<button class="forget">'+login_forget1+'</button>'+
                                        '</div>'+
                                        '</div>')
                                        .on('click' , '.enter',function(){
                                            var password = $("input[name='password']").val();
                                            var form = {
                                                "_token": "<?php echo e(csrf_token()); ?>",
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
                                                "_token": "<?php echo e(csrf_token()); ?>",
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
                                                            '<input type="text" id="authNumber" name="code" placeholder="'+verification_code1+'">'+
                                                            '<button>'+submit1+'</button>'+
                                                            '</div>')
                                                            .on('click' , 'button',function(){
                                                                code=$("input[name='code']").val();
                                                                var form = {
                                                                    "_token": "<?php echo e(csrf_token()); ?>",
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
                                                                                    '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                                                                    '<input type="password" id="authConfirmed" name="confirmed" placeholder="'+login_confirm1+'">'+
                                                                                    '<button>'+submit1+'</button>'+
                                                                                    '</div>')
                                                                                    .on('click' , 'button',function(){
                                                                                        var form = {
                                                                                            "_token": "<?php echo e(csrf_token()); ?>",
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
                                                                            text: verification_code1,
                                                                            title: verification_code2,
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
                                        '<input type="text" id="authNumber" name="code" placeholder="'+verification_code1+'">'+
                                        '<button>'+submit1+'</button>'+
                                        '</div>')
                                        .on('click' , 'button',function(){
                                            code=$("input[name='code']").val();
                                            var form = {
                                                "_token": "<?php echo e(csrf_token()); ?>",
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
                                                                '<input type="text" id="authUser" name="name" placeholder="'+user_name1+'">'+
                                                                '<input type="text" id="referral" name="referral" placeholder="'+identification_code1 +'">'+
                                                                '<input type="password" id="authPassword" name="password" placeholder="'+login_pass1+'">'+
                                                                '<input type="password" id="authConfirmed" name="confirmed" placeholder="'+login_confirm1+'">'+
                                                                '<div class="fields"></div>'+
                                                                '<button>'+submit1+'</button>'+
                                                                '</div>')
                                                                .on('click' , 'button',function(){
                                                                    $(this).text(wait1);
                                                                    buttons = $(this);
                                                                    var form = {
                                                                        "_token": "<?php echo e(csrf_token()); ?>",
                                                                        "authData": number,
                                                                        "code": code,
                                                                        "user": $("input[name='name']").val(),
                                                                        "password": $("input[name='password']").val(),
                                                                        "confirmed": $("input[name='confirmed']").val(),
                                                                        "referral": $("input[name='referral']").val(),
                                                                    };
                                                                    $(".fields .authItem").each(function(){
                                                                        form[$($(this)[0]['children'][0]).attr('name')] = $($(this)[0]['children'][0]).val()
                                                                    });
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
                                                        $.each(fields,function (){
                                                            var data1 = this;
                                                            var data2 = '';
                                                            if(this.choice){
                                                                $.each(this.choice.split(','),function (){
                                                                    data2 += '<option value="'+this+'" '+(data1.value == this ? 'selected' : '')+'>'+this+'</option>'
                                                                })
                                                            }
                                                            $('.authIndex .fields').append(
                                                                $(
                                                                    '<div class="authItem">'+
                                                                    (this.type == 0 ? '<input id="field'+this.id+'" type="text" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+' value="'+this.value+'" placeholder="'+this.name+'">' : '')+
                                                                    (this.type == 1 ? '<textarea id="field'+this.id+'" placeholder="'+this.name+'" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+'>'+this.value+'</textarea>' : '')+
                                                                    (this.type == 2 ? '<input id="field'+this.id+'" type="number" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+' value="'+this.value+'" placeholder="'+this.name+'">' : '')+
                                                                    (this.type == 3 ? '<input id="field'+this.id+'" type="email" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+' value="'+this.value+'" placeholder="'+this.name+'">' : '')+
                                                                    (this.type == 4 ? '<input id="field'+this.id+'" type="color" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+' value="'+this.value+'" placeholder="'+this.name+'">' : '')+
                                                                    (this.type == 5 ? '<input id="field'+this.id+'" type="checkbox" name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+' value="'+this.value+'" placeholder="'+this.name+'">' : '')+
                                                                    (this.type == 6 ?
                                                                        '<select name="field'+this.id+'" '+(this.disable_status == 1 ? 'disabled' : '')+'>'+data2+'</select>'
                                                                        : '')+
                                                                    '</div>'
                                                            ));
                                                        })
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
                                                        heading: verification_code1,
                                                        text: verification_code2,
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
        $('.level1 .first').click(function(){
            $(this).text(wait1);
            buttons = $(this);
            if(number == ''){
                number = $("input[name='authData']").val();
                var form = {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "authData": number,
                    'g-recaptcha-response' : $(".authItems textarea[name='g-recaptcha-response']").val()
                };

                $.ajax({
                    url: "/send-login-code",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data == 'code'){
                            $('.level1').remove();
                            $('.authIndex').append(
                                $(
                                    '<div class="authItems level2">'+
                                    '<input type="text" id="authNumber" name="code" placeholder="'+verification_code1+'">'+
                                    '<button>'+submit1+'</button>'+
                                    '</div>')
                                    .on('click' , 'button',function(){
                                        code=$("input[name='code']").val();
                                        var form = {
                                            "_token": "<?php echo e(csrf_token()); ?>",
                                            "authData": number,
                                            "code": code,
                                            "type": 1,
                                        };
                                        $.ajax({
                                            url: "/check-code-login",
                                            type: "post",
                                            data: form,
                                            success: function (data) {
                                                if(data == 'ok'){
                                                    window.location.reload();
                                                }else if(data == 'ban'){
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
                                                else{
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
                                                    heading: verification_code1,
                                                    text: verification_code2,
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
                    },
                    error: function (xhr) {
                        buttons.text(login_once1);
                        number = '';
                        if(xhr.responseJSON.errors['g-recaptcha-response']){
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsScript'); ?>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <script src="/js/jquery.toast.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home/auth/authIndex2.blade.php ENDPATH**/ ?>