<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use Illuminate\Http\Request;

class LandController extends Controller
{
    public function index(){
        $lands = Land::latest()->paginate(50);
        return view('admin.land.index' , compact('lands'));
    }
    public function create(){
        return view('admin.land.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'slug' => 'max:220',
            'body' => 'required',
        ]);
        Land::create([
            'name' => $request->name,
            'html' => $request->body,
            'slug' => $request->slug,
        ]);
        return redirect()->back()->with([
            'message' => 'صفحه با موفقیت اضافه شد'
        ]);
    }
    public function edit(Land $land){
        return view('admin.land.edit',compact('land'));
    }
    public function update(Land $land , Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'slug' => 'max:220',
            'body' => 'required',
        ]);
        $land->update([
            'name' => $request->name,
            'html' => $request->body,
            'slug' => $request->slug,
        ]);
        return redirect()->back()->with([
            'message' => 'صفحه ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Land $land){
        $land->delete();
        return redirect()->back()->with([
            'message' => 'صفحه با موفقیت حذف شد'
        ]);
    }
}
