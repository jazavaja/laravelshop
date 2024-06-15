@extends('admin.master')

@section('tab',1)
@section('content')
    <div class="allBrandPanel">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/collection">پک محصول</a>
            </div>
            <div class="allTopTableItem">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#filter"></use>
                            </svg>
                        </i>
                        فیلتر اطلاعات
                    </div>
                    <form method="GET" action="/admin/collection" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="title" placeholder="عنوان یا آیدی را وارد کنید" value="{{$title}}">
                        </div>
                        <button type="submit">اعمال</button>
                    </form>
                </div>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allTables">
            <div>
                <table>
                    <tr>
                        <th>آیدی</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    @foreach($collections as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                <div class="buttons">
                                    <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                    <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $collections->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/collection" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="title" placeholder="عنوان را وارد کنید">
                        @error('title')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="allCreatePostDetailItem">
                        <label>زبان* :</label>
                        <select name="language">
                            <option value="fa" selected>فارسی</option>
                            <option value="en">انگلیسی</option>
                            <option value="ar">عربی</option>
                            <option value="tr">ترکی</option>
                        </select>
                        <div id="validation-language"></div>
                    </div>
                    <div class="filledItem">
                        <label>تعداد*</label>
                        <input type="text" name="count" placeholder="تعداد را وارد کنید">
                        @error('count')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>تخفیف*</label>
                        <input type="text" name="off" placeholder="تخفیف را وارد کنید">
                        @error('off')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>قیمت*</label>
                        <input type="text" name="price" placeholder="قیمت را وارد کنید">
                        @error('price')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>پیوند</label>
                        <input type="text" name="slug" placeholder="پیوند را وارد کنید">
                    </div>
                    <div class="filledItem">
                        <label>توضیحات*</label>
                        <textarea name="body" placeholder="توضیحات را وارد کنید"></textarea>
                        @error('body')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>عنوان سئو*</label>
                        <input type="text" name="titleSeo" placeholder="عنوان را وارد کنید">
                        @error('titleSeo')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>کلمات کلیدی*</label>
                        <input name="keyword" placeholder="با , جدا کنید"/>
                        @error('keyword')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>توضیحات سئو*</label>
                        <textarea name="bodySeo" placeholder="توضیحات را وارد کنید"></textarea>
                        @error('bodySeo')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem2">
                        <label>محصولات :</label>
                        <select class="cats-multiple" name="products[]" multiple="multiple">
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filledItem">
                        <label>زمان ارسال :</label>
                        <select name="time">
                            @foreach ($times as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('time')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="addImageButton">برای افزودن تصویر کلیک کنید</div>
                    <div class="sendGallery">
                        <div class="getImageItem">
                            <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                        </div>
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp">
            <div class="popUpItem">
                <div class="title">آیا از حذف پک محصول مطمئن هستید؟</div>
                <p>با حذف پک محصول اطلاعات پک محصول به طور کامل حذف میشوند</p>
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
    </div>
    <div class="filemanager">
        @include('admin.filemanager')
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.cats-multiple').select2({
                placeholder: 'محصول را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('.popUp').hide();
            $('.filemanager').hide();
            $('.filterContent').hide();
            $('.filterTitle').click(function(){
                $('.filterContent').toggle();
            })
            $('.addImageButton').click(function(){
                $('.filemanager').show();
            });
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.allTables .buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/collection/' + post+'/delete');
            })
            $('.allTables .buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    collection:post,
                };
                $.ajax({
                    url: "/admin/collection/" + post + "/edit",
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/collection/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/collection/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $(".createFilled input[name='title']").val('');
                                $(".createFilled input[name='price']").val('');
                                $(".createFilled input[name='count']").val('');
                                $(".createFilled input[name='off']").val('');
                                $(".createFilled input[name='slug']").val('');
                                $(".createFilled input[name='titleSeo']").val('');
                                $(".createFilled input[name='keyword']").val('');
                                $(".createFilled textarea[name='body']").val('');
                                $(".createFilled textarea[name='bodySeo']").val('');
                                $(".createFilled input[name='image']").val('');
                                $('.cats-multiple').val([]);
                                $('.getImageItem .getImagePic').remove()
                            })
                        )
                        $(".createFilled input[name='title']").val(data.title);
                        $(".createFilled input[name='slug']").val(data.slug);
                        $(".createFilled input[name='titleSeo']").val(data.titleSeo);
                        $(".createFilled input[name='keyword']").val(data.keyword);
                        $(".createFilled textarea[name='body']").val(data.body);
                        $(".createFilled textarea[name='bodySeo']").val(data.bodySeo);
                        $(".createFilled input[name='price']").val(data.price);
                        $(".createFilled input[name='count']").val(data.count);
                        $(".createFilled input[name='off']").val(data.off);
                        $(".createFilled select[name='language']").val(data.language);
                        if(data.time.length){
                            $("select[name='time']").val(data.time[0].id);
                        }
                        if(data.product.length){
                            var cats2 = []
                            $.each(data.product,function(){
                                cats2.push(this.id);
                            });
                            $('.cats-multiple').val(cats2);
                            $('.cats-multiple').select2({
                                placeholder: 'محصول را انتخاب کنید ...',
                                "language": {
                                    "noResults": function(){
                                        return "موردی پیدا نشد";
                                    }
                                },
                            });
                        }
                        $('.getImageItem').append(
                            $('<div class="getImagePic"><input type="hidden" name="image" value="'+data.image+'"><i><svg class="deleteImg"><use xlink:href="#trash"></use></svg></i><img src="'+data.image+'"></div>')
                                .on('click' , '.deleteImg',function(ss){
                                    ss.currentTarget.parentElement.parentElement.remove();
                                })
                        );
                        $("input[name='image']").val(data.image);
                    },
                });
            })
        })
    </script>
@endsection

@section('jsScript')
    <script src="/js/select2.min.js"></script>
@endsection

@section('links')
    <link rel="stylesheet" href="/css/select2.min.css"/>
@endsection
