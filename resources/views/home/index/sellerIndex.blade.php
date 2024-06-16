<section class="sellerIndex width">
    <h3>{{$data['title']}}</h3>
    <p>{{__('messages.show_seller_page')}}</p>
    <div class="slider-sellers owl-carousel owl-theme">
        @foreach ($sellers as $item)
            <article>
                <a href="/mall/{{$item->slug}}" class="sellerIndexItem">
                    <div class="right">
                        @if($item->profile)
                            <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="{{$item->profile}}" alt="{{$item->name}}">
                        @else
                            <img lazy="loading" src="/img/user.png" alt="{{$item->name}}">
                        @endif
                        <span>{{number_format($item->product_count)}}</span>
                    </div>
                    <div class="left">
                        <h4>{{$item->name}}</h4>
                        @if(count($item->category) >= 1)
                            <h5>{{$item->category[0]->name}}</h5>
                        @else
                            <h5>-</h5>
                        @endif
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>
