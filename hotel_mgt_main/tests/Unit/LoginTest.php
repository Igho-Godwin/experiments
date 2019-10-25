<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hash;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginTest()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
          $data = [
                     
                        'email'=>'Avwerosuo',
                        'password'=> Hash::make('admin001'),
                        'ad' => Hash::make("admin@admin.de"),
                        'status'=> 0
                      
  
                    ];
        
            $response = $this->json('POST', '/api/LoginUser',$data);
            $response->assertStatus(200);
         

    }
    
    public function testLoginFailureTest()
    {
        $data = [
                     
                        'email'=>'',
                        'password'=> '',
                        'ad' => Hash::make("admin@admin.de"),
                        'status'=> 0
                      
  
                    ];
        
            $response = $this->json('POST', '/api/LoginUser',$data);
            $response->assertJson(['error' => "Invalid Login Credential"]);
            $response->assertStatus(200);
      

    }
}
