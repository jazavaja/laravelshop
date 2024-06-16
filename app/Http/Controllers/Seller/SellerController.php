<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\PayMeta;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(){
        $posts = Product::latest()->where('user_id' , auth()->user()->id)->where('type',0)->pluck('id');
        $pays = PayMeta::latest()->whereIn('product_id' , $posts)->where('status' , 100)->with('product','pay','user')->take(10)->get();
        $paycount = PayMeta::latest()->whereIn('product_id' , $posts)->where('status' , 100)->pluck('price')->sum();
        $postcount = Product::latest()->where('user_id' , auth()->user()->id)->where('type',0)->count();
        $checksum = Wallet::where('user_id' , auth()->user()->id)->where('status' , 2)->latest()->pluck('price')->sum();
        $posts = Product::latest()->where('user_id' , auth()->user()->id)->where('type',0)->take(10)->get();
        return view('seller.index',compact('pays','paycount','postcount','checksum','posts'));
    }
}
