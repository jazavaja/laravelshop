<?php

namespace App\Models;

use App\Mail\SendMail;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Ghasedak\GhasedakApi;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use soapclient;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'number',
        'admin',
        'buy',
        'profile',
        'shaba',
        'landingPhone',
        'password',
        'referral',
        'parent_id',
        'seller',
        'suspension',
    ];

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeBuildCode($query){
        do{
            $code = rand(1111111,9999999);
            $check = User::where('referral',$code)->first();
        }while($check);
        return $code;
    }
    public function isOnline(){

        return Cache::has('user-is-online-' . $this->id);
    }
    use SendSmsTrait;

    public function cart()
    {
        return $this->hasMany(Cart::class , 'user_id' , 'id');
    }

    public function address()
    {
        return $this->morphToMany(Address::class, 'addressables');
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class , 'user_id' , 'id');
    }
    public function like()
    {
        return $this->hasMany(Like::class , 'user_id' , 'id');
    }
    public function product()
    {
        return $this->hasMany(Product::class , 'user_id' , 'id');
    }
    public function cooperation()
    {
        return $this->hasMany(Cooperation::class , 'meta_id' , 'id');
    }
    public function cooperation2()
    {
        return $this->hasMany(Cooperation::class , 'user_id' , 'id');
    }
    public function subcategory()
    {
        return $this->hasMany(User::class , 'referral' , 'parent_id');
    }
    public function wallet()
    {
        return $this->hasMany(Wallet::class , 'user_id' , 'id');
    }
    public function pay()
    {
        return $this->hasMany(Pay::class , 'user_id' , 'id');
    }
    public function document()
    {
        return $this->hasMany(Document::class , 'user_id' , 'id');
    }
    public function genuine()
    {
        return $this->belongsTo(Genuine::class , 'id' , 'user_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class , 'id' , 'user_id');
    }
    public function lotteryCode()
    {
        return $this->belongsTo(LotteryCode::class , 'id' , 'user_id');
    }
    public function comments()
    {
        return $this->belongsTo(Comment::class , 'id' , 'user_id');
    }
    public function installments()
    {
        return $this->belongsTo(Installments::class , 'id' , 'user_id');
    }
    public function report()
    {
        return $this->belongsTo(Report::class , 'id' , 'user_id');
    }
    public function counseling()
    {
        return $this->belongsTo(Counseling::class , 'id' , 'user_id');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class , 'id' , 'user_id');
    }
    public function category()
    {
        return $this->morphToMany(Category::class, 'catables');
    }
    public function fields()
    {
        return $this->hasMany(FieldData::class,'model_id' , 'id')->where('type' , '=' , 0);
    }
}
