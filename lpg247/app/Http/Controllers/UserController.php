<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\MajorMarketer;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function userDashboard()
    {
        return view('user.userDashboard');
    }
    
    public function userSignUp()
    {
        $major_marketers = MajorMarketer::where('active',1)
                                        ->get();
                                        
        return view('user.register_user')->with(['MajorMarketers'=>$major_marketers]);
        
    }
    
    public function userProfile()
    {
        if(Auth::check())
        {
            $marketer_obj = new MarketersController();
            
            $major_marketers = MajorMarketer::where('active',1)
                                        ->get();
                                        
            return view('user.edit_user')->with(['marketer_obj'=>$marketer_obj,'MajorMarketers'=>$major_marketers]);
        }
        else{
            return redirect('login');
        }
    }
    
    public function createSubAccountPage()
    {
        if(Auth::check())
        {
            $states = States::where('country_id',160)
                        ->pluck('id');
                        
            $cities = Cities::whereIn('state_id',$states)
                        ->orderby('name','asc')
                        ->get();
                        
            $marketer_obj = new MarketersController();

            return view('user.marketer.createSubAccount')->with(['cities'=>$cities,'marketer_obj'=>$marketer_obj]);
        }
        else{
            return redirect('login');
        }
    }
    
    // Add User
    public function addUser()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'fullName' => 'required|max:100',
                'email' => 'required|max:100|unique:users,email|email',
                'email' => 'required|max:100|unique:sub_accounts,email|email',
                'phoneNumber' => 'required|numeric',
                'address' => 'required|max:255',
                'user_category'=>'required|numeric',
                'password' => 'required|min:5|same:password_confirmation',
                'terms'=> 'required'
            
            ];
            
            if(Request::get('marketer_type') == 1)
            {
                $rules['major_marketer'] = 'required';
            }
            
            
            if(Request::get('user_category') == '1')
            {
                $rules['marketer_type'] = 'required|numeric';
                
                $rules['cacNumber'] = 'required|max:100';
                
                $rules['dprLicenseNumber'] = 'required|max:100';
                
                $rules['about_company'] = 'required|max:255';
                
            }
   
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = new User();
                $obj->fullName = Request::get('fullName');
                $obj->email = Request::get('email');
                $obj->phoneNumber = Request::get('phoneNumber');
                $obj->address = Request::get('address');
                $obj->marketer_type = Request::get('marketer_type');
                $obj->user_category = Request::get('user_category');
                $obj->password = Hash::make(Request::get('password'));
                $obj->about_company = Request::get('about_company');
                
                $major_marketers ='';
                
                foreach(Request::get('major_marketer') as $vals)
                {
                    $major_marketers .= $vals.',';
                }
                
                $obj->major_marketer = substr($major_marketers,0,strlen($major_marketers)-1);
                
                
                if(Request::get('cac_number') != null)
                {
                    /*
                    
                    $file = Request::file('cac_document');

                    $filename = 'cac-doc' . time() . '.' . $file->getClientOriginalExtension();

                    $cac_path = $file->storeAs('public/Cac_Files', $filename);
                
                    $file = Request::file('dpr_license_document');
                
                    $filename = 'dpr-doc' . time() . '.' . $file->getClientOriginalExtension();

                    $dpr_path = $file->storeAs('public/Dpr_Files', $filename);
                    
                    */
                
                    $obj->cac_number = Request::get('cacNumber');
                    $obj->dpr_license_number = Request::get('dprLicenseNumber');
                    $obj->verified= 0;
                    
                }
                
                
                if(Request::get('username') != null)
                {
                    $obj->referrer = Request::get('username');
                }
                
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    // edit User
    public function editUser()
    {
        try{
            
            $value = Request::all();
            
            $rules = [
 
                'fullName' => 'required|max:100',
                'email' => 'required|max:100|unique:users,email,'.Auth::id().'|email',
                'address' => 'required|max:255',
                'phoneNumber' => 'required|numeric',
                'user_category'=>'required|numeric',
                
                
            ];
            
       
            $obj = User::find(Auth::id());
            
            if(Request::get('user_category') == '1')
            {
                $rules['marketer_type'] = 'required|numeric';
                
                $rules['about_company'] = 'required|max:255';
            }
            
            if(Request::get('password') !== null)
            {
               $rules['password'] = 'required|min:5|same:password_confirmation';
            }
   
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
             
                  
                    if(Request::get('photo') != null)
                    {
                        $img = Request::get('photo');
                        $img = str_replace('data:image/png;base64,', '', $img);
                        $img = str_replace(' ', '+', $img);
                        $data = base64_decode($img);
                        $filename= time().'.png';
                        $myfile = fopen(public_path().'/user_pics/'.$filename, "w");
                        file_put_contents(public_path().'/user_pics/'.$filename, $data);
                        
                        $obj->picture = 'user_pics/'.$filename;
                        
                    }
                    
                    
                    $obj->fullName = Request::get('fullName');
                    $obj->email = Request::get('email');
                    $obj->marketer_type = Request::get('marketer_type');
                    $obj->phoneNumber = Request::get('phoneNumber');
                    $obj->address = Request::get('address');
                    $obj->user_category = Request::get('user_category');
                    $obj->about_company = Request::get('about_company');
                    
                    if(Request::get('do_delivery') !== null)
                    {
                        $obj->do_delivery = Request::get('do_delivery');
                    }
                    
                    if(Request::get('cost_of_delivery') !== null)
                    {
                        $obj->cost_of_delivery = Request::get('cost_of_delivery');
                    }
                
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
    
    // all Users
    public function all_usersPage()
    {
        
        if(Auth::guard('admin')->check())
        {
            
            $user = Auth::guard('admin')->user();
                
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
                              
            return view('admin.all_users');
        }
        else{
            return redirect('admin_login');
        }
        
        
    }
    
    
   
    
    

    

    
}
