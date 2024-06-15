<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installments extends Model
{
    use HasFactory;
    protected $fillable=[
        'time','price','pay','status','pay_id','user_id','title'
    ];
}
