<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counseling;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::latest()->where('type' , '!=' , 3)->get();
        return view('admin.ticket.index',compact('tickets'));
    }
    public function edit(Ticket $ticket , Request $request){
        $request->validate([
            'body' => 'required',
        ]);
        $ticket->update([
            'body' => $request->body,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'تیکت با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Ticket $ticket){
        $ticket->delete();
        return redirect()->back()->with([
            'message' => 'تیکت با موفقیت حذف شد'
        ]);
    }

    public function counselingIndex(){
        $counselings = Counseling::latest()->with('product')->get();
        return view('admin.counseling.index',compact('counselings'));
    }
    public function counselingEdit(Counseling $counseling , Request $request){
        $request->validate([
            'body' => 'required',
        ]);
        $counseling->update([
            'body' => $request->body,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'مشاوره با موفقیت ویرایش شد'
        ]);
    }
    public function counselingRemove(Counseling $counseling){
        $counseling->delete();
        return redirect()->back()->with([
            'message' => 'مشاوره با موفقیت حذف شد'
        ]);
    }
}
