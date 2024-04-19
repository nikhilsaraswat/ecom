<?php

namespace App\Http\Controllers\Admin;
use App\Models\adminProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function categorypage(Request $request){
    //     $dataofuser = adminProductCategory::all();
    //     return view('adminpanel/category', compact('dataofuser'));
    // }

    public function productpage(Request $request){
        $dataofuser = adminProductCategory::all();
        return view('adminpanel/product', compact('dataofuser'));
    }
}
