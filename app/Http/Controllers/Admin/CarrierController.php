<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\CarrierCity;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $carriers = Carrier::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $carriers = Carrier::select(['name' , 'id'])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.taxonomy.index.carrier' , compact('carriers','title'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'price' => 'required|max:10',
            'limit' => 'required|max:10',
        ]);
        $post = Carrier::create([
            'name' => $request->name,
            'language' => $request->language,
            'price' => $request->price,
            'limit' => $request->limit,
        ]);
        if(!empty($request->city)){
            for ($i = 0; $i < count($request->city); $i++){
                CarrierCity::create([
                    'city' => $request->city[$i],
                    'carrier' => $post->id,
                    'price' => $request->price2[$i],
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'حامل با موفقیت اضافه شد'
        ]);
    }
    public function edit(Carrier $carrier){
        return Carrier::where('id' , $carrier->id)->with('cities')->first();
    }
    public function update(Carrier $carrier , Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'price' => 'required|max:10',
            'limit' => 'required|max:10',
        ]);
        $carrier->update([
            'name' => $request->name,
            'language' => $request->language,
            'price' => $request->price,
            'limit' => $request->limit,
        ]);
        CarrierCity::where('carrier' , $carrier->id)->delete();
        if(!empty($request->city)){
            for ($i = 0; $i < count($request->city); $i++){
                CarrierCity::create([
                    'city' => $request->city[$i],
                    'carrier' => $carrier->id,
                    'price' => $request->price2[$i],
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'حامل ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Carrier $carrier){
        $carrier->delete();
        return redirect()->back()->with([
            'message' => 'حامل با موفقیت حذف شد'
        ]);
    }
}
