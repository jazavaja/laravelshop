@extends('admin.master')

@section('tab',29)
@section('content')
    <div class="allCreatePost">
        <div class="allCreatePost">
            <div class="allPostPanelTop">
                <h1>افزودن صفحه</h1>
                <div class="allPostTitle">
                    <a href="/admin">داشبورد</a>
                    <span>/</span>
                    <a href="/admin/land">همه صفحه ها</a>
                    <span>/</span>
                    <a href="/admin/land/create">افزودن صفحه</a>
                </div>
            </div>
            @if (\Session::has('message'))
                <div class="success">
                    {!! \Session::get('message') !!}
                </div>
            @endif
            <form action="/admin/land/create" method="post" class="allCreatePostData">
                @csrf
                <div class="allCreatePostSubject">
                    <div class="allCreatePostItem">
                        <label>صفحه html خود را قرار دهید :</label>
                        <textarea name="body" style="direction: ltr;text-align: left"></textarea>
                        @error('html')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="button" name="createPost" type="submit">ارسال اطلاعات</button>
                </div>
                <div class="allCreatePostDetails">
                    <div class="allCreatePostDetail">
                        <div class="allCreatePostDetailItemsTitle">
                            جزییات
                        </div>
                        <div class="allCreatePostDetailItems">
                            <div class="allCreatePostDetailItem">
                                <label>عنوان* :</label>
                                <input type="text" name="name" placeholder="عنوان را وارد کنید">
                                @error('name')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="allCreatePostDetailItem">
                                <label>پیوند(slug) :</label>
                                <input type="text" name="slug" placeholder="پیوند را وارد کنید">
                                @error('slug')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
