<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Carrier;
use App\Models\CarrierCity;
use App\Models\Cart;
use App\Models\Collection;
use App\Models\Cooperation;
use App\Models\Discount;
use App\Models\Guarantee;
use App\Models\Installments;
use App\Models\Lottery;
use App\Models\LotteryCode;
use App\Models\Pack;
use App\Models\Pay;
use App\Models\PayMeta;
use App\Models\Product;
use App\Models\Score;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class ShopController extends Controller
{
    use SendSmsTrait;
    public function getCarrier($car,$amount){
        $sends1 = Carrier::where(function ($query) use ($car){
            $query->where("id", $car)
                ->orWhere("name", $car);
        })->first();
        if($sends1){
            if($sends1['limit'] <= $amount){
                return 0;
            }else{
                if(\auth()->user()){
                    if(CarrierCity::where('carrier' , $car)->where('city' , auth()->user()->address()->where('show' , 1)->where('status',1)->pluck('city')->first())->first()){
                        return CarrierCity::where('carrier' , $car)->where('city' , auth()->user()->address()->where('show' , 1)->where('status',1)->pluck('city')->first())->pluck('price')->first();
                    }else{
                        return $sends1['price'];
                    }
                }else{
                    return $sends1['price'];
                }
            }
        }else{
            return 0;
        }
    }
    public function installments(Request $request){
        $installmentStatus = Setting::where('key' , 'installment')->pluck('value')->first();
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        if($installmentStatus == 0){
            return redirect()->back()->with([
                'message' => __('messages.no_install')
            ]);
        }
        $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
        $time = Carbon::now()->format('Y-m-d h:i:s');
        $name = auth()->user()->name;
        if(!$request->carrier){
            return redirect()->back()->with([
                'message' => __('messages.select_carrier')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->carrier()->detach();
                $value->carrier()->sync($request->carrier);
            }
        }
        if(!$request->time){
            return redirect()->back()->with([
                'message' => __('messages.select_time2')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'time' => $request->time
                ]);
            }
        }
        if(!$address){
            return redirect()->back()->with([
                'message' => __('messages.select_address5')
            ]);
        }
        if (auth()->user()->cart()->where('number' , 0)->count() >= 1) {
            $number = auth()->user()->number;
            $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
            $checkCart = $this->checkCart($count);

            if($checkCart[0] == 'size'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count1',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'color'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count2',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'item'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count3')
                ]);
            }

            $amount = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $allSum2 = (int)$count[$i]['price'] * (int)$count[$i]['count'];
                $amount = $amount + (int)$allSum2;
                if($count[$i]->discount){
                    $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                    if ($discount) {
                        if($discount['day']){
                            $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                        }
                        if($count[$i]['product_id'] == $discount['product_id']){
                            $amount = $amount - (($amount * $discount->percent) / 100);
                        }
                    }
                }
            }

            $sends = $this->getCarrier($request->carrier,$amount);
            $amount = (int)$amount + (int)$sends;

            $discountId= null;
            if($count[0]->discount){
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $amount = $amount - ($amount * $discount->percent) / 100;
                    $discountId = $discount->percent;
                    $discount->update([
                        'count'=> --$discount->count
                    ]);
                }
            }

            if($request->pack){
                $pack = Pack::where('id' , $request->pack)->first();
                if($pack){
                    $amountA = ($amount * $pack->percent) / 100;
                    $amount = (int)$amount + (int)$amountA;
                }
            }
            $carrierData = Carrier::where('id' , $request->carrier)->pluck('name')->first();
            $code = Pay::buildCode();
            $pay = Pay::create([
                'refId'=>'اقساط',
                'status'=> 10,
                'property'=>$code,
                'time' => $count[0]->time,
                'price'=>$amount,
                'method'=>3,
                'note'=>$request->note,
                'discount_off'=>$discountId,
                'user_id'=>auth()->user()->id,
                'auth'=>'اقساط',
                'carrier'=> $carrierData,
                'carrier_price'=> $sends,
            ]);
            if($request->pack){
                $pack = Pack::where('id' , $request->pack)->first();
                if($pack){
                    $price = round((int)$amount / (int)$pack['count']);
                    $month = round($pack['month'] / (int)$pack['count']);
                    $i = 1;
                    foreach($request->installName as $item) {
                        $time = verta()->addMonth($i*$month)->formatJalaliDate();
                        Installments::create([
                            'title' => $item,
                            'price' => $price,
                            'time' => $time,
                            'status' => 0,
                            'pay' => '',
                            'user_id' => $pay['user_id'],
                            'pay_id' => $pay['id'],
                        ]);
                        $i++;
                    }
                }
            }
            if($cooperationStatus == 1 ){
                $priceCo = $pay['price'] * $cooperationPercent / 100;
                $users = User::where('referral' , auth()->user()->parent_id)->first();
                if($users){
                    Cooperation::create([
                        'user_id' => $users['id'],
                        'percent' => $cooperationPercent,
                        'meta_id' => auth()->user()->id,
                        'pay_id' => $pay['id'],
                        'price' => $priceCo,
                        'type' => 0,
                        'status' => 10,
                    ]);
                }
            }
            $pay->address()->attach($address->id);
            $score = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $discountId = $discount->percent;
                    $discount->update([
                        'count'=> --$discount->count
                    ]);
                    $getPrice = ( $count[$i]->price - (($count[$i]['price'] * $discount->percent) / 100)) * $count[$i]->count;
                }
                else{
                    $discountId = null;
                    $getPrice = $count[$i]->price * $count[$i]->count;
                }

                $guarantee = Guarantee::where('id' , $count[$i]->guarantee_id)->pluck('name')->first();
                if($count[$i]->pack == 1){
                    $product_id = 0;
                    $collect_id = $count[$i]->collect_id;
                    $profit = 0;
                }else{
                    $product_id = $count[$i]->product_id;
                    $collect_id = 0;
                    $profit = Product::where('id' , $count[$i]->product_id)->pluck('priceBuy')->first();
                }
                $payMeta = PayMeta::create([
                    'product_id' => $product_id,
                    'collect_id' => $collect_id,
                    'user_id' => $count[$i]->user_id,
                    'pay_id' => $pay->id,
                    'discount_off'=>$discountId,
                    'status'=>10,
                    'price'=> $getPrice,
                    'count' => $count[$i]->count,
                    'prebuy' => $count[$i]->prebuy,
                    'method'=>3,
                    'profit'=>$getPrice - $profit,
                    'color' => $count[$i]->color,
                    'size' => $count[$i]->size,
                    'guarantee_name'=> $guarantee
                ]);
                $payMeta->address()->attach($address->id);

                $post = Product::where('id', $count[$i]->product_id)->first();
                $post->update([
                    'count' => $post->count - $count[$i]['count']
                ]);
                if ($count[$i]['color']){
                    $cartColor = $count[$i]['color'];
                    $colors = [];
                    foreach (json_decode($post['colors'] , true) as $item) {
                        if($item['name'] == $cartColor){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($colors , $item);
                    }
                    $post->update([
                        'colors' => json_encode($colors),
                    ]);
                }
                if ($count[$i]['size']){
                    $cartSize = $count[$i]['size'];
                    $sizes = [];
                    foreach (json_decode($post['size'] , true) as $item) {
                        if($item['name'] == $cartSize){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($sizes , $item);
                    }
                    $post->update([
                        'size' => json_encode($sizes),
                    ]);
                }
                $allSum2 = (int)$post['score'] * (int)$count[$i]['count'];
                $score = $score + (int)$allSum2;
            }
            $this->notificationBuy($pay);
            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>auth()->user()->id,
                ]);
            }
            auth()->user()->cart()->where('number' , 0)->delete();
            return view('home.cart.buy' , compact('pay' , 'name'));
        } else {
            return redirect('/cart');
        }
    }

    public function card(Request $request){
        $cardStatus = Setting::where('key' , 'card')->pluck('value')->first();
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        if($cardStatus == 0){
            return redirect()->back()->with([
                'message' => __('messages.no_card')
            ]);
        }
        $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
        $time = Carbon::now()->format('Y-m-d h:i:s');
        $name = auth()->user()->name;
        if(!$request->carrier){
            return redirect()->back()->with([
                'message' => __('messages.select_carrier')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->carrier()->detach();
                $value->carrier()->sync($request->carrier);
            }
        }
        if(!$request->time){
            return redirect()->back()->with([
                'message' => __('messages.select_time2')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'time' => $request->time
                ]);
            }
        }
        if(!$address){
            return redirect()->back()->with([
                'message' => __('messages.select_address5')
            ]);
        }
        if (auth()->user()->cart()->where('number' , 0)->count() >= 1) {
            $number = auth()->user()->number;
            $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
            $checkCart = $this->checkCart($count);

            if($checkCart[0] == 'size'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count1',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'color'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count2',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'item'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count3')
                ]);
            }

            $amount = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $allSum2 = (int)$count[$i]['price'] * (int)$count[$i]['count'];
                $amount = $amount + (int)$allSum2;
                if($count[$i]->discount){
                    $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                    if ($discount) {
                        if($discount['day']){
                            $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                        }
                        if($count[$i]['product_id'] == $discount['product_id']){
                            $amount = $amount - (($amount * $discount->percent) / 100);
                        }
                    }
                }
            }


            $sends = $this->getCarrier($request->carrier,$amount);
            $amount = (int)$amount + (int)$sends;

            $discountId= null;
            if($count[0]->discount){
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $amount = $amount - ($amount * $discount->percent) / 100;
                    $discountId = $discount->percent;
                    $discount->update([
                        'count'=> --$discount->count
                    ]);
                }
            }

            $carrierData = Carrier::where('id' , $request->carrier)->pluck('name')->first();
            $code = Pay::buildCode();
            $pay = Pay::create([
                'refId'=>'کارت به کارت',
                'status'=> 10,
                'property'=>$code,
                'time' => $count[0]->time,
                'price'=>$amount,
                'note'=>$request->note,
                'method'=>5,
                'discount_off'=>$discountId,
                'user_id'=>auth()->user()->id,
                'auth'=>'کارت به کارت',
                'carrier'=> $carrierData,
                'carrier_price'=> $sends,
            ]);
            $pay->address()->attach($address->id);
            $score = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $discountId = $discount->percent;
                    $discount->update([
                        'count'=> --$discount->count
                    ]);
                    $getPrice = ( $count[$i]->price - (($count[$i]['price'] * $discount->percent) / 100)) * $count[$i]->count;
                }
                else{
                    $discountId = null;
                    $getPrice = $count[$i]->price * $count[$i]->count;
                }

                $guarantee = Guarantee::where('id' , $count[$i]->guarantee_id)->pluck('name')->first();
                if($count[$i]->pack == 1){
                    $product_id = 0;
                    $collect_id = $count[$i]->collect_id;
                    $profit = 0;
                }else{
                    $collect_id = 0;
                    $product_id = $count[$i]->product_id;
                    $profit = Product::where('id' , $count[$i]->product_id)->pluck('priceBuy')->first();
                }
                $payMeta = PayMeta::create([
                    'product_id' => $product_id,
                    'collect_id' => $collect_id,
                    'user_id' => $count[$i]->user_id,
                    'pay_id' => $pay->id,
                    'prebuy' => $count[$i]->prebuy,
                    'discount_off'=>$discountId,
                    'status'=>10,
                    'price'=> $getPrice,
                    'count' => $count[$i]->count,
                    'profit'=>$getPrice - $profit,
                    'method'=>5,
                    'color' => $count[$i]->color,
                    'size' => $count[$i]->size,
                    'guarantee_name'=> $guarantee
                ]);
                $payMeta->address()->attach($address->id);

                $post = Product::where('id', $count[$i]->product_id)->first();
                $post->update([
                    'count' => $post->count - $count[$i]['count']
                ]);
                if ($count[$i]['color']){
                    $cartColor = $count[$i]['color'];
                    $colors = [];
                    foreach (json_decode($post['colors'] , true) as $item) {
                        if($item['name'] == $cartColor){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($colors , $item);
                    }
                    $post->update([
                        'colors' => json_encode($colors),
                    ]);
                }
                if ($count[$i]['size']){
                    $cartSize = $count[$i]['size'];
                    $sizes = [];
                    foreach (json_decode($post['size'] , true) as $item) {
                        if($item['name'] == $cartSize){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($sizes , $item);
                    }
                    $post->update([
                        'size' => json_encode($sizes),
                    ]);
                }
                $allSum2 = (int)$post['score'] * (int)$count[$i]['count'];
                $score = $score + (int)$allSum2;
            }
            $this->notificationBuy($pay);
            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>auth()->user()->id,
                ]);
            }
            auth()->user()->cart()->where('number' , 0)->delete();
            return view('home.cart.buy' , compact('pay' , 'name'));
        } else {
            return redirect('/cart');
        }
    }

    public function direct(Request $request){
        if (Setting::where('key' , 'captchaStatus')->pluck('value')->first()){
            $request->validate([
                'price' => 'required|integer|min:5000',
                'body' => 'required',
                'phone' => 'required',
                'captcha' => ['required', 'captcha'],
            ]);
        }else{
            $request->validate([
                'price' => 'required|integer|min:5000',
                'phone' => 'required',
                'body' => 'required',
            ]);
        }
        if(auth()->user()){
            $user2 = User::where('id' , auth()->user()->id)->first();
            $user = $user2['id'];
        }else{
            $user2 = User::where('number' , $request->phone)->first();
            if($user2){
                $user = $user2['id'];
            }else{
                $code = User::buildCode();
                $user2 = User::create([
                    'name' => time(),
                    'password' => Hash::make(rand(100000, 900000)),
                    'referral'=> $code,
                    'parent_id'=> 0,
                    'number' => $request->phone
                ]);
                $user = $user2['id'];
            }
        }
        $choicePay = $request->gate;
        if($choicePay == 0){
            $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
            $gate = 'zarinpal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 1){
            $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
            $gate = 'zibal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 2){
            $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
            $gate = 'nextpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 3){
            $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
            $gate = 'idpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 4){
            $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
            $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
            $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
            $gate = 'behpardakht';
            $configs = [
                'terminalId' => $terminalBeh,
                'username' => $userBeh,
                'password' => $passwordBeh,
            ];
        }
        if($choicePay == 5){
            $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
            $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
            $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
            $gate = 'sadad';
            $configs = [
                'key' => $keySadad,
                'merchantId' => $merchantSadad,
                'terminalId' => $terminalSadad,
            ];
        }
        if($choicePay == 6){
            $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
            $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
            $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
            $gate = 'asanpardakht';
            $configs = [
                'username' => $userAsan,
                'password' => $passwordAsan,
                'merchantConfigID' => $terminalAsan,
            ];
        }
        if($choicePay == 7){
            $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
            $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
            $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
            $gate = 'pasargad';
            $configs = [
                'merchantId' => $merchantPasargad,
                'terminalCode' => $terminalPasargad,
                'certificate' => $certificatePasargad,
            ];
        }
        if($choicePay == 8){
            $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
            $gate = 'sep';
            $configs = [
                'terminalId' => $merchantSaman,
            ];
        }
        $invoice = (new Invoice)->amount($request->price);
        $invoice->detail('mobile',$request->phone);
        return Payment::via($gate)->config($configs)->callbackUrl(url("/direct-shop?gate=".$choicePay))->purchase(
            $invoice,
            function($driver, $transactionId) use ($request,$user,$choicePay) {
                $code = Pay::buildCode();
                $times= '{"dayL":"","dayLEn":"","price":0,"to":"","from":"","day":"","month":"","monthEn":"","timestamp":""}';
                $pay = Pay::create([
                    'refId'=>'پرداخت مستقیم',
                    'status'=> 0,
                    'property'=>$code,
                    'time' => $times,
                    'price'=>$request->price,
                    'note'=>$request->body,
                    'gate'=>$choicePay,
                    'method'=>6,
                    'discount_off'=>0,
                    'user_id'=> $user,
                    'auth'=>$transactionId,
                    'carrier'=> null,
                    'carrier_price'=> 0,
                ]);
                session()->put('transactionId' , (string) $transactionId);
                session()->put('amount' , $request->price);
            }
        )->pay()->render();
    }

    public function direct_order(Request $request)
    {
        $choicePay = $request->gate;
        if($choicePay == ''){
            return abort(404);
        }
        $transaction_id = session()->get('transactionId');
        $transaction_amount = session()->get('amount');
        $pay = Pay::where('auth' , $transaction_id)->where('price' , $transaction_amount)->first();
        try {
            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $receipt = Payment::via($gate)->config($configs)->amount($transaction_amount)->transactionId($transaction_id)->verify();
            $pay->update([
                'status' => 100,
                'refId' => $receipt->getReferenceId(),
            ]);
            $name = '';
            return view('home.cart.buy' , compact('pay' , 'name'));
        }
        catch (InvalidPaymentException $exception) {
            return redirect('/direct-payment');
        }
    }

    public function fast(Request $request)
    {
        $choicePay = Setting::where('key' , 'choicePay')->pluck('value')->first();
        if($choicePay == 0){
            $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
            $gate = 'zarinpal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 1){
            $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
            $gate = 'zibal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 2){
            $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
            $gate = 'nextpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 3){
            $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
            $gate = 'idpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 4){
            $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
            $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
            $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
            $gate = 'behpardakht';
            $configs = [
                'terminalId' => $terminalBeh,
                'username' => $userBeh,
                'password' => $passwordBeh,
            ];
        }
        if($choicePay == 5){
            $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
            $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
            $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
            $gate = 'sadad';
            $configs = [
                'key' => $keySadad,
                'merchantId' => $merchantSadad,
                'terminalId' => $terminalSadad,
            ];
        }
        if($choicePay == 6){
            $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
            $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
            $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
            $gate = 'asanpardakht';
            $configs = [
                'username' => $userAsan,
                'password' => $passwordAsan,
                'merchantConfigID' => $terminalAsan,
            ];
        }
        if($choicePay == 7){
            $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
            $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
            $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
            $gate = 'pasargad';
            $configs = [
                'merchantId' => $merchantPasargad,
                'terminalCode' => $terminalPasargad,
                'certificate' => $certificatePasargad,
            ];
        }
        if($choicePay == 8){
            $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
            $gate = 'sep';
            $configs = [
                'terminalId' => $merchantSaman,
            ];
        }
        $pay1 = Pay::where('property' , $request->order)->whereNotIn('status' , [100,50])->first();
        if(!$pay1){
            return abort(404);
        }
        $invoice = (new Invoice)->amount($pay1->price);
        return Payment::via($gate)->config($configs)->callbackUrl(url("/fast-shop?order=".$pay1->property))->purchase(
            $invoice,
            function($driver, $transactionId) use ($pay1) {
                session()->put('transactionId' , (string) $transactionId);
                session()->put('transactionProperty' , $pay1->property);
                session()->put('amount' , $pay1->price);
            }
        )->pay()->render();
    }

    public function fast_order(Request $request)
    {
        $choicePay = Setting::where('key' , 'choicePay')->pluck('value')->first();
        $transaction_id = session()->get('transactionId');
        $transactionProperty = session()->get('transactionProperty');
        $transaction_amount = session()->get('amount');
        $pay = Pay::where('property' , $transactionProperty)->where('price' , $transaction_amount)->whereNotIn('status' , [100,50])->first();
        if(!$pay){
            return abort(404);
        }
        try {
            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $receipt = Payment::via($gate)->config($configs)->amount($transaction_amount)->transactionId($transaction_id)->verify();
            $pay->update([
                'status' => 100,
                'method' => 0,
                'refId' => $receipt->getReferenceId(),
                'gate'=>$choicePay,
            ]);
            foreach ($pay->payMeta as $val){
                $val->update([
                    'status' => 100,
                ]);
            }
            $this->notificationBuy($pay);
            $name = $pay->address()->pluck('name')->first();
            return view('home.cart.buy' , compact('pay' , 'name'));
        }
        catch (InvalidPaymentException $exception) {
            return __('messages.no_count3');
        }
    }

    public function quickBuy(Request $request)
    {
        $myCart = request()->cookie('quickBuy');
        $myData = json_decode($myCart);
        $choicePay = Setting::where('key' , 'choicePay')->pluck('value')->first();
        $user = User::where('id' , $myData->user)->first();

        if(!$myData->carrier){
            return __('messages.select_carrier');
        }

        if(!$myData->address){
            return __('messages.select_address5');
        }

        $product = Product::where('id', $myData->product)->first();
        $amount = $product->price;
        if($product['colors']){
            foreach(json_decode($product['colors']) as $item){
                if($item->name == $myData->color){
                    $amount = (int)$amount + (int)$item->price;
                }
            }
        }
        if($product['size']){
            foreach(json_decode($product['size']) as $item){
                if($item->name == $myData->size){
                    $amount = (int)$amount + (int)$item->price;
                }
            }
        }

        $amount = $amount * $myData->count;

        $sends1 = Carrier::where('name' , $myData->carrier)->first();
        $sends = $this->getCarrier($myData->carrier,$amount);
        $amount = (int)$amount + (int)$sends;

        if($choicePay == 0){
            $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
            $gate = 'zarinpal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 1){
            $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
            $gate = 'zibal';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 2){
            $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
            $gate = 'nextpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 3){
            $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
            $gate = 'idpay';
            $configs = [
                'merchantId' => $merchantId,
            ];
        }
        if($choicePay == 4){
            $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
            $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
            $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
            $gate = 'behpardakht';
            $configs = [
                'terminalId' => $terminalBeh,
                'username' => $userBeh,
                'password' => $passwordBeh,
            ];
        }
        if($choicePay == 5){
            $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
            $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
            $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
            $gate = 'sadad';
            $configs = [
                'key' => $keySadad,
                'merchantId' => $merchantSadad,
                'terminalId' => $terminalSadad,
            ];
        }
        if($choicePay == 6){
            $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
            $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
            $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
            $gate = 'asanpardakht';
            $configs = [
                'username' => $userAsan,
                'password' => $passwordAsan,
                'merchantConfigID' => $terminalAsan,
            ];
        }
        if($choicePay == 7){
            $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
            $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
            $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
            $gate = 'pasargad';
            $configs = [
                'merchantId' => $merchantPasargad,
                'terminalCode' => $terminalPasargad,
                'certificate' => $certificatePasargad,
            ];
        }
        if($choicePay == 8){
            $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
            $gate = 'sep';
            $configs = [
                'terminalId' => $merchantSaman,
            ];
        }
        $invoice = (new Invoice)->amount($amount);
        $invoice->detail('mobile',$myData->number);
        $property = Pay::buildCode();
        return Payment::via($gate)->config($configs)->callbackUrl(url('/quick/order'))->purchase(
            $invoice,
            function($driver, $transactionId) use ($property,$amount,$sends1,$sends,$myData,$choicePay,$product,$user) {
                $times= '{"dayL":"","dayLEn":"","price":0,"to":"","from":"","day":"","month":"","monthEn":"","timestamp":""}';
                $pay = Pay::create([
                    'refId'=>'',
                    'status'=>0,
                    'property'=>$property,
                    'price'=>$amount,
                    'gate'=>$choicePay,
                    'user_id'=>$user->id,
                    'method' => 4,
                    'auth' => (string) $transactionId,
                    'time' => $times,
                    'carrier'=> $sends1['name'],
                    'carrier_price'=> $sends,
                ]);
                $pay->address()->attach($myData->address);
                $guarantee = Guarantee::where('id' , $myData->guarantee)->pluck('name')->first();
                $payMeta = PayMeta::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'pay_id' => $pay->id,
                    'prebuy' => 0,
                    'status'=>0,
                    'price'=> $amount - (int)$sends1['price'],
                    'method' => 4,
                    'profit'=>$amount - (int)$sends1['price'] - $product->priceBuy,
                    'count' => $myData->count,
                    'color' => $myData->color,
                    'size' => $myData->size,
                    'guarantee_name'=> $guarantee
                ]);
                $payMeta->address()->attach($myData->address);
                session()->put('transactionId' , (string) $transactionId);
                session()->put('amount' , $amount);
                $user->update([
                    'buy' =>$choicePay
                ]);
            }
        )->pay()->render();
    }

    public function quickOrder(Request $request)
    {
        $myCart = request()->cookie('quickBuy');
        $myData = json_decode($myCart);
        $user = User::where('id' , $myData->user)->first();
        $product = Product::where('id', $myData->product)->first();
        $choicePay = $user->buy;
        $transaction_id = session()->get('transactionId');
        $transaction_amount = session()->get('amount');
        $pay = Pay::where('auth' , $transaction_id)->where('user_id' , $user->id)->first();
        try {
            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $receipt = Payment::via($gate)->config($configs)->amount($transaction_amount)->transactionId($transaction_id)->verify();
            $pay->update([
                'status' => 100,
                'refId' => $receipt->getReferenceId(),
            ]);
            $pay->payMeta()->update([
                'status' => 100,
            ]);
            $product->update([
                'count' => $product->count - $myData->count
            ]);
            if ($myData->color){
                $cartColor = $myData->color;
                $colors = [];
                foreach (json_decode($product['colors'] , true) as $item) {
                    if($item['name'] == $cartColor){
                        $item['count'] = (int)$item['count'] - (int)$myData->count;
                    }
                    array_push($colors , $item);
                }
                $product->update([
                    'colors' => json_encode($colors),
                ]);
            }
            if ($myData->size){
                $cartSize = $myData->size;
                $sizes = [];
                foreach (json_decode($product['size'] , true) as $item) {
                    if($item['name'] == $cartSize){
                        $item['count'] = (int)$item['count'] - (int)$myData->count;
                    }
                    array_push($sizes , $item);
                }
                $product->update([
                    'size' => json_encode($sizes),
                ]);
            }
            $score = 0;
            $allSum2 = (int)$product['score'];
            $score = $score + (int)$allSum2;

            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>$user->id,
                ]);
            }
            $pay = Pay::where('auth' , $transaction_id)->where('user_id' , $user->id)->first();
            $name = $user->name;
            $this->notificationBuy($pay);
            return view('home.cart.buy' , compact('pay' , 'name'));
        } catch (InvalidPaymentException $exception) {
            $pay = Pay::where('auth' , $transaction_id)->where('user_id' , $user->id)->first();
            $name = $user->name;
            return view('home.cart.buy' , compact('pay' , 'name'));
        }
    }

    public function add_order(Request $request)
    {
        $time = Carbon::now()->format('Y-m-d h:i:s');
        $choicePay = $request->gateway;
        $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
        if(!$request->carrier){
            return redirect()->back()->with([
                'message' => __('messages.select_carrier')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->carrier()->detach();
                $value->carrier()->sync($request->carrier);
            }
        }
        if(!$request->time){
            return redirect()->back()->with([
                'message' => __('messages.select_time2')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'time' => $request->time
                ]);
            }
        }
        if(!$address){
            return redirect()->back()->with([
                'message' => __('messages.select_address5')
            ]);
        }
        if (auth()->user()->cart()->where('number' , 0)->count() >= 1) {
            $number = auth()->user()->number;
            $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
            $checkCart = $this->checkCart($count);

            if($checkCart[0] == 'size'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count1',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'color'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count2',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'item'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count3')
                ]);
            }

            $amount = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $allSum2 = (int)$count[$i]['price'] * (int)$count[$i]['count'];
                $amount = $amount + (int)$allSum2;
                if($count[$i]->discount){
                    $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                    if ($discount) {
                        if($discount['day']){
                            $discount = Discount::where('code' , $count[$i]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                        }
                        $discount->update([
                            'count'=> $discount->count - 1
                        ]);
                        if($count[$i]['product_id'] == $discount['product_id']){
                            $amount = $amount - (($amount * $discount->percent) / 100);
                        }
                    }
                }
            }
            $tax = Setting::where('key' , 'tax')->pluck('value')->first() ?? 0;
            $amount = $amount + (($amount * $tax) / 100);


            $carrierData = Carrier::where('id' , $request->carrier)->pluck('name')->first();
            $sends = $this->getCarrier($request->carrier,$amount);
            $amount = (int)$amount + (int)$sends;

            if($count[0]->discount){
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $discount->update([
                        'count'=> $discount->count - 1
                    ]);
                    $amount = $amount - ($amount * $discount->percent) / 100;
                }
            }

            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $invoice = (new Invoice)->amount($amount);
            $invoice->detail('mobile',auth()->user()->number);
            $property = Pay::buildCode();
            return Payment::via($gate)->config($configs)->callbackUrl(url('/order'))->purchase(
                $invoice,
                function($driver, $transactionId) use ($property,$amount,$tax,$choicePay,$sends,$carrierData,$request,$count) {
                    $time = Carbon::now()->format('Y-m-d h:i:s');
                    $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
                    $pay = Pay::create([
                        'refId'=>'',
                        'status'=>0,
                        'tax'=>$tax,
                        'property'=>$property,
                        'price'=>$amount,
                        'gate'=>$choicePay,
                        'note'=>$request->note,
                        'user_id'=>auth()->user()->id,
                        'method' => 4,
                        'auth' => (string) $transactionId,
                        'time' => $count[0]->time,
                        'carrier'=> $carrierData,
                        'carrier_price'=> $sends,
                    ]);
                    $pay->address()->attach($address->id);
                    for ( $i = 0; $i < count($count); $i++) {
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                        if($discount){
                            if($discount['day']){
                                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                            }
                            $discountId = $discount->percent;
                            $discount->update([
                                'count'=> --$discount->count
                            ]);
                            $getPrice = ( $count[$i]->price - (($count[$i]['price'] * $discount->percent) / 100)) * $count[$i]->count;
                        }
                        else{
                            $discountId = null;
                            $getPrice = $count[$i]->price * $count[$i]->count;
                        }

                        $guarantee = Guarantee::where('id' , $count[$i]->guarantee_id)->pluck('name')->first();
                        if($count[$i]->pack == 1){
                            $collect_id = $count[$i]->collect_id;
                            $product_id = 0;
                            $profit = 0;
                        }else{
                            $product_id = $count[$i]->product_id;
                            $collect_id = 0;
                            $profit = Product::where('id' , $count[$i]->product_id)->pluck('priceBuy')->first();
                        }
                        $payMeta = PayMeta::create([
                            'product_id' => $product_id,
                            'collect_id' => $collect_id,
                            'user_id' => $count[$i]->user_id,
                            'pay_id' => $pay->id,
                            'prebuy' => $count[$i]->prebuy,
                            'discount_off'=>$discountId,
                            'status'=>0,
                            'price'=> $getPrice,
                            'profit'=>$getPrice - $profit,
                            'count' => $count[$i]->count,
                            'color' => $count[$i]->color,
                            'size' => $count[$i]->size,
                            'guarantee_name'=> $guarantee
                        ]);
                        $payMeta->address()->attach($address->id);
                    }
                    session()->put('transactionId' , (string) $transactionId);
                    session()->put('amount' , $amount);
                    auth()->user()->update([
                        'buy' => $choicePay
                    ]);
                }
            )->pay()->render();
        } else {
            return redirect('/checkout');
        }
    }

    public function shopWallet(Request $request)
    {
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        $time = Carbon::now()->format('Y-m-d h:i:s');
        $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
        if(!auth()->user()){
            return redirect()->back()->with([
                'message' => __('messages.log_first')
            ]);
        }
        if(!$request->carrier){
            return redirect()->back()->with([
                'message' => __('messages.select_carrier')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->carrier()->detach();
                $value->carrier()->sync($request->carrier);
            }
        }
        if(!$request->time){
            return redirect()->back()->with([
                'message' => __('messages.select_time2')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'time' => $request->time
                ]);
            }
        }
        if(!$address){
            return redirect()->back()->with([
                'message' => __('messages.select_address5')
            ]);
        }
        $address = auth()->user()->address()->where('status' , 1)->first();
        $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
        $checkCart = $this->checkCart($count);

        if($checkCart[0] == 'size'){
            return redirect()->back()->with([
                'message' => __('messages.no_count1',['size'=>$checkCart[1]])
            ]);
        }
        if($checkCart[0] == 'color'){
            return redirect()->back()->with([
                'message' => __('messages.no_count2',['size'=>$checkCart[1]])
            ]);
        }
        if($checkCart[0] == 'item'){
            return redirect()->back()->with([
                'message' => __('messages.no_count3')
            ]);
        }

        $amount = 0;
        for ( $i = 0; $i < count($count); $i++) {
            $allSum2 = (int)$count[$i]['price'] * (int)$count[$i]['count'];
            $amount = $amount + (int)$allSum2;
            if($count[$i]->discount){
                $discount = Discount::where('code' , $count[$i]->discount)->where('product_id', '!=' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                if ($discount) {
                    if($count[$i]['product_id'] == $discount['product_id']){
                        $amount = $amount - (($amount * $discount->percent) / 100);
                    }
                }
            }
        }

        $tax = Setting::where('key' , 'tax')->pluck('value')->first() ?? 0;
        $amount = $amount + (($amount * $tax) / 100);


        $carrierData = Carrier::where('id' , $request->carrier)->pluck('name')->first();
        $sends = $this->getCarrier($request->carrier,$amount);
        $amount = (int)$amount + (int)$sends;

        if($count[0]->discount){
            $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
            if($discount){
                $amount = $amount - ($amount * $discount->percent) / 100;
            }
        }

        $walletIncrease = Wallet::latest()->where('type' , 0)->where('user_id' , auth()->user()->id)->where('status' , 100)->pluck('price')->sum();
        $walletDecrease = Wallet::latest()->where('type' , 1)->where('user_id' , auth()->user()->id)->where('status' , 100)->pluck('price')->sum();
        $wallet = $walletIncrease - $walletDecrease;
        if($wallet >= $amount){
            $chars2 = Pay::buildCode();

            $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
            if($discount){
                $discountId = $discount->id;
                $discount->update([
                    'count'=> --$discount->count
                ]);
            }else{
                $discountId = null;
            }

            $pay = Pay::create([
                'refId'=>'کیف پول',
                'status'=>100,
                'tax'=>$tax,
                'property'=>$chars2,
                'method'=>1,
                'time' => $count[0]->time,
                'note'=>$request->note,
                'price'=>$amount,
                'discount_off'=>$discountId,
                'user_id'=>auth()->user()->id,
                'auth'=>'کیف پول',
                'carrier'=> $carrierData,
                'carrier_price'=> $sends,
            ]);
            Wallet::create([
                'refId'=>'کیف پول',
                'status'=> 100,
                'type' => 1,
                'property'=>$chars2,
                'price'=>$amount,
                'user_id'=>auth()->user()->id,
            ]);
            if($cooperationStatus == 1 ){
                $priceCo = $pay['price'] * $cooperationPercent / 100;
                $users = User::where('referral' , auth()->user()->parent_id)->first();
                if($users){
                    Cooperation::create([
                        'user_id' => $users['id'],
                        'percent' => $cooperationPercent,
                        'meta_id' => auth()->user()->id,
                        'pay_id' => $pay['id'],
                        'price' => $priceCo,
                        'type' => 0,
                        'status' => 100,
                    ]);
                    Wallet::create([
                        'refId'=>$pay['refId'],
                        'status'=>100,
                        'property'=>$chars2,
                        'price'=>$priceCo,
                        'type'=>0,
                        'user_id'=>$users['id'],
                    ]);
                }
            }
            $pay->address()->attach($address->id);
            $score = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                if($discount){
                    if($discount['day']){
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    }
                    $discountId = $discount->percent;
                    $discount->update([
                        'count'=> $discount->count - 1
                    ]);
                    $getPrice = ( $count[$i]->price - (($count[$i]['price'] * $discount->percent) / 100)) * $count[$i]->count;
                }
                else{
                    $discountId = null;
                    $getPrice = $count[$i]->price * $count[$i]->count;
                }

                $guarantee = Guarantee::where('id' , $count[$i]->guarantee_id)->pluck('name')->first();
                if($count[$i]->pack == 1){
                    $collect_id = $count[$i]->collect_id;
                    $product_id = 0;
                    $profit = 0;
                }else{
                    $product_id = $count[$i]->product_id;
                    $collect_id = 0;
                    $profit = Product::where('id' , $count[$i]->product_id)->pluck('priceBuy')->first();
                }
                $payMeta = PayMeta::create([
                    'product_id' => $product_id,
                    'collect_id' => $collect_id,
                    'user_id' => $count[$i]->user_id,
                    'pay_id' => $pay->id,
                    'prebuy' => $count[$i]->prebuy,
                    'discount_off'=>$discountId,
                    'status'=>100,
                    'price'=> $getPrice,
                    'profit'=>$getPrice - $profit,
                    'count' => $count[$i]->count,
                    'color' => $count[$i]->color,
                    'size' => $count[$i]->size,
                    'guarantee_name'=> $guarantee
                ]);
                $payMeta->address()->attach($address->id);

                $post = Product::where('id', $count[$i]->product_id)->first();
                $post->update([
                    'count' => $post->count - $count[$i]['count']
                ]);
                if ($count[$i]['color']){
                    $cartColor = $count[$i]['color'];
                    $colors = [];
                    foreach (json_decode($post['colors'] , true) as $item) {
                        if($item['name'] == $cartColor){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($colors , $item);
                    }
                    $post->update([
                        'colors' => json_encode($colors),
                    ]);
                }
                if ($count[$i]['size']){
                    $cartSize = $count[$i]['size'];
                    $sizes = [];
                    foreach (json_decode($post['size'] , true) as $item) {
                        if($item['name'] == $cartSize){
                            $item['count'] = (int)$item['count'] - (int)$count[$i]['count'];
                        }
                        array_push($sizes , $item);
                    }
                    $post->update([
                        'size' => json_encode($sizes),
                    ]);
                }
                $allSum2 = (int)$post['score'] * (int)$count[$i]['count'];
                $score = $score + (int)$allSum2;
            }
            $this->notificationBuy($pay);
            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>auth()->user()->id,
                ]);
            }
            auth()->user()->cart()->where('number' , 0)->delete();
            return view('home.cart.buy' , compact('pay'));
        }
        else {
            return redirect('/checkout')->with([
                'message' => __('messages.no_money')
            ]);
        }
    }

    public function order(Request $request)
    {
        $transaction_id = session()->get('transactionId');
        $transaction_amount = session()->get('amount');
        $choicePay = auth()->user()->buy;
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        $pay = Pay::where('auth' , $transaction_id)->where('user_id' , auth()->user()->id)->first();
        try {
            $score = 0;
            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $receipt = Payment::via($gate)->config($configs)->amount($transaction_amount)->transactionId($transaction_id)->verify();
            $pay->update([
                'status' => 100,
                'refId' => $receipt->getReferenceId(),
            ]);
            if($cooperationStatus == 1 ){
                $priceCo = $pay['price'] * $cooperationPercent / 100;
                $users = User::where('referral' , auth()->user()->parent_id)->first();
                if($users){
                    Cooperation::create([
                        'user_id' => $users['id'],
                        'percent' => $cooperationPercent,
                        'meta_id' => auth()->user()->id,
                        'pay_id' => $pay['id'],
                        'price' => $priceCo,
                        'type' => 0,
                        'status' => 100,
                    ]);
                    Wallet::create([
                        'refId'=>$pay['refId'],
                        'status'=>100,
                        'property'=>$pay->property,
                        'price'=>$priceCo,
                        'type'=>0,
                        'user_id'=>$users['id'],
                    ]);
                }
            }
            foreach ($pay->payMeta as $val){
                $val->update([
                    'status' => 100,
                ]);
                if($val->pack == 1) {
                    $post = Collection::where('id', $val->collect_id)->first();
                    $post->update([
                        'count' => $post->count - $val['count']
                    ]);
                }else{
                    $post = Product::where('id', $val->product_id)->first();
                    $post->update([
                        'count' => $post->count - $val['count']
                    ]);
                }
                if ($val['color']){
                    $cartColor = $val['color'];
                    $colors = [];
                    foreach (json_decode($post['colors'] , true) as $item) {
                        if($item['name'] == $cartColor){
                            $item['count'] = (int)$item['count'] - (int)$val['count'];
                        }
                        array_push($colors , $item);
                    }
                    $post->update([
                        'colors' => json_encode($colors),
                    ]);
                }
                if ($val['size']){
                    $cartSize = $val['size'];
                    $sizes = [];
                    foreach (json_decode($post['size'] , true) as $item) {
                        if($item['name'] == $cartSize){
                            $item['count'] = (int)$item['count'] - (int)$val['count'];
                        }
                        array_push($sizes , $item);
                    }
                    $post->update([
                        'size' => json_encode($sizes),
                    ]);
                }
                $allSum2 = (int)$post['score'] * (int)$val['count'];
                $score = $score + (int)$allSum2;
            }
            $this->notificationBuy($pay);
            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>auth()->user()->id,
                ]);
            }
            $name = auth()->user()->name;
            auth()->user()->cart()->delete();
            return view('home.cart.buy' , compact('pay' , 'name'));
        }
        catch (InvalidPaymentException $exception) {
            return redirect('/checkout')->with([
                'message' => __('messages.fail_buy')
            ]);
        }
    }

    public function paymentSpot(Request $request)
    {
        $time = Carbon::now()->format('Y-m-d h:i:s');
        $choicePay = $request->gateway;
        $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
        if(!$request->carrier){
            return redirect()->back()->with([
                'message' => __('messages.select_carrier')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->carrier()->detach();
                $value->carrier()->sync($request->carrier);
            }
        }
        if(!$request->time){
            return redirect()->back()->with([
                'message' => __('messages.select_time2')
            ]);
        }else{
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'time' => $request->time
                ]);
            }
        }
        if(!$address){
            return redirect()->back()->with([
                'message' => __('messages.select_address5')
            ]);
        }
        if (auth()->user()->cart()->where('number' , 0)->count() >= 1) {
            $number = auth()->user()->number;
            $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
            $checkCart = $this->checkCart($count);

            if($checkCart[0] == 'size'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count1',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'color'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count2',['size'=>$checkCart[1]])
                ]);
            }
            if($checkCart[0] == 'item'){
                return redirect()->back()->with([
                    'message' => __('messages.no_count3')
                ]);
            }
            $amount = 0;
            for ( $i = 0; $i < count($count); $i++) {
                $allSum2 = (int)$count[$i]['price'] * (int)$count[$i]['count'];
                $amount = $amount + (int)$allSum2;
                if($count[$i]->discount){
                    $discount = Discount::where('code' , $count[$i]->discount)->where('product_id', '!=' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                    if ($discount) {
                        if($count[$i]['product_id'] == $discount['product_id']){
                            $amount = $amount - (($amount * $discount->percent) / 100);
                        }
                    }
                }
            }

            $tax = Setting::where('key' , 'tax')->pluck('value')->first() ?? 0;
            $amount = $amount + (($amount * $tax) / 100);

            $carrierData = Carrier::where('id' , $request->carrier)->pluck('name')->first();
            $sends = $this->getCarrier($request->carrier,$amount);
            $amount = (int)$amount + (int)$sends;

            if($count[0]->discount){
                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , null)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                if($discount){
                    $amount = $amount - ($amount * $discount->percent) / 100;
                }
            }
            $deposit = Setting::where('key' , 'deposit')->pluck('value')->first();
            $amountA = round($amount * (int)$deposit / 100);

            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $invoice = (new Invoice)->amount($amountA);
            $invoice->detail('mobile',auth()->user()->number);
            $property = Pay::buildCode();
            return Payment::via($gate)->config($configs)->callbackUrl(url('/spot/order'))->purchase(
                $invoice,
                function($driver, $transactionId) use ($property,$amount,$tax,$sends,$carrierData,$request,$choicePay,$count,$amountA) {
                    $time = Carbon::now()->format('Y-m-d h:i:s');
                    $address = auth()->user()->address()->where('show' , 1)->where('status' , 1)->first();
                    $pay = Pay::create([
                        'refId'=>'',
                        'status'=>0,
                        'tax'=>$tax,
                        'property'=>$property,
                        'price'=>$amount,
                        'gate'=>$choicePay,
                        'deposit'=>$amountA,
                        'note'=>$request->note,
                        'user_id'=>auth()->user()->id,
                        'method'=>2,
                        'auth' => (string) $transactionId,
                        'time' => $count[0]->time,
                        'carrier'=> $carrierData,
                        'carrier_price'=> $sends,
                    ]);
                    $pay->address()->attach($address->id);
                    for ( $i = 0; $i < count($count); $i++) {
                        $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('count' , '>=' , 1)->first();
                        if($discount){
                            if($discount['day']){
                                $discount = Discount::where('code' , $count[0]->discount)->where('product_id' , $count[$i]->product_id)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
                            }
                            $discountId = $discount->percent;
                            $discount->update([
                                'count'=> --$discount->count
                            ]);
                            $getPrice = ( $count[$i]->price - (($count[$i]['price'] * $discount->percent) / 100)) * $count[$i]->count;
                        }
                        else{
                            $discountId = null;
                            $getPrice = $count[$i]->price * $count[$i]->count;
                        }

                        $guarantee = Guarantee::where('id' , $count[$i]->guarantee_id)->pluck('name')->first();
                        if($count[$i]->pack == 1){
                            $collect_id = $count[$i]->collect_id;
                            $product_id = 0;
                            $profit = 0;
                        }else{
                            $product_id = $count[$i]->product_id;
                            $collect_id = 0;
                            $profit = Product::where('id' , $count[$i]->product_id)->pluck('priceBuy')->first();
                        }
                        $payMeta = PayMeta::create([
                            'product_id' => $product_id,
                            'collect_id' => $collect_id,
                            'user_id' => $count[$i]->user_id,
                            'pay_id' => $pay->id,
                            'prebuy' => $count[$i]->prebuy,
                            'method'=>2,
                            'discount_off'=>$discountId,
                            'status'=>0,
                            'price'=> $getPrice,
                            'profit'=> $getPrice - $profit,
                            'count' => $count[$i]->count,
                            'color' => $count[$i]->color,
                            'size' => $count[$i]->size,
                            'guarantee_name'=> $guarantee
                        ]);
                        $payMeta->address()->attach($address->id);
                    }
                    session()->put('transactionId' , (string) $transactionId);
                    session()->put('amount' , $amountA);
                    auth()->user()->update([
                        'buy' => $choicePay
                    ]);
                }
            )->pay()->render();
        } else {
            return redirect('/user-info-cart');
        }
    }

    public function spotOrder(Request $request)
    {
        $transaction_id = session()->get('transactionId');
        $transaction_amount = session()->get('amount');
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        $choicePay = auth()->user()->buy;
        $pay = Pay::where('auth' , $transaction_id)->where('user_id' , auth()->user()->id)->first();
        try {
            $score = 0;
            if($choicePay == 0){
                $merchantId = Setting::where('key' , 'zarinpal')->pluck('value')->first();
                $gate = 'zarinpal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 1){
                $merchantId = Setting::where('key' , 'zibal')->pluck('value')->first();
                $gate = 'zibal';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 2){
                $merchantId = Setting::where('key' , 'nextPay')->pluck('value')->first();
                $gate = 'nextpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 3){
                $merchantId = Setting::where('key' , 'idpay')->pluck('value')->first();
                $gate = 'idpay';
                $configs = [
                    'merchantId' => $merchantId,
                ];
            }
            if($choicePay == 4){
                $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
                $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
                $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
                $gate = 'behpardakht';
                $configs = [
                    'terminalId' => $terminalBeh,
                    'username' => $userBeh,
                    'password' => $passwordBeh,
                ];
            }
            if($choicePay == 5){
                $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
                $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
                $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
                $gate = 'sadad';
                $configs = [
                    'key' => $keySadad,
                    'merchantId' => $merchantSadad,
                    'terminalId' => $terminalSadad,
                ];
            }
            if($choicePay == 6){
                $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
                $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
                $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
                $gate = 'asanpardakht';
                $configs = [
                    'username' => $userAsan,
                    'password' => $passwordAsan,
                    'merchantConfigID' => $terminalAsan,
                ];
            }
            if($choicePay == 7){
                $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
                $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
                $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
                $gate = 'pasargad';
                $configs = [
                    'merchantId' => $merchantPasargad,
                    'terminalCode' => $terminalPasargad,
                    'certificate' => $certificatePasargad,
                ];
            }
            if($choicePay == 8){
                $merchantSaman = Setting::where('key' , 'samansep')->pluck('value')->first();
                $gate = 'sep';
                $configs = [
                    'terminalId' => $merchantSaman,
                ];
            }
            $receipt = Payment::via($gate)->config($configs)->amount($transaction_amount)->transactionId($transaction_id)->verify();
            $pay->update([
                'status' => 50,
                'refId' => $receipt->getReferenceId(),
            ]);
            if($cooperationStatus == 1 ){
                $priceCo = $pay['price'] * $cooperationPercent / 100;
                $users = User::where('referral' , auth()->user()->parent_id)->first();
                if($users){
                    Cooperation::create([
                        'user_id' => $users['id'],
                        'percent' => $cooperationPercent,
                        'meta_id' => auth()->user()->id,
                        'pay_id' => $pay['id'],
                        'price' => $priceCo,
                        'type' => 0,
                        'status' => 100,
                    ]);
                    Wallet::create([
                        'refId'=>$pay['refId'],
                        'status'=>100,
                        'property'=>$pay->property,
                        'price'=>$priceCo,
                        'type'=>0,
                        'user_id'=>$users['id'],
                    ]);
                }
            }
            foreach ($pay->payMeta as $val){
                $val->update([
                    'status' => 50,
                ]);
                if($val->pack == 1) {
                    $post = Collection::where('id', $val->collect_id)->first();
                    $post->update([
                        'count' => $post->count - $val['count']
                    ]);
                }else{
                    $post = Product::where('id', $val->product_id)->first();
                    $post->update([
                        'count' => $post->count - $val['count']
                    ]);
                }
                if ($val['color']){
                    $cartColor = $val['color'];
                    $colors = [];
                    foreach (json_decode($post['colors'] , true) as $item) {
                        if($item['name'] == $cartColor){
                            $item['count'] = (int)$item['count'] - (int)$val['count'];
                        }
                        array_push($colors , $item);
                    }
                    $post->update([
                        'colors' => json_encode($colors),
                    ]);
                }
                if ($val['size']){
                    $cartSize = $val['size'];
                    $sizes = [];
                    foreach (json_decode($post['size'] , true) as $item) {
                        if($item['name'] == $cartSize){
                            $item['count'] = (int)$item['count'] - (int)$val['count'];
                        }
                        array_push($sizes , $item);
                    }
                    $post->update([
                        'size' => json_encode($sizes),
                    ]);
                }
                $allSum2 = (int)$post['score'] * (int)$val['count'];
                $score = $score + (int)$allSum2;
            }
            $this->notificationBuy($pay);
            if($score >= 1){
                Score::create([
                    'name'=>$score,
                    'user_id'=>auth()->user()->id,
                ]);
            }
            $name = auth()->user()->name;
            auth()->user()->cart()->delete();
            return view('home.cart.buy' , compact('pay' , 'name'));
        } catch (InvalidPaymentException $exception) {
            return redirect('/checkout')->with([
                'message' => __('messages.fail_buy')
            ]);
        }
    }

    public function checkCart($count){
        $count = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee','carrier')->get();
        for ($i = 0; $i < count($count); $i++) {
            if($count[$i]->pack == 1) {
                $post = Collection::where('id', $count[$i]->collect_id)->first();
                $price = $post->price;
            }
            else{
                $post = Product::where('id', $count[$i]->product_id)->first();
                $price = $post->price;
                if(auth()->user()){
                    $levelUser = auth()->user()->roles()->pluck('name')->toArray();
                    if($post->levels){
                        if($post['levels'] != '[]'){
                            foreach(json_decode($post['levels']) as $item){
                                if(in_array($item->name, $levelUser)){
                                    $price = $item->price;
                                }
                            }
                        }
                    }
                }
                if($post->count <= 0 && $post->prebuy == 1){
                    $price = $post->prePrice;
                }
                if ($count[$i]['color']) {
                    $postColor = '';
                    foreach (json_decode($post['colors'], true) as $item) {
                        if ($item['name'] == $count[$i]['color']) {
                            $postColor = $item;
                            $price = $price + (int)$item['price'];
                            $count[$i]->update([
                                'color' => $item['name'],
                            ]);
                            if ($item['count'] <= 0 && $post->prebuy == 0) {
                                $count[$i]->delete();
                                return ['color', $item['name']];
                            }
                        }
                    }
                    if ($postColor == '') {
                        $count[$i]->delete();
                        return ['color', $count[$i]['color']];
                    }
                }
                if ($count[$i]['size']) {
                    $postSize = '';
                    foreach (json_decode($post['size'], true) as $item) {
                        if ($item['name'] == $count[$i]['size']) {
                            $postSize = $item;
                            $price = $price + $item['price'];
                            $count[$i]->update([
                                'size' => $item['name'],
                            ]);
                            if ($item['count'] <= 0 && $post->prebuy == 0) {
                                $count[$i]->delete();
                                return ['size', $count[$i]['size']];
                            }
                        }
                    }
                    if ($postSize == '') {
                        $count[$i]->delete();
                        return ['size', $count[$i]['size']];
                    }
                }
            }
            if($post['count'] <= 0 && $post->prebuy == 0){
                $count[$i]->delete();
                return ['item' , ''];
            }
            $count[$i]->update([
                'price' => $price,
            ]);
        };
        return ['success' , 'ok'];
    }

    public function notificationBuy($pay){
        $messageSuccess = Setting::where('key' , 'messageSuccess')->pluck('value')->first();
        $messageManager = Setting::where('key' , 'messageManager')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        $link = url("show-pay/$pay->property");
        $numFast = $pay->address()->pluck('number')->first();
        $nameFast = auth()->user() ? auth()->user()->name : $pay->address()->pluck('name')->first();
        if(auth()->user()){
            if($messageSuccess){
                if(auth()->user()->number){
                    $this->sendSms(auth()->user()->number , [auth()->user()->name , $pay->property],'',$messageSuccess);
                }
            }
            if(auth()->user()->email){
                $text2 = "<strong>".__('messages.email1')." </strong><br/> <a href='$link'>".__('messages.track_pay')."</a>";
                Mail::to(auth()->user()->email)->send(new sendMail(__('messages.success_buy1') , $text2 , env('MAIL_FROM_ADDRESS')));
            }
        }else{
            if($messageSuccess){
                if($numFast){
                    $this->sendSms($numFast , [$nameFast??' ' , $pay->property],'',$messageSuccess);
                }
            }
        }
        if($messageManager && $number){
            $this->sendSms($number , [$nameFast??' ' , $pay->property , $pay->price],'',$messageManager);
        }
        $this->lotteryBuy($pay);
    }

    public function lotteryBuy($pay){
        $payMetas = PayMeta::where('pay_id',$pay->id)->get();
        foreach($payMetas as $item){
            if($item->product_id >= 1){
                $post = Product::where('id', $item->product_id)->first();
                $user = User::where('id' , $item->user_id)->first();
                $registerMessage = __('messages.lottery_code');
                if($post->lotteryStatus == 1){
                    for ( $i = 0; $i < $item->count; $i++) {
                        $lastLottery1 = LotteryCode::latest()->where('product_id',$post->id)->first();
                        if($lastLottery1 != ''){
                            if($post->numLottery2 != $lastLottery1->number){
                                $number = ++$lastLottery1->number;
                                $code = LotteryCode::create([
                                    'product_id' => $post->id,
                                    'round' => $lastLottery1->round,
                                    'user_id' => $user->id,
                                    'letter' => $post->letterLottery,
                                    'number' => $number,
                                    'code' => $post->letterLottery . $number,
                                    'pay_id' => $pay->id,
                                ]);
                                $message = "$registerMessage <br> $code->code";
                                Mail::to($user->email)->send(new sendMail(__('messages.lottery_code2') , $message , env('MAIL_FROM_ADDRESS')));
                                if($post->numLottery2 == $number){
                                    $lot = Lottery::create([
                                        'title' => __('messages.lottery_code3') . $post->title,
                                        'product_id' => $post->id,
                                        'round' => $lastLottery1->round,
                                    ]);
                                    DB::table('lottery_codes')->where('active' , 0)->where('product_id' , $post->id)->update([
                                        'active' => 1,
                                        'lottery_id' => $lot['id']
                                    ]);
                                }
                            }else{
                                $code = LotteryCode::create([
                                    'product_id' => $post->id,
                                    'round' => ++$lastLottery1->round,
                                    'user_id' => $user->id,
                                    'letter' => $post->letterLottery,
                                    'number' => $post->numLottery1,
                                    'pay_id' => $pay->id,
                                    'code' => $post->letterLottery . $post->numLottery1,
                                ]);
                                $message = "$registerMessage <br> $code->code";
                                Mail::to($user->email)->send(new sendMail(__('messages.lottery_code2') , $message , env('MAIL_FROM_ADDRESS')));
                            }
                        }
                        else{
                            $code = LotteryCode::create([
                                'product_id' => $post->id,
                                'round' => 1,
                                'user_id' => $user->id,
                                'letter' => $post->letterLottery,
                                'number' => $post->numLottery1,
                                'pay_id' => $pay->id,
                                'code' => $post->letterLottery . $post->numLottery1,
                            ]);
                            if($user->email){
                                $message = "$registerMessage <br> $code->code";
                                Mail::to($user->email)->send(new sendMail(__('messages.lottery_code2') , $message , env('MAIL_FROM_ADDRESS')));
                            }
                        }
                    }
                }
            }
        }
    }
}
