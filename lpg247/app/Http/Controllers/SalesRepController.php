<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\SalesRep;
use App\Models\MajorMarketer;
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

class SalesRepController extends BaseController
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
                'email' => 'required|max:100|unique:sales_rep,email',
                'fullName' => 'required|max:100',
                'phoneNumber' => 'required|max:100',
                'company_name' => 'required|numeric',
                'locationOfDepot' => 'required|max:255',
                'product_to_sell' => 'required|numeric',
            
            ];
            
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = new SalesRep();
                $obj->email = Request::get('email');
                $obj->fullName = Request::get('fullName');
                $obj->phoneNumber = Request::get('phoneNumber');
                $obj->major_marketer = Request::get('major_marketer');
                $obj->locationOfDepot = Request::get('locationOfDepot');
                $obj->product_to_sell = Request::get('product_to_sell');
                $obj->major_marketer = Request::get('company_name');
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
    }
    
    
    // Add Sales Rep Page
    
    public function addSalesRepPage()
    {
        
        try{
            
            $major_marketers = MajorMarketer::where('active',1)
                                            ->get();
            
            return view('salesRepSignUp')->with(['major_marketers'=>$major_marketers]);
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],502);
        }
            
    
    }
    
    public function allSalesRepPage()
    {
        
        try{
            
          
            return view('admin.allSalesRepPage');
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],502);
        }
        
    }
    
    // All Sales Rep Page
    
    public function getAllSalesRep()
    {
        
        try{
            
               $all_sales_rep = SalesRep::leftJoin('major_marketer', 'sales_rep.major_marketer', '=', 'major_marketer.id')
                                         ->select('sales_rep.*','major_marketer.marketer_name')
                                         ->orderBy('id','desc')
                                         ->paginate(1,['*'],'sales_reps');
                                       
                                        
               $no_sales_rep = SalesRep::leftJoin('major_marketer', 'sales_rep.major_marketer', '=', 'major_marketer.id')
                                       ->select('sales_rep.*','major_marketer.marketer_name')
                                       ->count();
                                        
                               
               return response()->json(['success'=>True,'all_sales_rep'=>$all_sales_rep,'no_sales_rep'=>$no_sales_rep],200);
                    
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
        
        
    }
    
    public function verifySalesRep($id)
    {
        $obj = SalesRep::find($id);
        $obj->verified = 1;
        $obj->active = 1;
        $obj->save();
        
        return response()->json(['success'=>True],200);
    }
    
    public function suspendSalesRep()
    {
        if(Request::get('data') == 1)
        {
        
            $obj = SalesRep::find(Request::get('sales_rep_id'));
            $obj->active = 0;
            $obj->save();
            
        }
        else{
             $obj = SalesRep::find(Request::get('sales_rep_id'));
             $obj->active = 1;
             $obj->save();
        }
        
        return response()->json(['success'=>True,'data'=>$obj->active],200);
    }
       
       
    
    

    
}
