<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class AddCollectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddCollectionTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $food_type = factory(\App\Models\StoreCollections::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'item_name'=>'1',
                        'qty'=> '1',
                        'unit_price' => '2',
                        'user_id' => $user->id,
                        'added_by' => '1',
                        
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/collectFromStore',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddCollectionTestWithoutMiddlewareTest()
    {
         $data = [
                     
                       'item_name'=>'1',
                        'qty'=> '1',
                        'unit_price' => '2',
                        'user_id' => '1',
                        'added_by' => '1',
                      
                        
  
                    ];
        

            $response = $this->json('POST', '/api/collectFromStore',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
