@extends('admin.master')

@section('tab' , 34)
@section('content')
    <div class="allPayPanel">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/cost">همه هزینه ها</a>
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
                    <form method="GET" action="/admin/cost" class="filterContent">
                        <div class="filterContentItem">
                            <label>فیلتر حامل و شماره سفارش و آیدی کاربر و آیدی</label>
                            <input type="text" name="title" placeholder="مثال: 10" value="{{$title}}">
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
            @foreach ($pays as $item)
                <div class="postItem" id="{{$item->id}}">
                    <div class="postTop">
                        <div class="postTitle">
                            <ul>
                                <li>
                                    <span>توضیح :</span>
                                    <span>{{$item->note}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="postOptions">
                            <a href="/admin/pay/invoice/{{$item->id}}" title="پرینت خرید">
                                <svg class="icon">
                                    <use xlink:href="#print"></use>
                                </svg>
                            </a>
                            <a href="/admin/cost/{{$item->id}}" title="مشاهده هزینه">
                                <svg class="icon">
                                    <use xlink:href="#edit"></use>
                                </svg>
                            </a>
                            <i title="حذف هزینه" class="deletePay" id="{{$item->id}}">
                                <svg class="icon">
                                    <use xlink:href="#trash"></use>
                                </svg>
                            </i>
                        </div>
                    </div>
                    <div class="postBot">
                        <ul>
                            <li>
                                <span>زمان ثبت :</span>
                                <span>{{$item->created_at}}</span>
                            </li>
                            <li>
                                <span>نوع پرداخت :</span>
                                @if($item->method == 0)
                                    <span>پرداخت از درگاه</span>
                                @endif
                                @if($item->method == 1)
                                    <span>پرداخت از کیف پول</span>
                                @endif
                                @if($item->method == 2)
                                    <span>پرداخت در محل</span>
                                @endif
                                @if($item->method == 3)
                                    <span>پرداخت اقساطی</span>
                                @endif
                                @if($item->method == 4)
                                    <span>خرید فوری</span>
                                @endif
                                @if($item->method == 5)
                                    <span>کارت به کارت</span>
                                @endif
                                @if($item->method == 6)
                                    <span>پرداخت مستقیم</span>
                                @endif
                            </li>
                            <li>
                                <span>مبلغ هزینه :</span>
                                <span>{{ number_format($item->price) }} تومان</span>
                            </li>
                            <li>
                                <span>وضعیت پرداخت :</span>
                                @if($item->status == 100)
                                    <span class="status100">پرداخت شده</span>
                                @endif
                                @if($item->status == 50)
                                    <span class="status50">پرداخت بیعانه</span>
                                @endif
                                @if($item->status == 0)
                                    <span class="status0">پرداخت نشده</span>
                                @endif
                                @if($item->status == 20)
                                    <span class="status20">در حال پرداخت</span>
                                @endif
                                @if($item->status == 10)
                                    <span class="status10">پرداخت اقساطی</span>
                                @endif
                                @if($item->status == 1)
                                    <span class="status1">لغو شده</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $pays->links('admin.paginate') }}
        <div class="popUp" style="display:none;">
            <div class="popUpItem">
                <div class="title">آیا از حذف هزینه مطمئن هستید؟</div>
                <p>با حذف هزینه اطلاعات هزینه به طور کامل حذف میشوند</p>
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
            var checked = 0;
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
            $('.allTableContainer .postItem').on('click' , '.deletePay' ,function(){
                post = this.id;
                $('.popUp').show();
                $('.buttonsPop form').attr('action' , '/admin/pay/' + post+'/delete');
            });
        })
    </script>
@endsection

