<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'price',
        'mileage',
        'transmission',
        'fuel_type',
        'description',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}