<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\FieldData;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index(){
        $fields = Field::latest()->paginate(60);
        return view('admin.field.index',compact('fields'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        Field::create([
            'name' => $request->name,
            'disable_status' => $request->disable_status == 'on' ? 1 : 0,
            'value' => $request->value,
            'type' => $request->type,
            'choice' => $request->choice,
            'required_status' => $request->required_status == 'on' ? 1 : 0,
            'show_status' => $request->show_status == 'on' ? 1 : 0,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'فیلد با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Field::where('id' , $request->field)->first();
    }
    public function update(Field $field , Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $field->update([
            'name' => $request->name,
            'disable_status' => $request->disable_status == 'on' ? 1 : 0,
            'value' => $request->value,
            'type' => $request->type,
            'choice' => $request->choice,
            'required_status' => $request->required_status == 'on' ? 1 : 0,
            'show_status' => $request->show_status == 'on' ? 1 : 0,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Field $field){
        FieldData::where('field_id' , $field->id)->delete();
        $field->delete();
        return redirect()->back()->with([
            'message' => $field->name . ' با موفقیت حذف شد'
        ]);
    }
}
