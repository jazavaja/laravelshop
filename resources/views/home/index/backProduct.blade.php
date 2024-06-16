<div class="allBackProduct">
    <div class="allBackProductBlocks" style="background-image: url({{$data['background2']}})">
        <div class="allBackProductBlock width">
            <div class="allBackProductTitle">
                <h3>{{ $data['title'] }}</h3>
                <a href="/archive/{{ $data['slug'] }}">{{ $data['more'] }}</a>
            </div>
            <div class="slider-backProduct move-backProduct{{$data['move']}} owl-carousel owl-theme">
                @foreach ($data['post'] as $item)
                    <div>
                        <a href="/product/{{$item->slug}}">
                            <article>
                                <div class="pic">
                                    @if($item->image != '[]')
                                        <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                                        @if(count(json_decode($item->image)) >= 2)
                                            <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[1]}}" alt="{{$item->imageAlt}}">
                                        @else
                                            <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                                        @endif
                                    @endif
                                </div>
                                <div class="postTitle">{{$item->title}}</div>
                                @if($item->count >= 1)
                                    <div class="postPrice">
                                        @if($item->off >= 1)
                                            <s>{{number_format($item->offPrice)}}{{__('messages.arz')}}</s>
                                        @endif
                                        <h3>
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
                                            <span>{{__('messages.arz')}}</span>
                                        </h3>
                                    </div>
                                @else
                                    <div class="checkCount">
                                        <span>{{__('messages.unavailable1')}}</span>
                                    </div>
                                @endif
                            </article>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
