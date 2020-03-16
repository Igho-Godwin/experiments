<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hash;
use Auth;

class deleteUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteUsersTest()
    {
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [];
            
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/deleteUser/'.$user->id,$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testDeleteUsersWithoutMiddlewareTest()
    {
            $data = [];
            $user = factory(\App\Models\User::class)->create();
            $response = $this->json('POST', '/api/deleteUser/'.$user->id,$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
