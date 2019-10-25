<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class EditDrinkSalesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testEditDrinkTestWithMiddleware()
    {
        //$user = factory(App\Models\User::class)->make();
        //$user->save();
       // factory(OneHourElectricity::class)->make([ 'panel_id' => $panel->id ])->save();
        
            $sales_drink = factory(\App\Models\SalesDrink::class)->create();
        
            $user = factory(\App\Models\User::class)->create();
        
            $data = [
                     
                        'item'=>'1',
                        'price'=> '1000',
                        'added_by' => $user->id,
                        'qty' => '1',
                        'mode_of_payment'=> '1',
                        'id'=> 1
  
                    ];
        
            $u_login = Auth::loginusingid($user->id);
            $response = $this->actingAs($u_login, 'api')->json('POST', '/api/edit-sales-drinks',$data);
            $response->assertStatus(200);
           // $response->assertJson(['status' => true]);
            //$response->assertJson(['message' => "Product Created!"]);
            //$response->assertJson(['data' => $data]);
      

    }
    
    public function testEditDrinkTestWithoutMiddlewareTest()
    {
         $data = [
                     
                        'item'=>'1',
                        'price'=> '1000',
                        'added_by' => '1',
                        'qty' => '1',
                        'mode_of_payment'=> '1',
                        'id'=> 1
                        
  
                    ];
        

            $response = $this->json('POST', '/api/edit-sales-drinks',$data);
            $response->assertStatus(401);
            $response->assertJson(['message' => "Unauthenticated."]);
      

    }
}
