<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Field;
use App\Models\FieldData;
use App\Models\Gallery;
use App\Models\Guarantee;
use App\Models\PriceChange;
use App\Models\Product;
use App\Models\Report;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Tank;
use App\Models\Time;
use App\Models\User;
use App\Models\Video;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use PHPHtmlParser\Dom;
use Spatie\Permission\Models\Role;

class PostController extends Controller
{
    use SendSmsTrait;
    protected static function requestTranslation($source, $target, $text) {
        $url = "https://translate.google.com/translate_a/single?client=at&dt=t&dt=ld&dt=qca&dt=rm&dt=bd&dj=1&hl=es-ES&ie=UTF-8&oe=UTF-8&inputm=2&otf=2&iid=1dd3b944-fa62-4b55-b330-74909a99969e";
        $fields = array(
            'sl' => urlencode($source),
            'tl' => urlencode($target),
            'q' => urlencode($text)
        );

        $fields_string = "";
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&';
        }

        rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'AndroidTranslate/5.3.0.RC02.130475354-53000263 5.1 phone TRANSLATE_OPM5_TEST_1');

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }
    protected static function getSentencesFromJSON($json) {
        $sentencesArray = json_decode($json, true);
        $sentences = "";
        if(!empty($sentencesArray["sentences"])){
            foreach ($sentencesArray["sentences"] as $s) {
                if(!empty($s["trans"])){
                    $sentences .= $s["trans"];
                }
            }
        }
        return $sentences;
    }
    public function index(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->select(['id' , 'title' ,'price' ,'product_id' , 'image' , 'slug' , 'count'])->where('variety' , 0)->latest()->paginate(50)->setPath($currentUrl);
        }else{
            $products = Product::select(['id' , 'product_id' , 'title' ,'price' , 'slug' , 'image' , 'count'])->where('variety' , 0)->latest()->paginate(50)->setPath($currentUrl);
        }
        return view('admin.post.index',compact('products','title'));
    }
    public function change(Request $request){
        $title = $request->title;
        $currentUrl = url()->current().'?title='.$request->title;
        if($request->title){
            $products = Product::where(function ($query) use($title) {
                $query->where('title' , "LIKE" , "%{$title}%")
                    ->orWhere('id', $title);
            })->select(['id','title','titleEn','titleSeo','keywordSeo','imageAlt','slug','count','offPrice','off','score','weight','maxCart','status','showcase','original','inquiry','note'])->where('variety' , 0)->latest()->paginate(100)->setPath($currentUrl);
        }else{
            $products = Product::select(['id','title','titleEn','titleSeo','keywordSeo','imageAlt','slug','count','offPrice','off','score','weight','maxCart','status','showcase','original','inquiry','note'])->where('variety' , 0)->latest()->paginate(100)->setPath($currentUrl);
        }
        return view('admin.post.change',compact('products','title'));
    }
    public function changeData(Request $request){
        foreach(json_decode($request->products) as $item){
            if ($item->off){
                $price = round((int)$item->offPrice - ((int)$item->offPrice * $item->off / 100));
            }else{
                $price = (int)$item->offPrice;
            }
            Product::where('id' , $item->id)->first()->update([
                'title' => $item->title,
                'titleEn' => $item->titleEn,
                'titleSeo' => $item->titleSeo,
                'keywordSeo' => $item->keywordSeo,
                'imageAlt' => $item->imageAlt,
                'slug' => $item->slug,
                'count' => $item->count,
                'offPrice' => $item->offPrice,
                'off' => $item->off != '' ? $item->off : null,
                'score' => $item->score != '' ? $item->score : null,
                'weight' => $item->weight != '' ? $item->weight : 10,
                'maxCart' => $item->maxCart != '' ? $item->maxCart : 10,
                'status' => $item->status,
                'showcase' => $item->showcase? 1 : 0,
                'original' => $item->original? 1 : 0,
                'inquiry' => $item->inquiry? 1 : 0,
                'note' => $item->note,
                'price' => $price,
            ]);
        }
        return 'success';
    }
    public function editGroup(Request $request){
        return Product::whereIn('id' , json_decode($request->products))->get();
    }
    public function updateGroup(Product $product,Request $request){
        foreach(json_decode($request->productDatas) as $item){
            if ($item->off){
                $price = round((int)$item->price - ((int)$item->price * $item->off / 100));
            }else{
                $price = (int)$item->price;
            }
            Product::where('id' , $item->product)->first()->update([
                'title' => $item->title,
                'titleEn' => $item->titleEn,
                'titleSeo' => $item->titleSeo,
                'keywordSeo' => $item->keywordSeo,
                'imageAlt' => $item->imageAlt,
                'weight' => $item->weight,
                'slug' => $item->slug,
                'off' => $item->off,
                'price' => $price,
                'prePrice' => $item->prePrice,
                'offPrice' => $item->price,
                'count' => $item->count,
            ]);
        }
        return 'success';
    }

    public function getData(Request $request){
        if($request->type){
            $ch = curl_init('https://api.digikala.com/v1/product/'.$request->digikala.'/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            $result = json_decode($result, true, JSON_PRETTY_PRINT);
            curl_close($ch);

            $images = [];
            $categories = [];
            $brands = [];
            foreach($result['data']['product']['images']['list'] as $item){
                $year = Carbon::now()->year;
                $time = time();
                $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year . '/';
                $url = '/upload/image/' . $year . '/';
                $img = Image::make($item['url'][0])->save('upload/image/' . $year . '/' . $time . '.' . 'jpg', 100, 'jpg');
                $sizefile = $img->filesize() / 1000;
                if ($sizefile > 1000) {
                    $size = round($sizefile / 1000, 2) . 'mb';
                } else {
                    $size = round($sizefile) . 'kb';
                }
                $image = Gallery::create([
                    'name' => $time . '.' . 'jpg',
                    'size' => $size,
                    'type' => 'jpg',
                    'user_id' => auth()->user()->id,
                    'url' => $url . $time . '.' . 'jpg',
                    'path' => $path . $time . '.' . 'jpg',
                ]);
                array_push($images , $image['url']);
                sleep(1);
            }
            if($result['data']['product']['brand']){
                $brand1 = Brand::where('name' , $result['data']['product']['brand']['title_fa'])->first();
                if($brand1){
                    $brand = $brand1;
                }else{
                    $year = Carbon::now()->year;
                    $time = time();
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year . '/';
                    $url = '/upload/image/' . $year . '/';
                    $img = Image::make($result['data']['product']['brand']['logo']['url'][0])->save('upload/image/' . $year . '/' . $time . '.' . 'jpg', 100, 'jpg');
                    $sizefile = $img->filesize() / 1000;
                    if ($sizefile > 1000) {
                        $size = round($sizefile / 1000, 2) . 'mb';
                    } else {
                        $size = round($sizefile) . 'kb';
                    }
                    $imagePost = Gallery::create([
                        'name' => $time . '.' . 'jpg',
                        'size' => $size,
                        'type' => 'jpg',
                        'user_id' => auth()->user()->id,
                        'url' => $url . $time . '.' . 'jpg',
                        'path' => $path . $time . '.' . 'jpg',
                    ]);
                    $brand = Brand::create([
                        'name' => $result['data']['product']['brand']['title_fa'],
                        'nameSeo' => $result['data']['product']['brand']['title_fa'],
                        'image' => $imagePost['url'],
                        'keyword' => $result['data']['product']['brand']['title_fa'],
                    ]);
                }
                array_push($brands , $brand);
            }
            if($result['data']['product']['category']){
                $category1 = Category::where('name' , $result['data']['product']['category']['title_fa'])->first();
                if($category1){
                    $category = $category1;
                }else{
                    $category = Category::create([
                        'name' => $result['data']['product']['category']['title_fa'],
                        'nameSeo' => $result['data']['product']['category']['title_fa'],
                        'keyword' => $result['data']['product']['category']['title_fa'],
                    ]);
                }
                array_push($categories , $category);
            }
            if($result['data']['product']['default_variant']){
                $price = substr($result['data']['product']['default_variant']['price']['selling_price'], 0, -1);
            }else{
                $price = 0;
            }
            return [$result['data'],$brands,$categories,$price,$images];
        }else{
            $link = file_get_contents($request->digikala);
            $dom = new Dom;
            $dom = $dom->loadStr($link);
            $title = $dom->find('#productTitle');
            if(count($title) >= 1){
                $titleEn = $title->text;
                $title = self::requestTranslation('en', 'fa', $title->text);
                $title = self::getSentencesFromJSON($title);
            }else{
                $title = '';
                $titleEn = '';
            }

            $price1 = $dom->find('.apexPriceToPay');
            if($price1 != ''){
                $price = $price1->find('span');
                $price = explode('<', $price);
                $price = explode('>', $price[1]);
                $price = str_replace('$', '', $price[1]);
                $price = explode('.', $price);
                $price = $price[0];
            }
            else{
                $price = 0;
            }

            $brand = $dom->find('.a-spacing-small.po-brand');
            $brands = [];
            if($brand != ''){
                $brand = $brand->find('span' , 1);
                $brand = explode('<', $brand);
                $brand = explode('>', $brand[1]);
                $brand = str_replace('"', '', $brand[1]);
                $brand1 = Brand::where('name' , $brand)->first();
                if($brand1){
                    $brand = $brand1;
                }else{
                    $brand = Brand::create([
                        'name' =>$brand,
                        'nameSeo' =>$brand,
                        'image' => '',
                        'keyword' =>$brand,
                    ]);
                }
                array_push($brands , $brand);
            }

            $images = [];
            foreach($dom->find('#altImages ul li') as $item){
                $imageP1 = $item->find('img');
                $imageP1 = explode('src=', $imageP1);
                if(!empty($imageP1[1])){
                    $imageP1 = explode('"', $imageP1[1]);
                    $imageP2 = explode('._', $imageP1[1]);
                    if(count(explode('jpg', $imageP1[1])) >= 2){
                        $type = '.jpg';
                        $imageP1 = $imageP2[0].$type;
                        $year = Carbon::now()->year;
                        $time = time();
                        $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year . '/';
                        $url = '/upload/image/' . $year . '/';
                        $img = Image::make($imageP1)->save('upload/image/' . $year . '/' . $time . '.' . 'jpg', 100, 'jpg');
                        $sizefile = $img->filesize() / 1000;
                        if ($sizefile > 1000) {
                            $size = round($sizefile / 1000, 2) . 'mb';
                        } else {
                            $size = round($sizefile) . 'kb';
                        }
                        $image = Gallery::create([
                            'name' => $time . '.' . 'jpg',
                            'size' => $size,
                            'type' => 'jpg',
                            'user_id' => auth()->user()->id,
                            'url' => $url . $time . '.' . 'jpg',
                            'path' => $path . $time . '.' . 'jpg',
                        ]);
                        array_push($images , $image['url']);
                        sleep(1);
                    }elseif(count(explode('png', $imageP1[1])) >= 2){
                        $type = '.png';
                        $imageP1 = $imageP2[0].$type;
                        $year = Carbon::now()->year;
                        $time = time();
                        $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $year . '/';
                        $url = '/upload/image/' . $year . '/';
                        $img = Image::make($imageP1)->save('upload/image/' . $year . '/' . $time . '.' . 'jpg', 100, 'jpg');
                        $sizefile = $img->filesize() / 1000;
                        if ($sizefile > 1000) {
                            $size = round($sizefile / 1000, 2) . 'mb';
                        } else {
                            $size = round($sizefile) . 'kb';
                        }
                        $image = Gallery::create([
                            'name' => $time . '.' . 'jpg',
                            'size' => $size,
                            'type' => 'jpg',
                            'user_id' => auth()->user()->id,
                            'url' => $url . $time . '.' . 'jpg',
                            'path' => $path . $time . '.' . 'jpg',
                        ]);
                        array_push($images , $image['url']);
                        sleep(1);
                    }
                }
            }

            $abilities = [];
            foreach($dom->find('#feature-bullets ul li') as $item){
                $ability = $item->find('span');
                $ability = explode('<', $ability);
                $ability = explode('>', $ability[1]);
                $ability = str_replace('"', '', $ability[1]);
                $ability = self::requestTranslation('en', 'fa', $ability);
                $ability = self::getSentencesFromJSON($ability);
                if($ability){
                    array_push($abilities , $ability);
                }
            }

            $properties = [];
            if($dom->find('#productDetails_detailBullets_sections1 tr') != ''){
                foreach($dom->find('#productDetails_detailBullets_sections1 tr') as $item){
                    $p1 = [
                        'title'=> '',
                        'body'=> '',
                    ];
                    $property1 = $item->find('.prodDetSectionEntry');
                    $property1 = explode('<', $property1);
                    $property1 = explode('>', $property1[1]);
                    $property1 = str_replace('"', '', $property1[1]);
                    $property1 = self::requestTranslation('en', 'fa', $property1);
                    $p1['title'] = self::getSentencesFromJSON($property1);

                    $property2 = $item->find('.prodDetAttrValue');
                    $property2 = explode('<', $property2);
                    if(!empty($property2[1])){
                        $property2 = explode('>', $property2[1]);
                        $property2 = str_replace('"', '', $property2[1]);
                        $property2 = self::requestTranslation('en', 'fa', $property2);
                        $p1['body'] = self::getSentencesFromJSON($property2);
                        array_push($properties , $p1);
                    }
                }
            }
            else{
                foreach($dom->find('#detailBullets_feature_div ul li') as $item){
                    $p1 = [
                        'title'=> '',
                        'body'=> '',
                    ];
                    $property1 = $item->find('.a-list-item');
                    $property1 = $property1->find('span');
                    $property1 = explode('<', $property1);
                    if(!empty($property1[1])){
                        $property1 = explode('>', $property1[1]);
                        $property1 = str_replace('"', '', $property1[1]);
                        $property1 = self::requestTranslation('en', 'fa', $property1);
                        $p1['title'] = self::getSentencesFromJSON($property1);

                        $property2 = $item->find('.a-list-item');
                        $property2 = $property2->find('span',1);
                        $property2 = explode('<', $property2);
                        if(!empty($property2[1])){
                            $property2 = explode('>', $property2[1]);
                            $property2 = str_replace('"', '', $property2[1]);
                            $property2 = self::requestTranslation('en', 'fa', $property2);
                            $p1['body'] = self::getSentencesFromJSON($property2);
                            array_push($properties , $p1);
                        }
                    }
                }
            }

            $description = $dom->find('#productDescription_feature_div #productDescription');
            $descriptions = '';
            if($description != ''){
                foreach($description->find('span') as $item) {
                    $description = explode('<', $item);
                    $description = explode('>', $description[1]);
                    $description = str_replace('"', '', $description[1]);
                    $description = self::requestTranslation('en', 'fa', $description);
                    $description = self::getSentencesFromJSON($description);
                    $descriptions = $descriptions . ' ' . $description;
                }
            }

            return [$title,$brands,$images,$abilities,$properties,$descriptions,$price,$titleEn];
        }
    }
    public function create(){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $brands = Brand::select(['id' , 'name'])->latest()->get();
        $guarantees = Guarantee::select(['id' , 'name'])->latest()->get();
        $times = Time::select(['id' , 'name'])->latest()->get();
        $tags = Tag::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $currency = Currency::select(['id' , 'name'])->latest()->get();
        $levels = Role::select(['id' , 'name'])->latest()->get();
        return view('admin.post.create',compact('cats','currency','levels','tags','times','brands','guarantees'));
    }
    public function edit(Product $product){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $brands = Brand::select(['id' , 'name'])->latest()->get();
        $guarantees = Guarantee::select(['id' , 'name'])->latest()->get();
        $times = Time::select(['id' , 'name'])->latest()->get();
        $tags = Tag::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $currency = Currency::select(['id' , 'name'])->latest()->get();
        $levels = Role::select(['id' , 'name'])->latest()->get();
        $posts = Product::where('id' , $product->id)->with('category','tag','guarantee','fields','brand','video','time')->first();
        return view('admin.post.edit',compact('cats','times','levels','currency','tags','brands','guarantees','posts'));
    }
    public function copy(Product $product){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $brands = Brand::select(['id' , 'name'])->latest()->get();
        $guarantees = Guarantee::select(['id' , 'name'])->latest()->get();
        $times = Time::select(['id' , 'name'])->latest()->get();
        $tags = Tag::select(['id' , 'name'])->where('type' , 0)->latest()->get();
        $currency = Currency::select(['id' , 'name'])->latest()->get();
        $posts = Product::where('id' , $product->id)->with('category','tag','guarantee','fields','brand','video','time')->first();
        return view('admin.post.copy',compact('cats','times','currency','tags','brands','guarantees','posts'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'titleEn' => 'required|max:220',
            'status' => 'required',
            'keywordSeo' => 'required',
            'bodySeo' => 'required',
            'titleSeo' => 'required',
            'imageAlt' => 'required',
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|digits_between: 1,11',
        ]);
        $fields = Field::where('status' , 1)->get();
        foreach ($fields as $item){
            if($item->required_status){
                $request->validate([
                    'field'.$item->id => 'required',
                ]);
            }
        }
        if($request->currency >= 1){
            $currency1 = Currency::where('id' , $request->currency)->pluck('price')->first();
            if($currency1){
                $currency = $currency1 * $request->price;
            }else{
                $currency = $request->price;
            }
        }else{
            $currency = $request->price;
        }
        if ($request->off){
            $price = round((int)$currency - ((int)$currency * $request->off / 100));
        }else{
            $price = (int)$currency;
        }
        if ($request->showcase == 'true'){
            $showcase = 1;
        }else{
            $showcase = 0;
        }
        if ($request->used == 'true'){
            $used = 1;
        }else{
            $used = 0;
        }
        if ($request->inquiry == 'true'){
            $inquiry = 1;
        }else{
            $inquiry = 0;
        }
        if ($request->original == 'true'){
            $original = 1;
        }else{
            $original = 0;
        }
        if ($request->lotteryStatus == 'true'){
            $lotteryStatus = 1;
        }else{
            $lotteryStatus = 0;
        }
        if ($request->prebuy == 'true'){
            $prebuy = 1;
        }else{
            $prebuy = 0;
        }

        if($request->suggest){
            $ss =strtr($request->suggest, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
            $times = Verta::parse($ss)->toCarbon();
            $times2 = explode('T',$times);
            $suggest = implode(' ',$times2);
        }else{
            $suggest = null;
        }
        $productId = Setting::where('key', 'productId')->pluck('value')->first();
        $productIds = Product::buildCode();
        $post = Product::create([
            'short' => $request->body,
            'count' => $request->count,
            'title' => $request->title,
            'titleEn' => $request->titleEn,
            'state' => $request->state,
            'city' => $request->city,
            'showcase' => $showcase,
            'used' => $used,
            'inquiry' => $inquiry,
            'weight' => $request->weight,
            'prepare' => $request->prepare,
            'language' => $request->language,
            'note' => $request->note,
            'original' => $original,
            'status' => $request->status,
            'slug' => $request->slug,
            'currency_id' => $request->currency,
            'image3d' => $request->image3d,
            'imageCount3d' => $request->imageCount3d,
            'imageFirstCount' => $request->imageFirstCount,
            'letterLottery' => $request->letterLottery,
            'numLottery1' => $request->numLottery1,
            'numLottery2' => $request->numLottery2,
            'lotteryStatus' => $lotteryStatus,
            'image' => $request->image,
            'score' => $request->score,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keywordSeo' => $request->keywordSeo,
            'imageAlt' => $request->imageAlt,
            'maxCart' => $request->maxCart,
            'minCart' => $request->minCart,
            'price' => $price,
            'priceCurrency' => $request->price,
            'offPrice' => $currency,
            'prePrice' => $request->prePrice,
            'priceBuy' => $request->priceBuy,
            'prebuy' => $prebuy,
            'off' => $request->off,
            'suggest' => $suggest,
            'user_id' => auth()->user()->id,
            'product_id' => $productId . '-' . $productIds,
            'body' => $request->editor,
            'ability' => $request->abilities,
            'size' => $request->sizes,
            'rate' => $request->rates,
            'specifications' => $request->properties,
            'colors' => $request->colors,
            'levels' => $request->levels,
        ]);
        foreach (json_decode($request->videos) as $item){
            Video::create([
                'videoable_type' => 'App\\Models\\Product',
                'videoable_id' => $post->id,
                'url' => $item->url,
            ]);
        }
        if($request->countTank >= 1 && $request->tank_id >= 1){
            Tank::create([
                'name' => $request->title,
                'count' => $request->countTank,
                'parent_id' => $request->tank_id,
                'type' => 1,
                'product_id' => $post->id,
            ]);
        }
        PriceChange::create([
            'price' => $price,
            'product_id' => $post->id,
        ]);
        foreach ($fields as $item){
            FieldData::create([
                'field_id' => $item->id,
                'type' => 1,
                'value' => $request['field'.$item->id],
                'model_id' => $post->id,
            ]);
        }
        $post->category()->sync(json_decode($request->cats));
        $post->brand()->sync(json_decode($request->brands));
        $post->guarantee()->sync(json_decode($request->guarantees));
        $post->time()->sync(json_decode($request->times));
        $post->tag()->sync(json_decode($request->tags));
    }
    public function update(Product $product,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'titleEn' => 'required|max:220',
            'status' => 'required',
            'keywordSeo' => 'required',
            'bodySeo' => 'required',
            'titleSeo' => 'required',
            'imageAlt' => 'required',
            'count' => 'required|integer|digits_between: 1,5',
            'price' => 'required|digits_between: 1,9',
        ]);
        $fields = Field::where('status' , 1)->get();
        foreach ($fields as $item){
            FieldData::where('model_id' , $product->id)->where('field_id' , $item->id)->delete();
            if($item->required_status){
                $request->validate([
                    'field'.$item->id => 'required',
                ]);
            }
            FieldData::create([
                'field_id' => $item->id,
                'value' => $request['field'.$item->id],
                'type' => 1,
                'model_id' => $product->id,
            ]);
        }
        if($request->currency >= 1){
            $currency1 = Currency::where('id' , $request->currency)->pluck('price')->first();
            if($currency1){
                $currency = $currency1 * $request->price;
            }else{
                $currency = $request->price;
            }
        }else{
            $currency = $request->price;
        }
        if ($request->off){
            $price = round((int)$currency - ((int)$currency * $request->off / 100));
        }else{
            $price = (int)$currency;
        }
        if ($request->showcase == 'true'){
            $showcase = 1;
        }else{
            $showcase = 0;
        }
        if ($request->used == 'true'){
            $used = 1;
        }else{
            $used = 0;
        }
        if ($request->inquiry == 'true'){
            $inquiry = 1;
        }else{
            $inquiry = 0;
        }
        if ($request->original == 'true'){
            $original = 1;
        }else{
            $original = 0;
        }
        if ($request->prebuy == 'true'){
            $prebuy = 1;
        }else{
            $prebuy = 0;
        }
        if ($request->lotteryStatus == 'true'){
            $lotteryStatus = 1;
        }else{
            $lotteryStatus = 0;
        }

        if($request->suggest){
            if($request->suggest[0] != 2){
                $ss =strtr($request->suggest, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
                $times = Verta::parse($ss)->toCarbon();
                $times2 = explode('T',$times);
                $suggest = implode(' ',$times2);

                $reports = Report::where('reportable_id' , $product->id)->get();
                $address1 = Setting::where('key' , 'address')->pluck('value')->first();
                $address = $address1 . 'product/' .$product->slug;
                foreach ($reports as $item){
                    $user = User::where('id' , $item->user_id)->first();
                    foreach (json_decode($item->data , true) as $value){
                        if($value == 'ایمیل'){
                            if($user->email){
                                $message = "<strong>سلام و درود خدمت شما دوست عزیز</strong><br>محصول $product->title <br> در پیشنهاد شگفت انگیز قرار گرفته است <br><a href='$address '>مشاهده محصول</a><br><br>";
                                Mail::to($user->email)->send(new sendMail('شگفت انگیز ها' , $message , env('MAIL_FROM_ADDRESS')));
                            }
                        }
                        if($value == 'پیامک'){
                            $messageSuggest = Setting::where('key' , 'messageSuggest')->pluck('value')->first();
                            if($messageSuggest){
                                if($user->number){
                                    $this->sendSms($user->number , [$user->name , $request->title],env('GHASEDAKAPI_Number'),$messageSuggest);
                                }
                            }
                        }

                    }
                }
            }else{
                $suggest = $request->suggest;
            }
        }else{
            $suggest = null;
        }
        if($product->price != $price){
            PriceChange::create([
                'price' => $price,
                'product_id' => $product->id,
            ]);
            Cart::where('product_id' , $product->id)->delete();
        }
        $post = $product->update([
            'short' => $request->body,
            'count' => $request->count,
            'title' => $request->title,
            'titleEn' => $request->titleEn,
            'state' => $request->state,
            'city' => $request->city,
            'showcase' => $showcase,
            'used' => $used,
            'prePrice' => $request->prePrice,
            'prepare' => $request->prepare,
            'note' => $request->note,
            'prebuy' => $prebuy,
            'inquiry' => $inquiry,
            'weight' => $request->weight,
            'maxCart' => $request->maxCart,
            'minCart' => $request->minCart,
            'original' => $original,
            'language' => $request->language,
            'status' => $request->status,
            'slug' => $request->slug,
            'image' => $request->image,
            'image3d' => $request->image3d,
            'imageCount3d' => $request->imageCount3d,
            'imageFirstCount' => $request->imageFirstCount,
            'score' => $request->score,
            'titleSeo' => $request->titleSeo,
            'bodySeo' => $request->bodySeo,
            'keywordSeo' => $request->keywordSeo,
            'currency_id' => $request->currency,
            'imageAlt' => $request->imageAlt,
            'letterLottery' => $request->letterLottery,
            'numLottery1' => $request->numLottery1,
            'numLottery2' => $request->numLottery2,
            'lotteryStatus' => $lotteryStatus,
            'price' => $price,
            'priceCurrency' => $request->price,
            'offPrice' => $currency,
            'priceBuy' => $request->priceBuy,
            'off' => $request->off,
            'suggest' => $suggest,
            'body' => $request->editor,
            'ability' => $request->abilities,
            'rate' => $request->rates,
            'size' => $request->sizes,
            'specifications' => $request->properties,
            'colors' => $request->colors,
            'levels' => $request->levels,
        ]);
        Video::where('videoable_type' , 'App\\Models\\Product')->where('videoable_id' , $product->id)->delete();
        foreach (json_decode($request->videos) as $item){
            Video::create([
                'videoable_type' => 'App\\Models\\Product',
                'videoable_id' => $product->id,
                'url' => $item->url,
            ]);
        }
        $product->category()->detach();
        $product->brand()->detach();
        $product->guarantee()->detach();
        $product->time()->detach();
        $product->tag()->detach();
        $product->category()->sync(json_decode($request->cats));
        $product->brand()->sync(json_decode($request->brands));
        $product->guarantee()->sync(json_decode($request->guarantees));
        $product->time()->sync(json_decode($request->times));
        $product->tag()->sync(json_decode($request->tags));
        return 'success';
    }
    public function show(Product $product){
        $posts = Product::where('id' , $product->id)->withCount('like','bookmark','comments')->with('category','guarantee','brand','time')->first();
        return view('admin.post.show',compact('posts'));
    }
    public function delete(Product $product){
        $product->category()->detach();
        $product->brand()->detach();
        $product->tag()->detach();
        $product->guarantee()->detach();
        $product->time()->detach();
        $product->comments()->delete();
        $product->like()->delete();
        $product->bookmark()->delete();
        $product->rates()->delete();
        $product->lottery()->delete();
        $product->cart()->delete();
        $product->payMeta()->delete();
        $product->delete();
        return redirect()->back()->with([
            'message' => 'محصول با موفقیت حذف شد'
        ]);
    }
}
