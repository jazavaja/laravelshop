<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\FieldData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($request->title){
            $users = User::where(function ($query) use($title) {
                $query->where('name' , "LIKE" , "%{$title}%")
                    ->orWhere('number', $title)
                    ->orWhere('email', $title)
                    ->orWhere('id', $title);
            })->withCount("subcategory")->withCount(['wallet as walletUp' => function ($q) {
                $q->where('type' , 0)->select(DB::raw('sum(price)'));
            }])->withCount(['wallet as walletDown' => function ($q) {
                $q->where('type' , 1)->select(DB::raw('sum(price)'));
            }])->withCount(['pay' => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(price)'));
            }])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $users = User::withCount("subcategory")->withCount(['wallet as walletUp' => function ($q) {
                $q->where('status' , 100)->where('type' , 0)->select(DB::raw('sum(price)'));
            }])->withCount(['wallet as walletDown' => function ($q) {
                $q->where('status' , 100)->where('type' , 1)->select(DB::raw('sum(price)'));
            }])->withCount(['pay' => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(price)'));
            }])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.user.index',compact('users','title'));
    }
    public function create(){
        $roles = Role::latest()->get();
        $permissions = Permission::latest()->get();
        return view('admin.user.create',compact('roles','permissions'));
    }
    public function edit(User $user){
        $users = User::where('id' , $user->id)->with('roles','fields','permissions')->first();
        $roles = Role::latest()->get();
        $permissions = Permission::latest()->get();
        return view('admin.user.edit',compact('roles','permissions' , 'users'));
    }
    public function update(User $user , Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $fields = Field::where('status' , 0)->get();
        foreach ($fields as $item){
            FieldData::where('model_id' , $user->id)->where('field_id' , $item->id)->delete();
            if($item->required_status){
                $request->validate([
                    'field'.$item->id => 'required',
                ]);
            }
            FieldData::create([
                'field_id' => $item->id,
                'value' => $request['field'.$item->id],
                'type' => 0,
                'model_id' => $user->id,
            ]);
        }
        if ($request->password){
            $user->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'number'=> $request->number,
                'admin'=> $request->admin,
                'suspension'=> $request->suspension,
                'password'=> Hash::make($request->password),
                'updated_at'=> Carbon::now(),
            ]);
            if($request->role){
                $user->removeRole($request->role);
                $user->syncRoles($request->role);
            }
            if($request->permissions){
                foreach ($user->permissions as $permission) {
                    $user->revokePermissionTo($permission->name);
                }
                foreach ($request->permissions as $permission) {
                    $user->givePermissionTo($permission);
                }
            }
        }else{
            $user->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'number'=> $request->number,
                'admin'=> $request->admin,
                'suspension'=> $request->suspension,
                'updated_at'=> Carbon::now(),
            ]);
            if($request->role){
                $user->removeRole($request->role);
                $user->syncRoles($request->role);
            }
            if($request->permissions){
                foreach ($user->permissions as $permission) {
                    $user->revokePermissionTo($permission->name);
                }
                foreach ($request->permissions as $permission) {
                    $user->givePermissionTo($permission);
                }
            }
        }
        return redirect('/admin/user')->with([
            'message' => 'کاربر '. $request->name .' با موفقیت ویرایش شد'
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $fields = Field::where('status' , 0)->get();
        foreach ($fields as $item){
            if($item->required_status){
                $request->validate([
                    'field'.$item->id => 'required',
                ]);
            }
        }
        $code = User::buildCode();
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'number'=> $request->number,
            'suspension'=> $request->suspension,
            'referral'=> $code,
            'admin'=> $request->admin,
            'password'=> Hash::make($request->password),
        ]);
        foreach ($fields as $item){
            FieldData::create([
                'field_id' => $item->id,
                'type' => 0,
                'value' => $request['field'.$item->id],
                'model_id' => $user->id,
            ]);
        }
        if($request->role){
            $user->syncRoles($request->role);
        }
        if($request->permissions){
            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }
        return redirect('/admin/user')->with([
            'message' => 'کاربر '. $request->name .' با موفقیت اضافه شد'
        ]);
    }
    public function delete(User $user){
        $user->lotteryCode()->delete();
        $user->comments()->delete();
        $user->cart()->delete();
        $user->installments()->delete();
        $user->report()->delete();
        $user->ticket()->delete();
        $user->document()->delete();
        $user->counseling()->delete();
        $user->delete();
        return redirect()->back()->with([
            'message' => 'کاربر با موفقیت حذف شد'
        ]);
    }
}
