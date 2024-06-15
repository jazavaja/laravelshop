@extends('seller.master')

@section('tab' , 3)
@section('content')
    <div class="allShowPay">
        <div class="topShowPay">
            <div class="title">
                <h1>{{__('messages.detail_order')}}</h1>
                <span>{{$pays->created_at}}</span>
                <button class="print-button">
                    <svg class="icon">
                        <use xlink:href="#print"></use>
                    </svg>
                    {{__('messages.label1')}}
                </button>
                <button class="print-button2">
                    <svg class="icon">
                        <use xlink:href="#print"></use>
                    </svg>
                    {{__('messages.label2')}}
                </button>
            </div>
            <div class="detail">
                <div class="topDetail">
                    <div class="items">
                        @if($pays->pay->address)
                        <div class="item">
                                <h5>{{__('messages.buyer_name')}} :</h5>
                                <div>{{$pays->pay->address[0]->name}}</div>
                            </div>
                            <div class="item">
                                <h5>{{__('messages.buyer_number')}} :</h5>
                                <div>{{$pays->pay->address[0]->number}}</div>
                            </div>
                        @endif
                        <div class="item">
                            <h5>{{__('messages.buyer_carrier_type')}} :</h5>
                            <div>{{$pays->pay->carrier}}</div>
                        </div>
                        <div class="item">
                            <h5>{{__('messages.buyer_carrier_price')}} :</h5>
                            <div>{{number_format($pays->pay->carrier_price)}} {{__('messages.arz')}} </div>
                        </div>
                        @if($pays->pay->time)
                            <div class="item">
                                <h5>{{__('messages.buyer_time')}} :</h5>
                                <div>
                                    <span>{{__('messages.period_cart')}}</span>
                                    <span>{{json_decode($pays->pay->time)->from}}:00</span>
                                    <span>-</span>
                                    <span>{{json_decode($pays->pay->time)->to}}:00</span>
                                    <span>---></span>
                                    <span>{{json_decode($pays->pay->time)->day}} / </span>
                                    <span>{{json_decode($pays->pay->time)->month}}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($pays->pay->address)
                        <div class="items">
                            <div class="item">
                                <h5>{{__('messages.address')}} :</h5>
                                <div>
                                    -{{$pays->pay->address[0]->state}}
                                    -{{$pays->pay->address[0]->city}}
                                    -{{$pays->pay->address[0]->address}}
                                    {{__('messages.buyer_address')}} :
                                    {{$pays->pay->address[0]->plaque}}
                                    {{__('messages.unit_address')}} :
                                    {{$pays->pay->address[0]->unit}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="botDetail">
                    <div class="items">
                        <div class="item">
                            <h5>{{__('messages.order_price')}} :</h5>
                            <div>{{number_format($pays->price)}} {{__('messages.arz')}}</div>
                        </div>
                        @if($pays->method == 2)
                            <div class="item">
                                <h5>{{__('messages.buyer_deposit')}} :</h5>
                                <div>{{number_format($pays->deposit)}} {{__('messages.arz')}}</div>
                            </div>
                        @endif
                        <div class="item">
                            <h5>{{__('messages.order_install5')}} :</h5>
                            @if($pays->status == 100)
                                <span class="active">{{__('messages.order_status2')}}</span>
                            @endif
                            @if($pays->status == 50)
                                <span class="active">{{__('messages.order_status3')}}</span>
                            @endif
                            @if($pays->status == 20)
                                <span class="active">{{__('messages.order_status4')}}</span>
                            @endif
                            @if($pays->status == 10)
                                <span class="unActive">{{__('messages.order_status5')}}</span>
                            @endif
                            @if($pays->status == 0)
                                <span class="unActive">{{__('messages.order_status6')}}</span>
                            @endif
                            @if($pays->status == 1)
                                <span class="unActive">{{__('messages.order_status7')}}</span>
                            @endif
                        </div>
                        <div class="item">
                            <h5>{{__('messages.order_deliver')}} :</h5>
                            <select name="deliver">
                                <option value="0">{{__('messages.order_deliver1')}}</option>
                                <option value="1">{{__('messages.order_deliver2')}}</option>
                                <option value="2">{{__('messages.order_deliver3')}}</option>
                                <option value="3">{{__('messages.order_deliver4')}}</option>
                                <option value="4">{{__('messages.order_deliver5')}}</option>
                            </select>
                        </div>
                        <div class="item">
                            <h5>{{__('messages.order_method')}} :</h5>
                            @if($pays->method == 0)
                                <div>{{__('messages.method_cart1')}}</div>
                            @endif
                            @if($pays->method == 1)
                                <div>{{__('messages.order_method1')}}</div>
                            @endif
                            @if($pays->method == 2)
                                <div>{{__('messages.order_method2')}}</div>
                            @endif
                            @if($pays->method == 3)
                                <div>{{__('messages.order_method3')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="trackPay">
                <input type="text" placeholder="{{__('messages.order_track1')}}" name="track" value="{{$pays->track}}">
                <button>{{__('messages.action')}}</button>
            </div>
        </div>
        <div class="allShowPayContainer">
            <div class="topContainer">
                <div class="level">
                    <h3>{{__('messages.order_deliver')}} :</h3>
                    @if($pays->deliver == 0)
                        <span class="unActive">{{__('messages.order_deliver1')}}</span>
                    @endif
                    @if($pays->deliver == 1)
                        <span class="unActive">{{__('messages.order_deliver2')}}</span>
                    @endif
                    @if($pays->deliver == 2)
                        <span class="unActive">{{__('messages.order_deliver3')}}</span>
                    @endif
                    @if($pays->deliver == 3)
                        <span class="unActive">{{__('messages.order_deliver4')}}</span>
                    @endif
                    @if($pays->deliver == 4)
                        <span class="activeStatus">{{__('messages.order_deliver5')}}</span>
                    @endif
                </div>
                <div class="rateItemsCount">
                    <div class="rateItemsCountItem" title="{{__('messages.order_deliver1')}}">
                        @if($pays->deliver >= 1)
                        <div class="rateItemsCountItemBarActive"></div>
                        @endif
                        @if($pays->deliver == 0)
                        <div class="rateItemsCountItemBar"></div>
                        @endif
                        @if($pays->deliver >= 1)
                            <div class="rateItemsCountItemCircleActives">
                                <svg class="icon">
                                    <use xlink:href="#delivery-complete"></use>
                                </svg>
                            </div>
                        @endif
                        @if($pays->deliver == 0)
                        <div class="rateItemsCountItemCircleActive">
                            <svg class="icon">
                                    <use xlink:href="#delivery-complete"></use>
                                </svg>
                        </div>
                        @endif
                    </div>
                    <div class="rateItemsCountItem" title="{{__('messages.order_deliver2')}}">
                        @if($pays->deliver >= 2)
                        <div class="rateItemsCountItemBarActive"></div>
                        @endif
                        @if($pays->deliver <= 1)
                        <div class="rateItemsCountItemBar"></div>
                        @endif
                        @if($pays->deliver >= 2)
                        <div class="rateItemsCountItemCircleActives">
                            <svg class="icon">
                                <use xlink:href="#waiting-room"></use>
                            </svg>
                        </div>
                        @endif
                        @if($pays->deliver == 1)
                        <div class="rateItemsCountItemCircleActive">
                            <svg class="icon">
                                <use xlink:href="#waiting-room"></use>
                            </svg>
                        </div>
                        @endif
                        @if($pays->deliver <= 0)
                            <div class="rateItemsCountItemCircle">
                                <svg class="icon">
                                    <use xlink:href="#waiting-room"></use>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="rateItemsCountItem" title="{{__('messages.order_deliver3')}}">
                        @if($pays->deliver >= 3)
                        <div class="rateItemsCountItemBarActive"></div>
                        @endif
                        @if($pays->deliver <= 2)
                            <div class="rateItemsCountItemBar"></div>
                        @endif
                        @if($pays->deliver >= 3)
                            <div class="rateItemsCountItemCircleActives">
                                <svg class="icon">
                                    <use xlink:href="#package-delivery"></use>
                                </svg>
                            </div>
                        @endif
                        @if($pays->deliver == 2)
                        <div class="rateItemsCountItemCircleActive">
                            <svg class="icon">
                                <use xlink:href="#package-delivery"></use>
                            </svg>
                        </div>
                        @endif
                        @if($pays->deliver <= 1)
                        <div class="rateItemsCountItemCircle">
                            <svg class="icon">
                                <use xlink:href="#package-delivery"></use>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="rateItemsCountItem" title="{{__('messages.order_deliver4')}}">
                        @if($pays->deliver >= 4)
                        <div class="rateItemsCountItemBarActive"></div>
                        @endif
                        @if($pays->deliver <= 3)
                        <div class="rateItemsCountItemBar"></div>
                        @endif
                        @if($pays->deliver >= 4)
                        <div class="rateItemsCountItemCircleActives">
                            <svg class="icon">
                                <use xlink:href="#delivery-truck"></use>
                            </svg>
                        </div>
                        @endif
                        @if($pays->deliver == 3)
                        <div class="rateItemsCountItemCircleActive">
                            <svg class="icon">
                                <use xlink:href="#delivery-truck"></use>
                            </svg>
                        </div>
                        @endif
                        @if($pays->deliver <= 2)
                        <div class="rateItemsCountItemCircle">
                            <svg class="icon">
                                <use xlink:href="#delivery-truck"></use>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="rateItemsCountItem" title="{{__('messages.order_deliver5')}}">
                        @if($pays->deliver == 4)
                            <div class="rateItemsCountItemCircleActive">
                                <svg class="icon">
                                    <use xlink:href="#delivery-box"></use>
                                </svg>
                            </div>
                        @endif
                        @if($pays->deliver <= 3)
                            <div class="rateItemsCountItemCircle">
                                <svg class="icon">
                                    <use xlink:href="#delivery-box"></use>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="code">
                    <h3>{{__('messages.order_property')}} :</h3>
                    <span>{{$pays->pay->property}}</span>
                </div>
            </div>
            <div class="items">
                <div class="titleProducts">
                    <div class="title">{{__('messages.order_products')}}</div>
                </div>
                <div class="item">
                    <a href="/product/{{$pays->product->slug}}" class="cartDetailPic">
                        <img src="{{json_decode($pays->product->image)[0]}}" alt="{{$pays->product->title}}">
                    </a>
                    <div class="cartDetailInfo">
                        <a href="/product/{{$pays->product->slug}}" class="cartDetailInfoItem">
                            <h3>{{$pays->product->title}}</h3>
                        </a>
                        @if($pays->color)
                            <div class="cartDetailInfoItem">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#color"></use>
                                    </svg>
                                </i>
                                <span>{{$pays->color}}</span>
                            </div>
                        @endif
                        @if($pays->size)
                            <div class="cartDetailInfoItem">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#sizeFront"></use>
                                    </svg>
                                </i>
                                <span>{{$pays->size}}</span>
                            </div>
                        @endif
                        @if($pays->guarantee_name)
                            <div class="cartDetailInfoItem">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#security"></use>
                                    </svg>
                                </i>
                                <span>{{$pays->guarantee_name}}</span>
                            </div>
                        @endif
                        <div class="cartDetailInfoItem">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#post"></use>
                                </svg>
                            </i>
                            <span>{{$pays->count}}</span>
                        </div>
                        <div class="cartDetailInfoItem">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#cost"></use>
                                </svg>
                            </i>
                            <span>{{number_format($pays->price)}} {{__('messages.arz')}}</span>
                        </div>
                        <div class="cartDetailInfoItem">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#car"></use>
                                </svg>
                            </i>
                            @if($pays->deliver == 0)
                                <span class="unActive">{{__('messages.order_deliver1')}}</span>
                            @endif
                            @if($pays->deliver == 1)
                                <span class="unActive">{{__('messages.order_deliver2')}}</span>
                            @endif
                            @if($pays->deliver == 2)
                                <span class="unActive">{{__('messages.order_deliver3')}}</span>
                            @endif
                            @if($pays->deliver == 3)
                                <span class="unActive">{{__('messages.order_deliver4')}}</span>
                            @endif
                            @if($pays->deliver == 4)
                                <span class="activeStatus">{{__('messages.order_deliver5')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="printPay" id="printMe1">
            <div class="printPayItems" style="direction: rtl">
                <div class="userInfo" style="border: 1.5px dashed black;padding: 1rem;">
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.address')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->address[0]->address}}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.order_property')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->property}}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.buyer_name')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->address[0]->name}}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.seller_post')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->address[0]->post}}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.buyer_number')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->address[0]->number}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="printPay" id="printMe2">
            <div class="printPayItems" style="direction: rtl">
                <div class="userInfo" style="border: 1.5px dashed black;padding: 1rem;">
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.title1')}} :</label>
                        <span style="font-size: 1rem;">{{ $name }}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.order_property')}} :</label>
                        <span style="font-size: 1rem;">{{$pays->pay->property}}</span>
                    </div>
                    <div class="userInfoItem" style="padding: 1rem 0;">
                        <label style="font-size: 1rem;">{{__('messages.buyer_number')}} :</label>
                        <span style="font-size: 1rem;">{{$number}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var pays = {!! $pays->toJson() !!};
            $('.print-button').click(function() {
                var divToPrint=document.getElementById('printMe1');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $('.print-button2').click(function() {
                var divToPrint=document.getElementById('printMe2');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $(".item select[name='deliver']").val(pays.deliver);
            var success2 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
            var order_edited2 = {!! json_encode(__('messages.order_edited'), JSON_HEX_TAG) !!};
            $(".item select[name='deliver']").change(function() {
                var deliver=$(".item select[name='deliver'] :selected").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    deliver:deliver,
                    update:2,
                };
                $.ajax({
                    url: "/seller/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: order_edited2, // Text that is to be shown in the toast
                            heading: success2, // Optional heading to be shown on the toast
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
                        window.location.reload();
                    },
                });
            });
            $(".trackPay button").on('click',function() {
                var track=$(".trackPay input[name='track']").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    track:track,
                    update:3,
                };
                $.ajax({
                    url: "/seller/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: order_edited2, // Text that is to be shown in the toast
                            heading: success2, // Optional heading to be shown on the toast
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
                    },
                });
            });
        })
    </script>
@endsection

@section('jsScript')
    <script src="/js/jquery.toast.min.js"></script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
@endsection
