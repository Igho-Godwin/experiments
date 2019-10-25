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
use App\Models\customer;
use App\Models\DrinkType;
use App\Models\SalesRestuarant;
use App\Models\SalesDrink;
use Auth;

class CustomerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Drink Type
    public function editCustomer()
    {
        $value = Request::all();
        
        $rules = [
            
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone_number' => 'required|unique:customer,phone_number',
            'email_address' => 'required|max:100',
            'address' => 'required',
            'country' => 'required|max:100',
            'state' => 'required|max:100',
            'city' =>  'required|max:100',
            'customer_type' => 'required|numeric',
            'discount' => 'numeric'
          
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
           
            
            $cus = customer::find(Request::get('id'));
            $cus->first_name = Request::get('first_name');
            $cus->last_name = Request::get('last_name');
            $cus->phone_number = Request::get('phone_number');
            $cus->email_address = Request::get('email_address');
            $cus->address = Request::get('address');
            $cus->country = Request::get('country');
            $cus->state = Request::get('state');
            $cus->city = Request::get('city');
            
            if(Request::get('birthday') != null)
            {
                $cus->birthday = '1989-'.Request::get('birthday');   
            }
            
            $cus->customer_type = Request::get('customer_type');
            $cus->discount = Request::get('discount');
            $cus->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    
        

    
}
