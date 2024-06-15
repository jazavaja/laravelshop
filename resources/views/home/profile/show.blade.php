@extends('home.master')

@section('title' , __('messages.detail_order') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 1])
        <div class="allShowPay">
            <div class="topShowPay">
                <div class="title">
                    <h1>{{__('messages.detail_order')}}</h1>
                    <span>{{$pays->created_at}}</span>
                    <div>
                            <span>
                                <a href="/invoice/{{$pays->property}}" target="_blank">{{__('messages.invoice1')}}</a>
                            </span>
                    </div>
                </div>
                <div class="detail">
                    <div class="topDetail">
                        <div class="items">
                            @if(count($pays->address) >= 1)
                                <div class="item">
                                    <h5>{{__('messages.buyer_name')}} :</h5>
                                    <div>{{$pays->address[0]->name}}</div>
                                </div>
                                <div class="item">
                                    <h5>{{__('messages.buyer_number')}} :</h5>
                                    <div>{{$pays->address[0]->number}}</div>
                                </div>
                                <div class="item">
                                    <h5>{{__('messages.seller_post')}} :</h5>
                                    <div>{{$pays->address[0]->post}}</div>
                                </div>
                            @endif
                            @if($pays->method != 6)
                                <div class="item">
                                    <h5>{{__('messages.buyer_carrier_type')}} :</h5>
                                    <div>{{$pays->carrier}}</div>
                                </div>
                                <div class="item">
                                    <h5>{{__('messages.buyer_carrier_price')}} :</h5>
                                    <div>{{number_format($pays->carrier_price)}} {{__('messages.arz')}} </div>
                                </div>
                                @if($pays->time)
                                    <div class="item">
                                        <h5>{{__('messages.buyer_time')}} :</h5>
                                        <div>
                                            <span>{{__('messages.period_cart')}}</span>
                                            <span>{{json_decode($pays->time)->from}}:00</span>
                                            <span>-</span>
                                            <span>{{json_decode($pays->time)->to}}:00</span>
                                            <span>---></span>
                                            <span>{{json_decode($pays->time)->day}} / </span>
                                            <span>{{json_decode($pays->time)->month}}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(count($pays->address) >= 1)
                            <div class="items">
                                <div class="item">
                                    <h5>{{__('messages.address')}} :</h5>
                                    <div>
                                        {{$pays->address[0]->state}}
                                        -{{$pays->address[0]->city}}
                                        -{{$pays->address[0]->address}}
                                        {{__('messages.buyer_address')}} :
                                        {{$pays->address[0]->plaque}}
                                        {{__('messages.unit_address')}} :
                                        {{$pays->address[0]->unit}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="botDetail">
                        <div class="items">
                            <div class="item">
                                <h5>{{__('messages.order_price')}} :</h5>
                                <div>{{number_format($pays->price)}} {{__('messages.order_price')}}</div>
                            </div>
                            @if($pays->method == 2)
                                <div class="item">
                                    <h5>{{__('messages.buyer_deposit')}} :</h5>
                                    <div>{{number_format($pays->deposit)}} {{__('messages.arz')}}</div>
                                </div>
                            @endif
                            <div class="item">
                                <h5> :{{__('messages.order_install5')}}</h5>
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
                                @if($pays->status == 2)
                                    <span class="unActive">{{__('messages.order_status8')}}</span>
                                @endif
                            </div>
                            @if($pays->method != 6)
                                <div class="item">
                                    <h5>{{__('messages.order_deliver')}} :</h5>
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
                            @endif
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
                                @if($pays->method == 4)
                                    <div>{{__('messages.order_method4')}}</div>
                                @endif
                                @if($pays->method == 5)
                                    <div>{{__('messages.order_method5')}}</div>
                                @endif
                                @if($pays->method == 6)
                                    <div>{{__('messages.order_method6')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if($pays->method != 6)
                    <div class="trackPay">
                        <span>{{__('messages.order_track1')}}</span>
                        <p>{{$pays->track}}</p>
                    </div>
                    @else
                    <div class="trackPay">
                        <span>{{__('messages.order_track1')}}</span>
                        <p>{{__('messages.order_track2')}}</p>
                    </div>
                @endif
                @if($pays->note)
                    <div class="trackPay">
                        <span>{{__('messages.my_note1')}}</span>
                        <p>{{$pays->note}}</p>
                    </div>
                    @else
                    <div class="trackPay">
                        <span>{{__('messages.my_note')}}</span>
                        <p>{{__('messages.order_track2')}}</p>
                    </div>
                @endif
            </div>
            @if($pays->status != 100 && $pays->status != 50)
                <div class="note">
                    <label>{{__('messages.link_dir')}} :</label>
                    <p>{{url('/fast?order=')}}<span class="link1">{{$pays->property}}</span></p>
                </div>
            @endif
            @if($pays->method != 6)
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
                            <span>{{$pays->property}}</span>
                        </div>
                    </div>
                    @if(count($pays->installments) >= 1)
                        <div class="abilityPost">
                            <div class="abilityTitle">
                                <label>{{__('messages.order_install1')}}</label>
                            </div>
                            <ul class="abilityTable">
                                <li>
                                    <h4>{{__('messages.order_install2')}}</h4>
                                    <h4>{{__('messages.order_install3')}}</h4>
                                    <h4>{{__('messages.order_install4')}}</h4>
                                    <h4>{{__('messages.order_install5')}}</h4>
                                    <h4>{{__('messages.order_install6')}}</h4>
                                </li>
                                @foreach($pays->installments as $item)
                                <li>
                                    <h4>{{$item->title}}</h4>
                                    <h4>{{number_format($item->price)}} {{__('messages.arz')}}</h4>
                                    <h4>{{$item->time}}</h4>
                                    @if($item->status == 1)
                                        <h4 class="activeS">{{__('messages.order_status2')}}</h4>
                                    @else
                                        <h4 class="activeF">{{__('messages.order_status6')}}</h4>
                                    @endif
                                    @if($item->pay)
                                        <h4 class="activeS">{{$item->pay}}</h4>
                                    @else
                                        <h4 class="activeF">-</h4>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="items">
                        <div class="titleProducts">
                            <div class="title">{{__('messages.order_products')}}</div>
                        </div>
                        @foreach($pays->payMeta as $item)
                            <div class="item">
                                @if($item->product)
                                    <a href="/product/{{$item->product->slug}}" class="cartDetailPic">
                                        <img src="{{json_decode($item->product->image)[0]}}" alt="{{$item->product->title}}">
                                    </a>
                                @endif
                                @if($item->collection)
                                    <a href="/pack/{{$item->collection->slug}}" class="cartDetailPic">
                                        <img src="{{$item->collection->image}}" alt="{{$item->collection->title}}">
                                    </a>
                                @endif
                                <div class="cartDetailInfo">
                                    @if($item->product)
                                        <a href="/product/{{$item->product->slug}}" class="cartDetailInfoItem">
                                            <h3>{{$item->product->title}}</h3>
                                            @if($item->cancel)
                                                <span class="cancel">({{__('messages.order_status7')}})</span>
                                            @endif
                                        </a>
                                    @endif
                                    @if($item->collection)
                                        <a href="/pack/{{$item->collection->slug}}" class="cartDetailInfoItem">
                                            <h3>{{$item->collection->title}}</h3>
                                        </a>
                                    @endif
                                    @if($item->color)
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#color"></use>
                                                </svg>
                                            </i>
                                            <span>{{$item->color}}</span>
                                        </div>
                                    @endif
                                    @if($item->size)
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#sizeFront"></use>
                                                </svg>
                                            </i>
                                            <span>{{$item->size}}</span>
                                        </div>
                                    @endif
                                    @if($item->guarantee_name)
                                        <div class="cartDetailInfoItem">
                                            <i>
                                                <svg class="icon">
                                                    <use xlink:href="#security"></use>
                                                </svg>
                                            </i>
                                            <span>{{$item->guarantee_name}}</span>
                                        </div>
                                    @endif
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#post"></use>
                                            </svg>
                                        </i>
                                        <span>{{$item->count}}</span>
                                    </div>
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#cost"></use>
                                            </svg>
                                        </i>
                                        <span>{{number_format($item->price)}} {{__('messages.arz')}}</span>
                                    </div>
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#car"></use>
                                            </svg>
                                        </i>
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
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
