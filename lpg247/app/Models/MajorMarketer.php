<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class MajorMarketer extends Model
{  
   // use HasApiTokens, Notifiable;
    
    protected $table = 'major_marketer';
    
}
