<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class editDrinksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeditDrinksTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $drinks = factory(\App\Models\DrinkType::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'drink_type'=>'Coke',
                        'unit_price'=> '1000',
                        'added_by' => $user->id,
                        'picture' => 'pic.jpg',
                        'id' => $drinks->id
                        
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/edit-sales-drinks',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testeditDrinksWithoutMiddlewareTest()
    {
         $data = [
                     
                        'drink_type'=>'Coke',
                        'unit_price'=> '1000',
                        'added_by' => '2',
                        'picture' => 'pic.jpg',
                        'id' => '2'
                      
                        
  
                    ];
        

            $response = $this->json('POST', '/api/edit-sales-drinks',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
