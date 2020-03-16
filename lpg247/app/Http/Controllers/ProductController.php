<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\Products;
use App\Models\MajorMarketer;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;

class ProductController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
  
    public function addProductPage()
    {
        if(Auth::guard('admin')->check())
        {
            $user = Auth::guard('admin')->user();
                
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
            
            return view('admin.add_product');
        }
        else{
            return redirect('admin_login');
        }
    }
    
    public function allProductPage()
    {
        if(Auth::guard('admin')->check())
        {
            $user = Auth::guard('admin')->user();
                
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
            
            return view('admin.all_products');
        }
        else{
            return redirect('admin_login');
        }
    }
    
    public function getAllProducts()
    {
        $all_products = Products::paginate(30,['*'],'products');
        $no_products = Products::count();
        return response()->json(['success'=>True,'all_products'=>$all_products,'no_products'=>$no_products],200); 
    }
    
    // Add Product
    public function addProduct()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'product_name' => 'required|max:100|unique:products',
            
            ];
            
            $validator = Validator::make($value,$rules);
            
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = new Products();
                $obj->product_name = Request::get('product_name');
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    // Edit Product
    public function editProduct()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'product_name' => 'required|max:100|unique:products,product_name,'.Request::get('product_id'),
            
            ];
            
            $validator = Validator::make($value,$rules);
            
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = Products::find(Request::get('product_id'));
                $obj->product_name = Request::get('product_name');
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    
    // Deletes a Product
    public function deleteProduct($id)
    {
        try{
            
           
                
            $obj = Products::find($id);
            $obj->delete();
    
            return response()->json(['success'=>True],200); 
            
       
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    

    

    
}
