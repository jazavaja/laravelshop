<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lucky extends Model
{
    use HasFactory;
    protected $fillable=[
        'background',
        'color',
        'type',
        'language',
        'value',
        'name',
    ];
}
