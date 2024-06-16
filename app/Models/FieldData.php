<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldData extends Model
{
    use HasFactory;
    protected $fillable=[
        'field_id',
        'value',
        'model_id',
        'type',
    ];
    public function getCreatedAtAttribute($value)
    {
        return verta($value)->format(' %d / %B / %Y');
    }
    public function field(){
        return $this->hasMany(Field::class , 'id' , 'field_id');
    }
}
