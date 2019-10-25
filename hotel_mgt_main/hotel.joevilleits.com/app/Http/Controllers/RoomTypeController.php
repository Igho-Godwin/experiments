<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\customer;
use Request;
use Validator;
use Hash;
use DB;
use Session;
use App\Models\RoomType;
use App\Models\SellRooms;
use App\Models\SalesRoom;
use App\Models\SalesDrink;
use App\Models\Store;
use App\Models\SalesRestuarant;
use App\Models\PoolSales;
use App\Models\RoomOccupiedLog;
use App\Models\RoomCondition;
use Auth;

class RoomTypeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 

    //add Room
    public function addRoomType()
    {
        $value = Request::all();
        
        $rules = [
            
            'roomName' => 'required|max:100|unique:rooms_type,name',
            //'Quantity' => 'required|numeric',
            'UnitPrice' => 'required|numeric',
            'room_number' => 'required',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $room = new RoomType();
            $room->name = Request::get('roomName');
            //$room->qty = Request::get('Quantity');
            $room->unitPrice = Request::get('UnitPrice');
            if(Request::get('discounted_price') != null)
            {
                $room->discounted_price = Request::get('discounted_price');
            
            }
            
            if(Request::get('room_number') != null)
            {
                $room->room_numbers = Request::get('room_number');
            
            }
            
            if(Request::get('tv') != null)
            {
                $room->tv = Request::get('tv');
            
            }
            
            if(Request::get('bed') != null)
            {
                $room->bed = Request::get('bed');
            
            }
            
            if(Request::get('breakfast') != null)
            {
                $room->breakfast = Request::get('breakfast');
            
            }
            
            if(Request::get('tub') != null)
            {
                $room->tub = Request::get('breakfast');
            
            }
            
            if(Request::get('ac') != null)
            {
                $room->ac = Request::get('ac');
            
            }
            
            if(Request::get('smoking') != null)
            {
                $room->smoking = Request::get('smoking');
            
            }
            
            $filename='';
            
            if(Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                file_put_contents('room_type_pic/'.$filename, $data);
                $room->picture = $filename;
                
            }
            
            $room->added_by = Auth::id();
            $room->save(); 
           // DB::table('oauth_access_tokens')->where('user_id',Auth::id())->delete();
            $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    //Get All rooms
    public function getAllRooms($similar_id)
    {
        $room_numbers = implode(',',SalesRoom::where('similar_id',$similar_id)
                                    ->pluck('room_no')
                                    ->all()
                                    
                    );
                                
        
        return $room_numbers;
                 
    }
    
    // Get Room Type
    
    public function getRoomType($room_no)
    {
        $obj =  RoomType::whereRaw("find_in_set('".$room_no."',room_numbers)!=0")
                        ->get();
                        
        return $obj[0]->name;
    }
    
    //Log occupied Room
    
    public function RoomOccupiedLog($room_no)
    {
        
        $obj = new RoomOccupiedLog();
        
        $obj->room_no = $room_no;
        
        $obj->save();
        
        
    }
    
     // Edit Room Type
    public function editRoomType()
    {
        $value = Request::all();
        
        $rules = [
            
            'roomName' => 'required|max:100|unique:rooms_type,name,'.Request::get('id'),
            //'Quantity' => 'required|numeric',
            'UnitPrice' => 'required|numeric',
            'room_number' => 'required',
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            $user = Auth::user();
            $room_type = RoomType::find(Request::get('id'));
            $room_type->name = Request::get('roomName');
           
            $room_type->unitPrice = Request::get('UnitPrice');
            $room = $room_type;
            if(Request::get('discounted_price') != null)
            {
                $room->discounted_price = Request::get('discounted_price');
            
            }
            
            if(Request::get('room_number') != null)
            {
                $room->room_numbers = Request::get('room_number');
            
            }
            
            if(Request::get('tv') != null)
            {
                $room->tv = Request::get('tv');
            
            }
            
            if(Request::get('bed') != null)
            {
                $room->bed = Request::get('bed');
            
            }
            
            if(Request::get('breakfast') != null)
            {
                $room->breakfast = Request::get('breakfast');
            
            }
            
            if(Request::get('tub') != null)
            {
                $room->tub = Request::get('breakfast');
            
            }
            
            if(Request::get('ac') != null)
            {
                $room->ac = Request::get('ac');
            
            }
            
            if(Request::get('smoking') != null)
            {
                $room->smoking = Request::get('smoking');
            
            }
            
            $filename='';
            
            if(Request::get('pngimageData') != null) {
                  
                $img = Request::get('pngimageData');
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename= time().'.png';
                file_put_contents('room_type_pic/'.$filename, $data);
                $room_type->picture = $filename;
                
            }
            
            $room_type->added_by = Auth::id();
            $room_type->save();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        } 
        
    }
    
     // Delete Store
    public function deleteRoomType($id)
    {
        
        $obj = RoomType::find($id);
        
        if($obj && Auth::user()->dept == '7')
        {
        
           $obj->status= 1;
           $obj->save();
           $user = Auth::user();
            
           $success['token'] =  $user->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Delete Successful';
           Session::put('token',$success['token']);
           return response()->json(['success'=>$success]);
            
        }   
        
    }
    
    // Get Unit Price
    public function getUnitPrice()
    {
        $obj = RoomType::find(Request::get('room_type'));
        
        if($obj)
        {
           $user = Auth::user();
           $success['token'] =  $user->createToken('Laravel')->accessToken; 
           $success['unit_price'] = $obj->unitPrice;
           Session::put('token',$success['token']);
           return response()->json(['success'=>$success]);
            
        }   
        
    }
    
    public function addCustomer()
    {
        if(Request::get('selected_id') == null)
        {
            
            $obj = new customer();
        
            $obj->customer_type = Request::get('customer_type');
        
            $obj->first_name = Request::get('first_name');
        
            $obj->last_name = Request::get('last_name');
        
            if(Request::get('birth_month') != 0)
            {
                $obj->birthday = date('Y-m-d',strtotime('1989'.'-'.Request::get('birth_month').'-'.Request::get('birth_day')));
            }
            else{
                $obj->birthday = NULL;
            }
        
            $obj->phone_number = Request::get('phone_number');
        
            $obj->email_address = Request::get('email_address');
        
            $obj->address = Request::get('address');
        
            $obj->country = Request::get('country');
        
            $obj->state = Request::get('State');
        
            $obj->city = Request::get('city');
        
            $obj->save();
        
            return customer::where('status','0')->orderby('id','desc')->first()->id;
            
        }
        else{
            
            $obj = customer::find(Request::get('selected_id'));
        
            $obj->customer_type = Request::get('customer_type');
        
            $obj->first_name = Request::get('first_name');
        
            $obj->last_name = Request::get('last_name');
        
            if(Request::get('birth_month') != 0)
            {
                $obj->birthday = date('Y-m-d',strtotime('1989'.'-'.Request::get('birth_month').'-'.Request::get('birth_day')));
            }
            else{
                $obj->birthday = NULL;
            }
        
            $obj->phone_number = Request::get('phone_number');
        
            $obj->email_address = Request::get('email_address');
        
            $obj->address = Request::get('address');
        
            $obj->country = Request::get('country');
        
            $obj->state = Request::get('State');
        
            $obj->city = Request::get('city');
        
            $obj->save();
        
            return customer::where('status','0')->orderby('id','desc')->first()->id;
            
        }
     
        
        
    }
    
    // Sell Rooms
    
    public function sellRoom()
    {
        $value = Request::all();
        
        if(Request::get('selected_id') == null)
        {
            $rules = [
            
                'customer_type' => 'required|max:100',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'others' => 'max:11',
                'birth_month' => 'max:100',
                'birth_day' => 'max:31|numeric',
                'phone_number' => 'required|max:99999999999|numeric|unique:customer,phone_number',
                'email_address' => 'required|max:100',
                'address' => 'required|max:255',
                'country' => 'required|max:100',
                'State' => 'required|max:100',
                'city' => 'required|max:100',
                'action' => 'required|max:1|numeric',
                'mode_of_payment' => 'required|numeric',
                'checkinDate' => 'required|date_format:d-m-Y',
                'checkoutDate' => 'required|date_format:d-m-Y',
                //'available_room' => 'required|numeric',
            ];
        }
        else{
            
            $rules = [
            
                'customer_type' => 'required|max:100',
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'others' => 'max:11',
                'birth_month' => 'max:100',
                'birth_day' => 'max:31|numeric',
                'phone_number' => 'required|max:99999999999|unique:customer,phone_number,'.Request::get('selected_id').'|numeric',
                'email_address' => 'required|max:100',
                'address' => 'required|max:255',
                'country' => 'required|max:100',
                'State' => 'required|max:100',
                'city' => 'required|max:100',
                'action' => 'required|max:1|numeric',
                'mode_of_payment' => 'required|numeric',
                'checkinDate' => 'required|date_format:d-m-Y',
                'checkoutDate' => 'required|date_format:d-m-Y',
                //'available_room' => 'required|numeric',
            ];
            
        }
        
      //  unique:users,email,'.Request::get('id').'
        
        if(Request::get('action') == '1')
        {
            
            array_push($rules,['medium_of_contact'=>'required|max:100']);
            
        }
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            if(Request::get('record_id') == null)
            {
                try{
                $customer_id = $this->addCustomer();
                $user = Auth::user();
                $i =0;
                foreach(Request::get('available_room') as $room_no){
                    
                    $i++;
                
                    $room_type = new SalesRoom();
                    $room_type->room_id = Request::get('room_id');
                    $room_type->room_no = $room_no;
                    $room_type->others = Request::get('others');
                    $room_type->arrival_date = date('Y-m-d',strtotime(Request::get('checkinDate')));
                    $room_type->leave_date = date('Y-m-d',strtotime(Request::get('checkoutDate')));
                    $room_type->added_by = Auth::id();
                    $room_type->amount = Request::get('room_cost');
                    $room_type->customer_id = $customer_id;
                    $room_type->mode_of_payment = Request::get('mode_of_payment');
                    $room_type->special_request = Request::get('special_request');
                    $room_type->action = Request::get('action');
                    $room_type->medium_of_contact = Request::get('medium_of_contact');
                    $room_type->similar_id = time();
                    $room_type->amount_paid = Request::get('amount_paid');
                    $room_type->room_rate = Request::get('amount');
                    $room_type->no_of_days = Request::get('no_of_days');
                    $room_type->save();
                
                    if(Request::get('action') == '0')
                    {
                        $this->RoomOccupiedLog($room_no); 
                    }
                }
            
            
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
                }
                catch(\Exception $e)
                {
                   // return $e->getMessage();
                }
            
        }
        
            else{
                
                $customer_id = $this->addCustomer();
                $user = Auth::user();
                $i =0;
                try{
                      SalesRoom::where('similar_id',Request::get('similar_id'))
                                          ->delete();
                                          
                foreach(Request::get('available_room') as $room_no){
                    
                    $i++;
                    
                    
                
                 
                    
                    $room_type = new SalesRoom();
                    $room_type->room_id = Request::get('room_id');
                    $room_type->room_no = $room_no;
                    $room_type->others = Request::get('others');
                    $room_type->arrival_date = date('Y-m-d',strtotime(Request::get('checkinDate')));
                    $room_type->leave_date = date('Y-m-d',strtotime(Request::get('checkoutDate')));
                    $room_type->added_by = Auth::id();
                    $room_type->amount = Request::get('room_cost');
                    $room_type->customer_id = $customer_id;
                    $room_type->mode_of_payment = Request::get('mode_of_payment');
                    $room_type->special_request = Request::get('special_request');
                    $room_type->action = Request::get('action');
                    $room_type->medium_of_contact = Request::get('medium_of_contact');
                    $room_type->similar_id = Request::get('similar_id');
                    $room_type->amount_paid = Request::get('amount_paid');
                    $room_type->no_of_days = Request::get('no_of_days');
                    $room_type->room_rate = Request::get('amount');
                    $room_type->save();
                    
                    $sales_rm_id = SalesRoom::find(SalesRoom::orderby('id','desc')->get()[0]->id);
                    Session::put('sale_rm_id',$sales_rm_id);
                
                    if(Request::get('action') == '0')
                    {
                        $this->RoomOccupiedLog($room_no); 
                    }
                }
            
            
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
                }
                catch(\Exception $e)
                {
                    return $e->getMessage();
                }
            
        }
        
        }
        
    }
    
    public function checkIn()
    {
        $obj = SalesRoom::find(Request::get('sales_id'));
        
        if($obj->action == '0')
        {
            $obj->action = '2';
            $obj->save();
            return 'Check In';
        }
        else{
            $obj->action = '0';
            $obj->save();
            return 'Check Out';
        }
        
        
    }
    
    public function checkInTemp()
    {
        $obj = SalesRoom::find(Request::get('sales_id'));
        
        if($obj->temp_action == '0')
        {
            $obj->temp_action = '1';
            $obj->save();
            return 'Check In';
        }
        else{
            
            $obj->temp_action = '0';
            $obj->save();
            return 'Check Out';
        }
        
        
    }
    
    // Delete Sold Rooms
    
    public function deleteSoldRooms($id)
    {
        $obj = SalesRoom::find($id);
        
        if($obj && Auth::user()->dept == '7')
        {
        
           $obj->status= 1;
           $obj->save();
           $user = Auth::user();
            
           $success['token'] =  $user->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Delete Successful';
           Session::put('token',$success['token']);
           return response()->json(['success'=>$success]);
            
        } 
        
    }
    
    // get Room name
    
    public function getRoomName($id)
    {
        $obj = RoomType::find($id);
        
        if($obj)
        {
           return $obj->name;    
        }
        
    }
    
    // Edit Sold Room
    
    public function editSoldRoom()
    {
       $value = Request::all();
        
        $rules = [
            
            'checkinDate' => 'required|date_format:d-m-Y',
            'checkoutDate' => 'required|date_format:d-m-Y',
            //'available_room' => 'required|numeric',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            $obj =  Session::get('sale_rm_id');
            
            $user = Auth::user();
            $room_type = SalesRoom::find($obj->id);
            $room_type->room_id = Request::get('room_id');
            if(Request::get('available_room') != '')
            {
                $room_type->room_no = Request::get('available_room');
            }
            $room_type->arrival_date = date('Y-m-d',strtotime(Request::get('checkinDate')));
            $room_type->leave_date = date('Y-m-d',strtotime(Request::get('checkoutDate')));
            $room_type->added_by = Auth::id();
            $room_type->amount = Request::get('amount');
            $room_type->save();
            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
    public function getAvailabeRooms()
    {
        $room_id = Request::get('room_id');
        $room_no = RoomType::where('id',$room_id)->get()[0]->room_numbers;
        $rooms = explode(',',$room_no);
        $available_rooms = []; $room_no=''; $unavailable_rooms=[];
        $available_room_condition_color = [];
        $unavailable_room_condition_color = [];

        
        foreach($rooms as $val)
        {
            $count = $this->availableRoom($val,Request::get('checkin'),Request::get('checkout'));
            
            
            if($count == 0 )
            {
               array_push($available_rooms,$val);   
               array_push($available_room_condition_color,$this->checkRoomCondition($val));    
            }
            
            if($count > 0)
            {
                array_push($unavailable_rooms,$val);
                array_push($unavailable_room_condition_color,$this->checkRoomCondition($val));  
            }
            
        }
        
        $user = Auth::user();
        $success['token'] =  $user->createToken('Laravel')->accessToken; 
        $success['available_rooms'] = $available_rooms;
        $success['unavailable_rooms'] = $unavailable_rooms;
        $success['available_room_condition_color'] = $available_room_condition_color;
        $success['unavailable_room_condition_color'] = $unavailable_room_condition_color;
        Session::put('token',$success['token']);
        return response()->json(['success'=>$success]);
        
       
    }
    
    
    function checkRoomCondition($room_no)
    {
        
        $room_condition = RoomCondition::where('room_no',$room_no)->get();
        
        if(count($room_condition) > 0)
        {
            $room_condition = $room_condition[0]->status;
            
            if($room_condition == '0')
            {
                $color = 'green';   
            }
            elseif($room_condition == '1')
            {
                $color = 'red';   
            }
            elseif($room_condition == '2')
            {
                $color = '#A52A2A';   
            }
            elseif($room_condition == '3')
            {
                $color = 'yellow';   
            }
            elseif($room_condition == '4')
            {
                $color = 'blue';   
            }
            else{
                return 'green';
            }
        
            return $color;
            
        }
        
    }
    
    public function availableRoom($room_no,$checkin,$checkout)
    {
        
        $count = SalesRoom::where('room_no',$room_no)
                          ->whereRaw("(arrival_date between arrival_date and '".date('Y-m-d',strtotime($checkin))."' ) and (leave_date between  '".date('Y-m-d',strtotime($checkout))."' and leave_date) ")
                          ->where('status','0')
                          ->where('action','!=','2')
                          ->count();
        return $count;
    }
    
    
       // Get Profit
    
    public function getProfit()
    {
       $value = Request::all();
        
        $rules = [
            
            'SearchDate' => 'required',
            
         
        ];
        
        $validator = Validator::make($value,$rules);
        
        if($validator->fails()){
            
          return response()->json(['error'=>$validator->errors()]);             
            
        }
        else{
            
            
            $user = Auth::user();
            $date = explode('-',Request::get('SearchDate'));
            $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
            $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
            
            $room_sales = SalesRoom::whereRaw("(date(created_at) between '".$date[0]."' and '".$date[1]."') ")
                                    ->where('status','0')
                                    ->sum('amount');
            
            $drink_sales = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("(date(created_at) between '".$date[0]."' and '".$date[1]."') ")
                                     ->where('status','0')
                                     ->first()->total;
            
            $res_sales = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->whereRaw("(date(created_at) between '".$date[0]."' and '".$date[1]."') ")
                                        ->where('status','0')
                                        ->first()->total;
            
            $pool_sales = PoolSales::where('status','0')
                                     ->sum('cost');
            
            $Stock = Store::select(DB::raw('sum((qty*unitPrice)) as total'))
                                        ->whereRaw("(date(created_at) between '".$date[0]."' and '".$date[1]."') ")
                                        ->where('status','0')
                                        ->first()->total;
            
            $overall_total = array_sum([$room_sales+$drink_sales+$res_sales+$pool_sales+$Stock]);
        

            $success['token'] =  $user->createToken('Laravel')->accessToken; 
            $success['msg'] = 'Successful';
            $success['room_sales'] = $room_sales;
            $success['drink_sales'] = $drink_sales;
            $success['res_sales'] = $res_sales;
            $success['pool_sales'] = $pool_sales;
            $success['stock'] = $Stock;
            $success['overall_total'] = $overall_total;
            $success['Profit'] = $overall_total - $Stock;
            Session::put('token',$success['token']);
            return response()->json(['success'=>$success]); 
            
        }
        
    }
    
   

    
}
