<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use App\Models\Widget;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    use SeoHelper;
    public function category(Category $category , Request $request){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $category->nameSeo . "$title - " , $category->bodySeo , 'store' , 'category/'."$category->slug" , $category->image , $category->keyword );
        $product = $category->product()
            ->where('language', request()->cookie('language') ?? 'fa')
            ->where('status', 1)
            ->where('variety', 0)
            ->get();
        $maxPrice = $product->max('price');
        $minPrice = $product->min('price');

        $getshowmax = $request->max ?? $maxPrice;
        $getshowmin = $request->min ?? $minPrice;
        $getsearch = $request->search ? str_replace('"', ' ', $request->search) : '';
        $getshow = $request->show ?? 0;
        $color = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $size = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $brands = Brand::select(['name','slug','nameSeo','id'])->latest()->get();

        $cats = $category->cats;
        $urlpages = '/change/category/'.$category->slug;
        $archive = Category::where('id' , $category->id)->first();
        return view('home.archive.product', compact('cats','archive','getshowmax','getshowmin','getsearch','getshow','urlpages','minPrice','maxPrice','size','brands','color'));
    }

    public function categoryChange(Request $request, Category $category)
    {
        $product = $category->product()->where('language', request()->cookie('language') ?? 'fa')->where('status', 1)->where('variety', 0);

        $sizeId = $request->allSize ? $product->whereJsonContains('size', explode(',', $request->allSize))->pluck('id')->toArray() : [];

        $searchId = $request->search ? $product->where(function ($query) use ($request) {
            $query->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("short", "LIKE", "%{$request->search}%")
                ->orWhere("body", "LIKE", "%{$request->search}%")
                ->orWhere('product_id', $request->search);
        })->pluck('id')->toArray() : [];

        $colorId = $request->allColor ? $product->whereJsonContains('colors', explode(',', $request->allColor))->pluck('id')->toArray() : [];

        $rangeId = $request->max ? $product->whereBetween('price', [$request->min, $request->max])->pluck('id')->toArray() : [];

        $suggestId = $request->suggest ? $product->where('suggest', '!=', '')->pluck('id')->toArray() : [];

        $countId = $request->count ? $product->where('count', '!=', '0')->pluck('id')->toArray() : [];

        $arrayFilter = array_filter([$sizeId, $searchId, $colorId, $rangeId, $suggestId, $countId]);

        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;

        if (empty($arrayFilter)) {
            $catPost = $category->product()
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        } else {
            $catPost = $category->product()
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        }

        return $catPost;
    }

    public function categories(){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $this->seoSingleSeo( 'همه دسته بندی ها' . "$title - " , 'دسته بندی محصولات ما' , 'store' , 'categories' , $logoSite , $keyword );

        $cats = Category::select(['name','image','slug'])->get();
        return view('home.archive.categories', compact('cats'));
    }

    public function archive(Widget $widget, Request $request)
    {
        $title = Setting::where('key', 'title')->pluck('value')->first();
        $name = $widget->title ? $widget->title : 'محصولات';
        $logoSite = Setting::where('key', 'logo')->pluck('value')->first() ?: '';
        $keyword = Setting::where('key', 'keyword')->pluck('value')->first() ?: [];

        $this->seoSingleSeo($name . "$title - ", $name, 'store', 'archive/' . $widget->slug, $logoSite, $keyword);
        $ids = [];
        $ids2 = [];
        if($widget['cats'] != '[]'){
            $catIds = json_decode($widget['cats'], true);
            $ids = Category::whereIn('id', $catIds)
                ->where('language', request()->cookie('language') ?? 'fa')
                ->with('product:id')
                ->get()
                ->pluck('product.*.id')
                ->flatten()
                ->toArray();
        }
        if($widget['brands'] != '[]'){
            $catIds = json_decode($widget['brands'], true);
            $ids2 = Brand::whereIn('id', $catIds)
                ->where('language', request()->cookie('language') ?? 'fa')
                ->with('product:id')
                ->get()
                ->pluck('product.*.id')
                ->flatten()
                ->toArray();
        }
        if($widget['brands'] != '[]' && $widget['cats'] != '[]'){
            $arrayFilter = array_intersect($ids2, $ids);
        }
        else{
            if($widget['brands'] != '[]'){
                $arrayFilter = $ids2;
            }elseif($widget['cats'] != '[]'){
                $arrayFilter = $ids;
            }else{
                $arrayFilter = Product::latest()->where('variety', 0)->where('language' , request()->cookie('language')??'fa')->pluck('id')->take($widget['count'])->toArray();
            }
        }

        $product = Product::where('status', 1)->where('language', request()->cookie('language') ?? 'fa')->whereIn('id', $arrayFilter)->get();
        $maxPrice = $product->max('price');
        $minPrice = $product->min('price');
        $getshowmax = $request->max ?? $maxPrice;
        $getshowmin = $request->min ?? $minPrice;
        $getsearch = $request->search ? str_replace('"', ' ', $request->search) : '';
        $getshow = $request->show ?: 0;
        $color1 = [];

        $color = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $size = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $brands = Brand::select(['name', 'slug', 'nameSeo', 'id'])->latest()->get();
        $cats = [];
        $urlpages = '/change/archive/' . $widget->slug;
        $archive = json_decode(json_encode(["name" => $name, "body" => ""]));
        return view('home.archive.product', compact('cats', 'archive', 'getshowmax', 'getshowmin', 'getsearch', 'getshow', 'urlpages', 'minPrice', 'maxPrice', 'size', 'brands', 'color'));
    }
    public function archiveChange(Request $request , Widget $widget){
        $ids = [];
        $ids2 = [];

        if($widget['cats'] != '[]'){
            $catIds = json_decode($widget['cats'], true);
            $ids = Category::whereIn('id', $catIds)
                ->where('language', request()->cookie('language') ?? 'fa')
                ->with('product:id')
                ->get()
                ->pluck('product.*.id')
                ->flatten()
                ->toArray();
        }
        if($widget['brands'] != '[]'){
            $catIds = json_decode($widget['brands'], true);
            $ids2 = Brand::whereIn('id', $catIds)
                ->where('language', request()->cookie('language') ?? 'fa')
                ->with('product:id')
                ->get()
                ->pluck('product.*.id')
                ->flatten()
                ->toArray();
        }
        if($widget['brands'] != '[]' && $widget['cats'] != '[]'){
            $arrayFilter2 = array_intersect($ids2, $ids);
        }
        else{
            if($widget['brands'] != '[]'){
                $arrayFilter2 = $ids2;
            }elseif($widget['cats'] != '[]'){
                $arrayFilter2 = $ids;
            }else{
                $arrayFilter2 = Product::latest()->where('variety', 0)->where('language' , request()->cookie('language')??'fa')->pluck('id')->take($widget['count'])->toArray();
            }
        }
        $product = Product::whereIn('id', $arrayFilter2)
            ->where('status', 1)
            ->where('variety', 0);
        if ($widget['type'] == 3 || $widget['type'] == 0) {
            $product->where('count', '>=', 1);
        } elseif ($widget['type'] == 1) {
            $product->where('off', '!=', '');
        } elseif ($widget['type'] == 2) {
            $product->where('suggest', '!=', '');
        }

        $sizeId = $request->allSize ? $product->whereJsonContains('size', explode(',', $request->allSize))->pluck('id')->toArray() : [];

        $searchId = $request->search ? $product->where(function ($query) use ($request) {
            $query->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("short", "LIKE", "%{$request->search}%")
                ->orWhere("body", "LIKE", "%{$request->search}%")
                ->orWhere('product_id', $request->search);
        })->pluck('id')->toArray() : [];

        $colorId = $request->allColor ? $product->whereJsonContains('colors', explode(',', $request->allColor))->pluck('id')->toArray() : [];

        $rangeId = $request->max ? $product->whereBetween('price', [$request->min, $request->max])->pluck('id')->toArray() : [];

        $suggestId = $request->suggest ? $product->where('suggest', '!=', '')->pluck('id')->toArray() : [];

        $countId = $request->count ? $product->where('count', '!=', '0')->pluck('id')->toArray() : [];

        $arrayFilter = array_filter([$sizeId, $searchId, $colorId, $rangeId, $suggestId, $countId]);

        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;

        if (empty($arrayFilter)) {
            $catPost = $product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        } else {
            $catPost = $product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        }
        return $catPost;
    }

    public function tag(Tag $tag , Request $request){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $tag->nameSeo . "$title - " , $tag->bodySeo , 'store' , 'tag/'."$tag->slug" , $tag->image , $tag->keyword );
        $product = $tag->product()
            ->where('language', request()->cookie('language') ?? 'fa')
            ->where('status', 1)
            ->where('variety', 0)
            ->get();
        $maxPrice = $product->max('price');
        $minPrice = $product->min('price');

        $getshowmax = $request->max ?? $maxPrice;
        $getshowmin = $request->min ?? $minPrice;
        $getsearch = $request->search ? str_replace('"', ' ', $request->search) : '';
        $getshow = $request->show ?? 0;
        $color = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $size = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $brands = Brand::select(['name','slug','nameSeo','id'])->latest()->get();

        $cats = [];

        $urlpages = '/change/tag/'.$tag->slug;
        $archive = Tag::where('id' , $tag->id)->first();
        return view('home.archive.product', compact('cats','archive','getshowmax','getshowmin','getsearch','getshow','urlpages','minPrice','maxPrice','size','brands','color'));
    }
    public function tagChange(Request $request , Tag $tag){
        $product = $tag->product()->where('language', request()->cookie('language') ?? 'fa')->where('status', 1)->where('variety', 0);

        $sizeId = $request->allSize ? $product->whereJsonContains('size', explode(',', $request->allSize))->pluck('id')->toArray() : [];

        $searchId = $request->search ? $product->where(function ($query) use ($request) {
            $query->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("short", "LIKE", "%{$request->search}%")
                ->orWhere("body", "LIKE", "%{$request->search}%")
                ->orWhere('product_id', $request->search);
        })->pluck('id')->toArray() : [];

        $colorId = $request->allColor ? $product->whereJsonContains('colors', explode(',', $request->allColor))->pluck('id')->toArray() : [];

        $rangeId = $request->max ? $product->whereBetween('price', [$request->min, $request->max])->pluck('id')->toArray() : [];

        $suggestId = $request->suggest ? $product->where('suggest', '!=', '')->pluck('id')->toArray() : [];

        $countId = $request->count ? $product->where('count', '!=', '0')->pluck('id')->toArray() : [];

        $arrayFilter = array_filter([$sizeId, $searchId, $colorId, $rangeId, $suggestId, $countId]);

        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;

        if (empty($arrayFilter)) {
            $catPost = $tag->product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        } else {
            $catPost = $tag->product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        }

        return $catPost;
    }

    public function brand(Brand $brand , Request $request){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( $brand->nameSeo . "$title - " , $brand->bodySeo , 'store' , 'brand/'."$brand->slug" , $brand->image , $brand->keyword );
        $product = $brand->product()
            ->where('language', request()->cookie('language') ?? 'fa')
            ->where('status', 1)
            ->where('variety', 0)
            ->get();
        $maxPrice = $product->max('price');
        $minPrice = $product->min('price');

        $getshowmax = $request->max ?? $maxPrice;
        $getshowmin = $request->min ?? $minPrice;
        $getsearch = $request->search ? str_replace('"', ' ', $request->search) : '';
        $getshow = $request->show ?? 0;
        $color = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $size = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $brands = Brand::select(['name','slug','nameSeo','id'])->latest()->get();
        $cats = [];
        $urlpages = '/change/brand/'.$brand->slug;
        $archive = Brand::where('id' , $brand->id)->first();
        return view('home.archive.product', compact('cats','archive','getshowmax','getshowmin','getsearch','getshow','urlpages','minPrice','maxPrice','size','brands','color'));
    }
    public function brandChange(Request $request , Brand $brand){
        $product = $brand->product()->where('language', request()->cookie('language') ?? 'fa')->where('status', 1)->where('variety', 0);

        $sizeId = $request->allSize ? $product->whereJsonContains('size', explode(',', $request->allSize))->pluck('id')->toArray() : [];

        $searchId = $request->search ? $product->where(function ($query) use ($request) {
            $query->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("short", "LIKE", "%{$request->search}%")
                ->orWhere("body", "LIKE", "%{$request->search}%")
                ->orWhere('product_id', $request->search);
        })->pluck('id')->toArray() : [];

        $colorId = $request->allColor ? $product->whereJsonContains('colors', explode(',', $request->allColor))->pluck('id')->toArray() : [];

        $rangeId = $request->max ? $product->whereBetween('price', [$request->min, $request->max])->pluck('id')->toArray() : [];

        $suggestId = $request->suggest ? $product->where('suggest', '!=', '')->pluck('id')->toArray() : [];

        $countId = $request->count ? $product->where('count', '!=', '0')->pluck('id')->toArray() : [];

        $arrayFilter = array_filter([$sizeId, $searchId, $colorId, $rangeId, $suggestId, $countId]);

        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;

        if (empty($arrayFilter)) {
            $catPost = $brand->product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        } else {
            $catPost = $brand->product
                ->where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        }

        return $catPost;
    }

    public function search(Request $request){
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $this->seoSingleSeo( 'جستجو' . "$title - " , 'جستجو محصول' , 'store' , 'search?search='.str_replace('"', ' ', $request->search) , $logoSite , $keyword );
        $product = Product::where("title" , "LIKE" , "%{$request->search}%")
            ->where('language', request()->cookie('language') ?? 'fa')
            ->where('status', 1)
            ->where('variety', 0)
            ->get();
        $maxPrice = $product->max('price');
        $minPrice = $product->min('price');

        $getshowmax = $request->max ?? $maxPrice;
        $getshowmin = $request->min ?? $minPrice;
        $getsearch = $request->search ? str_replace('"', ' ', $request->search) : '';
        $getshow = $request->show ?? 0;
        $color = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $size = $product->flatMap(function ($item) {
            $sizes = json_decode($item['size'], true);
            return collect($sizes)->pluck('name')->all();
        })->unique()->values()->all();

        $brands = Brand::select(['name','slug','nameSeo','id'])->latest()->get();

        $cats = [];

        $urlpages = '/change/search';
        $archive = json_decode(json_encode(["name"=>$getsearch,"body"=>""]));
        return view('home.archive.product', compact('cats','archive','getshowmax','getshowmin','getsearch','getshow','urlpages','minPrice','maxPrice','size','brands','color'));
    }
    public function searchChange(Request $request){
        $product = Product::where("title" , "LIKE" , "%{$request->search}%")->where('language', request()->cookie('language') ?? 'fa')->where('status', 1)->where('variety', 0);

        $sizeId = $request->allSize ? $product->whereJsonContains('size', explode(',', $request->allSize))->pluck('id')->toArray() : [];

        $searchId = $request->search ? $product->where(function ($query) use ($request) {
            $query->where("title", "LIKE", "%{$request->search}%")
                ->orWhere("short", "LIKE", "%{$request->search}%")
                ->orWhere("body", "LIKE", "%{$request->search}%")
                ->orWhere('product_id', $request->search);
        })->pluck('id')->toArray() : [];

        $colorId = $request->allColor ? $product->whereJsonContains('colors', explode(',', $request->allColor))->pluck('id')->toArray() : [];

        $rangeId = $request->max ? $product->whereBetween('price', [$request->min, $request->max])->pluck('id')->toArray() : [];

        $suggestId = $request->suggest ? $product->where('suggest', '!=', '')->pluck('id')->toArray() : [];

        $countId = $request->count ? $product->where('count', '!=', '0')->pluck('id')->toArray() : [];

        $arrayFilter = array_filter([$sizeId, $searchId, $colorId, $rangeId, $suggestId, $countId]);

        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;

        if (empty($arrayFilter)) {
            $catPost = Product::where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        } else {
            $catPost = Product::where("title", "LIKE", "%{$request->search}%")
                ->where('language', request()->cookie('language') ?? 'fa')
                ->whereIn('id', call_user_func_array('array_intersect', $arrayFilter))
                ->when($request->show == 0, fn ($query) => $query->latest())
                ->when($request->show == 2, fn ($query) => $query->withCount('payMeta')->orderBy('pay_meta_count', 'DESC'))
                ->when(in_array($request->show, [1, 3]), fn ($query) => $query->withCount('view')->orderByDesc('view_count'))
                ->when(in_array($request->show, [4, 5]), fn ($query) => $query->orderBy('price', $request->show == 4 ? 'asc' : 'desc'))
                ->where('status', 1)
                ->where('variety', 0)
                ->paginate(36)->setPath($currentUrl);
        }

        return $catPost;
    }

    public function mall(User $user , Request $request){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first();
        $this->seoSingleSeo( $user->name . "$title - " , $user->body , 'store' , 'mall/'."$user->slug" , $user->profile , $keyword );

        $maxPrice = $user->product()->where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('variety' , 0)->orderBy('price','DESC')->pluck('price')->first();
        $minPrice = $user->product()->where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('variety' , 0)->orderBy('price')->pluck('price')->first();
        if($request->max){
            $getshowmax = $request->max;
        }else{
            $getshowmax = $maxPrice;
        }
        if($request->min){
            $getshowmin = $request->min;
        }else{
            $getshowmin = $minPrice;
        }
        if($request->search){
            $getsearch = str_replace('"', ' ', $request->search);
        }else{
            $getsearch = '';
        }
        if($request->show){
            $getshow = $request->show;
        }else{
            $getshow = 0;
        }
        $product = $user->product()->where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('variety' , 0)->get();
        $color1 = [];
        for ( $i = 0; $i < count($product); $i++) {
            $colors = json_decode($product[$i]['colors']);
            if ($colors != null){
                for ( $i2 = 0; $i2 < count($colors); $i2++) {
                    array_push($color1 , $colors[$i2]->name);
                }
            }
        }
        $color = array_unique($color1);

        $size1 = [];
        for ( $i = 0; $i < count($product); $i++) {
            $sizes = json_decode($product[$i]['size'] , true);
            if ($sizes != null){
                for ( $i2 = 0; $i2 < count($sizes); $i2++) {
                    array_push($size1 , $sizes[$i2]['name']);
                }
            }
        }
        $size = array_unique($size1);

        $brands = Brand::select(['name','slug','nameSeo','id'])->latest()->get();

        $cats = [];

        $urlpages = '/change/mall/'.$user->slug;
        $archive = json_decode(json_encode(["name"=>$user->name,"body"=>$user->body]));
        return view('home.archive.product', compact('cats','archive','getshowmax','getshowmin','getsearch','getshow','urlpages','minPrice','maxPrice','size','brands','color'));
    }
    public function mallChange(Request $request , User $user){
        $product = $user->product()->where('language' , request()->cookie('language')??'fa')->where('status' , 1)->where('variety' , 0)->get();

        $sizeId = [];
        if ($request->allSize){
            $allSize = explode(',' , $request->allSize);
            for ( $i = 0; $i < count($product); $i++) {
                $sizeIds = json_decode($product[$i]['size'] , true);
                if ($sizeIds != null){
                    for ( $i2 = 0; $i2 < count($sizeIds); $i2++) {
                        for ( $i3 = 0; $i3 < count($allSize); $i3++) {
                            if ($allSize[$i3] == $sizeIds[$i2]['name']){
                                array_push($sizeId , $product[$i]['id']);
                            }
                        }
                    }
                }
            }
        }

        $searchId= [];
        if ($request->search){
            $search1 = $request->search;
            $searchId = $user->product()->where('language' , request()->cookie('language')??'fa')->latest()->where(function ($query) use($search1) {
                $query->where("title" , "LIKE" , "%{$search1}%")
                    ->orWhere("short" , "LIKE" , "%{$search1}%")
                    ->orWhere("body" , "LIKE" , "%{$search1}%")
                    ->orWhere('product_id', $search1);
            })->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
        }

        $colorId = [];
        if ($request->allColor){
            $allColor = explode(',' , $request->allColor);
            for ( $i = 0; $i < count($product); $i++) {
                $colorIds = json_decode($product[$i]['colors'] , true);
                if ($colorIds != null){
                    for ( $i2 = 0; $i2 < count($colorIds); $i2++) {
                        for ( $i3 = 0; $i3 < count($allColor); $i3++) {
                            if ($allColor[$i3] == $colorIds[$i2]['name']){
                                array_push($colorId , $product[$i]['id']);
                            }
                        }
                    }
                }
            }
        }

        $rangeId = [];
        if ($request->max){
            $rangeId = $user->product()->where('language' , request()->cookie('language')??'fa')->where('price', '>=', $request->min)->where('status' , 1)->where('variety' , 0)->where('price', '<=', $request->max)->pluck('id')->toArray();
        }

        $suggestId = [];
        if ($request->suggest){
            $suggestId = $user->product()->where('language' , request()->cookie('language')??'fa')->where('suggest' , '!=' , '')->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
        }

        $countId = [];
        if ($request->count){
            $countId = $user->product()->where('language' , request()->cookie('language')??'fa')->where('count' , '!=' , '0')->where('status' , 1)->where('variety' , 0)->pluck('id')->toArray();
        }

        $checks = 0;
        $arrayFilter = [];
        if($request->allSize){
            if($checks == 1) {
                $arrayFilter = array_intersect($sizeId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $sizeId;
            }
        }
        if($request->search){
            if($checks == 1) {
                $arrayFilter = array_intersect($searchId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $searchId;
            }
        }
        if($request->allColor){
            if($checks == 1) {
                $arrayFilter = array_intersect($colorId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $colorId;
            }
        }
        if($request->max){
            if($checks == 1) {
                $arrayFilter = array_intersect($rangeId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $rangeId;
            }
        }
        if($request->suggest){
            if($checks == 1) {
                $arrayFilter = array_intersect($suggestId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $suggestId;
            }
        }
        if($request->count){
            if($checks == 1) {
                $arrayFilter = array_intersect($countId , $arrayFilter);
            }
            else{
                $checks = 1;
                $arrayFilter = $countId;
            }
        }
        $currentUrl = url()->current().'?min='.$request->min.'&max='.$request->max.'&show='.$request->show.'&search='.$request->search.'&allSize='.$request->allSize.'&allColor='.$request->allColor;
        if($checks == 0){
            if ($request->show == 0){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->latest()->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 2){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->withCount('payMeta')->orderBy('pay_meta_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 1 or $request->show == 3){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->withCount('view')->orderBy('view_count','DESC' )->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 4){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->orderBy('price')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 5){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->orderBy('price','DESC')->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
        }else{
            if ($request->show == 0){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->latest()->whereIn('id' , $arrayFilter)->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 2){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->withCount('payMeta')->orderBy('pay_meta_count','DESC' )->whereIn('id' , $arrayFilter)->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 1 or $request->show == 3){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->withCount('view')->orderBy('view_count','DESC' )->whereIn('id' , $arrayFilter)->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 4){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->orderBy('price')->whereIn('id' , $arrayFilter)->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
            if ($request->show == 5){
                $catPost = $user->product()->where('language' , request()->cookie('language')??'fa')->orderBy('price','DESC')->whereIn('id' , $arrayFilter)->where('status' , 1)->where('variety' , 0)->withCount('view')->withCount('comments')->withCount(["rates" => function ($q) {
                             $q->select(DB::raw('round(avg(rate),1)'));
                         }])->withCount(["payMeta" => function ($q) {
                             $q->whereIn('status' , [100,20,50])->select(DB::raw('sum(count)'));
                         }])->paginate(36)->setPath($currentUrl);
            }
        }

        return $catPost;
    }
}
