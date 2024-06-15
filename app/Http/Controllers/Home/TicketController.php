<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return view('home.ticket.index');
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
            'answer' => 'required',
        ]);
        Ticket::create([
            'title'=>$request->title,
            'status'=>$request->status,
            'answer'=>$request->answer,
            'body'=>$request->body,
            'type'=>3,
            'user_id'=>0,
        ]);
        return redirect()->back()->with([
            'success' => __('messages.request_back')
        ]);
    }
}
