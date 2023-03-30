<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catFlanes extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'available',
        'rating',
        'discount'
    ];
}
