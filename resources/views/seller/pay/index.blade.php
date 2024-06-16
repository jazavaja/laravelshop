@extends('seller.master')

@section('tab' , 3)
@section('content')
    <div class="allPayPanel">
        <div class="topProductIndex">
            <div class="right">
                <a href="/seller/dashboard">{{__('messages.dashboard')}}</a>
                <span>/</span>
                @if($delivery === 0)
                    <a href="/seller/pay?delivery=0">{{__('messages.order_deliver1')}}</a>
                @endif
                @if($delivery == 1)
                    <a href="/seller/pay?delivery=1">{{__('messages.order_deliver2')}}</a>
                @endif
                @if($delivery == 2)
                    <a href="/seller/pay?delivery=2">{{__('messages.order_deliver3')}}</a>
                @endif
                @if($delivery == 3)
                    <a href="/seller/pay?delivery=3">{{__('messages.order_deliver4')}}</a>
                @endif
                @if($delivery == 4)
                    <a href="/seller/pay?delivery=4">{{__('messages.order_deliver5')}}</a>
                @endif
                @if($delivery == 5 || !$delivery)
                    <a href="/seller/pay">{{__('messages.all_order1')}}</a>
                @endif
            </div>
            <div class="allTopTableItem">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        {{__('messages.filter_info')}}
                    </div>
                    <form method="GET" action="/seller/pay" class="filterContent">
                        <div class="filterContentItem">
                            <label>{{__('messages.filter_title2')}}</label>
                            <input type="text" name="title" placeholder="{{__('messages.filter_title2')}}" value="{{$title}}">
                        </div>
                        <div class="filterContentItem">
                            <label>{{__('messages.order_deliver')}}</label>
                            <select name="delivery">
                                <option value="5">{{__('messages.all')}}</option>
                                <option value="0">{{__('messages.order_deliver1')}}</option>
                                <option value="1">{{__('messages.order_deliver2')}}</option>
                                <option value="2">{{__('messages.order_deliver3')}}</option>
                                <option value="3">{{__('messages.order_deliver4')}}</option>
                                <option value="4">{{__('messages.order_deliver5')}}</option>
                            </select>
                        </div>
                        <button type="submit">{{__('messages.action')}}</button>
                    </form>
                </div>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTableContainer">
            @foreach ($pays as $item)
                <div class="postItem">
                    <div class="postTop">
                        <div class="postTitle">
                            <div class="postImages">
                                <div class="postImage">
                                    <img src="{{json_decode($item->product->image)[0]}}" alt="{{$item->product->title}}">
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <span>{{__('messages.order_created')}} :</span>
                                    <span>{{$item->created_at}}</span>
                                </li>
                                @if($item->guarantee_name)
                                    <li>
                                        <span>{{__('messages.guarantee')}} :</span>
                                        <span>{{$item->guarantee_name}}</span>
                                    </li>
                                @endif
                                @if($item->size)
                                    <li>
                                        <span>{{__('messages.size')}} :</span>
                                        <span>{{$item->size}}</span>
                                    </li>
                                @endif
                                @if($item->color)
                                    <li>
                                        <span>{{__('messages.color')}} :</span>
                                        <span>{{$item->color}}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="postOptions">
                            <a href="/seller/get-excel/pay?pay={{$item->id}}" title="{{__('messages.get_excel')}}">
                                <svg class="icon">
                                    <use xlink:href="#excel2"></use>
                                </svg>
                            </a>
                            <a href="/seller/pay/{{$item->id}}" title="{{__('messages.edit_order')}}">
                                <svg class="icon">
                                    <use xlink:href="#edit"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>{{__('messages.deliver_type')}} :</span>
                                <span>{{$item->pay->carrier}}</span>
                            </li>
                            <li>
                                <span>{{__('messages.order_price')}} :</span>
                                @if($item->status == 50)
                                    <span>{{ number_format($item->deposit) }} {{__('messages.arz')}}</span>
                                @endif
                                @if($item->status == 100)
                                    <span>{{ number_format($item->price) }} {{__('messages.arz')}}</span>
                                @endif
                                @if($item->status == 1)
                                    <span>0</span>
                                @endif
                                @if($item->status == 20)
                                    <span>{{__('messages.order_status4')}}</span>
                                @endif
                                @if($item->status == 10)
                                    <span>{{__('messages.order_method3')}}</span>
                                @endif
                                @if($item->status == 0)
                                    <span>0</span>
                                @endif
                            </li>
                            <li>
                                <span>{{__('messages.order_property')}} :</span>
                                <span>{{$item->pay->property}}</span>
                            </li>
                            <li>
                                <span>{{__('messages.order_install5')}} :</span>
                                @if($item->status == 100)
                                    <span>{{__('messages.order_status2')}}</span>
                                @endif
                                @if($item->status == 50)
                                    <span>{{__('messages.order_status3')}}</span>
                                @endif
                                @if($item->status == 0)
                                    <span>{{__('messages.order_status6')}}</span>
                                @endif
                                @if($item->status == 20)
                                    <span>{{__('messages.order_status4')}}</span>
                                @endif
                                @if($item->status == 10)
                                    <span>{{__('messages.order_method3')}}</span>
                                @endif
                                @if($item->status == 1)
                                    <span>{{__('messages.order_status7')}}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{__('messages.order_deliver')}} :</span>
                                @if($item->deliver == 0)
                                    <span class="unActive">{{__('messages.order_deliver1')}}</span>
                                @endif
                                @if($item->deliver == 1)
                                    <span class="unActive">{{__('messages.order_deliver2')}}</span>
                                @endif
                                @if($item->deliver == 2)
                                    <span class="unActive">{{__('messages.order_deliver3')}}</span>
                                @endif
                                @if($item->deliver == 3)
                                    <span class="unActive">{{__('messages.order_deliver4')}}</span>
                                @endif
                                @if($item->deliver == 4)
                                    <span class="activeStatus">{{__('messages.order_deliver5')}}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $pays->links('admin.paginate') }}
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var delivery = {!! json_encode($delivery, JSON_HEX_TAG) !!};
            $(".filterContentItem select[name='delivery']").val(delivery)
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
        })
    </script>
@endsection

