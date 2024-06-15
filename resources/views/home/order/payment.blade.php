@extends('home.master')

@section('title' , __('messages.direct_payment') . ' - ')
@section('content')
    <div class="allTracking">
        <div class="trackingTitle">
            <h4 class="width">{{__('messages.direct_payment')}}</h4>
        </div>
        <form class="trackingData paymentData width" method="POST" action="/direct-order">
            @csrf
            <input type="hidden" name="gate" value="{{\App\Models\Setting::where('key' , 'choicePay')->pluck('value')->first()}}">
            <div class="right">
                <div class="trackingItems">
                    <div class="trackingItem">
                        <label for="price1">{{__('messages.price_arz')}} *</label>
                        <input type="text" name="price" id="price1" placeholder="{{__('messages.price_arz')}}">
                        @error('price')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="trackingItem">
                        <label for="phone1">{{__('messages.buyer_number')}} *</label>
                        <input type="text" id="phone1" name="phone" placeholder="{{__('messages.buyer_number')}}">
                        @error('phone')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="trackingItem">
                        <label for="body1">{{__('messages.body')}} *</label>
                        <input type="text" id="body1" name="body" placeholder="{{__('messages.body')}}">
                        @error('body')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="left">
                @if(\App\Models\Setting::where('key' , 'captchaStatus')->pluck('value')->first())
                    <div class="trackingItem">
                        <label for="security_code1">{{__('messages.security_code')}} *</label>
                        <input type="text" id="security_code1" name="captcha" placeholder="{{__('messages.security_code')}}">
                        @error('captcha')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="captchaQuick">
                            @if(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 0)
                                {!! \Mews\Captcha\Facades\Captcha::img('math') !!}
                            @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 1)
                                {!! \Mews\Captcha\Facades\Captcha::img('inverse') !!}
                            @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 2)
                                {!! \Mews\Captcha\Facades\Captcha::img('mini2') !!}
                            @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 3)
                                {!! \Mews\Captcha\Facades\Captcha::img('default') !!}
                            @elseif(\App\Models\Setting::where('key' , 'captchaType')->pluck('value')->first() == 4)
                                {!! \Mews\Captcha\Facades\Captcha::img('mini') !!}
                            @endif
                        </div>
                    </div>
                @endif
                <div class="gatePay">
                    @if($statusSadad)
                        <label class="gateItem" id="5">
                            <img src="/img/sadad.png" alt="method">
                        </label>
                    @endif
                    @if($statusBeh)
                        <label class="gateItem" id="4">
                            <img src="/img/behpardakht.png" alt="method">
                        </label>
                    @endif
                    @if($idpayStatus)
                        <label class="gateItem" id="3">
                            <img src="/img/idpay.png" alt="method">
                        </label>
                    @endif
                    @if($nextpayStatus)
                        <label class="gateItem" id="2">
                            <img src="/img/nextpay.png" alt="method">
                        </label>
                    @endif
                    @if($zarinpalStatus)
                        <label class="gateItem active" id="0">
                            <img src="/img/zarinpal.svg" alt="method">
                        </label>
                    @endif
                    @if($zibalStatus)
                        <label class="gateItem" id="1">
                            <img src="/img/zibal.png" alt="method">
                        </label>
                    @endif
                    @if($statusAsan)
                        <label class="gateItem" id="6">
                            <img src="/img/asanPardakht.jpg" alt="method">
                        </label>
                    @endif
                    @if($statusPasargad)
                        <label class="gateItem" id="7">
                            <img src="/img/pasargad.png" alt="method">
                        </label>
                    @endif
                </div>
                <div class="buttons">
                    <button>{{__('messages.submit_payment')}}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script1')
    <script>
        $(document).ready(function(){
            $('.allTracking .gateItem').on('click' , function(){
                $.each($('.allTracking .gateItem'),function(){
                    $(this).attr('class' , 'gateItem');
                })
                $(this).attr('class','gateItem active');
                $(".allTracking form input[name='gate']").val($(this).attr('id'));
            });
        })
    </script>
@endsection
