<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FloatAccess;
use App\Models\Land;
use App\Models\Setting;
use App\Models\Widget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function categoryIndex(){
        $cats = Category::select(['id' , 'name'])->where('type' , 0)->get();
        $catHeader1 = Setting::where('key' , 'catHeader')->pluck('value')->first();
        $catHeader2 = explode(',' , $catHeader1);
        $catHeader = [];
        for ( $i = 0; $i < count($catHeader2); $i++) {
            $send = Category::where('id' , $catHeader2[$i])->pluck('name')->first();
            array_push($catHeader , $send);
        }
        return view('admin.setting.category' , compact('cats','catHeader'));
    }

    public function categoryUpdate(Request $request){
        $catHeader1 = explode(',',$request->catHeader);
        $catHeader = [];
        for ( $i = 0; $i < count($catHeader1); $i++) {
            $send = Category::where('name' , $catHeader1[$i])->pluck('id')->first();
            array_push($catHeader , $send);
        }
        $array = [
            'catHeader' => implode(',' , $catHeader),
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return 'success';
    }

    public function manageIndex(){
        $name = Setting::where('key' , 'name')->pluck('value')->first();
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logo = Setting::where('key' , 'logo')->pluck('value')->first();
        $about = Setting::where('key' , 'about')->pluck('value')->first();
        $address = Setting::where('key' , 'address')->pluck('value')->first();
        $email = Setting::where('key' , 'email')->pluck('value')->first();
        $fanavari = Setting::where('key' , 'fanavari')->pluck('value')->first();
        $etemad = Setting::where('key' , 'etemad')->pluck('value')->first();
        $number = Setting::where('key' , 'number')->pluck('value')->first();
        $facebook = Setting::where('key' , 'facebook')->pluck('value')->first();
        $instagram = Setting::where('key' , 'instagram')->pluck('value')->first();
        $twitter = Setting::where('key' , 'twitter')->pluck('value')->first();
        $telegram = Setting::where('key' , 'telegram')->pluck('value')->first();
        $productId = Setting::where('key' , 'productId')->pluck('value')->first();
        $heightHeader = Setting::where('key' , 'heightHeader')->pluck('value')->first();
        $imageHeader = Setting::where('key' , 'imageHeader')->pluck('value')->first();
        $linkHeader = Setting::where('key' , 'linkHeader')->pluck('value')->first();
        $adHeaderStatus = Setting::where('key' , 'adHeaderStatus')->pluck('value')->first();
        $imagePopUp = Setting::where('key' , 'imagePopUp')->pluck('value')->first();
        $titlePopUp = Setting::where('key' , 'titlePopUp')->pluck('value')->first();
        $addressPopUp = Setting::where('key' , 'addressPopUp')->pluck('value')->first();
        $popUpStatus = Setting::where('key' , 'popUpStatus')->pluck('value')->first();
        $descriptionPopUp = Setting::where('key' , 'descriptionPopUp')->pluck('value')->first();
        $buttonPopUp = Setting::where('key' , 'buttonPopUp')->pluck('value')->first();
        $cooperationPercent = Setting::where('key' , 'cooperationPercent')->pluck('value')->first();
        $cooperationStatus = Setting::where('key' , 'cooperationStatus')->pluck('value')->first();
        $minifySource = Setting::where('key' , 'minifySource')->pluck('value')->first();
        $headerColor = Setting::where('key' , 'headerColor')->pluck('value')->first();
        $sideColor = Setting::where('key' , 'sideColor')->pluck('value')->first();
        $giftDis = Setting::where('key' , 'giftDis')->pluck('value')->first();
        $holidays = Setting::where('key' , 'holidays')->pluck('value')->first();
        $textFloat = Setting::where('key' , 'textFloat')->pluck('value')->first();
        $singleDesign = Setting::where('key' , 'singleDesign')->pluck('value')->first();
        $headerDesign = Setting::where('key' , 'headerDesign')->pluck('value')->first();
        $footerDesign = Setting::where('key' , 'footerDesign')->pluck('value')->first();
        $loginDesign = Setting::where('key' , 'loginDesign')->pluck('value')->first();
        $google = Setting::where('key' , 'google')->pluck('value')->first();
        $github = Setting::where('key' , 'github')->pluck('value')->first();
        $font = Setting::where('key' , 'font')->pluck('value')->first();
        $languageStatus = Setting::where('key' , 'languageStatus')->pluck('value')->first();
        $darkStatus = Setting::where('key' , 'darkStatus')->pluck('value')->first();
        $captchaStatus = Setting::where('key' , 'captchaStatus')->pluck('value')->first();
        $captchaType = Setting::where('key' , 'captchaType')->pluck('value')->first();
        $tax = Setting::where('key' , 'tax')->pluck('value')->first();
        $maxGift = Setting::where('key' , 'maxGift')->pluck('value')->first();
        $nameAr = Setting::where('key' , 'nameAr')->pluck('value')->first();
        $titleAr = Setting::where('key' , 'titleAr')->pluck('value')->first();
        $nameEn = Setting::where('key' , 'nameEn')->pluck('value')->first();
        $titleEn = Setting::where('key' , 'titleEn')->pluck('value')->first();
        $nameTr = Setting::where('key' , 'nameTr')->pluck('value')->first();
        $titleTr = Setting::where('key' , 'titleTr')->pluck('value')->first();
        $addressEn = Setting::where('key' , 'addressEn')->pluck('value')->first();
        $addressAr = Setting::where('key' , 'addressAr')->pluck('value')->first();
        $addressTr = Setting::where('key' , 'addressTr')->pluck('value')->first();
        $aboutEn = Setting::where('key' , 'aboutEn')->pluck('value')->first();
        $aboutAr = Setting::where('key' , 'aboutAr')->pluck('value')->first();
        $aboutTr = Setting::where('key' , 'aboutTr')->pluck('value')->first();
        $textFloatEn = Setting::where('key' , 'textFloatEn')->pluck('value')->first();
        $textFloatAr = Setting::where('key' , 'textFloatAr')->pluck('value')->first();
        $textFloatTr = Setting::where('key' , 'textFloatTr')->pluck('value')->first();
        return view('admin.setting.manage' , compact('name','title','textFloatEn','languageStatus','darkStatus','textFloatAr','textFloatTr','aboutEn','aboutAr','aboutTr','addressEn','addressAr','addressTr','nameAr','titleAr','nameEn','titleEn','nameTr','titleTr','font','maxGift','tax','captchaType','google','captchaStatus','github','footerDesign','loginDesign','textFloat','singleDesign','headerDesign','headerColor','holidays','giftDis','sideColor','minifySource','cooperationStatus','cooperationPercent','descriptionPopUp','buttonPopUp','imagePopUp','titlePopUp','addressPopUp','popUpStatus','heightHeader','imageHeader','linkHeader','adHeaderStatus','logo','about','address','email','fanavari','etemad','number','facebook','instagram','twitter','telegram','productId'));
    }

    public function manageUpdate(Request $request){
        $fanavari = $request->fanavari;
        $etemad = $request->etemad;
        $number = $request->number;
        $textFloat = $request->textFloat;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $twitter = $request->twitter;
        $telegram = $request->telegram;
        $logo = $request->image;
        $about = $request->about;
        $title = $request->title;
        $address = $request->address;
        $productId = $request->productId;
        $name = $request->name;
        $email = $request->email;
        $font = $request->font;
        $headerColor = $request->headerColor;
        $sideColor = $request->sideColor;
        $giftDis = $request->giftDis;
        $minifySource = $request->minifySource;
        $cooperationPercent = $request->cooperationPercent;
        $cooperationStatus = $request->cooperationStatus;
        $singleDesign = $request->singleDesign;
        $headerDesign = $request->headerDesign;
        $footerDesign = $request->footerDesign;
        $loginDesign = $request->loginDesign;
        $captchaStatus = $request->captchaStatus;
        $captchaType = $request->captchaType;
        $google = $request->google;
        $github = $request->github;
        $tax = $request->tax;
        $languageStatus = $request->languageStatus;
        $darkStatus = $request->darkStatus;
        $maxGift = $request->maxGift;
        $nameAr = $request->nameAr;
        $titleAr = $request->titleAr;
        $nameEn = $request->nameEn;
        $titleEn = $request->titleEn;
        $nameTr = $request->nameTr;
        $titleTr = $request->titleTr;
        $addressEn = $request->addressEn;
        $addressAr = $request->addressAr;
        $addressTr = $request->addressTr;
        $aboutEn = $request->aboutEn;
        $aboutAr = $request->aboutAr;
        $aboutTr = $request->aboutTr;
        $textFloatEn = $request->textFloatEn;
        $textFloatAr = $request->textFloatAr;
        $textFloatTr = $request->textFloatTr;
        $holidays = json_encode($request->holidays);
        if($cooperationStatus == 'on'){
            $cooperationStatus = 1;
        }else{
            $cooperationStatus = 0;
        }
        if($minifySource == 'on'){
            $minifySource = 1;
        }else{
            $minifySource = 0;
        }
        if($google == 'on'){
            $google = 1;
        }else{
            $google = 0;
        }
        if($github == 'on'){
            $github = 1;
        }else{
            $github = 0;
        }
        if($captchaStatus == 'on'){
            $captchaStatus = 1;
        }else{
            $captchaStatus = 0;
        }
        if($languageStatus == 'on'){
            $languageStatus = 1;
        }else{
            $languageStatus = 0;
        }
        if($darkStatus == 'on'){
            $darkStatus = 1;
        }else{
            $darkStatus = 0;
        }
        $array = [
            'productId' =>$productId,
            'name' =>$name,
            'headerDesign' =>$headerDesign,
            'captchaStatus' =>$captchaStatus,
            'singleDesign' =>$singleDesign,
            'maxGift' =>$maxGift,
            'textFloat' =>$textFloat,
            'google' =>$google,
            'github' =>$github,
            'giftDis' =>$giftDis,
            'cooperationPercent' =>$cooperationPercent,
            'cooperationStatus' =>$cooperationStatus,
            'captchaType' =>$captchaType,
            'font' =>$font,
            'languageStatus' =>$languageStatus,
            'darkStatus' =>$darkStatus,
            'fanavari' =>$fanavari,
            'minifySource' =>$minifySource,
            'telegram' =>$telegram,
            'etemad' =>$etemad,
            'twitter' =>$twitter,
            'headerColor' =>$headerColor,
            'sideColor' =>$sideColor,
            'instagram' =>$instagram,
            'facebook' =>$facebook,
            'number' =>$number,
            'logo' =>$logo,
            'tax' =>$tax,
            'nameAr' =>$nameAr,
            'titleAr' =>$titleAr,
            'nameEn' =>$nameEn,
            'titleEn' =>$titleEn,
            'nameTr' =>$nameTr,
            'titleTr' =>$titleTr,
            'addressEn' =>$addressEn,
            'addressAr' =>$addressAr,
            'addressTr' =>$addressTr,
            'aboutEn' =>$aboutEn,
            'aboutAr' =>$aboutAr,
            'aboutTr' =>$aboutTr,
            'textFloatEn' =>$textFloatEn,
            'textFloatAr' =>$textFloatAr,
            'textFloatTr' =>$textFloatTr,
            'about' =>$about,
            'title' =>$title,
            'holidays' =>$holidays,
            'address' =>$address,
            'email' =>$email,
            'footerDesign' =>$footerDesign,
            'loginDesign' =>$loginDesign,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function adsHeader(Request $request){
        $heightHeader = $request->heightHeader;
        $imageHeader = $request->imageHeader;
        $linkHeader = $request->linkHeader;
        if($request->adHeaderStatus == 'on'){
            $adHeaderStatus = 1;
        }else{
            $adHeaderStatus = 0;
        }
        $array = [
            'heightHeader' =>$heightHeader,
            'imageHeader' =>$imageHeader,
            'linkHeader' =>$linkHeader,
            'adHeaderStatus' =>$adHeaderStatus,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function popUp(Request $request){
        $imagePopUp = $request->imagePopUp;
        $titlePopUp = $request->titlePopUp;
        $addressPopUp = $request->addressPopUp;
        $descriptionPopUp = $request->descriptionPopUp;
        $buttonPopUp = $request->buttonPopUp;
        if($request->popUpStatus == 'on'){
            $popUpStatus = 1;
        }else{
            $popUpStatus = 0;
        }
        $array = [
            'imagePopUp' =>$imagePopUp,
            'titlePopUp' =>$titlePopUp,
            'addressPopUp' =>$addressPopUp,
            'popUpStatus' =>$popUpStatus,
            'descriptionPopUp' =>$descriptionPopUp,
            'buttonPopUp' =>$buttonPopUp,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function seoIndex(){
        $titleSeo = Setting::where('key' , 'titleSeo')->pluck('value')->first();
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first();
        $aboutSeo = Setting::where('key' , 'aboutSeo')->pluck('value')->first();
        return view('admin.setting.seo' , compact('titleSeo','keyword','aboutSeo'));
    }

    public function seoUpdate(Request $request){
        $titleSeo = $request->titleSeo;
        $keyword = $request->keyword;
        $aboutSeo = $request->aboutSeo;
        $array = [
            'titleSeo' =>$titleSeo,
            'keyword' =>$keyword,
            'aboutSeo' =>$aboutSeo,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function themeIndex(){
        $greenColorLight = Setting::where('key' , 'greenColorLight')->pluck('value')->first();
        $redColorLight = Setting::where('key' , 'redColorLight')->pluck('value')->first();
        $backColorLight1 = Setting::where('key' , 'backColorLight1')->pluck('value')->first();
        $headerColorLight = Setting::where('key' , 'headerColorLight')->pluck('value')->first();
        $headerColor2Light = Setting::where('key' , 'headerColor2Light')->pluck('value')->first();
        $widgetColorLight = Setting::where('key' , 'widgetColorLight')->pluck('value')->first();
        $singleColorLight = Setting::where('key' , 'singleColorLight')->pluck('value')->first();
        $greenColorDark = Setting::where('key' , 'greenColorDark')->pluck('value')->first();
        $redColorDark = Setting::where('key' , 'redColorDark')->pluck('value')->first();
        $backColorDark1 = Setting::where('key' , 'backColorDark1')->pluck('value')->first();
        $headerColorDark = Setting::where('key' , 'headerColorDark')->pluck('value')->first();
        $headerColor2Dark = Setting::where('key' , 'headerColor2Dark')->pluck('value')->first();
        $widgetColorDark = Setting::where('key' , 'widgetColorDark')->pluck('value')->first();
        $singleColorDark = Setting::where('key' , 'singleColorDark')->pluck('value')->first();
        return view('admin.setting.theme' , compact('greenColorLight','redColorLight','backColorLight1','headerColorLight','headerColor2Light','widgetColorLight','singleColorLight','greenColorDark','redColorDark','backColorDark1','headerColorDark','headerColor2Dark','widgetColorDark','singleColorDark'));
    }

    public function themeUpdate(Request $request){
        if($request->demo >= 1){
            if($request->demo == 1) {
                $demo = json_decode('[{"id":25,"name":"\u0627\u0633\u0644\u0627\u06cc\u062f\u0631 \u0628\u0632\u0631\u06af","title":null,"more":null,"number":0,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/jl.gif\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-04-06T10:13:56.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":40,"name":"\u0627\u0633\u0644\u0627\u06cc\u062f\u0631 \u0628\u0632\u0631\u06af","title":null,"more":null,"number":1,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"ar","ads1":"[{\"image\":\"https:\/\/dukhni.ca\/cdn\/shop\/files\/Gift_celebrate_the_spirit_of_eid_with_1.png?v=1688470338&width=3056\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T16:19:20.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":41,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":2,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"ar","ads1":"[{\"image\":\"https:\/\/cdn.dribbble.com\/users\/4705225\/screenshots\/15324012\/media\/10c5cec441ee285c9e22bc707c43c44c.jpg?resize=400x0\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dribbble.com\/users\/4705225\/screenshots\/15324012\/media\/10c5cec441ee285c9e22bc707c43c44c.jpg?resize=400x0\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dribbble.com\/users\/4705225\/screenshots\/15324012\/media\/10c5cec441ee285c9e22bc707c43c44c.jpg?resize=400x0\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dribbble.com\/users\/4705225\/screenshots\/15324012\/media\/10c5cec441ee285c9e22bc707c43c44c.jpg?resize=400x0\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T16:22:36.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":43,"name":"\u0645\u062a\u0646","title":"\u0627\u0631\u062a\u0628\u0627\u0637 \u0628\u0627 \u0645\u0627 : 0999999999","more":null,"number":3,"description":null,"background":"linear-gradient(to left ,#e62424,#e69124)","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-10-14T14:45:21.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":42,"name":"\u0633\u0648\u0627\u0644 \u0645\u062a\u062f\u0627\u0648\u0644","title":"\u0623\u0633\u0626\u0644\u0629 \u0645\u0643\u0631\u0631\u0629","more":null,"number":4,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"ar","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T16:28:32.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":39,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":5,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"en","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/ty1011\/int\/banner\/1210202391232_DE_woman_desktop_carousel_banner_okt21.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:40:47.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":35,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":6,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"en","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Pfw_50_Homepageweb_202310121958.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:13:27.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":38,"name":"\u0634\u06af\u0641\u062a \u0627\u0646\u06af\u06cc\u0632","title":"Latest Products","more":"show all","number":7,"description":"Latest Products","background":"#db33d2","slug":"latest-products-en","background2":"https:\/\/cdn.dsmcdn.com\/ty961\/int\/banner\/03072023422f6_DE_woman_new_balance_brands_slider_gue1.jpg","count":10,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"en","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:21:51.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":36,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":8,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"en","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Prefashion_Week_Proms1_202310121541.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Prefashion_Week_Proms5_Sar_202310121541.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Prefashion_Week_Proms2_202310121541.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Prefashion_Week_Proms7_Sar_202310121541.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:15:23.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":37,"name":"\u062c\u0633\u062a\u062c\u0648","title":null,"more":null,"number":9,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"en","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:19:49.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":32,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":10,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"tr","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Pfw_Homepageweb_202310121938.gif\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T14:46:09.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":31,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":11,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"tr","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/ty1016\/pimWidgetApi\/mobile_20231013000939_2340495TrendyolCollectionAradiginTumUrunler2340495mobile.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/ty1011\/pimWidgetApi\/mobile_20231012122748_gddf.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/ty1013\/pimWidgetApi\/mobile_20231013000812_MangoKadinErkekCocukTekstil2343169mobile.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T14:45:30.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":33,"name":"\u0645\u062d\u0635\u0648\u0644 \u0639\u0631\u0636\u06cc","title":"en son \u00fcr\u00fcnler","more":"Daha fazla g\u00f6ster","number":12,"description":"en son \u00fcr\u00fcnler","background":"#000000","slug":"tr-product","background2":null,"count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"8","responsive":0,"cats":"[]","language":"tr","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T14:48:44.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":34,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":13,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"tr","ads1":"[{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/12\/En_Prefashion_Week_Sales_Arazra6_202310121516.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/cdn.dsmcdn.com\/marketing\/datascience\/automation\/2023\/10\/10\/En_Women_Boutique_Arazra3_202310102236.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-10-13T15:05:03.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":46,"name":"\u0645\u0642\u0627\u06cc\u0633\u0647","title":"\u0627\u0645\u06a9\u0627\u0646 \u0646\u0645\u0627\u06cc\u0634 \u0645\u062d\u0635\u0648\u0644 \u0628\u0627 \u0631\u0646\u06af \u0648 \u0639\u06a9\u0633 \u0645\u062a\u0641\u0627\u0648\u062a","more":null,"number":14,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-03-23T07:39:14.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":10,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":15,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/nn1.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/nn2.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/nn3.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/nn4.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-03T05:33:14.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":6,"name":"\u0645\u062d\u0635\u0648\u06443","title":"\u0634\u06af\u0641\u062a \u0627\u0646\u06af\u06cc\u0632","more":"\u0645\u0634\u0627\u0647\u062f\u0647 \u0647\u0645\u0647","number":16,"description":"\u062a\u0633\u062a","background":"#1141ff","slug":"\u0634\u06af\u0641\u062a-\u0627\u0646\u06af\u06cc\u0632","background2":"https:\/\/rayganapp.ir\/upload\/image\/2022\/amazing-typo.svg","count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:20:05.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":47,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":17,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/hh1.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/hh2.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-11-15T20:25:04.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":8,"name":"\u0645\u062d\u0635\u0648\u06442","title":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0627\u0635\u0644","more":"\u0645\u0634\u0627\u0647\u062f\u0647 \u0628\u06cc\u0634\u062a\u0631","number":18,"description":"lfkndslf","background":"#000000","slug":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a-\u0627\u0635\u0644","background2":null,"count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T10:25:20.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":15,"name":"\u067e\u06cc\u0634\u0646\u0647\u0627\u062f \u0644\u062d\u0638\u0647 \u0627\u06cc","title":"\u067e\u0631\u0641\u0631\u0648\u0634 \u062a\u0631\u06cc\u0646 \u0645\u062d\u0635\u0648\u0644\u0627\u062a","more":null,"number":19,"description":null,"background":"#000000","slug":null,"background2":null,"count":6,"sort":5,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-10-20T11:11:13.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":13,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":20,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/jj1.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/jj2.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-06T06:18:13.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":14,"name":"\u0628\u0647\u062a\u0631\u06cc\u0646 \u0647\u0627","title":"\u067e\u0631\u0641\u0631\u0648\u0634\u200c\u062a\u0631\u06cc\u0646 \u06a9\u0627\u0644\u0627\u0647\u0627","more":null,"number":21,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":5,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-10-19T10:30:51.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"},{"id":3,"name":"\u062e\u0628\u0631","title":"\u0622\u062e\u0631\u06cc\u0646 \u062e\u0628\u0631 \u0647\u0627","more":null,"number":22,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:15:24.000000Z","updated_at":"2023-11-15T20:31:33.000000Z"}]');
            }
            if($request->demo == 2) {
                $demo = json_decode('[{"id":25,"name":"\u0627\u0633\u0644\u0627\u06cc\u062f\u0631 \u0628\u0632\u0631\u06af","title":null,"more":null,"number":0,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/jj.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-04-06T10:13:56.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":10,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":1,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2023\/media-643ba86b36e99.png\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2023\/media-643ba8aaa9a1c.png\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2023\/media-643ba8d1e7ee4.png\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2023\/media-643ba8f49ba5b.png\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-03T05:33:14.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":44,"name":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0628\u0627 \u067e\u0633 \u0632\u0645\u06cc\u0646\u0647","title":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u062c\u062f\u06cc\u062f \u0645\u0627","more":"\u0628\u0631\u0627\u06cc \u0645\u0634\u0627\u0647\u062f\u0647 \u0645\u062d\u0635\u0648\u0644\u0627\u062a \u06a9\u0644\u06cc\u06a9 \u06a9\u0646\u06cc\u062f","number":2,"description":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0645\u0627 \u0631\u0627 \u062e\u0631\u06cc\u062f\u0627\u0631\u06cc \u06a9\u0646\u06cc\u062f","background":"#000000","slug":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a-\u062c\u062f\u06cc\u062f1","background2":"https:\/\/digimall.golden-site.ir\/upload\/image\/2021\/T1tw_gBjdv1RXrhCrK.jpg","count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T10:25:20.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":29,"name":"\u062c\u0633\u062a\u062c\u0648","title":null,"more":null,"number":3,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-06-15T04:10:23.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":45,"name":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0639\u0645\u0648\u062f\u06cc \u0628\u0627 \u067e\u0633 \u0632\u0645\u06cc\u0646\u0647","title":"\u0645\u062d\u0628\u0648\u0628 \u062a\u0631\u06cc\u0646 \u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0645\u0627","more":"\u0628\u0631\u0627\u06cc \u0645\u0634\u0627\u0647\u062f\u0647 \u0645\u062d\u0635\u0648\u0644\u0627\u062a \u06a9\u0644\u06cc\u06a9 \u06a9\u0646\u06cc\u062f","number":4,"description":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0645\u0627 \u0631\u0627 \u062e\u0631\u06cc\u062f\u0627\u0631\u06cc \u06a9\u0646\u06cc\u062f","background":"#000000","slug":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a-\u0645\u062d\u0635\u0628\u0648\u0628","background2":"https:\/\/chawk.in\/themes\/davici\/wp-content\/uploads\/2021\/03\/img-banner.jpg","count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T10:25:20.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":46,"name":"\u0645\u0642\u0627\u06cc\u0633\u0647","title":"\u0627\u0645\u06a9\u0627\u0646 \u0646\u0645\u0627\u06cc\u0634 \u0645\u062d\u0635\u0648\u0644 \u0628\u0627 \u0631\u0646\u06af \u0648 \u0639\u06a9\u0633 \u0645\u062a\u0641\u0627\u0648\u062a","more":null,"number":5,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-03-23T07:39:14.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":3,"name":"\u062e\u0628\u0631","title":"\u0622\u062e\u0631\u06cc\u0646 \u062e\u0628\u0631 \u0647\u0627","more":null,"number":6,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:15:24.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":5,"name":"\u0644\u06cc\u0633\u062a\u06cc","title":"\u0645\u0646\u062a\u062e\u0628 \u0645\u062d\u0635\u0648\u0644\u0627\u062a \u062a\u062e\u0641\u06cc\u0641 \u0648 \u062d\u0631\u0627\u062c","more":"\u0645\u0634\u0627\u0647\u062f\u0647 \u0628\u06cc\u0634\u062a\u0631","number":7,"description":null,"background":"#000000","slug":null,"background2":null,"count":10,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:18:11.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":13,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":8,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad30.gif\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad31.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-06T06:18:13.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"},{"id":30,"name":"\u0633\u0648\u0627\u0644 \u0645\u062a\u062f\u0627\u0648\u0644","title":"\u0633\u0648\u0627\u0644\u0627\u062a \u0645\u062a\u062f\u0627\u0648\u0644","more":null,"number":9,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-08-15T08:13:59.000000Z","updated_at":"2023-11-16T09:30:03.000000Z"}]');
            }
            if($request->demo == 3) {
                $demo = json_decode('[{"id":2,"name":"\u062a\u0628\u0644\u06cc\u063a \u0627\u0633\u0644\u0627\u06cc\u062f\u0631\u06cc","title":null,"more":null,"number":0,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad8.jpg\",\"address\":\"\/\"}]","ads3":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad9.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad9.jpg\",\"address\":\"\/\"}]","created_at":"2022-09-18T09:14:10.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":22,"name":"\u0627\u0633\u062a\u0648\u0631\u06cc","title":"\u0627\u0633\u062a\u0648\u0631\u06cc \u0648 \u0647\u0627\u06cc\u0644\u0627\u06cc\u062a \u0647\u0627","more":null,"number":1,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-03-23T07:39:14.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":8,"name":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0627\u0633\u0644\u0627\u06cc\u062f\u0631\u06cc","title":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0627\u0635\u0644","more":"\u0645\u0634\u0627\u0647\u062f\u0647 \u0628\u06cc\u0634\u062a\u0631","number":2,"description":"lfkndslf","background":"#000000","slug":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a-\u0627\u0635\u0644","background2":null,"count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T10:25:20.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":10,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":3,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/pp.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ll.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-03T05:33:14.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":6,"name":"\u0634\u06af\u0641\u062a \u0627\u0646\u06af\u06cc\u0632","title":"\u0634\u06af\u0641\u062a \u0627\u0646\u06af\u06cc\u0632","more":"\u0645\u0634\u0627\u0647\u062f\u0647 \u0647\u0645\u0647","number":4,"description":"\u062a\u0633\u062a","background":"#1141ff","slug":"\u0634\u06af\u0641\u062a-\u0627\u0646\u06af\u06cc\u0632","background2":"https:\/\/rayganapp.ir\/upload\/image\/2022\/amazing-typo.svg","count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:20:05.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":21,"name":"\u062c\u0633\u062a\u062c\u06482","title":null,"more":null,"number":5,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-03-10T08:22:41.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":23,"name":"\u0648\u0627\u0645","title":"\u0648\u0627\u0645 \u062f\u0631\u062e\u0648\u0627\u0633\u062a\u06cc \u062c\u0647\u062a \u062e\u0631\u06cc\u062f \u0627\u0632 \u0633\u0626\u0648\u0634\u0627\u067e","more":null,"number":6,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"15","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-03-25T11:13:03.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":47,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":7,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/gg.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-11-15T19:32:53.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"},{"id":3,"name":"\u062e\u0628\u0631","title":"\u0622\u062e\u0631\u06cc\u0646 \u062e\u0628\u0631 \u0647\u0627","more":null,"number":8,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:15:24.000000Z","updated_at":"2023-11-15T19:33:32.000000Z"}]');
            }
            if($request->demo == 4) {
                $demo = json_decode('[{"id":47,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":0,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ty.gif\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2023-11-15T19:53:23.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":10,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":1,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ss1.jpg\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ss2.gif\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ss3.webp\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2024\/ss4.webp\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-03T05:33:14.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":15,"name":"\u067e\u06cc\u0634\u0646\u0647\u0627\u062f \u0644\u062d\u0638\u0647 \u0627\u06cc","title":"\u067e\u0631\u0641\u0631\u0648\u0634 \u062a\u0631\u06cc\u0646 \u0645\u062d\u0635\u0648\u0644\u0627\u062a","more":null,"number":2,"description":null,"background":"#000000","slug":null,"background2":null,"count":6,"sort":5,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-10-20T11:11:13.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":19,"name":"\u06af\u0631\u062f\u0648\u0646\u0647 \u062f\u0633\u062a\u0647 \u0628\u0646\u062f\u06cc","title":null,"more":null,"number":3,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":null,"responsive":0,"cats":"[\"27\",\"30\",\"33\",\"37\",\"50\",\"53\",\"55\",\"59\"]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-12-30T09:16:58.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":8,"name":"\u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0627\u0633\u0644\u0627\u06cc\u062f\u0631\u06cc","title":"\u067e\u0631\u0628\u0627\u0632\u062f\u06cc\u062f \u062a\u0631\u06cc\u0646 \u0645\u062d\u0635\u0648\u0644\u0627\u062a","more":"\u0645\u062d\u0628\u0648\u0628 \u062a\u0631\u06cc\u0646 \u0645\u062d\u0635\u0648\u0644\u0627\u062a \u0645\u0627 \u0631\u0627 \u0645\u0634\u0627\u0647\u062f\u0647 \u06a9\u0646\u06cc\u062f","number":4,"description":"lfkndslf","background":"#000000","slug":"\u0628\u0627\u0632\u062f\u06cc\u062f-\u0645\u062d\u0635\u0648\u0644","background2":null,"count":6,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"16","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T10:25:20.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":14,"name":"\u0628\u0647\u062a\u0631\u06cc\u0646 \u0647\u0627","title":"\u067e\u0631\u0641\u0631\u0648\u0634\u200c\u062a\u0631\u06cc\u0646 \u06a9\u0627\u0644\u0627\u0647\u0627","more":null,"number":5,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":5,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-10-19T10:30:51.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":30,"name":"\u0633\u0648\u0627\u0644 \u0645\u062a\u062f\u0627\u0648\u0644","title":"\u0633\u0648\u0627\u0644\u0627\u062a \u0645\u062a\u062f\u0627\u0648\u0644","more":null,"number":6,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"20","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2023-08-15T08:13:59.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":13,"name":"\u062a\u0628\u0644\u06cc\u063a \u0633\u0627\u062f\u0647","title":null,"more":null,"number":7,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad30.gif\",\"address\":\"\/\"},{\"image\":\"https:\/\/rayganapp.ir\/upload\/image\/2022\/ad31.jpg\",\"address\":\"\/\"}]","ads2":"[]","ads3":"[]","created_at":"2022-10-06T06:18:13.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"},{"id":3,"name":"\u062e\u0628\u0631","title":"\u0622\u062e\u0631\u06cc\u0646 \u062e\u0628\u0631 \u0647\u0627","more":null,"number":8,"description":null,"background":"#000000","slug":null,"background2":null,"count":null,"sort":0,"type":3,"status":1,"brands":"[]","move":0,"height":"10","responsive":0,"cats":"[]","language":"fa","ads1":"[]","ads2":"[]","ads3":"[]","created_at":"2022-09-18T09:15:24.000000Z","updated_at":"2023-11-15T20:01:51.000000Z"}]');
            }
            DB::table('widgets')->delete();
            foreach ($demo as $item){
                Widget::create([
                    'name'=> $item->name,
                    'title'=> $item->title,
                    'more'=> $item->more,
                    'description'=> $item->description,
                    'background'=> $item->background,
                    'slug'=> $item->slug,
                    'background2'=> $item->background2,
                    'count'=> $item->count,
                    'sort'=> $item->sort,
                    'type'=> $item->type,
                    'status'=> $item->status,
                    'brands'=> $item->brands,
                    'language'=> $item->language,
                    'height'=> $item->height,
                    'responsive'=> $item->responsive,
                    'move'=> $item->move,
                    'number'=> $item->number,
                    'cats'=> $item->cats,
                    'ads1'=> $item->ads1,
                    'ads2'=> $item->ads2,
                    'ads3'=> $item->ads3,
                ]);
            }
        }
        $greenColorLight = $request->greenColorLight;
        $redColorLight = $request->redColorLight;
        $backColorLight1 = $request->backColorLight1;
        $headerColorLight = $request->headerColorLight;
        $headerColor2Light = $request->headerColor2Light;
        $widgetColorLight = $request->widgetColorLight;
        $singleColorLight = $request->singleColorLight;
        $greenColorDark = $request->greenColorDark;
        $redColorDark = $request->redColorDark;
        $backColorDark1 = $request->backColorDark1;
        $headerColorDark = $request->headerColorDark;
        $headerColor2Dark = $request->headerColor2Dark;
        $widgetColorDark = $request->widgetColorDark;
        $singleColorDark = $request->singleColorDark;
        $array = [
            'greenColorLight' =>$greenColorLight,
            'redColorLight' =>$redColorLight,
            'backColorLight1' =>$backColorLight1,
            'headerColorLight' =>$headerColorLight,
            'headerColor2Light' =>$headerColor2Light,
            'widgetColorLight' =>$widgetColorLight,
            'singleColorLight' =>$singleColorLight,
            'greenColorDark' =>$greenColorDark,
            'redColorDark' =>$redColorDark,
            'backColorDark1' =>$backColorDark1,
            'headerColorDark' =>$headerColorDark,
            'headerColor2Dark' =>$headerColor2Dark,
            'widgetColorDark' =>$widgetColorDark,
            'singleColorDark' =>$singleColorDark,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function messageIndex(){
        $messageAuth = Setting::where('key' , 'messageAuth')->pluck('value')->first();
        $messageSuccess = Setting::where('key' , 'messageSuccess')->pluck('value')->first();
        $messageSuggest = Setting::where('key' , 'messageSuggest')->pluck('value')->first();
        $messageCancel = Setting::where('key' , 'messageCancel')->pluck('value')->first();
        $messageBack = Setting::where('key' , 'messageBack')->pluck('value')->first();
        $messageManager = Setting::where('key' , 'messageManager')->pluck('value')->first();
        $messageCounseling = Setting::where('key' , 'messageCounseling')->pluck('value')->first();
        $messageStatus0 = Setting::where('key' , 'messageStatus0')->pluck('value')->first();
        $messageStatus1 = Setting::where('key' , 'messageStatus1')->pluck('value')->first();
        $messageStatus2 = Setting::where('key' , 'messageStatus2')->pluck('value')->first();
        $messageStatus3 = Setting::where('key' , 'messageStatus3')->pluck('value')->first();
        $messageTrack = Setting::where('key' , 'messageTrack')->pluck('value')->first();
        $userSms = Setting::where('key' , 'userSms')->pluck('value')->first();
        $passSms = Setting::where('key' , 'passSms')->pluck('value')->first();
        $kaveKey = Setting::where('key' , 'kaveKey')->pluck('value')->first();
        $typeSms = Setting::where('key' , 'smsType')->pluck('value')->first();
        $userFaraz = Setting::where('key' , 'userFaraz')->pluck('value')->first();
        $passFaraz = Setting::where('key' , 'passFaraz')->pluck('value')->first();
        $numberFaraz = Setting::where('key' , 'numberFaraz')->pluck('value')->first();
        $messageRegister = Setting::where('key' , 'messageRegister')->pluck('value')->first();
        return view('admin.setting.message' , compact('messageAuth','messageCounseling','messageTrack','messageRegister','messageStatus0','messageStatus1','messageStatus2','messageStatus3','userSms','passSms','kaveKey','userFaraz','passFaraz','numberFaraz','typeSms','messageSuccess','messageSuggest','messageCancel','messageBack','messageManager'));
    }

    public function messageUpdate(Request $request){
        $messageAuth = $request->messageAuth;
        $messageSuccess = $request->messageSuccess;
        $messageSuggest = $request->messageSuggest;
        $messageCancel = $request->messageCancel;
        $messageBack = $request->messageBack;
        $messageManager = $request->messageManager;
        $messageCounseling = $request->messageCounseling;
        $messageStatus0 = $request->messageStatus0;
        $messageStatus1 = $request->messageStatus1;
        $messageStatus2 = $request->messageStatus2;
        $messageStatus3 = $request->messageStatus3;
        $messageTrack = $request->messageTrack;
        $userSms = $request->userSms;
        $passSms = $request->passSms;
        $kaveKey = $request->kaveKey;
        $typeSms = $request->typeSms;
        $userFaraz = $request->userFaraz;
        $passFaraz = $request->passFaraz;
        $numberFaraz = $request->numberFaraz;
        $messageRegister = $request->messageRegister;
        $array = [
            'messageAuth' =>$messageAuth,
            'userFaraz' =>$userFaraz,
            'passFaraz' =>$passFaraz,
            'numberFaraz' =>$numberFaraz,
            'messageRegister' =>$messageRegister,
            'messageSuccess' =>$messageSuccess,
            'messageSuggest' =>$messageSuggest,
            'messageCancel' =>$messageCancel,
            'messageBack' =>$messageBack,
            'messageManager' =>$messageManager,
            'messageCounseling' =>$messageCounseling,
            'messageStatus0' =>$messageStatus0,
            'messageStatus1' =>$messageStatus1,
            'messageStatus2' =>$messageStatus2,
            'messageStatus3' =>$messageStatus3,
            'messageTrack' =>$messageTrack,
            'userSms' =>$userSms,
            'passSms' =>$passSms,
            'kaveKey' =>$kaveKey,
            'smsType' =>$typeSms,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function floatIndex(){
        $floats = FloatAccess::get();
        return view('admin.setting.float',compact('floats'));
    }

    public function scriptIndex(){
        $headScript = Setting::where('key' , 'headScript')->pluck('value')->first();
        $bodyScript = Setting::where('key' , 'bodyScript')->pluck('value')->first();
        return view('admin.setting.script',compact('headScript','bodyScript'));
    }

    public function scriptUpdate(Request $request){
        $headScript = $request->headScript;
        $bodyScript = $request->bodyScript;
        $array = [
            'headScript' => $headScript,
            'bodyScript' => $bodyScript,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function fileIndex(){
        $lightHomeCss = File::get($_SERVER['DOCUMENT_ROOT'].'/css/home.css');
        $darkHomeCss = File::get($_SERVER['DOCUMENT_ROOT'].'/css/dark-home.css');
        $adminCss = File::get($_SERVER['DOCUMENT_ROOT'].'/css/admin.css');
        $robot = File::get($_SERVER['DOCUMENT_ROOT'].'/robots.txt');
        $htaccess = File::get($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
        return view('admin.setting.file',compact('lightHomeCss','darkHomeCss','adminCss','robot','htaccess'));
    }

    public function fileUpdate(Request $request){
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/css/home.css',$request->lightHomeCss);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/css/dark-home.css',$request->darkHomeCss);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/css/admin.css',$request->adminCss);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/robots.txt',$request->robot);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess',$request->htaccess);
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }

    public function floatUpdate(Request $request){
        DB::table('float_accesses')->delete();
        foreach (json_decode($request->colors) as $item){
            FloatAccess::create([
                'title' => $item->title,
                'link' => $item->link,
                'icon' => $item->icon,
                'type' => $item->type,
            ]);
        }
        return 'success';
    }

    public function paymentIndex(){
        $zarinpal = Setting::where('key' , 'zarinpal')->pluck('value')->first();
        $zibal = Setting::where('key' , 'zibal')->pluck('value')->first();
        $idpay = Setting::where('key' , 'idpay')->pluck('value')->first();
        $nextpay = Setting::where('key' , 'nextpay')->pluck('value')->first();
        $merchantPasargad = Setting::where('key' , 'merchantPasargad')->pluck('value')->first();
        $terminalPasargad = Setting::where('key' , 'terminalPasargad')->pluck('value')->first();
        $certificatePasargad = Setting::where('key' , 'certificatePasargad')->pluck('value')->first();
        $terminalAsan = Setting::where('key' , 'terminalAsan')->pluck('value')->first();
        $userAsan = Setting::where('key' , 'userAsan')->pluck('value')->first();
        $passwordAsan = Setting::where('key' , 'passwordAsan')->pluck('value')->first();
        $terminalBeh = Setting::where('key' , 'terminalBeh')->pluck('value')->first();
        $userBeh = Setting::where('key' , 'userBeh')->pluck('value')->first();
        $passwordBeh = Setting::where('key' , 'passwordBeh')->pluck('value')->first();
        $keySadad = Setting::where('key' , 'keySadad')->pluck('value')->first();
        $merchantSadad = Setting::where('key' , 'merchantSadad')->pluck('value')->first();
        $terminalSadad = Setting::where('key' , 'terminalSadad')->pluck('value')->first();
        $choicePay = Setting::where('key' , 'choicePay')->pluck('value')->first();
        $spot = Setting::where('key' , 'spot')->pluck('value')->first();
        $installment = Setting::where('key' , 'installment')->pluck('value')->first();
        $gateway = Setting::where('key' , 'gateway')->pluck('value')->first();
        $card = Setting::where('key' , 'card')->pluck('value')->first();
        $zarinpalStatus = Setting::where('key' , 'zarinpalStatus')->pluck('value')->first();
        $zibalStatus = Setting::where('key' , 'zibalStatus')->pluck('value')->first();
        $nextpayStatus = Setting::where('key' , 'nextpayStatus')->pluck('value')->first();
        $idpayStatus = Setting::where('key' , 'idpayStatus')->pluck('value')->first();
        $statusBeh = Setting::where('key' , 'statusBeh')->pluck('value')->first();
        $statusSadad = Setting::where('key' , 'statusSadad')->pluck('value')->first();
        $statusAsan = Setting::where('key' , 'statusAsan')->pluck('value')->first();
        $statusPasargad = Setting::where('key' , 'statusPasargad')->pluck('value')->first();
        $cardText = Setting::where('key' , 'cardText')->pluck('value')->first();
        $samansep = Setting::where('key' , 'samansep')->pluck('value')->first();
        $statusSaman = Setting::where('key' , 'statusSaman')->pluck('value')->first();
        return view('admin.setting.payment' , compact('zarinpal','choicePay','merchantPasargad','samansep','statusSaman','terminalPasargad','certificatePasargad','statusPasargad','zarinpalStatus','statusAsan','terminalAsan','userAsan','passwordAsan','zibalStatus','nextpayStatus','idpayStatus','statusBeh','statusSadad','terminalBeh','userBeh','passwordBeh','keySadad','merchantSadad','terminalSadad','card','cardText','spot','installment','gateway','zibal','idpay','nextpay'));
    }

    public function paymentUpdate(Request $request){
        $zarinpal = $request->zarinpal;
        $zibal = $request->zibal;
        $idpay = $request->idpay;
        $nextpay = $request->nextpay;
        $terminalAsan = $request->terminalAsan;
        $userAsan = $request->userAsan;
        $passwordAsan = $request->passwordAsan;
        $terminalBeh = $request->terminalBeh;
        $userBeh = $request->userBeh;
        $passwordBeh = $request->passwordBeh;
        $keySadad = $request->keySadad;
        $merchantSadad = $request->merchantSadad;
        $terminalSadad = $request->terminalSadad;
        $merchantPasargad = $request->merchantPasargad;
        $terminalPasargad = $request->terminalPasargad;
        $certificatePasargad = $request->certificatePasargad;
        $choicePay = $request->choicePay;
        $cardText = $request->cardText;
        $samansep = $request->samansep;
        if ($request->gateway == 'on'){
            $gateway = 1;
        }else{
            $gateway = 0;
        }
        if ($request->spot == 'on'){
            $spot = 1;
        }else{
            $spot = 0;
        }
        if ($request->installment == 'on'){
            $installment = 1;
        }else{
            $installment = 0;
        }
        if ($request->card == 'on'){
            $card = 1;
        }else{
            $card = 0;
        }
        if ($request->zarinpalStatus == 'on'){
            $zarinpalStatus = 1;
        }else{
            $zarinpalStatus = 0;
        }
        if ($request->zibalStatus == 'on'){
            $zibalStatus = 1;
        }else{
            $zibalStatus = 0;
        }
        if ($request->nextpayStatus == 'on'){
            $nextpayStatus = 1;
        }else{
            $nextpayStatus = 0;
        }
        if ($request->idpayStatus == 'on'){
            $idpayStatus = 1;
        }else{
            $idpayStatus = 0;
        }
        if ($request->statusBeh == 'on'){
            $statusBeh = 1;
        }else{
            $statusBeh = 0;
        }
        if ($request->statusSadad == 'on'){
            $statusSadad = 1;
        }else{
            $statusSadad = 0;
        }
        if ($request->statusAsan == 'on'){
            $statusAsan = 1;
        }else{
            $statusAsan = 0;
        }
        if ($request->statusPasargad == 'on'){
            $statusPasargad = 1;
        }else{
            $statusPasargad = 0;
        }
        if ($request->statusSaman == 'on'){
            $statusSaman = 1;
        }else{
            $statusSaman = 0;
        }
        $array = [
            'zarinpal' =>$zarinpal,
            'zibal' =>$zibal,
            'idpay' =>$idpay,
            'nextpay' =>$nextpay,
            'terminalAsan' =>$terminalAsan,
            'userAsan' =>$userAsan,
            'passwordAsan' =>$passwordAsan,
            'terminalBeh' =>$terminalBeh,
            'userBeh' =>$userBeh,
            'passwordBeh' =>$passwordBeh,
            'keySadad' =>$keySadad,
            'merchantSadad' =>$merchantSadad,
            'terminalSadad' =>$terminalSadad,
            'merchantPasargad' =>$merchantPasargad,
            'terminalPasargad' =>$terminalPasargad,
            'certificatePasargad' =>$certificatePasargad,
            'statusPasargad' =>$statusPasargad,
            'choicePay' =>$choicePay,
            'spot' => $spot,
            'card' => $card,
            'zarinpalStatus' => $zarinpalStatus,
            'zibalStatus' => $zibalStatus,
            'nextpayStatus' => $nextpayStatus,
            'idpayStatus' => $idpayStatus,
            'statusBeh' => $statusBeh,
            'statusSadad' => $statusSadad,
            'statusAsan' => $statusAsan,
            'installment' => $installment,
            'gateway' => $gateway,
            'cardText' => $cardText,
            'samansep' => $samansep,
            'statusSaman' => $statusSaman,
        ];
        foreach ($array as $key=>$item){
            $setting = Setting::where('key' , $key)->first();
            if ($setting != ''){
                $setting->update([
                    'value'=>$item,
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => 'اطلاعات ثبت شد'
        ]);
    }
}
