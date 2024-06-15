<div class="allSliderIndex2 width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
        <a href="/archive/{{$data['slug']}}">{{$data['more']}}</a>
    </div>
    <div class="slider-products move-products{{$data['move']}} owl-carousel owl-theme">
        @foreach ($data['post'] as $item)
            <div>
                <a href="/product/{{$item->slug}}" title="{{$item->titleSeo}}" name="{{$item->title}}">
                    <article>
                        <figure class="pic">
                            @if($item->image != '[]')
                                <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                                @if(count(json_decode($item->image)) >= 2)
                                    <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[1]}}" alt="{{$item->imageAlt}}">
                                @else
                                    <img lazy="loading" class="lazyload" style="height:{{$data['height']}}rem" src="/img/404Image.png" data-src="{{json_decode($item->image)[0]}}" alt="{{$item->imageAlt}}">
                                @endif
                            @endif
                        </figure>
                        <h3>{{$item->title}}</h3>
                        @if($item->count >= 1)
                            <div class="prices">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                </i>
                                <div class="price">
                                    @if($item->off >= 1)
                                        <div class="offPrice">
                                            <s>{{number_format($item->offPrice)}}</s>
                                            <span>%{{$item->off}}</span>
                                        </div>
                                    @endif
                                    <h5>{{number_format($item->price)}} {{__('messages.arz')}}</h5>
                                </div>
                            </div>
                            <div class="addCartSlide">
                                <div class="showAddData">
                                    <div class="adds" data-max="{{$item->maxCart}}" data-min="{{$item->minCart}}" data-count="{{$item->count}}">
                                        <button class="minus">-</button>
                                        <span class="cartWant">{{$item->minCart}}</span>
                                        <button class="add">+</button>
                                    </div>
                                    <div class="addData" data-id="{{$item->id}}">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#cart"></use>
                                            </svg>
                                        </i>
                                        <span class="textCart">
                                            {{__('messages.add_cart')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($item->count <= 0 && $item->prebuy == 0)
                            <div class="emptyProduct"></div>
                        @endif
                        @if($item->count <= 0 && $item->prebuy == 1)
                            <div class="preProduct"></div>
                        @endif
                    </article>
                </a>
            </div>
        @endforeach
    </div>
</div>
