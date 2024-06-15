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
                <a href="/admin/pack/{{$packs->id}}/show">پک</a>
            </div>
        </div>
        <div class="showData">
            <div class="showDataItems">
                <div class="showDataItem">
                    <h3>آیدی</h3>
                    <h4>{{$packs->id}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>عنوان</h3>
                    <h4>{{$packs->title}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>ماه</h3>
                    <h4>{{$packs->month}}</h4>
                </div>
                <div class="showDataItem">
                    <h3>تعداد</h3>
                    <h4>{{$packs->count}}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection()
