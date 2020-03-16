<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editSoldRoomTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeditSoldRoomTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $sell_rooms = factory(\App\Models\SellRooms::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'customer_name'=>'English',
                        'room_type'=> '1',
                        'qty' => '2',
                        'unit_price' => '2',
                        'added_by' => $user->id,
                        'id'=>$sell_rooms->id
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editSold-room',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testeditSoldRoomWithoutMiddlewareTest()
    {
         $data = [
                     
                         'customer_name'=>'English',
                        'room_type'=> '1',
                        'qty' => '2',
                        'unit_price' => '2',
                        'added_by' => '1',
                        'id'=>'1'
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editSold-room',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
