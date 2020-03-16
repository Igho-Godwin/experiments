<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editPoolSalesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEditPoolSalesTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $pool_sales = factory(\App\Models\PoolSales::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'customer_name'=>'Avwerosuo',
                        'cost'=> '1000',
                        'added_by' => $user->id,
                        'id' => $pool_sales->id
                        
                        
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editPoolSales',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddFoodTypeWithoutMiddlewareTest()
    {
         $data = [
                     
                         'customer_name'=>'Avwerosuo',
                        'cost'=> '1000',
                        'added_by' => '1',
                        'id' => '1'
                      
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editPoolSales',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
