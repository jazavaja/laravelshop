<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable=[
        'data',
        'user_id',
        'reportable_id',
        'reportable_type',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }
    public function reportable()
    {
        return $this->morphTo();
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
