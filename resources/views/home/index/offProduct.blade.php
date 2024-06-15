<section class="allOffProduct width">
    <h3>{{__('messages.best_off')}}</h3>
    <ul>
        @foreach ($data['post'] as $item)
            <li>
                <a href="/product/{{$item->slug}}" title="{{$item->title}}" name="{{$item->title}}">
                    <article>
                        <figure class="pic">
                            @if($item->image != '[]')
                                <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                            @endif
                            @if($item->lotteryStatus == 1)
                                <div class="lotteryStatus">
                                    <svg class="icon">
                                        <use xlink:href="#lotteryShow"></use>
                                    </svg>
                                </div>
                            @endif
                        </figure>
                        @if($item->colors != '[]')
                            <div class="colors">
                                @foreach(json_decode($item->colors) as $value)
                                    <div class="color" style="background-color: {{$value->color}}"></div>
                                @endforeach
                            </div>
                        @endif
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
                            <div class="optionItem" name="compareBtn" title="{{__('messages.compare')}}" id="{{$item->product_id}}">
                                <svg class="icon">
                                    <use xlink:href="#chart"></use>
                                </svg>
                            </div>
                        </div>
                        <h3>{{$item->title}}</h3>
                        <div class="price">
                            @if($item->off)
                                <div class="off">
                                    <s>{{number_format($item->offPrice)}}</s>
                                    <div class="offProduct">
                                        <div class="offProductItem">
                                            <svg class="icon">
                                                <use xlink:href="#off-tag"></use>
                                            </svg>
                                            <div>
                                                <span>%{{$item->off}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h5>
                                @if(auth()->user())
                                    @if(auth()->user()->roles()->whereIn('name' , collect(json_decode($item['levels']))->pluck('name'))->first())
                                        @if($item->levels)
                                            @if($item['levels'] != '[]')
                                                @foreach(json_decode($item['levels']) as $val)
                                                    @if(in_array($val->name, auth()->user()->roles()->pluck('name')->toArray()))
                                                        {{number_format($val->price)}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @else
                                        {{number_format($item->price)}}
                                    @endif
                                @else
                                    {{number_format($item->price)}}
                                @endif
                                {{__('messages.arz')}}
                            </h5>
                        </div>
                    </article>
                </a>
            </li>
        @endforeach
    </ul>
</section>
