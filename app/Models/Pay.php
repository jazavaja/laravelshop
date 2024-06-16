<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $fillable=[
        'auth',
        'refId',
        'user_id',
        'price',
        'discount_off',
        'deliver',
        'note',
        'carrier',
        'carrier_price',
        'back',
        'time',
        'pin',
        'gate',
        'tax',
        'track',
        'property',
        'deposit',
        'method',
        'status',
    ];

    public function scopeBuildCode($query){
        do{
            $code = rand(1111111,9999999);
            $check = Pay::where('property',$code)->first();
        }while($check);
        return $code;
    }

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->morphToMany(Address::class, 'addressables');
    }
    public function carrier()
    {
        return $this->morphToMany(Carrier::class, 'carriables');
    }
    public function installments()
    {
        return $this->hasMany(Installments::class , 'pay_id' , 'id');
    }
    public function lotteryCode()
    {
        return $this->hasMany(LotteryCode::class , 'pay_id' , 'id');
    }
    public function payMeta()
    {
        return $this->hasMany(PayMeta::class);
    }
}
