<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class deletePoolSalesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeletePoolSalesTestWithMiddleware()
    {
        
            $user = factory(\App\Models\User::class)->create();
        
            $pool_sales = factory(\App\Models\PoolSales::class)->create();
        
            $data = [];
            
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/deletePoolSales/'.$pool_sales->id,$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testDeletePoolSalesWithoutMiddlewareTest()
    {
            $data = [];
            $pool_sales = factory(\App\Models\PoolSales::class)->create();
            $response = $this->json('POST', '/api/deletePoolSales/'.$pool_sales->id,$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
