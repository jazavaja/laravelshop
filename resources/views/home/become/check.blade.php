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
                    <div class="allBecomeSellerLevelBar"></div>
                    <div class="allBecomeSellerLevelCircleActive">
                        <svg class="icon">
                            <use xlink:href="#checkDocuments"></use>
                        </svg>
                    </div>
                </div>
                <div class="allBecomeSellerLevel" title="{{__('messages.seller_status4')}}">
                    <div class="allBecomeSellerLevelCircle">
                        <svg class="icon">
                            <use xlink:href="#welcomeSeller"></use>
                        </svg>
                    </div>
                </div>
            </div>
            <h4>{{__('messages.seller_doc')}}</h4>
            <p>{{__('messages.seller_doc2')}}</p>
        </div>
        @if (\Session::has('success'))
            <div class="success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="checkUploaded">
            <h3>{{__('messages.seller_doc_status')}}</h3>
            <table>
                <tr>
                    <th>{{__('messages.seller_front')}}</th>
                    <th>{{__('messages.seller_back')}}</th>
                    <th>{{__('messages.seller_doc_status1')}}</th>
                    <th>{{__('messages.seller_created')}}</th>
                </tr>
                @foreach ($documents as $item)
                    <tr>
                        <td>
                                <span>
                                    <img src="{{$item->frontNaturalId}}" alt="{{__('messages.seller_front')}}">
                                </span>
                        </td>
                        <td>
                                <span>
                                    <img src="{{$item->backNaturalId}}" alt="{{__('messages.seller_back')}}">
                                </span>
                        </td>
                        <td>
                            @if($item->status == 0)
                                <span>{{__('messages.seller_wait')}}</span>
                            @endif
                            @if($item->status == 1)
                                <span class="unActive">{{__('messages.seller_reject')}}</span>
                            @endif
                            @if($item->status == 2)
                                <span class="activeStatus">{{__('messages.seller_accept')}}</span>
                            @endif
                        </td>
                        <td>
                            <span>{{$item->created_at}}</span>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
