@extends('admin.master')

@section('tab',21)
@section('content')
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/variety">همه تنوع ها</a>
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
                    <form method="GET" action="/admin/variety" class="filterContent">
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
        <table>
            <tr>
                <th>آیدی</th>
                <th>تصویر</th>
                <th>عنوان</th>
                <th>مبلغ</th>
                <th>تعداد موجود</th>
                <th>عملیات</th>
            </tr>
            @foreach($products as $item)
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
                    <td>
                        <div class="buttons">
                            <a href="/admin/variety/{{$item->id}}/edit">ویرایش</a>
                            <button id="{{$item->id}}">حذف</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $products->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف تنوع مطمئن هستید؟</div>
                <p>با حذف تنوع اطلاعات تنوع به طور کامل حذف میشوند</p>
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
            $('.filemanager').show();
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
            $('.buttons').on('click' , 'button' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/variety/' + post+'/delete');
            })
        })
    </script>
@endsection
