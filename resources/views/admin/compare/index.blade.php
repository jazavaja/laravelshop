@extends('admin.master')

@section('tab',1)
@section('content')
    <div class="allBrandPanel">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/compare-product">محصول مقایسه ای</a>
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
                    <form method="GET" action="/admin/compare-product" class="filterContent">
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
                    @foreach($compares as $item)
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
                {{ $compares->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/compare-product" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان محصول*</label>
                        <input type="text" name="title" placeholder="مثال : گوشی هوشمند">
                        @error('title')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>آدرس صفحه محصول*</label>
                        <input type="text" name="link" placeholder="آدرس را وارد کنید">
                        @error('link')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>تصویر اول*</label>
                        <input type="text" name="image1" placeholder="لینک را وارد کنید">
                        @error('image1')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>تصویر دوم*</label>
                        <input type="text" name="image2" placeholder="لینک را وارد کنید">
                        @error('image2')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>عنوان تصویر اول*</label>
                        <input type="text" name="text1" placeholder="مثال : قبل">
                        @error('text1')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>عنوان تصویر دوم*</label>
                        <input type="text" name="text2" placeholder="مثال : بعد">
                        @error('text2')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>زبان* :</label>
                        <select name="language">
                            <option value="fa" selected>فارسی</option>
                            <option value="en">انگلیسی</option>
                            <option value="ar">عربی</option>
                            <option value="tr">ترکی</option>
                        </select>
                        <div id="validation-language"></div>
                    </div>
                    <div class="buttonForm">
                        <button type="submit">ثبت اطلاعات</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="popUp">
            <div class="popUpItem">
                <div class="title">آیا از حذف محصول مطمئن هستید؟</div>
                <p>با حذف محصول اطلاعات پک ول به طور کامل حذف میشوند</p>
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
@endsection

@section('scripts3')
    <script>
        $(document).ready(function(){
            var post = 0;
            $('.popUp').hide();
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
                $('.buttonsPop form').attr('action' , '/admin/compare-product/' + post+'/delete');
            })
            $('.allTables .buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                };
                $.ajax({
                    url: "/admin/compare-product/" + post + "/edit",
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/compare-product/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/compare-product/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $(".createFilled input[name='title']").val('');
                                $(".createFilled input[name='link']").val('');
                                $(".createFilled input[name='image1']").val('');
                                $(".createFilled input[name='image2']").val('');
                                $(".createFilled input[name='text1']").val('');
                                $(".createFilled input[name='text2']").val('');
                                $(".createFilled select[name='language']").val('');
                            })
                        )
                        $(".createFilled input[name='title]").val(data.title);
                        $(".createFilled input[name='link]").val(data.link);
                        $(".createFilled input[name='image1]").val(data.image1);
                        $(".createFilled input[name='image2]").val(data.image2);
                        $(".createFilled input[name='text1]").val(data.text1);
                        $(".createFilled input[name='text2]").val(data.text2);
                        $(".createFilled select[name='language]").val(data.language);
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
