<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Counseling;
use App\Models\News;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index(){
        $startDayEn = verta()->startDay()->formatGregorian('Y-m-d H:i:s');
        $endDayEn = verta()->endDay()->formatGregorian('Y-m-d H:i:s');
        $todayUser = User::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $allPay = Pay::whereNotIn('status' , [0,2,1])->count();
        $todayPay = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->whereNotIn('status' , [0,2,1])->count();
        $allComment = Counseling::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $todayComment = Comment::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $allEmpty = Product::where('count' , 0)->count();
        $allIncome = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $allView = View::count();
        $todayView = View::whereBetween('created_at', [$startDayEn, $endDayEn])->count();

        $year2 =verta()->year;
        $farvardin = Verta::parse($year2 . ' فروردین 1')->formatGregorian('Y-m-d H:i:s');
        $ordibehesht = Verta::parse($year2 . ' اردیبهشت 1')->formatGregorian('Y-m-d H:i:s');
        $khordad = Verta::parse($year2 . ' خرداد 1')->formatGregorian('Y-m-d H:i:s');
        $tir = Verta::parse($year2 . ' تیر 1')->formatGregorian('Y-m-d H:i:s');
        $mordad = Verta::parse($year2 . ' مرداد 1')->formatGregorian('Y-m-d H:i:s');
        $shahrivar = Verta::parse($year2 . ' شهریور 1')->formatGregorian('Y-m-d H:i:s');
        $mehr = Verta::parse($year2 . ' مهر 1')->formatGregorian('Y-m-d H:i:s');
        $aban = Verta::parse($year2 . ' آبان 1')->formatGregorian('Y-m-d H:i:s');
        $azar = Verta::parse($year2 . ' آذر 1')->formatGregorian('Y-m-d H:i:s');
        $dey = Verta::parse($year2 . ' دی 1')->formatGregorian('Y-m-d H:i:s');
        $bahman = Verta::parse($year2 . ' بهمن 1')->formatGregorian('Y-m-d H:i:s');
        $esfand = Verta::parse($year2 . ' اسفند 1')->formatGregorian('Y-m-d H:i:s');

        $deyPay = Pay::whereBetween('created_at', [$dey, $bahman])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $bahmanPay = Pay::whereBetween('created_at', [$bahman, $esfand])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $esfandPay = Pay::whereBetween('created_at', [$esfand, $farvardin])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $farvardinPay = Pay::whereBetween('created_at', [$farvardin, $ordibehesht])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $ordibeheshtPay = Pay::whereBetween('created_at', [$ordibehesht, $khordad])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $khordadPay = Pay::whereBetween('created_at', [$khordad, $tir])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $tirPay = Pay::whereBetween('created_at', [$tir, $mordad])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $mordadPay = Pay::whereBetween('created_at', [$mordad, $shahrivar])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $shahrivarPay = Pay::whereBetween('created_at', [$shahrivar, $mehr])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $mehrPay = Pay::whereBetween('created_at', [$mehr, $aban])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $abanPay = Pay::whereBetween('created_at', [$aban, $azar])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $azarPay = Pay::whereBetween('created_at', [$azar, $dey])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();


        $taskChart0 = Pay::where('status' ,100)->count();
        $taskChart1 = Pay::where('status' ,50)->count();
        $taskChart2 = Pay::where('status' ,0)->count();
        $taskChart3 = Pay::where('status' ,1)->count();
        $projectChart0 = Pay::where('deliver' ,1)->count();
        $projectChart1 = Pay::where('deliver' ,2)->count();
        $projectChart2 = Pay::where('deliver' ,3)->count();
        $projectChart3 = Pay::where('deliver' ,4)->count();

        $statusProduct0 = Product::where('count' , '>=' , 20)->count();
        $statusProduct1 = Product::whereBetween('count', [1, 20])->count();
        $statusProduct2 = Product::where('count' , 0)->count();

        return view('admin.panel',compact(
            'todayUser',
            'allPay',
            'todayPay',
            'allComment',
            'todayComment',
            'allEmpty',
            'allIncome',
            'allView',
            'todayView',
            'deyPay',
            'bahmanPay',
            'esfandPay',
            'farvardinPay',
            'ordibeheshtPay',
            'khordadPay',
            'tirPay',
            'mordadPay',
            'shahrivarPay',
            'mehrPay',
            'abanPay',
            'azarPay',
            'taskChart0',
            'taskChart1',
            'taskChart2',
            'taskChart3',
            'projectChart0',
            'projectChart1',
            'projectChart2',
            'projectChart3',
            'statusProduct0',
            'statusProduct1',
            'statusProduct2',
        ));
    }
    public function learn(){
        return view('admin.learn');
    }
}
