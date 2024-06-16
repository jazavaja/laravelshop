<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompareProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'image1',
        'image2',
        'language',
        'link',
        'text1',
        'text2',
    ];
}
