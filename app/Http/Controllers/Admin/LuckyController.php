<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lucky;
use Illuminate\Http\Request;

class LuckyController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $luckies = Lucky::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $luckies = Lucky::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.lucky' , compact('luckies','title'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'background' => 'required',
            'color' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);
        $post = Lucky::create([
            'name' => $request->name,
            'background' => $request->background,
            'color' => $request->color,
            'language' => $request->language,
            'value' => $request->value,
            'type' => $request->type,
        ]);
        return redirect()->back()->with([
            'message' => 'آیتم با موفقیت اضافه شد'
        ]);
    }
    public function edit(Lucky $lucky){
        return $lucky;
    }
    public function update(Lucky $lucky , Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'background' => 'required',
            'color' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);
        $lucky->update([
            'name' => $request->name,
            'background' => $request->background,
            'value' => $request->value,
            'language' => $request->language,
            'color' => $request->color,
            'type' => $request->type,
        ]);
        return redirect()->back()->with([
            'message' => 'آیتم ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Lucky $lucky){
        $lucky->delete();
        return redirect()->back()->with([
            'message' => 'آیتم با موفقیت حذف شد'
        ]);
    }
}
