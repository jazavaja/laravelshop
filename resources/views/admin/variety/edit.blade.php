@extends('admin.master')

@section('tab',21)
@section('content')
    <div class="allSellerIndex">
        <div class="allPostPanel">
            <div class="allAddVariety">
                <div class="allAddVarietyTop">
                    <div class="allAddVarietyPic">
                        <img src="{{json_decode($posts->image)[0]}}" alt="{{$posts->title}}">
                    </div>
                    <div class="allAddVarietySubject">
                        <h1>{{ $posts->title }}</h1>
                        <ul>
                            <li>
                                <span>دسته بندی :</span>
                                @if($posts->category)
                                    <span>{{$posts->category[0]->name}}</span>
                                @else
                                    <span>بدون دسته بندی</span>
                                @endif
                            </li>
                            <li>
                                <span>تنوع رنگ :</span>
                                <span>{{count(json_decode($posts->colors))}}</span>
                            </li>
                            <li>
                                <span>تنوع سایز :</span>
                                <span>{{count(json_decode($posts->size))}}</span>
                            </li>
                            <li>
                                <span>مبلغ :</span>
                                <span>{{number_format($posts->price)}} تومان</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="allCreateVariety">
                    <div class="allVarietiesTitle">
                        <span>ویرایش تنوع</span>
                    </div>
                    <div class="allCreateVarietyItems">
                        <div class="allCreateVarietyItem">
                            <h3>گارانتی</h3>
                            <select class="guarantee-multiple" name="guarantees" multiple="multiple">
                                @foreach ($guarantees as $guarantee)
                                    <option value="{{ $guarantee->id }}">{{ $guarantee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="allCreateVarietyItem">
                            <h3>تعداد*</h3>
                            <input type="text" name="count" value="{{$posts->count}}" placeholder="تعداد را وارد کنید ...">
                        </div>
                        <div class="allCreateVarietyItem">
                            <h3>وضعیت*</h3>
                            <select name="status">
                                <option value="0">پیشنویس</option>
                                <option value="1">منتشر شده</option>
                            </select>
                        </div>
                    </div>
                    <div class="allCreateVarietyItems">
                        <div class="allCreateVarietyItem">
                            <h3>قیمت*</h3>
                            <input type="text" name="price" value="{{$posts->offPrice}}" placeholder="قیمت را وارد کنید ...">
                        </div>
                        <div class="allCreateVarietyItem">
                            <h3>تخفیف</h3>
                            <input type="text" name="off" value="{{$posts->off}}" placeholder="تخفیف را وارد کنید ...">
                        </div>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>رنگ</label>
                            <i id="addColor">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="colors">
                            <tr>
                                <th>نام رنگ</th>
                                <th>رنگ</th>
                                <th>تعداد</th>
                                <th>افزودن قیمت (تومان)</th>
                                <th>حذف</th>
                            </tr>
                        </table>
                        <div class="abilityPostToolTip">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#lamp"></use>
                                </svg>
                            </i>
                            <p>برای اضافه نشدن قیمت به قیمت اصلی عدد صفر را وارد کنید</p>
                        </div>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>سایز</label>
                            <i id="addSize">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="sizes">
                            <tr>
                                <th>سایز</th>
                                <th>تعداد</th>
                                <th>افزودن قیمت (تومان)</th>
                                <th>حذف</th>
                            </tr>
                        </table>
                        <div class="abilityPostToolTip">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#lamp"></use>
                                </svg>
                            </i>
                            <p>برای اضافه نشدن قیمت به قیمت اصلی عدد صفر را وارد کنید</p>
                        </div>
                    </div>
                    <div class="buttons">
                        <button>ویرایش تنوع</button>
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
            var guarantee = [];
            $(".allCreateVarietyItem select[name='status']").val(posts.status);
            if(posts.guarantee){
                $.each(posts.guarantee,function(){
                    guarantee.push(this.id);
                });
                $('.guarantee-multiple').val(guarantee);
            }
            $('.guarantee-multiple').select2({
                placeholder: 'گارانتی را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('#addColor').click(function (){
                $('#colors').append(
                    $('<tr><td><input type="text" name="name" placeholder="نام را وارد کنید"></td><td><input name="color" type="color" placeholder="کد را وارد کنید"></td><td><input name="count" placeholder="تعداد را وارد کنید"></td><td><input name="price" placeholder="قیمت را وارد کنید"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                        .on('click' , '#deleteColor',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addSize').click(function (){
                $('#sizes').append(
                    $('<tr><td><input type="text" name="name" placeholder="سایز را وارد کنید"></td><td><input type="text" name="count" placeholder="تعداد را وارد کنید"></td><td><input placeholder="قیمت را وارد کنید" name="price"></td><td><i id="deleteSize"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                        .on('click' , '#deleteSize',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            if(posts.colors) {
                if(JSON.parse(posts.colors)) {
                    $.each(JSON.parse(posts.colors),function(){
                        $('#colors').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="نام را وارد کنید"></td><td><input name="color" type="color" value="'+this.color+'" placeholder="کد را وارد کنید"></td><td><input name="count" value="'+this.count+'" placeholder="تعداد را وارد کنید"></td><td><input name="price" value="'+this.price+'" placeholder="قیمت را وارد کنید"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteColor',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            if(posts.size) {
                if(JSON.parse(posts.size)) {
                    $.each(JSON.parse(posts.size),function(){
                        $('#sizes').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="سایز را وارد کنید"></td><td><input type="text" name="count" value="'+this.count+'" placeholder="تعداد را وارد کنید"></td><td><input placeholder="قیمت را وارد کنید" value="'+this.price+'" name="price"></td><td><i id="deleteSize"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteSize',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            $(".buttons button").click(function(event){
                $(this).text('منتظر بمانید');
                var off = $(".allCreateVarietyItem input[name='off']").val();
                var price = $(".allCreateVarietyItem input[name='price']").val();
                var count = $(".allCreateVarietyItem input[name='count']").val();
                var status = $(".allCreateVarietyItem select[name='status']").val();
                var guarantees = [];
                $("select[name='guarantees'] :selected").each(function(){
                    guarantees.push($(this).val());
                });
                var colors = [];
                $("#colors tr").each(function(){
                    if($(this).find("input").length >= 1) {
                        var color = {
                            name: "",
                            color: "",
                            count: "",
                            price: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'name') {
                                color.name = this.value;
                            }
                            if (this.name == 'color') {
                                color.color = this.value;
                            }
                            if (this.name == 'count') {
                                color.count = this.value;
                            }
                            if (this.name == 'price') {
                                color.price = this.value;
                            }
                        })
                        colors.push(color);
                    }
                });

                var sizes = [];
                $("#sizes tr").each(function(){
                    if($(this).find("input").length >= 1) {
                        var size = {
                            name: "",
                            count: "",
                            price: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'name') {
                                size.name = this.value;
                            }
                            if (this.name == 'count') {
                                size.count = this.value;
                            }
                            if (this.name == 'price') {
                                size.price = this.value;
                            }
                        })
                        sizes.push(size);
                    }
                });
                var form = {
                    "_token": "{{ csrf_token() }}",
                    off:off,
                    price:price,
                    count:count,
                    status:status,
                    guarantees:JSON.stringify(guarantees),
                    colors:JSON.stringify(colors),
                    sizes:JSON.stringify(sizes),
                };

                $.ajax({
                    url: window.location.href,
                    type: "put",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "تنوع اضافه شد", // Text that is to be shown in the toast
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
                        window.location.href="/admin/variety";
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
                        $("button[name='createPost']").text('افزودن تنوع');
                    }
                });
            });
        })
    </script>
@endsection

@section('jsScript')
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
