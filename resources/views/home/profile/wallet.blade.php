@extends('home.master')

@section('title' , __('messages.dashboard') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 20])
        <div class="profileIndex">
            <div class="allChargeIndex">
                <div class="chargeWidgets">
                    <div class="WidgetItem">
                        <div class="WidgetIcon">
                            <svg class="icon">
                                <use xlink:href="#successPay"></use>
                            </svg>
                        </div>
                        <div class="WidgetSubject">
                            <h4>{{__('messages.increase_charge_success')}}</h4>
                            <h5>{{number_format($walletsSuccess)}} {{__('messages.dashboard')}} </h5>
                        </div>
                    </div>
                    <div class="WidgetItem">
                        <div class="WidgetIcon">
                            <svg class="icon">
                                <use xlink:href="#failPay"></use>
                            </svg>
                        </div>
                        <div class="WidgetSubject">
                            <h4>{{__('messages.increase_charge_fail')}}</h4>
                            <h5>{{number_format($walletsFail)}} {{__('messages.dashboard')}} </h5>
                        </div>
                    </div>
                    <div class="WidgetItem">
                        <div class="WidgetIcon">
                            <svg class="icon">
                                <use xlink:href="#successPay"></use>
                            </svg>
                        </div>
                        <div class="WidgetSubject">
                            <h4>{{__('messages.charge_success')}}</h4>
                            <h5>{{number_format($walletsIncrease)}} {{__('messages.dashboard')}} </h5>
                        </div>
                    </div>
                    <div class="WidgetItem">
                        <div class="WidgetIcon">
                            <svg class="icon">
                                <use xlink:href="#failPay"></use>
                            </svg>
                        </div>
                        <div class="WidgetSubject">
                            <h4>{{__('messages.charge_fail')}}</h4>
                            <h5>{{number_format($walletsDecrease)}} {{__('messages.dashboard')}} </h5>
                        </div>
                    </div>
                </div>
                <div class="chargePrice">
                    <form class="right" action="/charge/shop" method="get">
                        @csrf
                        <label for="price">{{__('messages.price_arz')}}:</label>
                        <input id="price" type="text" placeholder="{{__('messages.price_arz')}}" name="price">
                        <button>{{__('messages.charge1')}}</button>
                    </form>
                    <div class="left">
                        <h4>{{__('messages.min_charge')}}</h4>
                    </div>
                </div>
                <table>
                    <tr>
                        <th>{{__('messages.order_property')}}</th>
                        <th>{{__('messages.price1')}}</th>
                        <th>{{__('messages.charge_type')}}</th>
                        <th>{{__('messages.order_status')}}</th>
                        <th>{{__('messages.order_created')}}</th>
                    </tr>
                    @foreach($wallets as $item)
                        <tr>
                            <td>
                                <span>{{$item->property}}</span>
                            </td>
                            <td>
                                <span>{{number_format($item->price)}} {{__('messages.arz')}} </span>
                            </td>
                            <td>
                                @if($item->type == 0)
                                {{__('messages.increase_charge')}}
                                @else
                                {{__('messages.decrease_charge')}}
                                @endif
                            </td>
                            <td>
                                @if($item->status == 0)
                                    {{__('messages.order_status6')}}
                                @else
                                    {{__('messages.order_status2')}}
                                @endif
                            </td>
                            <td>
                                <span>{{$item->created_at}}</span>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
