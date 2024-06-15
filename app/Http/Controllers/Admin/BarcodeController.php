<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class BarcodeController extends Controller
{
    public function index(){
        $show1 = request()->show ?? 0;
        return view('admin.barcode.index',compact('show1'));
    }
}
