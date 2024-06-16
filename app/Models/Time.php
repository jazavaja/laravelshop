<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'from',
        'name',
        'nameEn',
        'to',
        'day',
    ];
    public function product()
    {
        return $this->morphedByMany(Product::class, 'timables');
    }
}
