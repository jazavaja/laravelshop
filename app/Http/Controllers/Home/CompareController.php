<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request){
        $product = '';
        if($request->product){
            $product = Product::where('product_id' , $request->product)->first();
            if($product){
                $cat = $product->category()->first();
            }
        }
        if(!$cat){
            $cat = Category::first();
        }
        $products = $cat->product()->where('status', 1)->where('variety',0)->get();
        return view('home.compare.index',compact('products','product'));
    }
    public function getCompare(Request $request){
        return Product::where('id' , $request->product)->first();
    }
}
