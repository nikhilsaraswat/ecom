<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'category_id',
        'category_name',
        'subcategory_id',
        'subcategory_name',
        'productshortdescription',
        'description',
        'image',
        'images',
        'discount',
        'sellingPrice',
        'actualPrice',
        'percentage',
    ];
}
