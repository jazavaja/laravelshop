<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceProduct;
use App\Imports\ProductImport;
use App\Models\Address;
use App\Models\Ask;
use PHPHtmlParser\Dom;
use App\Models\Brand;
use App\Models\Carrier;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Counseling;
use App\Models\Discount;
use App\Models\Gallery;
use App\Models\Gift;
use App\Models\Land;
use App\Models\Loan;
use App\Models\Lucky;
use App\Models\News;
use App\Models\Page;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Score;
use App\Models\Setting;
use App\Models\Story;
use App\Models\Subscribe;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Widget;
use App\Traits\SendSmsTrait;
use App\Traits\SeoHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;
use PHPHtmlParser\Options;

class IndexController extends Controller
{
    use SeoHelper;
    use SendSmsTrait;
    public function index(Request $request){
        $this->setIndexSeo();
        $title1 = Setting::where('key' , 'title')->pluck('value')->first();
        $Agent = new Agent();
        $widgets = Widget::where('status', 1)
            ->where('language', request()->cookie('language') ?? 'fa')
            ->when($Agent->isMobile(), function ($query) {
                return $query->where('responsive', 1);
            }, function ($query) {
                return $query->where('responsive', 0);
            })
            ->orderBy('number')
            ->get();

        Story::where('expire' , '<=' , Carbon::now()->timestamp)->delete();
        $widget = [];
        foreach ($widgets as $item){
            $widgetCategory = [
                'name'=> $item['name'],
                'title'=> $item['title'],
                'more'=> $item['more'],
                'description'=> $item['description'],
                'background'=> $item['background'],
                'slug'=> $item['slug'],
                'background2'=> $item['background2'],
                'count'=> $item['count'],
                'sort'=> $item['sort'],
                'type'=> $item['type'],
                'brands'=> $item['brands'],
                'move'=> $item['move'],
                'height'=> $item['height'],
                'cats'=> $item['cats'],
                'ads1'=> $item['ads1'],
                'ads2'=> $item['ads2'],
                'ads3'=> $item['ads3'],
                'post'=> [],
            ];
            if($item['name'] != 'تبلیغ اسلایدری' && $item['name'] != 'مقایسه' && $item['name'] != 'جستجو' && $item['name'] != 'متن' && $item['name'] != 'سوال متداول' && $item['name'] != 'جستجو2' && $item['name'] != 'جشنواره' && $item['name'] != 'گردونه دسته بندی' && $item['name'] != 'اسلایدر بزرگ' && $item['name'] != 'بهترین ها' && $item['name'] != 'تبلیغ ساده' && $item['name'] != 'فروشندگان' && $item['name'] != 'خبر'  && $item['name'] != 'دسته بندی'){
                $ids = [];
                $ids2 = [];
                if($item['cats'] != '[]'){
                    $catIds = json_decode($item['cats'], true);
                    $ids = Category::whereIn('id', $catIds)
                        ->where('language', request()->cookie('language') ?? 'fa')
                        ->with('product:id')
                        ->get()
                        ->pluck('product.*.id')
                        ->flatten()
                        ->toArray();
                }
                if($item['brands'] != '[]'){
                    $catIds = json_decode($item['brands'], true);
                    $ids = Brand::whereIn('id', $catIds)
                        ->where('language', request()->cookie('language') ?? 'fa')
                        ->with('product:id')
                        ->get()
                        ->pluck('product.*.id')
                        ->flatten()
                        ->toArray();
                }
                if($item['brands'] != '[]' && $item['cats'] != '[]'){
                    $arrayFilter = array_intersect($ids2, $ids);
                }
                else{
                    if($item['brands'] != '[]'){
                        $arrayFilter = $ids2;
                    }elseif($item['cats'] != '[]'){
                        $arrayFilter = $ids;
                    }else{
                        $arrayFilter = Product::latest()->where('variety', 0)->where('language' , request()->cookie('language')??'fa')->pluck('id')->take($item['count'])->toArray();
                    }
                }
                $commonQuery = Product::whereIn('id', $arrayFilter)
                    ->where('status', 1)
                    ->where('language', request()->cookie('language') ?? 'fa')
                    ->where('variety', 0)
                    ->where('state', $request->state)
                    ->where('city', $request->city)
                    ->take($item['count']);

                switch ($item['sort']) {
                    case 0:
                        $catPost1 = $commonQuery->latest()
                            ->when($item['type'] == 0, function ($query) {
                                return $query->where('count', '>=', 1);
                            })
                            ->when($item['type'] == 1, function ($query) {
                                return $query->where('off', '!=', '');
                            })
                            ->when($item['type'] == 2, function ($query) {
                                return $query->where('suggest', '!=', '');
                            })
                            ->get(['id','off','price','image','count','slug','minCart','maxCart','offPrice','imageAlt','colors','lotteryStatus','title','inquiry','ability','short']);
                        break;

                    case 1:
                    case 2:
                        $catPost1 = $commonQuery
                            ->when($item['type'] == 0, function ($query) {
                                return $query->where('count', '>=', 1);
                            })
                            ->when($item['type'] == 1, function ($query) {
                                return $query->where('off', '!=', '');
                            })
                            ->when($item['type'] == 2, function ($query) {
                                return $query->where('suggest', '!=', '');
                            })
                            ->withCount('view')
                            ->orderBy('view_count', 'DESC')
                            ->get(['id','off','price','image','count','slug','minCart','maxCart','offPrice','imageAlt','colors','lotteryStatus','title','inquiry','ability','short']);
                        break;

                    case 3:
                        $catPost1 = $commonQuery->orderBy('price')->get(['id','off','price','image','count','slug','minCart','maxCart','offPrice','imageAlt','colors','lotteryStatus','title','inquiry','ability','short']);
                        break;

                    case 4:
                        $catPost1 = $commonQuery->orderBy('price', 'DESC')->get(['id','off','price','image','count','slug','minCart','maxCart','offPrice','imageAlt','colors','lotteryStatus','title','inquiry','ability','short']);
                        break;

                    case 5:
                        $catPost1 = $commonQuery
                            ->when($item['type'] == 0, function ($query) {
                                return $query->where('count', '>=', 1);
                            })
                            ->when($item['type'] == 1, function ($query) {
                                return $query->where('off', '!=', '');
                            })
                            ->when($item['type'] == 2, function ($query) {
                                return $query->where('suggest', '!=', '');
                            })
                            ->withCount('payMeta')
                            ->orderBy('pay_meta_count', 'DESC')
                            ->get(['id','off','price','image','count','slug','minCart','maxCart','offPrice','imageAlt','colors','lotteryStatus','title','inquiry','ability','short']);
                        break;
                }

                $catPost = ResourceProduct::collection($catPost1);
                $widgetCategory['post'] = $catPost;
            }
            if($item['name'] == 'دسته بندی'){
                $cat0 = str_replace('"', '', $item['cats']);
                $cat1 = str_replace('[', '', $cat0);
                $cat2 = str_replace(']', '', $cat1);
                $allCatSite3 = explode(',' , $cat2);
                foreach ($allCatSite3 as $value){
                    $tax = Category::where('id' , $value)->where('language' , request()->cookie('language')??'fa')->first();
                    if($tax){
                        $categoryPost = [
                            'title'=> $tax['name'],
                            'slug'=> $tax['slug'],
                            'product'=> [],
                        ];
                        $categoryPost['product'] = $tax->product()->where('language' , request()->cookie('language')??'fa')->select(['slug','image','titleSeo','title'])->take(4)->get();
                        array_push($widgetCategory['post'],$categoryPost);
                    }
                }
            }
            if($item['name'] == 'گردونه دسته بندی'){
                $cat0 = str_replace('"', '', $item['cats']);
                $cat1 = str_replace('[', '', $cat0);
                $cat2 = str_replace(']', '', $cat1);
                $allCatSite3 = explode(',' , $cat2);
                $widgetCategory['cats'] = [];
                foreach ($allCatSite3 as $value){
                    $tax = Category::where('id' , $value)->where('language' , request()->cookie('language')??'fa')->first();
                    if($tax){
                        $categoryPost = [
                            'name'=> $tax['name'],
                            'product'=> [],
                        ];
                        $categoryPost['product'] = $tax->product()->where('count' , '>=' , 1)->where('status' , 1)->where('variety' , 0)->where('language' , request()->cookie('language')??'fa')->where('state' , $request->state)->where('city' , $request->city)->take(4)->get();
                        array_push($widgetCategory['post'],$categoryPost);
                        array_push($widgetCategory['cats'],$tax);
                    }
                }
            }
            if($item['name'] == 'خبر'){
                $widgetCategory['post'] = News::latest()->take(8)->where('language' , request()->cookie('language')??'fa')->select(['title' , 'slug' , 'imageAlt' , 'bodySeo' , 'image'])->get();
            }
            if($item['name'] == 'استوری'){
                $widgetCategory['post'] = Story::get();
            }
            if($item['name'] == 'پک محصولات'){
                $collect = Collection::latest()->where('language' , request()->cookie('language')??'fa')->take(7)->get();
                $packs = [];
                foreach ($collect as $pack){
                    $packItem = [
                        'title'=> $pack['title'],
                        'price'=> $pack['price'],
                        'slug'=> $pack['slug'],
                        'off'=> $pack['off'],
                        'titleSeo'=> $pack['titleSeo'],
                        'imageAlt'=> $pack['imageAlt'],
                        'offPrice'=> $pack['offPrice'],
                        'product'=> $pack->product()->take(2)->get(),
                    ];
                    array_push($packs , $packItem);
                }
                $widgetCategory['post'] = $packs;
            }
            if($item['name'] == 'بهترین ها'){
                if ($item['sort'] == 0){
                    $catPost1 = Product::where('language' , request()->cookie('language')??'fa')->latest()->where('status' , 1)->where('count' , '>=' , 1)->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->take(18)->get();
                }
                if ($item['sort'] == 1 or $item['sort'] == 2){
                    $catPost1 = Product::where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('count' , '>=' , 1)->withCount('view')->orderBy('view_count','DESC' )->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->take(18)->get();
                }
                if ($item['sort'] == 3){
                    $catPost1 = Product::where('language' , request()->cookie('language')??'fa')->where('count' , '>=' , 1)->orderBy('price')->where('status' , 1)->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->take(18)->get();
                }
                if ($item['sort'] == 4){
                    $catPost1 = Product::where('language' , request()->cookie('language')??'fa')->where('count' , '>=' , 1)->orderBy('price','DESC')->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->take(18)->get();
                }
                if ($item['sort'] == 5){
                    $catPost1 = Product::where('language' , request()->cookie('language')??'fa')->where('count' , '>=' , 1)->withCount('payMeta')->orderBy('pay_meta_count','DESC' )->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->take(18)->get();
                }
                $catPost = ResourceProduct::collection($catPost1);
                $widgetCategory['post'] = $catPost;
            }
            array_push($widget , $widgetCategory);
        }
        $popUpStatus = Setting::where('key' , 'popUpStatus')->pluck('value')->first();
        if(empty($_COOKIE['popUp']) && $popUpStatus == 1){
            $popUp = 1;
        }else{
            $popUp = 0;
        }
        $imagePopUp = Setting::where('key' , 'imagePopUp')->pluck('value')->first();
        $titlePopUp = Setting::where('key' , 'titlePopUp')->pluck('value')->first();
        $addressPopUp = Setting::where('key' , 'addressPopUp')->pluck('value')->first();
        $descriptionPopUp = Setting::where('key' , 'descriptionPopUp')->pluck('value')->first();
        $buttonPopUp = Setting::where('key' , 'buttonPopUp')->pluck('value')->first();
        $profitLoan = Setting::where('key' , 'profitLoan')->pluck('value')->first();
        $maxPriceLoan = Setting::where('key' , 'maxPriceLoan')->pluck('value')->first();
        $maxMonthLoan = Setting::where('key' , 'maxMonthLoan')->pluck('value')->first();
        $sellers = User::permission('فروشنده')->withCount('category')->withCount(['product' => function ($q) {
            $q->where('status' , 1);
        }])->latest()->get();
        $moment = Product::inRandomOrder()->where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('variety' , 0)->where('state' , $request->state)->where('city' , $request->city)->where('count' , '>=' , 1)->select(['title','price','slug','image'])->where('off' , null)->take(20)->get();
        $brandIndex = Brand::latest()->take(20)->where('language' , request()->cookie('language')??'fa')->select(['name' ,'id'])->get();
        $catsIndex = Category::latest()->take(20)->where('language' , request()->cookie('language')??'fa')->select(['name' ,'id'])->get();
        $storySeen = Cookie::get('story');
        if(empty($storySeen)){
            $storySeen = [];
        }else{
            $storySeen = explode(',',$storySeen);
        }
        return view('home.index.index' , compact('widget','moment','maxPriceLoan','maxMonthLoan','profitLoan','storySeen','brandIndex','catsIndex','imagePopUp','sellers','descriptionPopUp','buttonPopUp','titlePopUp','addressPopUp','popUpStatus','popUp','title1'));
    }

