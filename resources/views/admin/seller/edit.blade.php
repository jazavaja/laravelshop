@extends('admin.master')

@section('tab' , 22)
@section('content')
<div class="createDocumentPanel">
    <form action="/admin/document/{{$documents->id}}/edit" method="post" class="createDocumentPanelItems">
        @csrf
        <div class="allBecomeUserInfo">
            <div class="sellerType">
                <h3>وضعیت اهراز هویت</h3>
                <select name="status">
                    <option value="0">در حال بررسی</option>
                    <option value="1">رد شده</option>
                    <option value="2">تایید شده</option>
                </select>
            </div>
            <div class="sellerType">
                <h3>چه نوع فروشنده ای هستید؟</h3>
                <select name="seller">
                    <option value="0">امکان تغییر مجدد اطلاعات</option>
                    <option value="1">فروشنده حقیقی</option>
                    <option value="2">فروشنده حقوقی</option>
                </select>
            </div>
            <div class="personInfoSeller">
                <h3>اطلاعات فروشنده</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>نام و نام خانوادگی</h4>
                        <input type="text" placeholder="نام و نام خانوادگی" name="firstName">
                    </div>
                    <div class="personInfoItem">
                        <h4>کد ملی</h4>
                        <input type="text" placeholder="کد ملی" name="code">
                    </div>
                    <div class="personInfoItem">
                        <h4>جنسیت</h4>
                        <select name="gender">
                            <option value="0" selected>مرد</option>
                            <option value="1">زن</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="personInfoSeller">
                <h3>اطلاعات شرکت</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>نام شرکت</h4>
                        <input type="text" placeholder="نام شرکت" name="companyName">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>نوع شرکت</h4>
                        <select name="type">
                            <option value="0">سهامی عام</option>
                            <option value="1">سهامی خاص</option>
                            <option value="2">مسئولیت محدود</option>
                            <option value="3">تعاونی</option>
                            <option value="4">تضامنی</option>
                        </select>
                    </div>
                    <div class="personInfoItem">
                        <h4>شماره ثبت</h4>
                        <input type="text" placeholder="شماره ثبت" name="registrationNumber">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>شناسه ملی</h4>
                        <input type="text" placeholder="شناسه ملی" name="nationalID">
                    </div>
                    <div class="personInfoItem">
                        <h4>کد اقتصادی</h4>
                        <input type="text" placeholder="کد اقتصادی" name="economicCode">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>صاحبان حق امضا</h4>
                        <input type="text" placeholder="صاحبان حق امضا" name="signatureOwners">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>آدرس</h4>
                        <input type="text" placeholder="آدرس" name="residenceAddress">
                    </div>
                </div>
            </div>
            <div class="contactSeller">
                <h3>اطلاعات تماس</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>آدرس</h4>
                        <input type="text" placeholder="آدرس" name="residenceAddress">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>کد پستی</h4>
                        <input type="text" placeholder="کد پستی" name="post">
                    </div>
                    <div class="personInfoItem">
                        <h4>آدرس ایمیل</h4>
                        <input type="text" placeholder="آدرس ایمیل" value="{{$documents->user->email}}" name="email">
                    </div>
                </div>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>تلفن ثابت</h4>
                        <input type="text" placeholder="پیش شماره بدون صفر + شماره" value="{{$documents->user->landlinePhone}}" name="landlinePhone">
                    </div>
                    <div class="personInfoItem">
                        <h4>شماره تماس</h4>
                        <input type="text" placeholder="شماره تماس" value="{{$documents->user->number}}" name="number">
                    </div>
                </div>
            </div>
            <div class="contactSeller">
                <h3>اطلاعات تجاری</h3>
                <div class="personInfoItems">
                    <div class="personInfoItem">
                        <h4>نام فروشگاه</h4>
                        <input type="text" placeholder="نام فروشگاه" value="{{$documents->user->name}}" name="name">
                    </div>
                    <div class="personInfoItem">
                        <h4>شماره شبا</h4>
                        <input type="text" placeholder="شماره شبا" name="shaba" value="{{$documents->user->shaba}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="uploadDocument">
            <h3>تصویر کارت ملی</h3>
            <a class="download" href="{{$documents->frontNaturalId}}" download>دانلود تصویر جلو کارت ملی</a>
            <a class="download" href="{{$documents->backNaturalId}}" download>دانلود تصویر پشت کارت ملی</a>
        </div>
        <div class="buttons">
            <button>بروزرسانی</button>
        </div>
    </form>
</div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            var documents = {!! $documents->toJson() !!};
            $("select[name='status']").val(documents.status);
            $("select[name='seller']").val(documents.user.seller);
            if(documents.user.genuine){
                $("select[name='gender']").val(documents.user.genuine.gender);
                $("input[name='residenceAddress']").val(documents.user.genuine.residenceAddress);
                $("input[name='post']").val(documents.user.genuine.post);
                $("input[name='firstName']").val(documents.user.genuine.name);
                $("input[name='code']").val(documents.user.genuine.code);
            }
            if(documents.user.company){
                $("input[name='companyName']").val(documents.user.company.name);
                $("input[name='nationalID']").val(documents.user.company.NationalID);
                $("input[name='economicCode']").val(documents.user.company.economicCode);
                $("input[name='signatureOwners']").val(documents.user.company.signer);
                $("input[name='residenceAddress']").val(documents.user.company.residenceAddress);
                $("select[name='type']").val(documents.user.company.type);
            }
        })
    </script>
@endsection
