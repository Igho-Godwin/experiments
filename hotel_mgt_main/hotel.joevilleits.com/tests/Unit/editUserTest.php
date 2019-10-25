<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Hash;
use Auth;

class editUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEditUsersTest()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
         
        
            $user = factory(\App\Models\User::class)->create();
             $data = [
                     
                        'firstName'=>'Avwerosuo',
                        'lastName'=> 'Godwin',
                        'email' => 'xx2@u.com',
                        'phoneNo' => '08161827947',
                        'dept' => 'Store',
                        'password' => Hash::make('admin001'),
                        'id'=> $user->id,
                        'added_by'=>$user->id
  
                    ];
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editUser',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddUsersWithoutMiddlewareTest()
    {
        
        $user = factory(\App\Models\User::class)->create();
        $data = [
                     
                        'firstName'=>'Avwerosuo',
                        'lastName'=> 'Godwin',
                        'email' => 'xx2@u.com',
                        'phoneNo' => '08161827947',
                        'dept' => 'Store',
                        'password' => Hash::make('admin001'),
                        'id'=> $user->id 
  
                    ];
        

            $response = $this->json('POST', '/api/editUser',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
