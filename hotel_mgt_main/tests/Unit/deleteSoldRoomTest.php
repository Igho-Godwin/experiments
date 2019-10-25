<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class deleteSoldRoomTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   
    public function testDeleteSoldRoomTest()
    {
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [];
            
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/deleteSoldRooms/1',$data);
            $response->assertStatus(200);
      

    }
    
    public function testDeleteSoldRoomWithoutMiddlewareTest()
    {
            $data = [];
          
            $response = $this->json('POST', '/api/deleteSoldRooms/1',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
