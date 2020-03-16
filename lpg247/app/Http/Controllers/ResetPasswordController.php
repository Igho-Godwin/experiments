<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Admin;
use App\Models\SubAccounts;

use App\Models\PasswordChange;
use Request;
use Validator;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Session;
use Hash;

class ResetPasswordController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    // Reset Password
    function resetPassword()
    {
        $value = Request::all();
        
        $rules = [
            
                    'email' => 'required|max:100|email',
        
                ];
        
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);   
        }
        else{
            
            if(Request::get('user') != 'admin')
            {
            
                $usr_obj = new User();
            
                $email = Request::get('email');
            
                $val = $usr_obj->checkIfUsersExist($email);
                
                $sub_usr = new SubAccounts();
                
                $val2 = $sub_usr->checkIfSubUserExist($email);
            
                if(isset($val))
                {
                
                    $password_change_obj = new PasswordChange();
                
                    $password_change_obj->hardDelete($val->id);
                
                    $code = Hash::make($email);
                    $password_change_obj->addPasswordChangeData($code,$val->id);
                
                    $link = 'https://lpg247.com/PasswordChange?user=user&email='.$code;
                    
                    $data = ['link'=>$link];
                
                    $mail_object = new MailController();
                    $view ='mails.changePassword';
                    $mail_object->sendMail($email,$view,$data,'Change Password'); 
               
                    echo 'Email Sent';
        
                }
                elseif(isset($val2))
                {
                    
                    $password_change_obj = new PasswordChange();
                
                    $password_change_obj->hardDelete($val2->id);
                
                    $code = Hash::make($email);
                    $password_change_obj->addPasswordChangeData($code,$val2->id);
                
                    $link = 'https://lpg247.com/PasswordChange?user=subUser&email='.$code;
                    
                    $data = ['link'=>$link];
                
                    $mail_object = new MailController();
                    $view ='mails.changePassword';
                    $mail_object->sendMail($email,$view,$data,'Change Password'); 
               
                    echo 'Email Sent';
                    
                }
                else
                {
           
                    echo 'Invalid Email';
           
                }
                
            }
            else{
                
                $usr_obj = new Admin();
            
                $email = Request::get('email');
            
                $val = $usr_obj->checkIfAdminExist($email);
            
                if(isset($val))
                {
                
                    $password_change_obj = new PasswordChange();
                    $password_change_obj->hardDelete($val->id);
                    
                    $code = Hash::make($email);
                    $password_change_obj->addPasswordChangeData($code,$val->id);
                
                    $link = 'https://lpg247.com/PasswordChange?user=admin&email='.$code;
                    
                    $data = ['link'=>$link];
                
                    $mail_object = new MailController();
                    $view ='mails.changePassword';
                    $mail_object->sendMail($email,$view,$data,'Change Password'); 
               
                    echo 'Email Sent';
        
                }
                else
                {
           
                    echo 'Invalid Email';
           
                }
                
            }
            
        }
        
    }
    
    function changePassword()
    {
        $value = Request::all();
        
        $rules = [
 
            'password' => 'required|same:password_confirmation|min:5',
            
        ];
   
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
            return response()->json(['error'=>$validator->errors()],400);   
        }
        else{
            
            if(Request::get('user') == 'user')
            {
                
                $obj = User::find(Request::get('user_id'));
                $obj->password = Hash::make(Request::get('password'));
                $obj->save();
            
                $password_change_obj = new PasswordChange();
                
                $password_change_obj->hardDelete(Request::get('user_id'));
            
                return response()->json(['success'=>'successful'],200); 
            }
            elseif(Request::get('user') == 'subUser')
            {
                
                $obj = SubAccounts::find(Request::get('user_id'));
                $obj->password = Hash::make(Request::get('password'));
                $obj->save();
            
                $password_change_obj = new PasswordChange();
                
                $password_change_obj->hardDelete(Request::get('user_id'));
            
                return response()->json(['success'=>'successful'],200); 
            }
            else{
                
                $obj = Admin::find(Request::get('user_id'));
                $obj->password = Hash::make(Request::get('password'));
                $obj->save();
            
                $password_change_obj = new PasswordChange();
                
                $password_change_obj->hardDelete(Request::get('user_id'));
            
                return response()->json(['success'=>'successful'],200); 
            }
            
        }
    }
    
    function passwordChangePage()
    {
        $email = Request::get('email');
        $code='';
        
        $password_change_obj = new PasswordChange();
        
        $val = PasswordChange::where('code',$email)->count();
      
        if($val > 0)
        {
            
            $obj = PasswordChange::where('code',$email)->get()[0];
            
            $date = $obj->created_at;
        
            $date = strtotime($date.'+1 hours');
        
            if(time() <= $date)
            {
                
                return view('user.PasswordChangePage')->with(['user_id'=>$obj->user_id]);
            
            }
            else{
            
                echo "Link Has Expired";
            
            }
        }
        else{
            
                echo "This Link is not correct";
            
        }
       
    }
    
}
