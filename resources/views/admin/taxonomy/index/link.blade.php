@extends('admin.master')

@section('tab',15)
@section('content')
    <div class="allBrandPanel">
        <div class="topBrandPanel">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a>تاکسونامی</a>
                <span>/</span>
                <a href="/admin/link">لینک هدر</a>
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
                    <form method="GET" action="/admin/link" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر عنوان و آیدی</label>
                            <input type="text" name="name" placeholder="عنوان یا آیدی را وارد کنید" value="{{$title}}">
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
                    @foreach($links as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <div class="buttons">
                                    <button id="{{$item->id}}" class="editButton">ویرایش</button>
                                    <button id="{{$item->id}}" class="deleteButton">حذف</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $links->links('admin.paginate') }}
            </div>
            <div>
                <form action="/admin/link" class="createFilled" method="post">
                    @csrf
                    <div class="filledItem">
                        <label>عنوان*</label>
                        <input type="text" name="name" placeholder="عنوان را وارد کنید">
                        @error('name')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>ریز عنوان*</label>
                        <input type="text" name="tooltip" placeholder="مثال : جدید">
                        @error('tooltip')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>نوع*</label>
                        <select name="type" id="">
                            <option value="0" selected>داخل هدر</option>
                            <option value="1">داخل فوتر</option>
                        </select>
                        @error('type')
                        <div class="alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="filledItem">
                        <label>آدرس*</label>
                        <input type="text" name="slug" placeholder="آدرس را وارد کنید">
                        @error('slug')
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
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف لینک مطمئن هستید؟</div>
                <p>با حذف لینک اطلاعات لینک به طور کامل حذف میشوند</p>
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
            $('#cancelDelete').click(function(){
                $('.popUp').hide();
                post = 0;
            })
            $('#deletePost').click(function(){
                $('.popUp').hide();
            });
            $('.buttons').on('click' , '.deleteButton' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/link/' + post+'/delete');
            })
            $('.buttons').on('click' , '.editButton' ,function(){
                window.scrollTo(0,0);
                post = this.id;
                var form = {
                    "_token": "{{ csrf_token() }}",
                    link:post,
                };
                $.ajax({
                    url: "/admin/link/" + post + "/edit",
                    type: "get",
                    data: form,
                    success: function (data) {
                        $('.createFilled').attr('action' , '/admin/link/' + post+'/edit');
                        $(".createFilled input[name='_method']").remove();
                        $('.createFilled').append(
                            $('@method('put')')
                        )
                        $('.buttonForm h4').remove();
                        $('.buttonForm').append(
                            $('<h4>لغو</h4>').on('click',function(ss){
                                post = 0;
                                $('.createFilled').attr('action' , '/admin/link/');
                                $(".createFilled input[name='_method']").remove();
                                $(this).hide();
                                $("input[name='name']").val('');
                                $("input[name='tooltip']").val('');
                                $("input[name='slug']").val('');
                                $("select[name='type']").val(0);
                            })
                        )
                        $("input[name='name']").val(data.name);
                        $("input[name='tooltip']").val(data.tooltip);
                        $("input[name='slug']").val(data.slug);
                        $("select[name='type']").val(data.type);
                        $("select[name='language']").val(data.language);
                    },
                });
            })
        })
    </script>
@endsection
