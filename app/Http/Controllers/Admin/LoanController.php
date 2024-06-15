<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Wallet;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $loans = Loan::where(function ($query) use($title) {
                $query->where('name', $title)
                    ->orWhere('id', $title);
            })->with('user')->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $loans = Loan::latest()->with('user')->paginate(50)->setPath($currentUrl);
        }
        return view('admin.loan.index' , compact('loans','title'));
    }

    public function getLoan(Request $request){
        return Loan::where('id',$request->loan)->first();
    }

    public function edit(Loan $loan , Request $request){
        $request->validate([
            'amount' => 'required',
            'refund' => 'required',
            'month' => 'required',
            'percent' => 'required',
        ]);
        $loan->update([
            'amount' => $request->amount,
            'monthProfit' => $request->monthProfit,
            'refund' => $request->refund,
            'month' => $request->month,
            'percent' => $request->percent,
            'status' => $request->status,
        ]);
        if($request->status == 2){
            $code = Wallet::buildCode();
            Wallet::create([
                'refId' => 'پرداخت وام',
                'price'=> $request->amount,
                'type'=> 0,
                'status'=> 100,
                'property'=> $code,
                'user_id'=> $loan->user_id,
            ]);
        }
        return redirect()->back()->with([
            'message' => 'وام با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Loan $loan){
        $loan->delete();
        return redirect()->back()->with([
            'message' => 'وام با موفقیت حذف شد'
        ]);
    }
}
