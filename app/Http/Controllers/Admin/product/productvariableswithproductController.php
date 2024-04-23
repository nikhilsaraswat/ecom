<?php

namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\Models\Product;
use App\Models\variationsproduct ;
class productvariableswithproductController extends Controller
{
    public function variablespagewithproduct(Request $request){
        $dataofuser = Product::all();
        return view('adminpanel/product/variationproduct', compact('dataofuser'));
    }
}
