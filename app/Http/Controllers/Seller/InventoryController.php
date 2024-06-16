<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['id' , 'title' ,'price' , 'image' , 'count','colors','size'])->where('user_id' , auth()->user()->id)->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::select(['id' , 'title' ,'price' , 'image' , 'count','colors','size'])->where('user_id' , auth()->user()->id)->latest()->paginate(50)->setPath($currentUrl);
        }
        $inventory = 1;
        return view('seller.inventory.index',compact('products' , 'inventory','title'));
    }
    public function empty(Request $request){
        $title = $request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->where('user_id' , auth()->user()->id)->where('count' , 0)->select(['id' , 'title' ,'price' , 'image' , 'count','colors','size'])->latest()->paginate(100);
        }else{
            $products = Product::select(['id' , 'title' ,'price' , 'image' , 'count','colors','size'])->where('user_id' , auth()->user()->id)->where('count' , 0)->latest()->paginate(100);
        }
        $inventory = 0;
        return view('seller.inventory.index',compact('products','inventory','title'));
    }
}
