<div class="digiProductItems" style="background-image: url({{$data['background2']}})">
    <div class="width">
        @foreach($data['post'] as $item)
            <a class="item" href="/product/{{$item->slug}}" style="background-image: url({{$item->category()->pluck('image')->first()}})">
                <div class="itemOver">
                    <div class="itemOverPic">
                        <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                    </div>
                    <div class="itemOverSubject">
                        <div class="subData">
                            <div class="itemOverTitle">{{$item->title}}</div>
                            <div class="itemOverOptions">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#dollar1"></use>
                                    </svg>
                                </i>
                                <span>
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
                                </span>
                            </div>
                            <div class="itemOverOptions">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#box"></use>
                                    </svg>
                                </i>
                                @if($item->count >= 1)
                                    <span>{{__('messages.available')}}</span>
                                @else
                                    <span>{{__('messages.unavailable')}}</span>
                                @endif
                            </div>
                            <div class="itemOverOptions">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#tag"></use>
                                    </svg>
                                </i>
                                <span>{{$item->category()->pluck('name')->first()}}</span>
                            </div>
                        </div>
                        <div class="itemOverAbility options">
                            <div class="optionItem" name="quickBuy" title="{{__('messages.buy_fast')}}" id="{{$item->id}}">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#time-fast"></use>
                                    </svg>
                                </i>
                                <span>{{__('messages.buy_fast')}}</span>
                            </div>
                            <div class="optionItem" name="compareBtn" title="{{__('messages.compare')}}" id="{{$item->product_id}}">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#chart"></use>
                                    </svg>
                                </i>
                                <span>{{__('messages.compare')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
