<div class="collectionIndex width">
    <div class="collectionTitle">
        <h3>{{$data['title']}}</h3>
    </div>
    <div class="slider-collectionIndex owl-carousel owl-theme">
        @foreach ($data['post'] as $item)
            <div class="collectionItems">
                <a class="collectionItem" href="/pack/{{$item['slug']}}" title="{{$item['titleSeo']}}" name="{{$item['title']}}">
                    <article>
                        <div class="topCollect">{{$item['title']}}</div>
                        <div class="offPrice">{{$item['off']}}</div>
                        <div class="collectProducts">
                            @foreach ($item['product'] as $value)
                                <a href="/product/{{$value->slug}}" class="collectProduct">
                                    <figure class="pic">
                                        @if($value->image != '[]')
                                            <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="{{json_decode($value->image)[0]}}" alt="{{$value->imageAlt}}">
                                        @endif
                                    </figure>
                                    <h4>{{$value->title}}</h4>
                                </a>
                            @endforeach
                        </div>
                        <div class="botCollect">
                            <h5>{{number_format($item['price'])}} {{__('messages.arz')}} </h5>
                            <a class="collectionItem" href="/pack/{{$item['slug']}}">
                                {{__('messages.show_all')}}
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </a>
                        </div>
                    </article>
                </a>
            </div>
        @endforeach
    </div>
</div>
