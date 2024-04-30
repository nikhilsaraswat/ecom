<?php

namespace App\Http\Controllers\Admin\product;
use App\Models\adminProductCategory;
use App\Models\subCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\Models\Product;
use App\Models\product\variationsproduct ;
use App\Models\product\variable ;
class productvariableswithproductController extends Controller
{
    public function variablespagewithproduct(Request $request){
        $dataofuser = variationsproduct::all();
        return view('adminpanel/product/variationproduct', compact('dataofuser'));
    }
    public function variables_page_create_with_product(Request $request){
        $productList = Product::pluck('product','id')->unique();
        $variableList = variable::pluck('attribute','value')->unique();
        $categoryList = adminProductCategory::pluck('category','id')->unique(); // Assuming this returns the list of categories
        $subcategoryList = subCategory::all();
        // Now $idNameList contains only id and name pairs
        
        return view('adminpanel.product.variableproduct.variableproductcreate', compact('categoryList','subcategoryList','productList','variableList')); 
    }
    public function variable_update_with_product(Request $request, $id ){
        $productlistfromdatabase = variationsproduct::find($id);
        $percentage = $request->percentage;
        $disc = $request->discount;
        $actpri = $request->actualPrice;
        if($percentage==null && $disc>$actpri){
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->with('failure', "discount value in rupees cannot be greater than the actual price");  //Pass all validation errors
        }
        else if($percentage==1 && $disc>100){
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->with('failure', "discount value n percentage cannt be greater than 100");  //Pass all validation errors
        }
        $inputcategory = $request->category;
        $inputsubcategory = $request->subcategory;
        $categoryname = adminProductCategory::where('id',$inputcategory )->value('category');
        if($inputsubcategory){
        $subcategoryname = subCategory::where('id',$inputsubcategory)->value('subcategory');}
        else{
            $inputsubcategory = 0;
            $subcategoryname = "";
        }
        $image = $request->file('image');
        if(
            $request->producttype == "Simple"
        ){
            
        
        if($image){
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'tags'=>['required','string','max:255'],
                ]);
        }else{
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'tags'=>['required','string','max:255'],
                ]);
        }
    }else{
        if($image){
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
                'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                'tags'=>['required','string','max:255'],
            ]);
    }else{
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
                'tags'=>['required','string','max:255'],
            ]);
    }
    }

         if($VALIDATOR->fails()){
             return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->withErrors($VALIDATOR->errors())  //Pass all validation errors
         ->withInput();
         }else{
            if($image==null){
            }
            else{
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put('/public/images/' . $imageName, File::get($image));
                $productlistfromdatabase->image = $imageName;
            }
                $getCat_name = adminProductCategory::find($request -> category)->category;
                $data['imagess']=[];
                $images = $request->images;
                if($images!=null){
                    foreach($images as $key=>$images){
                        $imageNames = $key.time() . '.' . $images->getClientOriginalExtension();
                        Storage::disk('local')->put('/public/images/' . $imageNames, File::get($images));
                        $data['imagess'][]= $imageNames;
                    }
                    $productlistfromdatabase->images = $data['imagess'];
                }
                if($request->productshortdescription){
                    $productshortdescription = $request->productshortdescription;
                }else{
                    $productshortdescription = "";
                }
                if($request->description){
                    $description = $request->description;
                }else{
                    $description = "";
                }
                if($request->sellingPrice>$request->actualPrice){
                    return redirect()->route('adminvariationproductpanel')  //Redirect to register route
             ->with('failure', "user not edited as selling price cannot be greter than actual price");
                }
                $tag = explode(',', $request->tags);
                $productlistfromdatabase->tag= json_encode($tag);
                    $productlistfromdatabase->product= $request->product;
                    $productlistfromdatabase->slug = $request->slug;
                    $productlistfromdatabase->producttype= $request->producttype;
                    $productlistfromdatabase->category_id= $request->category;
                    $productlistfromdatabase->category_name = $categoryname;
                    $productlistfromdatabase->subcategory_id= $inputsubcategory;
                    $productlistfromdatabase->subcategory_name = $subcategoryname ;
                    $productlistfromdatabase->productshortdescription= $productshortdescription;
                    $productlistfromdatabase->description= $description;
                    $productlistfromdatabase->discount= $request->discount||0;
                    $productlistfromdatabase->sellingPrice= $request->sellingPrice||0;
                    $productlistfromdatabase->actualPrice= $request->actualPrice||0;
                    $productlistfromdatabase->percentage= $request->percentage||0;
                    $productlistfromdatabase->save();
                       return redirect()->route('adminvariationproductpanel')
               ->with('success', 'product added successfully!');
            

    }}
    public function variable_edit_with_product($id){
        $productlistfromdatabase = variationsproduct::find($id);
        $categoryList = adminProductCategory::pluck('id','category')->unique();
        $subcategoryList = subCategory::all();

        return view('adminpanel.product.variableproduct.variableproductedit',compact('productlistfromdatabase','categoryList','subcategoryList'));
    }

    public function variables_create_with_product(Request $request){
        $percentage = $request->percentage;
        $disc = $request->discount;
        $actpri = $request->actualPrice;
        if($percentage==null && $disc>$actpri){
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->with('failure', "discount value in rupees cannot be greater than the actual price");  //Pass all validation errors
        }
        else if($percentage==1 && $disc>100){
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->with('failure', "discount value n percentage cannt be greater than 100");  //Pass all validation errors
        }
        $inputcategory = $request->category;
        $inputsubcategory = $request->subcategory;
        $categoryname = adminProductCategory::where('id',$inputcategory )->value('category');
        if($inputsubcategory){
        $subcategoryname = subCategory::where('id',$inputsubcategory)->value('subcategory');}
        else{
            $inputsubcategory = 0;
            $subcategoryname = "";
        }
        $image = $request->file('image');
        if(
            $request->producttype == "Simple"
        ){
        if($image){
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'tags'=>['required','string','max:255'],
                ]);
        }else{
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'tags'=>['required','string','max:255'],
                ]);
        }
        
    }else{
        if($image){
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
                'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                'tags'=>['required','string','max:255'],
            ]);
    }else{
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
                'tags'=>['required','string','max:255'],
            ]);
    }}
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
            $data['imagess']=[];
            $images = $request->images;
        if($images!=null){
            foreach($images as $key=>$images){
                $imageNames = $key.time() . '.' . $images->getClientOriginalExtension();
                Storage::disk('local')->put('/public/images/' . $imageNames, File::get($images));
                $data['imagess'][]= $imageNames;
            }
        }
            if($request->productshortdescription){
                $productshortdescription = $request->productshortdescription;
            }else{
                $productshortdescription = "";
            }
            if($request->description){
                $description = $request->description;
            }else{
                $description = "";
            }
            if($request->sellingPrice>$request->actualPrice){
                return redirect()->route('adminvariationproductpanelcreate')  //Redirect to register route
         ->with('failure', "user not edited as selling price cannot be greter than actual price");
            }
            $tag = explode(',', $request->tags);
            variationsproduct::create([
                'product'=> $request->product,
                'slug' => $request->slug,
                'category_id'=> $request->category,
                'category_name' => $categoryname,
                'subcategory_id'=> $inputsubcategory,
                'subcategory_name' => $subcategoryname ,
                'productshortdescription'=> $productshortdescription,
                'description'=> $description,
                'image' => $imageName,
                'images' => $data['imagess'],
                'discount'=> $request->discount||0,
                'sellingPrice'=> $request->sellingPrice||0,
                'actualPrice'=> $request->actualPrice||0,
                'percentage'=> $request->percentage||0,
                'tag' => json_encode($tag),
                'producttype' => $request->producttype,
                  ]);
                   return redirect()->route('adminvariationproductpanel')
           ->with('success', 'product added successfully!');
            }
    }

    public function variable_delete_with_product(Request $request, $id){
        $product_to_be_deleted = variationsproduct::find($id);
        if($product_to_be_deleted){
            $product_to_be_deleted->delete();
            return redirect()->route('adminvariationproductpanel')
            ->with('success', 'Record deleted successfully!');
        }else{
           return redirect()->route('adminvariationproductpanel')->with('failure', 'Record deleted failed. No user found.');
           ;
        }
    }
}