    public function offline(){
        return view('vendor.laravelpwa.offline');
    }

    public function direct(){
        $zarinpalStatus = Setting::where('key' , 'zarinpalStatus')->pluck('value')->first();
        $zibalStatus = Setting::where('key' , 'zibalStatus')->pluck('value')->first();
        $nextpayStatus = Setting::where('key' , 'nextpayStatus')->pluck('value')->first();
        $idpayStatus = Setting::where('key' , 'idpayStatus')->pluck('value')->first();
        $statusBeh = Setting::where('key' , 'statusBeh')->pluck('value')->first();
        $statusSadad = Setting::where('key' , 'statusSadad')->pluck('value')->first();
        $statusAsan = Setting::where('key' , 'statusAsan')->pluck('value')->first();
        $statusPasargad = Setting::where('key' , 'statusPasargad')->pluck('value')->first();
        return view('home.order.payment',compact('zarinpalStatus','zibalStatus','nextpayStatus','idpayStatus','statusBeh','statusSadad','statusAsan','statusPasargad'));
    }

    public function lucky(){
        if (auth()->user()){
            $maxGift = Setting::where('key' , 'maxGift')->pluck('value')->first()??7;
            $gifts = Gift::whereDate('created_at','>=',Carbon::today()->addDay(-$maxGift))->whereDate('created_at','<=',Carbon::today())->where('user_id' , Auth::id())->first();
            if($gifts){
                $shareText = __('messages.max_gif',['max' => $maxGift]);
            }else{
                $shareText = '';
            }
        }else{
            $shareText = __('messages.max_gif2');
        }
        return view('home.lucky.index',compact('shareText'));
    }
    public function luckyStore(Request $request){
        $luck = Lucky::where('id' , $request->prize)->first();
        Gift::create([
            'user_id' => auth()->user()->id,
            'type' => 1,
            'discount' => $luck->value
        ]);
        if($luck->type == 0){
            $day = Carbon::now()->addDay(1)->format('Y-m-d h:i:s');
            $dis = Discount::create([
                'title'=> 'گردونه شانس',
                'code'=> 'gift-'.time(),
                'day'=> $day,
                'percent'=> $luck->value,
                'status'=> 1,
                'count'=> 1,
                'user_id'=> auth()->user()->id,
            ]);
            return __('messages.dis_gif' , ['val' => $dis->code]);
        }
        if($luck->type == 1){
            Score::create([
                'name'=>$luck->value,
                'user_id'=>auth()->user()->id,
            ]);
            return __('messages.dis_gif2');
        }
        if($luck->type == 2){
            return __('messages.dis_gif3');
        }
        if($luck->type == 3){
            $code = Wallet::buildCode();
            Wallet::create([
                'refId' => 'گردونه شانس',
                'price'=> $luck->value,
                'type'=> 0,
                'status'=> 100,
                'property'=> $code,
                'user_id'=> auth()->user()->id,
            ]);
            return __('messages.dis_gif4');
        }
        return 'success';
    }

