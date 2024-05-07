<?php

namespace App\Http\Controllers\Admin;
use App\Models\adminProductCategory;
use App\Models\subCategory;
use App\Models\product\variable;
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
        $dataofvariables = variable::all();
        return view('adminpanel/product', compact('dataofuser'));
    }

    public function productcreationpage(Request $request){
        $dataofvariables = variable::all();
        $categoryList = adminProductCategory::pluck('category','id')->unique(); // Assuming this returns the list of categories
        $subcategoryList = subCategory::all();
        // Now $idNameList contains only id and name pairs

        
        return view('adminpanel/product/productcreate', compact('categoryList','subcategoryList','dataofvariables'));
    }

    public function productupdate(Request $request, $id ){
        $productlistfromdatabase = Product::find($id);
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
                    return redirect()->route('adminproductpanel')  //Redirect to register route
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
                       return redirect()->route('adminproductpanel')
               ->with('success', 'product added successfully!');
            

    }}
    public function productedit($id){
        $productlistfromdatabase = Product::find($id);
        $categoryList = adminProductCategory::pluck('id','category')->unique();
        $subcategoryList = subCategory::all();

        return view('adminpanel/product/productedit',compact('productlistfromdatabase','categoryList','subcategoryList'));
    }

    public function productcreate(Request $request){
        // dd($request);
        $valuescat = [];
        $currentCategory = null;
        $currentSubcategories = [];
        
        foreach ($request->all() as $key => $value) {
            // Extract category and subcategory number from the key
            if (preg_match('/^(category|subcategory)(\d+)$/', $key, $matches)) {
                $type = $matches[1];
                $index = (int) $matches[2];
                
                // If it's a category
                if ($type === 'category') {
                    // If not the first category, store the previous category and its subcategories
                    if ($currentCategory !== null) {
                        $valuescat[] = [
                            'category' => $currentCategory,
                            'subcategories' => $currentSubcategories,
                        ];
                        // Reset subcategories for the new category
                        $currentSubcategories = [];
                    }
                    // Update current category
                    $currentCategory = $value;
                } else { // If it's a subcategory
                    // Add subcategory to the current subcategories if there's a current category
                    if ($currentCategory !== null) {
                        $currentSubcategories[] = $value;
                    }
                }
            }
        }
        
        // Store the last category and its subcategories
        if ($currentCategory !== null) {
            $valuescat[] = [
                'category' => $currentCategory,
                'subcategories' => $currentSubcategories,
            ];
        }
        $desiredValues = [];

// Iterate over the request data
foreach ($request->all() as $key => $value) {
    // Check if the value starts with a hash symbol (#)
    if (is_string($value) && strpos($value, '#') === 0) {
        // Add the value to the desired values array
        $desiredValues[$key] = $value;
    }
}
$matchingObjects = [];

foreach ($request->all() as $key => $value) {
    // Check if the key contains any of the desired values
    foreach ($desiredValues as $desiredKey => $desiredVal) {
        if (strpos($key, $desiredKey) !== false) {
            // Remove the desired key from the original key
            $modifiedKey = str_replace($desiredKey, '', $key);

            // Group the object by the desired key
            if (!isset($matchingObjects[$desiredKey])) {
                $matchingObjects[$desiredKey] = (object) [];
            }

            // Add the matching key-value pair to the object
            $matchingObjects[$desiredKey]->{$modifiedKey} = $value;
        }
    }
}
        $maxIndex = null;

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    $variableName = "attributename" . $i;

    if (isset($request->$variableName)) {
        $maxIndex = $i;
    } else {
        // If the variable doesn't exist, break the loop
        break;
    }
}
$values = [];

