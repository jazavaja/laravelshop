<div class="allNewsIndex width">
    <div class="title">
        <h3>{{$data['title']}}</h3>
        <a href="/blogs">{{__('messages.show_all')}}</a>
    </div>
    <ul>
        @foreach ($data['post'] as $item)
            <li>
                <a href="/blog/{{$item['slug']}}" title="{{$item->titleSeo}}">
                    <article>
                        <figure class="pic">
                            <img lazy="loading" class="lazyload" src="/img/404Image.png" data-src="{{$item['image']}}" alt="{{$item['imageAlt']}}">
                        </figure>
                        <h4>{{$item['title']}}</h4>
                    </article>
                </a>
            </li>
        @endforeach
    </ul>
</div>
