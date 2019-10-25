<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Model
{  
   // use HasApiTokens, Notifiable;
    
    protected $table = 'admin';
    
    function checkIfAdminExist($email)
    {
        return Admin::where('email',$email)->where('active','1')->first();
    }
}
