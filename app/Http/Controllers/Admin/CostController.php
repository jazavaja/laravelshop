<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use App\Models\PayMeta;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $pays = Pay::where('back' , 4)->where(function ($query) use($title) {
                $query->where('property', $title)
                    ->orWhere('id', $title)
                    ->orWhere('user_id', $title);
            })->with('user')->latest()->paginate(50)->setPath($currentUrl);
        }
        else{
            $pays = Pay::where('back' , 4)->with('user')->paginate(50)->setPath($currentUrl);
        }
        return view('admin.cost.index' , compact('pays','title'));
    }

    public function create(){
        return view('admin.cost.create');
    }

    public function statistics(){
        $startDayEn = verta()->startMonth()->formatGregorian('Y-m-d H:i:s');
        $endDayEn = verta()->endMonth()->formatGregorian('Y-m-d H:i:s');

        $directMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 6)->sum('price');
        $costMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('back' , 4)->sum('price');
        $profitsMonth = PayMeta::whereBetween('created_at', [$startDayEn, $endDayEn])->where('status' , 100)->sum('profit');
        $payPriceMonth = PayMeta::whereBetween('created_at', [$startDayEn, $endDayEn])->where('status' , 100)->sum('price');
        $backsMonth = PayMeta::whereBetween('created_at', [$startDayEn, $endDayEn])->where('status' , 2)->sum('price');
        $paysMonth = PayMeta::whereBetween('created_at', [$startDayEn, $endDayEn])->where('status' , 100)->sum('price');
        $productsMonth = PayMeta::whereBetween('created_at', [$startDayEn, $endDayEn])->where('status' , 100)->sum('count');
        $gatePayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 0)->sum('price');
        $walletPayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 1)->sum('price');
        $homePayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 2)->sum('price');
        $installPayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 3)->sum('price');
        $quickPayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 4)->sum('price');
        $cardPayMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->where('method' , 5)->sum('price');
        $carrierPriceMonth = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->sum('carrier_price');

        $direct = Pay::where('method' , 6)->sum('price');
        $cost = Pay::where('back' , 4)->sum('price');
        $profits = PayMeta::where('status' , 100)->sum('profit');
        $payPrice = PayMeta::where('status' , 100)->sum('price');
        $backs = PayMeta::where('status' , 2)->sum('price');
        $pays = PayMeta::where('status' , 100)->sum('price');
        $products = PayMeta::where('status' , 100)->sum('count');
        $gatePay = Pay::where('method' , 0)->sum('price');
        $walletPay = Pay::where('method' , 1)->sum('price');
        $homePay = Pay::where('method' , 2)->sum('price');
        $installPay = Pay::where('method' , 3)->sum('price');
        $quickPay = Pay::where('method' , 4)->sum('price');
        $cardPay = Pay::where('method' , 5)->sum('price');
        $carrierPrice = Pay::sum('carrier_price');
        return view('admin.cost.statistics',compact('direct','profits','carrierPrice','carrierPriceMonth','payPrice','backs','pays','products','cost','gatePay','walletPay','homePay','installPay','quickPay','cardPay','directMonth','costMonth','profitsMonth','payPriceMonth','backsMonth','paysMonth','productsMonth','gatePayMonth','walletPayMonth','homePayMonth','installPayMonth','quickPayMonth','cardPayMonth'));
    }

    public function store(Request $request){
        $code = Pay::buildCode();
        $pay = Pay::create([
            'refId'=>'هزینه',
            'status'=>$request->status,
            'tax'=>$request->tax,
            'property'=>$code,
            'price'=>$request->price,
            'note'=>$request->note,
            'user_id'=> auth()->user()->id,
            'method' => $request->methods,
            'back' => 4,
            'deliver' => 0,
            'deposit' => $request->price,
            'auth' => $code,
            'time' => '',
            'carrier'=> null,
            'carrier_price'=> 0,
        ]);
        return 'ok';
    }
}
