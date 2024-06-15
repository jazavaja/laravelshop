@extends('home.master')

@section('title' , __('messages.seller') . ' - ')
@section('content')
    <div class="allBecomeSeller width">
        <div class="allBecomeSellerTop">
            <div class="allBecomeSellerLevels">
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status1')}}">
                    <div class="allBecomeSellerLevelBarActive"></div>
                    <div class="allBecomeSellerLevelCircleActives">
                        <svg class="icon">
                            <use xlink:href="#contact-info"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status2')}}">
                    <div class="allBecomeSellerLevelBarActive"></div>
                    <div class="allBecomeSellerLevelCircleActives">
                        <svg class="icon">
                            <use xlink:href="#uploadDocuments"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status3')}}">
                    <div class="allBecomeSellerLevelBarActive"></div>
                    <div class="allBecomeSellerLevelCircleActive">
                        <svg class="icon">
                            <use xlink:href="#checkDocuments"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status4')}}">
                    <div class="allBecomeSellerLevelCircleActives">
                        <svg class="icon">
                            <use xlink:href="#welcomeSeller"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @if (\Session::has('success'))
            <div class="success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="welcomeSeller">
            <i>
                <svg class="icon">
                    <use xlink:href="#online-shop"></use>
                </svg>
            </i>
            <h2>{{__('messages.seller_ok1')}}</h2>
            <h3>{{__('messages.seller_ok2')}}</h3>
            <p>{{__('messages.seller_ok3')}}</p>
            <div class="nextButton">
                <a href="/seller/product/">{{__('messages.all_product')}}</a>
                <a href="/seller/product/create">{{__('messages.add_product')}}</a>
                <a href="/seller/pay">{{__('messages.all_order')}}</a>
            </div>
        </div>
    </div>
@endsection

