<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editStoreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeditStoreTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $store = factory(\App\Models\Store::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'itemName'=>'Rice',
                        'Quantity'=> '1',
                        'UnitPrice' => '2',
                        'added_by' => $user->id,
                        'id' => $store->id,
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editStock',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddStoreWithoutMiddlewareTest()
    {
         $data = [
                     
                        'itemName'=>'Rice',
                        'Quantity'=> '1',
                        'UnitPrice' => '2',
                        'added_by' => 1,
                        'id' => 1,
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editStock',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
