<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperation extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'percent',
        'product_id',
        'cat_id',
        'meta_id',
        'pay_id',
        'price',
        'type',
        'status',
    ];
}
