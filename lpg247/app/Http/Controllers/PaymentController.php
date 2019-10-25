<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\PaymentLog;
use App\Models\User;
use Request;
use Validator;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Session;
use Hash;

class PaymentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public $successStatus = 200;
    
    // User Login Page
    
    public function logPayment()
    {
        $obj = new PaymentLog();
        $obj->user_id = Request::get('user_id');
        $obj->reference_no = Request::get('reference_no');
        $obj->amount = Request::get('amount');
        $obj->save();
        
        $user_obj = User::find(Auth::id());
        $user_obj->money_wallet += Request::get('amount') ;
        $user_obj->save();
        
        return response()->json(['success' => True]);
        
    }
    
    
    
}
