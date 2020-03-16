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
use Auth;

class FoodTypeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Food Type
    public function addfoodType()
    {
        $value = Request::all();
        
        $rules = [
            
            'food_name' => 'required|max:100|unique:food_type,name',
            'unit_price' => 'required|numeric',
            'food_category' => 'required|numeric'
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
              $filename='';
            if (Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                $myfile = fopen(public_path().'/food_pic/'.$filename, "w");
                file_put_contents(public_path().'/food_pic/'.$filename, $data);
                
            }
            
            
            
            $store = new Foodtype();
            $store->name = Request::get('food_name');
            $store->price = Request::get('unit_price');
            $store->added_by = Auth::id();
            $store->picture = $filename;
            $store->food_category = Request::get('food_category');
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
     // Edit Food Type
    public function editFoodType()
    {
        $value = Request::all();
        
        $rules = [
            
            'food_name' => 'required|max:100|unique:food_type,name,'.Request::get('id'),
            'unit_price' => 'required|numeric',
            'food_category' => 'required|numeric'
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
             $name='';
             
            $user = Auth::user();
            $store = Foodtype::find(Request::get('id'));
            $store->name = Request::get('food_name');
            $store->price = Request::get('unit_price');
            $store->food_category = Request::get('food_category');
            $store->added_by = Auth::id();
                $filename='';
            if (Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                $myfile = fopen(public_path().'/food_pic/'.$filename, "w");
                file_put_contents(public_path().'/food_pic/'.$filename, $data);
                $store->picture = $filename;
                
            }
            
            $store->save();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        } 
        
    }
    
     // Delete Food Type
    public function deletefoodType($id)
    {
        
        $obj = Foodtype::find($id);
        
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
    
    
    //Make Sales
    public function MakeSalesRestaurant($id,$unit_price,$qty,$mode_of_payment,$customer_id)
    {
  
            $store = new SalesRestuarant();
            
            if($customer_id != '' )
            {
                $store->customer_id = $customer_id;
            }
            
            $store->item =  $id;
            $store->price = $unit_price;
            $store->added_by = Auth::id();
            $store->qty = $qty;
            $store->mode_of_payment = $mode_of_payment;
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
       
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
        if(Auth::user()->dept == '7')
        {
            $obj = SalesRestuarant::find($id);
        
            if($obj)
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
            if(Request::get('hotel_customer') != null)
            {
                $store->customer_id = Request::get('hotel_customer');
            }
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
    
    // Search Food
    
    public function search_food()
    {
        
                            
        
    }

    
}
