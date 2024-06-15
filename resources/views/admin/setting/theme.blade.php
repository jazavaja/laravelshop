@extends('admin.master')

@section('tab',4)

@section('content')
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/theme">تغییر دمو و رنگ</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <form method="post" action="/admin/setting/theme" class="settingMangeItems">
            @csrf
            <div class="settingItem">
                <label for="">تغییر ویجت دمو</label>
                <select name="demo">
                    <option value="0" selected>انتخاب در صورت نیاز</option>
                    <option value="1">کلاسیک 1</option>
                    <option value="2">کلاسیک 2</option>
                    <option value="3">کلاسیک 3</option>
                    <option value="4">کلاسیک 4</option>
                </select>
            </div>
            <h3>حالت روشن</h3>
            <div class="settingItemPage">
                <div class="settingItem">
                    <label for="">رنگ پیشفرض (سبز)</label>
                    <input type="color" name="greenColorLight" value="{{$greenColorLight}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پیشفرض دوم(قرمز)</label>
                    <input type="color" name="redColorLight" value="{{$redColorLight}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه سایت</label>
                    <input type="color" name="backColorLight1" value="{{$backColorLight1}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت</label>
                    <input type="color" name="headerColorLight" value="{{$headerColorLight}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت 2</label>
                    <input type="color" name="headerColor2Light" value="{{$headerColor2Light}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه ویجت</label>
                    <input type="color" name="widgetColorLight" value="{{$widgetColorLight}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ باکس صفحه معرفی محصول</label>
                    <input type="color" name="singleColorLight" value="{{$singleColorLight}}">
                </div>
            </div>
            <h3>حالت دارک</h3>
            <div class="settingItemPage">
                <div class="settingItem">
                    <label for="">رنگ پیشفرض (سبز)</label>
                    <input type="color" name="greenColorDark" value="{{$greenColorDark}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پیشفرض دوم(قرمز)</label>
                    <input type="color" name="redColorDark" value="{{$redColorDark}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه سایت</label>
                    <input type="color" name="backColorDark1" value="{{$backColorDark1}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت</label>
                    <input type="color" name="headerColorDark" value="{{$headerColorDark}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ هدر سایت 2</label>
                    <input type="color" name="headerColor2Dark" value="{{$headerColor2Dark}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ پس زمینه ویجت</label>
                    <input type="color" name="widgetColorDark" value="{{$widgetColorDark}}">
                </div>
                <div class="settingItem">
                    <label for="">رنگ باکس صفحه معرفی محصول</label>
                    <input type="color" name="singleColorDark" value="{{$singleColorDark}}">
                </div>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
@endsection
