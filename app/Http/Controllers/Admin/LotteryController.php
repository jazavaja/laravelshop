<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\LotteryCode;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function index(){
        $lotteries = Lottery::where('parent_id' , 0)->latest()->with('product')->withCount('lotteryCode')->get();
        return view('admin.lottery.index',compact('lotteries'));
    }
    public function edit(Lottery $lottery){
        $posts = Lottery::where('id' , $lottery->id)->with(["lotteryCode" => function($q){
            $q->with('user');
        }])->with('winner')->first();
        return view('admin.lottery.edit',compact('posts'));
    }
    public function update(Request $request,Lottery $lottery){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required',
        ]);
        foreach (json_decode($request->abilities) as $item){
            Lottery::create([
                'user_id'=> $item->user_id,
                'code'=> $item->code,
                'parent_id'=> $lottery->id,
            ]);
        };
        $lottery->update([
            'title'=> $request->title,
            'status'=> $request->status,
            'body'=> $request->body,
            'link'=> $request->link,
        ]);
        return 'success';
    }
    public function code(){
        $codes = LotteryCode::latest()->with('product','user','pay')->get();
        return view('admin.lottery.lotteryCode',compact('codes'));
    }
}
