<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompareProduct;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function create(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $compares = CompareProduct::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $compares = CompareProduct::select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.compare.index',compact('title','compares'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'link' => 'required|max:400',
            'image1' => 'required|max:300',
            'image2' => 'required|max:300',
            'text2' => 'required|max:255',
            'text1' => 'required|max:255',
        ]);
        $post = CompareProduct::create([
            'title' => $request->title,
            'link' => $request->link,
            'image1' => $request->image1,
            'image2' => $request->image2,
            'text1' => $request->text1,
            'text2' => $request->text2,
            'language' => $request->language,
        ]);
        return redirect()->back()->with([
            'message' => 'محصول با موفقیت اضافه شد'
        ]);
    }
    public function edit(CompareProduct $compareProduct){
        return CompareProduct::where('id' , $compareProduct->id)->first();
    }
    public function update(CompareProduct $compareProduct , Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'link' => 'required|max:400',
            'image1' => 'required|max:300',
            'image2' => 'required|max:300',
            'text2' => 'required|max:255',
            'text1' => 'required|max:255',
        ]);
        $compareProduct->update([
            'title' => $request->title,
            'link' => $request->link,
            'image1' => $request->image1,
            'image2' => $request->image2,
            'text1' => $request->text1,
            'text2' => $request->text2,
            'language' => $request->language,
        ]);
        return redirect()->back()->with([
            'message' => 'محصول ' . $request->title . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(CompareProduct $compareProduct){
        $compareProduct->delete();
        return redirect()->back()->with([
            'message' => 'محصول با موفقیت حذف شد'
        ]);
    }
}
