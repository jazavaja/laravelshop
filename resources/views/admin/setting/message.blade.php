@extends('admin.master')

@section('tab',4)

@section('content')
    <div class="allManageSetting">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/setting/message">تنظیمات پیامک</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <form method="post" action="/admin/setting/message" class="settingMangeItems">
            @csrf
            <div class="settingItem">
                <label for="">کد پترن برای ثبتنام (یک متغیر : متغیر اول کد یکبار مصرف)</label>
                <input type="text" name="messageAuth" value="{{$messageAuth}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن ثبت سفارش (دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageSuccess" value="{{$messageSuccess}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن اطلاع از فروش ویژه(دو متغیر : متغیر اول نام کاربر و متغیر دوم نام محصول)</label>
                <input type="text" name="messageSuggest" value="{{$messageSuggest}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن لغو سفارش(دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageCancel" value="{{$messageCancel}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن بازگشت پول(سه متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش و متغیر سوم مبلغ)</label>
                <input type="text" name="messageBack" value="{{$messageBack}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن اطلاع به مدیر از ثبت سفارش(سه متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش و متغیر سوم مبلغ)</label>
                <input type="text" name="messageManager" value="{{$messageManager}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت در انتظار بررسی(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus0" value="{{$messageStatus0}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت بسته بندی شده(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus1" value="{{$messageStatus1}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت تحویل پیک(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus2" value="{{$messageStatus2}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن تغییر وضعیت تکمیل شده(دو متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش)</label>
                <input type="text" name="messageStatus3" value="{{$messageStatus3}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن مشاوره فوری(دو متغیر : متغیر اول شماره تماس و متغیر دوم عنوان محصول)</label>
                <input type="text" name="messageCounseling" value="{{$messageCounseling}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن خوش آمدگویی(یک متغیر : متغیر اول نام کاربر)</label>
                <input type="text" name="messageRegister" value="{{$messageRegister}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">کد پترن ارسال کد رهگیری(دو متغیر : متغیر اول نام کاربر و متغیر دوم کد رهگیری)</label>
                <input type="text" name="messageTrack" value="{{$messageTrack}}" placeholder="مثال : 2222">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری ملی پیامک</label>
                <input type="text" name="userSms" value="{{$userSms}}" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور ملی پیامک</label>
                <input type="text" name="passSms" value="{{$passSms}}" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">کلید کاوه نگار</label>
                <input type="text" name="kaveKey" value="{{$kaveKey}}" placeholder="API Key">
            </div>
            <div class="settingItem">
                <label for="">نام کاربری فراز</label>
                <input type="text" name="userFaraz" value="{{$userFaraz}}" placeholder="نام کاربری">
            </div>
            <div class="settingItem">
                <label for="">رمز عبور فراز</label>
                <input type="text" name="passFaraz" value="{{$passFaraz}}" placeholder="رمز عبور">
            </div>
            <div class="settingItem">
                <label for="">شماره تماس فراز</label>
                <input type="text" name="numberFaraz" value="{{$numberFaraz}}" placeholder="شماره">
            </div>
            <div class="settingItem">
                <label for="">سامانه پیامکی شما</label>
                <select name="typeSms">
                    <option value="0">قاصدک</option>
                    <option value="1">ملی پیامک</option>
                    <option value="2">کاوه نگار</option>
                    <option value="3">فراز اس ام اس</option>
                </select>
            </div>
            <button>ثبت اطلاعات</button>
        </form>
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var typeSms = {!! json_encode($typeSms, JSON_HEX_TAG) !!};
            $("select[name='typeSms']").val(typeSms);
        })
    </script>
@endsection
