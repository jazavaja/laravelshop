@extends('seller.master')

@section('tab',6)
@section('content')
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>{{__('messages.edit_product')}}</h1>
                <div class="allPostTitle">
                    <a href="/seller">{{__('messages.dashboard')}}</a>
                    <span>/</span>
                    <a href="/seller/product">{{__('messages.dashboard')}}</a>
                    <span>/</span>
                    <a href="/seller/product/{{$posts->id}}/edit">{{__('messages.edit_product')}}</a>
                </div>
            </div>
            <div class="allCreatePostData">
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>{{__('messages.body1')}}* :</label>
                        <textarea placeholder="{{__('messages.body1')}}" name="body">{{$posts->short}}</textarea>
                        <div id="validation-body"></div>
                    </div>
                    <div class="allCreatePostItem">
                        <label>{{__('messages.body2')}} :</label>
                        <textarea name="editor" class="editor">{{$posts->body}}</textarea>
                    </div>
                    <div class="addImageButton">{{__('messages.add_pic')}}</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">{{__('messages.add_pic2')}}</span>
                        </div>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>{{__('messages.product_property')}}</label>
                            <i id="addAbility">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="abilities">
                            <tr>
                                <th>{{__('messages.product_property')}}</th>
                                <th>{{__('messages.delete')}}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>{{__('messages.product_property2')}}</label>
                            <i id="addProperty">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="properties">
                            <tr>
                                <th>{{__('messages.product_property2')}}</th>
                                <th>{{__('messages.body')}}</th>
                                <th>{{__('messages.delete')}}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>{{__('messages.color')}}</label>
                            <i id="addColor">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="colors">
                            <tr>
                                <th>{{__('messages.color_name')}}</th>
                                <th>{{__('messages.color_code')}}</th>
                                <th>{{__('messages.count')}}</th>
                                <th>{{__('messages.increase_price')}}</th>
                                <th>{{__('messages.delete')}}</th>
                            </tr>
                        </table>
                        <div class="abilityPostToolTip">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#lamp"></use>
                                </svg>
                            </i>
                            <p>{{__('messages.add0')}}</p>
                        </div>
                    </div>
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>{{__('messages.size')}}</label>
                            <i id="addSize">
                                <svg class="icon">
                                    <use xlink:href="#add"></use>
                                </svg>
                            </i>
                        </div>
                        <table class="abilityTable" id="sizes">
                            <tr>
                                <th>{{__('messages.size')}}</th>
                                <th>{{__('messages.count')}}</th>
                                <th>{{__('messages.increase_price')}}</th>
                                <th>{{__('messages.delete')}}</th>
                            </tr>
                        </table>
                        <div class="abilityPostToolTip">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#lamp"></use>
                                </svg>
                            </i>
                            <p>{{__('messages.add0')}}</p>
                        </div>
                    </div>
                    <button class="button" name="createPost" type="submit">{{__('messages.submit_info')}}</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            {{__('messages.detail')}}
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.title1')}}* :</label>
                                <input type="text" name="title" value="{{ old('title', $posts->title) }}" placeholder="{{__('messages.title1')}}">
                                <div id="validation-title"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.weight')}} :</label>
                                <input type="text" name="weight" value="{{ old('weight', $posts->weight) }}" placeholder="{{__('messages.weight')}}">
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.off_percent')}} :</label>
                                <input type="text" name="off" value="{{ old('off', $posts->off) }}" placeholder="{{__('messages.off_percent')}}">
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.price_arz')}}* :</label>
                                <input type="text" name="price" value="{{ old('price', $posts->offPrice) }}" placeholder="{{__('messages.price_arz')}}">
                                <div id="validation-price"></div>
                            </div>
                        </div>
                    </div>
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            {{__('messages.more_info')}}
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.count')}}* :</label>
                                <input type="text" name="count" value="{{ old('count', $posts->count) }}" placeholder="{{__('messages.count')}}">
                                <div id="validation-count"></div>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label for="s2d" class="allCreatePostDetailItemData">
                                    {{__('messages.original')}}
                                    <input id="s2d" name="original" type="checkbox" class="switch" >
                                </label>
                                <label for="s3d" class="allCreatePostDetailItemData">
                                    {{__('messages.used')}}
                                    <input id="s3d" type="checkbox" name="used" class="switch" checked>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            {{__('messages.tax')}}
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.cats')}} :</label>
                                <select class="cats-multiple" name="cats" multiple="multiple">
                                    @foreach ($cats as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.brand')}} :</label>
                                <select class="brands-multiple" name="brands" multiple="multiple">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.guarantee')}} :</label>
                                <select class="guarantee-multiple" name="guarantees" multiple="multiple">
                                    @foreach ($guarantees as $guarantees)
                                        <option value="{{ $guarantees->id }}">{{ $guarantees->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.tags')}} :</label>
                                <select class="tag-multiple" name="tags" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>{{__('messages.buyer_time')}} :</label>
                                <select class="time-multiple" name="times" multiple="multiple">
                                    @foreach ($times as $time)
                                        <option value="{{ $time->id }}">{{ $time->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filemanager">
            @include('seller.filemanager')
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var posts = {!! $posts->toJson() !!};
            $('.filemanager').hide();
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            $( 'textarea.editor' ).ckeditor();
            $(".example1").persianDatepicker({
                showGregorianDate: true,
                formatPersian: false,
                months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
                shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
                persianNumbers: true,
                responsive:true,
                isRTL: true,
                persianDigit: false,
                selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                selectedBefore: false,
                selectedDate: null,
                startDate: null,
                endDate: null,
                theme: 'default',
                alwaysShow: false,
                selectableYears: null,
                cellWidth: 25,
                cellHeight: 20,
                fontSize: 13,
                format: 'YYYY-MM-DD H:m:ss',
                observer: true,
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    },
                },
            });
            $("input[name='suggest']").val(posts.suggest);
            if(posts.used == 1){
                $("input[name='used']").prop("checked", true );
            }
            if(posts.original == 1){
                $("input[name='original']").prop("checked", true );
            }
            if(posts.showcase == 1){
                $("input[name='showcase']").prop("checked", true );
            }
            $("select[name='status']").val(posts.status);
            if(posts.image){
                $.each(JSON.parse(posts.image),function(){
                    $('#imageTooltip').hide();
                    $('.getImageItem').append(
                        $('<div class="getImagePic"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+this+'"></div>')
                            .on('click' , '.deleteImg',function(ss){
                                ss.currentTarget.parentElement.parentElement.remove();
                            })
                    );
                });
            }
            var cats = [];
            var brands = [];
            var tags = [];
            var guarantee = [];
            var time = [];
            if(posts.category){
                $.each(posts.category,function(){
                    cats.push(this.id);
                });
                $('.cats-multiple').val(cats);
            }
            if(posts.brand){
                $.each(posts.brand,function(){
                    brands.push(this.id);
                });
                $('.brands-multiple').val(brands);
            }
            if(posts.guarantee){
                $.each(posts.guarantee,function(){
                    guarantee.push(this.id);
                });
                $('.guarantee-multiple').val(guarantee);
            }
            if(posts.time){
                $.each(posts.time,function(){
                    time.push(this.id);
                });
                $('.time-multiple').val(time);
            }
            if(posts.tag){
                $.each(posts.tag,function(){
                    tags.push(this.id);
                });
                $('.tag-multiple').val(tags);
            }
            var product_property2 = {!! json_encode(__('messages.product_property2'), JSON_HEX_TAG) !!};
            var color3 = {!! json_encode(__('messages.color'), JSON_HEX_TAG) !!};
            var size3 = {!! json_encode(__('messages.size'), JSON_HEX_TAG) !!};
            var count3 = {!! json_encode(__('messages.count'), JSON_HEX_TAG) !!};
            var price3 = {!! json_encode(__('messages.price1'), JSON_HEX_TAG) !!};
            var property3 = {!! json_encode(__('messages.property'), JSON_HEX_TAG) !!};
            var body3 = {!! json_encode(__('messages.body'), JSON_HEX_TAG) !!};
            var color_code = {!! json_encode(__('messages.color_code'), JSON_HEX_TAG) !!};
            var select_brand = {!! json_encode(__('messages.select_brand'), JSON_HEX_TAG) !!};
            var select_cat = {!! json_encode(__('messages.select_cat'), JSON_HEX_TAG) !!};
            var not_found = {!! json_encode(__('messages.not_found'), JSON_HEX_TAG) !!};
            var not_guarantee = {!! json_encode(__('messages.not_guarantee'), JSON_HEX_TAG) !!};
            var select_tag = {!! json_encode(__('messages.select_tag'), JSON_HEX_TAG) !!};
            var select_time = {!! json_encode(__('messages.select_time'), JSON_HEX_TAG) !!};
            var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
            var product_added = {!! json_encode(__('messages.product_added'), JSON_HEX_TAG) !!};
            var login_attention = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
            var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
            var star_field = {!! json_encode(__('messages.star_field'), JSON_HEX_TAG) !!};
            var submit_info = {!! json_encode(__('messages.submit_info'), JSON_HEX_TAG) !!};
            if(posts.ability) {
                if(JSON.parse(posts.ability)) {
                    $.each(JSON.parse(posts.ability),function(){
                        $('#abilities').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="'+property3+'"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteAbility',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            if(posts.rate) {
                if(JSON.parse(posts.rate)) {
                    $.each(JSON.parse(posts.rate),function(){
                        $('#rates').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="'+property3+'"></td><td><input type="range" name="rate" value="'+this.rate+'" min="0" max="4"></td><td><i id="deleteRate"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteRate',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            if(posts.specifications) {
                if(JSON.parse(posts.specifications)) {
                    $.each(JSON.parse(posts.specifications),function(){
                        $('#properties').append(
                            $('<tr><td><input type="text" name="title" value="'+this.title+'" placeholder="'+product_property2+'"></td><td><input name="body" value="'+this.body+'" placeholder="'+body3+'"/></td><td><i id="deleteProperty"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteProperty',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            if(posts.colors) {
                if(JSON.parse(posts.colors)) {
                    $.each(JSON.parse(posts.colors),function(){
                        $('#colors').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="'+color3+'"></td><td><input name="color" value="'+this.color+'" placeholder="'+color_code+'"></td><td><input name="count" value="'+this.count+'" placeholder="'+count3+'"></td><td><input name="price" value="'+this.price+'" placeholder="'+price3+'"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
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
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="'+size3+'"></td><td><input type="text" name="count" value="'+this.count+'" placeholder="'+count3+'"></td><td><input placeholder="'+price3+'" value="'+this.price+'" name="price"></td><td><i id="deleteSize"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                                .on('click' , '#deleteSize',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                    })
                }
            }
            $('.brands-multiple').select2({
                placeholder: select_brand,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $('.cats-multiple').select2({
                placeholder: select_cat,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $('.guarantee-multiple').select2({
                placeholder: not_guarantee,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $('.tag-multiple').select2({
                placeholder: select_tag,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $('.time-multiple').select2({
                placeholder: select_time,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $("select[name='brands']").change(function() {
                var d=$("select[name='brands'] :selected").map(function(){
                    return $(this).val();
                });
            });
            $("button[name='createPost']").click(function(event){
                $(this).text('منتظر بمانید');
                var title = $(".allCreatePostDetailItems input[name='title']").val();
                var weight = $(".allCreatePostDetailItems input[name='weight']").val();
                var slug = $(".allCreatePostDetailItems input[name='slug']").val();
                var status = $(".allCreatePostDetailItems select[name='status']").val();
                var off = $(".allCreatePostDetailItems input[name='off']").val();
                var price = $(".allCreatePostDetailItems input[name='price']").val();
                var count = $(".allCreatePostDetailItems input[name='count']").val();
                var suggest = $(".allCreatePostDetailItems input[name='suggest']").val();
                var keywordSeo = $("input[name='keywordSeo']").val();
                var titleSeo = $("input[name='titleSeo']").val();
                var bodySeo = $("textarea[name='bodySeo']").val();
                var imageAlt = $(".allCreatePostItem input[name='imageAlt']").val();
                var body = $(".allCreatePostItem textarea[name='body']").val();
                var editor = $(".allCreatePostItem textarea[name='editor']").val();
                var showcase = $(".allCreatePostDetailItems input[name='showcase']").is(":checked");
                var original = $(".allCreatePostDetailItems input[name='original']").is(":checked");
                var used = $(".allCreatePostDetailItems input[name='used']").is(":checked");
                var brands = [];
                var cats = [];
                var guarantees = [];
                var times = [];
                var tags = [];
                var image = [];
                $(".allCreatePostDetailItems select[name='brands'] :selected").each(function(){
                    brands.push($(this).val());
                });
                $(".allCreatePostDetailItems select[name='tags'] :selected").each(function(){
                    tags.push($(this).val());
                });
                $(".allCreatePostSubject .getImagePic").each(function(){
                    image.push(this.lastElementChild.src);
                });
                $("select[name='cats'] :selected").each(function(){
                    cats.push($(this).val());
                });
                $("select[name='guarantees'] :selected").each(function(){
                    guarantees.push($(this).val());
                });
                $("select[name='times'] :selected").each(function(){
                    times.push($(this).val());
                });
                var abilities = [];
                $("#abilities tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ability = {
                            name:"",
                        };
                        $(this).find("input").each(function(){
                            ability.name = this.value;
                        })
                        abilities.push(ability);
                    }
                });

                var rates = [];
                var rate1 = $("#rates tr").each(function(){
                    if($(this).find("input").length >= 1) {
                        var rate = {
                            name: "",
                            rate: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'name') {
                                rate.name = this.value;
                            } else {
                                rate.rate = this.value;
                            }
                        })
                        rates.push(rate);
                    }
                });

                var properties = [];
                $("#properties tr").each(function(){
                    if($(this).find("input").length >= 1) {
                        var property = {
                            title: "",
                            body: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'title') {
                                property.title = this.value;
                            }
                            if (this.name == 'body') {
                                property.body = this.value;
                            }
                        })
                        properties.push(property);
                    }
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
                    "_method": "put",
                    title:title,
                    weight:weight,
                    slug:slug,
                    status:status,
                    off:off,
                    price:price,
                    count:count,
                    suggest:suggest,
                    body:body,
                    editor:editor,
                    showcase:showcase,
                    original:original,
                    keywordSeo:keywordSeo,
                    titleSeo:titleSeo,
                    bodySeo:bodySeo,
                    imageAlt:imageAlt,
                    used:used,
                    brands:JSON.stringify(brands),
                    cats:JSON.stringify(cats),
                    guarantees:JSON.stringify(guarantees),
                    times:JSON.stringify(times),
                    tags:JSON.stringify(tags),
                    abilities:JSON.stringify(abilities),
                    colors:JSON.stringify(colors),
                    sizes:JSON.stringify(sizes),
                    properties:JSON.stringify(properties),
                    rates:JSON.stringify(rates),
                    image:JSON.stringify(image),
                };

                $.ajax({
                    url: "/seller/product/"+posts.id+"/edit",
                    type: "put",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: product_added, // Text that is to be shown in the toast
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
                        window.location.href="/seller/product";
                    },
                    error: function (xhr) {
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
                        $("button[name='createPost']").text(submit_info);
                    }
                });
            });
            $('#addAbility').click(function (){
                $('#abilities').append(
                    $('<tr><td><input type="text" name="name" placeholder="'+property3+'"></td><td><i id="deleteAbility"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteAbility',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
            $('#addRate').click(function (){
                $('#rates').append(
                    $('<tr><td><input type="text" name="name" value="" placeholder="'+property3+'"></td><td><input type="range" name="rate" value="2" min="0" max="4"></td><td><i id="deleteRate"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteRate',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
            $('#addProperty').click(function (){
                $('#properties').append(
                    $('<tr><td><input type="text" name="title" placeholder="مشخصات‌ را وارد کنید"></td><td><input name="body" placeholder="'+body3+'"/></td><td><i id="deleteProperty"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteProperty',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
            $('#addColor').click(function (){
                $('#colors').append(
                    $('<tr><td><input type="text" name="name" placeholder="'+color3+'"></td><td><input name="color" placeholder="'+color_code+'"></td><td><input name="count" placeholder="'+count3+'"></td><td><input name="price" placeholder="'+price3+'"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteColor',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
            $('#addSize').click(function (){
                $('#sizes').append(
                    $('<tr><td><input type="text" name="name" placeholder="'+size3+'"></td><td><input type="text" name="count" placeholder="'+count3+'"></td><td><input placeholder="'+price3+'" name="price"></td><td><i id="deleteSize"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
                    .on('click' , '#deleteSize',function(ss){
                        ss.currentTarget.parentElement.parentElement.remove();
                    })
                );
            })
        })
    </script>
@endsection

@section('jsScript')
    <script src="/js/jquery.toast.min.js"></script>
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/persian-datepicker.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/editor/ckeditor.js"></script>
    <script src="/js/editor/adapters/jquery.js"></script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/persian-datepicker.min.css"/>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
