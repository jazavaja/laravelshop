<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'price',
        'color',
        'prebuy',
        'size',
        'pack',
        'collect_id',
        'number',
        'inquiry',
        'guarantee_id',
        'product_id',
        'time',
        'user_id',
        'discount',
        'count',
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
    public function guarantee()
    {
        return $this->hasMany(Guarantee::class , 'id' , 'guarantee_id');
    }
    public function carrier()
    {
        return $this->morphToMany(Carrier::class, 'carriables');
    }
}
