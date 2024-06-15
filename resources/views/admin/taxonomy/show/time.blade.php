@extends('admin.master')

@section('tab',2)

@section('content')
    <div class="allShowBrand">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a>تاکسونامی</a>
                <span>/</span>
                <a href="/admin/time/{{$times->id}}/show">زمان</a>
            </div>
        </div>
        <div class="showData">
            <div class="showDataItems">
                <div class="showDataItem">
                    <h3>آیدی</h3>
                    <h4>{{$times->id}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>عنوان</h3>
                    <h4>{{$times->name}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>بازه زمانی ارسال (روز)</h3>
                    <h4>{{$times->day}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>از چه ساعت</h3>
                    <h4>{{$times->from}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>تا چه ساعت</h3>
                    <h4>{{$times->to}}</h4>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>آیدی</th>
                <th>تصویر</th>
                <th>عنوان</th>
                <th>مبلغ</th>
                <th>تعداد موجود</th>
            </tr>
            @foreach($times->product as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>
                        <div class="pic">
                            @if($item->image != '[]')
                                <img src="{{json_decode($item->image)[0]}}" alt="{{$item->title}}">
                            @endif
                        </div>
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{number_format($item->price)}} تومان </td>
                    <td>{{$item->count}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection()
