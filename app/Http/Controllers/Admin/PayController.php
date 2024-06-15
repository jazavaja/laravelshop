<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Counseling;
use App\Models\Installments;
use App\Models\Loan;
use App\Models\Pay;
use App\Models\PayMeta;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use App\Models\View;
use App\Models\Wallet;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    use SendSmsTrait;
    public function index(Request $request){
        $title = $request->title;
        $delivery = $request->delivery;
        if($request->pin){
            $pinPay = Pay::where('id' , $request->pin)->first();
            $pinPay->update([
                'pin' => $pinPay->pin ? 0 : 1
            ]);
            return redirect(url()->current().'?title='.$title.'&delivery='.$delivery);
        }
        $currentUrl = url()->current().'?title='.$title.'&delivery='.$delivery;
        if($title){
            if($delivery != 5 && $delivery != '' || $delivery === 0){
                $pays = Pay::where('back' , '!=' , 4)->where(function ($query) use($title) {
                    $query->where('property', $title)
                        ->orWhere('id', $title)
                        ->orWhere('user_id', $title)
                        ->orWhere('deliver', $title);
                })->where('deliver' , $delivery)->with('user')->with(["payMeta" => function($q){
                    $q->with('product','collection');
                }])->latest()->paginate(50)->setPath($currentUrl);
            }else{
                $pays = Pay::where('back' , '!=' , 4)->where(function ($query) use($title) {
                    $query->where('property', $title)
                        ->orWhere('id', $title)
                        ->orWhere('user_id', $title)
                        ->orWhere('deliver', $title);
                })->with('user')->with(["payMeta" => function($q){
                    $q->with('product','collection');
                }])->latest()->paginate(50)->setPath($currentUrl);
            }
            $pined = [];
        }
        else{
            if($delivery != 5 && $delivery != '' || $delivery === 0){
                $pays = Pay::where('back' , '!=' , 4)->latest()->where('pin' , 0)->where('deliver' , $delivery)->with('user')->with(["payMeta" => function($q){
                    $q->with('product','collection');
                }])->paginate(50)->setPath($currentUrl);
                $pined = [];
            }else{
                $pays = Pay::where('back' , '!=' , 4)->latest()->where('pin' , 0)->with('user')->with(["payMeta" => function($q){
                    $q->with('product','collection');
                }])->paginate(50)->setPath($currentUrl);
                $pined = Pay::where('back' , '!=' , 4)->latest()->where('pin' , 1)->with('user')->with(["payMeta" => function($q){
                    $q->with('product','collection');
                }])->get();
            }
        }
        return view('admin.pay.index' , compact('pays','pined','title','delivery'));
    }

    public function returned(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $pp = Product::where("title", "LIKE", "%".$title."%")->pluck('id');
            $pays = PayMeta::where('status',2)->whereIn('product_id' , $pp)->has('product')->has('pay')->with('user')->latest()->paginate(50)->setPath($currentUrl);
        }
        else{
            $pays = PayMeta::where('status',2)->has('product')->has('pay')->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.pay.returned' , compact('pays','title'));
    }

    public function statisticsProduct(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$title;
        if($title){
            $products = Product::where('variety' , 0)->where("title", "LIKE", "%".$title."%")->latest()->paginate(30)->setPath($currentUrl);
        }
        else{
            $products = Product::where('variety' , 0)->latest()->paginate(30)->setPath($currentUrl);
        }
        return view('admin.chart.product' , compact('products','title'));
    }

    public function edit(Pay $pay){
        $pays = Pay::where('id' , $pay->id)->with('address','user')->with(["payMeta" => function($q){
            $q->with('product','collection');
        }])->first();
        $name = Setting::where('key' , 'name')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        $products = Product::select(['title','id'])->latest()->take(500)->get();
        return view('admin.pay.show' , compact('pays','name','products','number'));
    }

    public function update(Pay $pay , Request $request){
        $user = User::where('id' , $pay['user_id'])->first();
        if($request->update == 1){
            Pay::where('id' , $pay->id)->first()->update([
                'status' => $request->status
            ]);
            DB::table('pay_metas')->where('pay_id' , $pay->id)->update(['status' => $request->status]);
            if($request->status == 1){
                $messageCancel = Setting::where('key' , 'messageCancel')->pluck('value')->first();
                if($messageCancel){
                    if($user->number){
                        $this->sendSms($user->number , [$user->name , $pay->property],env('GHASEDAKAPI_Number'),$messageCancel);
                    }
                }
            }
        }
        if($request->update == 2){
            $messageStatus0 = Setting::where('key' , 'messageStatus0')->pluck('value')->first();
            $messageStatus1 = Setting::where('key' , 'messageStatus1')->pluck('value')->first();
            $messageStatus2 = Setting::where('key' , 'messageStatus2')->pluck('value')->first();
            $messageStatus3 = Setting::where('key' , 'messageStatus3')->pluck('value')->first();
            $pay->update([
                'deliver' => $request->deliver
            ]);
            if($request->deliver == 1 && $messageStatus0){
                if($user->number){
                    $this->sendSms($user->number , [$user->name , $pay->property],env('GHASEDAKAPI_Number'),$messageStatus0);
                }
            }
            if($request->deliver == 2 && $messageStatus1){
                if($user->number){
                    $this->sendSms($user->number , [$user->name , $pay->property],env('GHASEDAKAPI_Number'),$messageStatus1);
                }
            }
            if($request->deliver == 3 && $messageStatus2){
                if($user->number){
                    $this->sendSms($user->number , [$user->name , $pay->property],env('GHASEDAKAPI_Number'),$messageStatus2);
                }
            }
            if($request->deliver == 4 && $messageStatus3){
                if($user->number){
                    $this->sendSms($user->number , [$user->name , $pay->property],env('GHASEDAKAPI_Number'),$messageStatus3);
                }
            }
            DB::table('pay_metas')->where('pay_id' , $pay->id)->update(['deliver' => $request->deliver]);
        }
        if($request->update == 3){
            $messageTrack = Setting::where('key' , 'messageTrack')->pluck('value')->first();
            $pay->update([
                'track' => $request->track
            ]);
            if($user->number){
                $this->sendSms($user->number , [$user->name , $request->track],env('GHASEDAKAPI_Number'),$messageTrack);
            }
        }
        if($request->update == 4){
            $messageBack = Setting::where('key' , 'messageBack')->pluck('value')->first();
            if($messageBack){
                $user = User::where('id' , $pay['user_id']);
                if($user->number){
                    $this->sendSms($user->number , [$user->name , $pay->property , $pay->price],'',$messageBack);
                }
            }
            if($request->back == 1){
                $code = Wallet::buildCode();
                Wallet::create([
                    'price'=> $pay->price,
                    'type'=> 0,
                    'status'=> 100,
                    'property'=> $code,
                    'user_id'=> $pay->user_id,
                ]);
            }
            $pay->update([
                'back' => $request->back
            ]);
        }
        if($request->update == 5){
            foreach(json_decode($request->installs) as $item){
                Installments::where('id' , $item->id)->first()->update([
                    'title' => $item->title,
                    'price' => $item->price,
                    'time' => $item->time,
                    'status' => $item->status,
                    'pay' => $item->pay,
                ]);
            }
        }
        if($request->update == 6){
            DB::table('pay_metas')->where('id' , $request->payMeta)->update(['deliver' => $request->deliver]);
        }
        return 'success';
    }

    public function invoice(Pay $pay){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logo = Setting::where('key' , 'logo')->pluck('value')->first();
        $address = Setting::where('key' , 'address')->pluck('value')->first();
        $email = Setting::where('key' , 'email')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        $pays = Pay::with('address')->where('id',$pay->id)->with(["payMeta" => function($q){
            $q->with(["Product" => function($q){
                $q->with('user');
            }]);
        }])->with('user')->first();
        return view('admin.pay.invoice', compact(
            'pays',
            'title',
            'number',
            'email',
            'address',
            'logo',
        ));
    }

    public function print(Pay $pay){
        return view('admin.pay.print', compact(
            'pay',
        ));
    }

    public function create(){
        $users = User::latest()->take(500)->select(['name','id'])->get();
        $products = Product::latest()->take(500)->select(['title','id'])->get();
        return view('admin.pay.create', compact('users','products'));
    }

    public function addPay(Pay $pay , Request $request){
        PayMeta::create([
            'product_id' => $request->productM,
            'color' => $request->colorM,
            'size' => $request->sizeM,
            'count' => $request->countM,
            'guarantee' => $request->guaranteeM,
            'price' => $request->priceM,
            'user_id' => $pay->user_id,
            'status' => $pay->status,
            'pay_id' => $pay->id,
            'deliver' => $pay->deliver,
        ]);
        $pay->update([
            'price' => (int)$pay->price + (int)$request->priceM
        ]);
        return redirect()->back()->with([
            'message' => 'آیتم با موفقیت اضافه شد'
        ]);
    }

    public function group(Request $request){
        $pays = Pay::whereIn('id',explode(',',$request->pay))->get();
        return view('admin.pay.prints',compact('pays'));
    }

    public function createP(Request $request){
        $pay = Pay::create([
            'refId'=>'',
            'status'=>$request->status,
            'tax'=>$request->tax,
            'property'=>$request->property,
            'price'=>$request->price,
            'user_id'=>$request->user_id,
            'method' => $request->methods,
            'deliver' => $request->deliver,
            'track' => $request->track,
            'deposit' => $request->deposit??$request->price,
            'auth' => $request->property,
            'time' => '',
            'carrier'=> $request->carrier,
            'carrier_price'=> $request->carrier_price,
        ]);
        $address = Address::create([
            'name'=> $request->name,
            'address'=> $request->address,
            'post'=> $request->post,
            'state'=> $request->state,
            'city'=> $request->city,
            'plaque'=> $request->plaque,
            'number'=> $request->number,
            'unit'=> $request->unit,
            'status'=> 0,
            'show'=> 0,
        ]);
        $pay->address()->attach($address->id);
        foreach (json_decode($request->metas) as $item){
            $payMeta = PayMeta::create([
                'product_id' => $item->product,
                'collect_id' => 0,
                'user_id'=>$request->user_id,
                'pay_id' => $pay->id,
                'prebuy' => 0,
                'discount_off'=> $request->discount_off,
                'status'=>$request->status,
                'price'=> $item->price,
                'count' => $item->count,
                'color' => $item->color,
                'size' => $item->size,
                'guarantee_name'=> $item->guarantee
            ]);
            $payMeta->address()->attach($address->id);
        }
        return 'success';
    }

    public function chart(Request $request){
        $date = $request->date;
        if($date == 0){
            $startDayEn = verta()->startDay()->formatGregorian('Y-m-d H:i:s');
            $endDayEn = verta()->endDay()->formatGregorian('Y-m-d H:i:s');
        }
        elseif($date == 1){
            $startDayEn = verta()->subDay(1)->startDay()->formatGregorian('Y-m-d H:i:s');
            $endDayEn = verta()->subDay(1)->endDay()->formatGregorian('Y-m-d H:i:s');
        }
        elseif($date == 2){
            $startDayEn = verta()->startWeek()->formatGregorian('Y-m-d H:i:s');
            $endDayEn = verta()->endWeek()->formatGregorian('Y-m-d H:i:s');
        }elseif($date == 3){
            $startDayEn = verta()->startMonth()->formatGregorian('Y-m-d H:i:s');
            $endDayEn = verta()->endMonth()->formatGregorian('Y-m-d H:i:s');
        }else{
            $startDayEn = verta()->startYear()->formatGregorian('Y-m-d H:i:s');
            $endDayEn = verta()->endYear()->formatGregorian('Y-m-d H:i:s');
        }
        $pay1 = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->whereNotIn('status' , [0,2,1])->count();
        $user1 = User::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $comment1 = Comment::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $income1 = Pay::whereBetween('created_at', [$startDayEn, $endDayEn])->whereNotIn('status' , [0,2,1])->pluck('price')->sum();
        $tickets1 = Ticket::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $counselings1 = Counseling::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $loan1 = Loan::whereBetween('created_at', [$startDayEn, $endDayEn])->count();
        $views1 = View::whereBetween('created_at', [$startDayEn, $endDayEn])->count();

        $tops = Product::withCount(["payMeta" => function($q){
            $q->latest()->whereNotIn('status',[0,1]);
        }])->withCount(["payMeta as payMeta2" => function($q) use($startDayEn, $endDayEn){
            $q->latest()->whereBetween('created_at', [$startDayEn, $endDayEn])->whereNotIn('status',[0,1,2]);
        }])->orderBy('payMeta2','DESC' )->take(3)->get();

        $views = Product::withCount('view')->withCount(["view as view2" => function($q) use($startDayEn, $endDayEn){
            $q->latest()->whereBetween('created_at', [$startDayEn, $endDayEn]);
        }])->orderBy('view2','DESC' )->take(3)->get();

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

        $deyPrice = Pay::whereBetween('created_at', [$dey, $bahman])->where('status' , 100)->pluck('price')->sum();
        $bahmanPrice = Pay::whereBetween('created_at', [$bahman, $esfand])->where('status' , 100)->pluck('price')->sum();
        $esfandPrice = Pay::whereBetween('created_at', [$esfand, $farvardin])->where('status' , 100)->pluck('price')->sum();
        $farvardinPrice = Pay::whereBetween('created_at', [$farvardin, $ordibehesht])->where('status' , 100)->pluck('price')->sum();
        $ordibeheshtPrice = Pay::whereBetween('created_at', [$ordibehesht, $khordad])->where('status' , 100)->pluck('price')->sum();
        $khordadPrice = Pay::whereBetween('created_at', [$khordad, $tir])->where('status' , 100)->pluck('price')->sum();
        $tirPrice = Pay::whereBetween('created_at', [$tir, $mordad])->where('status' , 100)->pluck('price')->sum();
        $mordadPrice = Pay::whereBetween('created_at', [$mordad, $shahrivar])->where('status' , 100)->pluck('price')->sum();
        $shahrivarPrice = Pay::whereBetween('created_at', [$shahrivar, $mehr])->where('status' , 100)->pluck('price')->sum();
        $mehrPrice = Pay::whereBetween('created_at', [$mehr, $aban])->where('status' , 100)->pluck('price')->sum();
        $abanPrice = Pay::whereBetween('created_at', [$aban, $azar])->where('status' , 100)->pluck('price')->sum();
        $azarPrice = Pay::whereBetween('created_at', [$azar, $dey])->where('status' , 100)->pluck('price')->sum();

        $deyUser = User::whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanUser = User::whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandUser = User::whereBetween('created_at', [$esfand, $farvardin])->count();
        $farvardinUser = User::whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtUser = User::whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadUser = User::whereBetween('created_at', [$khordad, $tir])->count();
        $tirUser = User::whereBetween('created_at', [$tir, $mordad])->count();
        $mordadUser = User::whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarUser = User::whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrUser = User::whereBetween('created_at', [$mehr, $aban])->count();
        $abanUser = User::whereBetween('created_at', [$aban, $azar])->count();
        $azarUser = User::whereBetween('created_at', [$azar, $dey])->count();

        $deyPay = Pay::whereBetween('created_at', [$dey, $bahman])->whereNotIn('status' , [0,2,1])->count();
        $bahmanPay = Pay::whereBetween('created_at', [$bahman, $esfand])->whereNotIn('status' , [0,2,1])->count();
        $esfandPay = Pay::whereBetween('created_at', [$esfand, $farvardin])->whereNotIn('status' , [0,2,1])->count();
        $farvardinPay = Pay::whereBetween('created_at', [$farvardin, $ordibehesht])->whereNotIn('status' , [0,2,1])->count();
        $ordibeheshtPay = Pay::whereBetween('created_at', [$ordibehesht, $khordad])->whereNotIn('status' , [0,2,1])->count();
        $khordadPay = Pay::whereBetween('created_at', [$khordad, $tir])->whereNotIn('status' , [0,2,1])->count();
        $tirPay = Pay::whereBetween('created_at', [$tir, $mordad])->whereNotIn('status' , [0,2,1])->count();
        $mordadPay = Pay::whereBetween('created_at', [$mordad, $shahrivar])->whereNotIn('status' , [0,2,1])->count();
        $shahrivarPay = Pay::whereBetween('created_at', [$shahrivar, $mehr])->whereNotIn('status' , [0,2,1])->count();
        $mehrPay = Pay::whereBetween('created_at', [$mehr, $aban])->whereNotIn('status' , [0,2,1])->count();
        $abanPay = Pay::whereBetween('created_at', [$aban, $azar])->whereNotIn('status' , [0,2,1])->count();
        $azarPay = Pay::whereBetween('created_at', [$azar, $dey])->whereNotIn('status' , [0,2,1])->count();

        return view('admin.chart.index', compact(
            'pay1',
            'user1',
            'date',
            'comment1',
            'income1',
            'deyPrice',
            'tickets1',
            'counselings1',
            'loan1',
            'views1',
            'views',
            'bahmanPrice',
            'esfandPrice',
            'farvardinPrice',
            'ordibeheshtPrice',
            'khordadPrice',
            'tirPrice',
            'tops',
            'mordadPrice',
            'shahrivarPrice',
            'mehrPrice',
            'abanPrice',
            'azarPrice',
            'deyUser',
            'bahmanUser',
            'esfandUser',
            'farvardinUser',
            'ordibeheshtUser',
            'khordadUser',
            'tirUser',
            'mordadUser',
            'shahrivarUser',
            'mehrUser',
            'abanUser',
            'azarUser',
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
        ));
    }

    public function delete(Pay $pay){
        $pay->address()->detach();
        DB::table('pay_metas')->where('pay_id', $pay->id)->delete();
        $pay->lotteryCode()->delete();
        $pay->installments()->delete();
        $pay->delete();
        return redirect()->back()->with([
            'message' => 'سفارش با موفقیت حذف شد'
        ]);
    }

    public function deleteMeta(PayMeta $payMeta){
        $payMeta->update([
            'cancel' => $payMeta->cancel ? 0 : 1
        ]);
        if($payMeta->cancel == 0){
            $payMeta->pay()->update([
                'price' => (int)$payMeta->pay()->pluck('price')->first() + (int)$payMeta->price
            ]);
        }else{
            $payMeta->pay()->update([
                'price' => (int)$payMeta->pay()->pluck('price')->first() - (int)$payMeta->price
            ]);
        }
        return redirect()->back()->with([
            'message' => 'آیتم با موفقیت لغو شد'
        ]);
    }
}
