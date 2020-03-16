<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editFoodTypeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testEditFoodTypeTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $food_type = factory(\App\Models\Foodtype::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'name'=>'Jolof Rice',
                        'price'=> '1000',
                        'added_by' => $user->id,
                        'id'=> '1',
                        'picture' => 'pic.jpg'
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editfoodType',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testeditFoodTypeWithoutMiddlewareTest()
    {
         $data = [
                     
                        'name'=>'Jolof Rice',
                        'price'=> '1000',
                        'added_by' => '2',
                        'id'=> '1',
                         'picture' => 'pic.jpg'
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editfoodType',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
