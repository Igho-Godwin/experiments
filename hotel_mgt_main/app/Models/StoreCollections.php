<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StoreCollections extends Model
{  
   // use HasApiTokens, Notifiable;
    
    protected $table = 'store_collections';
}
