@extends('seller.master')

@section('tab',2)
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
                                <span>{{__('messages.cats')}} :</span>
                                @if($posts->category)
                                    <span>{{$posts->category[0]->name}}</span>
                                @else
                                    <span>{{__('messages.no_cat')}}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{__('messages.var_color')}} :</span>
                                <span>{{count(json_decode($posts->colors))}}</span>
                            </li>
                            <li>
                                <span>{{__('messages.var_size')}} :</span>
                                <span>{{count(json_decode($posts->size))}}</span>
                            </li>
                            <li>
                                <span>{{__('messages.price1')}} :</span>
                                <span>{{number_format($posts->price)}} {{__('messages.arz')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="allCreateVariety">
                    <div class="allVarietiesTitle">
                        <span>{{__('messages.edit_var')}}</span>
                    </div>
                    <div class="allCreateVarietyItems">
                        <div class="allCreateVarietyItem">
                            <h3>{{__('messages.guarantee')}}</h3>
                            <select class="guarantee-multiple" name="guarantees" multiple="multiple">
                                @foreach ($guarantees as $guarantee)
                                    <option value="{{ $guarantee->id }}">{{ $guarantee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="allCreateVarietyItem">
                            <h3>{{__('messages.count')}}*</h3>
                            <input type="text" name="count" value="{{$posts->count}}" placeholder="{{__('messages.count')}}">
                        </div>
                    </div>
                    <div class="allCreateVarietyItems">
                        <div class="allCreateVarietyItem">
                            <h3>{{__('messages.price1')}}*</h3>
                            <input type="text" name="price" value="{{$posts->offPrice}}" placeholder="{{__('messages.price1')}}">
                        </div>
                        <div class="allCreateVarietyItem">
                            <h3>{{__('messages.off')}}</h3>
                            <input type="text" name="off" value="{{$posts->off}}" placeholder="{{__('messages.off')}}">
                        </div>
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
                    <div class="buttons">
                        <button>{{__('messages.edit_var')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var not_guarantee = {!! json_encode(__('messages.not_guarantee'), JSON_HEX_TAG) !!};
            var not_found = {!! json_encode(__('messages.not_found'), JSON_HEX_TAG) !!};
            var color3 = {!! json_encode(__('messages.color'), JSON_HEX_TAG) !!};
            var size3 = {!! json_encode(__('messages.size'), JSON_HEX_TAG) !!};
            var count3 = {!! json_encode(__('messages.count'), JSON_HEX_TAG) !!};
            var price3 = {!! json_encode(__('messages.price1'), JSON_HEX_TAG) !!};
            var color_code = {!! json_encode(__('messages.color_code'), JSON_HEX_TAG) !!};
            var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
            var product_added = {!! json_encode(__('messages.product_added'), JSON_HEX_TAG) !!};
            var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
            var star_field = {!! json_encode(__('messages.star_field'), JSON_HEX_TAG) !!};
            var login_attention = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
            var edit_var = {!! json_encode(__('messages.edit_var'), JSON_HEX_TAG) !!};
            var posts = {!! $posts->toJson() !!};
            var guarantee = [];
            if(posts.guarantee){
                $.each(posts.guarantee,function(){
                    guarantee.push(this.id);
                });
                $('.guarantee-multiple').val(guarantee);
            }
            $('.guarantee-multiple').select2({
                placeholder: not_guarantee,
                "language": {
                    "noResults": function(){
                        return not_found;
                    }
                },
            });
            $('#addColor').click(function (){
                $('#colors').append(
                    $('<tr><td><input type="text" name="name" placeholder="'+color3+'"></td><td><input name="color" type="color" placeholder="'+color_code+'"></td><td><input name="count" placeholder="'+count3+'"></td><td><input name="price" placeholder="'+price3+'"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
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
            if(posts.colors) {
                if(JSON.parse(posts.colors)) {
                    $.each(JSON.parse(posts.colors),function(){
                        $('#colors').append(
                            $('<tr><td><input type="text" name="name" value="'+this.name+'" placeholder="'+color3+'"></td><td><input name="color" type="color" value="'+this.color+'" placeholder="'+color_code+'"></td><td><input name="count" value="'+this.count+'" placeholder="'+count3+'"></td><td><input name="price" value="'+this.price+'" placeholder="'+price3+'"></td><td><i id="deleteColor"><svg class="icon"><use xlink:href="#trash"></use></svg></i></td></tr>')
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
            $(".buttons button").click(function(event){
                $(this).text(wait1);
                var off = $(".allCreateVarietyItem input[name='off']").val();
                var price = $(".allCreateVarietyItem input[name='price']").val();
                var count = $(".allCreateVarietyItem input[name='count']").val();
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
                        window.location.href="/seller/my-products";
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
                        $("button[name='createPost']").text(edit_var);
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
