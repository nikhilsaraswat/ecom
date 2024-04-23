<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variationsproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'slug',
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
        'tag',
        'producttype',
    ];
    protected $casts = [
        'images'=> 'array',
    ];
}
