<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\SubAccounts;
use App\Models\Distance;
use App\Models\Review;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;

class ReviewController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function create()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'name' => 'required|max:100',
                'email' => 'required|max:100|email',
                'review' => 'required|max:255',
                'star_rating' => 'required|numeric|max:5|min:1',
            
            ];
         
           
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $user = User::where('email',Request::get('email'))->first();
                $sub_account_obj = SubAccounts::find(Request::get('marketer_id'));
                
                if($user)
                {
                    if(($user->id == $sub_account_obj->user_id ) or ($sub_account_obj->id == Request::get('marketer_id')) )
                    {
                        $rule['marketers'] = 'required';
                        
                        $validator = Validator::make($value,$rule);
        
                        if($validator->fails()){
            
                            return response()->json(['error'=>$validator->errors()],400);   
                        }
                        
                    }
                    
                   
                    
                }
                
                $obj = new Review();
                $obj->name = Request::get('name');
                $obj->email = Request::get('email');
                $obj->review = Request::get('review');
                $obj->star_rating = Request::get('star_rating');
                $obj->marketer_id = Request::get('marketer_id');
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
    

    

    
}
