@extends('seller.master')

@section('tab' , 0)
@section('title' , __('messages.add_pic3') . ' - ')
@section('content')
    <div class="sellerIndex">
        <div class="widgetItems">
            <div class="widgetItem">
                <div class="widgetIcon">
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                </div>
                <div class="widgetSubject">
                    <h4>{{__('messages.all_order_price')}}</h4>
                    <h5>{{number_format($paycount)}} {{__('messages.arz')}}</h5>
                </div>
            </div>
            <div class="widgetItem">
                <div class="widgetIcon">
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </div>
                <div class="widgetSubject">
                    <h4>{{__('messages.all_count_product')}}</h4>
                    <h5>{{$postcount}}</h5>
                </div>
            </div>
            <div class="widgetItem">
                <div class="widgetIcon">
                    <svg class="icon">
                        <use xlink:href="#wallet1"></use>
                    </svg>
                </div>
                <div class="widgetSubject">
                    <h4>{{__('messages.all_payback')}}</h4>
                    <h5>{{number_format($checksum)}} {{__('messages.arz')}}</h5>
                </div>
            </div>
        </div>
        <div class="productItems">
            <div>
                <div class="productItem">
                    <h3>{{__('messages.latest_order')}}</h3>
                    <table>
                        <tr>
                            <th>#</th>
                            <th>{{__('messages.order_property')}}</th>
                            <th>{{__('messages.product')}}</th>
                            <th>{{__('messages.price1')}}</th>
                        </tr>
                        @foreach($pays as $key => $item)
                            <tr>
                                <td>
                                    <span>{{ $key + 1 }}</span>
                                </td>
                                <td>
                                    <span>{{$item->pay->property}}</span>
                                </td>
                                <td>
                                    <span>{{$item->product->title}}</span>
                                </td>
                                <td>
                                    <span>{{number_format($item->price)}} {{__('messages.arz')}} </span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div>
                <div class="productItem">
                    <h3>{{__('messages.latest_product')}}</h3>
                    <table>
                        <tr>
                            <th>#</th>
                            <th>{{__('messages.title1')}}</th>
                            <th>{{__('messages.price1')}}</th>
                        </tr>
                        @foreach($posts as $key => $item)
                            <tr>
                                <td>
                                    <span>{{$key + 1 }}</span>
                                </td>
                                <td>
                                    <span>{{$item->title}}</span>
                                </td>
                                <td>
                                    <span>{{number_format($item->price)}} {{__('messages.arz')}} </span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
