<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\SubAccounts;
use App\Models\Distance;
use App\Models\MarketerOrder;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;

class OrderController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function create()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'volume' => 'required|numeric',
                'delivery_location' => 'required|max:255',
                'marketer' => 'required|numeric'
            
            ];
         
      
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj2 = SubAccounts::find(Request::get('marketer'));
                
                $marketer_obj = new MarketersController();
                
                $distance = $marketer_obj->haversineGreatCircleDistance($obj2->address,Request::get('delivery_location'));
                
                $distance = explode(' ',$distance)[0];
       
                $distance = ((double) str_replace( ',', '', $distance ));
                
                $cost_of_delivery = User::find($obj2->user_id)->cost_of_delivery;
                
               //  return response()->json(['error'=>$distance],400); 
                
                $delivery_cost =  $distance  * $cost_of_delivery;
                
                $cost_price = Request::get('volume') * $obj2->price_per_qty;
                
                $total_cost = $delivery_cost + $cost_price;
                
                $usr = User::find(Request::get('user_id'));
                
                $value['wallet'] = $usr->money_wallet;
                $value['total_cost'] = $total_cost;
                
                $rules = [
 
                    'wallet' => 'required|numeric|gte:total_cost',
                 
                ];
         
                $validator = Validator::make($value,$rules);
               
                if($validator->fails()){
            
                    return response()->json(['error'=>$validator->errors()],400);   
                }
                else{
                    
                    $order_no = '#'.time();
                
                    $obj = new MarketerOrder();
                    $obj->volume = Request::get('volume');
                    $obj->delivery_location = Request::get('delivery_location');
                    $obj->delivery_cost = $delivery_cost;
                    $obj->cost_price = $cost_price;
                    $obj->total_cost = $total_cost;
                    $obj->user_id = Request::get('user_id');
                    $obj->marketer_id = Request::get("marketer");
                    $obj->order_no = $order_no;
                    $obj->save();
                    
                    
                    $usr->money_wallet -= $total_cost;
                    $usr->save();
                    
                    $sub_acc_obj = SubAccounts::find(Request::get("marketer"));
                    
                    $mail_obj = new MailController();
                    
                    $mail_obj->sendMail($sub_acc_obj->email,'user.marketer.email.newOrderMail',['order_no'=>$order_no],'New Order');
                    
                    $parent_marketer_obj = User::find($sub_acc_obj->user_id);
                    
                    $mail_obj->sendMail($parent_marketer_obj->email,'user.marketer.email.newOrderMail',['order_no'=>$order_no],'New Order');
                    
                    return response()->json(['success'=>True],200); 
                    
                }
                
                
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
    
    public function getAllOrders()
    {
        try{
            
            $value['marketer_id'] = Request::get('marketer_id');
        
            $rules = [
 
                'marketer_id' => 'required|numeric|exists:sub_accounts,id',
                
            
            ];
         
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                if(Request::get('date_range') == null)
                {
                
                    $marketers_orders = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                         ->orderBy('id','desc')
                                         ->paginate(30,['*'],'orders')
                                         ->appends('marketer_id',Request::get('marketer_id'));
                                        
                    $no_marketers_orders = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                        ->count();
                                        
                    return response()->json(['success'=>True,'marketers_orders'=>$marketers_orders,'no_marketers_orders'=>$no_marketers_orders,'orders'=>Request::get('orders')],200);
                    
                }
                else{
                    
                    $date = explode('-',Request::get('date_range'));
                    $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                    $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));

                    $marketers_orders = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                         ->whereRaw("date(marketer_orders.created_at) between '".$date[0]."' and '".$date[1]."'  ")
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                         ->orderBy('id','desc')
                                         ->paginate(30,['*'],'orders_search')
                                         ->appends('marketer_id',Request::get('marketer_id'))
                                         ->appends('date_range',Request::get('date_range'));
                                        
                    $no_marketers_orders = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                        ->whereRaw("date(marketer_orders.created_at) between '".$date[0]."' and '".$date[1]."'  ")
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                        ->count();
                                        
                    $total_orders_sum = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                        ->whereRaw("date(marketer_orders.created_at) between '".$date[0]."' and '".$date[1]."'  ")
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                        ->sum('total_cost');
                                        
                    $total_orders_paid = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                        ->where('paid','1')
                                        ->whereRaw("date(marketer_orders.created_at) between '".$date[0]."' and '".$date[1]."'  ")
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                        ->sum('total_cost');
                                        
                    $total_orders_unpaid = MarketerOrder::where('marketer_id',Request::get('marketer_id'))->where('marketer_orders.active',1)
                                        ->where('paid','0')
                                        ->whereRaw("date(marketer_orders.created_at) between '".$date[0]."' and '".$date[1]."'  ")
                                         ->leftJoin('users', 'users.id', '=', 'marketer_orders.user_id')
                                         ->select('marketer_orders.*','users.fullName')
                                        ->sum('total_cost');
                                        
                                        
                    return response()->json(['success'=>True,'marketers_orders'=>$marketers_orders,'no_marketers_orders'=>$no_marketers_orders,'orders'=>Request::get('orders'),'search'=>1],200);
                    
                }
               
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage(),'links'=>$marketers_orders->links()],400);
        }
    }
    

  

    

    
}
