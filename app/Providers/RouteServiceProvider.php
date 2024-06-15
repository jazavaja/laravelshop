<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Land;
use App\Models\News;
use App\Models\Page;
use App\Models\Pay;
use App\Models\PayMeta;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/profile';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        Route::bind('ProductSlug', function ($value) {
            return Product::where('slug', $value)->where('status', 1)->firstOrFail();
        });
        Route::bind('CollectionSlug', function ($value) {
            return Collection::where('slug', $value)->firstOrFail();
        });

        Route::bind('BlogSlug', function ($value) {
            return News::where('slug', $value)->firstOrFail();
        });

        Route::bind('CategorySlug', function ($value) {
            return Category::where('slug', $value)->where('type' , 0)->firstOrFail();
        });

        Route::bind('TagSlug', function ($value) {
            return Tag::where('slug', $value)->where('type' , 0)->firstOrFail();
        });

        Route::bind('BrandSlug', function ($value) {
            return Brand::where('slug', $value)->firstOrFail();
        });

        Route::bind('BlogCategory', function ($value) {
            return Category::where('slug', $value)->where('type' , 1)->firstOrFail();
        });

        Route::bind('BlogTag', function ($value) {
            return Tag::where('slug', $value)->where('type' , 1)->firstOrFail();
        });

        Route::bind('PageSlug', function ($value) {
            return Page::where('slug', $value)->firstOrFail();
        });

        Route::bind('PayId', function ($value) {
            if(auth()->user()){
                return Pay::where('property', $value)->where('user_id' , auth()->user()->id)->firstOrFail();
            }else{
                return abort(404);
            }
        });

        Route::bind('WidgetSlug', function ($value) {
            return Widget::where('slug', $value)->firstOrFail();
        });
        Route::bind('LandingSlug', function ($value) {
            return Land::where('slug', $value)->firstOrFail();
        });

        Route::bind('MyProduct', function ($value) {
            return Product::where('id', $value)->where('user_id' , auth()->user()->id)->firstOrFail();
        });
        Route::bind('ProductID', function ($value) {
            return Product::where('product_id', $value)->where('status' , 1)->where('variety' , 0)->firstOrFail();
        });
        Route::bind('SimpleProduct', function ($value) {
            return Product::where('id', $value)->where('status' , 1)->where('variety' , 0)->firstOrFail();
        });
        Route::bind('MyVariety', function ($value) {
            return Product::where('id', $value)->where('user_id' , auth()->user()->id)->where('status' , 1)->where('variety' , '>=' , 1)->firstOrFail();
        });

        Route::bind('MyPay', function ($value) {
            $posts = Product::latest()->where('user_id' , auth()->user()->id)->pluck('id');
            return PayMeta::whereIn('product_id' , $posts)->where('id', $value)->firstOrFail();
        });

        Route::bind('SellerSlug', function ($value) {
            $user = User::where('slug', $value)->firstOrFail();
            $user2 = $user->getAllPermissions()->where('name' , 'فروشنده')->pluck('name')->first();
            if($user2 || $user->admin){
                return $user;
            }else{
                return abort(404);
            }
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
