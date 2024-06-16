<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $categories = Category::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $categories = Category::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        $cats = Category::select(['name' , 'id'])->latest()->get();
        return view('admin.taxonomy.index.category' , compact('categories','cats','title'));
    }
    public function show(Request $request , Category $category){
        $categories = Category::where('id' , $category->id)->with('product','blogs')->first();
        return view('admin.taxonomy.show.category' , compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'nameSeo' => 'required|max:220',
            'keyword' => 'required|max:220',
            'percent' => 'required|max:3',
            'bodySeo' => 'required',
        ]);
        $post = Category::create([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'percent' => $request->percent,
            'image' => $request->image,
            'slug' => $request->slug,
            'language' => $request->language,
            'type' => $request->type,
            'keyword' => $request->keyword,
        ]);
        $post->cats()->attach($request->cats);
        return redirect()->back()->with([
            'message' => 'دسته بندی با موفقیت اضافه شد'
        ]);
    }
    public function edit(Category $category){
        return Category::where('id' , $category->id)->with('cats')->first();
    }
    public function update(Category $category , Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'nameSeo' => 'required|max:220',
            'keyword' => 'required|max:220',
            'percent' => 'required|max:3',
            'bodySeo' => 'required',
        ]);
        $category->update([
            'name' => $request->name,
            'nameSeo' => $request->nameSeo,
            'body' => $request->body,
            'bodySeo' => $request->bodySeo,
            'percent' => $request->percent,
            'image' => $request->image,
            'type' => $request->type,
            'language' => $request->language,
            'slug' => $request->slug,
            'keyword' => $request->keyword,
        ]);
        $category->cats()->detach();
        $category->cats()->attach($request->cats);
        return redirect()->back()->with([
            'message' => 'دسته بندی ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Category $category){
        $category->product()->detach();
        $category->cats()->detach();
        $category->delete();
        return redirect()->back()->with([
            'message' => 'دسته بندی با موفقیت حذف شد'
        ]);
    }
}
