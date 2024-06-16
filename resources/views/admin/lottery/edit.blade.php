@extends('admin.master')

@section('tab',1)
@section('content')
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>ویرایش قرعه کشی</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/lottery">همه قرعه کشی ها</a>
                    <span>/</span>
                    <a href="/admin/lottery/{{$posts->id}}/edit">ویرایش قرعه کشی</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>عنوان* :</label>
                        <input type="text" name="title" value="{{ old('title', $posts->title) }}" placeholder="عنوان را وارد کنید">
                        <div id="validation-titleSeo"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>لینک نمایش اجرا قرعه کشی :</label>
                        <input type="text" name="link" value="{{ old('link', $posts->link) }}" placeholder="لینک را وارد کنید">
                        <div id="validation-link"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>توضیحات* :</label>
                        <textarea name="body" class="editor">{{$posts->body}}</textarea>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>برندگان قرعه کشی</label>
                            <i id="addAbility">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="properties">
                            <tr>
                                <th>کد</th>
                                <th>آیدی کاربر</th>
                                <th>حذف</th>
                            </tr>
                        </table>
                    </div>
                    <button class="button" name="createPost" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            جزییات
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>وضعیت* :</label>
                                <select name="status" id="status">
                                    <option value="0">در حال انجام</option>
                                    <option value="1">انجام شده</option>
                                </select>
                                <div id="validation-status"></div>
                            </div>
                            <table>
                                <tr>
                                    <th>کد</th>
                                    <th>نام کاربر</th>
                                    <th>آیدی کاربر</th>
                                </tr>
                                @foreach($posts->lotteryCode as $item)
                                    <tr>
                                        <td>
                                            <span>{{$item->code}}</span>
                                        </td>
                                        <td>
                                            <span>{{$item->user->name}}</span>
                                        </td>
                                        <td>
                                            <span>{{$item->user->id}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var posts = {!! $posts->toJson() !!};
            $( 'textarea.editor' ).ckeditor();
            $("select[name='status']").val(posts.status);
            if(posts.winner.length >= 1) {
                $.each(posts.winner,function(){
                    $('#properties').append(
                        $('<tr><td><input type="text" name="code" value="'+this.code+'" placeholder="کد را وارد کنید"></td><td><input type="text" name="user_id" value="'+this.user_id+'" placeholder="کاربر را وارد کنید"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                            .on('click' , '#deleteAbility',function(ss){
                                ss.currentTarget.parentElement.parentElement.remove();
                            })
                    );
                })
            }
            $("button[name='createPost']").click(function(event){
                $(this).text('منتظر بمانید');
                var title = $(".allCreatePostData input[name='title']").val();
                var link = $(".allCreatePostData input[name='link']").val();
                var status = $(".allCreatePostData select[name='status']").val();
                var body = $(".allCreatePostItem textarea[name='body']").val();
                var abilities = [];
                $("#properties tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ability = {
                            code:"",
                            user_id:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'code') {
                                ability.code = this.value;
                            }
                            if (this.name == 'user_id') {
                                ability.user_id = this.value;
                            }
                        })
                        abilities.push(ability);
                    }
                });

                var form = {
                    "_token": "{{ csrf_token() }}",
                    "_method": "put",
                    title:title,
                    status:status,
                    link:link,
                    body:body,
                    abilities:JSON.stringify(abilities),
                };

                $.ajax({
                    url: "/admin/lottery/"+posts.id+"/edit",
                    type: "put",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "قرعه کشی ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
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
                        window.location.href="/admin/lottery";
                    },
                    error: function (xhr) {
                        $.toast({
                            text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
                            heading: 'دقت کنید', // Optional heading to be shown on the toast
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
                        $("button[name='createPost']").text('ثبت اطلاعات');
                    }
                });
            });
            $('#addAbility').click(function (){
                $('#properties').append(
                    $('<tr><td><input type="text" name="code" placeholder="کد را وارد کنید"></td><td><input type="text" name="user_id" placeholder="کاربر را وارد کنید"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteAbility',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
        })
    </script>
@endsection

@section('jsScript')
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
