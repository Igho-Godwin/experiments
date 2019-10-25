<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PasswordChange extends Model
{  
    //use HasApiTokens, Notifiable;
    
    protected $table = 'passwordchange';
    
    function hardDelete($id)
    {
        PasswordChange::where('user_id',$id)->delete();
        
    }
    
    function addPasswordChangeData($code,$user_id)
    {
        $obj = new PasswordChange();
        $obj->code = $code;
        $obj->user_id = $user_id;
        $obj->save();
        
    }
    
}
