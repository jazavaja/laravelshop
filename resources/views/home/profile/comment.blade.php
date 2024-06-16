@extends('home.master')

@section('title' , __('messages.comments') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 4])
        <div class="allProduct">
            <table>
                <tr>
                    <th>{{__('messages.id1')}}</th>
                    <th>{{__('messages.picture1')}}</th>
                    <th>{{__('messages.title1')}}</th>
                    <th>{{__('messages.order_created')}}</th>
                    <th>{{__('messages.status')}}</th>
                </tr>
                @foreach($comments as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            <div class="pic">
                                @if($item->product)
                                    @if($item->product->image != '[]')
                                        <img src="{{json_decode($item->product->image)[0]}}" alt="{{$item->product->titleSeo}}">
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at}}</td>
                        @if($item->status == 1)
                            <td>{{__('messages.order_status5')}}</td>
                        @else
                            <td>{{__('messages.seller_accept')}}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