    public function landing(Land $land){
        return view('home.land.index',compact('land'));
    }

    public function faq(){
        $asks = Ask::where('language' , request()->cookie('language')??'fa')->get();
        return view('home.faq.index',compact('asks'));
    }

    public function orderTracking(){
        return view('home.order.tracking');
    }

    public function changeLang(Request $request){
        $response = new Response('success');
        return $response->withCookie(cookie('languages', 'en'));
    }

    public function sendSub(Request $request){
        $sub = Subscribe::where('name' , $request->name)->first();
        if(!$sub){
            Subscribe::create([
                'name' => $request->name
            ]);
            return 'ok';
        }else{
            return 'exist';
        }
    }

    public function loanRecord(Request $request){
        $request->validate([
            'month' => 'required',
            'amount' => 'required|min:2',
        ]);
        if(!auth()->user()){
            return 'noUser';
        }
        $loan = Loan::where('user_id',auth()->user()->id)->first();
        if($loan){
            return 'loan';
        }
        $profitLoan = Setting::where('key' , 'profitLoan')->pluck('value')->first();
        $allProfit = $request->month * $profitLoan;
        $priceProfit = ($request->amount * $allProfit) / 100;
        $monthProfit = round(((int)$priceProfit + (int)$request->amount) / $request->month);
        $refund = (int)$priceProfit + $request->amount;
        Loan::create([
            'amount' => $request->amount,
            'refund' => $refund,
            'monthProfit' => $monthProfit,
            'percent' => $allProfit,
            'month' => $request->month,
            'user_id' => auth()->user()->id,
            'status' => 1,
        ]);
        return 'success';
    }

