<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CarritoVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'discount',
        'finalprice',
        'idusers'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
