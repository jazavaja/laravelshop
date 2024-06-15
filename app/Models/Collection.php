<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable=[
        'title',
        'titleSeo',
        'body',
        'bodySeo',
        'image',
        'keyword',
        'language',
        'price',
        'off',
        'user_id',
        'offPrice',
        'count',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' H:i | %d / %B / %Y');
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function product()
    {
        return $this->morphedByMany(Product::class, 'collectables');
    }
    public function time()
    {
        return $this->morphToMany(Time::class, 'timables');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
