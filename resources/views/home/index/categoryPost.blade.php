<section class="categoryPostIndex width">
    <div class="slider-category-post owl-carousel owl-theme">
        @foreach ($data['post'] as $item)
            <div>
                <div class="productItem">
                    <div class="topProduct">
                        <h3>{{$item['title']}}</h3>
                        <h4>{{__('messages.best_cat')}}</h4>
                    </div>
                    <div class="products">
                        <ul>
                            @foreach ($item['product'] as $product)
                                <li>
                                    <a href="/product/{{$product->slug}}" title="{{$product->titleSeo}}" name="{{$product->title}}">
                                        <figure>
                                            @if($product->image != '[]')
                                                <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="{{json_decode($product->image)[0]}}" alt="{{$product->imageAlt}}">
                                            @endif
                                        </figure>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="botProduct">
                        <a href="/category/{{$item['slug']}}">
                            {{__('messages.show_all')}}
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
