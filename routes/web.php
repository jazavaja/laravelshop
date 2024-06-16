<?php

use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\BarcodeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CarrierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangeController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\ConverterController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GuaranteeController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LandController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LotteryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PackController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PayController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TankController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\VarietyController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LuckyController;
use App\Http\Controllers\Home\AddressController;
use App\Http\Controllers\Home\ArchiveController;
use App\Http\Controllers\Home\AuthController;
use App\Http\Controllers\Home\BecomeController;
use App\Http\Controllers\Home\BlogArchiveController;
use App\Http\Controllers\Home\BookmarkController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CommentController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\LikeController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Home\ReportController;
use App\Http\Controllers\Home\ShopController;
use App\Http\Controllers\Home\SingleController;
use App\Http\Controllers\Home\SitemapController;
use App\Http\Controllers\Home\ViewController;
use App\Http\Controllers\Home\GoogleController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'] , function (){
    Route::get('/', [PanelController::class , 'index'])->middleware(['permission:داشبورد']);
    Route::get('/learn', [PanelController::class , 'learn'])->middleware(['permission:داشبورد']);

    ////////////////////////////////// gallery
    Route::get('/gallery', [GalleryController::class , 'index'])->middleware(['permission:گالری']);
    Route::post('/upload-image', [GalleryController::class , 'upload'])->middleware(['permission:گالری']);
    Route::get('/get-image', [GalleryController::class , 'getImage'])->middleware(['permission:گالری']);
    Route::delete('/gallery/{gallery}/delete', [GalleryController::class , 'deleteImage'])->middleware(['permission:گالری']);

    //////// product
    Route::get('/product', [PostController::class , 'index'])->middleware(['permission:همه محصولات']);
    Route::post('/edit-products', [PostController::class , 'editGroup'])->middleware(['permission:همه محصولات']);
    Route::post('/update-products', [PostController::class , 'updateGroup'])->middleware(['permission:همه محصولات']);
    Route::post('/product/get-data', [PostController::class , 'getData'])->middleware(['permission:همه محصولات']);
    Route::get('/product/change', [PostController::class , 'change'])->middleware(['permission:همه محصولات']);
    Route::post('/product/change', [PostController::class , 'changeData'])->middleware(['permission:همه محصولات']);
    Route::delete('/product/{product}/delete', [PostController::class , 'delete'])->middleware(['permission:همه محصولات']);
    Route::put('/product/{product}/edit', [PostController::class , 'update'])->middleware(['permission:همه محصولات']);
    Route::get('/product/{product}/edit', [PostController::class , 'edit'])->middleware(['permission:همه محصولات']);
    Route::get('/product/{product}/show', [PostController::class , 'show'])->middleware(['permission:همه محصولات']);
    Route::get('/product/{product}/copy', [PostController::class , 'copy'])->middleware(['permission:همه محصولات']);
    Route::get('/product/create', [PostController::class , 'create'])->middleware(['permission:افزودن محصول']);
    Route::post('/product/create', [PostController::class , 'store'])->middleware(['permission:افزودن محصول']);

    //////// tank
    Route::get('/tank', [TankController::class , 'index'])->middleware(['permission:وضعیت موجودی']);
    Route::post('/tank', [TankController::class , 'store'])->middleware(['permission:وضعیت موجودی']);
    Route::delete('/tank/{tank}/delete', [TankController::class , 'delete'])->middleware(['permission:وضعیت موجودی']);
    Route::get('/tank/{tank}/edit', [TankController::class , 'edit'])->middleware(['permission:وضعیت موجودی']);
    Route::post('/tank/{tank}/edit', [TankController::class , 'update'])->middleware(['permission:وضعیت موجودی']);
    Route::post('/add-tank', [TankController::class , 'addTank'])->middleware(['permission:وضعیت موجودی']);
    Route::post('/tank/add-detail', [TankController::class , 'addDetail'])->middleware(['permission:وضعیت موجودی']);

    ///////////////////// collection
    Route::get('/collection', [CollectionController::class , 'create'])->middleware(['permission:افزودن محصول']);
    Route::post('/collection', [CollectionController::class , 'store'])->middleware(['permission:افزودن محصول']);
    Route::get('/collection/{collection}/edit', [CollectionController::class , 'edit'])->middleware(['permission:افزودن محصول']);
    Route::put('/collection/{collection}/edit', [CollectionController::class , 'update'])->middleware(['permission:افزودن محصول']);
    Route::delete('/collection/{collection}/delete', [CollectionController::class , 'delete'])->middleware(['permission:افزودن محصول']);

    ////////////////////// compare
    Route::get('/compare-product', [\App\Http\Controllers\Admin\CompareController::class , 'create'])->middleware(['permission:افزودن محصول']);
    Route::post('/compare-product', [\App\Http\Controllers\Admin\CompareController::class , 'store'])->middleware(['permission:افزودن محصول']);
    Route::get('/compare-product/{compareProduct}/edit', [\App\Http\Controllers\Admin\CompareController::class , 'edit'])->middleware(['permission:افزودن محصول']);
    Route::put('/compare-product/{compareProduct}/edit', [\App\Http\Controllers\Admin\CompareController::class , 'update'])->middleware(['permission:افزودن محصول']);
    Route::delete('/compare-product/{compareProduct}/delete', [\App\Http\Controllers\Admin\CompareController::class , 'delete'])->middleware(['permission:افزودن محصول']);

    //////// blog
    Route::get('/blog', [NewsController::class , 'index'])->middleware(['permission:همه بلاگ ها']);
    Route::delete('/blog/{news}/delete', [NewsController::class , 'delete'])->middleware(['permission:همه بلاگ ها']);
    Route::put('/blog/{news}/edit', [NewsController::class , 'update'])->middleware(['permission:همه بلاگ ها']);
    Route::get('/blog/{news}/edit', [NewsController::class , 'edit'])->middleware(['permission:همه بلاگ ها']);
    Route::get('/blog/{news}/show', [NewsController::class , 'show'])->middleware(['permission:همه بلاگ ها']);
    Route::get('/blog/create', [NewsController::class , 'create'])->middleware(['permission:افزودن بلاگ']);
    Route::post('/blog/create', [NewsController::class , 'store'])->middleware(['permission:افزودن بلاگ']);

    //////// page
    Route::get('/page', [PageController::class , 'index'])->middleware(['permission:برگه ها']);
    Route::delete('/page/{page}/delete', [PageController::class , 'delete'])->middleware(['permission:برگه ها']);
    Route::put('/page/{page}/edit', [PageController::class , 'update'])->middleware(['permission:برگه ها']);
    Route::get('/page/{page}/edit', [PageController::class , 'edit'])->middleware(['permission:برگه ها']);
    Route::get('/page/create', [PageController::class , 'create'])->middleware(['permission:برگه ها']);
    Route::post('/page/create', [PageController::class , 'store'])->middleware(['permission:برگه ها']);

    //////// ask
    Route::get('/ask', [AskController::class , 'index'])->middleware(['permission:برگه ها']);
    Route::delete('/ask/{ask}/delete', [AskController::class , 'delete'])->middleware(['permission:برگه ها']);
    Route::put('/ask/{ask}/edit', [AskController::class , 'update'])->middleware(['permission:برگه ها']);
    Route::get('/ask/{ask}/edit', [AskController::class , 'edit'])->middleware(['permission:برگه ها']);
    Route::get('/ask/create', [AskController::class , 'create'])->middleware(['permission:برگه ها']);
    Route::post('/ask/create', [AskController::class , 'store'])->middleware(['permission:برگه ها']);

    //// brand
    Route::get('/brand', [BrandController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/brand', [BrandController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/brand/{brand}/edit', [BrandController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/brand/{brand}/edit', [BrandController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/brand/{brand}/delete', [BrandController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/brand/{brand}/show', [BrandController::class , 'show'])->middleware(['permission:تاکسونامی']);

    /////// barcode
    Route::get('/barcode', [BarcodeController::class , 'index'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/barcode', [BarcodeController::class , 'store'])->middleware(['permission:تنظیمات سایت']);

    //// category
    Route::get('/category', [CategoryController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/category', [CategoryController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/category/{category}/edit', [CategoryController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/category/{category}/edit', [CategoryController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/category/{category}/delete', [CategoryController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/category/{category}/show', [CategoryController::class , 'show'])->middleware(['permission:تاکسونامی']);

    /////////////////////////////////////// comment
    Route::get('/comment',  [App\Http\Controllers\Admin\CommentController::class, 'index'])->middleware(['permission:دیدگاه']);
    Route::get('/comment/{comment}/edit',  [App\Http\Controllers\Admin\CommentController::class, 'edit'])->middleware(['permission:دیدگاه']);
    Route::post('/comment/{comment}/edit',  [App\Http\Controllers\Admin\CommentController::class, 'update'])->middleware(['permission:دیدگاه']);
    Route::delete('/comment/{comment}/delete',  [App\Http\Controllers\Admin\CommentController::class, 'delete'])->middleware(['permission:دیدگاه']);

    //// tag
    Route::get('/tag', [TagController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/tag', [TagController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/tag/{tag}/edit', [TagController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/tag/{tag}/edit', [TagController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/tag/{tag}/delete', [TagController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/tag/{tag}/show', [TagController::class , 'show'])->middleware(['permission:تاکسونامی']);

    //// guarantee
    Route::get('/guarantee', [GuaranteeController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/guarantee', [GuaranteeController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/guarantee/{guarantee}/edit', [GuaranteeController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/guarantee/{guarantee}/edit', [GuaranteeController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/guarantee/{guarantee}/delete', [GuaranteeController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/guarantee/{guarantee}/show', [GuaranteeController::class , 'show'])->middleware(['permission:تاکسونامی']);

    //// inventory
    Route::get('/inventory', [InventoryController::class , 'index'])->middleware(['permission:وضعیت موجودی']);
    Route::get('/empty', [InventoryController::class , 'empty'])->middleware(['permission:وضعیت موجودی']);
    Route::get('/inquiry', [InventoryController::class , 'inquiry'])->middleware(['permission:وضعیت موجودی']);
    Route::post('/inquiry/change', [InventoryController::class , 'inquiryChange'])->middleware(['permission:وضعیت موجودی']);

    //// time
    Route::get('/time', [TimeController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/time', [TimeController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/time/{time}/edit', [TimeController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/time/{time}/edit', [TimeController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/time/{time}/delete', [TimeController::class , 'delete'])->middleware(['permission:تاکسونامی']);

    //// role
    Route::get('/role', [RoleController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/role', [RoleController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/role/{role}/edit', [RoleController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/role/{role}/edit', [RoleController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/role/{role}/delete', [RoleController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/role/{role}/show', [RoleController::class , 'show'])->middleware(['permission:تاکسونامی']);

    //// converter
    Route::get('/converter', [ConverterController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/converter', [ConverterController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/converter/{converter}/edit', [ConverterController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/converter/{converter}/edit', [ConverterController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/converter/{converter}/delete', [ConverterController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::get('/converter/{converter}/show', [ConverterController::class , 'show'])->middleware(['permission:تاکسونامی']);

    //// carrier
    Route::get('/carrier', [CarrierController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/carrier', [CarrierController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::get('/carrier/{carrier}/edit', [CarrierController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::put('/carrier/{carrier}/edit', [CarrierController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::delete('/carrier/{carrier}/delete', [CarrierController::class , 'delete'])->middleware(['permission:تاکسونامی']);

    //// link
    Route::get('/link', [LinkController::class , 'index'])->middleware(['permission:لینک هدر']);
    Route::post('/link', [LinkController::class , 'store'])->middleware(['permission:لینک هدر']);
    Route::get('/link/{link}/edit', [LinkController::class , 'edit'])->middleware(['permission:لینک هدر']);
    Route::put('/link/{link}/edit', [LinkController::class , 'update'])->middleware(['permission:لینک هدر']);
    Route::delete('/link/{link}/delete', [LinkController::class , 'delete'])->middleware(['permission:لینک هدر']);

    //// link
    Route::get('/lucky', [LuckyController::class , 'index'])->middleware(['permission:گردانه شانس']);
    Route::post('/lucky', [LuckyController::class , 'store'])->middleware(['permission:گردانه شانس']);
    Route::get('/lucky/{lucky}/edit', [LuckyController::class , 'edit'])->middleware(['permission:گردانه شانس']);
    Route::put('/lucky/{lucky}/edit', [LuckyController::class , 'update'])->middleware(['permission:گردانه شانس']);
    Route::delete('/lucky/{lucky}/delete', [LuckyController::class , 'delete'])->middleware(['permission:گردانه شانس']);

    //// loan
    Route::get('/loan', [LoanController::class , 'index'])->middleware(['permission:وام']);
    Route::post('/get-loan', [LoanController::class , 'getLoan'])->middleware(['permission:وام']);
    Route::post('/loan/{loan}/edit', [LoanController::class , 'edit'])->middleware(['permission:وام']);

    //// currency
    Route::get('/currency', [CurrencyController::class , 'index'])->middleware(['permission:ارز']);
    Route::post('/currency', [CurrencyController::class , 'store'])->middleware(['permission:ارز']);
    Route::get('/currency/{currency}/edit', [CurrencyController::class , 'edit'])->middleware(['permission:ارز']);
    Route::put('/currency/{currency}/edit', [CurrencyController::class , 'update'])->middleware(['permission:ارز']);
    Route::delete('/currency/{currency}/delete', [CurrencyController::class , 'delete'])->middleware(['permission:ارز']);

    //// pack
    Route::get('/pack', [PackController::class , 'index'])->middleware(['permission:شرایط اقساط']);
    Route::post('/pack', [PackController::class , 'store'])->middleware(['permission:شرایط اقساط']);
    Route::get('/pack/{pack}/edit', [PackController::class , 'edit'])->middleware(['permission:شرایط اقساط']);
    Route::get('/pack/{pack}/show', [PackController::class , 'show'])->middleware(['permission:شرایط اقساط']);
    Route::put('/pack/{pack}/edit', [PackController::class , 'update'])->middleware(['permission:شرایط اقساط']);
    Route::delete('/pack/{pack}/delete', [PackController::class , 'delete'])->middleware(['permission:شرایط اقساط']);

    //// pay
    Route::get('/pay', [PayController::class , 'index'])->middleware(['permission:همه سفارشات']);
    Route::get('/pay/create', [PayController::class , 'create'])->middleware(['permission:همه سفارشات']);
    Route::post('/pay/create', [PayController::class , 'createP'])->middleware(['permission:همه سفارشات']);
    Route::get('/pay/returned', [PayController::class , 'returned'])->middleware(['permission:همه سفارشات']);
    Route::get('/pay/{pay}', [PayController::class , 'edit'])->middleware(['permission:ویرایش سفارش']);
    Route::put('/pay/{pay}', [PayController::class , 'update'])->middleware(['permission:ویرایش سفارش']);
    Route::post('/add-pay/{pay}', [PayController::class , 'addPay'])->middleware(['permission:ویرایش سفارش']);
    Route::put('/delete-pay/{pay_meta}', [PayController::class , 'deleteMeta'])->middleware(['permission:ویرایش سفارش']);
    Route::get('/pay/invoice/{pay}', [PayController::class , 'invoice'])->middleware(['permission:همه سفارشات']);
    Route::delete('/pay/{pay}/delete', [PayController::class , 'delete'])->middleware(['permission:همه سفارشات']);
    Route::get('/pay/print/{pay}', [PayController::class , 'print'])->middleware(['permission:همه سفارشات']);
    Route::get('/invoice/group', [PayController::class , 'group'])->middleware(['permission:همه سفارشات']);

    //// cost
    Route::get('/cost', [CostController::class , 'index'])->middleware(['permission:همه سفارشات']);
    Route::get('/cost/create', [CostController::class , 'create'])->middleware(['permission:همه سفارشات']);
    Route::post('/cost/create', [CostController::class , 'store'])->middleware(['permission:همه سفارشات']);
    Route::get('/cost-benefit', [CostController::class , 'statistics'])->middleware(['permission:همه سفارشات']);

    ///////////////// chart
    Route::get('/chart', [PayController::class , 'chart'])->middleware(['permission:آمارگیری']);
    Route::get('/statistics/product', [PayController::class , 'statisticsProduct'])->middleware(['permission:آمارگیری']);

    ///////////////// document
    Route::get('/document', [App\Http\Controllers\Admin\SellerController::class , 'document'])->middleware(['permission:بررسی فروشنده']);
    Route::get('/document/{document}/edit', [App\Http\Controllers\Admin\SellerController::class , 'edit'])->middleware(['permission:بررسی فروشنده']);
    Route::post('/document/{document}/edit', [App\Http\Controllers\Admin\SellerController::class , 'update'])->middleware(['permission:بررسی فروشنده']);
    Route::delete('/document/{document}/delete', [App\Http\Controllers\Admin\SellerController::class , 'deleteDoc'])->middleware(['permission:بررسی فروشنده']);

    ///////////////// seller
    Route::get('/sellers', [App\Http\Controllers\Admin\SellerController::class , 'index'])->middleware(['permission:بررسی فروشنده']);
    Route::delete('/sellers/{user}/delete', [App\Http\Controllers\Admin\SellerController::class , 'delete'])->middleware(['permission:بررسی فروشنده']);

    ///////////////// variety
    Route::get('/variety', [VarietyController::class , 'index'])->middleware(['permission:تنوع ها']);
    Route::get('/variety/{product}/edit', [VarietyController::class , 'edit'])->middleware(['permission:تنوع ها']);
    Route::put('/variety/{product}/edit', [VarietyController::class , 'update'])->middleware(['permission:تنوع ها']);
    Route::delete('/variety/{product}/delete', [VarietyController::class , 'delete'])->middleware(['permission:تنوع ها']);

    //// user
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class , 'index'])->middleware(['permission:همه سفارشات']);
    Route::get('/user/create', [\App\Http\Controllers\Admin\UserController::class , 'create'])->middleware(['permission:ویرایش سفارش']);
    Route::post('/user/create', [\App\Http\Controllers\Admin\UserController::class , 'store'])->middleware(['permission:ویرایش سفارش']);
    Route::get('/user/{user}/edit', [\App\Http\Controllers\Admin\UserController::class , 'edit'])->middleware(['permission:ویرایش سفارش']);
    Route::put('/user/{user}/edit', [\App\Http\Controllers\Admin\UserController::class , 'update'])->middleware(['permission:ویرایش سفارش']);
    Route::delete('/user/{user}/delete', [\App\Http\Controllers\Admin\UserController::class , 'delete'])->middleware(['permission:همه سفارشات']);

    //// discount
    Route::get('/discount', [DiscountController::class , 'index'])->middleware(['permission:کد تخفیف']);
    Route::post('/discount', [DiscountController::class , 'store'])->middleware(['permission:کد تخفیف']);
    Route::get('/discount/{discount}/edit', [DiscountController::class , 'edit'])->middleware(['permission:کد تخفیف']);
    Route::put('/discount/{discount}/edit', [DiscountController::class , 'update'])->middleware(['permission:کد تخفیف']);
    Route::delete('/discount/{discount}/delete', [DiscountController::class , 'delete'])->middleware(['permission:کد تخفیف']);

    //// widget
    Route::get('/widget', [WidgetController::class , 'index'])->middleware(['permission:ویجت']);
    Route::get('/widget/mobile', [WidgetController::class , 'mobileIndex'])->middleware(['permission:ویجت']);
    Route::post('/widget', [WidgetController::class , 'change'])->middleware(['permission:ویجت']);
    Route::get('/widget/create', [WidgetController::class , 'create'])->middleware(['permission:ویجت']);
    Route::post('/widget/create', [WidgetController::class , 'store'])->middleware(['permission:ویجت']);
    Route::get('/widget/{widget}/edit', [WidgetController::class , 'edit'])->middleware(['permission:ویجت']);
    Route::put('/widget/{widget}/edit', [WidgetController::class , 'update'])->middleware(['permission:ویجت']);
    Route::delete('/widget/{widget}/delete', [WidgetController::class , 'delete'])->middleware(['permission:ویجت']);

    //// setting
    Route::get('/setting/category', [SettingController::class , 'categoryIndex'])->middleware(['permission:تنظیمات دسته بندی']);
    Route::post('/setting/category', [SettingController::class , 'categoryUpdate'])->middleware(['permission:تنظیمات دسته بندی']);
    Route::get('/setting/manage', [SettingController::class , 'manageIndex'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/setting/manage', [SettingController::class , 'manageUpdate'])->middleware(['permission:تنظیمات سایت']);
    Route::get('/setting/seo', [SettingController::class , 'seoIndex'])->middleware(['permission:تنظیمات سئو']);
    Route::post('/setting/seo', [SettingController::class , 'seoUpdate'])->middleware(['permission:تنظیمات سئو']);
    Route::get('/setting/payment', [SettingController::class , 'paymentIndex'])->middleware(['permission:تنظیمات پرداخت']);
    Route::post('/setting/payment', [SettingController::class , 'paymentUpdate'])->middleware(['permission:تنظیمات پرداخت']);
    Route::post('/setting/ads-header', [SettingController::class , 'adsHeader'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/setting/pop-up', [SettingController::class , 'popUp'])->middleware(['permission:تنظیمات سایت']);
    Route::get('/setting/message', [SettingController::class , 'messageIndex'])->middleware(['permission:تنظیمات پیامک']);
    Route::post('/setting/message', [SettingController::class , 'messageUpdate'])->middleware(['permission:تنظیمات پیامک']);
    Route::get('/setting/float', [SettingController::class , 'floatIndex'])->middleware(['permission:تنظیمات شناور']);
    Route::post('/setting/float', [SettingController::class , 'floatUpdate'])->middleware(['permission:تنظیمات شناور']);
    Route::get('/setting/script', [SettingController::class , 'scriptIndex'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/setting/script', [SettingController::class , 'scriptUpdate'])->middleware(['permission:تنظیمات سایت']);
    Route::get('/setting/file', [SettingController::class , 'fileIndex'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/setting/file', [SettingController::class , 'fileUpdate'])->middleware(['permission:تنظیمات سایت']);
    Route::get('/setting/theme', [SettingController::class , 'themeIndex'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/setting/theme', [SettingController::class , 'themeUpdate'])->middleware(['permission:تنظیمات سایت']);


    ///////////////////////////////////////// land
    Route::get('/land', [LandController::class , 'index'])->middleware(['permission:برگه ها']);
    Route::get('/land/create', [LandController::class , 'create'])->middleware(['permission:برگه ها']);
    Route::post('/land/create', [LandController::class , 'store'])->middleware(['permission:برگه ها']);
    Route::get('/land/{land}/edit', [LandController::class , 'edit'])->middleware(['permission:برگه ها']);
    Route::post('/land/{land}/edit', [LandController::class , 'update'])->middleware(['permission:برگه ها']);
    Route::delete('/land/{land}/delete', [LandController::class , 'delete'])->middleware(['permission:برگه ها']);

    ///////////////////////////////////////// excel
    Route::get('/excel',  [ExcelController::class, 'index'])->middleware(['permission:خروجی اکسل']);
    Route::get('/import',  [ExcelController::class, 'import'])->middleware(['permission:خروجی اکسل']);
    Route::post('/import-user',  [ExcelController::class, 'import_user'])->middleware(['permission:خروجی اکسل']);
    Route::post('/import-blog',  [ExcelController::class, 'import_blog'])->middleware(['permission:خروجی اکسل']);
    Route::post('/import-product',  [ExcelController::class, 'import_product'])->middleware(['permission:خروجی اکسل']);
    Route::get('/get-excel/{data}',  [ExcelController::class, 'getExcel'])->middleware(['permission:خروجی اکسل']);

    ///////////////////////////////////////// wallet
    Route::get('/wallet',  [WalletController::class, 'index'])->middleware(['permission:کیف پول']);
    Route::post('/wallet',  [WalletController::class, 'store'])->middleware(['permission:کیف پول']);
    Route::get('/wallet/{wallet}/edit',  [WalletController::class, 'edit'])->middleware(['permission:کیف پول']);
    Route::put('/wallet/{wallet}/edit',  [WalletController::class, 'update'])->middleware(['permission:کیف پول']);
    Route::delete('/wallet/{wallet}/delete',  [WalletController::class, 'delete'])->middleware(['permission:کیف پول']);

    ///////////////////////////////////////// change price
    Route::get('/change-price/excel',  [ChangeController::class, 'excel'])->middleware(['permission:تغییر قیمت']);
    Route::get('/change-price/increase',  [ChangeController::class, 'increase'])->middleware(['permission:تغییر قیمت']);
    Route::post('/change-price/increase',  [ChangeController::class, 'increasePrice'])->middleware(['permission:تغییر قیمت']);
    Route::get('/change-price/decrease',  [ChangeController::class, 'decrease'])->middleware(['permission:تغییر قیمت']);
    Route::post('/change-price/decrease',  [ChangeController::class, 'decreasePrice'])->middleware(['permission:تغییر قیمت']);
    Route::post('/change-price/excel',  [ChangeController::class, 'changePriceExcel'])->middleware(['permission:تغییر قیمت']);

    ///////////////////////////////////////// ticket
    Route::get('/ticket',  [\App\Http\Controllers\Admin\TicketController::class, 'index'])->middleware(['permission:درخواست ها']);
    Route::delete('/ticket/{ticket}/delete',  [\App\Http\Controllers\Admin\TicketController::class, 'remove'])->middleware(['permission:درخواست ها']);
    Route::post('/ticket/{ticket}/edit',  [\App\Http\Controllers\Admin\TicketController::class, 'edit'])->middleware(['permission:درخواست ها']);

    ///////////////////////////////////////// lottery
    Route::get('/lottery',  [LotteryController::class, 'index'])->middleware(['permission:قرعه کشی']);
    Route::delete('/lottery/{lottery}/delete',  [LotteryController::class, 'remove'])->middleware(['permission:قرعه کشی']);
    Route::get('/lottery/{lottery}/edit',  [LotteryController::class, 'edit'])->middleware(['permission:قرعه کشی']);
    Route::put('/lottery/{lottery}/edit',  [LotteryController::class, 'update'])->middleware(['permission:قرعه کشی']);
    Route::get('/lottery/code',  [LotteryController::class, 'code'])->middleware(['permission:قرعه کشی']);

    ///// field
    Route::group(['prefix' => 'field'] , function () {
        Route::get('/', [FieldController::class, 'index'])->middleware(['permission:فیلد های سفارشی']);
        Route::post('/', [FieldController::class, 'store'])->middleware(['permission:فیلد های سفارشی']);
        Route::get('/{field}/edit', [FieldController::class, 'edit'])->middleware(['permission:فیلد های سفارشی']);
        Route::post('/{field}/edit', [FieldController::class, 'update'])->middleware(['permission:فیلد های سفارشی']);
        Route::delete('/{field}/delete', [FieldController::class, 'delete'])->middleware(['permission:فیلد های سفارشی']);
    });

    ///// event
    Route::group(['prefix' => 'event'] , function () {
        Route::get('/', [EventController::class, 'parent'])->middleware(['permission:فعالیت ها']);
        Route::post('/', [EventController::class, 'store'])->middleware(['permission:فعالیت ها']);
        Route::get('/{event}/edit', [EventController::class, 'edit'])->middleware(['permission:فعالیت ها']);
        Route::put('/{event}/edit', [EventController::class, 'update'])->middleware(['permission:فعالیت ها']);
        Route::delete('/{event}/delete', [EventController::class, 'delete'])->middleware(['permission:فعالیت ها']);
    });

    ///// notification
    Route::group(['prefix' => 'notification'] , function () {
        Route::get('/sms', [EventController::class, 'sms'])->middleware(['permission:فعالیت ها']);
        Route::post('/sms', [EventController::class, 'smsStore'])->middleware(['permission:فعالیت ها']);
        Route::get('/email', [EventController::class, 'email'])->middleware(['permission:فعالیت ها']);
        Route::post('/email', [EventController::class, 'emailStore'])->middleware(['permission:فعالیت ها']);
    });

    ///// subscribe
    Route::group(['prefix' => 'subscribe'] , function () {
        Route::get('/', [EventController::class, 'subscribe'])->middleware(['permission:فعالیت ها']);
        Route::post('/', [EventController::class, 'subscribeStore'])->middleware(['permission:فعالیت ها']);
        Route::delete('/{subscribe}/delete', [EventController::class, 'subscribeDelete'])->middleware(['permission:فعالیت ها']);
    });

    ///////////////////////////////////////// counseling
    Route::get('/counseling',  [\App\Http\Controllers\Admin\TicketController::class, 'counselingIndex'])->middleware(['permission:درخواست ها']);
    Route::delete('/counseling/{counseling}/delete',  [\App\Http\Controllers\Admin\TicketController::class, 'counselingRemove'])->middleware(['permission:درخواست ها']);
    Route::post('/counseling/{counseling}/edit',  [\App\Http\Controllers\Admin\TicketController::class, 'counselingEdit'])->middleware(['permission:درخواست ها']);
});

Route::group(['prefix' => '/'] , function (){
    Route::get('/', [IndexController::class , 'index']);
    Route::post('/change-lang', [IndexController::class , 'changeLang']);
    Route::post('/send-sub', [IndexController::class , 'sendSub']);
    Route::post('/send-ticket', [IndexController::class , 'sendTicket']);
    Route::post('/quick-buy', [IndexController::class , 'quickBuy']);
    Route::post('/check-quick-buy', [IndexController::class , 'checkQuickBuy']);
    Route::post('/send-counseling', [IndexController::class , 'sendCounseling']);
    Route::post('/search', [IndexController::class , 'search']);
    Route::post('/search-advance', [IndexController::class , 'searchAdvance']);
    Route::get('/order-tracking', [IndexController::class , 'orderTracking']);
    Route::post('/get-order-fast', [IndexController::class , 'getOrder']);
    Route::get('/show-pay-fast', [IndexController::class , 'showPayFast']);
    Route::get('/gift', [IndexController::class , 'gift']);
    Route::post('/gift', [IndexController::class , 'getGift']);
    Route::post('/loan-record', [IndexController::class , 'loanRecord']);
    Route::post('/help-search', [IndexController::class , 'helpSearch']);
    Route::get('/faq', [IndexController::class , 'faq']);
    Route::get('/landing/{LandingSlug}', [IndexController::class , 'landing']);
    Route::get('/direct-payment', [IndexController::class , 'direct']);

    //////////////// ticket
    Route::get('/request-product', [\App\Http\Controllers\Home\TicketController::class , 'index']);
    Route::post('/request-product', [\App\Http\Controllers\Home\TicketController::class , 'store']);

    //////////////// seller
    Route::get('/become-seller', [BecomeController::class , 'becomeSeller'])->middleware(['auth']);
    Route::post('/become-seller', [BecomeController::class , 'level1'])->middleware(['auth']);
    Route::post('/send-document', [BecomeController::class , 'sendDocument'])->middleware(['auth']);

    Route::post('/send-comment', [CommentController::class , 'sendComment']);
    Route::get('/get-comment/{ProductSlug}', [CommentController::class , 'getComment']);
    Route::post('/like', [LikeController::class , 'store']);
    Route::post('/bookmark', [BookmarkController::class , 'store']);

    //////////////////////// lucky
    Route::get('/lucky', [IndexController::class , 'lucky']);
    Route::post('/lucky', [IndexController::class , 'luckyStore']);

    //////////////////////// compare
    Route::get('/compare', [CompareController::class , 'index']);
    Route::post('/get-compare', [CompareController::class , 'getCompare']);

    /////////////////// single
    Route::get('/product/{ProductSlug}', [SingleController::class , 'single']);
    Route::get('/productID/{ProductID}', [SingleController::class , 'single']);
    Route::get('/pack/{CollectionSlug}', [SingleController::class , 'pack']);
    Route::get('/blog/{BlogSlug}', [SingleController::class , 'blog']);

    /////////////////// page
    Route::get('/page/{PageSlug}', [IndexController::class , 'page']);

    ///////////////////////////////////////////////////// report
    Route::post('/send-report',  [ReportController::class, 'sendReport']);

    ///////////////////////////////////////////////////// auth
    Route::get('/login', [AuthController::class , 'login'])->name('login');
    Route::get('/register', [AuthController::class , 'login'])->name('register');
    Route::post('/check-auth', [AuthController::class , 'checkAuth']);
    Route::post('/check-code', [AuthController::class , 'checkCode']);
    Route::post('/add-user', [AuthController::class , 'addUser']);
    Route::post('/enter-auth', [AuthController::class , 'enterAuth']);
    Route::post('/change-password', [AuthController::class , 'changePassword']);
    Route::post('/check-pass-code', [AuthController::class , 'checkPassCode']);
    Route::post('/change-user-password', [AuthController::class , 'changeUserPassword']);
    Route::post('/send-login-code', [AuthController::class , 'sendCode']);
    Route::post('/check-code-login', [AuthController::class , 'checkCode2']);

    ///////////////////////////////////////////////////// archive Product
    Route::get('/category/{CategorySlug}', [ArchiveController::class , 'category']);
    Route::get('/change/category/{CategorySlug}', [ArchiveController::class , 'categoryChange']);
    Route::get('/tag/{TagSlug}', [ArchiveController::class , 'tag']);
    Route::get('/change/tag/{TagSlug}', [ArchiveController::class , 'tagChange']);
    Route::get('/brand/{BrandSlug}', [ArchiveController::class , 'brand']);
    Route::get('/change/brand/{BrandSlug}', [ArchiveController::class , 'brandChange']);
    Route::get('/search', [ArchiveController::class , 'search']);
    Route::get('/change/search', [ArchiveController::class , 'searchChange']);
    Route::get('/archive/{WidgetSlug}', [ArchiveController::class , 'archive']);
    Route::get('/change/archive/{WidgetSlug}', [ArchiveController::class , 'archiveChange']);
    Route::get('/mall/{SellerSlug}', [ArchiveController::class , 'mall']);
    Route::get('/change/mall/{SellerSlug}', [ArchiveController::class , 'mallChange']);
    Route::get('/categories', [ArchiveController::class , 'categories']);

    //////////////////////// cart
    Route::post('/add-cart', [CartController::class , 'addCart']);
    Route::post('/add-pack', [CartController::class , 'addPack']);
    Route::post('/add-cart-fast', [CartController::class , 'addCartFast']);
    Route::post('/add-cart-fast2', [CartController::class , 'addCartFast2']);
    Route::post('/delete-cart', [CartController::class , 'deleteCart']);
    Route::get('/cart/next', [CartController::class , 'nextCartIndex']);
    Route::post('/all-back-cart', [CartController::class , 'allBackCart']);
    Route::post('/next-cart', [CartController::class , 'nextCart']);
    Route::post('/back-cart', [CartController::class , 'backCart']);
    Route::get('/get-cart', [CartController::class , 'getCart']);
    Route::get('/cart', [CartController::class , 'index']);
    Route::get('/checkout', [CartController::class , 'checkout'])->middleware(['auth']);
    Route::post('/change-cart', [CartController::class , 'change']);
    Route::get('/check-discount-cart',  [CartController::class, 'checkDiscount']);

    Route::feeds();
    ///////////////////////////////////////////////////// sitemap
    Route::get('/sitemap' , [SitemapController::class , 'index']);

    ///////////////////////////////////////////////////// archive blog
    Route::get('/blog/category/{BlogCategory}', [BlogArchiveController::class , 'category']);
    Route::get('/blog/tag/{BlogTag}', [BlogArchiveController::class , 'tag']);
    Route::get('/blogs', [BlogArchiveController::class , 'blogs']);
    Route::post('/view', [ViewController::class , 'view']);

    ///////////////////////////////////////////////////// address
    Route::post('/add-address',  [AddressController::class, 'create'])->middleware(['web', 'auth']);
    Route::post('/select-address',  [AddressController::class, 'selectAddress'])->middleware(['web', 'auth']);
    Route::delete('/delete-address',  [AddressController::class, 'deleteAddress'])->middleware(['web', 'auth']);
    Route::post('/edit-address',  [AddressController::class, 'editUserAddress'])->middleware(['web', 'auth']);

    ///////////////////////////////////////////////////// shop
    Route::get('/installments-shop',  [ShopController::class, 'installments'])->middleware(['web', 'auth']);
    /// order
    Route::match(['get','post'],'/order',  [ShopController::class, 'order'])->middleware(['web', 'auth']);
    Route::get('/shop',  [ShopController::class, 'add_order'])->middleware(['web', 'auth']);
    /// fast
    Route::match(['get','post'],'/fast',  [ShopController::class, 'fast']);
    Route::get('/fast-shop',  [ShopController::class, 'fast_order']);
    /// spot
    Route::get('/payment-spot',  [ShopController::class, 'paymentSpot'])->middleware(['web', 'auth']);
    Route::match(['get','post'],'/spot/order',  [ShopController::class, 'spotOrder'])->middleware(['web', 'auth']);
    ///wallet
    Route::get('/wallet-shop',  [ShopController::class, 'shopWallet'])->middleware(['web', 'auth']);
    Route::get('/card-by-card',  [ShopController::class, 'card'])->middleware(['web', 'auth']);
    ///quick
    Route::get('/quick-buy',  [ShopController::class, 'quickBuy']);
    Route::match(['post','get'],'/quick/order',  [ShopController::class, 'quickOrder']);
    /// direct
    Route::post('/direct-order', [ShopController::class , 'direct']);
    Route::match(['post','get'],'/direct-shop', [ShopController::class , 'direct_order']);

    //////////////////// charge
    Route::get('/charge/shop',  [App\Http\Controllers\Home\ChargeController::class, 'addCharge']);
    Route::match(['post','get'],'/charge/order',  [App\Http\Controllers\Home\ChargeController::class, 'chargeOrder']);

    ///////////////////////////////////////////////////// user
    Route::get('/logout',  [ProfileController::class, 'logout'])->middleware(['web', 'auth']);
    Route::put('/change-user-info',  [ProfileController::class, 'ChangeUserInfo'])->middleware(['web', 'auth']);
    Route::get('/profile',  [ProfileController::class, 'profile'])->middleware(['web', 'auth']);
    Route::get('/profile/pay',  [ProfileController::class, 'pay'])->middleware(['web', 'auth']);
    Route::get('/profile/like',  [ProfileController::class, 'like'])->middleware(['web', 'auth']);
    Route::get('/profile/bookmark',  [ProfileController::class, 'bookmark'])->middleware(['web', 'auth']);
    Route::get('/profile/comment',  [ProfileController::class, 'comment'])->middleware(['web', 'auth']);
    Route::get('/profile/ticket',  [ProfileController::class, 'ticket'])->middleware(['web', 'auth']);
    Route::get('/profile/counseling',  [ProfileController::class, 'counseling'])->middleware(['web', 'auth']);
    Route::get('/profile/counseling/{counseling}/delete',  [ProfileController::class, 'deleteCounseling'])->middleware(['web', 'auth']);
    Route::get('/profile/convert',  [ProfileController::class, 'convert'])->middleware(['web', 'auth']);
    Route::post('/send-convert',  [ProfileController::class, 'sendConvert'])->middleware(['web', 'auth']);
    Route::delete('/profile/ticket/{ticket}/delete',  [ProfileController::class, 'removeTicket'])->middleware(['web', 'auth']);
    Route::get('/profile/personal-info',  [ProfileController::class, 'personalInfo'])->middleware(['web', 'auth']);
    Route::post('/change-all-user-info',  [ProfileController::class, 'ChangeAllUserInfo'])->middleware(['web', 'auth']);
    Route::post('/profile/check-code',  [ProfileController::class, 'checkCode'])->middleware(['web', 'auth']);
    Route::post('/profile/check-email',  [ProfileController::class, 'checkEmail'])->middleware(['web', 'auth']);
    Route::post('/profile/upload-profile',  [ProfileController::class, 'uploadProfile'])->middleware(['web', 'auth']);
    Route::get('/show-pay/{PayId}',  [ProfileController::class, 'showPay'])->middleware(['web', 'auth']);
    Route::get('/invoice/{PayId}',  [ProfileController::class, 'invoice'])->middleware(['web', 'auth']);
    Route::get('/profile/subcategory',  [ProfileController::class, 'subcategory'])->middleware(['web', 'auth']);
    Route::get('/charge',  [ProfileController::class, 'charge'])->middleware(['web', 'auth']);
    Route::get('/offline',  [IndexController::class, 'offline']);

    ////////////////////////////////////////////////////// google
    Route::get('/login-social/{social}', [GoogleController::class, 'redirectToProvider']);
    Route::get('/callback/{social}', [GoogleController::class, 'handleProviderCallback']);
});

Route::group(['prefix' => 'seller'] , function (){
    Route::get('/dashboard', [SellerController::class , 'index'])->middleware(['permission:فروشنده']);

    ////////////////////////////////// gallery
    Route::get('/gallery', [App\Http\Controllers\Seller\GalleryController::class , 'index'])->middleware(['permission:فروشنده']);
    Route::post('/upload-image', [App\Http\Controllers\Seller\GalleryController::class , 'upload'])->middleware(['permission:فروشنده']);
    Route::get('/get-image', [App\Http\Controllers\Seller\GalleryController::class , 'getImage'])->middleware(['permission:فروشنده']);
    Route::delete('/gallery/{gallery}/delete', [App\Http\Controllers\Seller\GalleryController::class , 'deleteImage'])->middleware(['permission:فروشنده']);

    //////// product
    Route::get('/product', [ProductController::class , 'index'])->middleware(['permission:فروشنده']);
    Route::get('/my-products', [ProductController::class , 'myProduct'])->middleware(['permission:فروشنده']);
    Route::put('/product/{MyProduct}/edit', [ProductController::class , 'update'])->middleware(['permission:فروشنده']);
    Route::get('/product/{MyProduct}/edit', [ProductController::class , 'edit'])->middleware(['permission:فروشنده']);
    Route::get('/product/create', [ProductController::class , 'create'])->middleware(['permission:فروشنده']);
    Route::post('/product/create', [ProductController::class , 'store'])->middleware(['permission:فروشنده']);
    Route::get('/add-variety/{SimpleProduct}', [ProductController::class , 'addVariety'])->middleware(['permission:فروشنده']);
    Route::post('/add-variety/{product}', [ProductController::class , 'storeVariety'])->middleware(['permission:فروشنده']);
    Route::get('/variety/{MyVariety}/edit', [ProductController::class , 'editVariety'])->middleware(['permission:فروشنده']);
    Route::put('/variety/{MyVariety}/edit', [ProductController::class , 'updateVariety'])->middleware(['permission:فروشنده']);
    Route::delete('/variety/{MyVariety}/delete', [ProductController::class , 'delete'])->middleware(['permission:فروشنده']);

    //// inventory
    Route::get('/inventory', [App\Http\Controllers\Seller\InventoryController::class , 'index'])->middleware(['permission:فروشنده']);
    Route::get('/empty', [App\Http\Controllers\Seller\InventoryController::class , 'empty'])->middleware(['permission:فروشنده']);

    //// pay
    Route::get('/pay', [App\Http\Controllers\Seller\PayController::class , 'index'])->middleware(['permission:فروشنده']);
    Route::get('/pay/{MyPay}', [App\Http\Controllers\Seller\PayController::class , 'edit'])->middleware(['permission:فروشنده']);
    Route::put('/pay/{MyPay}', [App\Http\Controllers\Seller\PayController::class , 'update'])->middleware(['permission:فروشنده']);

});
