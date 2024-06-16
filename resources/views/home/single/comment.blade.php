<div class="allComment" id="comment">
    <h3>
        <i>
            <svg class="icon">
                <use xlink:href="#comment2"></use>
            </svg>
        </i>
        {{__('messages.comments')}}
    </h3>
    <div class="btnComment">
        <h4>{{__('messages.comments1')}}</h4>
        <p>{{__('messages.comments2')}}</p>
        @if(auth()->user())
        <div class="showAdd" id="showAdd">
            <i>
                <svg class="icon">
                    <use xlink:href="#comment2"></use>
                </svg>
            </i>
            <button>{{__('messages.add_comment')}}</button>
        </div>
        @else
            <a href="/login" class="showAdd" id="showAdd">
                <i>
                    <svg class="icon">
                        <use xlink:href="#user"></use>
                    </svg>
                </i>
                <button>{{__('messages.login_user')}}</button>
            </a>
        @endif
    </div>
    <div class="addComments">
        <div class="addComment">
            <div class="right">
                <div class="rates">
                    <h4>{{__('messages.rate_comment')}}* :</h4>
                    <div class="rateItem">
                        <div id="rate"></div>
                        <input id="rateData" type="hidden" name="rate" />
                    </div>
                    <div id="validation-rate"></div>
                </div>
                <div class="sendCommentItem">
                    <label for="title">{{__('messages.title1')}}*</label>
                    <input type="text" id="title" placeholder="{{__('messages.title1')}}" name="title">
                    <div id="validation-title"></div>
                </div>
                <div class="sendCommentItem" id="goodContainer">
                    <div class="sendCommentItemTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#circle"></use>
                            </svg>
                        </i>
                        <label>{{__('messages.good_comment')}}</label>
                    </div>
                    <label for="good">
                        <input type="text" id="good" placeholder="{{__('messages.good_comment')}}" name="good">
                        <i id="goodBtn">
                            <svg class="icon">
                                <use xlink:href="#plus2"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="sendCommentItem" id="badContainer">
                    <div class="sendCommentItemTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#circle"></use>
                            </svg>
                        </i>
                        <label>{{__('messages.bad_comment')}}</label>
                    </div>
                    <label>
                        <input type="text" id="bad" placeholder="{{__('messages.bad_comment')}}" name="bad">
                        <i id="badBtn">
                            <svg class="icon">
                                <use xlink:href="#plus2"></use>
                            </svg>
                        </i>
                    </label>
                </div>
                <div class="sendCommentItem">
                    <label for="bodyText">{{__('messages.body')}}*</label>
                    <textarea name="body" id="bodyText" placeholder="{{__('messages.body')}}"></textarea>
                    <div id="validation-body"></div>
                </div>
            </div>
            <div>
                <div class="left">
                    <div class="titlePost">{{__('messages.rule_comments')}}</div>
                    <h5>{{__('messages.rule_comments1')}}</h5>
                    <ul>
                        <li>{{__('messages.rule_comments2')}}</li>
                        <li>{{__('messages.rule_comments3')}}</li>
                        <li>{{__('messages.rule_comments4')}}</li>
                    </ul>
                    <div class="allCommentButtons">
                        <button id="createComment">{{__('messages.send')}}</button>
                        <button id="cancelComment">{{__('messages.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="showComments">
        <h5>{{__('messages.show_comment_user')}} :</h5>
        @if(count($comments) >= 1)
            @foreach($comments as $item)
                <div class="getCommentItem">
                    <div class="rightComment">
                        <div class="topRight">
                            <h4>{{$item->user->name}}</h4>
                            <span>{{$item->created_at}}</span>
                        </div>
                        <div class="botRight">
                            <h5>{{__('messages.score_user')}} :</h5>
                            <div class="rates">
                                <div class="rateItem">
                                    @if($item->rate >= 1)
                                        <img src="/img/star-on.png" alt="{{__('messages.star1')}}">
                                    @elseif($item->rate == .5)
                                        <img src="/img/star-half.png" alt="{{__('messages.star2')}}">
                                    @else
                                        <img src="/img/star-off.png" alt="{{__('messages.star3')}}">
                                    @endif
                                </div>
                                <div class="rateItem">
                                    @if($item->rate >= 2)
                                        <img src="/img/star-on.png" alt="{{__('messages.star1')}}">
                                    @elseif($item->rate == 1.5)
                                        <img src="/img/star-half.png" alt="{{__('messages.star2')}}">
                                    @else
                                        <img src="/img/star-off.png" alt="{{__('messages.star3')}}">
                                    @endif
                                </div>
                                <div class="rateItem">
                                    @if($item->rate >= 3)
                                        <img src="/img/star-on.png" alt="{{__('messages.star1')}}">
                                    @elseif($item->rate == 2.5)
                                        <img src="/img/star-half.png" alt="{{__('messages.star2')}}">
                                    @else
                                        <img src="/img/star-off.png" alt="{{__('messages.star3')}}">
                                    @endif
                                </div>
                                <div class="rateItem">
                                    @if($item->rate >= 4)
                                        <img src="/img/star-on.png" alt="{{__('messages.star1')}}">
                                    @elseif($item->rate == 3.5)
                                        <img src="/img/star-half.png" alt="{{__('messages.star2')}}">
                                    @else
                                        <img src="/img/star-off.png" alt="{{__('messages.star3')}}">
                                    @endif
                                </div>
                                <div class="rateItem">
                                    @if($item->rate >= 5)
                                        <img src="/img/star-on.png" alt="{{__('messages.star1')}}">
                                    @elseif($item->rate == 4.5)
                                        <img src="/img/star-half.png" alt="{{__('messages.star2')}}">
                                    @else
                                        <img src="/img/star-off.png" alt="{{__('messages.star3')}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leftComment">
                        <div class="allCommentTitle">
                            {{$item->title}}
                        </div>
                        <div class="allCommentBody">
                            <p>{{$item->body}}</p>
                        </div>
                        <div class="getCommentDatas">
                            @if($item->good)
                                <div class="getCommentData">
                                    <h5>{{__('messages.good_comment')}}</h5>
                                    <div class="items">
                                        @foreach(json_decode($item->good) as $value)
                                            <div class="item">
                                                <i>
                                                    <svg class="icon">
                                                        <use xlink:href="#circle"></use>
                                                    </svg>
                                                </i>
                                                {{$value}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if($item->bad)
                                <div class="getCommentData bad">
                                    <h5>{{__('messages.bad_comment')}}</h5>
                                    <div class="items">
                                        @foreach(json_decode($item->bad) as $value)
                                            <div class="item">
                                                <i>
                                                    <svg class="icon">
                                                        <use xlink:href="#circle"></use>
                                                    </svg>
                                                </i>
                                                {{$value}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="emptyComment">{{__('messages.no_comment')}}</div>
        @endif
    </div>
</div>

<script>
    $(document).ready(function(){
        var post = {!! $post->toJson() !!};
        $('.addComments').hide();
        var rate = '';
        $('#rate').raty({
            half: true,
            target: '#rateData',
            click: function(score, evt) {
                rate=score;
            }
        });
        $('#showAdd').click(function(){
            $('.addComments').toggle();
            $('.btnComment').toggle();
            $('.showComments').toggle();
        })
        $('#cancelComment').click(function(){
            $('.addComments').toggle();
            $('.btnComment').toggle();
            $('.showComments').toggle();
        })
        $('#goodBtn').click(function(){
            if($("#good").val() != ''){
                $('#goodContainer').append(
                    $('<span>'+$("#good").val()+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                        .on('click' , 'i',function(ss){
                            ss.currentTarget.parentElement.remove();
                        })
                );
                $('#good').val('');
            }
        })
        var keycode = 0;
        $('#good').keypress(function(event){
            if($("#good").val() != ''){
                keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13') {
                    $('#goodContainer').append(
                        $('<span>' + $("#good").val() + '<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click', 'i', function (ss) {
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                    $('#good').val('');
                }
            }
        })
        $('#bad').keypress(function(event){
            if($("#bad").val() != ''){
                keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13') {
                    $('#badContainer').append(
                        $('<span>' + $("#bad").val() + '<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                            .on('click', 'i', function (ss) {
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                    $('#bad').val('');
                }
            }
        })
        $('#badBtn').click(function(){
            if($("#bad").val() != ''){
                $('#badContainer').append(
                    $('<span>'+$("#bad").val()+'<i id="#deleteDatas"><svg class="icon"><use xlink:href="#cancel"></use></svg></i></span>')
                        .on('click' , 'i',function(ss){
                            ss.currentTarget.parentElement.remove();
                        })
                );
                $('#bad').val('');
            }
        })
        var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
        var send1 = {!! json_encode(__('messages.send'), JSON_HEX_TAG) !!};
        var need_login2 = {!! json_encode(__('messages.need_login2'), JSON_HEX_TAG) !!};
        var log_first1 = {!! json_encode(__('messages.log_first'), JSON_HEX_TAG) !!};
        var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
        var sub_comment = {!! json_encode(__('messages.sub_comment'), JSON_HEX_TAG) !!};
        var login_attention = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
        var star_field = {!! json_encode(__('messages.star_field'), JSON_HEX_TAG) !!};
        $('.allCommentButtons #createComment').click(function (){
            if($('.allCommentButtons #createComment').text() != wait1){
                $('.allCommentButtons #createComment').text(wait1);
                var bads = [];
                var goods = [];
                var title = $("input[name='title']").val();
                var body = $("textarea[name='body']").val();
                $.each($('#badContainer span') , function (){
                    bads.push(this.textContent);
                })
                $.each($('#goodContainer span') , function (){
                    goods.push(this.textContent);
                })

                var form = {
                    "_token": "{{ csrf_token() }}",
                    "_method": "post",
                    title:title,
                    product:post.id,
                    body:body,
                    rate:rate,
                    good:JSON.stringify(goods),
                    bad:JSON.stringify(bads),
                };

                $.ajax({
                    url: "/send-comment",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if($('.allCommentButtons #createComment').text(send1));
                        if(data == 'noUser'){
                            $.toast({
                                text: log_first1, // Text that is to be shown in the toast
                                heading: need_login2, // Optional heading to be shown on the toast
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
                        }else{
                            $.toast({
                                text: sub_comment, // Text that is to be shown in the toast
                                heading: success1, // Optional heading to be shown on the toast
                                icon: 'success', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                            });
                            $('.addComments').toggle();
                            $('.btnComment').toggle();
                            $('.showComments').toggle();
                        }
                    },
                    error: function (xhr) {
                        $('.allCommentButtons #createComment').text(send1);
                        $.toast({
                            text: star_field, // Text that is to be shown in the toast
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
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">'+value+'</div');
                        });
                    }
                });
            }
        })
    })
</script>
