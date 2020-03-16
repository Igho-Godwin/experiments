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
use Mail;

class MailController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    public $successStatus = 200;
    
    public $from = 'info@joevilleits.com';
    
    public $company_name = 'lpg247';

    function sendMail($email,$view,$data,$subject)
    {
        
         Mail::send(['html'=>$view], $data, function($message) use ($email,$subject) {
                $message->to($email)->subject
            ($subject);
            $message->from($this->from,$this->company_name);
         });
    }
    
    
}
