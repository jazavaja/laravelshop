<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Time;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function create(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $collections = Collection::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $collections = Collection::select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        $times = Time::select(['id' , 'name'])->latest()->get();
        $products = Product::select(['id' , 'title'])->where('variety' , 0)->latest()->get();
        return view('admin.collection.index',compact('times','title','products','collections'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'titleSeo' => 'required|max:220',
            'body' => 'required',
            'time' => 'required',
            'keyword' => 'required|max:220',
            'bodySeo' => 'required',
            'count' => 'required|max:220',
            'price' => 'required|max:10',
        ]);
        if ($request->off){
            $price = round((int)$request->price - ((int)$request->price * $request->off / 100));
        }else{
            $price = (int)$request->price;
        }
        $post = Collection::create([
            'title' => $request->title,
            'titleSeo' => $request->titleSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keyword,
            'language' => $request->language,
            'count' => $request->count,
            'offPrice' => $request->price,
            'slug' => $request->slug,
            'off' => $request->off,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
            'price' => $price,
        ]);
        $post->product()->sync($request->products);
        $post->time()->sync($request->time);
        return redirect()->back()->with([
            'message' => 'پک با موفقیت اضافه شد'
        ]);
    }
    public function edit(Collection $collection){
        return Collection::where('id' , $collection->id)->with('product','time')->first();
    }
    public function update(Collection $collection , Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'titleSeo' => 'required|max:220',
            'body' => 'required',
            'time' => 'required',
            'keyword' => 'required|max:220',
            'bodySeo' => 'required',
            'count' => 'required|max:220',
            'price' => 'required|max:10',
        ]);
        if ($request->off){
            $price = round((int)$request->price - ((int)$request->price * $request->off / 100));
        }else{
            $price = (int)$request->price;
        }
        $collection->update([
            'title' => $request->title,
            'titleSeo' => $request->titleSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'keyword' => $request->keyword,
            'language' => $request->language,
            'count' => $request->count,
            'offPrice' => $request->price,
            'slug' => $request->slug,
            'off' => $request->off,
            'image' => $request->image,
            'price' => $price,
        ]);
        $collection->product()->detach();
        $collection->time()->detach();
        $collection->product()->sync($request->products);
        $collection->time()->sync($request->time);
        return redirect()->back()->with([
            'message' => 'پک ' . $request->title . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Collection $collection){
        $collection->product()->detach();
        $collection->time()->detach();
        $collection->delete();
        return redirect()->back()->with([
            'message' => 'پک با موفقیت حذف شد'
        ]);
    }
}
