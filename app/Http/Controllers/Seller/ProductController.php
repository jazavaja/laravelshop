<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Guarantee;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Time;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->with('category')->where('status' , 1)->where('variety' , 0)->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::with('category')->where('variety' , 0)->where('status' , 1)->latest()->paginate(50)->setPath($currentUrl);
        }
        $tab = 2;
        return view('seller.post.index',compact('products','title','tab'));
    }
    public function myProduct(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->with('category')->where('user_id' , auth()->user()->id)->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::with('category')->where('user_id' , auth()->user()->id)->latest()->paginate(50)->setPath($currentUrl);
        }
        $tab = 6;
        return view('seller.post.index',compact('products','title','tab'));
    }
    public function create(){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $brands = Brand::select(['id' , 'name'])->latest()->get();
        $guarantees = Guarantee::select(['id' , 'name'])->latest()->get();
        $times = Time::select(['id' , 'name'])->latest()->get();
        $tags = Tag::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        return view('seller.post.create',compact('cats','tags','times','brands','guarantees'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|integer|digits_between: 1,9',
        ]);
        if ($request->off){
            $price = round($request->price - $request->price * $request->off / 100);
        }else{
            $price = $request->price;
        }
        if ($request->used == 'true'){
            $used = 1;
        }else{
            $used = 0;
        }
        if ($request->original == 'true'){
            $original = 1;
        }else{
            $original = 0;
        }

        if($request->suggest){
            $ss =strtr($request->suggest, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
            $times = Verta::parse($ss)->toCarbon();
            $times2 = explode('T',$times);
            $suggest = implode(' ',$times2);
        }else{
            $suggest = null;
        }
        $productIds = Product::buildCode();
        $productId = Setting::where('key', 'productId')->pluck('value')->first();
        $post = Product::create([
            'short' => $request->body,
            'count' => $request->count,
            'title' => $request->title,
            'showcase' => 0,
            'used' => $used,
            'weight' => $request->weight,
            'original' => $original,
            'status' => 0,
            'slug' => $request->slug,
            'image' => $request->image,
            'score' => 0,
            'price' => $price,
            'priceCurrency' => $price,
            'offPrice' => $request->price,
            'off' => $request->off,
            'suggest' => $suggest,
            'user_id' => auth()->user()->id,
            'product_id' => $productId . '-' .$productIds,
            'body' => $request->editor,
            'ability' => $request->abilities,
            'size' => $request->sizes,
            'specifications' => $request->properties,
            'colors' => $request->colors,
        ]);
        $post->category()->sync(json_decode($request->cats));
        $post->brand()->sync(json_decode($request->brands));
        $post->guarantee()->sync(json_decode($request->guarantees));
        $post->time()->sync(json_decode($request->times));
        $post->tag()->sync(json_decode($request->tags));
    }
    public function edit(Product $product){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $brands = Brand::select(['id' , 'name'])->latest()->get();
        $guarantees = Guarantee::select(['id' , 'name'])->latest()->get();
        $times = Time::select(['id' , 'name'])->latest()->get();
        $tags = Tag::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $posts = Product::where('id' , $product->id)->with('category','tag','guarantee','brand','time')->first();
        return view('seller.post.edit',compact('cats','times','tags','brands','guarantees','posts'));
    }
    public function update(Product $product,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|integer|digits_between: 1,9',
        ]);
        if ($request->off){
            $price = round($request->price - $request->price * $request->off / 100);
        }else{
            $price = $request->price;
        }
        if ($request->used == 'true'){
            $used = 1;
        }else{
            $used = 0;
        }
        if ($request->original == 'true'){
            $original = 1;
        }else{
            $original = 0;
        }

        $post = $product->update([
            'short' => $request->body,
            'count' => $request->count,
            'title' => $request->title,
            'showcase' => 0,
            'used' => $used,
            'weight' => $request->weight,
            'original' => $original,
            'image' => $request->image,
            'price' => $price,
            'offPrice' => $request->price,
            'off' => $request->off,
            'body' => $request->editor,
            'ability' => $request->abilities,
            'size' => $request->sizes,
            'specifications' => $request->properties,
            'colors' => $request->colors,
        ]);

        $product->category()->detach();
        $product->brand()->detach();
        $product->guarantee()->detach();
        $product->time()->detach();
        $product->tag()->detach();
        $product->category()->sync(json_decode($request->cats));
        $product->brand()->sync(json_decode($request->brands));
        $product->guarantee()->sync(json_decode($request->guarantees));
        $product->time()->sync(json_decode($request->times));
        $product->tag()->sync(json_decode($request->tags));
        return 'success';
    }

    public function addVariety(Product $product){
        $posts = Product::where('id' , $product->id)->with('category','guarantee')->first();
        $guarantees = Guarantee::latest()->select(['name', 'id'])->get();
        return view('seller.variety.create' , compact(
            'posts',
            'guarantees',
        ));
    }

    public function editVariety(Product $product){
        $posts = Product::where('id' , $product->id)->with('category','guarantee')->first();
        $guarantees = Guarantee::latest()->select(['name', 'id'])->get();
        return view('seller.variety.edit' , compact(
            'posts',
            'guarantees',
        ));
    }

    public function storeVariety(Product $product , Request $request){
        $request->validate([
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|integer|digits_between: 1,9',
        ]);
        if ($request->off){
            $price = round($request->price - $request->price * $request->off / 100);
        }else{
            $price = $request->price;
        }
        $productIds = Product::buildCode();
        $productId = Setting::where('key', 'productId')->pluck('value')->first();
        $variety = Product::create([
            'short' => $product->short,
            'count' => $request->count,
            'title' => $product->title,
            'showcase' => 0,
            'used' => 0,
            'weight' => $product->weight,
            'original' => 1,
            'status' => 0,
            'slug' => $product->slug,
            'image' => $product->image,
            'score' => $product->score,
            'titleSeo' => $product->titleSeo,
            'bodySeo' => $product->bodySeo,
            'keywordSeo' => $product->keywordSeo,
            'imageAlt' => $product->imageAlt,
            'price' => $price,
            'priceCurrency' => $price,
            'offPrice' => $request->price,
            'off' => $request->off,
            'variety' => $product->id,
            'user_id' => auth()->user()->id,
            'product_id' => $productId . '-' . $productIds,
            'body' => $product->body,
            'ability' => $product->abilities,
            'size' => $request->sizes,
            'specifications' => $product->properties,
            'colors' => $request->colors,
        ]);
        $variety->category()->sync($product->category);
        $variety->brand()->sync($product->brand);
        $variety->time()->sync($product->time);
        $variety->tag()->sync($product->tag);
        $variety->guarantee()->sync(json_decode($request->guarantees));
        return 'success';
    }

    public function updateVariety(Product $product , Request $request){
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
            'off' => $request->off,
        ]);
        $product->guarantee()->detach();
        $product->guarantee()->sync(json_decode($request->guarantees));
        return 'success';
    }
}
