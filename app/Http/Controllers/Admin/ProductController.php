<?php

namespace App\Http\Controllers\Admin;
use App\Models\adminProductCategory;
use App\Models\subCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function categorypage(Request $request){
    //     $dataofuser = adminProductCategory::all();
    //     return view('adminpanel/category', compact('dataofuser'));
    // }

    public function productpage(Request $request){
        $dataofuser = Product::all();
        return view('adminpanel/product', compact('dataofuser'));
    }

    public function productcreationpage(Request $request){
        $categoryList = adminProductCategory::pluck('category','id'); // Assuming this returns the list of categories
        $subcategoryList = subCategory::pluck('subcategory','id');
        // Now $idNameList contains only id and name pairs
        
        return view('adminpanel/product/productcreate', compact('categoryList','subcategoryList'));
    }

    public function productedit($id){
        $productlistfromdatabase = Product::find($id);
        $categoryList = adminProductCategory::get(); // Assuming this returns the list of categories

        $categoryListFromDatabase = array(); // Array to store id and name pairs
        
        foreach ($categoryList as $category) {
            $categoryListFromDatabase[] = array(
                'id' => $category->id,
                'category' => $category->category
            );
        }
        return view('adminpanel/product/productedit',compact('productlistfromdatabase','categoryListFromDatabase'));
    }

    public function productcreate(Request $request){
        $inputcategory = $request->category;
        $inputsubcategory = $request->subcategory;
        $categoryname = adminProductCategory::where('id',$inputcategory )->value('category');
        if($inputsubcategory){
        $subcategoryname = subCategory::where('id',$inputsubcategory)->value('subcategory');}
        else{
            $inputsubcategory = 1111111;
            $subcategoryname = "";
        }
        $image = $request->file('image');
        if($image){
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'description'=>['required','string','max:25555555'],
                    'productshortdescription'=>['required','string','max:25555555'],
                    'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                ]);
        }else{
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'description'=>['required','string','max:25555555'],
                    'productshortdescription'=>['required','string','max:25555555'],
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                ]);
        }
        

         if($VALIDATOR->fails()){
             return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->withErrors($VALIDATOR->errors())  //Pass all validation errors
         ->withInput();
         }else{
            if($image==null){
                $imageName= "1713428191.png";
            }else{
                    $discountedvalueinpercentage = $request->discountedvalueinpercentage;
                    $discount_status = "percentage";
                    $discountedvalue = 0;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put('/public/images/' . $imageName, File::get($image));}
            $getCat_name = adminProductCategory::find($request -> category)->category;
            Product::create([
                'product'=> $request->product,
                'category_id'=> $request->category,
                'category_name' => $categoryname,
                'subcategory_id'=> $inputsubcategory,
                'subcategory_name' => $subcategoryname ,
                'productshortdescription'=> $request->productshortdescription,
                'description'=> $request->description,
                'image' => $imageName,
                'images' => "",
                'discount'=> $request->discount,
                'sellingPrice'=> $request->sellingPrice,
                'actualPrice'=> $request->actualPrice,
                'percentage'=> $request->percentage||0,
                  ]);
                   return redirect()->route('adminproductpanelcreation')
           ->with('success', 'product added successfully!');
            }
    }

    public function productdelete(Request $request, $id){
        $product_to_be_deleted = Product::find($id);
        if($product_to_be_deleted){
            $product_to_be_deleted->delete();
            return redirect()->route('adminproductpanel')
            ->with('success', 'Record deleted successfully!');
        }else{
           return redirect()->route('adminproductpanel')->with('failure', 'Record deleted failed. No user found.');
           ;
        }
    }
}
