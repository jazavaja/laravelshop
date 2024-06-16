@extends('admin.master')

@section('tab',22)
@section('content')
    <div class="allProduct">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/sellers">همه فروشندگان</a>
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
                    <form method="GET" action="/admin/sellers" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر نام و آیدی و شماره و ایمیل</label>
                            <input type="text" name="title" placeholder="جستجو ..." value="{{$title}}">
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
        <div class="allTableContainer">
            @foreach ($users as $item)
                <div class="postItem">
                    <div class="postTop">
                        <div class="postTitle">
                            <div class="postImages">
                                <div class="postImage">
                                    <img src="/img/user.png" alt="{{$item->title}}">
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <span>نام فروشگاه :</span>
                                    <span>{{$item->name}}</span>
                                </li>
                                <li>
                                    <span>آیدی کاربر :</span>
                                    <span>{{$item->id}}</span>
                                </li>
                                <li>
                                    <span>درآمد :</span>
                                    <span>{{number_format($item->cooperation2_count)}} تومان </span>
                                </li>
                            </ul>
                        </div>
                        <div class="postOptions">
                            @if(count($item->document) >= 1)
                                <a href="/admin/document/{{$item->document[0]->id}}/edit" title="ویرایش فروشنده">
                                    <svg class="icon">
                                        <use xlink:href="#edit"></use>
                                    </svg>
                                </a>
                            @endif
                            <i title="حذف کاربر" class="deleteUser" id="{{$item->id}}">
                                <svg class="icon">
                                    <use xlink:href="#trash"></use>
                                </svg>
                            </i>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>شماره تماس :</span>
                                <span>{{$item->number}}</span>
                            </li>
                            <li>
                                <span>ایمیل :</span>
                                <span>{{$item->email}}</span>
                            </li>
                            <li>
                                <span>زمان ثبت :</span>
                                <span>{{$item->created_at}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $users->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف فروشنده مطمئن هستید؟</div>
                <p>با حذف فروشنده کاربر حذف نخواهد شد و صرفا از بخش فروشندگی خارج میشود</p>
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
            $('.allTableContainer .postItem').on('click' , '.deleteUser' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/sellers/' + post+'/delete');
            })
        })
    </script>
@endsection
