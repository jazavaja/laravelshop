@extends('home.master')

@section('title' , $packs->title .' - ')
@section('content')
    <main class="allPackSingle">
        <div class="allPackSingleTop">
            <div class="allPackSingleTopBlock">
                <h1>{{$packs->title}}</h1>
                <p>{{__('messages.pack_body')}}</p>
            </div>
        </div>
        <div class="allPackSingleTopBlockInfo width">
            @if($packs->count >= 1)
                <div class="allPackSingleTopBlockInfoItem">
                    <button class="addCollect" id="{{$packs->id}}">{{__('messages.add_cart')}}</button>
                    <h3>
                        {{number_format($packs->price)}}
                        <span>{{__('messages.arz')}}</span>
                    </h3>
                </div>
            @else
                <div class="allPackSingleTopBlockInfoItem">
                    <h3>{{__('messages.unavailable1')}}</h3>
                </div>
            @endif
            <h4>
                <svg-icon :icon="'#product'"></svg-icon>
                {{__('messages.count')}} : {{count($packs->product)}}
            </h4>
        </div>
        <div class="allPackSinglePosts width">
            @foreach($packs->product as $item)
                <div class="allPackSinglePost">
                    <a href="/product/{{$item->slug}}">
                        <article class="allHoopersPost">
                            @if($item->off)
                            <div class="offProduct">
                                <div class="offProductItem">
                                    <svg class="icon">
                                        <use xlink:href="#off-tag"></use>
                                    </svg>
                                    <div>
                                        <span>٪{{$item->off}}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="allHoopersPostPic">
                                <img src="{{json_decode($item->image)[0]}}" alt="{{$item->title}}">
                            </div>
                            <h3>{{$item->title}}</h3>
                            <div class="allHoopersPostData">
                                <h4>
                                    <svg class="icon">
                                        <use xlink:href="#info"></use>
                                    </svg>
                                    <span>{{__('messages.detail')}}</span>
                                </h4>
                                <div class="allHoopersPostDataPrice">
                                    <h6>{{__('messages.arz')}}</h6>
                                    <h5>{{number_format($item->price)}}</h5>
                                </div>
                            </div>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection

@section('jsScript')
    @include('feed::links')
@endsection
