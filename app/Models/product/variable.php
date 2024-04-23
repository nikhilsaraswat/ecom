<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variable extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute',
        'value',
    ];
}
