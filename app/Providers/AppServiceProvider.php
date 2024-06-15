<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Score;
use App\Models\Setting;
use App\Models\Wallet;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mews\Captcha\Facades\Captcha;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('home.master', function ($view) {
            $links = Link::where('type' , 0)->where('language' , request()->cookie('language')??'fa')->get();
            $telegram = Setting::where('key' , 'telegram')->pluck('value')->first();
            $twitter = Setting::where('key' , 'twitter')->pluck('value')->first();
            $instagram = Setting::where('key' , 'instagram')->pluck('value')->first();
            $etemad = Setting::where('key' , 'etemad')->pluck('value')->first();
            $fanavari = Setting::where('key' , 'fanavari')->pluck('value')->first();
            $facebook = Setting::where('key' , 'facebook')->pluck('value')->first();
            if(App::getLocale() == 'tr'){
                $title = Setting::where('key' , 'titleTr')->pluck('value')->first();
                $name = Setting::where('key' , 'nameTr')->pluck('value')->first();
            }elseif(App::getLocale() == 'en'){
                $title = Setting::where('key' , 'titleEn')->pluck('value')->first();
                $name = Setting::where('key' , 'nameEn')->pluck('value')->first();
            }elseif(App::getLocale() == 'ar'){
                $title = Setting::where('key' , 'titleAr')->pluck('value')->first();
                $name = Setting::where('key' , 'nameAr')->pluck('value')->first();
            }else{
                $title = Setting::where('key' , 'title')->pluck('value')->first();
                $name = Setting::where('key' , 'name')->pluck('value')->first();
            }
            $logo = Setting::where('key' , 'logo')->pluck('value')->first();
            $headScript = Setting::where('key' , 'headScript')->pluck('value')->first();
            $bodyScript = Setting::where('key' , 'bodyScript')->pluck('value')->first();

            $catHeader1 = Setting::where('key' , 'catHeader')->pluck('value')->first();
            $catHeader = [];
            if ($catHeader1 != null){
                $allCatHeader3 = explode(',' , $catHeader1);
                foreach ($allCatHeader3 as $item){
                    $send = Category::where('id' , $item)->where('language' , request()->cookie('language')??'fa')->with(["cats" => function($q){
                        $q->with(["cats" => function($q){
                            $q->with(["cats" => function($q){
                                $q->with('cats');}]);}]);}])->first();
                    if($send){
                        array_push($catHeader ,$send);
                    }
                }
            }
            $heightHeader = Setting::where('key' , 'heightHeader')->pluck('value')->first();
            $imageHeader = Setting::where('key' , 'imageHeader')->pluck('value')->first();
            $linkHeader = Setting::where('key' , 'linkHeader')->pluck('value')->first();
            $adHeaderStatus = Setting::where('key' , 'adHeaderStatus')->pluck('value')->first();

            if(\request()->theme != ''){
                $theme = \request()->theme;
            }else{
                if(!empty($_COOKIE['theme'])){
                    if($_COOKIE['theme'] == 'false'){
                        $theme = 0;
                    }else{
                        $theme = 1;
                    }
                }else{
                    $theme = 0;
                }
            }
            $catTop = Category::latest()->where('language' , request()->cookie('language')??'fa')->select(['name','id'])->take(30)->get();

            $stateContainer = [request()->state,request()->city];

            if(Request::segment(1) != 'login' && Request::segment(1) != 'direct-payment'){
                if(Setting::where('key' , 'captchaType')->pluck('value')->first() == 0){
                    $captcha = Captcha::img('math');
                }elseif (Setting::where('key' , 'captchaType')->pluck('value')->first() == 1){
                    $captcha = Captcha::img('inverse');
                }elseif (Setting::where('key' , 'captchaType')->pluck('value')->first() == 2){
                    $captcha = Captcha::img('mini2');
                }elseif (Setting::where('key' , 'captchaType')->pluck('value')->first() == 3){
                    $captcha = Captcha::img('default');
                }else{
                    $captcha = Captcha::img('mini');
                }
            }else{
                $captcha = '';
            }
            $view->with([
                'captcha' => $captcha,
                'headScript' => $headScript,
                'bodyScript' => $bodyScript,
                'theme' => $theme,
                'catHeader' => $catHeader,
                'telegram' => $telegram,
                'twitter' => $twitter,
                'stateContainer' => $stateContainer,
                'instagram' => $instagram,
                'etemad' => $etemad,
                'fanavari' => $fanavari,
                'facebook' => $facebook,
                'name' => $name,
                'links' => $links,
                'title' => $title,
                'logo' => $logo,
                'catTop' => $catTop,
                'heightHeader' => $heightHeader,
                'imageHeader' => $imageHeader,
                'linkHeader' => $linkHeader,
                'adHeaderStatus' => $adHeaderStatus,
            ]);
        });

        view()->composer('admin.master', function ($view) {
            $logo = Setting::where('key' , 'logo')->pluck('value')->first();
            $headerColor = Setting::where('key' , 'headerColor')->pluck('value')->first();
            $sideColor = Setting::where('key' , 'sideColor')->pluck('value')->first();
            $view->with([
                'logo' => $logo,
                'headerColor' => $headerColor,
                'sideColor' => $sideColor,
            ]);
        });

        view()->composer('seller.master', function ($view) {
            $logo = Setting::where('key' , 'logo')->pluck('value')->first();
            $view->with([
                'logo' => $logo,
            ]);
        });

        view()->composer('home.profile.list', function ($view) {
            $wallet = Wallet::latest()->where('type' , 0)->where('user_id' , auth()->user()->id)->where('status' , 100)->pluck('price')->sum() - Wallet::latest()->where('type' , 1)->where('user_id' , auth()->user()->id)->where('status' , 100)->pluck('price')->sum();
            $scores = Score::latest()->where('type' , 0)->where('user_id' , auth()->user()->id)->pluck('name')->sum() - Score::latest()->where('type' , 1)->where('user_id' , auth()->user()->id)->pluck('name')->sum();
            $checkSeller = auth()->user()->getAllPermissions()->where('name' , 'فروشنده')->first()? 1 : 0;
            $view->with([
                'wallet' => $wallet,
                'checkSeller' => $checkSeller,
                'scores' => $scores,
            ]);
        });
    }
}
