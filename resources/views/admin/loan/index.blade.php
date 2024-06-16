@extends('admin.master')

@section('tab' , 26)
@section('content')
    <div class="profileIndexTicket">
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <table>
            <tr>
                <th>مبلغ وام</th>
                <th>بازپرداخت</th>
                <th>تعداد ماه</th>
                <th>درصد سود</th>
                <th>وضعیت</th>
                <th>کاربر</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            @foreach($loans as $item)
                <tr>
                    <td>
                        <span>{{number_format($item->amount)}} تومان</span>
                    </td>
                    <td>
                        <span>{{number_format($item->refund)}} تومان</span>
                    </td>
                    <td>
                        <span>{{$item->month}}</span>
                    </td>
                    <td>
                        <span>{{$item->percent}}</span>
                    </td>
                    <td>
                        @if($item->status == 1)
                            <span>در حال بررسی</span>
                        @elseif($item->status == 2)
                            <span>تایید شده</span>
                        @else
                            <span>رد شده</span>
                        @endif
                    </td>
                    <td>
                        @if($item->user)
                        <span>{{$item->user->name}}</span>
                        @else
                            <span>کاربر حذف شده</span>
                        @endif
                    </td>
                    <td>
                        <span>{{$item->created_at}}</span>
                    </td>
                    <td>
                        <div class="buttons">
                            <button id="{{$item->id}}" class="editButton">ویرایش</button>
                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف وام مطمئن هستید؟</div>
                <p>با حذف وام اطلاعات وام به طور کامل حذف میشوند</p>
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
                    <h4>مبلغ وام :</h4>
                    <input type="text" name="amount">
                </div>
                <div class="itemsTicket">
                    <h4>بازپرداخت :</h4>
                    <input type="text" name="refund">
                </div>
                <div class="itemsTicket">
                    <h4>اقساط ماهیانه :</h4>
                    <input type="text" name="monthProfit">
                </div>
                <div class="itemsTicket">
                    <h4>تعداد ماه :</h4>
                    <input type="text" name="month">
                </div>
                <div class="itemsTicket">
                    <h4>درصد سود :</h4>
                    <input type="text" name="percent">
                </div>
                <div class="itemsStatus">
                    <h4>وضعیت :</h4>
                    <select name="status">
                        <option value="0">رد شده</option>
                        <option value="1">در حال بررسی</option>
                        <option value="2">تایید شده</option>
                    </select>
                </div>
                <p>بعد از تغییر وضعیت به تایید شده مبلغ به کیف پول کاربر منتقل میشود</p>
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
                $('.buttonsPop form').attr('action' , '/admin/loan/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                $('.showTicket').show(100);
                $('.showTicket form').attr('action' , '/admin/loan/' + this.id+'/edit');
                var form = {
                    "_token": "{{ csrf_token() }}",
                    loan:this.id,
                };
                $.ajax({
                    url: "/admin/get-loan",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $(".showTicket .itemsTicket input[name='amount']").val(data.amount)
                        $(".showTicket .itemsTicket input[name='refund']").val(data.refund)
                        $(".showTicket .itemsTicket input[name='month']").val(data.month)
                        $(".showTicket .itemsTicket input[name='percent']").val(data.percent)
                        $(".showTicket .itemsTicket input[name='monthProfit']").val(data.monthProfit)
                        $(".showTicket .itemsStatus select[name='status']").val(data.status)
                    },
                });
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
