<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class deleteStoreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteStockTest()
    {
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [];
            
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/deleteStock/1',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testDeleteStockWithoutMiddlewareTest()
    {
            $data = [];
            $user = factory(\App\Models\User::class)->create();
            $response = $this->json('POST', '/api/deleteStock/1',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
