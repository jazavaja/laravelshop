<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','price','city','limit','language'
    ];

    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %B / %Y');
    }

    public function cities()
    {
        return $this->hasMany(CarrierCity::class , 'carrier' , 'id');
    }
}
