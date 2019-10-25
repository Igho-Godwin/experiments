<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use App\Models\Store;
use App\Models\StoreCollections;
use Auth;

class StoreController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add to Store
    public function addToStore()
    {
        $value = Request::all();
        
        
        if(Hash::check('auth-positive', Request::get('auth')))
        {
        
           $rules = [
            
            'itemName' => 'required|max:100',
            'Quantity' => 'required|numeric',
            'UnitPrice' => 'required|numeric',
            'departments'=> 'required|numeric'
            
           ];
            
        }
        else{
            
            $rules = [
            
            'itemName' => 'required|max:100',
            'Quantity' => 'required|integer|min:0',
            'UnitPrice' => 'required|numeric',
            'departments'=> 'required|numeric'
                
           ];
            
        }
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $store = new Store();
            $store->itemName = Request::get('itemName');
            $store->qty = Request::get('Quantity');
            $store->unitPrice = Request::get('UnitPrice');
            $store->added_by = Auth::id();
            $store->dept = Request::get('departments');
            $store->save();
           
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
     // Edit Store
    public function editStore()
    {
        $value = Request::all();
        
        $rules = [
            
            'itemName' => 'required|max:100',
            'Quantity' => 'required|numeric',
            'UnitPrice' => 'required|numeric',
            'departments'=> 'required|numeric'
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        
        
        
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            $user = Auth::user();
            $store = Store::find(Request::get('id'));
            $store->itemName = Request::get('itemName');
            $store->qty = Request::get('Quantity');
            $store->unitPrice = Request::get('UnitPrice');
            $store->dept = Request::get('departments');
            $store->added_by = Auth::id();
            $store->save();
            $obj2 = Store::find(Request::get('id'));
            $ob = Store::where('itemName',$obj2->itemName)->where('id','!=',Request::get('id'))->delete();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        } 
        
    }
    
     // Delete Store
    public function deleteStore($ItemName)
    {
        if(Auth::user()->dept == '7')
        {
            $obj = Store::where('itemName',$ItemName)->update(['status'=>'1']);
        
            $user = Auth::user();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Delete Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]);
        }
            
           
        
    }
    
    // collect From Store
    
    public function collectFromStore()
    {
        $value = Request::all();
        
        $rules = [
            
            'Item_name' => 'required|numeric',
            'quantity' => 'required|numeric',
            'users' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $obj = Store::find(Request::get('Item_name'));            
            $store = new StoreCollections();
            $store->item_name = Request::get('Item_name');
            $store->qty = Request::get('quantity');
            $store->unit_price = $obj->unitPrice; 
            $store->user_id = Request::get('users');
            $store->added_by = Auth::id();
            $store->save();
           // DB::table('oauth_access_tokens')->where('user_id',Auth::id())->delete();
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    // delete Store Collections
    
    public function deleteStoreCollections($id)
    {
        
        $obj = StoreCollections::find($id);
        
        if($obj && Auth::user()->dept == '7')
        {
        
           $obj->status= 1;
           $obj->save();
           $user = Auth::user();
            
           $success['token'] =  $user->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Delete Successful';
           Session::put('token',$success['token']);
           return response()->json(['success'=>$success]);
            
        }   
        
    }
    
    //edit Store Collections
    
    public function editStoreCollections()
    {
        $value = Request::all();
        
        $rules = [
            
            'Item_name' => 'required|numeric',
            'quantity' => 'required|numeric',
            'users' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $obj = Store::find(Request::get('Item_name'));            
            $store = StoreCollections::find(Request::get('id'));
            $store->item_name = Request::get('Item_name');
            $store->qty = Request::get('quantity');
            $store->unit_price = $obj->unitPrice; 
            $store->user_id = Request::get('users');
            $store->added_by = Auth::id();
            $store->save();
           // DB::table('oauth_access_tokens')->where('user_id',Auth::id())->delete();
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    public function getLatestUnitPrice($id)
    {
        $obj = Store::find($id);
        
        return $obj->unitPrice;
        
    }
    
    

    
}
