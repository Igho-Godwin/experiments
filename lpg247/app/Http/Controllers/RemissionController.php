<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Admin;
use App\Models\Remission;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;

class RemissionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $page_size = 3; 
    
    public function addRemissionPage()
    {
        if(Auth::guard('admin')->check())
        {
            $remission = Remission::all();
            
            return view('admin.add_percentage_remission')->with(['remission'=>$remission]);
        }
        else{
            return redirect('admin_login');
        }
    }
    
    public function addRemission()
    {
        $rules = [
            
            'percentage_remission' => 'required|numeric|max:100',
            
         ];
        
        try{
        
            $validator = Validator::make(Request::all(),$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);
             
            }
            else{
               
                if(count(Remission::all()) == 0)
                {
                    $obj = new Remission();
                    $obj->percentage_remission = Request::get('percentage_remission');
                    $obj->save();
                }
                else{
                    
                    $obj = Remission::find(Remission::all()->first()->id);
                    $obj->percentage_remission = Request::get('percentage_remission');
                    $obj->save();
                    
                }
                
                $user = Auth::guard('admin')->user();
                $success['token'] =  $user->createToken('Laravel')->accessToken;
                Session::put('token',$success['token']);
                return response()->json(['success'=>$success],200);
            }
                
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],502);
        }
        
    }
    
    public function editAdmin()
    {
        $rules = [
            
            
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|max:100|unique:admin,email,'.Request::get('id').',|email',
           // 'photo' => 'required'
            
     
         ];
         
         
         
         //return Request::get('id');
         
         if(Request::get('password') !== null)
         {
             $rules['password'] = 'required|max:100|same:password_confirmation|min:5';
         }
        
        try{
        
            $validator = Validator::make(Request::all(),$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);
             
            }
            else{
                
                $obj = Admin::find(Request::get('id'));
                
                if(Request::get('photo') !== null)
                {
                
                    $img = Request::get('photo');
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $filename= time().'.png';
                    $myfile = fopen(public_path().'/admin_pics/'.$filename, "w");
                    file_put_contents(public_path().'/admin_pics/'.$filename, $data);
                    
                    $obj->picture = 'admin_pics/'.$filename;
                }
                
                
                
                
                $obj->email = Request::get('email');
                
                if(Request::get('password') != null)
                {
                    $obj->password = Hash::make(Request::get('password'));
                }
                
                $obj->first_name = Request::get('first_name');
                $obj->last_name = Request::get('last_name');
                $obj->save();
                
                $user = Auth::guard('admin')->user();
                $success['token'] =  $user->createToken('Laravel')->accessToken;
                Session::put('token',$success['token']);
                return response()->json(['success'=>$success],200);
            }
                
        }
        catch(\Exception $e)
        {
           
            return response()->json(['error'=>$e->getMessage()],502);
        }
        
    }
    
    
    // Authenticate ADMIN
    
    public function authenticate()
    {
        $value = Request::all();
        
        if(Auth::guard('admin')->attempt(['email' => Request::get('email'), 'password' => Request::get('password'),'active'=>1]))
        { 
            $user = Auth::guard('admin')->user();
                
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
            
            return response()->json(['success' => $success], 200); 
        } 
       
        $error = 'Invalid Login Credential';
        return response()->json(['error' => $error]); 
        
        
    }
    
    
    public function addAdminPage()
    {
        if(Auth::guard('admin')->check())
        {
            $user = Auth::guard('admin')->user();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
            
            return view('admin.add_admin');
        }
        else{
            return redirect('admin_login');
        }
    }
    
    public function allAdminPage()
    {
        if(Auth::guard('admin')->check())
        {
            
            $all_admin = Admin::where('active','1')
                              ->orderby('id','desc')
                              ->paginate($this->page_size,['*'],'admins');
            

                              
            $user = Auth::guard('admin')->user();
                
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            Session::put('token',$success['token'] );
                              
            return view('admin.all_admins')->with(['all_admins'=>$all_admin]);
        }
        else{
            return redirect('admin_login');
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
                'phoneNumber' => 'required|numeric',
                'address' => 'required|max:255',
                'user_category'=>'required|numeric',
                'password' => 'required|min:5|same:password_confirmation',
                'terms'=> 'required'
            
            ];
            
            
            if(Request::get('user_category') == '1')
            {
                $rules['cac_document'] = 'required|max:5000|mimes:pdf,pdf';
                
                $rules['dpr_license_document'] = 'required|max:5000|mimes:pdf,pdf';
            }
   
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()]);   
            }
            else{
                
                $obj = new User();
                $obj->fullName = Request::get('fullName');
                $obj->email = Request::get('email');
                $obj->phoneNumber = Request::get('phoneNumber');
                $obj->address = Request::get('address');
                $obj->user_category = Request::get('user_category');
                $obj->password = Hash::make(Request::get('password'));
                
                
                if(Request::file('cac_document') != null)
                {
                    $file = Request::file('cac_document');

                    $filename = 'cac-doc' . time() . '.' . $file->getClientOriginalExtension();

                    $cac_path = $file->storeAs('public/Cac_Files', $filename);
                
                    $file = Request::file('dpr_license_document');
                
                    $filename = 'dpr-doc' . time() . '.' . $file->getClientOriginalExtension();

                    $dpr_path = $file->storeAs('public/Dpr_Files', $filename);
                
                    $obj->cac_document = 'storage/Cac_Files/'.$cac_path;
                    $obj->dpr_license_document = 'storage/Dpr_Files/'.$dpr_path;
                    
                }
                
                
                if(Request::get('username') != null)
                {
                    $obj->referrer = Request::get('username');
                }
                
                $obj->save();
                
                return 'Success';
            
            }
            
        }
        catch(\Exception $e)
        {
            echo $e;
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
    
     // Edit User
    public function editUser()
    {
        $value = Request::all();
        
        $rules = [
            
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'EmailAddress' => 'required|max:100|unique:users,email,'.Request::get('id').'|email',
            'phoneNo' => 'required|max:100',
            'departments' => 'required',
            'password_confirmation' => 'same:password',   
                  'city'  => 'required|max:100',   
            'State'  => 'required|max:100', 
            'date_Of_birth'  => 'required|max:100',
            'certificate_1'  => 'required|max:100',
            'school_1'  => 'required|max:100',
            'year_1'  => 'required|max:100',
            'certificate_2'  => 'max:100',
            'school_2'  => 'max:100',
            'year_2'  => 'max:100',
            'organization_1'=> 'max:100',
            'Field_OF_Work_1'=> 'max:100',
            'Designation_1'=> 'max:100',
            'Location_1'=> 'max:100',
            //'organization_2'=> 'required|max:100',
            //'Designation_2'=> 'required|max:100',
            //'Field_OF_Work_2'=> 'required|max:100',
            'Location_2'=> 'max:100',
            'organization_2'=> 'max:100',
            'Designation_2'=> 'max:100',
            'Field_OF_Work_2'=> 'max:100',
            'Reference_FullName'=> 'required|max:100',
            'Reference_Address'=> 'required|max:100',
            'Reference_city'=> 'required|max:100',
            'Reference_state'=> 'required|max:100',
            'Reference_Gender'=> 'required|max:100',
            'Reference_Phone_No'=> 'required|max:100',
        ];
        
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $user = User::find(Request::get('id'));
            $user->first_name = Request::get('firstName');
            $user->last_name = Request::get('lastName');
            $user->email = Request::get('EmailAddress');
            $user->phone_no = Request::get('phoneNo');
            $user->dept = Request::get('departments');
            $user->added_by = Auth::id();
            if(Request::get('password') != null)
            {
                $user->password = Hash::make(Request::get('password'));
            }
            if(Request::hasFile('picture')) {
                  
                $image = Request::file('picture');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/user_pic');
                $image->move($destinationPath, $name);     
                $user->picture = $name;
            
            }
            $user->city = Request::get('city');
            $user->state = Request::get('State');
            $user->dateOfBirth = date('Y-m-d',strtotime(Request::get('date_Of_birth')));
            $user->Gender = Request::get('Gender');
            $user->certificate_1 = Request::get('certificate_1');
            $user->certificate_2 = Request::get('certificate_2');
            $user->school_1 = Request::get('school_1');
            $user->year_1 = Request::get('year_1');
            $user->school_2 = Request::get('school_2');
            $user->year_2 = Request::get('year_2');
            $user->organization_1 = Request::get('organization_1');
            $user->fieldOfWork_1 = Request::get('Field_OF_Work_1');
            $user->designation_1 = Request::get('Designation_1');
            $user->location_1 = Request::get('Location_1');
            $user->organization_2 = Request::get('organization_2');
            $user->fieldOfWork_2 = Request::get('Field_OF_Work_2');
            $user->designation_2 = Request::get('Designation_2');
            $user->location_2 = Request::get('Location_2');
            $user->ref_full_name = Request::get('Reference_FullName');
            $user->ref_address = Request::get('Reference_Address');
            $user->ref_city = Request::get('Reference_city');
            $user->ref_state = Request::get('Reference_state');
            $user->ref_gender = Request::get('Reference_Gender');
            $user->ref_phone_no = Request::get('Reference_Phone_No');
            $user->remember_token = 'Token';
            $user->save();
            $user = Auth::user();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }

        
        
        
    }
    
    
    

    

    
}
