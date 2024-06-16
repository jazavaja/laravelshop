<div class="advanceProduct width" >
    <div class="title">{{__('messages.products')}}</div>
    <div class="slider-advance{{$data['move']}} owl-carousel owl-theme">
        @foreach ($data['post'] as $item)
            <a href="/product/{{$item->slug}}" class="advanceProductItem">
                <div class="top">
                    <div class="advanceLeft">
                        <figure class="pic">
                            @if($item->image != '[]')
                                <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                            @endif
                        </figure>
                    </div>
                    <div class="advanceRight">
                        <h3>{{$item->title}}</h3>
                        <p>{{$item->short}}</p>
                        <div class="advanceOptions">
                            <div class="productStatus">
                                <span>{{__('messages.count1')}} :</span>
                                @if($item->count >= 1)
                                    <span class="active">{{__('messages.available')}}</span>
                                @else
                                    <span class="unActive">{{__('messages.unavailable')}}</span>
                                @endif
                            </div>
                            <div class="starProduct">
                                <svg class="icon">
                                    <use xlink:href="#star"></use>
                                </svg>
                                <span>{{__('messages.score')}} :</span>
                                @if($item->rates_count)
                                    <span>{{$item->rates_count}}</span>
                                @else
                                    <span>0</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bot">
                    <div class="options">
                        @if($item->inquiry == 0)
                            <div class="optionItem" name="quickBuy" title="{{__('messages.buy_fast')}}" id="{{$item->id}}">
                                <svg class="icon">
                                    <use xlink:href="#time-fast"></use>
                                </svg>
                            </div>
                        @endif
                        <div class="optionItem" name="addCart" title="{{__('messages.add_cart')}}" id="{{$item->id}}">
                            <svg class="icon">
                                <use xlink:href="#add-cart"></use>
                            </svg>
                        </div>
                        <div class="optionItem" name="counselingBtn" title="{{__('messages.counseling_fast')}}" data="{{$item->title}}" id="{{$item->id}}">
                            <svg class="icon">
                                <use xlink:href="#counseling"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="price">
                        @if($item->off)
                            <div class="off">
                                <s>{{number_format($item->offPrice)}}</s>
                                <div class="offData">%{{$item->off}}</div>
                            </div>
                        @endif
                        <h5>{{number_format($item->price)}} {{__('messages.arz')}}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
