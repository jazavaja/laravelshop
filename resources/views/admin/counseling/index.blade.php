@extends('admin.master')

@section('tab' , 17)
@section('content')
    <div class="profileIndexTicket">
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <table>
            <tr>
                <th>درخواست</th>
                <th>شماره تماس</th>
                <th>محصول</th>
                <th>وضعیت درخواست</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            @foreach($counselings as $item)
                <tr>
                    <td>
                        <span>{{$item->body}}</span>
                    </td>
                    <td>
                        <span>{{$item->number}}</span>
                    </td>
                    <td>
                        @if($item->product)
                            <span>{{$item->product->title}}</span>
                        @else
                            <span>نامشخص</span>
                        @endif
                    </td>
                    <td>
                        @if($item->answer)
                            <span>پاسخ داده شده</span>
                        @else
                            <span>در حال بررسی</span>
                        @endif
                    </td>
                    <td>
                        <span>{{$item->created_at}}</span>
                    </td>
                    <td>
                        <div class="buttons">
                            <input type="hidden" value="{{$item->body}}" name="body" id="{{$item->id}}">
                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                            <input type="hidden" value="{{$item->answer}}" name="answer" id="{{$item->id}}">
                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="popUp">
            <div class="popUpItem">
                <div class="title">آیا از حذف درخواست مطمئن هستید؟</div>
                <p>با حذف درخواست اطلاعات درخواست به طور کامل حذف میشوند</p>
                <div class="buttonsPop">
                    <form method="POST" action="" id="deletePost">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">حذف شود</button>
                    </form>
                    <button id="cancelDelete">منصرف شدم</button>
                </div>
            </div>
        </div>
        <div class="showTicket" style="display:none">
            <form class="ticketData" action="" method="POST">
                @csrf
                <div class="itemsTicket">
                    <h4>درخواست :</h4>
                    <textarea name="body"></textarea>
                </div>
                <div class="itemsAnswer">
                    <h4>پاسخ :</h4>
                    <textarea name="answer"></textarea>
                </div>
                <div class="buttonsPop">
                    <button>ثبت</button>
                    <h5 id="btnCancel">انصراف</h5>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts3')
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
                $('.buttonsPop form').attr('action' , '/admin/counseling/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                $('.showTicket').show(100);
                $('.showTicket form').attr('action' , '/admin/counseling/' + this.id+'/edit');
                $(".showTicket .itemsTicket textarea[name='body']").val($(this.previousElementSibling).val())
                $(".showTicket .itemsAnswer textarea[name='answer']").val($(this.nextElementSibling).val())
            })
            $('.showTicket #btnCancel').on('click' ,function(){
                post = 0;
                $('.showTicket').hide(100);
                $(".showTicket .itemsTicket textarea[name='body']").val('')
                $(".showTicket .itemsAnswer textarea[name='answer']").val('')
            })
        })
    </script>
@endsection
