<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryCode extends Model
{
    use HasFactory;
    protected $fillable=[
        'code','letter','number','product_id','user_id','round','lottery_id','active','pay_id'
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }
    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function pay()
    {
        return $this->belongsTo(Pay::class , 'pay_id' , 'id');
    }
}
