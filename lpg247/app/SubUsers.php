<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubUsers extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    protected $table = 'sub_accounts';
}
