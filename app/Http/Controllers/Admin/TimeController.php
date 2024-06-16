<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $times = Time::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $times = Time::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.time' , compact('times','title'));
    }
    public function show(Request $request , Time $time){
        $times = Time::where('id' , $time->id)->with('product')->first();
        return view('admin.taxonomy.show.time' , compact('times'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
        ]);
        $post = Time::create([
            'name' => $request->name,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return redirect()->back()->with([
            'message' => 'زمان با موفقیت اضافه شد'
        ]);
    }
    public function edit(Time $time){
        return $time;
    }
    public function update(Time $time , Request $request){
        $request->validate([
            'name' => 'required|max:220',
        ]);
        $time->update([
            'name' => $request->name,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return redirect()->back()->with([
            'message' => 'زمان ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Time $time){
        $time->product()->detach();
        $time->delete();
        return redirect()->back()->with([
            'message' => 'زمان با موفقیت حذف شد'
        ]);
    }
}
