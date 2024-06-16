<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Collection;
use App\Models\Comment;
use App\Models\FieldData;
use App\Models\Like;
use App\Models\LotteryCode;
use App\Models\News;
use App\Models\Pack;
use App\Models\PayMeta;
use App\Models\PriceChange;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    use SeoHelper;
    public function single(Product $product){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $singleDesign = Setting::where('key' , 'singleDesign')->pluck('value')->first();
        $this->seoSingleSeo( $product->titleSeo . "$title - " , $product->bodySeo , 'store' , 'product/'."$product->slug" , json_decode($product->image)[0] , $product->keywordSeo );
        $post = Product::withCount([
            'comments' => fn ($q) => $q->where('status', 1),
            'rates' => fn ($q) => $q->select(DB::raw('round(avg(rate), 1)'))
        ])->with([
            'category', 'brand', 'time', 'guarantee', 'tag',
            'product' => fn ($q) => $q->where('status', 1)->with('user', 'guarantee'),
            'collection.product' => fn ($q) => $q->where('id', '!=', $product->id),
            'lottery' => fn ($q) => $q->where('parent_id', 0)->with('winner')
        ])->withCount('like')->find($product->id);

        if ($post->lotteryStatus == 1) {
            $allLottery = $post->numLottery2 - $post->numLottery1 + 1;
            $lastLottery1 = LotteryCode::where('product_id', $post->id)
                ->where('active', 0)
                ->latest('round')
                ->first();

            $lastLottery = $lastLottery1 ? $lastLottery1->codes()->where('active', 0)->count() : 0;
            $lastLottery = $lastLottery == $allLottery ? 0 : $lastLottery;
        } else {
            $allLottery = 0;
            $lastLottery = 0;
        }
        $related = Product::where('id', '!=', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($q) use ($product) {
                $q->whereIn('name', $product->category()->pluck('name'));
            })
            ->take(10)
            ->get();

        $finalPrices = $product->price;
        $like = $bookmark = $levelUser = null;
        if (auth()->check()) {
            $like = Like::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $bookmark = Bookmark::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();
            $levelUser = auth()->user()->roles()->pluck('name')->toArray();
            if ($post->levels && $post['levels'] != '[]') {
                foreach (json_decode($post['levels']) as $item) {
                    if (in_array($item->name, $levelUser)) {
                        $finalPrices = $item->price;
                        break;
                    }
                }
            }
        }


        $pays1 = PayMeta::where('product_id' , $post->id)->pluck('count')->sum();
        $comments = Comment::where('product_id' , $product->id)->where('status',1)->with('user')->latest()->get();
        $priceChange = PriceChange::latest()->where('product_id' , $product->id)->take(5)->get();
        $fields = FieldData::where('model_id' , $post->id)->whereHas('field', function($q){
            $q->where('status' , 1)->where('show_status', 1);
        })->get();

        $viewName = 'home.single.product';
        if ($singleDesign == 1) {
            $viewName = 'home.single.product2';
        } elseif ($singleDesign == 2) {
            $viewName = 'home.single.product3';
        }
        return view($viewName, compact('post', 'levelUser', 'finalPrices', 'pays1', 'fields', 'priceChange', 'allLottery', 'lastLottery', 'bookmark', 'like', 'related', 'comments'));

    }

    public function pack(Collection $collection){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $collection->titleSeo . "$title - " , $collection->bodySeo , 'store' , 'pack/'."$collection->slug" , $collection->image , $collection->keywordSeo );
        $packs = Collection::where('id' , $collection->id)->with('product')->first();
        return view('home.single.pack' , compact('packs'));
    }

    public function blog(News $news){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $news->titleSeo . "$title - " , $news->bodySeo , 'store' , 'blog/'."$news->slug" , $news->image , $news->keywordSeo );

        $related =  News::whereHas('category', function ($q) use ($news){
            return $q->whereIn('name', $news->category()->pluck('name'));
        })->where('id' , '!=' , $news->id)->where('status' , 1)->take(6)->get();
        $suggest = News::where('suggest',1)->inRandomOrder()->where('status',1)->latest()->get();
        $post = News::where('id',$news->id)->with('category','tag')->first();
        $fields = FieldData::where('model_id' , $post->id)->whereHas('field', function($q){
            $q->where('status' , 2)->where('show_status', 1);
        })->get();
        return view('home.single.blog' , compact('related','fields','suggest','post'));
    }
}
