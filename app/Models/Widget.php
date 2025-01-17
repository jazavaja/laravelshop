<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Widget extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'title',
        'more',
        'height',
        'move',
        'description',
        'responsive',
        'background',
        'language',
        'slug',
        'background2',
        'count',
        'sort',
        'type',
        'status',
        'brands',
        'cats',
        'ads1',
        'ads2',
        'ads3',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($instance) {
            Cache::forget('product.'.$instance->slug);
            Cache::forget('related.'.$instance->slug);
            Cache::forget('index');
        });

        static::deleting(function ($instance) {
            Cache::forget('product.'.$instance->slug);
            Cache::forget('index');
            Cache::forget('related.'.$instance->slug);
        });
    }
}
