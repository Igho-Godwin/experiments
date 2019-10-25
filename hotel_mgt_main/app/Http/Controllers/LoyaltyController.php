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
use App\Models\CustomerLoyalty;
use Auth;

class LoyaltyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Drink Type
    public function update_loyalty_data()
    {
        $value = Request::all();
        
        $rules = [
            
            'loyalty_value' => 'required|numeric',
            'number_of_visits' => 'required|integer'
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            
            if(Request::get('data') == null)
            {
                $obj = new CustomerLoyalty();
                
                $obj->loyalty_value = Request::get('loyalty_value');
                
                $obj->visit_number  = Request::get('number_of_visits');
                
                $obj->save();
                
            }
            else
            {
                $obj = CustomerLoyalty::find(Request::get('data'));
                
                $obj->loyalty_value = Request::get('loyalty_value');
                
                $obj->visit_number  = Request::get('number_of_visits');
                
                $obj->save();
                
            }
           
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
   
   

    
}
