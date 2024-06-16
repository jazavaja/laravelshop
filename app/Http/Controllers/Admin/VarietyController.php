<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guarantee;
use App\Models\Product;
use Illuminate\Http\Request;

class VarietyController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->select(['id' , 'title' ,'price' , 'image' , 'count'])->where('variety' , '>=' , 1)->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::select(['id' , 'title' ,'price' , 'image' , 'count'])->where('variety' , '>=' , 1)->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.variety.index',compact('products','title'));
    }

    public function edit(Product $product){
        $posts = Product::where('id' , $product->id)->with('category','guarantee')->first();
        $guarantees = Guarantee::latest()->select(['name', 'id'])->get();
        return view('admin.variety.edit' , compact(
            'posts',
            'guarantees',
        ));
    }

    public function update(Product $product , Request $request){
        $request->validate([
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|integer|digits_between: 1,9',
        ]);
        if ($request->off){
            $price = round($request->price - $request->price * $request->off / 100);
        }else{
            $price = $request->price;
        }
        $product->update([
            'count' => $request->count,
            'price' => $price,
            'offPrice' => $request->price,
            'status' => $request->status,
            'off' => $request->off,
        ]);
        $product->guarantee()->detach();
        $product->guarantee()->sync(json_decode($request->guarantees));
        return 'success';
    }
    public function delete(Product $product){
        $product->category()->detach();
        $product->brand()->detach();
        $product->tag()->detach();
        $product->guarantee()->detach();
        $product->time()->detach();
        $product->comments()->delete();
        $product->like()->delete();
        $product->bookmark()->delete();
        $product->rates()->delete();
        $product->lottery()->delete();
        $product->cart()->delete();
        $product->payMeta()->delete();
        $product->delete();
        return redirect()->back()->with([
            'message' => 'محصول با موفقیت حذف شد'
        ]);
    }
}
