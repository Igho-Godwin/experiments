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
use App\Models\Shift;
use App\Models\customer;
use App\Models\DrinkType;
use App\Models\SalesRestuarant;
use App\Models\SalesDrink;
use Auth;

class ShiftController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 
    //add a Shift 
    public function addShift()
    {
        $value = Request::all();
        
        $rules = [
            
            'shift_name' => 'required|max:100',
            'from_time' => 'required|date_format:H:i',
            'to_time'  => 'date_format:H:i|after:from_time',
            'departments' => 'required|numeric'
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
              
            $store = new Shift();
            $store->dept = Request::get('departments');
            $store->shift_name = Request::get('shift_name');
            $store->from_time = Request::get('from_time');
            $store->to_time= Request::get('to_time');
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    public function editShift()
    {
        
        $value = Request::all();
        
        $rules = [
            
            'shift_name' => 'required|max:100',
            'from_time' => 'required|date_format:H:i',
            'to_time'  => 'date_format:H:i|after:from_time',
            'departments' => 'required|numeric'
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
              
            $store = Shift::find(Request::get('id'));
            $store->dept = Request::get('departments');
            $store->shift_name = Request::get('shift_name');
            $store->from_time = Request::get('from_time');
            $store->to_time= Request::get('to_time');
            $store->save();        
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    public function deleteShift()
    {
        $id = Request::get('id');
        
        $obj = Shift::find($id);
        
        $obj->status='1';
        
        $obj->save();
        
        $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
        $success['msg'] = 'Successful';
        Session::put('token',$success['token']);
        return response()->json(['success'=>$success]);
        
    }
    
        

    
}
