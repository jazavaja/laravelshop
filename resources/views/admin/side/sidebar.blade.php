<div class="allSideBar" style="background:{{$sideColor}}">
    <div class="sideSearch">
        <input type="text" placeholder="بخشی از عنوان مثل : افزودن مح" name="searchSide">
        <button>جستجو</button>
    </div>
    <div class="buttonSystem">
        <a href="/admin/cost-benefit">سیستم حسابداری</a>
        <a href="/admin/tank">سیستم انبارداری</a>
        <a href="/admin/tank" style="grid-column: 1 / span 2;">سیستم مارکتینگ و تخفیف</a>
    </div>
    <div class="allSideBarItem">
        @if(auth()->user()->can('داشبورد') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList1">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#home"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">داشبورد</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList1">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#home"></use>
                        </svg>
                    </i>
                    داشبورد
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList1" class="active">
                    <li>
                        <a href="/">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            خانه
                        </a>
                    </li>
                    <li>
                        <a href="/admin">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            داشبورد
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('داشبورد') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/learn">
                <div class="active" style="display: none" id="showList28">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#diploma"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">آموزش کار با پنل مدیریت</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList28">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#diploma"></use>
                        </svg>
                    </i>
                    آموزش کار با پنل مدیریت
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('گالری') || auth()->user()->admin == 1)
            <a href="/admin/gallery" class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList12">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#gallery"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        گالری
                        <span class="countData">{{\App\Models\Gallery::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList12">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#gallery"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        گالری
                        <span class="countData">{{\App\Models\Gallery::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('همه محصولات') || auth()->user()->can('افزودن محصول') || auth()->user()->admin == 1)
        <div class="allSideBarIconsText">
            <div class="active" style="display: none" id="showList2">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    محصولات
                    <span class="countData">{{\App\Models\Product::where('variety', 0)->count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList2">
                <i>
                    <svg class="icon">
                        <use xlink:href="#post"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    محصولات
                    <span class="countData">{{\App\Models\Product::where('variety', 0)->count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList2" class="active">
                @if(auth()->user()->can('همه محصولات') || auth()->user()->admin == 1)
                    <li>
                        <a href="/admin/product">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه محصولات
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('همه محصولات') || auth()->user()->admin == 1)
                    <li>
                        <a href="/admin/product/change">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            فرم تغییر پیشرفته
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('افزودن محصول') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/product/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        افزودن محصول
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('افزودن محصول') || auth()->user()->admin == 1)
                    <li>
                        <a href="/admin/compare-product">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزودن محصول مقایسه ای
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('افزودن محصول') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/collection">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            افزودن پک محصولات
                            <span class="countData">{{\App\Models\Collection::count()}}</span>
                        </span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنوع ها') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/collection">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            تنوع ها
                            <span class="countData">{{\App\Models\Product::where('variety', '>=' , 1)->count()}}</span>
                        </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @endif
        @if(auth()->user()->can('همه سفارشات') || auth()->user()->admin == 1)
        <div class="allSideBarIconsText">
            <div class="active" style="display: none" id="showList8">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    سفارشات
                    <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList8">
                <i>
                    <svg class="icon">
                        <use xlink:href="#pay"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    سفارشات
                    <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList8" class="active">
                <li>
                    <a href="/admin/pay/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        افزودن سفارش
                    </a>
                </li>
                <li>
                    <a href="/admin/pay">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            همه سفارشات
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay?delivery=0">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سفارشات دریافت شده
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->where('deliver' , 0)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay?delivery=1">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سفارشات در انتظار بررسی
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->where('deliver' , 1)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay?delivery=2">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سفارشات بسته بندی شده
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->where('deliver' , 2)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay?delivery=3">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سفارشات تحویل پیک داده شده
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->where('deliver' , 3)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay?delivery=4">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سفارشات تکمیل شده
                            <span class="countData">{{\App\Models\Pay::where('back' , '!=' , 4)->where('deliver' , 4)->count()}}</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        @if(auth()->user()->can('همه سفارشات') || auth()->user()->admin == 1)
        <div class="allSideBarIconsText">
            <div class="active" style="display: none" id="showList35">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#calculator"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    سیستم حسابداری
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList35">
                <i>
                    <svg class="icon">
                        <use xlink:href="#calculator"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    سیستم حسابداری
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList35" class="active">
                <li>
                    <a href="/admin/pay/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        افزودن سفارش / فاکتور
                    </a>
                </li>
                <li>
                    <a href="/admin/cost/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            افزودن هزینه
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/cost">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            همه هزینه ها
                            <span class="countData">{{\App\Models\Pay::where('back' , 4)->count()}}</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/pay/returned">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            مرجوعی محصولات
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/statistics/product">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            آمارگیری فروش هر محصول
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/cost-benefit">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        <span class="sidemenu-label">
                            سود و زیان فروشگاه
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        @if(auth()->user()->can('وضعیت موجودی') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList9">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#car"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">سیستم انبارداری</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList9">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#car"></use>
                        </svg>
                    </i>
                    سیستم انبارداری
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList9" class="active">
                    <li>
                        <a href="/admin/tank">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                            ورودی و خروجی انبار ها
                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/inventory">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            انبارداری محصولات
                        </a>
                    </li>
                    <li>
                        <a href="/admin/inquiry">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            استعلام موجودی
                        </a>
                    </li>
                    <li>
                        <a href="/admin/empty">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                محصولات تمام شده
                                <span class="countData">{{\App\Models\Product::where('count' , 0)->count()}}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('کد تخفیف') || auth()->user()->can('کیف پول') || auth()->user()->can('گردونه شانس') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList7">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#discount"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    مارکتینگ و تخفیف
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList7">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#discount"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                     مارکتینگ و تخفیف
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList7" class="active">
                    @if(auth()->user()->can('فعالیت ها') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/notification/sms">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    ارسال پیامک به کاربر
                                    <span class="countData">{{\App\Models\Event::where('type',1)->count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('فعالیت ها') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/notification/email">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    ارسال ایمیل به کاربر
                                    <span class="countData">{{\App\Models\Event::where('type',2)->count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('فعالیت ها') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/subscribe">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    خبرنامه
                                    <span class="countData">{{\App\Models\Subscribe::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('کد تخفیف') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/discount">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    کد تخفیف
                                    <span class="countData">{{\App\Models\Discount::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('کیف پول') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/wallet">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    شارژ کیف پول
                                    <span class="countData">{{\App\Models\Wallet::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('گردونه شانس') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/lucky">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    گردونه شانس
                                    <span class="countData">{{\App\Models\Lucky::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('کد تخفیف') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/converter">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    تبدیل امتیاز
                                    <span class="countData">{{\App\Models\Converter::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('قرعه کشی') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/lottery">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                     همه قرعه کشی ها
                                    <span class="countData">{{\App\Models\Lottery::count()}}</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/lottery/code">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                <span class="sidemenu-label">
                                    همه کد های قرعه کشی
                                    <span class="countData">{{\App\Models\LotteryCode::count()}}</span>
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('همه بلاگ ها') || auth()->user()->can('افزودن بلاگ') || auth()->user()->admin == 1)
        <div class="allSideBarIconsText">
            <div class="active" style="display: none" id="showList6">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#news"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    بلاگ
                    <span class="countData">{{\App\Models\News::count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList6">
                <i>
                    <svg class="icon">
                        <use xlink:href="#news"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">
                    بلاگ
                    <span class="countData">{{\App\Models\News::count()}}</span>
                </span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList6" class="active">
                @if(auth()->user()->can('همه بلاگ ها') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/blog">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        همه بلاگ ها
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('افزودن بلاگ') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/blog/create">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        افزودن بلاگ
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @endif
        @if(auth()->user()->can('برگه ها') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList15">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#page"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        برگه
                        <span class="countData">{{\App\Models\Page::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList15">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#page"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        برگه
                        <span class="countData">{{\App\Models\Page::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList15" class="active">
                    <li>
                        <a href="/admin/page">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه برگه ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/page/create">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزودن برگه
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('تاکسونامی') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList3">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#box"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">تاکسونامی</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList3">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#box"></use>
                        </svg>
                    </i>
                    تاکسونامی
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList3" class="active">
                    <li>
                        <a href="/admin/brand">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                برند ها
                                <span class="countData">{{\App\Models\Brand::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/category">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                دسته بندی ها
                                <span class="countData">{{\App\Models\Category::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tag">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                برچسب
                                <span class="countData">{{\App\Models\Tag::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/guarantee">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                گارانتی
                                <span class="countData">{{\App\Models\Guarantee::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/time">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                زمان
                                <span class="countData">{{\App\Models\Time::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/carrier">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                حامل
                                <span class="countData">{{\App\Models\Carrier::count()}}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('همه کاربر ها') || auth()->user()->can('افزودن کاربر') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList11">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#user"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        کاربران
                        <span class="countData">{{\App\Models\User::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList11">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#user"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        کاربران
                        <span class="countData">{{\App\Models\User::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList11" class="active">
                    @if(auth()->user()->can('افزودن کاربر') || auth()->user()->admin == 1)
                        <li>
                            <a href="/admin/user/create">
                                <i>
                                    <svg class="icon">
                                        <use xlink:href="#left"></use>
                                    </svg>
                                </i>
                                افزودن کاربر
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->can('همه کاربر ها') || auth()->user()->admin == 1)
                    <li>
                        <a href="/admin/user">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه کاربران
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('ویجت') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList4">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#widget"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ویجت
                        <span class="countData">{{\App\Models\Widget::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList4">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#widget"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ویجت
                        <span class="countData">{{\App\Models\Widget::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList4" class="active">
                    <li>
                        <a href="/admin/widget">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                ویجت ها
                                <span class="countData">{{\App\Models\Widget::where('responsive',0)->count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/widget/mobile">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                ویجت های حالت موبایل
                                <span class="countData">{{\App\Models\Widget::where('responsive',1)->count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/widget/create">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزودن ویجت
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('همه کاربر ها') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/role">
                <div class="active" style="display: none" id="showList38">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#secure"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        مقام
                        <span class="countData">{{\Spatie\Permission\Models\Role::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList38">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#secure"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        مقام
                        <span class="countData">{{\Spatie\Permission\Models\Role::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/barcode">
                <div class="active" style="display: none" id="showList37">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#barcode"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ساخت کیوآر
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList37">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#barcode"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ساخت کیوآر
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('وام') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/loan">
                <div class="active" style="display: none" id="showList27">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#loan"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        وام درخواستی
                        <span class="countData">{{\App\Models\Loan::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList27">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#loan"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        وام درخواستی
                        <span class="countData">{{\App\Models\Loan::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('لینک هدر') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/link">
                <div class="active" style="display: none" id="showList16">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#tag"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        لینک هدر
                        <span class="countData">{{\App\Models\Link::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList16">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#tag"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        لینک هدر
                        <span class="countData">{{\App\Models\Link::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('بررسی فروشنده') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList23">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#seller"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        فروشنده
                        <span class="countData">{{\App\Models\User::permission('فروشنده')->count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList23">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#seller"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        فروشنده
                        <span class="countData">{{\App\Models\User::permission('فروشنده')->count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList23" class="active">
                    <li>
                        <a href="/admin/document">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                بررسی مدارک و فروشنده
                                <span class="countData">{{\App\Models\Document::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/sellers">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            فروشندگان
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('خروجی اکسل') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList21">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#excel2"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">اکسل</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList21">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#excel2"></use>
                        </svg>
                    </i>
                    اکسل
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList21" class="active">
                    <li>
                        <a href="/admin/import">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            درون ریزی اکسل
                        </a>
                    </li>
                    <li>
                        <a href="/admin/excel">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            خروجی اکسل
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('ارز') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/currency">
                <div class="active" style="display: none" id="showList29">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#currency"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ارز
                        <span class="countData">{{\App\Models\Currency::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList29">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#currency"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        ارز
                        <span class="countData">{{\App\Models\Currency::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('درخواست ها') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList18">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#ticket2"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        درخواست ها
                        <span class="countData">{{\App\Models\Ticket::count()+\App\Models\Counseling::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList18">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#ticket2"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        درخواست ها
                        <span class="countData">{{\App\Models\Ticket::count()+\App\Models\Counseling::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList18" class="active">
                    <li>
                        <a href="/admin/ticket">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                درخواست ها
                                <span class="countData">{{\App\Models\Ticket::count()}}</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/counseling">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            <span class="sidemenu-label">
                                مشاوره فوری
                                <span class="countData">{{\App\Models\Counseling::count()}}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('آمارگیری') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList13">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#chart"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">آمارگیری</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList13">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#chart"></use>
                        </svg>
                    </i>
                    آمارگیری
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList13" class="active">
                    <li>
                        <a href="/admin/chart?date=0">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            آمارگیری امروز
                        </a>
                    </li>
                    <li>
                        <a href="/admin/chart?date=1">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            آمارگیری دیروز
                        </a>
                    </li>
                    <li>
                        <a href="/admin/chart?date=2">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            آمارگیری این هفته
                        </a>
                    </li>
                    <li>
                        <a href="/admin/chart?date=3">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            آمارگیری این ماه
                        </a>
                    </li>
                    <li>
                        <a href="/admin/chart?date=4">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            آمارگیری امسال
                        </a>
                    </li>
                </ul>
            </div>
    @endif
        @if(auth()->user()->can('تنظیمات دسته بندی') || auth()->user()->can('تنظیمات پیامک') || auth()->user()->can('تنظیمات شناور') || auth()->user()->can('تنظیمات سئو') || auth()->user()->can('تنظیمات پرداخت') || auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
        <div class="allSideBarIconsText">
            <div class="active" style="display: none" id="showList5">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                <i>
                    <svg class="icon">
                        <use xlink:href="#setting"></use>
                    </svg>
                </i>
                <span class="sidemenu-label">تنظیمات</span>
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </div>
            <h4 class="unActive" id="showList5">
                <i>
                    <svg class="icon">
                        <use xlink:href="#setting"></use>
                    </svg>
                </i>
                تنظیمات
                <i class="arrow">
                    <svg class="icon">
                        <use xlink:href="#left"></use>
                    </svg>
                </i>
            </h4>
            <ul id="showList5" class="active">
                @if(auth()->user()->can('تنظیمات دسته بندی') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/category">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات دسته بندی
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/manage">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات سایت
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/theme">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تغییر دمو و رنگ
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/script">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات اسکریپت ها
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات سایت') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/file">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تغییر فایل ها
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات سئو') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/seo">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات سئو
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات پرداخت') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/payment">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات درگاه پرداخت
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات پیامک') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/message">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات پیامک
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('تنظیمات شناور') || auth()->user()->admin == 1)
                <li>
                    <a href="/admin/setting/float">
                        <i>
                            <svg class="icon">
                                <use xlink:href="#left"></use>
                            </svg>
                        </i>
                        تنظیمات شناور
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @endif
        @if(auth()->user()->can('سوالات متداول') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList17">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#question"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        سوالات متداول
                        <span class="countData">{{\App\Models\Ask::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList17">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#question"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        سوالات متداول
                        <span class="countData">{{\App\Models\Ask::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList17" class="active">
                    <li>
                        <a href="/admin/ask/create">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزودن سوال
                        </a>
                    </li>
                    <li>
                        <a href="/admin/ask">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه سوالات متداول
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('تغییر قیمت') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList19">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#change"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">تغییر قیمت گروهی</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList19">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#change"></use>
                        </svg>
                    </i>
                    تغییر قیمت گروهی
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList19" class="active">
                    <li>
                        <a href="/admin/change-price/excel">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            تغییر قیمت با اکسل
                        </a>
                    </li>
                    <li>
                        <a href="/admin/change-price/increase">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزایش قیمت
                        </a>
                    </li>
                    <li>
                        <a href="/admin/change-price/decrease">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            کاهش قیمت
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('شرایط اقساط') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/pack">
                <div class="active" style="display: none" id="showList39">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#diploma"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    شرایط اقساط
                    <span class="countData">{{\App\Models\Pack::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList39">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#diploma"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    شرایط اقساط
                    <span class="countData">{{\App\Models\Pack::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('داشبورد') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/field">
                <div class="active" style="display: none" id="showList32">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#field"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">فیلد های اختصاصی</span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList32">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#field"></use>
                        </svg>
                    </i>
                    فیلد های اختصاصی
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
        @if(auth()->user()->can('دیدگاه') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList10">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#comment2"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        دیدگاه
                        <span class="countData">{{\App\Models\Comment::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList10">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#comment2"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                        دیدگاه
                        <span class="countData">{{\App\Models\Comment::count()}}</span>
                    </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList10" class="active">
                    <li>
                        <a href="/admin/comment">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه دیدگاه ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/comment?status=0">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            دیدگاه در حال بررسی
                        </a>
                    </li>
                    <li>
                        <a href="/admin/comment?status=1">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            دیدگاه تایید شده
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('برگه ها') || auth()->user()->admin == 1)
            <div class="allSideBarIconsText">
                <div class="active" style="display: none" id="showList30">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#page"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    صفحه لندینگ پیج
                    <span class="countData">{{\App\Models\Land::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList30">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#page"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    صفحه لندینگ پیج
                    <span class="countData">{{\App\Models\Land::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
                <ul id="showList30" class="active">
                    <li>
                        <a href="/admin/land">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            همه لندینگ پیج ها
                        </a>
                    </li>
                    <li>
                        <a href="/admin/land/create">
                            <i>
                                <svg class="icon">
                                    <use xlink:href="#left"></use>
                                </svg>
                            </i>
                            افزودن لندینگ پیج
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        @if(auth()->user()->can('فعالیت ها') || auth()->user()->admin == 1)
            <a class="allSideBarIconsText" href="/admin/event">
                <div class="active" style="display: none" id="showList33">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <span class="shape3" style="border-left: 20px solid {{$sideColor}}"></span>
                    <span class="shape4" style="border-left: 20px solid {{$sideColor}}"></span>
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notice"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    رویداد ها
                    <span class="countData">{{\App\Models\Event::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </div>
                <h4 class="unActive" id="showList33">
                    <i>
                        <svg class="icon">
                            <use xlink:href="#notice"></use>
                        </svg>
                    </i>
                    <span class="sidemenu-label">
                    رویداد ها
                    <span class="countData">{{\App\Models\Event::count()}}</span>
                </span>
                    <i class="arrow">
                        <svg class="icon">
                            <use xlink:href="#left"></use>
                        </svg>
                    </i>
                </h4>
            </a>
        @endif
    </div>
</div>
@section('scripts2')
    <script>
        $(document).ready(function(){
            var tab = '{!! app()->view->getSections()['tab'] !!}';
            $('.allSideBarIconsText>.active').hide();
            $(".allSideBar .sideSearch button").click(function (){
                $('.allSideBarIconsText .active').hide();
                $('.allSideBarIconsText .unActive').show();
                var text = $(".allSideBar .sideSearch input").val();
                var gg = $('.allSideBar .allSideBarItem .allSideBarIconsText:contains('+text+')');
                var text5 = $('.allSideBar .allSideBarItem .allSideBarIconsText a:contains('+text+')');
                $(gg[0]).find('.unActive').hide();
                $(gg[0]).find('.active').show();
                $(text5[0]).css({'color' : 'red'});
                $('.allSideBarItem').animate({
                    scrollTop: 0
                }, 0);
                $('.allSideBarItem').animate({
                    scrollTop: $(gg).offset().top - 150
                }, 1000);
            })
            if(tab == 0){
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 1){
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 2){
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 3){
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 4){
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 5){
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 6){
                $('.allSideBarIconsText>#showList7').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 7){
                $('.allSideBarIconsText>#showList8').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 8){
                $('.allSideBarIconsText>#showList9').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 9){
                $('.allSideBarIconsText>#showList10').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 10){
                $('.allSideBarIconsText>#showList11').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 11){
                $('.allSideBarIconsText>#showList12').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 12){
                $('.allSideBarIconsText>#showList13').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 13){
                $('.allSideBarIconsText>#showList14').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 14){
                $('.allSideBarIconsText>#showList15').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 15){
                $('.allSideBarIconsText>#showList16').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 16){
                $('.allSideBarIconsText>#showList17').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 17){
                $('.allSideBarIconsText>#showList18').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 18){
                $('.allSideBarIconsText>#showList19').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 19){
                $('.allSideBarIconsText>#showList20').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 20){
                $('.allSideBarIconsText>#showList21').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 21){
                $('.allSideBarIconsText>#showList22').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 22){
                $('.allSideBarIconsText>#showList23').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 23){
                $('.allSideBarIconsText>#showList24').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 24){
                $('.allSideBarIconsText>#showList25').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 25){
                $('.allSideBarIconsText>#showList26').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 26){
                $('.allSideBarIconsText>#showList27').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 27){
                $('.allSideBarIconsText>#showList28').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 28){
                $('.allSideBarIconsText>#showList29').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 29){
                $('.allSideBarIconsText>#showList30').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 30){
                $('.allSideBarIconsText>#showList31').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 31){
                $('.allSideBarIconsText>#showList32').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 32){
                $('.allSideBarIconsText>#showList33').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 33){
                $('.allSideBarIconsText>#showList34').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 34){
                $('.allSideBarIconsText>#showList35').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 35){
                $('.allSideBarIconsText>#showList36').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 36){
                $('.allSideBarIconsText>#showList37').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 37){
                $('.allSideBarIconsText>#showList38').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            if(tab == 38){
                $('.allSideBarIconsText>#showList39').each(function() {
                    if($( this ).attr('class') == 'active'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
            $('.allSideBarIconsText>#showList1').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList1').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList2').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList2').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList3').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList3').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList4').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList4').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList5').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList5').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList6').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList6').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList7').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList7').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList8').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList8').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList9').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList9').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList10').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList10').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList11').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList11').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList12').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList12').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList13').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList13').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList15').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList15').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList17').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList17').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList18').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList18').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList19').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList19').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList20').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList20').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList21').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList21').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList22').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList22').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList23').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList23').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList24').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList24').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList25').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList25').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList26').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList26').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList27').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList27').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList28').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList28').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList29').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList29').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList30').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList30').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList31').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList31').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList32').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList32').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList33').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList33').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList34').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList34').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList35').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList35').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList36').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList36').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList37').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList37').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList38').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList38').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
            $('.allSideBarIconsText>#showList39').click(function (e){
                $('.allSideBarIconsText>.unActive').each(function() {
                    $(this).show();
                });
                $('.allSideBarIconsText>.active').each(function() {
                    $(this).hide();
                });
                $('.allSideBarIconsText>#showList39').each(function() {
                    if($( this ).attr('class') != e.currentTarget.className){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            })
        })
    </script>
@endsection
