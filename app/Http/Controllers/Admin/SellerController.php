<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use App\Models\Genuine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($request->title){
            $users = User::permission('فروشنده')->withCount("subcategory")->withCount(['cooperation2' => function ($q) {
                $q->where('status' , 100)->select(DB::raw('sum(price)'));
            }])->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $users = User::permission('فروشنده')->withCount("subcategory")->withCount(['cooperation2' => function ($q) {
                $q->where('status' , 100)->select(DB::raw('sum(price)'));
            }])->with(['document' => function ($q) {
                $q->where('status' , 2);
            }])->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.seller.index',compact('users' , 'title'));
    }
    public function document(){
        $documents = Document::with('user')->paginate(50);
        return view('admin.seller.document',compact('documents'));
    }
    public function edit(Document $document){
        $documents = Document::latest()->where('id',$document->id)->with(["user" => function($q){
            $q->with('genuine' , 'company');
        }])->first();
        return view('admin.seller.edit',compact('documents'));
    }
    public function deleteDoc(Document $document){
        $document->delete();
        return redirect()->back()->with([
            'message' => 'مدرک پاک شد'
        ]);
    }
    public function update(Request $request , Document $document){
        $user = User::where('id' , $document->user_id)->first();
        $user->update([
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'shaba' => $request->shaba,
            'seller' => $request->seller,
            'landlinePhone'=>$request->landlinePhone,
        ]);
        $document->update([
            'status' => $request->status
        ]);
        $user->update([
            'name' => $request->name,
            'shaba' => $request->shaba,
            'seller' => $request->seller,
            'landlinePhone'=>$request->landlinePhone,
        ]);
        if($request->status == 2){
            $user->givePermissionTo('فروشنده');
        }
        if ($request->seller == 2){
            $check = $user->company()->count();
            if ($check >= 1){
                $user->company()->update([
                    'name' => $request->companyName,
                    'type' => $request->type,
                    'registration' => $request->registrationNumber,
                    'NationalID' => $request->nationalID,
                    'economicCode' => $request->economicCode,
                    'signer' => $request->signatureOwners,
                    'residenceAddress' => $request->residenceAddress,
                ]);
            }
            else{
                Company::create([
                    'name' => $request->companyName,
                    'type' => $request->type,
                    'registration' => $request->registrationNumber,
                    'NationalID' => $request->nationalID,
                    'economicCode' => $request->economicCode,
                    'signer' => $request->signatureOwners,
                    'residenceAddress' => $request->residenceAddress,
                    'user_id' => $user->id,
                ]);
            }
        }
        elseif($request->seller == 1){
            $check = $user->genuine()->count();
            if ($check >= 1){
                $user->genuine()->first()->update([
                    'name'=>$request->firstName,
                    'post'=>$request->post,
                    'gender'=>$request->gender,
                    'code'=>$request->code,
                    'residenceAddress' => $request->residenceAddress,
                ]);
            }
            else{
                $userMeta = Genuine::create([
                    'name'=>$request->name,
                    'post'=>$request->post,
                    'landlinePhone'=>$request->landlinePhone,
                    'gender'=>$request->gender,
                    'code'=>$request->code,
                    'residenceAddress' => $request->residenceAddress,
                ]);
                $user->genuine()->sync($userMeta->id);
            }
        }
        return redirect('/admin/sellers')->with([
            'message' => 'با موفقیت ثبت شد.'
        ]);
    }

    public function delete(User $user){
        $user->revokePermissionTo('فروشنده');
        return redirect()->back()->with([
            'message' => 'کاربر '.$user->name.' با موفقیت از بخش فروشندگان حذف شد.'
        ]);
    }
}
