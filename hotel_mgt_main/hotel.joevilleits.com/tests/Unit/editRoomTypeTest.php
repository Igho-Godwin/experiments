<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editRoomTypeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeditRoomTypeTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $room = factory(\App\Models\RoomType::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'name'=>'Rice',
                        'Quantity'=> '1',
                        'UnitPrice' => '2',
                        'added_by' => $user->id,
                        'id' => $room->id,
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editRoomType',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddStoreWithoutMiddlewareTest()
    {
         $data = [
                     
                        'name'=>'Rice',
                        'Quantity'=> '1',
                        'UnitPrice' => '2',
                        'added_by' => 1,
                        'id' => 1,
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editRoomType',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
