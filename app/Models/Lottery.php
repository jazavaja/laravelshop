<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','body','link','round','status','user_id','code','parent_id','product_id'
    ];

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format('%d / n / %Y');
    }
    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function lotteryCode()
    {
        return $this->hasMany(LotteryCode::class , 'lottery_id' , 'id');
    }
    public function winner()
    {
        return $this->hasMany(Lottery::class , 'parent_id' , 'id');
    }
}
