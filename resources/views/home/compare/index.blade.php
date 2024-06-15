@extends('home.master')

@section('content')
    <main class="allCompare width">
        <div class="titleCompare">{{__('messages.compare_product')}}</div>
        <div class="compareItems">
            <div class="compareItem" id="compare1">
                <div class="addCompare">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#add"></use>
                        </svg>
                    </i>
                    <h4>{{__('messages.add_product1')}}</h4>
                </div>
            </div>
            <div class="compareItem" id="compare2">
                <div class="addCompare">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#add"></use>
                        </svg>
                    </i>
                    <h4>{{__('messages.add_product1')}}</h4>
                </div>
            </div>
            <div class="compareItem" id="compare3">
                <div class="addCompare">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#add"></use>
                        </svg>
                    </i>
                    <h4>{{__('messages.add_product1')}}</h4>
                </div>
            </div>
            <div class="compareItem" id="compare4">
                <div class="addCompare">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#add"></use>
                        </svg>
                    </i>
                    <h4>{{__('messages.add_product1')}}</h4>
                </div>
            </div>
        </div>
        <div class="compareTable" style="display:none;">
            <table>
                <tr>
                    <td>
                        <h4>{{__('messages.price1')}}</h4>
                    </td>
                </tr>
                <tr class="amountCompare">
                    <td id="compare1">
                        <span></span>
                    </td>
                    <td id="compare2">
                        <span></span>
                    </td>
                    <td id="compare3">
                        <span></span>
                    </td>
                    <td id="compare4">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__('messages.count1')}}</h4>
                    </td>
                </tr>
                <tr class="inventoryCompare">
                    <td id="compare1">
                        <span></span>
                    </td>
                    <td id="compare2">
                        <span></span>
                    </td>
                    <td id="compare3">
                        <span></span>
                    </td>
                    <td id="compare4">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__('messages.off')}}</h4>
                    </td>
                </tr>
                <tr class="discountCompare">
                    <td id="compare1">
                        <span></span>
                    </td>
                    <td id="compare2">
                        <span></span>
                    </td>
                    <td id="compare3">
                        <span></span>
                    </td>
                    <td id="compare4">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__('messages.score')}}</h4>
                    </td>
                </tr>
                <tr class="scoreCompare">
                    <td id="compare1">
                        <span></span>
                    </td>
                    <td id="compare2">
                        <span></span>
                    </td>
                    <td id="compare3">
                        <span></span>
                    </td>
                    <td id="compare4">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__('messages.property')}}</h4>
                    </td>
                </tr>
                <tr class="abilityCompare">
                    <td id="compare1"></td>
                    <td id="compare2"></td>
                    <td id="compare3"></td>
                    <td id="compare4"></td>
                </tr>
            </table>
        </div>
        <div class="showAllProducts" style="display:none;">
            <div class="productItems">
                <div class="showProductTitle">
                    <h4>{{__('messages.search_product')}}</h4>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#cancel"></use>
                        </svg>
                    </i>
                </div>
                <div class="searchShow">
                    <input type="text" name="searchProduct" placeholder="{{__('messages.search2')}}">
                </div>
                <div class="allProducts">
                    @foreach($products as $item)
                        <div class="productItem" id="{{$item->id}}">
                            <div class="pic">
                                <img src="{{json_decode($item->image)[0]}}" alt="{{$item->title}}">
                            </div>
                            <h4>{{$item->title}}</h4>
                            <h5>{{number_format($item->price)}} {{__('messages.arz')}}</h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var show1 = {!! json_encode(__('messages.show'), JSON_HEX_TAG) !!};
            var arz1 = {!! json_encode(__('messages.arz'), JSON_HEX_TAG) !!};
            var number1 = {!! json_encode(__('messages.number'), JSON_HEX_TAG) !!};
            var no_off1 = {!! json_encode(__('messages.no_off'), JSON_HEX_TAG) !!};
            var score1 = {!! json_encode(__('messages.score'), JSON_HEX_TAG) !!};
            var no_score1 = {!! json_encode(__('messages.no_score'), JSON_HEX_TAG) !!};
            var product = {!! $product->toJson() !!};
            var compareId = '';
            if(product){
                compareId = 'compare1';
                $('.showAllProducts').hide();
                $('.compareTable').show();
                $(".compareItems " + '#'+compareId + ' .addCompare').hide();
                $(".compareItems " + '#'+compareId + ' .productData').remove();
                $(".compareItems " + '#'+compareId).append(
                    $('<div class="productData">'+
                        '<div class="closeCompare">'+
                        '<i>'+
                        '<svg class="icon">'+
                        '<use xlink:href="#cancel"></use>'+
                        '</svg>'+
                        '</i>'+
                        '</div>'+
                        '<figure class="pic">'+
                        '<img src="'+JSON.parse(product.image)[0]+'" alt="'+product.title+'">'+
                        '</figure>'+
                        '<h4>'+product.title+'</h4>'+
                        '<a href="/product/'+product.slug+'">مشاهده</a>'+
                        '</div>')
                );
                $(".compareTable .amountCompare " + '#'+compareId + ' span').text(makePrice(product.price) + ' ' + arz1)
                $(".compareTable .inventoryCompare " + '#'+compareId + ' span').text(product.count + ' ' + number1)
                if(product.off){
                    $(".compareTable .discountCompare " + '#'+compareId + ' span').text('%' + product.off)
                }else{
                    $(".compareTable .discountCompare " + '#'+compareId + ' span').text(no_off1)
                }
                if(product.score){
                    $(".compareTable .scoreCompare " + '#'+compareId + ' span').text(product.score + score1)
                }else{
                    $(".compareTable .scoreCompare " + '#'+compareId + ' span').text(no_score1)
                }
                $(".compareTable .abilityCompare " + '#'+compareId).children("h5").remove();
                $.each(JSON.parse(product.ability) , function(){
                    $(".compareTable .abilityCompare " + '#'+compareId).append(
                        $('<h5>+ '+this.name+'</h5>')
                    )
                })
            }
            $(document).on('click','.allProducts .productItem',function(){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    'product' : $(this).attr('id')
                };
                $.ajax({
                    url: "/get-compare",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $('.showAllProducts').hide();
                        $('.compareTable').show();
                        $(".compareItems " + '#'+compareId + ' .addCompare').hide();
                        $(".compareItems " + '#'+compareId + ' .productData').remove();
                        $(".compareItems " + '#'+compareId).append(
                            $('<div class="productData">'+
                            '<div class="closeCompare">'+
                            '<i>'+
                            '<svg class="icon">'+
                            '<use xlink:href="#cancel"></use>'+
                            '</svg>'+
                            '</i>'+
                            '</div>'+
                            '<figure class="pic">'+
                            '<img src="'+JSON.parse(data.image)[0]+'" alt="'+data.title+'">'+
                            '</figure>'+
                            '<h4>'+data.title+'</h4>'+
                            '<a href="/product/'+data.slug+'">'+show1+'</a>'+
                            '</div>')
                        );
                        $(".compareTable .amountCompare " + '#'+compareId + ' span').text(makePrice(data.price) + ' ' + arz1)
                        $(".compareTable .inventoryCompare " + '#'+compareId + ' span').text(data.count + ' ' + number1)
                        if(data.off){
                            $(".compareTable .discountCompare " + '#'+compareId + ' span').text('%' + data.off)
                        }else{
                            $(".compareTable .discountCompare " + '#'+compareId + ' span').text(no_off1)
                        }
                        if(data.score){
                            $(".compareTable .scoreCompare " + '#'+compareId + ' span').text(data.score + score1)
                        }else{
                            $(".compareTable .scoreCompare " + '#'+compareId + ' span').text(no_score1)
                        }
                        $(".compareTable .abilityCompare " + '#'+compareId).children("h5").remove();
                        $.each(JSON.parse(data.ability) , function(){
                            $(".compareTable .abilityCompare " + '#'+compareId).append(
                                $('<h5>+ '+this.name+'</h5>')
                            )
                        })
                    },
                });
            })
            $('.compareItem').on('click',function(){
                compareId = $(this).attr('id');
                $('.showAllProducts').show();
            })
            $(document).on('click','.compareItems .productData .closeCompare',function(ss){
                $('.showAllProducts').hide();
                compareId = $(ss.currentTarget.parentElement.parentElement).attr('id');
                $(".compareItems " + '#'+compareId + ' .addCompare').show();
                $(".compareItems " + '#'+compareId + ' .productData').remove();
                $(".compareTable .amountCompare " + '#'+compareId + ' span').text('')
                $(".compareTable .inventoryCompare " + '#'+compareId + ' span').text('')
                $(".compareTable .discountCompare " + '#'+compareId + ' span').text('')
                $(".compareTable .scoreCompare " + '#'+compareId + ' span').text('')
                $(".compareTable .abilityCompare " + '#'+compareId).children("h5").remove();
            })
            $('.showProductTitle i').click(function(){
                $('.showAllProducts').hide();
            })
            $(document).on('click','.compareItems .productData a',function(){
                $('.showAllProducts').hide();
            })

            var typingTimer;
            var doneTypingInterval = 500;
            var $input = $(".showAllProducts .searchShow input[name='searchProduct']");
            $input.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });
            $input.on('keydown', function () {
                clearTimeout(typingTimer);
            });
            function doneTyping () {
                $('.allProducts').children(".productItem").remove();
                if($input.val().length >= 1){
                    $('.allLoading').show();
                    var form = {
                        "_token": "{{ csrf_token() }}",
                        'search' : $input.val(),
                    };
                    $.ajax({
                        url: "/search",
                        type: "post",
                        data: form,
                        success: function (data) {
                            $('.allLoading').hide();
                            $.each(data,function(){
                                $('.allProducts').append(
                                    '<div class="productItem" id="'+this.id+'">'+
                                        '<div class="pic">'+
                                            '<img src="'+JSON.parse(this.image)[0]+'" alt="'+this.title+'">'+
                                        '</div>'+
                                        '<h4>'+this.title+'</h4>'+
                                        '<h5>'+makePrice(this.price)+arz1+' </h5>'+
                                    '</div>'
                                );
                            })
                        },
                    });
                }
            }
            function makePrice(price){
                price += '';
                x = price.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        })
    </script>
@endsection

