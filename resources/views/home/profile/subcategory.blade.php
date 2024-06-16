@extends('home.master')

@section('title' , __('messages.sub1') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 6])
        <div class="profileIndexTicket">
            <div class="referralCode">
                <span>{{__('messages.sub2')}} :</span>
                <h5>{{url('login')}}?referral={{auth()->user()->referral}}</h5>
            </div>
            <div class="containerSub">
                <h6>{{__('messages.sub3')}}</h6>
                @if(count($referralUser) >= 1)
                    <table>
                        <tr>
                            <th>{{__('messages.user_name')}}</th>
                            <th>{{__('messages.identification_code')}}</th>
                            <th>{{__('messages.order_created')}}</th>
                        </tr>
                        @foreach($referralUser as $item)
                            <tr>
                                <td>
                                    <span>{{$item->name}}</span>
                                </td>
                                <td>
                                    <span>{{auth()->user()->parent_id}}</span>
                                </td>
                                <td>
                                    <span>{{auth()->user()->created_at}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4 class="emptyUser">{{__('messages.id11')}}</h4>
                @endif
            </div>
            <div class="containerSub">
                <h6>{{__('messages.sub4')}}</h6>
                @if(count($users) >= 1)
                    <table>
                        <tr>
                            <th>{{__('messages.user_name')}}</th>
                            <th>{{__('messages.my_profit')}}</th>
                            <th>{{__('messages.order_created')}}</th>
                        </tr>
                        @foreach($users as $item)
                            <tr>
                                <td>
                                    <span>{{$item->name}}</span>
                                </td>
                                <td>
                                    <span>{{number_format($item->cooperation_count)}} {{__('messages.arz')}} </span>
                                </td>
                                <td>
                                    <span>{{$item->created_at}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h4 class="emptyUser">{{__('messages.no_sub')}}</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
