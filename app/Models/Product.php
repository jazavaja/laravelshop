<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Product extends Model implements Feedable
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
        'title',
        'titleEn',
        'titleSeo',
        'prepare',
        'priceBuy',
        'prePrice',
        'note',
        'prebuy',
        'state',
        'city',
        'bodySeo',
        'weight',
        'keywordSeo',
        'image3d',
        'imageCount3d',
        'imageFirstCount',
        'numLottery1',
        'numLottery2',
        'letterLottery',
        'lotteryStatus',
        'weight',
        'currency_id',
        'imageAlt',
        'language',
        'short',
        'type',
        'score',
        'status',
        'showcase',
        'used',
        'original',
        'suggest',
        'image',
        'count',
        'maxCart',
        'minCart',
        'slug',
        'variety',
        'price',
        'off',
        'offPrice',
        'priceCurrency',
        'user_id',
        'product_id',
        'body',
        'rate',
        'specifications',
        'ability',
        'colors',
        'inquiry',
        'levels',
        'size',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeBuildCode($query){
        do{
            $code = rand(111111,999999);
            $check = Product::where('product_id' , $code)->first();
        }while($check);
        return $code;
    }

    public function toFeedItem(): FeedItem
    {
        if($this->short){
            $short =$this->short;
        }else{
            $short ='بدون توضیحات';
        }
        if($this->user){
            $author =$this->user->name;
        }else{
            $name = User::where('admin' , 1)->pluck('name')->first();
            $author = $name;
        }
        if($this->titleSeo){
            $title =$this->titleSeo;
        }else{
            $title =$this->title;
        }
        return FeedItem::create([
            'id' => $this->id,
            'title' => $title,
            'summary' => $short,
            'updated' => $this->updated_at,
            'link' => '/product/'. $this->slug,
            'author' => $author,
            'image' => $this->image,
        ]);
    }

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %m / %Y');
    }
    public static function getFeedItems()
    {
        return Product::latest()->where('status' , 1)->get();
    }
    public function category()
    {
        return $this->morphToMany(Category::class, 'catables');
    }
    public function tag()
    {
        return $this->morphToMany(Tag::class, 'taggables');
    }
    public function video()
    {
        return $this->morphMany(Video::class, 'videoable');
    }
    public function brand()
    {
        return $this->morphToMany(Brand::class, 'brandables');
    }
    public function lottery()
    {
        return $this->hasMany(Lottery::class , 'product_id' , 'id');
    }
    public function guarantee()
    {
        return $this->morphToMany(Guarantee::class, 'guarantables');
    }
    public function time()
    {
        return $this->morphToMany(Time::class, 'timables');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class , 'product_id' , 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class , 'product_id' , 'id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class , 'product_id' , 'id');
    }
    public function payMeta()
    {
        return $this->hasMany(PayMeta::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class , 'product_id' , 'id');
    }
    public function bookmark()
    {
        return $this->hasMany(Bookmark::class , 'product_id' , 'id');
    }
    public function product()
    {
        return $this->hasMany(Product::class , 'variety' , 'id');
    }
    public function view()
    {
        return $this->morphMany(View::class, 'viewable');
    }
    public function collection()
    {
        return $this->morphToMany(Collection::class, 'collectables');
    }
    public function fields()
    {
        return $this->hasMany(FieldData::class,'model_id' , 'id')->where('type' , '=' , 1);
    }
}
