<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Converter;
use Illuminate\Http\Request;

class ConverterController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $converters = Converter::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $converters = Converter::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.converter' , compact('converters','title'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
        ]);
        $post = Converter::create([
            'name' => $request->name,
            'type' => $request->type,
            'score' => $request->score,
            'reward' => $request->reward,
        ]);
        return redirect()->back()->with([
            'message' => 'تبدیل با موفقیت اضافه شد'
        ]);
    }
    public function edit(Converter $converter){
        return $converter;
    }
    public function update(Converter $converter , Request $request){
        $request->validate([
            'name' => 'required|max:220',
        ]);
        $converter->update([
            'name' => $request->name,
            'type' => $request->type,
            'score' => $request->score,
            'reward' => $request->reward,
        ]);
        return redirect()->back()->with([
            'message' => 'تبدیل ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Converter $converter){
        $converter->delete();
        return redirect()->back()->with([
            'message' => 'تبدیل با موفقیت حذف شد'
        ]);
    }
}
