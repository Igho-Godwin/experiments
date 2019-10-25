<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class EditFoodSalesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeditFoodSalesWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $food_obj = factory(\App\Models\SalesRestuarant::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'item'=>'1',
                        'price'=> '1000',
                        'added_by' => $user->id,
                        'qty' => '1',
                        'mode_of_payment'=> '1',
                        'id' => $food_obj->id,
                        
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/editFoodSales',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testAddStoreWithoutMiddlewareTest()
    {
         $data = [
                     
                        'item'=>'1',
                        'price'=> '1000',
                        'added_by' => '1',
                        'qty' => '1',
                        'mode_of_payment'=> '1',
                        'id' => '1',
                        
  
                    ];
        

            $response = $this->json('POST', '/api/editFoodSales',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
