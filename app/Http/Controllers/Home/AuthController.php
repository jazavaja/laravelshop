<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\ActiveSms;
use App\Models\Cart;
use App\Models\Field;
use App\Models\FieldData;
use App\Models\Setting;
use App\Models\User;
use App\Traits\SendSmsTrait;
use App\Traits\SeoHelper;
use Carbon\Carbon;
use Ghasedak\GhasedakApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use SeoHelper;
    use SendSmsTrait;
    public function login(){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $shortActivity = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo( __('messages.login_user') . "$title - " , $shortActivity , 'store' , 'login' , $logoSite , $keyword );
        if (Auth::check())return redirect('/profile');
        $loginDesign = Setting::where('key' , 'loginDesign')->pluck('value')->first() ? 1 : 0;
        if($loginDesign){
            return view('home.auth.authIndex2');
        }else{
            return view('home.auth.authIndex');
        }
    }
    public function checkAuth(Request $request){
        if (Setting::where('key' , 'captchaStatus')->pluck('value')->first()){
            $request->validate([
                'authData' => 'required',
                'captcha' => ['required', 'captcha'],
            ]);
        }else{
            $request->validate([
                'authData' => 'required',
            ]);
        }
        DB::table('active_sms')->where('expire' , '<=', Carbon::now()->timestamp)->delete();
        if (is_numeric($request->authData)) {
            $check2 = User::where('number' , $request->authData)->first();
            if($check2){
                if($check2->suspension == 1){
                    return 'ban';
                }else{
                    return 'exist';
                }
            }else{
                $messageAuth = Setting::where('key' , 'messageAuth')->pluck('value')->first();
                $code = ActiveSms::buildCode();
                ActiveSms::create([
                    'code'=> $code,
                    'expire'=> Carbon::now()->addSecond(200)->timestamp,
                    'phone'=>$request->authData
                ]);
                $smsType = Setting::where('key' , 'smsType')->pluck('value')->first();
                if($smsType == 0){
                    $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
                    $api->Verify(
                        "$request->authData",
                        "$messageAuth",
                        $code
                    );
                }
                if($smsType == 1){
                    $userSms = Setting::where('key' , 'userSms')->pluck('value')->first();
                    $passSms = Setting::where('key' , 'passSms')->pluck('value')->first();
                    $url = "https://api.payamak-panel.com/post/Send.asmx/SendByBaseNumber2?username=$userSms&password=$passSms&text=$code;&to=$request->authData&bodyId=$messageAuth";
                    $client = new Client();
                    $response = $client->request('GET', $url,
                        [
                            'allow_redirects' => true
                        ]);
                    $contents = $response->getBody()->getContents();
                    $contents = json_decode($contents,true);
                }
                if($smsType == 2){
                    $kaveKey = Setting::where('key' , 'kaveKey')->pluck('value')->first();
                    $url = "https://api.kavenegar.com/v1/$kaveKey/verify/lookup.json?receptor=$request->authData&token=$code&template=$messageAuth";
                    $client = new Client();
                    $response = $client->request('GET', $url,
                        [
                            'allow_redirects' => true
                        ]);
                    $contents = $response->getBody()->getContents();
                    $contents = json_decode($contents,true);
                }
                if($smsType == 3){
                    $user = Setting::where('key' , 'userFaraz')->pluck('value')->first();
                    $pass = Setting::where('key' , 'passFaraz')->pluck('value')->first();
                    $fromNum = Setting::where('key' , 'numberFaraz')->pluck('value')->first();
                    $toNum = array($request->authData);
                    $pattern_code = Setting::where('key' , 'messageAuth')->pluck('value')->first();
                    $input_data = array(
                        "token" => $code,
                    );
                    $url = 'https://ippanel.com/patterns/pattern?username=' . $user . '&password=' . urlencode($pass) . '&from='.$fromNum.'&to=' . json_encode($toNum) . '&input_data=' . urlencode(json_encode($input_data)) . '&pattern_code='.$pattern_code;
                    $handler = curl_init($url);
                    curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
                    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($handler);
                }
                return 'code';
            }
        }
        elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $check2 = User::where('email' , $request->authData)->first();
            if($check2){
                if($check2->suspension == 1){
                    return 'ban';
                }else{
                    return 'exist';
                }
            }else{
                $code = ActiveSms::buildCode();
                ActiveSms::create([
                    'code'=> $code,
                    'expire'=> Carbon::now()->addSecond(200)->timestamp,
                    'phone'=>$request->authData
                ]);
                $message = "کد تایید شما برای ورود به وبسایت : $code";
                Mail::to($request->authData)->send(new sendMail('کد تایید' , $message , env('MAIL_FROM_ADDRESS')));
                return 'code';
            }
        }else{
            return [0,0];
        }
    }
    public function sendCode(Request $request){
        if (Setting::where('key' , 'captchaStatus')->pluck('value')->first()){
            $request->validate([
                'authData' => 'required',
                'captcha' => ['required', 'captcha'],
            ]);
        }else{
            $request->validate([
                'authData' => 'required',
            ]);
        }
        DB::table('active_sms')->where('expire' , '<=', Carbon::now()->timestamp)->delete();
        if (is_numeric($request->authData)) {
            $messageAuth = Setting::where('key' , 'messageAuth')->pluck('value')->first();
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData,
                'type'=>1
            ]);
            $smsType = Setting::where('key' , 'smsType')->pluck('value')->first();
            if($smsType == 0){
                $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
                $api->Verify(
                    "$request->authData",
                    "$messageAuth",
                    $code
                );
            }
            if($smsType == 1){
                $userSms = Setting::where('key' , 'userSms')->pluck('value')->first();
                $passSms = Setting::where('key' , 'passSms')->pluck('value')->first();
                $url = "https://api.payamak-panel.com/post/Send.asmx/SendByBaseNumber2?username=$userSms&password=$passSms&text=$code;&to=$request->authData&bodyId=$messageAuth";
                $client = new Client();
                $response = $client->request('GET', $url,
                    [
                        'allow_redirects' => true
                    ]);
                $contents = $response->getBody()->getContents();
                $contents = json_decode($contents,true);
            }
            if($smsType == 2){
                $kaveKey = Setting::where('key' , 'kaveKey')->pluck('value')->first();
                $url = "https://api.kavenegar.com/v1/$kaveKey/verify/lookup.json?receptor=$request->authData&token=$code&template=$messageAuth";
                $client = new Client();
                $response = $client->request('GET', $url,
                    [
                        'allow_redirects' => true
                    ]);
                $contents = $response->getBody()->getContents();
                $contents = json_decode($contents,true);
            }
            if($smsType == 3){
                $user = Setting::where('key' , 'userFaraz')->pluck('value')->first();
                $pass = Setting::where('key' , 'passFaraz')->pluck('value')->first();
                $fromNum = Setting::where('key' , 'numberFaraz')->pluck('value')->first();
                $toNum = array($request->authData);
                $pattern_code = Setting::where('key' , 'messageAuth')->pluck('value')->first();
                $input_data = array(
                    "token" => $code,
                );
                $url = 'https://ippanel.com/patterns/pattern?username=' . $user . '&password=' . urlencode($pass) . '&from='.$fromNum.'&to=' . json_encode($toNum) . '&input_data=' . urlencode(json_encode($input_data)) . '&pattern_code='.$pattern_code;
                $handler = curl_init($url);
                curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($handler);
            }
            return 'code';
        }
        elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData,
                'type'=>1
            ]);
            $message = "کد تایید شما برای ورود به وبسایت : $code";
            Mail::to($request->authData)->send(new sendMail('کد تایید' , $message , env('MAIL_FROM_ADDRESS')));
            return 'code';
        }else{
            return [0,0];
        }
    }
    public function checkCode(Request $request){
        $request->validate([
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
        ]);
        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if ($check){
            return 'ok';
        }else{
            return 'fail';
        }
    }
    public function checkCode2(Request $request){
        $request->validate([
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
        ]);
        $messageRegister = Setting::where('key' , 'messageRegister')->pluck('value')->first();
        $check = ActiveSms::where('code',$request->code)->where('type' , 1)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if ($check){
            if (is_numeric($request->authData)) {
                $check2 = User::where('number' , $request->authData)->first();
                if($check2){
                    if($check2->suspension == 1){
                        return 'ban';
                    }
                    Auth::login($check2);
                    $this->sendSms(auth()->user()->number , [$check2->name],'',$messageRegister);
                    $this->createCart();
                }else{
                    $code = User::buildCode();
                    $referralCode = 0;
                    $user = User::create([
                        'name'=> time(),
                        'number'=> $request->authData,
                        'referral'=> $code,
                        'parent_id'=> $referralCode,
                        'password'=> Hash::make(rand(10000000,999999999))
                    ]);
                    Auth::login($user);
                    $this->sendSms(auth()->user()->number , [$user->name],'',$messageRegister);
                    $this->createCart();
                }
            }
            elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
                $check2 = User::where('email' , $request->authData)->first();
                if($check2){
                    if($check2->suspension == 1){
                        return 'ban';
                    }
                    Auth::login($check2);
                    $this->createCart();
                }else{
                    $code = User::buildCode();
                    $referralCode = 0;
                    $user = User::create([
                        'name'=> time(),
                        'number'=> $request->authData,
                        'referral'=> $code,
                        'parent_id'=> $referralCode,
                        'password'=> Hash::make(rand(10000000,999999999))
                    ]);
                    Auth::login($user);
                    $this->createCart();
                }
            }
            return 'ok';
        }else{
            return 'fail';
        }
    }
    public function enterAuth(Request $request){
        $request->validate([
            'authData' => 'required',
            'password' => 'required',
        ]);

        if (is_numeric($request->authData)) {
            $credentials = [
                'number' => $request->authData,
                'password' => $request->password
            ];
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->authData,
                'password' => $request->password
            ];
        }else{
            return 'format';
        }

        if (Auth::attempt($credentials)) {
            $this->createCart();
            return 'success';
        } else {
            return 'no';
        }
    }
    public function addUser(Request $request){
        $request->validate([
            'authData' => 'required|unique:users,number',
            'password' => 'required|required_with:confirmed|same:confirmed',
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
            'user' => 'unique:users,name',
        ]);
        $fields = Field::where('status' , 0)->where('show_status' , 1)->get();
        foreach ($fields as $item){
            if($item->required_status){
                $request->validate([
                    'field'.$item->id => 'required',
                ]);
            }
        }
        $messageRegister = Setting::where('key' , 'messageRegister')->pluck('value')->first();
        $check = ActiveSms::where('phone' , $request->authData)->where('code' , $request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->first();
        if($check){
            $code = User::buildCode();
            $referralCode = 0;
            if($request->referral){
                $referralU = User::where('referral' , $request->referral)->first();
                if($referralU){
                    $referralCode = $request->referral;
                }
            }
            if (is_numeric($request->authData)) {
                $user = User::create([
                    'name'=> $request->user,
                    'number'=> $request->authData,
                    'referral'=> $code,
                    'parent_id'=> $referralCode,
                    'password'=> Hash::make($request->password)
                ]);
                foreach ($fields as $item){
                    FieldData::create([
                        'field_id' => $item->id,
                        'type' => 0,
                        'value' => $request['field'.$item->id],
                        'model_id' => $user->id,
                    ]);
                }
                Auth::login($user);
                if($messageRegister){
                    $this->sendSms(auth()->user()->number , [$request->user],'',$messageRegister);
                }
                $this->createCart();
                return 'success';
            } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
                $user = User::create([
                    'name'=> $request->user,
                    'email'=> $request->authData,
                    'referral'=> $code,
                    'parent_id'=> $referralCode,
                    'password'=> Hash::make($request->password)
                ]);
                foreach ($fields as $item){
                    FieldData::create([
                        'field_id' => $item->id,
                        'type' => 0,
                        'value' => $request['field'.$item->id],
                        'model_id' => $user->id,
                    ]);
                }
                Auth::login($user);
                $this->createCart();
                return 'success';
            }else{
                return 'format';
            }
        }else{
            return 'time';
        }
    }
    public function changePassword(Request $request){
        $request->validate([
            'authData' => 'required',
        ]);

        if (is_numeric($request->authData)) {
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData
            ]);
            $messageAuth = Setting::where('key' , 'messageAuth')->pluck('value')->first();
            $smsType = Setting::where('key' , 'smsType')->pluck('value')->first();
            if($smsType == 0){
                $api = new GhasedakApi(env('GHASEDAKAPI_KEY'));
                $api->Verify(
                    "$request->authData",
                    "$messageAuth",
                    $code
                );
            }
            if($smsType == 1){
                $userSms = Setting::where('key' , 'userSms')->pluck('value')->first();
                $passSms = Setting::where('key' , 'passSms')->pluck('value')->first();
                $text = $code;
                $url = "https://api.payamak-panel.com/post/Send.asmx/SendByBaseNumber2?username=$userSms&password=$passSms&text=$text;&to=$request->authData&bodyId=$messageAuth";
                $client = new Client();
                $response = $client->request('GET', $url,
                    [
                        'allow_redirects' => true
                    ]);
                $contents = $response->getBody()->getContents();
                $contents = json_decode($contents,true);
            }
            if($smsType == 2){
                $kaveKey = Setting::where('key' , 'kaveKey')->pluck('value')->first();
                $url = "https://api.kavenegar.com/v1/$kaveKey/verify/lookup.json?receptor=$request->authData&token=$code&template=$messageAuth";
                $client = new Client();
                $response = $client->request('GET', $url,
                    [
                        'allow_redirects' => true
                    ]);
                $contents = $response->getBody()->getContents();
                $contents = json_decode($contents,true);
            }
            if($smsType == 3){
                $user = Setting::where('key' , 'userFaraz')->pluck('value')->first();
                $pass = Setting::where('key' , 'passFaraz')->pluck('value')->first();
                $fromNum = Setting::where('key' , 'numberFaraz')->pluck('value')->first();
                $toNum = array($request->authData);
                $pattern_code = Setting::where('key' , 'messageAuth')->pluck('value')->first();
                $input_data = array(
                    "token" => $code,
                );
                $url = 'https://ippanel.com/patterns/pattern?username=' . $user . '&password=' . urlencode($pass) . '&from='.$fromNum.'&to=' . json_encode($toNum) . '&input_data=' . urlencode(json_encode($input_data)) . '&pattern_code='.$pattern_code;
                $handler = curl_init($url);
                curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($handler);
            }
            return 'code';
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $code = ActiveSms::buildCode();
            ActiveSms::create([
                'code'=> $code,
                'expire'=> Carbon::now()->addSecond(200)->timestamp,
                'phone'=>$request->authData
            ]);
            $message = "کد تایید شما برای ورود به وبسایت : $code";
            Mail::to($request->authData)->send(new sendMail('کد تایید' , $message , env('MAIL_FROM_ADDRESS')));
            return 'code';
        }else{
            return 'format';
        }
    }
    public function checkPassCode(Request $request){
        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if ($check){
            return 'ok';
        }else{
            return 'fail';
        }
    }
    public function changeUserPassword(Request $request){
        $request->validate([
            'authData' => 'required',
            'password' => 'required|required_with:confirmed|same:confirmed',
            'code' => ['required','min:6','max:6' , Rule::exists('active_sms')],
        ]);

        $check = ActiveSms::where('code',$request->code)->where('expire' , '>='  ,Carbon::now()->timestamp)->where('phone',$request->authData)->first();
        if (!$check){
            return 'time';
        }
        if (is_numeric($request->authData)) {
            $user = User::where('number',$request->authData)->first();
            $user->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::login($user);
            $this->createCart();
            return 'success';
        } elseif (filter_var($request->authData, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email',$request->authData)->first();
            $user->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::login($user);
            $this->createCart();
            return 'success';
        }else{
            return 'format';
        }
    }
    public function createCart(){
        $myCart = request()->cookie('myCart');
        $myCookieCart = json_decode($myCart , true);
        if($myCookieCart){
            for ($i = 0; $i < count(json_decode($myCart , true)); $i++) {
                foreach(auth()->user()->cart as $value) {
                    if (json_decode($myCart , true)[$i]['id'] == $value->product_id && $value->size == json_decode($myCart , true)[$i]['size'] && $value->color == json_decode($myCart , true)[$i]['color'] && $value->guarantee_id == json_decode($myCart , true)[$i]['guarantee_id']) {
                        $myCookieCart[$i]['id'] = 0;
                    }
                }
            }
            foreach($myCookieCart as $value) {
                if($value['id'] != 0){
                    Cart::create([
                        'product_id' => $value['id'],
                        'user_id' => auth()->user()->id,
                        'guarantee_id' => $value['guarantee_id'],
                        'color' => $value['color'],
                        'size' => $value['size'],
                        'prebuy' => $value['prebuy'],
                        'pack' => $value['pack'],
                        'price' => $value['price'],
                        'inquiry' => $value['inquiry'],
                        'count' => $value['count'],
                        'number' => $value['number'],
                    ]);
                }
            }
        }
        Cookie::queue(Cookie::forget('myCart'));
        return 'ok';
    }
}
