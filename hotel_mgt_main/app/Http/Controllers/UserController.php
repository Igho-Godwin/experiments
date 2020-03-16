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
use Auth;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // Add User
    public function addUser()
    {
        try{
        $value = Request::all();
        
        $rules = [
            
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'EmailAddress' => 'required|max:100|unique:users,email|email',
            'phoneNo' => 'required|max:100',
            'departments' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'picture'  => 'required',   
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
            
            $name='';
            
            if(Request::hasFile('picture')) {
                  
                $image = Request::file('picture');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/user_pic');
                $image->move($destinationPath, $name);        
              
          
            }
            
            $user = new User();
            $user->first_name = Request::get('firstName');
            $user->last_name = Request::get('lastName');
            $user->email = Request::get('EmailAddress');
            $user->phone_no = Request::get('phoneNo');
            $user->dept = Request::get('departments');
            $user->password = Hash::make(Request::get('password'));
            $user->picture = $name; 
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
            $user->added_by = Auth::id();
            $user->save();
            $user = Auth::user();
           // DB::table('oauth_access_tokens')->where('user_id',Auth::id())->delete();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
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
    
    //add to Store
    public function addToStore()
    {
        $value = Request::all();
        
        $rules = [
            
            'itemName' => 'required|max:100',
            'Quantity' => 'required|numeric',
            'UnitPrice' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $store = new Store();
            $store->itemName = Request::get('itemName');
            $store->qty = Request::get('Quantity');
            $store->unitPrice = Request::get('UnitPrice');
            $store->added_by = Auth::id();
            $store->save();
           // DB::table('oauth_access_tokens')->where('user_id',Auth::id())->delete();
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    // returns Users name 
    public function getName($id)
    {
        $user = User::find($id);
        if($user)
        {
            return $user->first_name.' '.$user->last_name;
        }
    }
    
    // returns department name 
    public function getDeptName($id)
    {
        if($id == 1)
        {
            return 'Store';
        }
        elseif($id == 2)
        {
            return 'Rooms';
        }
        elseif($id == 3)
        {
            return 'Restuarant';
        }
        elseif($id == 4)
        {
            return 'Bar';
        }
        elseif($id == 5)
        {
            return 'Pool';
        }
        elseif($id == 6)
        {
            return 'Pool Bar';
        }
        elseif($id == 7)
        {
            return 'Admin';
        }
    
    }
    
    

    
}
