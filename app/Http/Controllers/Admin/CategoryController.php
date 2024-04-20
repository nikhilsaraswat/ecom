<?php

namespace App\Http\Controllers\Admin;
// use App\Models\Product;
use App\Models\adminProductCategory;
use App\Models\subCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categorypage(Request $request){
        $dataofcategory = adminProductCategory::all();
return view('adminpanel/category', compact('dataofcategory'));
    }
    public function categorycreationpage(Request $request){
        return view('adminpanel/category/categorycreate');
    }
    public function categorycreate(Request $request){
        $image = $request->file('image');
        if($image){
            $VALIDATOR= Validator::make($request->all(),[
                'name'=>['required','string','max:255'],
                'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ]);
        }else{
            $VALIDATOR= Validator::make($request->all(),[
                'name'=>['required','string','max:255'],
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

            adminProductCategory::create([
                      'category' => $request->name,
                      'image' => $imageName,
                  ]);
                   return redirect()->route('admincategorypanel')
           ->with('success', 'category added successfully!');
            }
    }

    public function categoryedit($id){
        $categorylistfromdatabase = adminProductCategory::find($id);
        return view('adminpanel/category/categoryedit',compact('categorylistfromdatabase'));
    }
    public function categoryupdate(Request $request, $id){
        if($request->input('image')!=null){
            $VALIDATOR = Validator::make($request->all(),[
                'category'=>['required','string','max:255'],
                'image'=> 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
            ]);
        }else{
            $VALIDATOR = Validator::make(['category'=>$request->input('category')],[
                'category'=>['required','string','max:255'],
            ]);
        }
        if($VALIDATOR->fails()){
            return redirect()->route('adminpanelcategoryedit', compact('id'))
            ->withErrors($VALIDATOR->errors())
            ->withInput();
        }else{
            $categorylistfromdatabase = adminProductCategory::find($id);
            $categorylistfromdatabase->category = $request->input('category');
            $image = $request->file('image');
            if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            Storage::disk('local')->put('/public/images/'.$imageName, File::get($image));
            $categorylistfromdatabase->image = $imageName;
        }
            $categorylistfromdatabase->save();
            return redirect()->route('admincategorypanel')
            ->with('success','Record edited successfully');
        }
        

    }

    
    public function categorydelete(Request $request, $id){
        $category_to_be_deleted = adminProductCategory::find($id);
        $subcategory = $category_to_be_deleted->category;
        $subcategories_to_be_deleted = subCategory::where("category_name",$subcategory)->value('subcategory');
        if($subcategories_to_be_deleted ){
            return redirect()->route('admincategorypanel')->with('failure', 'cannot be deleted contains sub-categories.');
        }else{
            if($category_to_be_deleted){
                     $category_to_be_deleted->delete();
                     return redirect()->route('admincategorypanel')
                     ->with('success', 'Record deleted successfully!');
                 }else{
                    return redirect()->route('admincategorypanel')->with('failure', 'Record deleted failed. No user found.');
                    ;
                 }
        }
        // 
    }
}
