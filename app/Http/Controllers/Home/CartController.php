<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\Cart;
use App\Models\Collection;
use App\Models\Discount;
use App\Models\Guarantee;
use App\Models\Pack;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Time;
use App\Traits\SeoHelper;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    use SeoHelper;
    public function addCart(Request $request){
        $product = Product::where('id', $request->product)->first();
        $preBuy = 0;
        $price = $product->price;
        if(auth()->user()){
            $levelUser = auth()->user()->roles()->pluck('name')->toArray();
            if($product->levels){
                if($product['levels'] != '[]'){
                    foreach(json_decode($product['levels']) as $item){
                        if(in_array($item->name, $levelUser)){
                            $price = $item->price;
                        }
                    }
                }
            }
        }
        if($product->count <= 0 && $product->prebuy == 1){
            $price = $product->prePrice;
            $preBuy = 1;
        }
        if($product['colors']){
            foreach(json_decode($product['colors']) as $item){
                if($item->name == $request->color){
                    $price = (int)$price + (int)$item->price;
                    if($item->count <= 0 && $product->prebuy == 0){
                        return 'limit';
                    }
                }
            }
        }
        if($product['size']){
            foreach(json_decode($product['size']) as $item){
                if($item->name == $request->size){
                    $price = (int)$price + (int)$item->price;
                    if($item->count <= 0 && $product->prebuy == 0){
                        return 'limit';
                    }
                }
            }
        }
        $limit = 0;
        if (auth()->user()) {
            $check = Cart::where('product_id', $request->product)->where('size', $request->size)->where('color', $request->color)->where('guarantee_id', $request->guarantee)->where('user_id', auth()->user()->id)->first();
            if ($check) {
                if($product['colors']){
                    foreach(json_decode($product['colors']) as $item){
                        if($item->name == $request->color){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $check->count){
                                $limit = 1;
                            }
                        }
                    }
                }
                if($product['size']){
                    foreach(json_decode($product['size']) as $item){
                        if($item->name == $request->size){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $check->count){
                                $limit = 1;
                            }
                        }
                    }
                }
                if($product->count <= $check->count && $product->prebuy == 0){
                    return 'limit';
                }
                if($limit == 1 && $product->prebuy == 0){
                    return 'limit';
                }
                if($product->maxCart <= $check->count){
                    return 'maxCart';
                }
                $check->update([
                    'count' => ++$check->count
                ]);
                $carts = $this->setToCart($preBuy);
                return ['success',$carts];
            }
            else {
                if($product->inquiry == 1){
                    $inquiry = 0;
                }else{
                    $inquiry = 2;
                }
                Cart::create([
                    'product_id' => $request->product,
                    'user_id' => auth()->user()->id,
                    'guarantee_id' => $request->guarantee,
                    'color' => $request->color,
                    'size' => $request->size,
                    'inquiry' => $inquiry,
                    'price' => $price,
                    'count' => $product->minCart,
                    'prebuy' => $preBuy,
                ]);
                $carts = $this->setToCart($preBuy);
                return ['success',$carts];
            }
        }
        else {
            $myCart = $request->cookie('myCart');
            $changeCart = [];
            if($product->inquiry == 1){
                $inquiry = 0;
            }else{
                $inquiry = 2;
            }
            if(!empty($myCart)){
                if ($myCart){
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->product && $request->size == $item['size'] && $request->color == $item['color'] && $request->guarantee == $item['guarantee_id']) {
                            if($product->count <= $item['count'] && $product->prebuy == 0){
                                return 'limit';
                            }
                            if($limit == 1 && $product->prebuy == 0){
                                return 'limit';
                            }
                            if($product->maxCart <= $item['count']){
                                return 'maxCart';
                            }
                            $count = ++$item['count'];
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $count,
                                'price' => $item['price'],
                                'color' => $item['color'],
                                'size' => $item['size'],
                                'number' => $item['number'],
                                'prebuy' => $item['prebuy'],
                                'pack' => $item['pack'],
                                'inquiry' => $item['inquiry'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }
                    $c = collect($changeCart);
                    $filtered = $c->where('id', '=' , $request->product)->where('size', '=' , $request->size)->where('color', '=' , $request->color)->where('guarantee_id', '=' , $request->guarantee)->first();
                    if(!$filtered){
                        $cart=[
                            'id' => $request->product,
                            'count' => $product->minCart,
                            'inquiry' => $inquiry,
                            'color' => $request->color,
                            'size' => $request->size,
                            'number' => 0,
                            'pack' => 0,
                            'prebuy' => $preBuy,
                            'guarantee_id' => $request->guarantee,
                            'price' => $price,
                        ];
                        array_push($changeCart, $cart);
                    }
                }
                else{
                    $cart=[
                        'id' => $request->product,
                        'count' => $product->minCart,
                        'color' => $request->color,
                        'number' => 0,
                        'inquiry' => $inquiry,
                        'size' => $request->size,
                        'guarantee_id' => $request->guarantee,
                        'price' => $price,
                        'pack' => 0,
                        'prebuy' => $preBuy,
                    ];
                    array_push($changeCart, $cart);
                }
            }
            else{
                $cart=[
                    'id' => $request->product,
                    'count' => $product->minCart,
                    'inquiry' => $inquiry,
                    'color' => $request->color,
                    'size' => $request->size,
                    'guarantee_id' => $request->guarantee,
                    'price' => $price,
                    'number' => 0,
                    'pack' => 0,
                    'prebuy' => $preBuy,
                ];
                array_push($changeCart, $cart);
            }
            $carts = [];
            for ( $i = 0; $i < count($changeCart); $i++) {
                if($changeCart[$i]['number'] == 0){
                    $send = Product::where('id', $changeCart[$i])->with('user')->first();
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'inquiry' => $changeCart[$i]['inquiry'],
                        'pack' => $changeCart[$i]['pack'],
                        'id' => $changeCart[$i]['id'],
                        'count' => $changeCart[$i]['count'],
                        'size' => $changeCart[$i]['size'],
                        'number' => $changeCart[$i]['number'],
                        'color' => $changeCart[$i]['color'],
                        'prebuy' => $changeCart[$i]['prebuy'],
                        'price' => $changeCart[$i]['price'],
                        'guarantee_id' => $changeCart[$i]['guarantee_id'],
                    ];
                    array_push($carts, $data);
                }
            };
            $response = new Response(['success',$carts]);
            return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
        }
    }

    public function addPack(Request $request){
        $product = Collection::where('id', $request->collect)->first();
        if($product->count <= 0){
            return 'limit';
        }
        if (auth()->user()) {
            $check = Cart::where('collect_id', $request->collect)->where('user_id', auth()->user()->id)->first();
            if ($check) {
                $check->update([
                    'count' => ++$check->count
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            }
            else {
                if($product->inquiry == 1){
                    $inquiry = 0;
                }else{
                    $inquiry = 2;
                }
                Cart::create([
                    'collect_id' => $request->collect,
                    'user_id' => auth()->user()->id,
                    'guarantee_id' => '',
                    'color' => '',
                    'size' => '',
                    'inquiry' => $inquiry,
                    'price' => $product->price,
                    'count' => 1,
                    'pack' => 1,
                    'prebuy' => 0,
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            }
        }
        else {
            $myCart = $request->cookie('myCart');
            $changeCart = [];
            if($product->inquiry == 1){
                $inquiry = 0;
            }else{
                $inquiry = 2;
            }
            if(!empty($myCart)){
                if ($myCart){
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->collect && $request->pack == 1) {
                            $count = ++$item['count'];
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $count,
                                'price' => $item['price'],
                                'color' => $item['color'],
                                'size' => $item['size'],
                                'pack' => 1,
                                'collect' => $item['collect'],
                                'prebuy' => $item['prebuy'],
                                'number' => $item['number'],
                                'inquiry' => $item['inquiry'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }
                    $c = collect($changeCart);
                    $filtered = $c->where('id', '=' , $request->collect)->where('pack', '=' , 1)->first();
                    if(!$filtered){
                        $cart=[
                            'id' => $request->collect,
                            'count' => 1,
                            'inquiry' => $inquiry,
                            'color' => '',
                            'size' => '',
                            'number' => 0,
                            'prebuy' => 0,
                            'pack' => 1,
                            'guarantee_id' => '',
                            'price' => $product->price,
                        ];
                        array_push($changeCart, $cart);
                    }
                }
                else{
                    $cart=[
                        'id' => $request->collect,
                        'count' => 1,
                        'inquiry' => $inquiry,
                        'color' => '',
                        'size' => '',
                        'prebuy' => 0,
                        'number' => 0,
                        'pack' => 1,
                        'guarantee_id' => '',
                        'price' => $product->price,
                    ];
                    array_push($changeCart, $cart);
                }
            }
            else{
                $cart=[
                    'id' => $request->collect,
                    'count' => 1,
                    'inquiry' => $inquiry,
                    'color' => '',
                    'size' => '',
                    'prebuy' => 0,
                    'number' => 0,
                    'pack' => 1,
                    'guarantee_id' => '',
                    'price' => $product->price,
                ];
                array_push($changeCart, $cart);
            }
            $carts = [];
            for ( $i = 0; $i < count($changeCart); $i++) {
                if($changeCart[$i]['number'] == 0){
                    $send = Product::where('id', $changeCart[$i])->with('user')->first();
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'inquiry' => $changeCart[$i]['inquiry'],
                        'pack' => $changeCart[$i]['pack'],
                        'id' => $changeCart[$i]['id'],
                        'count' => $changeCart[$i]['count'],
                        'size' => $changeCart[$i]['size'],
                        'number' => $changeCart[$i]['number'],
                        'prebuy' => $changeCart[$i]['prebuy'],
                        'color' => $changeCart[$i]['color'],
                        'price' => $changeCart[$i]['price'],
                        'guarantee_id' => $changeCart[$i]['guarantee_id'],
                    ];
                    array_push($carts, $data);
                }
            };
            $response = new Response(['success',$carts]);
            return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
        }
    }

    public function addCartFast(Request $request)
    {
        $post = Product::where('id', $request->product)->with('guarantee')->first();
        $count  = $post->minCart;
        $colorName = '';
        $size = '';
        $price = $post->price;
        if(auth()->user()){
            $levelUser = auth()->user()->roles()->pluck('name')->toArray();
            if($post->levels){
                if($post['levels'] != '[]'){
                    foreach(json_decode($post['levels']) as $item){
                        if(in_array($item->name, $levelUser)){
                            $price = $item->price;
                        }
                    }
                }
            }
        }
        if($post->count <= 0 && $post->prebuy == 1){
            $price = $post->prePrice;
        }
        if ($post->colors){
            $get1 = json_decode($post->colors , true);
            if (count($get1)) {
                if ($get1[0]['count'] >= $count){
                    $colorName = $get1[0];
                }elseif($get1[1]){
                    $colorName = $get1[1];
                }else{
                    return ['limit',[]];
                }
            }
        }
        if ($post->size) {
            $get2 = json_decode($post->size , true);
            if (count($get2)) {
                if ($get2[0]['count'] >= $count){
                    $size = $get2[0];
                }elseif($get2[1]){
                    $size = $get2[1];
                }else{
                    return ['limit',[]];
                }
            }
        }
        if($size != ''){
            $sizeN = $size['name'];
            $price = (int)$price + (int)$size['price'];
        }else{
            $sizeN = null;
        }
        if($colorName != ''){
            $colorN = $colorName['name'];
            $price = (int)$price + (int)$colorName['price'];
        }else{
            $colorN = null;
        }
        if(!empty($post['guarantee'])){
            $guarantee = $post['guarantee'][0]['id'];
        }else{
            $guarantee = '';
        }
        if($post->inquiry == 1){
            $inquiry = 0;
        }else{
            $inquiry = 2;
        }
        $limit = 0;
        if (auth()->user()) {
            $check = Cart::where('product_id', $request->product)->where('guarantee_id', $guarantee)->where('user_id', auth()->user()->id)->where('color', $colorN)->where('size', $sizeN)->first();
            if ($check) {
                if($post['colors']){
                    foreach(json_decode($post['colors']) as $item){
                        if($item->name == $request->color){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $check->count){
                                $limit = 1;
                            }
                        }
                    }
                }
                if($post['size']){
                    foreach(json_decode($post['size']) as $item){
                        if($item->name == $request->size){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $check->count){
                                $limit = 1;
                            }
                        }
                    }
                }
                if($post->count <= $check->count && $post->prebuy == 0){
                    return 'limit';
                }
                if($limit == 1 && $post->prebuy == 0){
                    return 'limit';
                }
                if($post->maxCart <= $check->count){
                    return 'maxCart';
                }
                $check->update([
                    'count' => ++$check->count
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            } else {
                Cart::create([
                    'product_id' => $request->product,
                    'user_id' => auth()->user()->id,
                    'guarantee_id' => $guarantee,
                    'color' => $colorN,
                    'size' => $sizeN,
                    'price' => $price,
                    'inquiry' => $inquiry,
                    'count' => $count,
                    'number' => 0,
                    'prebuy' => 0,
                    'pack' => 0,
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            }
        }
        else {
            $myCart = $request->cookie('myCart');
            $changeCart = [];
            if(!empty($myCart)){
                if ($myCart){
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->product && $sizeN == $item['size'] && $colorN == $item['color'] && $guarantee == $item['guarantee_id']) {
                            if($post->count <= $item['count'] && $post->prebuy == 0){
                                return 'limit';
                            }
                            if($limit == 1 && $post->prebuy == 0){
                                return 'limit';
                            }
                            if($post->maxCart <= $item['count']){
                                return 'maxCart';
                            }
                            $count = ++$item->count;
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $count,
                                'price' => $item['price'],
                                'inquiry' => $item['inquiry'],
                                'color' => $item['color'],
                                'size' => $item['size'],
                                'pack' => $item['pack'],
                                'prebuy' => $item['prebuy'],
                                'number' => $item['number'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }
                    $c = collect($changeCart);
                    $filtered = $c->where('id', '=' , $request->product)->where('size', '=' , $sizeN)->where('color', '=' , $colorN)->where('guarantee_id', '=' , $guarantee)->first();
                    if(!$filtered){
                        $cart=[
                            'id' => $request->product,
                            'count' => $count,
                            'pack' => 0,
                            'number' => 0,
                            'prebuy' => 0,
                            'inquiry' => $inquiry,
                            'color' => $colorN,
                            'size' => $sizeN,
                            'guarantee_id' => $guarantee,
                            'price' => $price,
                        ];
                        array_push($changeCart, $cart);
                    }
                }
                else{
                    $cart=[
                        'id' => $request->product,
                        'count' => $count,
                        'number' => 0,
                        'pack' => 0,
                        'prebuy' => 0,
                        'color' => $colorN,
                        'inquiry' => $inquiry,
                        'size' => $sizeN,
                        'guarantee_id' => $guarantee,
                        'price' => $price,
                    ];
                    array_push($changeCart, $cart);
                }
            }
            else{
                $cart=[
                    'id' => $request->product,
                    'count' => $count,
                    'number' => 0,
                    'pack' => 0,
                    'prebuy' => 0,
                    'color' => $colorN,
                    'inquiry' => $inquiry,
                    'size' => $sizeN,
                    'guarantee_id' => $guarantee,
                    'price' => $price,
                ];
                array_push($changeCart, $cart);
            }

            $carts = [];
            for ( $i = 0; $i < count($changeCart); $i++) {
                if($changeCart[$i]['number'] == 0){
                    $send = Product::where('id', $changeCart[$i])->with('user')->first();
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'inquiry' => $changeCart[$i]['inquiry'],
                        'pack' => $changeCart[$i]['pack'],
                        'id' => $changeCart[$i]['id'],
                        'count' => $changeCart[$i]['count'],
                        'size' => $changeCart[$i]['size'],
                        'number' => $changeCart[$i]['number'],
                        'color' => $changeCart[$i]['color'],
                        'prebuy' => $changeCart[$i]['prebuy'],
                        'price' => $changeCart[$i]['price'],
                        'guarantee_id' => $changeCart[$i]['guarantee_id'],
                    ];
                    array_push($carts, $data);
                }
            };
            $response = new Response(['success',$carts]);
            return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
        }
    }


    public function addCartFast2(Request $request)
    {
        $post = Product::where('id', $request->product)->with('guarantee')->first();
        $count  = $request->count;
        $colorName = '';
        $size = '';
        $price = $post->price;
        if(auth()->user()){
            $levelUser = auth()->user()->roles()->pluck('name')->toArray();
            if($post->levels){
                if($post['levels'] != '[]'){
                    foreach(json_decode($post['levels']) as $item){
                        if(in_array($item->name, $levelUser)){
                            $price = $item->price;
                        }
                    }
                }
            }
        }
        if($post->count <= 0 && $post->prebuy == 1){
            $price = $post->prePrice;
        }
        if ($post->colors){
            $get1 = json_decode($post->colors , true);
            if (count($get1)) {
                if ($get1[0]['count'] >= $count){
                    $colorName = $get1[0];
                }elseif($get1[1]){
                    $colorName = $get1[1];
                }else{
                    return ['limit',[]];
                }
            }
        }
        if ($post->size) {
            $get2 = json_decode($post->size , true);
            if (count($get2)) {
                if ($get2[0]['count'] >= $count){
                    $size = $get2[0];
                }elseif($get2[1]){
                    $size = $get2[1];
                }else{
                    return ['limit',[]];
                }
            }
        }
        if($size != ''){
            $sizeN = $size['name'];
            $price = (int)$price + (int)$size['price'];
        }else{
            $sizeN = null;
        }
        if($colorName != ''){
            $colorN = $colorName['name'];
            $price = (int)$price + (int)$colorName['price'];
        }else{
            $colorN = null;
        }
        if(!empty($post['guarantee'])){
            $guarantee = $post['guarantee'][0]['id'];
        }else{
            $guarantee = '';
        }
        if($post->inquiry == 1){
            $inquiry = 0;
        }else{
            $inquiry = 2;
        }
        $limit = 0;
        if (auth()->user()) {
            $check = Cart::where('product_id', $request->product)->where('guarantee_id', $guarantee)->where('user_id', auth()->user()->id)->where('color', $colorN)->where('size', $sizeN)->first();
            if ($check) {
                if($post['colors']){
                    foreach(json_decode($post['colors']) as $item){
                        if($item->name == $request->color){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $count){
                                $limit = 1;
                            }
                        }
                    }
                }
                if($post['size']){
                    foreach(json_decode($post['size']) as $item){
                        if($item->name == $request->size){
                            $price = (int)$price + (int)$item->price;
                            if($item->count <= $count){
                                $limit = 1;
                            }
                        }
                    }
                }

                if($post->count <= $count && $post->prebuy == 0){
                    return 'limit';
                }
                if($post->maxCart <= $count){
                    return 'maxCart';
                }
                $check->update([
                    'count' => $count
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            } else {
                Cart::create([
                    'product_id' => $request->product,
                    'user_id' => auth()->user()->id,
                    'guarantee_id' => $guarantee,
                    'color' => $colorN,
                    'size' => $sizeN,
                    'price' => $price,
                    'inquiry' => $inquiry,
                    'count' => $count,
                    'number' => 0,
                    'prebuy' => 0,
                    'pack' => 0,
                ]);
                $carts = $this->setToCart(0);
                return ['success',$carts];
            }
        }
        else {
            $myCart = $request->cookie('myCart');
            $changeCart = [];
            if(!empty($myCart)){
                if ($myCart){
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->product && $sizeN == $item['size'] && $colorN == $item['color'] && $guarantee == $item['guarantee_id']) {
                            if($post->count <= $item['count'] && $post->prebuy == 0){
                                return 'limit';
                            }
                            if($limit == 1 && $post->prebuy == 0){
                                return 'limit';
                            }
                            if($post->maxCart <= $item['count']){
                                return 'maxCart';
                            }
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $count,
                                'price' => $item['price'],
                                'inquiry' => $item['inquiry'],
                                'color' => $item['color'],
                                'size' => $item['size'],
                                'pack' => $item['pack'],
                                'prebuy' => $item['prebuy'],
                                'number' => $item['number'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }
                    $c = collect($changeCart);
                    $filtered = $c->where('id', '=' , $request->product)->where('size', '=' , $sizeN)->where('color', '=' , $colorN)->where('guarantee_id', '=' , $guarantee)->first();
                    if(!$filtered){
                        $cart=[
                            'id' => $request->product,
                            'count' => $count,
                            'pack' => 0,
                            'number' => 0,
                            'prebuy' => 0,
                            'inquiry' => $inquiry,
                            'color' => $colorN,
                            'size' => $sizeN,
                            'guarantee_id' => $guarantee,
                            'price' => $price,
                        ];
                        array_push($changeCart, $cart);
                    }
                }
                else{
                    $cart=[
                        'id' => $request->product,
                        'count' => $count,
                        'number' => 0,
                        'pack' => 0,
                        'prebuy' => 0,
                        'color' => $colorN,
                        'inquiry' => $inquiry,
                        'size' => $sizeN,
                        'guarantee_id' => $guarantee,
                        'price' => $price,
                    ];
                    array_push($changeCart, $cart);
                }
            }
            else{
                $cart=[
                    'id' => $request->product,
                    'count' => $count,
                    'number' => 0,
                    'pack' => 0,
                    'prebuy' => 0,
                    'color' => $colorN,
                    'inquiry' => $inquiry,
                    'size' => $sizeN,
                    'guarantee_id' => $guarantee,
                    'price' => $price,
                ];
                array_push($changeCart, $cart);
            }

            $carts = [];
            for ( $i = 0; $i < count($changeCart); $i++) {
                if($changeCart[$i]['number'] == 0){
                    $send = Product::where('id', $changeCart[$i])->with('user')->first();
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'inquiry' => $changeCart[$i]['inquiry'],
                        'pack' => $changeCart[$i]['pack'],
                        'id' => $changeCart[$i]['id'],
                        'count' => $changeCart[$i]['count'],
                        'size' => $changeCart[$i]['size'],
                        'number' => $changeCart[$i]['number'],
                        'color' => $changeCart[$i]['color'],
                        'prebuy' => $changeCart[$i]['prebuy'],
                        'price' => $changeCart[$i]['price'],
                        'guarantee_id' => $changeCart[$i]['guarantee_id'],
                    ];
                    array_push($carts, $data);
                }
            };
            $response = new Response(['success',$carts]);
            return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
        }
    }

    public function checkDiscount(Request $request){
        $time = Carbon::now()->format('Y-m-d h:i');
        $dis = Discount::where('code' , $request->discount)->where('status' , 1)->where('day', '>=' , $time)->where('count' , '>=' , 1)->first();
        if($dis){
            foreach (auth()->user()->cart as $value) {
                $value->update([
                    'discount' => $dis['code']
                ]);
            }
            return $dis;
        }else{
            return 'no';
        }
    }

    public function getCart(){
        if (auth()->user()) {
            $carts = $this->setToCart();
        }
        else {
            $value = request()->cookie('myCart');
            $cart = collect(json_decode($value , true));
            $carts = [];
            for ( $i = 0; $i < count($cart); $i++) {
                if($cart[$i]['number'] == 0){
                    if($cart[$i]['pack'] == 1){
                        $send = Collection::where('id', $cart[$i])->with('user')->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'size' => $cart[$i]['size'],
                            'number' => $cart[$i]['number'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'color' => $cart[$i]['color'],
                            'pack' => $cart[$i]['pack'],
                            'price' => $cart[$i]['price'],
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                        array_push($carts, $data);
                    }else{
                        $send = Product::where('id', $cart[$i])->with('user')->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'pack' => $cart[$i]['pack'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'size' => $cart[$i]['size'],
                            'number' => $cart[$i]['number'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'color' => $cart[$i]['color'],
                            'price' => $cart[$i]['price'],
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                        array_push($carts, $data);
                    }
                }
            };
        }
        return $carts;
    }

    public function index(){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $shortActivity = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo( __('messages.my_cart') . "$title - " , $shortActivity , 'store' , 'cart' , $logoSite , $keyword );
        $count = 0;
        $count2 = 0;
        if (auth()->user()) {
            $cart = Cart::where('user_id' , auth()->user()->id)->with('guarantee')->get();
            $carts = [];
            $prices = 0;
            $scores = 0;
            for ( $i = 0; $i < count($cart); $i++) {
                if($cart[$i]['number'] == 0){
                    if($cart[$i]['pack'] == 1){
                        $send = Collection::where('id', $cart[$i]['collect_id'])->with('user')->first();
                        if($cart[$i]['inquiry'] == 1){
                            $cart[$i]->delete();
                            return redirect('/cart')->with([
                                'message' => __('messages.no_pack',['title'=>$send->title])
                            ]);
                        }
                        $count = (int)$count + (int)$cart[$i]['count'];
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'color' => $cart[$i]['color'],
                            'number' => $cart[$i]['number'],
                            'price' => $cart[$i]['price'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'pack' => 1,
                            'inquiry' => $cart[$i]['inquiry'],
                            'guarantee' => '',
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                    }else{
                        $send = Product::where('id', $cart[$i]['product_id'])->with('user')->first();
                        if($cart[$i]['inquiry'] == 1){
                            $cart[$i]->delete();
                            return redirect('/cart')->with([
                                'message' => __('messages.no_product1',['title'=>$send->title])
                            ]);
                        }
                        $count = (int)$count + (int)$cart[$i]['count'];
                        $guarantee = Guarantee::where('id' , $cart[$i]['guarantee_id'])->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'pack' => 0,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'color' => $cart[$i]['color'],
                            'number' => $cart[$i]['number'],
                            'price' => $cart[$i]['price'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'guarantee' => $guarantee,
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                        $scores = (int)$scores + (int)$send->score;
                    }
                    array_push($carts, $data);
                    $prices = (int)$prices + ((int)$cart[$i]['price'] * $cart[$i]['count']);
                }else{
                    $count2 = (int)$count2 + (int)$cart[$i]['count'];
                }
            };
        }
        else {
            $value = request()->cookie('myCart');
            $cart = collect(json_decode($value , true));
            $carts = [];
            $prices = 0;
            $scores = 0;
            for ( $i = 0; $i < count($cart); $i++) {
                if($cart[$i]['number'] == 0){
                    if($cart[$i]['pack'] == 1){
                        $send = Collection::where('id', $cart[$i])->with('user')->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'pack' => 1,
                            'inquiry' => $cart[$i]['inquiry'],
                            'color' => $cart[$i]['color'],
                            'price' => $cart[$i]['price'],
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                            'number' => $cart[$i]['number'],
                            'guarantee' => '',
                        ];
                    }else{
                        $send = Product::where('id', $cart[$i])->with('user')->first();
                        $guarantee = Guarantee::where('id' , $cart[$i]['guarantee_id'])->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'pack' => 0,
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'color' => $cart[$i]['color'],
                            'price' => $cart[$i]['price'],
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                            'number' => $cart[$i]['number'],
                            'guarantee' => $guarantee,
                        ];
                        $scores = (int)$scores + (int)$send->score;
                    }
                    $count = (int)$count + (int)$cart[$i]['count'];
                    array_push($carts, $data);
                    $prices = (int)$prices + ((int)$cart[$i]['price'] * $cart[$i]['count']);
                }else{
                    $count2 = (int)$count2 + (int)$cart[$i]['count'];
                }
            };
        }
        return view('home.cart.cartIndex' , compact('carts','count','count2','scores','prices'));
    }

    public function nextCartIndex(){
        $title = Setting::where('key' , 'title')->pluck('value')->first();
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        $shortActivity = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ?:'' ;
        $this->seoSingleSeo( __('messages.my_cart') . "$title - " , $shortActivity , 'store' , 'cart' , $logoSite , $keyword );
        $count = 0;
        $count2 = 0;
        if (auth()->user()) {
            $cart = Cart::where('user_id' , auth()->user()->id)->with('guarantee')->get();
            $carts = [];
            $prices = 0;
            $scores = 0;
            for ( $i = 0; $i < count($cart); $i++) {
                if($cart[$i]['number'] == 1){
                    if($cart[$i]['pack'] == 1){
                        $send = Collection::where('id', $cart[$i]['collect_id'])->with('user')->first();
                        if($cart[$i]['inquiry'] == 1){
                            $cart[$i]->delete();
                            return redirect('/cart')->with([
                                'message' => __('messages.no_pack',['title'=>$send->title])
                            ]);
                        }
                        $count = (int)$count + (int)$cart[$i]['count'];
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'color' => $cart[$i]['color'],
                            'number' => $cart[$i]['number'],
                            'price' => $cart[$i]['price'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'pack' => 1,
                            'inquiry' => $cart[$i]['inquiry'],
                            'guarantee' => '',
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                    }else{
                        $send = Product::where('id', $cart[$i]['product_id'])->with('user')->first();
                        if($cart[$i]['inquiry'] == 1){
                            $cart[$i]->delete();
                            return redirect('/cart')->with([
                                'message' => __('messages.no_product1',['title'=>$send->title])
                            ]);
                        }
                        $count = (int)$count + (int)$cart[$i]['count'];
                        $guarantee = Guarantee::where('id' , $cart[$i]['guarantee_id'])->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'size' => $cart[$i]['size'],
                            'color' => $cart[$i]['color'],
                            'pack' => 0,
                            'number' => $cart[$i]['number'],
                            'price' => $cart[$i]['price'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'guarantee' => $guarantee,
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                        $scores = (int)$scores + (int)$send->score;
                    }
                    array_push($carts, $data);
                    $prices = (int)$prices + ((int)$cart[$i]['price'] * $cart[$i]['count']);
                }else{
                    $count2 = (int)$count2 + (int)$cart[$i]['count'];
                }
            };
        }
        else {
            $value = request()->cookie('myCart');
            $cart = collect(json_decode($value , true));
            $carts = [];
            $prices = 0;
            $scores = 0;
            for ( $i = 0; $i < count($cart); $i++) {
                if($cart[$i]['number'] == 1){
                    if($cart[$i]['pack']) {
                        $send = Collection::where('id', $cart[$i]['collect_id'])->with('user')->first();
                        if($cart[$i]['inquiry'] == 1){
                            $cart[$i]->delete();
                            return redirect('/cart')->with([
                                'message' => __('messages.no_pack',['title'=>$send->title])
                            ]);
                        }
                        $count = (int)$count + (int)$cart[$i]['count'];
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'color' => $cart[$i]['color'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'number' => $cart[$i]['number'],
                            'price' => $cart[$i]['price'],
                            'pack' => 1,
                            'inquiry' => $cart[$i]['inquiry'],
                            'guarantee' => '',
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                        ];
                    }else{
                        $send = Product::where('id', $cart[$i])->with('user')->first();
                        $guarantee = Guarantee::where('id' , $cart[$i]['guarantee_id'])->first();
                        $data = [
                            'title' => $send->title,
                            'image' => $send->image,
                            'slug' => $send->slug,
                            'user' => $send->user,
                            'product' => $send->id,
                            'pack' => 0,
                            'id' => $cart[$i]['id'],
                            'count' => $cart[$i]['count'],
                            'size' => $cart[$i]['size'],
                            'inquiry' => $cart[$i]['inquiry'],
                            'color' => $cart[$i]['color'],
                            'price' => $cart[$i]['price'],
                            'prebuy' => $cart[$i]['prebuy'],
                            'guarantee_id' => $cart[$i]['guarantee_id'],
                            'number' => $cart[$i]['number'],
                            'guarantee' => $guarantee,
                        ];
                        $scores = (int)$scores + (int)$send->score;
                    }
                    array_push($carts, $data);
                    $count = (int)$count + (int)$cart[$i]['count'];
                    $prices = (int)$prices + ((int)$cart[$i]['price'] * $cart[$i]['count']);
                }else{
                    $count2 = (int)$count2 + (int)$cart[$i]['count'];
                }
            };
        }
        return view('home.cart.cartNextIndex' , compact('carts','count','count2','scores','prices'));
    }

    public function checkout(){
        $cart = Cart::where('user_id' , auth()->user()->id)->where('number' , 0)->with('guarantee')->get();
        if(count($cart) >= 1){
            foreach($cart as $item){
                if($item->inquiry == 0){
                    return redirect('/cart')->with([
                        'message' => __('messages.wait_product')
                    ]);
                }
                if($item->inquiry == 1){
                    $post = Product::where('id' , $item->product_id)->first();
                    return redirect('/cart')->with([
                        'message' => __('messages.no_product1',['title'=>$post->title])
                    ]);
                }
            }
        }else{
            return redirect('/cart');
        }
        $carts = [];
        $count = 0;
        $prices = 0;
        $scores = 0;
        $prebuy = 0;
        for ( $i = 0; $i < count($cart); $i++) {
            if($cart[$i]['number'] == 0){
                if($cart[$i]['prebuy'] == 1){
                    $prebuy = 1;
                }
                if($cart[$i]['pack'] == 1) {
                    $send = Collection::where('id', $cart[$i]['collect_id'])->with('user')->first();
                    if($cart[$i]['inquiry'] == 1){
                        $cart[$i]->delete();
                        return redirect('/cart')->with([
                            'message' => __('messages.no_pack',['title'=>$send->title])
                        ]);
                    }
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'id' => $cart[$i]['id'],
                        'count' => $cart[$i]['count'],
                        'size' => $cart[$i]['size'],
                        'color' => $cart[$i]['color'],
                        'number' => $cart[$i]['number'],
                        'price' => $cart[$i]['price'],
                        'prebuy' => $cart[$i]['prebuy'],
                        'pack' => 1,
                        'inquiry' => $cart[$i]['inquiry'],
                        'guarantee' => '',
                        'guarantee_id' => $cart[$i]['guarantee_id'],
                    ];
                }
                else{
                    $send = Product::where('id', $cart[$i]['product_id'])->with('user')->first();
                    $guarantee = Guarantee::where('id' , $cart[$i]['guarantee_id'])->first();
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug,
                        'user' => $send->user,
                        'product' => $send->id,
                        'id' => $cart[$i]['id'],
                        'count' => $cart[$i]['count'],
                        'size' => $cart[$i]['size'],
                        'inquiry' => $cart[$i]['inquiry'],
                        'color' => $cart[$i]['color'],
                        'pack' => 0,
                        'prebuy' => $cart[$i]['prebuy'],
                        'price' => $cart[$i]['price'],
                        'guarantee_id' => $cart[$i]['guarantee_id'],
                        'number' => $cart[$i]['number'],
                        'guarantee' => $guarantee,
                    ];
                    $scores = (int)$scores + (int)$send->score;
                }
                array_push($carts, $data);
                $count = (int)$count + (int)$cart[$i]['count'];
                $prices = (int)$prices + ((int)$cart[$i]['price'] * $cart[$i]['count']);
            }
        };

        $cart = auth()->user()->cart()->where('number' , 0)->pluck('product_id');
        $cart2 = auth()->user()->cart()->where('number' , 0)->pluck('collect_id');
        $posts = Product::whereIn('id', $cart)->with('time')->get();
        $collects = Collection::whereIn('id', $cart2)->with('time')->get();
        $ids = [];
        foreach ($posts as $item){
            if($item){
                if(count($item['time']) >= 1){
                    $id = $item['time'][0]['id'];
                    array_push($ids , $id);
                }
            }
        }
        foreach ($collects as $item){
            if($item){
                if(count($item['time']) >= 1){
                    $id = $item['time'][0]['id'];
                    array_push($ids , $id);
                }
            }
        }
        $times = Time::whereIn('id' , $ids)->orderBy('day','DESC' )->first();
        $holidays = Setting::where('key' , 'holidays')->pluck('value')->first() == 'null' ? json_encode([]) : Setting::where('key' , 'holidays')->pluck('value')->first();
        $days = [];
        if ($times){
            $i = $times['day'] - 1;
            do {
                $v = new Verta('+'.++$i . "day");
                $date = [
                    'dayL'=> $v->format('j'),
                    'price'=> 0,
                    'to'=> $times['to'],
                    'from'=> $times['from'],
                    'day'=> App::getLocale() == 'fa' ? $v->day : '',
                    'month'=> App::getLocale() == 'fa' ? $v->format('%B') : '',
                    'timestamp'=> Carbon::now()->addDays($i)->timestamp,
                ];
                if($v->isMonday()){
                    $date['dayL'] = __('messages.time1');
                }
                if($v->isTuesday()){
                    $date['dayL'] = __('messages.time2');
                }
                if($v->isWednesday()){
                    $date['dayL'] = __('messages.time3');
                }
                if($v->isThursday()){
                    $date['dayL'] = __('messages.time4');
                }
                if($v->isFriday()){
                    $date['dayL'] = __('messages.time5');
                }
                if($v->isSaturday()){
                    $date['dayL'] = __('messages.time6');
                }
                if($v->isSunday()){
                    $date['dayL'] = __('messages.time7');
                }
                if(in_array($date['dayL'], json_decode($holidays)) == ''){
                    array_push($days , $date);
                }
            }
            while (count($days) <= 4);
        }
        $tax = Setting::where('key' , 'tax')->pluck('value')->first() ?? 0;

        $cartPrice = $prices;
        $taxPrice = (($prices * $tax) / 100);
        $prices = $cartPrice + $taxPrice;

        $carriers = Carrier::latest()->get();
        $packs = Pack::latest()->select(['title','id','count'])->get();
        $address = auth()->user()->address()->latest()->where('show' , 1)->get();
        $spot = Setting::where('key' , 'spot')->pluck('value')->first();
        $gateway = Setting::where('key' , 'gateway')->pluck('value')->first();
        $installment = Setting::where('key' , 'installment')->pluck('value')->first();
        $wallet = Setting::where('key' , 'wallet')->pluck('value')->first();
        $card = Setting::where('key' , 'card')->pluck('value')->first();
        $cardText = Setting::where('key' , 'cardText')->pluck('value')->first();
        $zarinpalStatus = Setting::where('key' , 'zarinpalStatus')->pluck('value')->first();
        $zibalStatus = Setting::where('key' , 'zibalStatus')->pluck('value')->first();
        $nextpayStatus = Setting::where('key' , 'nextpayStatus')->pluck('value')->first();
        $idpayStatus = Setting::where('key' , 'idpayStatus')->pluck('value')->first();
        $statusBeh = Setting::where('key' , 'statusBeh')->pluck('value')->first();
        $statusSadad = Setting::where('key' , 'statusSadad')->pluck('value')->first();
        $statusAsan = Setting::where('key' , 'statusAsan')->pluck('value')->first();
        $statusPasargad = Setting::where('key' , 'statusPasargad')->pluck('value')->first();
        $statusSaman = Setting::where('key' , 'statusSaman')->pluck('value')->first();
        return view('home.cart.checkoutIndex' , compact('carts','prebuy','cartPrice','statusSaman','taxPrice','tax','cardText','statusAsan','statusPasargad','zarinpalStatus','zibalStatus','nextpayStatus','idpayStatus','statusBeh','statusSadad','wallet','card','count','packs','spot','gateway','installment','carriers','days','address','scores','prices'));
    }

    public function change(Request $request){
        if (auth()->user()) {
            $cartsAr = Cart::where('user_id' , auth()->user()->id)->get();
            for ( $i = 0; $i < count($cartsAr); $i++) {
                if($cartsAr[$i]['pack'] == 1){
                    $post = Collection::where('id' , $cartsAr[$i]['collect_id'])->first();
                    if($post->count < json_decode($request->count)[$i]){
                        return __('messages.no_product2',['count'=>json_decode($request->count)[$i],'title'=>$post->title]);
                    }
                    $cartsAr[$i]->update([
                        'count' => json_decode($request->count)[$i],
                    ]);
                }
                else{
                    $post = Product::where('id' , $cartsAr[$i]['product_id'])->first();
                    if($post->minCart > json_decode($request->count)[$i]){
                        return __('messages.min_cart');
                    }
                    if($cartsAr[$i]['color'] && $post->prebuy == 0){
                        foreach(json_decode($post['colors']) as $color){
                            if($color->name == $cartsAr[$i]['color']){
                                if($color->count < json_decode($request->count)[$i]){
                                    return __('messages.no_product3',['count'=>json_decode($request->count)[$i],'color'=>$cartsAr[$i]['color'],'title'=>$post->title]);
                                }
                            }
                        }
                    }
                    if($cartsAr[$i]['size'] && $post->prebuy == 0){
                        foreach(json_decode($post['size']) as $size){
                            if($size->name == $cartsAr[$i]['size']){
                                if($size->count < json_decode($request->count)[$i]){
                                    return __('messages.no_product4',['count'=>json_decode($request->count)[$i],'size'=>$cartsAr[$i]['size'],'title'=>$post->title]);
                                }
                            }
                        }
                    }
                    if($post->count < json_decode($request->count)[$i] && $post->prebuy == 0){
                        return __('messages.no_product6',['count'=>json_decode($request->count)[$i],'title'=>$post->title]);
                    }
                    if($post->maxCart < json_decode($request->count)[$i]){
                        return __('messages.no_product5',['max'=>$post->maxCart,'title'=>$post->title]);
                    }
                    $cartsAr[$i]->update([
                        'count' => json_decode($request->count)[$i],
                    ]);
                }
            }
            return 'success';
        }
        else {
            $myCart = request()->cookie('myCart');
            if(!empty($myCart)){
                if ($myCart){
                    $changeCart = [];
                    $cartsAr = json_decode($myCart , true);
                    for ( $i = 0; $i < count($cartsAr); $i++) {
                        if($cartsAr[$i]['pack'] == 1){
                            $post = Collection::where('id' , $cartsAr[$i]['id'])->first();
                            if($post->count < json_decode($request->count)[$i]){
                                return __('messages.no_product2',['count'=>json_decode($request->count)[$i],'title'=>$post->title]);
                            }
                            $cartItem = [
                                'id' => $cartsAr[$i]['id'],
                                'count' => json_decode($request->count)[$i],
                                'inquiry' => $cartsAr[$i]['inquiry'],
                                'color' => $cartsAr[$i]['color'],
                                'size' => $cartsAr[$i]['size'],
                                'number' => $cartsAr[$i]['number'],
                                'pack' => $cartsAr[$i]['pack'],
                                'guarantee_id' => $cartsAr[$i]['guarantee_id'],
                                'prebuy' => $cartsAr[$i]['prebuy'],
                                'price' => $cartsAr[$i]['price'],
                            ];
                            array_push($changeCart, $cartItem);
                        }else{
                            $post = Product::where('id' , $cartsAr[$i]['id'])->first();
                            if($post->minCart > json_decode($request->count)[$i]){
                                return __('messages.min2');
                            }
                            if($cartsAr[$i]['color'] && $post->prebuy == 0){
                                foreach(json_decode($post['colors']) as $color){
                                    if($color->name == $cartsAr[$i]['color']){
                                        if($color->count < json_decode($request->count)[$i]){
                                            return __('messages.no_product3',['count'=>json_decode($request->count)[$i],'color'=>$cartsAr[$i]['color'],'title'=>$post->title]);
                                        }
                                    }
                                }
                            }
                            if($cartsAr[$i]['size'] && $post->prebuy == 0){
                                foreach(json_decode($post['size']) as $size){
                                    if($size->name == $cartsAr[$i]['size']){
                                        if($size->count < json_decode($request->count)[$i]){
                                            return __('messages.no_product4',['count'=>json_decode($request->count)[$i],'color'=>$cartsAr[$i]['color'],'title'=>$post->title]);
                                        }
                                    }
                                }
                            }
                            if($post->count < json_decode($request->count)[$i] && $post->prebuy == 0){
                                return __('messages.no_product6',['count'=>json_decode($request->count)[$i],'title'=>$post->title]);
                            }
                            if($post->maxCart < json_decode($request->count)[$i]){
                                return __('messages.no_product5',['max'=>$post->maxCart,'title'=>$post->title]);
                            }
                            $cartItem = [
                                'id' => $cartsAr[$i]['id'],
                                'count' => json_decode($request->count)[$i],
                                'inquiry' => $cartsAr[$i]['inquiry'],
                                'color' => $cartsAr[$i]['color'],
                                'size' => $cartsAr[$i]['size'],
                                'number' => $cartsAr[$i]['number'],
                                'pack' => $cartsAr[$i]['pack'],
                                'guarantee_id' => $cartsAr[$i]['guarantee_id'],
                                'prebuy' => $cartsAr[$i]['prebuy'],
                                'price' => $cartsAr[$i]['price'],
                            ];
                            array_push($changeCart, $cartItem);
                        }
                    }
                    $c = collect($changeCart);
                    $response = new Response('success');
                    return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
                }
            }
        }
    }

    public function deleteCart(Request $request)
    {
        if($request->size == null || $request->size == 'null'){
            $sizes = null;
        }else{
            $sizes = $request->size;
        }
        if($request->color == null || $request->color == 'null'){
            $colors = null;
        }else{
            $colors = $request->color;
        }
        if($request->guarantee == null || $request->guarantee == 'null'){
            $guarantees = null;
        }else{
            $guarantees = $request->guarantee;
        }
        if(auth()->user()){
            if($request->pack == 1){
                $cart = Cart::where('collect_id', $request->product)->where('pack' , 1)->where('user_id', auth()->user()->id)->first();
                if($cart){
                    $cart->delete();
                }
            }else{
                $cart = Cart::where('product_id', $request->product)->where(function ($query) use($sizes) {
                    $query->where('size', $sizes)
                        ->orWhere('size' , '');
                })->where(function ($query) use($colors) {
                    $query->where('color', $colors)
                        ->orWhere('color' , '');
                })->where(function ($query) use($guarantees) {
                    $query->where('guarantee_id', $guarantees)
                        ->orWhere('guarantee_id' , '');
                })->where('user_id', auth()->user()->id)->first();
                if($cart){
                    $cart->delete();
                }
            }
            return 'success';
        }
        else{
            $myCart = request()->cookie('myCart');
            if(!empty($myCart)){
                if ($myCart){
                    $changeCart = [];
                    foreach(json_decode($myCart , true) as $item) {
                        if($request->pack == 1){
                            if ($item['id'] == $request->product) {

                            } else {
                                array_push($changeCart, $item);
                            }
                        }else{
                            if ($item['id'] == $request->product && $request->size == $item['size'] && $request->color == $item['color'] && $request->guarantee == $item['guarantee_id']) {

                            } else {
                                array_push($changeCart, $item);
                            }
                        }
                    }
                    $c = collect($changeCart);
                    $response = new Response('success');
                    return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
                }
            }
        }
    }

    public function nextCart(Request $request)
    {
        if($request->size == null || $request->size == 'null'){
            $sizes = null;
        }else{
            $sizes = $request->size;
        }
        if($request->color == null || $request->color == 'null'){
            $colors = null;
        }else{
            $colors = $request->color;
        }
        if($request->guarantee == null || $request->guarantee == 'null'){
            $guarantees = null;
        }else{
            $guarantees = $request->guarantee;
        }
        if(auth()->user()){
            $cart = Cart::where('product_id', $request->product)->where(function ($query) use($sizes) {
                $query->where('size', $sizes)
                    ->orWhere('size' , '');
            })->where(function ($query) use($colors) {
                $query->where('color', $colors)
                    ->orWhere('color' , '');
            })->where(function ($query) use($guarantees) {
                $query->where('guarantee_id', $guarantees)
                    ->orWhere('guarantee_id' , '');
            })->where('user_id', auth()->user()->id)->first();
            if($cart){
                $cart->update([
                    'number' => 1
                ]);
            }
            return 'success';
        }
        else{
            $myCart = request()->cookie('myCart');
            if(!empty($myCart)){
                if ($myCart){
                    $changeCart = [];
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->product && $request->size == $item['size'] && $request->color == $item['color'] && $request->guarantee == $item['guarantee_id']) {
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $item['count'],
                                'price' => $item['price'],
                                'color' => $item['color'],
                                'size' => $item['size'],
                                'prebuy' => $item['prebuy'],
                                'number' => 1,
                                'pack' => $item['pack'] ?? 0,
                                'inquiry' => $item['inquiry'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }

                    $c = collect($changeCart);
                    $response = new Response('success');
                    return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
                }
            }
        }
    }

    public function backCart(Request $request)
    {
        if($request->size == null || $request->size == 'null'){
            $sizes = null;
        }else{
            $sizes = $request->size;
        }
        if($request->color == null || $request->color == 'null'){
            $colors = null;
        }else{
            $colors = $request->color;
        }
        if($request->guarantee == null || $request->guarantee == 'null'){
            $guarantees = null;
        }else{
            $guarantees = $request->guarantee;
        }
        if(auth()->user()){
            $cart = Cart::where('product_id', $request->product)->where(function ($query) use($sizes) {
                $query->where('size', $sizes)
                    ->orWhere('size' , '');
            })->where(function ($query) use($colors) {
                $query->where('color', $colors)
                    ->orWhere('color' , '');
            })->where(function ($query) use($guarantees) {
                $query->where('guarantee_id', $guarantees)
                    ->orWhere('guarantee_id' , '');
            })->where('user_id', auth()->user()->id)->first();
            if($cart){
                $cart->update([
                    'number' => 0
                ]);
            }
            return 'success';
        }
        else{
            $myCart = request()->cookie('myCart');
            if(!empty($myCart)){
                if ($myCart){
                    $changeCart = [];
                    foreach(json_decode($myCart , true) as $item) {
                        if ($item['id'] == $request->product && $request->size == $item['size'] && $request->color == $item['color'] && $request->guarantee == $item['guarantee_id']) {
                            $cartItem = [
                                'id' => $item['id'],
                                'count' => $item['count'],
                                'price' => $item['price'],
                                'color' => $item['color'],
                                'pack' => $item['pack'],
                                'size' => $item['size'],
                                'number' => 0,
                                'inquiry' => $item['inquiry'],
                                'prebuy' => $item['prebuy'],
                                'guarantee_id' => $item['guarantee_id'],
                            ];
                            array_push($changeCart, $cartItem);
                        } else {
                            array_push($changeCart, $item);
                        }
                    }

                    $c = collect($changeCart);
                    $response = new Response('success');
                    return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
                }
            }
        }
    }

    public function allBackCart(Request $request)
    {
        if(auth()->user()){
            DB::table('carts')->where('user_id', auth()->user()->id)->update([
                'number' => 0
            ]);
            return 'success';
        }
        else{
            $myCart = request()->cookie('myCart');
            if(!empty($myCart)){
                if ($myCart){
                    $changeCart = [];
                    foreach(json_decode($myCart , true) as $item) {
                        $cartItem = [
                            'id' => $item['id'],
                            'count' => $item['count'],
                            'price' => $item['price'],
                            'color' => $item['color'],
                            'size' => $item['size'],
                            'pack' => $item['pack'],
                            'number' => 0,
                            'inquiry' => $item['inquiry'],
                            'prebuy' => $item['prebuy'],
                            'guarantee_id' => $item['guarantee_id'],
                        ];
                        array_push($changeCart, $cartItem);
                    }

                    $c = collect($changeCart);
                    $response = new Response('success');
                    return $response->withCookie(cookie('myCart', json_encode($changeCart), 500));
                }
            }
        }
    }

    public function setToCart(){
        $carts2 = Cart::where('user_id', auth()->user()->id)->where('number', 0)->get();
        $carts=[];
        for ( $i = 0; $i < count($carts2); $i++) {
            if($carts2[$i]['pack'] == 1){
                $send = Collection::where('id', $carts2[$i]['collect_id'])->with('user')->first();
                $data = [
                    'title' => $send->title,
                    'image' => $send->image,
                    'pack' => 1,
                    'slug' => $send->slug,
                    'user' => $send->user,
                    'product' => $send->id,
                    'prebuy' => $send->prebuy,
                    'id' => $carts2[$i]['id'],
                    'count' => $carts2[$i]['count'],
                    'size' => '',
                    'color' => '',
                    'price' => $carts2[$i]['price'],
                    'guarantee_id' => '',
                ];
                array_push($carts, $data);
            }
            else{
                $send = Product::where('id', $carts2[$i]['product_id'])->with('user')->first();
                if(!$send){
                    $carts2[$i]->delete();
                }else{
                    $data = [
                        'title' => $send->title,
                        'image' => $send->image,
                        'slug' => $send->slug, 
                        'pack' => 0,
                        'user' => $send->user,
                        'product' => $send->id,
                        'id' => $carts2[$i]['id'],
                        'count' => $carts2[$i]['count'],
                        'prebuy' => $carts2[$i]['prebuy'],
                        'size' => $carts2[$i]['size'],
                        'color' => $carts2[$i]['color'],
                        'price' => $carts2[$i]['price'],
                        'guarantee_id' => $carts2[$i]['guarantee_id'],
                    ];
                    array_push($carts, $data);
                }
            }
        };
        return $carts;
    }
}
