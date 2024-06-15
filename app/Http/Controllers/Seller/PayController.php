<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use App\Models\PayMeta;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function index(Request $request){
        $posts = Product::latest()->where('user_id' , auth()->user()->id)->pluck('id');
        $title = $request->title;
        $delivery = $request->delivery;
        $currentUrl = url()->current().'?title='.$title.'&delivery='.$delivery;
        if($title){
            if($delivery != 5 && $delivery != '' || $delivery === 0){
                $pays = PayMeta::whereIn('product_id' , $posts)->where('deliver', $title)->where('deliver' , $delivery)->with('user','product','pay')->latest()->paginate(50)->setPath($currentUrl);
            }else{
                $pays = PayMeta::whereIn('product_id' , $posts)->where('deliver', $title)->with('user','product','pay')->latest()->paginate(50)->setPath($currentUrl);
            }
        }else{
            if($delivery != 5 && $delivery != '' || $delivery === 0){
                $pays = PayMeta::whereIn('product_id' , $posts)->latest()->where('deliver' , $delivery)->with('user','product','pay')->paginate(50)->setPath($currentUrl);
            }else{
                $pays = PayMeta::whereIn('product_id' , $posts)->latest()->with('user','product','pay')->paginate(50)->setPath($currentUrl);
            }
        }
        return view('seller.pay.index' , compact('pays','title','delivery'));
    }

    public function edit(PayMeta $payMeta){
        $pays = $payMeta::where('id' , $payMeta->id)->with('user')->with(["pay" => function($q){
            $q->with('address');
        }])->first();
        $name = Setting::where('key' , 'name')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        return view('seller.pay.show' , compact('pays','name','number'));
    }

    public function update(PayMeta $payMeta , Request $request){
        if($request->update == 2){
            $payMeta->update([
                'deliver' => $request->deliver
            ]);
        }
        if($request->update == 3){
            $payMeta->update([
                'track' => $request->track
            ]);
        }
        return 'success';
    }
}
