<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SellRooms extends Model
{  
   // use HasApiTokens, Notifiable;
    
    protected $table = 'sell_rooms';
}
