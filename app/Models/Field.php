<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'disable_status',
        'value',
        'type',
        'choice',
        'required_status',
        'show_status',
        'status',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %B / %Y');
    }
}
