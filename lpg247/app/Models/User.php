<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{  
    use HasApiTokens, Notifiable;
    
    protected $table = 'users';
    
    function checkIfUsersExist($email)
    {
        return User::where('email',$email)->where('status','0')->first();
    }
}
