@extends('home.master')

@section('title' , __('messages.change_charge') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 7])
        <div class="profileIndexConverter">
            <ul>
                @foreach($converters as $item)
                    <li>
                        <h3>#{{ ++$loop->index }}</h3>
                        <h4>{{__('messages.change_charge1' , ['score' => number_format($item->score)])}}</h4>
                        @if($item->type == 1)
                            <h4>{{__('messages.change_charge2' , ['score' => number_format($item->reward)])}}</h4>
                            <h4>{{__('messages.change_charge3')}}</h4>
                        @else
                            <h4>{{__('messages.change_charge4' , ['score' => number_format($item->reward)])}}</h4>
                            <h4>{{__('messages.change_charge5')}}</h4>
                        @endif
                        <button id="{{$item->id}}">{{__('messages.change_charge')}}</button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var score_convert1 = {!! json_encode(__('messages.score_convert'), JSON_HEX_TAG) !!};
            var success1 = {!! json_encode(__('messages.success'), JSON_HEX_TAG) !!};
            var fail1 = {!! json_encode(__('messages.fail'), JSON_HEX_TAG) !!};
            var score_fail1 = {!! json_encode(__('messages.score_fail'), JSON_HEX_TAG) !!};
            $('.profileIndexConverter li button').on('click',function(){
                var form = {
                    "_token": "{{ csrf_token() }}",
                    "convert": $(this).attr('id'),
                };
                $.ajax({
                    url: "/send-convert",
                    type: "post",
                    data: form,
                    success: function (data) {
                        if(data[0] == 'successDiscount'){
                            $.toast({
                                text: score_convert1, // Text that is to be shown in the toast
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
                        }
                        if(data[0] == 'successPrice'){
                            $.toast({
                                text: score_convert1, // Text that is to be shown in the toast
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
                        }
                        if(data[0] == 'no'){
                            $.toast({
                                text: score_fail1, // Text that is to be shown in the toast
                                heading: fail1, // Optional heading to be shown on the toast
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
                    },
                });
            })
        })
    </script>
@endsection
