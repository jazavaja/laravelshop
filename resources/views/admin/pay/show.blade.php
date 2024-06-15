@extends('admin.master')

@section('tab' , 7)
@section('content')
    <div class="allShowPay">
        <div class="topShowPay">
            <div class="title">
                @if($pays->method != 6)
                    <h1>جزئیات سفارش</h1>
                @else
                    <h1>جزئیات پرداخت</h1>
                @endif
                <span>{{$pays->created_at}}</span>
                <a href="/admin/pay/invoice/{{$pays->id}}" target="_blank">
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                    دریافت فاکتور
                </a>
                @if($pays->method != 6)
                    <a href="/admin/pay/print/{{$pays->id}}" target="_blank" style="color:#fff;padding: 0.3rem 1rem" class="print-button2">
                        <svg class="icon">
                            <use xlink:href="#print"></use>
                        </svg>
                        لیبل گیرنده
                    </a>
                    <button class="btnMap">
                        <svg class="icon">
                            <use xlink:href="#map"></use>
                        </svg>
                        نمایش نقشه
                    </button>
                @endif
            </div>
            <div class="detail">
                <div class="topDetail">
                    <div class="items">
                        @if(count($pays->address) >= 1)
                            <div class="item">
                                <h5>نام گیرنده :</h5>
                                <div>{{$pays->address[0]->name}}</div>
                            </div>
                            <div class="item">
                                <h5>شماره تماس :</h5>
                                <div>{{$pays->address[0]->number}}</div>
                            </div>
                            <div class="item">
                                <h5>کد پستی :</h5>
                                <div>{{$pays->address[0]->post}}</div>
                            </div>
                        @else
                            <div class="item">
                                <h5>نام گیرنده :</h5>
                                <div>{{$pays->user->name}}</div>
                            </div>
                            <div class="item">
                                <h5>شماره تماس :</h5>
                                <div>{{$pays->user->number}}</div>
                            </div>
                        @endif
                        @if($pays->method != 6)
                            <div class="item">
                                <h5>نوع حامل :</h5>
                                <div>{{$pays->carrier}}</div>
                            </div>
                            <div class="item">
                                <h5>مبلغ حمل :</h5>
                                <div>{{number_format($pays->carrier_price)}} تومان </div>
                            </div>
                        @endif
                        <div class="item">
                            <h5>درگاه پرداختی :</h5>
                            @if($pays->gate == 0)
                                <div>زرینپال</div>
                            @elseif($pays->gate == 1)
                                <div>زیبال</div>
                            @elseif($pays->gate == 2)
                                <div>نکست پی</div>
                            @elseif($pays->gate == 3)
                                <div>نکست پی</div>
                            @elseif($pays->gate == 4)
                                <div>آیدی پی</div>
                            @elseif($pays->gate == 5)
                                <div>به پرداخت ملت</div>
                            @elseif($pays->gate == 6)
                                <div>سداد ملی</div>
                            @elseif($pays->gate == 7)
                                <div>آسان پرداخت</div>
                            @elseif($pays->gate == 8)
                                <div>پاسارگاد</div>
                            @endif
                        </div>
                        @if($pays->time)
                            @if(json_decode($pays->time)->day)
                                <div class="item">
                                    <h5>بازه زمانی :</h5>
                                    <div>
                                        <span>بازه</span>
                                        <span>{{json_decode($pays->time)->from}}:00</span>
                                        <span>-</span>
                                        <span>{{json_decode($pays->time)->to}}:00</span>
                                        <span>---></span>
                                        <span>{{json_decode($pays->time)->day}} / </span>
                                        <span>{{json_decode($pays->time)->month}}</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    @if(count($pays->address) >= 1)
                        <div class="items">
                            <div class="item">
                                <h5>آدرس :</h5>
                                <div>
                                    {{$pays->address[0]->state}}
                                    -{{$pays->address[0]->city}}
                                    -{{$pays->address[0]->address}}
                                    پلاک :
                                    {{$pays->address[0]->plaque}}
                                    واحد :
                                    {{$pays->address[0]->unit}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="botDetail">
                    <div class="items">
                        <div class="item">
                            <h5>مبلغ پرداخت :</h5>
                            <div>{{number_format($pays->price)}} تومان</div>
                        </div>
                        @if($pays->method != 6)
                            <div class="item">
                                <h5>مبلغ بیعانه :</h5>
                                <div>{{number_format($pays->deposit)}} تومان</div>
                            </div>
                        @endif
                        <div class="item">
                            <h5>وضعیت پرداخت :</h5>
                            <select name="status">
                                <option value="100">پرداخت شده</option>
                                <option value="50">پرداخت بیعانه</option>
                                <option value="20">تایید و آماده پرداخت</option>
                                <option value="10">در حال بررسی</option>
                                <option value="0">پرداخت نشده</option>
                                <option value="1">لغو شده</option>
                                <option value="2">مرجوعی</option>
                            </select>
                        </div>
                        @if($pays->method != 6)
                            <div class="item">
                                <h5>وضعیت ارسال :</h5>
                                <select name="deliver">
                                    <option value="0">دریافت سفارش</option>
                                    <option value="1">در انتظار بررسی</option>
                                    <option value="2">بسته بندی شده</option>
                                    <option value="3">تحویل پیک</option>
                                    <option value="4">تکمیل شده</option>
                                </select>
                            </div>
                        @endif
                        <div class="item">
                            <h5>روش پرداخت :</h5>
                            @if($pays->method == 0)
                                <div>پرداخت از درگاه</div>
                            @endif
                            @if($pays->method == 1)
                                <div>پرداخت از کیف پول</div>
                            @endif
                            @if($pays->method == 2)
                                <div>پرداخت در محل</div>
                            @endif
                            @if($pays->method == 3)
                                <div>پرداخت اقساطی</div>
                            @endif
                            @if($pays->method == 4)
                                <div>پرداخت فوری</div>
                            @endif
                            @if($pays->method == 5)
                                <div>کارت به کارت</div>
                            @endif
                            @if($pays->method == 6)
                                <div>پرداخت مستقیم</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($pays->method != 6)
                <div class="trackPay">
                    <input type="text" placeholder="کد رهگیری را وارد کنید" name="track" value="{{$pays->track}}">
                    <button>اعمال کد</button>
                </div>
            @endif
            @if($pays->note)
                <div class="trackPay">
                    <span>مطلب کاربر</span>
                    <p>{{$pays->note}}</p>
                </div>
            @else
                <div class="trackPay">
                    <span>مطلب کاربر</span>
                    <p>وارد نشده</p>
                </div>
            @endif
        </div>
        @if($pays->status != 100 && $pays->status != 50)
            <div class="note">
                <label>لینک پرداخت مستقیم توسط کاربر :</label>
                <a target="_blank" href="{{url('/fast?order='.$pays->property)}}">{{url('/fast?order=')}}<span class="link1">{{$pays->property}}</span></a>
            </div>
        @endif
        @if($pays->method != 6)
            <div class="allShowPayContainer">
                <div class="topContainer">
                    <div class="level">
                        <h3>وضعیت ارسال :</h3>
                        @if($pays->deliver == 0)
                            <span class="unActive">دریافت سفارش</span>
                        @endif
                        @if($pays->deliver == 1)
                            <span class="unActive">در انتظار بررسی</span>
                        @endif
                        @if($pays->deliver == 2)
                            <span class="unActive">بسته بندی شده</span>
                        @endif
                        @if($pays->deliver == 3)
                            <span class="unActive">تحویل پیک</span>
                        @endif
                        @if($pays->deliver == 4)
                            <span class="activeStatus">تکمیل شده</span>
                        @endif
                    </div>
                    <div class="rateItemsCount">
                        <div class="rateItemsCountItem" title="دریافت سفارش">
                            @if($pays->deliver >= 1)
                            <div class="rateItemsCountItemBarActive"></div>
                            @endif
                            @if($pays->deliver == 0)
                            <div class="rateItemsCountItemBar"></div>
                            @endif
                            @if($pays->deliver >= 1)
                                <div class="rateItemsCountItemCircleActives">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-complete"></use>
                                    </svg>
                                </div>
                            @endif
                            @if($pays->deliver == 0)
                            <div class="rateItemsCountItemCircleActive">
                                <svg class="icon">
                                        <use xlink:href="#delivery-complete"></use>
                                    </svg>
                            </div>
                            @endif
                        </div>
                        <div class="rateItemsCountItem" title="در انتظار بررسی">
                            @if($pays->deliver >= 2)
                            <div class="rateItemsCountItemBarActive"></div>
                            @endif
                            @if($pays->deliver <= 1)
                            <div class="rateItemsCountItemBar"></div>
                            @endif
                            @if($pays->deliver >= 2)
                            <div class="rateItemsCountItemCircleActives">
                                <svg class="icon">
                                    <use xlink:href="#waiting-room"></use>
                                </svg>
                            </div>
                            @endif
                            @if($pays->deliver == 1)
                            <div class="rateItemsCountItemCircleActive">
                                <svg class="icon">
                                    <use xlink:href="#waiting-room"></use>
                                </svg>
                            </div>
                            @endif
                            @if($pays->deliver <= 0)
                                <div class="rateItemsCountItemCircle">
                                    <svg class="icon">
                                        <use xlink:href="#waiting-room"></use>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="rateItemsCountItem" title="بسته بندی شده">
                            @if($pays->deliver >= 3)
                            <div class="rateItemsCountItemBarActive"></div>
                            @endif
                            @if($pays->deliver <= 2)
                                <div class="rateItemsCountItemBar"></div>
                            @endif
                            @if($pays->deliver >= 3)
                                <div class="rateItemsCountItemCircleActives">
                                    <svg class="icon">
                                        <use xlink:href="#package-delivery"></use>
                                    </svg>
                                </div>
                            @endif
                            @if($pays->deliver == 2)
                            <div class="rateItemsCountItemCircleActive">
                                <svg class="icon">
                                    <use xlink:href="#package-delivery"></use>
                                </svg>
                            </div>
                            @endif
                            @if($pays->deliver <= 1)
                            <div class="rateItemsCountItemCircle">
                                <svg class="icon">
                                    <use xlink:href="#package-delivery"></use>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="rateItemsCountItem" title="تحویل پیک">
                            @if($pays->deliver >= 4)
                            <div class="rateItemsCountItemBarActive"></div>
                            @endif
                            @if($pays->deliver <= 3)
                            <div class="rateItemsCountItemBar"></div>
                            @endif
                            @if($pays->deliver >= 4)
                            <div class="rateItemsCountItemCircleActives">
                                <svg class="icon">
                                    <use xlink:href="#delivery-truck"></use>
                                </svg>
                            </div>
                            @endif
                            @if($pays->deliver == 3)
                            <div class="rateItemsCountItemCircleActive">
                                <svg class="icon">
                                    <use xlink:href="#delivery-truck"></use>
                                </svg>
                            </div>
                            @endif
                            @if($pays->deliver <= 2)
                            <div class="rateItemsCountItemCircle">
                                <svg class="icon">
                                    <use xlink:href="#delivery-truck"></use>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="rateItemsCountItem" title="تکمیل شده">
                            @if($pays->deliver == 4)
                                <div class="rateItemsCountItemCircleActive">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-box"></use>
                                    </svg>
                                </div>
                            @endif
                            @if($pays->deliver <= 3)
                                <div class="rateItemsCountItemCircle">
                                    <svg class="icon">
                                        <use xlink:href="#delivery-box"></use>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="code">
                        <h3>شماره سفارش :</h3>
                        <span>{{$pays->property}}</span>
                    </div>
                    <div class="cashBacks">
                        <div class="cash1">
                            @if($pays->back == 1)
                                <button class="active">کش بک به کیف پول سایت</button>
                            @else
                                <button>کش بک به کیف پول سایت</button>
                            @endif
                        </div>
                        <div class="cash2">
                            @if($pays->back == 2)
                                <button class="active">کش بک به حساب با شبا</button>
                            @else
                                <button>کش بک به حساب با شبا</button>
                            @endif
                        </div>
                    </div>
                </div>
                @if(count($pays->installments) >= 1)
                    <div class="abilityPost">
                        <div class="abilityTitle">
                            <label>اقساط این سفارش</label>
                        </div>
                        <ul class="abilityTable">
                            <li>
                                <h4>شماره چک</h4>
                                <h4>مبلغ قسط (تومان)</h4>
                                <h4>سررسید قسط</h4>
                                <h4>وضعیت پرداخت</h4>
                                <h4>زمان پرداخت مشتری</h4>
                            </li>
                            @foreach($pays->installments as $item)
                                <li>
                                    <input type="text" name="title" value="{{$item->title}}" placeholder="شماره را وارد کنید">
                                    <input type="text" name="price" value="{{$item->price}}" placeholder="مبلغ را وارد کنید">
                                    <input type="text" name="time" value="{{$item->time}}" placeholder="تاریخ را وارد کنید">
                                    <select name="status" id="{{$item->id}}">
                                        <option value="0">پرداخت نشده</option>
                                        <option value="1">پرداخت شده</option>
                                    </select>
                                    <input type="text" name="pay" value="{{$item->pay}}" placeholder="زمان پرداخت مشتری">
                                </li>
                            @endforeach
                        </ul>
                        <button class="btnClick">ثبت اقساط</button>
                    </div>
                @endif
                <div class="items">
                    <div class="titleProducts">
                        <div class="title">محصولاتی که سفارش داده شده</div>
                        <button>افزودن محصول</button>
                    </div>
                    @foreach($pays->payMeta as $item)
                        <div class="item">
                            @if($item->product)
                                <a href="/product/{{$item->product->slug}}" class="cartDetailPic">
                                    <img src="{{json_decode($item->product->image)[0]}}" alt="{{$item->product->title}}">
                                    <i id="{{$item->id}}">
                                        <svg class="icon">
                                            <use xlink:href="#cancel"></use>
                                        </svg>
                                    </i>
                                </a>
                            @endif
                            @if($item->collection)
                                <a href="/pack/{{$item->collection->slug}}" class="cartDetailPic">
                                    <img src="{{$item->collection->image}}" alt="{{$item->collection->title}}">
                                </a>
                            @endif
                            <div class="cartDetailInfo">
                                @if($item->product)
                                    <a href="/product/{{$item->product->slug}}" class="cartDetailInfoItem">
                                        <h3>
                                            {{$item->product->title}}
                                            @if($item->cancel)
                                                <span class="cancel">(لغو شده)</span>
                                            @endif
                                        </h3>
                                    </a>
                                @endif
                                @if($item->collection)
                                    <a href="/pack/{{$item->collection->slug}}" class="cartDetailInfoItem">
                                        <h3>{{$item->collection->title}}</h3>
                                    </a>
                                @endif
                                @if($item->prebuy)
                                    <div class="cartDetailInfoItem activePay">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#pay"></use>
                                            </svg>
                                        </i>
                                        <span>پیش خرید</span>
                                    </div>
                                @endif
                                @if($item->color)
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#color"></use>
                                            </svg>
                                        </i>
                                        <span>{{$item->color}}</span>
                                    </div>
                                @endif
                                @if($item->size)
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#sizeFront"></use>
                                            </svg>
                                        </i>
                                        <span>{{$item->size}}</span>
                                    </div>
                                @endif
                                @if($item->guarantee_name)
                                    <div class="cartDetailInfoItem">
                                        <i>
                                            <svg class="icon">
                                                <use xlink:href="#security"></use>
                                            </svg>
                                        </i>
                                        <span>{{$item->guarantee_name}}</span>
                                    </div>
                                @endif
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#post"></use>
                                        </svg>
                                    </i>
                                    <span>{{$item->count}}</span>
                                </div>
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#cost"></use>
                                        </svg>
                                    </i>
                                    <span>{{number_format($item->price)}} تومان</span>
                                </div>
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg class="icon">
                                            <use xlink:href="#car"></use>
                                        </svg>
                                    </i>
                                    <select name="deliver" id="{{$item->id}}">
                                        @if($item->deliver == 0)
                                            <option value="0" selected>دریافت سفارش</option>
                                            @else
                                            <option value="0">دریافت سفارش</option>
                                        @endif
                                        @if($item->deliver == 1)
                                            <option value="1" selected>در انتظار بررسی</option>
                                        @else
                                            <option value="1">در انتظار بررسی</option>
                                        @endif
                                        @if($item->deliver == 2)
                                            <option value="2" selected>بسته بندی شده</option>
                                        @else
                                            <option value="2">بسته بندی شده</option>
                                        @endif
                                        @if($item->deliver == 3)
                                            <option value="3" selected>تحویل پیک</option>
                                        @else
                                            <option value="3">تحویل پیک</option>
                                        @endif
                                        @if($item->deliver == 4)
                                            <option value="4" selected>تکمیل شده</option>
                                        @else
                                            <option value="4">تکمیل شده</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="addProducts" style="display:none;">
                <form method="post" action="/admin/add-pay/{{$pays->id}}" class="showProducts">
                    @csrf
                    <div class="item">
                        <h4>محصول</h4>
                        <select name="productM">
                            @foreach($products as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="item">
                        <h4>رنگ</h4>
                        <input type="text" placeholder="رنگ" name="colorM">
                    </div>
                    <div class="item">
                        <h4>سایز</h4>
                        <input type="text" placeholder="سایز" name="sizeM">
                    </div>
                    <div class="item">
                        <h4>تعداد</h4>
                        <input type="text" placeholder="تعداد" name="countM">
                    </div>
                    <div class="item">
                        <h4>گارانتی</h4>
                        <input type="text" placeholder="گارانتی" name="guaranteeM">
                    </div>
                    <div class="item">
                        <h4>مبلغ کل</h4>
                        <input type="text" placeholder="مبلغ" name="priceM">
                    </div>
                    <div class="buttons">
                        <button>ارسال</button>
                        <button class="btnCan">انصراف</button>
                    </div>
                </form>
            </div>
            <div class="showAllMap">
                <div class="map1">
                    <div id="map1"></div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts3')
    <script>
        $(document).mouseup(function(e)
        {
            var container = $(".showAllMap");
            if (container.is(e.target) && container.has(e.target).length == 0)
            {
                $('.showAllMap').attr('class','showAllMap');
            }
        });
        $(document).ready(function(){
            var pays = {!! $pays->toJson() !!};
            $.each(pays.installments , function (e){
                $(".abilityTable select[id="+this.id+"]").val(this.status);
            })
            $('.allShowPay .btnMap').click(function (){
                if($('.showAllMap').attr('class') == 'showAllMap activesAddress'){
                    $('.showAllMap').attr('class','showAllMap');
                }else{
                    $('.showAllMap').attr('class','showAllMap activesAddress');
                }
            })
            $('.print-button').click(function() {
                var divToPrint=document.getElementById('printMe1');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $('.print-button2').click(function() {
                var divToPrint=document.getElementById('printMe2');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><link rel="stylesheet" href="/css/admin.css"/></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                newWin.document.close();
            });
            $(".botDetail .item select[name='deliver']").val(pays.deliver);
            $(".item select[name='status']").val(pays.status);
            $(".item select[name='status']").change(function() {
                var status=$(".item select[name='status'] :selected").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    status:status,
                    update:1,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                    },
                });
            });
            $(".botDetail .item select[name='deliver']").change(function() {
                var deliver=$(".item select[name='deliver'] :selected").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    deliver:deliver,
                    update:2,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".allShowPayContainer .item select[name='deliver']").change(function() {
                var form = {
                    "_token": "{{ csrf_token() }}",
                    deliver:$(this).val(),
                    payMeta:$(this).attr('id'),
                    update:6,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".trackPay button").on('click',function() {
                var track=$(".trackPay input[name='track']").val();
                var form = {
                    "_token": "{{ csrf_token() }}",
                    track:track,
                    update:3,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                    },
                });
            });
            $(".cash1 button").on('click',function() {
                var form = {
                    "_token": "{{ csrf_token() }}",
                    back:1,
                    update:4,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".cash2 button").on('click',function() {
                var form = {
                    "_token": "{{ csrf_token() }}",
                    back:2,
                    update:4,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".abilityPost button").on('click',function() {
                var installs = [];
                $(".abilityPost li").each(function(){
                    if($(this).find("input").length >= 1) {
                        var install = {
                            title: "",
                            price: "",
                            time: "",
                            status: "",
                            pay: "",
                            id: "",
                        };
                        $(this).find("input").each(function () {
                            if (this.name == 'title') {
                                install.title = this.value;
                            }
                            if (this.name == 'price') {
                                install.price = this.value;
                            }
                            if (this.name == 'time') {
                                install.time = this.value;
                            }
                            if (this.name == 'status') {
                                install.status = this.value;
                            }
                            if (this.name == 'pay') {
                                install.pay = this.value;
                            }
                        })
                        $(this).find("select").each(function () {
                            if (this.name == 'status') {
                                install.status = this.value;
                            }
                            install.id = this.id;
                        })
                        installs.push(install);
                    }
                });
                var form = {
                    "_token": "{{ csrf_token() }}",
                    installs:JSON.stringify(installs),
                    update:5,
                };
                $.ajax({
                    url: "/admin/pay/"+pays.id,
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".cartDetailPic i").click(function(e) {
                e.preventDefault();
                var form = {
                    "_token": "{{ csrf_token() }}",
                };
                $.ajax({
                    url: "/admin/delete-pay/"+$(this).attr('id'),
                    type: "put",
                    data: form,
                    success: function () {
                        $.toast({
                            text: "سفارش ویرایش شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.reload();
                    },
                });
            });
            $(".titleProducts button").click(function(e) {
                $('.addProducts').toggle();
            })
            $(".addProducts .btnCan").click(function(e) {
                e.preventDefault();
                $('.addProducts').toggle();
            })
            if(pays.address.length >= 1){
                var originLat = pays.address[0].originLat;
                var originLng = pays.address[0].originLng;
                var app = new Mapp({
                    element: '#map1',
                    presets: {
                        latlng: {
                            lat: originLat,
                            lng: originLng,
                        },
                        zoom: 15,
                    },
                    apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVmMDFmMDMxOTE2MmYxMWM4YjFmNjAxZGEzZWM0ZTcyZDI1ZjMxY2ZiZDI0NjM2MzE0OGJjZWI5NzcwN2VlOTM4NjBhZmNlOTc0NTZlMjk2In0.eyJhdWQiOiIxNjMzMCIsImp0aSI6IjVmMDFmMDMxOTE2MmYxMWM4YjFmNjAxZGEzZWM0ZTcyZDI1ZjMxY2ZiZDI0NjM2MzE0OGJjZWI5NzcwN2VlOTM4NjBhZmNlOTc0NTZlMjk2IiwiaWF0IjoxNjk1MjQwOTI3LCJuYmYiOjE2OTUyNDA5MjcsImV4cCI6MTY5NzU3MzcyNywic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.ggya0Flw4c5RI67geif-boTPM15vM4nIRF1fKflZbHxVHdv6TMhRQkR_cyCOnoL8M-JzsHrVloiHZqb64_laAMNqNMjjWPqcmPFo-AOEqG3v_-8k1bPfxM_6iZEsARwmdVqwByG9KEKleJ8lZR6TKuSWQtDPw_9wTP39bWAw7udKLCw_cDRo_ZOYUSqFXwypDi3YEvQNXP1YaTDvTIQbZRWMgwDEJ1d9F2oymRcWnJyTSiW_KCDeYl7kQr74pGafUAGtgGskB2Weh2MZYJzsdM-9ioX1lBHbnDCdaHY8rLzDeLPu7gFSgK6HQ2CXQlbkrY90a-f2G69GG1iqGsPHjA'
                });
                app.addLayers();
                app.addMarker({
                    name: 'advanced-marker',
                    latlng: {
                        lat: originLat,
                        lng: originLng
                    },
                    zoom: 16,
                    draggable: false,
                    popup: false,
                });
            }
        })
    </script>
@endsection

@section('map')
    <script src="/js/jquery.toast.min.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>
@endsection

@section('mapLink')
    <link rel="stylesheet" href="/css/jquery.toast.min.css"/>
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">
@endsection
