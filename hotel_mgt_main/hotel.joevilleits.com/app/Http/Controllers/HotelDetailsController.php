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
use App\Models\hotelDetails;
use Auth;

class HotelDetailsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Drink Type
    public function addHotelDetails()
    {
        $value = Request::all();
        
        $rules = [
            
            'hotel_name' => 'required|max:100',
            
            'Image' => 'required',
            
            'address' => 'required|max:255',
            
            'phone_no' => 'required|max:30',
            
          
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $filename ='';
            
            if (Request::get('Image') != null) {
                  
                $img = Request::get('Image');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                $myfile = fopen(public_path().'/Hotel_logo/'.$filename, "w");
                file_put_contents(public_path().'/Hotel_logo/'.$filename, $data);
                
            }
           
            if(count(hotelDetails::all()) == 0){
                
                $store = new hotelDetails();
                $store->hotel_name = Request::get('hotel_name');
                $store->logo = $filename;
                $store->address = Request::get('address');
                $store->phone_no = Request::get('phone_no');
                $store->save();     
            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                return response()->json(['success'=>$success]);
            }
            else{
                
                $id = hotelDetails::all()[0]->id;
                $store = hotelDetails::find($id);
                $store->hotel_name = Request::get('hotel_name');
                $store->logo = $filename;
                $store->address = Request::get('address');
                $store->phone_no = Request::get('phone_no');
                $store->save();     
            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                return response()->json(['success'=>$success]);
                
            }
            
            
        }
        
    }
    
    
        

    
}