for ($i = 0; $i <= $maxIndex; $i++) {
    $attributeName = "attributename" . $i;
    $votppname = "votppname" . $i;
    $ufvname = "ufvname" . $i;
    $valuename = "valuename" . $i;

    // Check if all variables exist
    if (isset($request->$attributeName, $request->$votppname, $request->$ufvname, $request->$valuename)) {
        // Add values to the array
        $values[] = [
            'attributename' => $request->$attributeName,
            'votppname' => $request->$votppname,
            'ufvname' => $request->$ufvname,
            'valuename' => $request->$valuename,
        ];
    } else {
        // Break the loop if any variable is missing
        break;
    }
}
     
        $validatedData = $request->validate([
            'producturl' => 'nullable|url',
        ]);
        if($validatedData ){

        }else{
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->with('url', "not a valid url");  //Pass all validation errors
        };
        if($request->stockstatus){
            $stockstatus = "instock";
        }
        else if($request->outofstock){
            $stockstatus = "outofstock";
        }
        else if($request->onbackorder){
            $stockstatus = "onbackorder";
        }
        if(
            $request-> producttype == "Grouped"
          ){
            $grouped = $request->xsell;
          }
          if($request->password_protected){
            $visibility_array = ["password protected", $request->passvisible];
         }
         else if($request->Public){
            $visibility_array = ["public"];
         }
         else if($request->private){
            $visibility_array = ["private"];
         }
         if($request->SSER){
            $visibilitycat = "Shop and search results";
          }
          else if($request->SO){
            $visibilitycat = "Shop only";
          }
          else if($request->SRO){
            $visibilitycat = "Search results only";
          }
          else if($request->hid){
            $visibilitycat = "Hidden";
          }
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
        // $inputcategory = $request->category;
        // $inputsubcategory = $request->subcategory;
        // $categoryname = adminProductCategory::where('id',$inputcategory )->value('category');
        // if($inputsubcategory){
        // $subcategoryname = subCategory::where('id',$inputsubcategory)->value('subcategory');}
        // else{
        //     $inputsubcategory = 0;
        //     $subcategoryname = "";
        // }
        $slugValue = $request->slug;
        $slugShouldBeUnique = Product::where('slug',$slugValue )->value('slug');
        if(
            $slugShouldBeUnique != $slugValue
        ){
            
        
        $image = $request->file('image');
        if(
            $request->producttype == "Simple"
        ){
        if($image){
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                    'actualPrice' => ['','integer','min:1','digits_between:1,1000000'],
                ]);
        }else{
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],

                ]);
        }
        
    }else{
        if($image){
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
                'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ]);
    }else{
            $VALIDATOR= Validator::make($request->all(),[
                'product'=>['required','string','max:255'],
                'slug'=>['required','string','max:255'],
            ]);
    }}
         if($VALIDATOR->fails()){
             return redirect()->route('adminproductpanelcreation')  //Redirect to register route
             ->withErrors($VALIDATOR->errors());  //Pass all validation errors;
         }else{
            if($image==null){
                $imageName= "1713428191.png";
            }else{
                    $discountedvalueinpercentage = $request->discountedvalueinpercentage;
                    $discount_status = "percentage";
                    $discountedvalue = 0;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put('/public/images/' . $imageName, File::get($image));}
            // $getCat_name = adminProductCategory::find($request -> category)->category;
            $data['imagess']=[];
            $images = $request->images;
        if($images!=null){
            foreach($images as $key=>$images){
                $imageNames = $key.time() . '.' . $images->getClientOriginalExtension();
                Storage::disk('local')->put('/public/images/' . $imageNames, File::get($images));
                $data['imagess'][]= $imageNames;
            }
        }
            if($request->description){
                $description = $request->description;
            }else{
                $description = "";
            }
            if($request->sellingPrice>$request->actualPrice){
                return redirect()->route('adminproductpanelcreation')  //Redirect to register route
         ->with('failure', "user not edited as selling price cannot be greter than actual price");
            }
// Remove square brackets and split the string by commas
$tagsArray = preg_split('/,/', trim( $request->tags, '[]'));

$resultArray = [];

// Iterate through each element in the tagsArray
foreach ($tagsArray as $tag) {
    // Remove the X character from each tag and trim any extra spaces
    $tagWithoutX = str_replace('✗', '', $tag);
    $tagWithoutXTrimmed = trim($tagWithoutX);

    // Add the modified tag to resultArray
    $resultArray[] = $tagWithoutXTrimmed;
}
if($request->hrtype&&$request->mintype&&$request->monthtype&&$request->daytype&&$request->yeartype){
$timestamp = mktime($request->hrtype, $request->mintype, 0, $request->monthtype, $request->daytype, $request->yeartype);}
else{
    $timestamp = time();
}

if($request->producttype =="Variable" && $matchingObjects){
    $producttype = "Variable";
}else if($request->producttype =="Variable" && $matchingObjects == []){
    $producttype = "Simple";
}else{
    $producttype = $request->producttype;
}
            Product::create([
                'product'=> $request->product??"",
                'slug' => $request->slug??"",
                'productshortdescription'=> $request->productshortdescription,
                'description'=> $description??"",
                'image' => $imageName??"",
                'images' => $data['imagess']??"",
                'sellingPrice'=> $request->sellingPrice??0,
                'actualPrice'=> $request->actualPrice??0,
                'percentage'=> $request->percentage??0,
                'tag' => json_encode($resultArray)??"",
                'producttype' => $producttype??"",
                'preordraft' => $request->clickbutton??"",
                'virtual'=> $request->virtual??0,
                'downloadable'=> $request->downloadable??0,
                'fromdate'=> $request->fromDate??"",
                'todate'=> $request->toDate??"",
                'producturl' => $request->producturl??"",
                'buttontext' => $request->buttontext??"",
                'sku' => $request->sku??"",
                'stockmanagement' => $request->stockmanagement??"",
                'stockstatus' => $stockstatus??"",
                'soldind' => $request->soldind??"",
                'initnostock' => $request->initnostock??"",
                'wtkg' => $request->wtkg??"",
                'product_dimension_array' =>  [$request->len,$request->width,$request->ht]??"",
                'productship' =>  $request->productship??"",
                'upsell'=> $request->upsell??"",
                'xsell'=> $request->xsell??"",
                'groupsell'=> $grouped??"",
                'purchasenote'=>  $request->purchaseNote??"",
                'menuorder'=>  $request->menuorder??"",
                'facebooksync'=>  $request->facebooksync??"",
                'facebookdescription'=>  $request->facebookdescription??"",
                'usewcimage'=>  $request->usewcimage??0,
                'customimage'=>  $request->customimage??0,
                'facebookprice'=>  $request->facebookprice??0,
                'statustype'=>  $request->clickbutton??"",
                'visiblity_array'=> $visibility_array ??"",
                'featured'=>  $request->featured??0,
                'publishimorcustom_array'=>  [$timestamp]??[],
                'cat_visibility'=>  $visibilitycat??"immediately",
                'attributes_array'=>  $values??"",
                'productvariation_array'=>  $matchingObjects??"",
                'category_id_subcategory_id_array'=>  $valuescat??"",

                  ]);
                  
                   return redirect()->route('adminproductpanel')
           ->with('success', 'product added successfully!');
            }
        }else{
            return redirect()->route('adminproductpanelcreation')  //Redirect to register route
         ->with('failure', "not unique slug please make it unique");
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
// ajax requests
    public function fetchDataOfAttributes(){
        $dataofvariables = variable::pluck('attribute');

        // Return the data as JSON
        return response()->json($dataofvariables);
    }
    //ajax requests end
}


