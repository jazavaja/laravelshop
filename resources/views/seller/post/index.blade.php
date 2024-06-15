@extends('seller.master')

@section('tab',$tab)
@section('content')
    <div class="myProduct">
        <div class="allTopTable">
            @if($tab == 2)
                <form method="get" action="/seller/product" class="searches">
                    <input type="text" name="title" placeholder="{{__('messages.search_product')}}" value="{{$title}}">
                </form>
            @else
                <form method="get" action="/seller/my-products" class="searches">
                    <input type="text" name="title" placeholder="{{__('messages.search_product')}}" value="{{$title}}">
                </form>
            @endif
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTableContainer">
            @foreach($products as $item)
                <div class="postItem">
                    <div class="postTop">
                        <div class="postPic">
                            @if($item->image != '[]')
                                <img src="{{json_decode($item->image)[0]}}" alt="{{$item->title}}">
                            @else
                                <img src="" alt="{{$item->title}}">
                            @endif
                        </div>
                        <div class="postTitle">
                            <h3>{{$item->title}}</h3>
                        </div>
                        <div class="postOptions">
                            @if($tab == 2)
                                <a href="/seller/add-variety/{{$item->id}}" title="{{__('messages.sell1')}}">
                                    <svg class="icon">
                                        <use xlink:href="#graph"></use>
                                    </svg>
                                    {{__('messages.sell1')}}
                                </a>
                            @else
                                @if($item->status == 1)
                                    @if($item->variety >= 1)
                                        <a href="/seller/variety/{{$item->id}}/edit" title="{{__('messages.edit_product')}}">
                                            <svg class="icon">
                                                <use xlink:href="#edit"></use>
                                            </svg>
                                            {{__('messages.edit_product')}}
                                        </a>
                                    @else
                                        <a href="/seller/product/{{$item->id}}/edit" title="{{__('messages.edit_product')}}">
                                            <svg class="icon">
                                                <use xlink:href="#edit"></use>
                                            </svg>
                                            {{__('messages.edit_product')}}
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>{{__('messages.group')}} :</span>
                                @if(count($item->category) >= 1)
                                    <span>{{$item->category[0]->name}}</span>
                                @else
                                    <span>{{__('messages.no_group')}}</span>
                                @endif
                            </li>
                            <li>
                                <span>{{__('messages.product_price')}} :</span>
                                <span>{{ number_format($item->price) }} {{__('messages.arz')}}</span>
                            </li>
                            <li>
                                <span>{{__('messages.var1')}} :</span>
                                <span>{{ number_format($item->post_count) }}</span>
                            </li>
                            <li>
                                <span>{{__('messages.product_status')}} :</span>
                                @if($item->status == 0)
                                    <span>{{__('messages.status0')}}</span>
                                    @else
                                    <span>{{__('messages.status1')}}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
