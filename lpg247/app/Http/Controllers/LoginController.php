<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use Request;
use Validator;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Session;
use Hash;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    // User Login Page
    
    public function loginPage()
    {
        
        return view('user.login');
 
    }
    
    // Authenticate Users
    
    public function authenticate()
    {
        
        try{
        
            $value = Request::all();
        
            if(Request::get('remember_me') != null)
            {
            
                if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')], True)) {
                
                    $user = Auth::user();
                
                    $success['token'] =  $user->createToken('Laravel')->accessToken; 
                    Session::put('token',$success['token'] );
            
                    return response()->json(['success' => $success], 200); 
  
                }
            
            }
        
            if(Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password'),'status'=>0]))
            { 
                $user = Auth::user();
                
                $success['token'] =  $user->createToken('Laravel')->accessToken; 
                Session::put('token',$success['token'] );
            
                return response()->json(['success' => $success], 200); 
            } 
            
            if(Request::get('remember_me') != null)
            {
            
                if (Auth::guard('sub_users')->attempt(['email' => Request::get('email'), 'password' => Request::get('password'),'active'=>1], True)) {
                
                    $user = Auth::guard('sub_users')->user();
                
                    $success['token'] =  $user->createToken('Laravel')->accessToken; 
                    
                    $success['sub_users'] =  '1';
                    
                    Session::put('token',$success['token'] );
            
                    return response()->json(['success' => $success], 200); 
  
                }
            
            }
        
            if(Auth::guard('sub_users')->attempt(['email' => Request::get('email'), 'password' => Request::get('password'),'active'=>1]))
            { 
                $user = Auth::guard('sub_users')->user();
                
                $success['token'] =  $user->createToken('Laravel')->accessToken;
                
                $success['sub_users'] =  '1';
                
                Session::put('token',$success['token'] );
            
                return response()->json(['success' => $success], 200); 
            } 
       
            $error = 'Invalid Login Credential';
            return response()->json(['error' => $error],400);
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()],502);
        }
        
        
    }
    
    
    
     // Log User In
    public function createUserPage()
    {
        $client = new Client(); //GuzzleHttp\Client
        
    }
    
    //  Log out
    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
    
    
}
