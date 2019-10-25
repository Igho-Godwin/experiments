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
    
    
    public $successStatus = 200;
    
    // User Login Page
    
    public function index()
    {
        
        return view('user.login');
 
    }
    
    // Authenticate Users
    
    public function authenticate()
    {
        if(Hash::check('admin@admin.de', Request::get('ad')))
        {
            if(Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password'),'status'=>0])){ 
                $user = Auth::user();
                $success['token'] =  $user->createToken('Laravel')->accessToken; 
                Session::put('token',$success['token'] );
                return response()->json(['success' => $success], $this-> successStatus); 
            } 
            else{
               $error = 'Invalid Login Credential';
               return response()->json(['error' => $error]); 
            }
        }
    }
    
    // Authenticate Admin
    
    public function AuthenticateAdmin()
    {
        $data = User::where('email',Request::get('email'))->where('dept',7)->get();
        
        if(isset($data[0])){
            $data = $data[0];
            if(Hash::check(Request::get('password'),$data->password))
            {
           
                $user = Auth::user();
                $success['token'] =  $user->createToken('Laravel')->accessToken; 
                $success['auth'] =  Hash::make('auth-positive'); 
                Session::put('token',$success['token'] );
                return response()->json(['success' => $success]); 
        
            }
            else{
               $error = 'Invalid Login Credential';
               return response()->json(['error' => $error]); 
            }
        }
        else{
               $error = 'Invalid Login Credential';
               return response()->json(['error' => $error]); 
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
