<?php

namespace App\Http\Controllers\Admin;
use App\Models\subCategory;
use App\Models\adminProductCategory;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;

class subCategoryController extends Controller
{
    public function subcategorypage(Request $request){
        $dataofsubcategory = subCategory::all();


return view('adminpanel/subcategory', compact('dataofsubcategory'));
    }
    public function subcategorycreationpage(Request $request){
        $dataofcategory = adminProductCategory::all();
        return view('adminpanel/subcategory/subcategorycreate', compact('dataofcategory'));
    }
    public function subcategorycreate(Request $request, $id){
        $image = $request->file('image');
         $category_name = adminProductCategory::where('id',$request->category)->value('category');
        if($image){
            $VALIDATOR= Validator::make($request->all(),[
                'subcategory'=>['required','string','max:255'],
                'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ]);
        }else{
            $VALIDATOR= Validator::make($request->all(),[
                'subcategory'=>['required','string','max:255'],
            ]);
        }
        

         if($VALIDATOR->fails()){
             return redirect()->route('admincategorypanelcreation')  //Redirect to register route
             ->withErrors($VALIDATOR->errors())  //Pass all validation errors
         ->withInput();
         }else{
            if($image==null){
                $imageName= "1713428191.png";
            }
            else{
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put('/public/images/' . $imageName, File::get($image));
        }

        subCategory::create([
                        'category_id' =>$request->category,
                        'category_name'=>$category_name,
                      'subcategory' => $request->subcategory,
                      'image' => $imageName,
                  ]);
                   return redirect()->route('adminsubcategorypanel')
           ->with('success', 'category added successfully!');
            }
    }
    public function subcategoryedit($id){
        $subcategorylistfromdatabase = subCategory::find($id);
        $dataofcategory = adminProductCategory::all();
        return view('adminpanel/subcategory/subcategoryedit',compact('subcategorylistfromdatabase','dataofcategory'));
    }
    public function subcategorydelete(Request $request, $id){
        $subcategory_to_be_deleted = subCategory::find($id);
        $subcategory = $subcategory_to_be_deleted->subcategory;
        $product = Product::where("subcategory_name",$subcategory)->value('product');
        if($product ){
            return redirect()->route('adminsubcategorypanel')->with('failure', 'cannot be deleted contains products.');
        }else{
        if($subcategory_to_be_deleted){
            $subcategory_to_be_deleted->delete();
            return redirect()->route('adminsubcategorypanel')
            ->with('success', 'Record deleted successfully!');
        }else{
           return redirect()->route('adminsubcategorypanel')->with('failure', 'Record deleted failed. No user found.');
           ;
        }}
    }
    public function subcategoryupdate(Request $request, $id){
            if($request->input('image')!=null){
                $VALIDATOR = Validator::make($request->all(),[
                    'subcategory'=>['required','string','max:255'],
                    'image'=> 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
                ]);
            }else{
                $VALIDATOR = Validator::make(['subcategory'=>$request->input('subcategory')],[
                    'subcategory'=>['required','string','max:255'],
                ]);
            }
            if($VALIDATOR->fails()){
                return redirect()->route('adminpanelsubcategoryedit', compact('id'))
                ->withErrors($VALIDATOR->errors())
                ->withInput();
            }else{
                $categoryfromdatabase = adminProductCategory::where('id',$request->category)->value('category');
                $subcategorylistfromdatabase = subCategory::find($id);
                $subcategorylistfromdatabase->subcategory = $request->input('subcategory');
                $subcategorylistfromdatabase->category_name = $categoryfromdatabase ;
                $subcategorylistfromdatabase->category_id = $request->input('category');
                $image = $request->file('image');
                if($image){
                $imageName = time().'.'.$image->getClientOriginalExtension();
                Storage::disk('local')->put('/public/images/'.$imageName, File::get($image));
                $subcategorylistfromdatabase->image = $imageName;
            }
                $subcategorylistfromdatabase->save();
                return redirect()->route('adminsubcategorypanel')
                ->with('success','Record edited successfully');
            }
            
    
        
    }
}
