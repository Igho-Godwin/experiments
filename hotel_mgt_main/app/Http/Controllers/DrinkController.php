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
use App\Models\DrinkType;
use App\Models\SalesRestuarant;
use App\Models\SalesDrink;
use Auth;

class DrinkController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Drink Type
    public function addDrinkType()
    {
        $value = Request::all();
        
        $rules = [
            
            'drink_type' => 'required|max:100',
            'unit_price' => 'required|numeric',
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
             // $name='';
                  $filename='';
            if (Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                $myfile = fopen(public_path().'/drink_type/'.$filename, "w");
                file_put_contents(public_path().'/drink_type/'.$filename, $data);
                
            }
            
            $store = new DrinkType();
            $store->drink_type = Request::get('drink_type');
            $store->unit_price = Request::get('unit_price');
            $store->added_by = Auth::id();
            $store->picture = $filename;
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
     // Edit Drink Type
    public function editDrinkType()
    {
        $value = Request::all();
        
        $rules = [
            
            'drink_type' => 'required|max:100',
            'unit_price' => 'required|numeric',
            
            //'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
              $name='';
              
            
            $store = DrinkType::find(Request::get('id'));
            $store->drink_type = Request::get('drink_type');
            $store->unit_price = Request::get('unit_price');
            $store->added_by = Auth::id();
         
              $filename='';
            if (Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                $myfile = fopen(public_path().'/drink_type/'.$filename, "w");
                file_put_contents(public_path().'/drink_type/'.$filename, $data);
                $store->picture = $filename;
                
            }
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    
    // Delete Drink Type
    public function deleteDrinkType($id)
    {
        $obj = DrinkType::find($id);
        
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
    
    //Make Sales Drinks
    public function makeSalesDrink($id,$unit_price,$qty,$mode_of_payment,$customer_id)
    {
        
           
            
            $store = new SalesDrink();
            
            if($customer_id != '' )
            {
                $store->customer_id = $customer_id;
            }
            
            $store->item = $id;
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
    
    //get Drink name
    
    public function getDrinkName($id)
    {
        $obj = DrinkType::find($id);
        
        if($obj)
        {
           return $obj->drink_type;    
        }
        
    }
    
    // Edit Sales Drink
    
    public function editSalesDrink()
    {
        $value = Request::all();
        
        $rules = [
            
         
            'unit_price' => 'required|numeric',
            'mode_of_payment' => 'required|numeric',
            'qty' => 'required|numeric'
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
              
            $store = SalesDrink::find(Request::get('id'));
            
            if(Request::get('hotel_customer') != null)
            {
                $store->customer_id = Request::get('hotel_customer');
            }
            
            $store->item = Request::get('drink');
            $store->price = Request::get('unit_price');
            $store->mode_of_payment = Request::get('mode_of_payment');
            $store->qty = Request::get('qty');
            $store->added_by = Auth::id();
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    // delete Sales Drink
    
    public function deleteSalesDrink($id)
    {
        $obj = SalesDrink::find($id);
        
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
    
    
        

    
}
