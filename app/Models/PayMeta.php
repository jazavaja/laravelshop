<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMeta extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'collect_id',
        'status',
        'pay_id',
        'price',
        'discount_off',
        'method',
        'cancel',
        'count',
        'profit',
        'deliver',
        'track',
        'color',
        'prebuy',
        'size',
        'guarantee_name',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }
    public function pay()
    {
        return $this->belongsTo(Pay::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class , 'collect_id' , 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->morphToMany(Address::class, 'addressables');
    }
}
