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
use App\Models\Foodtype;
use App\Models\SalesRestuarant;
use App\Models\PoolSales;
use Auth;

class PoolController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Pool Sales
    public function addPoolSales()
    {
        $value = Request::all();
        
        $rules = [
            
            'customer_name' => 'required|max:200',
            'cost' => 'required|numeric',
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
             
            $store = new PoolSales();
            $store->customer_name = Request::get('customer_name');
            $store->cost = Request::get('cost');
            
            if(Request::get('hotel_customer') != null)
            {
                $store->customer_id = Request::get('hotel_customer');
            }
            
            $store->added_by = Auth::id();
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    //edit Pool Sales
    public function editPoolSales()
    {
        $value = Request::all();
        
        $rules = [
            
            'customer_name' => 'required|max:200',
            'cost' => 'required|numeric',
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
             
            $store = PoolSales::find(Request::get('id'));
            if(Request::get('hotel_customer') != null)
            {
                $store->customer_id = Request::get('hotel_customer');
            }
            $store->customer_name = Request::get('customer_name');
            $store->cost = Request::get('cost');
            $store->added_by = Auth::id();
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    
     // Delete Pool Sales
    public function deletePoolSales($id)
    {
        
        $obj = PoolSales::find($id);
        
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
    
    
    //Make Sales
    public function MakeSales()
    {
        $value = Request::all();
        
        $rules = [
            
            'mode_of_payment' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'qty' => 'required|numeric'
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
           
            
            $store = new SalesRestuarant();
            $store->item = Request::get('id');
            $store->price = Request::get('unit_price');
            $store->added_by = Auth::id();
            $store->qty = Request::get('qty');
            $store->mode_of_payment = Request::get('mode_of_payment');
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    //get Food name
    public function getFoodName($id)
    {
        $obj = Foodtype::find($id);
        
        if($obj)
        {
           return $obj->name;    
        }
        
    }
    
    //get Mode of Payment
    public function getModeOfPayment($value)
    {
        if($value=='1')
        {
            return 'POS';
        }
        elseif($value=='2')
        {
            return 'CASH';
        }
        elseif($value=='3')
        {
            return 'TRANSFER';
        }
        
    }
    
    // Delete SALES
    public function deleteSales($id)
    {
        
        $obj = SalesRestuarant::find($id);
        
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
    
     // Edit Food Sales
    public function editFoodSales()
    {
        $value = Request::all();
        
        $rules = [
            
            'food_name' => 'required|max:100',
            'unit_price' => 'required|numeric',
            'qty' => 'required|numeric',
            'mode_of_payment' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
             $name='';
             
            $user = Auth::user();
            $store = SalesRestuarant::find(Request::get('id'));
            $store->item = Request::get('food');
            $store->price = Request::get('unit_price');
            $store->qty = Request::get('qty');
            $store->mode_of_payment = Request::get('mode_of_payment');
            $store->added_by = Auth::id();
            $store->save();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        } 
        
    }

    
}
