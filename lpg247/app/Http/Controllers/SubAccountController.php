<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\SubAccounts;
use App\Models\User;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;

class SubAccountController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
  
    // Add Sub Account
    
    public function create()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'email' => 'required|max:100|unique:sub_accounts,email|email',
                'email' => 'required|max:100|unique:users,email',
                'password' => 'required|min:5|same:password_confirmation',
                'address' => 'required|max:255',
                'user_id' => 'required|numeric',
                'price_per_qty' => 'required|numeric',
                'city_of_location' => 'required|max:100'
            
            ];
            
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = new SubAccounts();
                $obj->email = Request::get('email');
                $obj->password = Hash::make(Request::get('password'));
                $obj->address = Request::get('address');
                $obj->user_id = Request::get('user_id');
                $obj->price_per_qty = Request::get('price_per_qty');
                $obj->city = Request::get('city_of_location');
                $obj->save();
      
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    // edit Sub Account
    
    public function edit()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'email' => 'required|max:100|unique:sub_accounts,email|email,'.Auth::id().'',
                'email' => 'required|max:100|unique:users,email',
                'address' => 'required|max:255',
                'price_per_qty' => 'required|numeric',
                'city_of_location' => 'required|max:100'
                
            ];
            
            if(Request::get('password') !== null)
            {
               $rules['password'] = 'required|min:5|same:password_confirmation';
            }
            
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = SubAccounts::find(Request::get('id'));
                $obj->email = Request::get('email');
                $obj->address = Request::get('address');
                $obj->user_id = Auth::id();
                $obj->price_per_qty = Request::get('price_per_qty');
                $obj->city = Request::get('city_of_location');
                
                if(Request::get('password') !== null)
                {
                    $obj->password = Hash::make(Request::get('password'));
                }
                
                $obj->save();
      
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],502);
        }
        
    }
    
    // log out

    public function logout()
    {
        Auth::logout();
    }
    
    
    // All Sub Account
    
    public function allSubAccount()
    {
        
        if(Auth::check())
        {
            
            if(Auth::user()->user_category == 1)
            {
                try{
            
                    $data = SubAccounts::where('active','1')
                               ->paginate(30,['*'],'sub_acc');
                               
                    $states = States::where('country_id',160)
                        ->pluck('id');
                        
                    $cities = Cities::whereIn('state_id',$states)
                        ->orderby('name','asc')
                        ->get();
                        
                    $marketer_obj = new MarketersController(); 
                               
                    return view('user.marketer.allSubAccounts')->with(['sub_accounts'=>$data,'cities'=>$cities,'marketer_obj'=>$marketer_obj]);
            
                }
                catch(\Exception $e)
                {
                    return response()->json(['error'=>$e->getMessage()],502);
                }
            
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
        
    }
    
     public function home()
    {
        
        if(Auth::guard('sub_users')->check())
        {
            
            try{
            
                $data = SubAccounts::where('active','1')
                               ->paginate(30,['*'],'sub_acc');
                               
                $user = User::find(Auth::guard('sub_users')->user()->user_id);
                               
                return view('subUser.createSubAccount')->with(['sub_accounts'=>$data,'main_user'=>$user]);
            
            }
            catch(\Exception $e)
            {
                return response()->json(['error'=>$e->getMessage()],502);
            }
        }
        else{
            return redirect('/');
        }
        
    }
    
    // Suspend User
    public function suspendUser($id)
    {
        
        $obj = User::find($id);
        
        if($obj)
        {
        
           $obj->status= Request::get('action');
           $obj->save();
           $user = Auth::user();
            
           $success['token'] =  $user->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           return response()->json(['success'=>$success]);
            
        }   
        
    }
    
    // Delete User
    public function deleteUser($id)
    {
        
        $obj = User::find($id);
        
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
