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
                <th>کد</th>
                <th>کاربر</th>
                <th>محصول</th>
                <th>شماره سفارش</th>
                <th>زمان ثبت</th>
            </tr>
            @foreach($codes as $item)
                <tr>
                    <td>
                        <span>{{$item->code}}</span>
                    </td>
                    <td>
                        <span>{{$item->user->name}}</span>
                    </td>
                    <td>
                        @if($item->product)
                            <span>{{$item->product->title}}</span>
                        @else
                            <span>نامشخص</span>
                        @endif
                    </td>
                    <td>
                        @if($item->pay)
                            <span>{{$item->pay->property}}</span>
                        @else
                            <span>نامشخص</span>
                        @endif
                    </td>
                    <td>
                        <span>{{$item->created_at}}</span>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
