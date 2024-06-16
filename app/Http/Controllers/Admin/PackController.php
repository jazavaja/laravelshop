<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $packs = Pack::where(function ($query) use($title) {
                $query->where('title', $title)
                    ->orWhere('id', $title);
            })->select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $packs = Pack::select(['title' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.pack' , compact('packs','title'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'percent' => 'required|integer|max:100',
            'month' => 'required|integer|max:100',
            'count' => 'required|integer|max:100',
        ]);
        $post = Pack::create([
            'title' => $request->title,
            'percent' => $request->percent,
            'month' => $request->month,
            'count' => $request->count,
        ]);
        return redirect()->back()->with([
            'message' => 'پک با موفقیت اضافه شد'
        ]);
    }
    public function edit(Pack $pack){
        return $pack;
    }
    public function show(Request $request , Pack $pack){
        $packs = Pack::where('id' , $pack->id)->first();
        return view('admin.taxonomy.show.pack' , compact('packs'));
    }
    public function update(Pack $pack , Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'percent' => 'required|integer|max:100',
            'month' => 'required|integer|max:100',
            'count' => 'required|integer|max:100',
        ]);
        $pack->update([
            'title' => $request->title,
            'percent' => $request->percent,
            'month' => $request->month,
            'count' => $request->count,
        ]);
        return redirect()->back()->with([
            'message' => 'پک ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Pack $pack){
        $pack->delete();
        return redirect()->back()->with([
            'message' => 'پک با موفقیت حذف شد'
        ]);
    }
}
