<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\PasswordChange;
use Request;
use Validator;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Session;
use Hash;
use Mail;

class forgotPassController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public $successStatus = 200;
    
    // User Login Page
    
    public function index()
    {
        
        return view('user.forgotpass');
 
    }
    
    // Forgot Password
    
    public function SendPasswordLink()
    {
       $data=['username'=>Request::get('username')];
       $email = Request::get('email');
       $x = User::where('email',$email)->where('status','0')->count();
       if($x>0)
       {  
           DB::table('passwordchange')->where('email',$email)->delete();
           $code = Hash::make($email);
           $obj = new PasswordChange();
           $obj->code = $code;
           $obj->email = $email;
           $obj->save();
           $link = 'https://hotel.joevilleits.com/PasswordChange?email='.$code;
             $data = ['link'=>$link];
             Mail::send(['html'=>'mails.changepassword'], $data, function($message) use ($email) {
              $message->to($email)->subject
            ('Change Password');
             $message->from('info@joevilleits.com','JoevilleITS');
             });
             
             echo 'Email Sent';
        
       
       }
       else
       {
           
           echo 'Invalid Email address Given';
           
       }
     
    }
    
    // Password Change Page
    
    public function PasswordChange()
    {
        $email = Request::get('email');
        $code  = Request::get('code');

    
        $code='';
        if(isset( PasswordChange::where('code',$email)->where('created_at','<=',date('Y-m-d H:i:s',strtotime('+1 hours')))->get()[0])){
        $id = PasswordChange::where('code',$email)->get()[0]->id;
        $obj = PasswordChange::find($id);
        $date = explode('.',strtotime($obj->created_at)+strtotime('+1 hours'));
          //dd($date[0]);
        if(time() < strtotime(date('Y-m-d H:i:s',intval($date[0])))){
           $code= $obj->code;
        }
        
        $email= $obj->email;
        
        
        }
        
       
        
        if(Hash::check($email,$code))
        {
            Session::put('email',$email);
            
            return view('user.changepassword');
            
            
            
        }
        else{
            
            echo "Link Must Have Expired or LINK IS WRONG";
            
        }
        
    }
    
    public function changePassword()
    {
        $value = Request::all();
        
        $rules = [
            
            'password' => 'required|max:100',
            'password_confirmation' => 'required|same:password|max:100',
          //'password_confirmation' => 'required|same:password',         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
             $email = Session::get('email');
            if(isset(User::where('email',Session::get('email'))->get()[0]->id)){
             $id = User::where('email',Session::get('email'))->get()[0]->id;
             $obj = User::find($id);
             $obj->password = Hash::make(Request::get('password'));
             $obj->save();
             $id = PasswordChange::where('email',$email)->get()[0]->id;
             $obj = PasswordChange::find($id);
             $obj->delete();
             $success['msg'] = 'Successful';
             return response()->json(['success'=>$success]);
                
            }
             
        }
    }
    
     // Log User In
    public function createUserPage()
    {
        $client = new Client(); //GuzzleHttp\Client
        
    }
    
    
}
