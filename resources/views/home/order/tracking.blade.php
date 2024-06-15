@extends('home.master')

@section('title' , __('messages.type_ticket3') . ' - ')
@section('content')
    <div class="allTracking">
        <div class="trackingTitle">
            <h4 class="width">{{__('messages.type_ticket3')}}</h4>
        </div>
        <div class="trackingData width">
            <p>{{__('messages.track1')}}</p>
            <div class="trackingItems">
                <div class="trackingItem">
                    <label for="property1">{{__('messages.order_property')}} *</label>
                    <input type="text" name="property" id="property1" placeholder="{{__('messages.order_property')}}">
                </div>
                <div class="trackingItem">
                    <label for="number1">{{__('messages.buyer_number')}} *</label>
                    <input type="text" id="number1" name="number" placeholder="{{__('messages.buyer_number')}}">
                </div>
            </div>
            <div class="buttons">
                <button>{{__('messages.track2')}}</button>
            </div>
        </div>
        <div class="payTracked width">
            <div class="trackedTitle">{{__('messages.my_order')}} :</div>
            <table>
                <tr>
                    <th>{{__('messages.order_deliver')}}</th>
                    <th>{{__('messages.order_property')}}</th>
                    <th>{{__('messages.order_status')}}</th>
                    <th>{{__('messages.order_created')}}</th>
                    <th>{{__('messages.action1')}}</th>
                </tr>
            </table>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var wait1 = {!! json_encode(__('messages.wait'), JSON_HEX_TAG) !!};
            var fail_track1 = {!! json_encode(__('messages.fail_track'), JSON_HEX_TAG) !!};
            var login_attention1 = {!! json_encode(__('messages.login_attention'), JSON_HEX_TAG) !!};
            var track2 = {!! json_encode(__('messages.track2'), JSON_HEX_TAG) !!};
            var order_deliver1 = {!! json_encode(__('messages.order_deliver1'), JSON_HEX_TAG) !!};
            var order_deliver2 = {!! json_encode(__('messages.order_deliver2'), JSON_HEX_TAG) !!};
            var order_deliver3 = {!! json_encode(__('messages.order_deliver3'), JSON_HEX_TAG) !!};
            var order_deliver4 = {!! json_encode(__('messages.order_deliver4'), JSON_HEX_TAG) !!};
            var order_deliver5 = {!! json_encode(__('messages.order_deliver5'), JSON_HEX_TAG) !!};
            var order_status2 = {!! json_encode(__('messages.order_status2'), JSON_HEX_TAG) !!};
            var order_status3 = {!! json_encode(__('messages.order_status3'), JSON_HEX_TAG) !!};
            var order_status4 = {!! json_encode(__('messages.order_status4'), JSON_HEX_TAG) !!};
            var order_status5 = {!! json_encode(__('messages.order_status5'), JSON_HEX_TAG) !!};
            var order_status6 = {!! json_encode(__('messages.order_status6'), JSON_HEX_TAG) !!};
            var order_status7 = {!! json_encode(__('messages.order_status7'), JSON_HEX_TAG) !!};
            var show1 = {!! json_encode(__('messages.show'), JSON_HEX_TAG) !!};
            $('.allTracking .buttons button').click(function(){
                var button = $(this);
                button.text(wait1);
                var num = $(".allTracking input[name='number']").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    property:$(".allTracking input[name='property']").val(),
                    number: num,
                };
                $.ajax({
                    url: "/get-order-fast",
                    type: "post",
                    data: form,
                    success: function (data) {
                        button.text(track2);
                        if(data == 'no'){
                            $.toast({
                                text: fail_track1, // Text that is to be shown in the toast
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
                        }else{
                            $('.payTracked').show();
                            $('.allTracking table').append(
                                $('<tr class="newTr">'+
                                    '<td>'+
                                    (data.deliver == 0 ? '<span class="unActive">'+order_deliver1+'</span>': '')+
                                    (data.deliver == 1 ? '<span class="unActive">'+order_deliver2+'</span>': '')+
                                    (data.deliver == 2 ? '<span class="unActive">'+order_deliver3+'</span>': '')+
                                    (data.deliver == 3 ? '<span class="unActive">'+order_deliver4+'</span>': '')+
                                    (data.deliver == 4 ? '<span class="active">'+order_deliver5+'</span>': '')+
                                    '</td>'+
                                    '<td>'+
                                    '<span>'+data.property+'</span>'+
                                    '</td>'+
                                    '<td>'+
                                    (data.status == 100 ? '<span class="active">'+order_status2+'</span>': '')+
                                    (data.status == 50 ? '<span class="active">'+order_status3+'</span>': '')+
                                    (data.status == 20 ? '<span class="active">'+order_status4+'</span>': '')+
                                    (data.status == 10 ? '<span class="unActive">'+order_status5+'</span>': '')+
                                    (data.status == 0 ? '<span class="unActive">'+order_status6+'</span>': '')+
                                    (data.status == 1 ? '<span class="unActive">'+order_status7+'</span>': '')+
                                    '</td>'+
                                    '<td>'+
                                    '<span>'+data.created_at+'</span>'+
                                    '</td>'+
                                    '<td>'+
                                    '<a href="/show-pay-fast?property='+data.property+'&number='+num+'">'+show1+'</a>'+
                                    '</td>'+
                                    '</tr>'
                                ));
                        }
                    },
                });
            })
        })
    </script>
@endsection
