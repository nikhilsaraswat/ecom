<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'slug',
        'category_id_subcategory_id_array',
        'description',
        'productshortdescription',
        'image',
        'images',
        'sellingPrice',
        'actualPrice',
        'percentage',
        'tag',
        'producttype',
        // ADDING NEW
        'preordraft',
        'virtual',
        'downloadable',
        'fromdate',
        'todate',
        'producturl',
        'buttontext',
        'sku',
        'stockmanagement',
        'stockstatus', // 'stock', 'out of stock', 'on back order'
        'soldind',
        'initnostock',
        'wtkg',
        'product_dimension_array', //'len','width','ht',
        'productship',
        'upsell',
        'xsell',
        'groupsell',
        'attributes_array',
        'purchasenote',
        'menuorder',
        'facebooksync',
        'facebookdescription',
        'facebookimage',
        'customimage',
        'customeimageurl',
        'facebookprice',
        'productvariation_array',
        'statustype',
        'visiblity_array', // 'passwordprotect', 'passvisible', 'private',
        'publishimorcustom_array', // combine year, mm, day, hr, and min
        'cat_visibility', //'sser', 'so', 'sro', 'hid',
        'featured',


    ];
    protected $casts = [
        'images'=> 'array',
        'publishimorcustom_array'=> 'array',
        'visiblity_array'=> 'array',
        'productvariation_array'=> 'array',
        'attributes_array'=>'array',
        'category_id_subcategory_id_array'=>'array',
        'product_dimension_array'=>'array',
    ];
}