    public function getOrder(Request $request){
        $pay = Pay::where('property',$request->property)->get();
        if(count($pay) >= 1){
            $address= $pay[0]->address()->where('number' , $request->number)->first();
            if(!$address){
                return 'no';
            }
            return $pay[0];
        }else{
            return 'no';
        }
    }

    public function showPayFast(Request $request){
        $pay = Pay::where('property',$request->property)->first();
        $address= $pay->address()->where('number' , $request->number)->first();
        if(!$address){
            return 'no';
        }
        $pays = Pay::where('id' , $pay->id)->with('address','user','installments')->with(["payMeta" => function($q){
            $q->with('product');
        }])->first();
        $name = Setting::where('key' , 'name')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        return view('home.order.show' , compact('pays','name','number'));
    }

    public function sendTicket(Request $request){
        if(!auth()->user()){
            return redirect()->back()->with([
                'message' => __('messages.login_first')
            ]);
        }
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'type' => 'required',
        ]);
        Ticket::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'type'=>$request->type,
            'user_id'=>auth()->user()->id,
        ]);
        return redirect()->back()->with([
            'success' => __('messages.show_ticket1')
        ]);
    }

    public function page(Page $page){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logo = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $map = Setting::where('key' , 'map')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo(   $page->titleSeo . " - $title " , $page->bodySeo , 'store' , 'page/'."$page->slug" , $logo , $page->keyword);
        return view('home.page.index' , compact('page'));
    }

    public function quickBuy(Request $request){
        $products = Product::where('id' , $request->product)->with('guarantee' , 'time')->first();
        $carriers = Carrier::latest()->get();
        return [$products,$carriers];
    }

    public function checkQuickBuy(Request $request){
        if (Setting::where('key' , 'captchaStatus')->pluck('value')->first()){
            $request->validate([
                'carrier' => 'required',
                'count' => 'required',
                'number' => 'required|max:12',
                'address' => 'required',
                'captcha' => ['required', 'captcha'],
            ]);
        }else{
            $request->validate([
                'carrier' => 'required',
                'count' => 'required',
                'number' => 'required|max:12',
                'address' => 'required',
            ]);
        }

        if($request->number[0] != 0 || $request->number[1] != 9){
            return 'number';
        }

        $post = Product::where('id' , $request->product)->first();
        if($request->color){
            foreach(json_decode($post['colors']) as $color){
                if($color->name == $request->color){
                    if($color->count < $request->count){
                        return 'color';
                    }
                }
            }
        }
        if($request->size){
            foreach(json_decode($post['size']) as $size){
                if($size->name == $request->size){
                    if($size->count < $request->count){
                        return 'size';
                    }
                }
            }
        }
        if($post['count'] < $request->count){
            return 'count';
        }

        if(auth()->user()){
            $user2 = User::where('id' , auth()->user()->id)->first();
            $user = $user2['id'];
        }else{
            $user2 = User::where('number' , $request->number)->first();
            if($user2){
                $user = $user2['id'];
            }else{
                $code = User::buildCode();
                $user2 = User::create([
                    'name' => time(),
                    'password' => Hash::make(rand(100000, 900000)),
                    'referral'=> $code,
                    'parent_id'=> 0,
                    'number' => $request->number
                ]);
                $user = $user2['id'];
            }
        }
        $address = Address::create([
            'name'=> $request->number,
            'address'=> $request->address,
            'post'=> '',
            'state'=> '',
            'city'=> '',
            'user_id'=> $user,
            'plaque'=> '',
            'number'=> $request->number,
            'unit'=> '',
            'status'=> 1,
            'show'=> 0,
        ]);
        $data = [
            'product' => $request->product,
            'address' => $address['id'],
            'size' => $request->size,
            'color' => $request->color,
            'guarantee' => $request->guarantee,
            'number' => $request->number,
            'user' => $user,
            'carrier' => $request->carrier,
            'count' => $request->count,
        ];
        $response = new Response('success');
        return $response->withCookie(cookie('quickBuy', json_encode($data), 500));
    }

    public function sendCounseling(Request $request){
        if (Setting::where('key' , 'captchaStatus')->pluck('value')->first()){
            $request->validate([
                'number' => 'required|max:12',
                'body' => 'required',
                'captcha' => ['required', 'captcha'],
            ]);
        }else{
            $request->validate([
                'number' => 'required|max:12',
                'body' => 'required',
            ]);
        }

        if(auth()->user()){
            $user2 = User::where('id' , auth()->user()->id)->first();
            $user = $user2['id'];
        }else{
            $user2 = User::where('number' , $request->number)->first();
            if($user2){
                $user = $user2['id'];
            }else{
                $code = User::buildCode();
                $user2 = User::create([
                    'name' => time(),
                    'password' => Hash::make(rand(100000, 900000)),
                    'referral'=> $code,
                    'parent_id'=> 0,
                    'number' => $request->number
                ]);
                $user = $user2['id'];
            }
        }
        $product = Product::where('id' , $request->product)->first();
        $messageCounseling = Setting::where('key' , 'messageCounseling')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        if($messageCounseling){
            $this->sendSms($number , [$user2->number , $product->title],env('GHASEDAKAPI_Number'),$messageCounseling);
        }
        Counseling::create([
            'body'=> $request->body,
            'user_id'=> $user,
            'product_id'=> $request->product,
            'number'=> $request->number,
        ]);
        return 'success';
    }

    public function search(Request $request){
        $searches = [];
        $searchEx = explode(' ',$request->search);
        foreach ($searchEx as $search){
            if($request->categorySearch){
                $cats = Category::where('id' , $request->categorySearch)->first();
                if($cats){
                    $products = $cats->product()->where(function ($query) use ($search){
                        $query->where("title", "LIKE", "%".$search."%")
                            ->orWhere("product_id", "LIKE", "%".$search."%");
                    })->where('variety' , 0)->where('status' , 1)->pluck('id');
                    foreach ($products as $product){
                        array_push($searches , $product);
                    }
                }
            }else{
                $products = Product::where(function ($query) use ($search){
                    $query->where("title", "LIKE", "%".$search."%")
                        ->orWhere("product_id", "LIKE", "%".$search."%");
                })->where('variety' , 0)->where('status' , 1)->pluck('id');
                foreach ($products as $product){
                    array_push($searches , $product);
                }
            }
        }
        $arr = [];
        foreach(array_count_values($searches) as $key=>$item){
            if($item == count($searchEx)){
                array_push($arr , $key);
            }
        }
        return Product::whereIn('id' , $arr)->select(['id' ,'title','slug','image','price','product_id'])->get();
    }

    public function searchAdvance(Request $request){
        $checks = 0;
        $arrayFilter = [];
        if ($request->search){
            $search1 = $request->search;
            $searchId = Product::latest()->where(function ($query) use($search1) {
                $query->where("title" , "LIKE" , "%{$search1}%")
                    ->orWhere('product_id', $search1);
            })->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($searchId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $searchId;
            }
        }

        if ($request->suggest){
            $suggestId = Product::where('suggest' , '!=' , '')->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($suggestId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $suggestId;
            }
        }

        if ($request->count){
            $countId = Product::where('count' , '!=' , '0')->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($countId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $countId;
            }
        }

        if ($request->off){
            $offId = Product::where('off' , '>=' , '1')->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($offId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $offId;
            }
        }

        if ($request->lottery){
            $lotteryId = Product::where('lotteryStatus' , 1)->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($lotteryId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $lotteryId;
            }
        }

        if ($request->state){
            $stateId = Product::where('state' , $request->state)->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($stateId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $stateId;
            }
        }

        if ($request->quick){
            $quickId = Product::where('inquiry' , 0)->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($quickId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $quickId;
            }
        }

        if ($request->brand){
            $brand = Brand::where('id' , $request->brand)->first();
            $brandId = $brand->product()->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($brandId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $brandId;
            }
        }

        if ($request->category){
            $category = Category::where('id' , $request->category)->first();
            $categoryId = $category->product()->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
            if($checks == 1) {
                $arrayFilter = array_intersect($categoryId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $categoryId;
            }
        }

        if ($request->show == 0){
            $catPost = Product::latest()->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->take(12)->get();
        }
        if ($request->show == 2){
            $catPost = Product::withCount('payMeta')->orderBy('pay_meta_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->take(12)->get();
        }
        if ($request->show == 1 or $request->show == 3){
            $catPost = Product::withCount('view')->orderBy('view_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->take(12)->get();
        }
        if ($request->show == 4){
            $catPost = Product::orderBy('price')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->take(12)->get();
        }
        if ($request->show == 5){
            $catPost = Product::orderBy('price','DESC')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->take(12)->get();
        }

        return $catPost;
    }

    public function helpSearch(Request $request){
        $arrayFilter = [];

        if (count(json_decode($request->brandFast)) >= 1){
            $brandId = Brand::whereIn('id' , json_decode($request->brandFast))->pluck('id');
            $brandIds =  Product::whereHas('brand', function ($q) use($brandId){
                return $q->whereIn('id', $brandId);
            })->where('variety' , 0)->where('status' , 1)->take(80)->pluck('id')->toArray();
            foreach ($brandIds as $item){
                array_push($arrayFilter , $item);
            }
        }

        if (count(json_decode($request->catFast)) >= 1){
            $catId = Category::whereIn('id' , json_decode($request->catFast))->pluck('id');
            $categoryId =  Product::whereHas('category', function ($q) use($catId){
                return $q->whereIn('id', $catId);
            })->where('variety' , 0)->where('status' , 1)->take(80)->pluck('id')->toArray();
            foreach ($categoryId as $item){
                array_push($arrayFilter , $item);
            }
        }
        if ($request->show == 0){
            $catPost = Product::latest()->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 1){
            $catPost = Product::orderBy('price')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 2){
            $catPost = Product::orderBy('price','DESC')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 3){
            $catPost = Product::withCount('payMeta')->orderBy('pay_meta_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 4){
            $catPost = Product::withCount('view')->orderBy('view_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 5){
            $catPost = Product::orderBy('off','DESC')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }elseif ($request->show == 6){
            $catPost = Product::where('suggest' , '!=' , '')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }else{
            $catPost = Product::where('count' , '!=' , '0')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                $q->select(DB::raw('round(avg(rate),1)'));
            }])->withCount(["payMeta" => function ($q) {
                $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
            }])->whereIn('id' , $arrayFilter)->distinct('id')->take(12)->get();
        }

        return $catPost;
    }

    public function gift(){
        $empty2 = __('messages.empty1');
        if (auth()->user()){
            $gifts = Gift::whereDate('created_at','>=',Carbon::today()->addDay(-7))->whereDate('created_at','<=',Carbon::today())->where('user_id' , Auth::id())->first();
            if($gifts){
                $shareText = __('messages.gif_limit');
                $giftDiscounts = [
                    [$empty2, ''],
                    [$empty2, ''],
                    [$empty2, ''],
                    [$empty2, ''],
                    [$empty2, ''],
                ];
            }else{
                $giftDis = Setting::where('key' , 'giftDis')->pluck('value')->first();
                $shareText = '';
                $disNum = mt_rand(1, $giftDis);
                $giftDiscounts = [
                    [$disNum.'%', ''],
                    [$empty2, ''],
                    [$empty2, ''],
                    [$empty2, ''],
                    [$empty2, ''],
                ];
            }
        }else{
            $shareText = __('messages.gif_limit2');
            $giftDiscounts = [
                [$empty2, ''],
                [$empty2, ''],
                [$empty2, ''],
                [$empty2, ''],
                [$empty2, ''],
            ];
        }
        return view('home.gift.giftIndex',compact('giftDiscounts','shareText'));
    }
    public function getGift(Request $request){
        Gift::create([
            'user_id' => auth()->user()->id,
            'discount' => $request->discount?str_replace('%', '', $request->discount):0
        ]);
        if($request->discount){
            $day = Carbon::now()->addDay(1)->format('Y-m-d h:i:s');
            $dis = Discount::create([
                'title'=> 'جعبه جادویی شانس',
                'code'=> 'gift-'.time(),
                'day'=> $day,
                'percent'=> str_replace('%', '', $request->discount),
                'status'=> 1,
                'count'=> 1,
                'user_id'=> auth()->user()->id,
            ]);
            return $dis->code;
        }
    }
}
