<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $links = Link::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $links = Link::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.link' , compact('links','title'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'slug' => 'required',
        ]);
        $post = Link::create([
            'name' => $request->name,
            'tooltip' => $request->tooltip,
            'slug' => $request->slug,
            'language' => $request->language,
            'type' => $request->type,
        ]);
        return redirect()->back()->with([
            'message' => 'لینک با موفقیت اضافه شد'
        ]);
    }
    public function edit(Link $link){
        return $link;
    }
    public function update(Link $link , Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'slug' => 'required',
        ]);
        $link->update([
            'name' => $request->name,
            'tooltip' => $request->tooltip,
            'slug' => $request->slug,
            'language' => $request->language,
            'type' => $request->type,
        ]);
        return redirect()->back()->with([
            'message' => 'لینک ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Link $link){
        $link->delete();
        return redirect()->back()->with([
            'message' => 'لینک با موفقیت حذف شد'
        ]);
    }
}
