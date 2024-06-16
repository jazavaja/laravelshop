@extends('admin.master')

@section('tab' , 23)
@section('content')
    <div class="profileIndexTicket">
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <table>
            <tr>
                <th>عنوان</th>
                <th>تعداد کد</th>
                <th>وضعیت</th>
                <th>زمان ثبت</th>
                <th>عملیات</th>
            </tr>
            @foreach($lotteries as $item)
                <tr>
                    <td>
                        <span>{{$item->title}}</span>
                    </td>
                    <td>
                        <span>{{$item->lottery_code_count}}</span>
                    </td>
                    <td>
                        @if($item->status == 0)
                            <span class="unActive">در حال انجام</span>
                        @else
                            <span class="active">انجام شده</span>
                        @endif
                    </td>
                    <td>
                        <span>{{$item->created_at}}</span>
                    </td>
                    <td>
                        <div class="buttons">
                            <a href="/admin/lottery/{{$item->id}}/edit" class="editButton">ویرایش</a>
                            <button id="{{$item->id}}" class="deleteButton">حذف</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
