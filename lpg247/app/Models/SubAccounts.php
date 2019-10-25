<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SubAccounts extends Model
{  
   // use HasApiTokens, Notifiable;
    
    protected $table = 'sub_accounts';
    
    function checkIfSubUserExist($email)
    {
        return SubAccounts::where('email',$email)->where('active','1')->first();
    }
    
}
