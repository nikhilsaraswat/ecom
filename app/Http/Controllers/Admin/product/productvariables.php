<?php

namespace App\Http\Controllers\Admin\product;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\variable;

class productvariables extends Controller
{
    public function variablespage(Request $request){
        $dataofuser = variable::all();
      
        return view('adminpanel/product/variation', compact('dataofuser'));
    }
    public function variablespagecreate(Request $request){
        return view('adminpanel/product/variations/variationcreate');
    }
    public function variabledelete(Request $request, $id){
        $variable_to_be_deleted = variable::find($id);
        if($variable_to_be_deleted){
            $variable_to_be_deleted->delete();
            return redirect()->route('adminvariationpanel')
            ->with('success', 'Record deleted successfully!');
        }else{
           return redirect()->route('adminvariationpanel')->with('failure', 'Record deleted failed. No user found.');
           ;
        }
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
        if($image){
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
                    'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                    'actualPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                    'discount' => ['required','integer','min:1','digits_between:1,1000000'],
                    'sellingPrice' => ['required','integer','min:1','digits_between:1,1000000'],
                ]);
        }else{
                $VALIDATOR= Validator::make($request->all(),[
                    'product'=>['required','string','max:255'],
                    'slug'=>['required','string','max:255'],
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
                    $productlistfromdatabase->product= $request->product;
                    $productlistfromdatabase->slug = $request->slug;
                    $productlistfromdatabase->category_id= $request->category;
                    $productlistfromdatabase->category_name = $categoryname;
                    $productlistfromdatabase->subcategory_id= $inputsubcategory;
                    $productlistfromdatabase->subcategory_name = $subcategoryname ;
                    $productlistfromdatabase->productshortdescription= $productshortdescription;
                    $productlistfromdatabase->description= $description;
                    $productlistfromdatabase->discount= $request->discount;
                    $productlistfromdatabase->sellingPrice= $request->sellingPrice;
                    $productlistfromdatabase->actualPrice= $request->actualPrice;
                    $productlistfromdatabase->percentage= $request->percentage||0;
                    $productlistfromdatabase->save();
                       return redirect()->route('adminproductpanel')
               ->with('success', 'product added successfully!');
            

    }}
    public function variableedit($id){
        $variablelistfromdatabase = variable::find($id);

        return view('adminpanel/product/variations/variationedit',compact('variablelistfromdatabase'));
    }
    public function variablescreate(Request $request){
       
            $VALIDATOR= Validator::make($request->all(),[
                'attribute'=>['required','string','max:255'],
                'value'=>['required','string','max:255'],
            ]);

         if($VALIDATOR->fails()){
             return redirect()->route('adminvariationpanelcreate')  //Redirect to register route
             ->withErrors($VALIDATOR->errors())  //Pass all validation errors
         ->withInput();
         }else{
            $value = explode(',', $request->value);
          
            variable::create([
                      'attribute' => $request->attribute,
                      'value' => json_encode($value),
                  ]);
                   return redirect()->route('adminvariationpanel')
           ->with('success', 'category added successfully!');
            }
    }
    public function variableupdate(Request $request,$id){
       
        $VALIDATOR= Validator::make($request->all(),[
            'attribute'=>['required','string','max:255'],
            'value'=>['required','string','max:255'],
        ]);

     if($VALIDATOR->fails()){
         return redirect()->route('adminvariationpanelcreate')  //Redirect to register route
         ->withErrors($VALIDATOR->errors())  //Pass all validation errors
     ->withInput();
     }else{
        $value = explode(',', $request->value);
        $variablelistfromdatabase = variable::find($id);
        $variablelistfromdatabase->attribute= $request->attribute;
        $variablelistfromdatabase->value = json_encode($value);
        $variablelistfromdatabase->save();
               return redirect()->route('adminvariationpanel')
       ->with('success', 'variable updated successfully!');
        }
}
    
}
