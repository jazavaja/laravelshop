@extends('admin.master')

@section('tab' , 34)
@section('content')
    <div class="allPayPanel">
        <div class="topProductIndex">
            <div class="right">
                <a href="/admin">داشبورد</a>
                <span>/</span>
                <a href="/admin/cost-benefit">سود و زیان فروشگاه</a>
            </div>
        </div>
        @if (\Session::has('message'))
            <div class="alert">
                {!! \Session::get('message') !!}
            </div>
        @endif
        <div class="allStatistics">
            <div class="right">
                <h3>آمارگیری این ماه</h3>
                <div class="item">
                    <h4>سود خالص</h4>
                    <h5>{{number_format($profitsMonth + $directMonth - $costMonth)}} تومان</h5>
                </div>
                <div class="item">
                    <h4>هزینه ها</h4>
                    <h5>{{number_format($costMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>فروش به جز هزینه حمل</h4>
                    <h5>{{number_format($payPriceMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>هزینه حمل</h4>
                    <h5>{{number_format($carrierPriceMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>مرجوعی</h4>
                    <h5>{{number_format($backsMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>واریز مستقیم</h4>
                    <h5>{{number_format($directMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت از درگاه</h4>
                    <h5>{{number_format($gatePayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت از کیف پول</h4>
                    <h5>{{number_format($walletPayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت در محل</h4>
                    <h5>{{number_format($homePayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت اقساطی</h4>
                    <h5>{{number_format($installPayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>خرید فوری</h4>
                    <h5>{{number_format($quickPayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت کارت به کارت</h4>
                    <h5>{{number_format($cardPayMonth)}}</h5>
                </div>
                <div class="item">
                    <h4>تعداد محصول فروخته شده</h4>
                    <h5>{{number_format($productsMonth)}}</h5>
                </div>
            </div>
            <div class="left">
                <h3>آمارگیری کلی</h3>
                <div class="item">
                    <h4>سود خالص</h4>
                    <h5>{{number_format($profits + $direct - $cost)}} تومان</h5>
                </div>
                <div class="item">
                    <h4>هزینه ها</h4>
                    <h5>{{number_format($cost)}}</h5>
                </div>
                <div class="item">
                    <h4>فروش به جز هزینه حمل</h4>
                    <h5>{{number_format($payPrice)}}</h5>
                </div>
                <div class="item">
                    <h4>هزینه حمل</h4>
                    <h5>{{number_format($carrierPrice)}}</h5>
                </div>
                <div class="item">
                    <h4>مرجوعی</h4>
                    <h5>{{number_format($backs)}}</h5>
                </div>
                <div class="item">
                    <h4>واریز مستقیم</h4>
                    <h5>{{number_format($direct)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت از درگاه</h4>
                    <h5>{{number_format($gatePay)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت از کیف پول</h4>
                    <h5>{{number_format($walletPay)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت در محل</h4>
                    <h5>{{number_format($homePay)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت اقساطی</h4>
                    <h5>{{number_format($installPay)}}</h5>
                </div>
                <div class="item">
                    <h4>خرید فوری</h4>
                    <h5>{{number_format($quickPay)}}</h5>
                </div>
                <div class="item">
                    <h4>پرداخت کارت به کارت</h4>
                    <h5>{{number_format($cardPay)}}</h5>
                </div>
                <div class="item">
                    <h4>تعداد محصول فروخته شده</h4>
                    <h5>{{number_format($products)}}</h5>
                </div>
            </div>
        </div>
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

