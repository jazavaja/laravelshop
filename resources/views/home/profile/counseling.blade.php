@extends('home.master')

@section('title' , __('messages.counseling') . ' - ')
@section('content')
    <div class="allProfileIndex width">
        @include('home.profile.list' , ['tab' => 6])
        <div class="profileIndexTicket">
            <h1>{{__('messages.counseling')}}</h1>
            @if (\Session::has('message'))
                <div class="alert">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <table>
                <tr>
                    <th>{{__('messages.counseling1')}}</th>
                    <th>{{__('messages.status')}}</th>
                    <th>{{__('messages.order_created')}}</th>
                    <th>{{__('messages.action1')}}</th>
                </tr>
                @foreach($counselings as $item)
                    <tr>
                        <td>
                            <span>{{$item->body}}</span>
                        </td>
                        <td>
                            @if($item->answer)
                                <span>{{__('messages.answered')}}</span>
                            @else
                                <span>{{__('messages.order_status5')}}</span>
                            @endif
                        </td>
                        <td>
                            <span>{{$item->created_at}}</span>
                        </td>
                        <td>
                            <div class="buttons">
                                <input type="hidden" value="{{$item->body}}" name="body" id="{{$item->id}}">
                                <button id="{{$item->id}}" class="editButton">{{__('messages.show_all')}}</button>
                                <input type="hidden" value="{{$item->answer}}" name="answer" id="{{$item->id}}">
                                <button id="{{$item->id}}" class="deleteButton">{{__('messages.delete')}}</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="popUp">
                <div class="popUpItem">
                    <div class="title">{{__('messages.counsel_delete1')}}</div>
                    <p>{{__('messages.counsel_delete2')}}</p>
                    <div class="buttonsPop">
                        <form method="POST" action="" id="deletePost">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">{{__('messages.deleted')}}</button>
                        </form>
                        <button id="cancelDelete">{{__('messages.cancel')}}</button>
                    </div>
                </div>
            </div>
            <div class="showTicket" style="display:none">
                <div class="ticketData">
                    <div class="itemsTicket">
                        <h4>{{__('messages.counseling1')}} :</h4>
                        <p></p>
                    </div>
                    <div class="itemsAnswer">
                        <h4>{{__('messages.answer')}} :</h4>
                        <p></p>
                    </div>
                    <div class="buttonsPop">
                        <button>{{__('messages.close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/profile/counseling/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                $('.showTicket').show(100);
                $('.showTicket .itemsTicket p').text($(this.previousElementSibling).val())
                $('.showTicket .itemsAnswer p').text($(this.nextElementSibling).val())
            })
            $('.showTicket button').on('click' ,function(){
                $('.showTicket').hide(100);
                $('.showTicket .itemsTicket p').text('')
                $('.showTicket .itemsAnswer p').text('')
            })
        })
    </script>
@endsection
