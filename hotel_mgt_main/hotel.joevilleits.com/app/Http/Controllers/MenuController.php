<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Session;
use DB;
use App;
use App\Models\User;
use App\Models\Store;
use App\Models\RoomType;
use App\Models\Foodtype;
use App\Models\PoolSales;
use App\Models\SalesRestuarant;
use App\Models\StoreCollections;
use Request;
use App\Models\SellRooms;
use App\Models\DrinkType;
use App\Models\SalesDrink;
use App\Models\SalesRoom;
use App\Models\Cities;
use App\Models\States;
use App\Models\countries;
use App\Models\customer;
use App\Models\RoomCondition;
use App\Models\RoomOccupiedLog;
use App\Models\CustomerSpendingLog;
use App\Models\CustomerLoyalty;
use App\Models\Shift;
use Validator;
//use App\app_interfaces\PdfDoc;
use App\Models\hotelDetails;
use PDF;
use Mail;



class MenuController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $page_size = 25;
    
    private  $pdfDoc;
    
    public $url;
    
    public $company_name;
    
    public $company_email;
    
    public function __construct()
    {
        $this->url = 'https://hotel.joevilleits.com/';
        $this->company_email = 'info@joevilleits.com';
        $this->company_name = 'JOEvilleITS'; 
    }

    
    // User main Page
    public function AdminDashboard()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
            $room_sales = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."'  ")
                                    ->where('status','0')
                                    ->sum('amount');
            
            $drink_sales = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                     ->where('status','0')
                                     ->first()->total;
            
            $res_sales = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                        ->where('status','0')
                                        ->first()->total;
            
            $pool_sales = PoolSales::where('status','0')
                                   ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                   ->sum('cost');
            
            $Stock = Store::select(DB::raw('sum((qty*unitPrice)) as total'))
                                        ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                        ->where('status','0')
                                        ->first()->total;
            
            $room_sales_no = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."'  ")
                                    ->where('status','0')
                                    ->count();
            
            $drink_sales_no = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                     ->where('status','0')
                                     ->count();
            
            $res_sales_no = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                        ->where('status','0')
                                        ->count();
            
            $pool_sales_no = PoolSales::where('status','0')
                                   ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                   ->count();
            
            
            $overall_total = array_sum([$room_sales+$drink_sales+$pool_sales]);
            
            $orders = array_sum([$pool_sales_no+$drink_sales_no+$pool_sales_no]);
            
            $profit = array_sum([$room_sales+$drink_sales+$pool_sales]) - $Stock;
            
            return view('user.index')->with(['income'=>$overall_total,'Profit'=>$profit,'orders'=>$orders,'obj'=>$this]);
            
        }
    }
    
    
    // List OF Debtors Page
    
    public function listOfDebtors()
    {
        
        $sales_room = SalesRoom::where('paid','0')
                               ->whereNotNull('customer_id')
                               ->where('status','0')
                               ->paginate($this->page_size,['*'],'debtors_list');
        
        
        return view('user.listOfDebtors')->with(['sales_room'=>$sales_room,'obj'=>$this]);
        
    }
    
    public function retrieveCustomerData()
    {
        
        $customer_data = customer::find(Request::get('id'));
                                 
        return response()->json(['data'=>$customer_data]); 
        
    }
    
    
    // Get Departments Income 
    
   // public function getDeptIncome($)
    
    
    // Best Performing Depts Page
    
    public function BestPerformingDepts()
    {
         
        if(Request::get('date1') == null)
        {
            
               $income_room = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                    ->where('status','0')
                                    ->sum('amount');
                                    
                
                   
       
               $income_drink = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'    ")
                                     ->where('status','0')
                                     ->first()->total;
            
      
               $income_restuarant = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                             ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'    ")
                                             ->where('status','0')
                                             ->first()->total;
      
               $income_pool = PoolSales::where('status','0')
                                              ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'    ")
                                              ->sum('cost');
                                              
               $room_employees =  User::where('dept','2')
                                      ->where('status','0')
                                      ->get();
            
               
               $expenses_room = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$room_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_room) > 0 )
                {
                    $expenses_room = $expenses_room->total_expenses;
                }
                else{
                    
                    $expenses_room = 0;
                }
                
               $drink_employees =  User::where('dept','4')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_drink = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$drink_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_drink) > 0 )
                {
                    $expenses_drink = $expenses_drink->total_expenses;
                }
                else{
                    
                    $expenses_drink = 0;
                }
                
               $restuarant_employees =  User::where('dept','3')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_restuarant = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$restuarant_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_restuarant) > 0 )
                {
                    $expenses_restuarant = $expenses_restuarant->total_expenses;
                }
                else{
                    
                    $expenses_restuarant = 0;
                }
                
               $pool_employees =  User::where('dept','5')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_pool = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$pool_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
               if(count($expenses_pool) > 0 )
                {
                    $expenses_pool = $expenses_pool->total_expenses;
                }
                else{
                    
                    $expenses_pool = 0;
                }
                                                   
               $Income = ['room'=>$income_room,'bar'=>$income_drink,'restuarant'=>$income_restuarant,'pool'=>$income_pool];
               
               $Expenses = ['room'=>$expenses_room,'bar'=>$expenses_drink,'restuarant'=>$expenses_restuarant,'pool'=>$expenses_pool];
                                                   
               // dd($expenses_room);
                                                  
                                             
        
        } 
        else{
            
             $date = explode('-',Request::get('date1'));
             $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
             $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
            
              $income_room = SalesRoom::whereBetween('created_at',[$date[0],$date[1]])
                                    ->where('status','0')
                                    ->sum('amount');
                                    
                
                   
       
               $income_drink = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereBetween('created_at',[$date[0],$date[1]])
                                     ->where('status','0')
                                     ->first()->total;
            
      
               $income_restuarant = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                             ->whereBetween('created_at',[$date[0],$date[1]])
                                             ->where('status','0')
                                             ->first()->total;
      
               $income_pool = PoolSales::where('status','0')
                                              ->whereBetween('created_at',[$date[0],$date[1]])
                                              ->sum('cost');
                                              
               $expenses_room = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$room_employees)
                                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_room) > 0 )
                {
                    $expenses_room = $expenses_room->total_expenses;
                }
                else{
                    
                    $expenses_room = 0;
                }
                
               $drink_employees =  User::where('dept','4')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_drink = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$drink_employees)
                                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_drink) > 0 )
                {
                    $expenses_drink = $expenses_drink->total_expenses;
                }
                else{
                    
                    $expenses_drink = 0;
                }
                
               $restuarant_employees =  User::where('dept','3')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_restuarant = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$restuarant_employees)
                                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_restuarant) > 0 )
                {
                    $expenses_restuarant = $expenses_restuarant->total_expenses;
                }
                else{
                    
                    $expenses_restuarant = 0;
                }
                
               $pool_employees =  User::where('dept','5')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_pool = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$pool_employees)
                                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
               if(count($expenses_pool) > 0 )
                {
                    $expenses_pool = $expenses_pool->total_expenses;
                }
                else{
                    
                    $expenses_pool = 0;
                }
            
               
            
                                              
              
                                                   
               $Income = ['room'=>$income_room,'bar'=>$income_drink,'restuarant'=>$income_restuarant,'pool'=>$income_pool];
               
               $Expenses = ['room'=>$expenses_room,'bar'=>$expenses_drink,'restuarant'=>$expenses_restuarant,'pool'=>$expenses_pool];
                                                   
            
        }
    
               return view('user.bestPerformingDepts')->with(['obj'=>$this,'Income'=>$Income,'Expenses'=>$Expenses]);
        
    }
    
    public function NotificationPage()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           
           $special_request_notification = SalesRoom::whereRaw("date(arrival_date) = '".date('Y-m-d',strtotime('+ 1 days'))."'")
                                                    ->WhereNotNull('special_request')
                                                    ->where('special_request','!=','')
                                                    ->paginate($this->page_size,['*'],'notification');
                                    
           $logged_in_customers =  SalesRoom::where('action','0')
                                            ->get(['customer_id'])
                                            ->toArray();
                                    
           $birthday_notification = customer::whereRaw("month(birthday) = '".date('m')."'")
                                            ->whereRaw("day(birthday) = '".date('d')."'")
                                            ->WhereIn('id',$logged_in_customers)
                                            ->paginate($this->page_size,['*'],'notification');
                                            
            
            
           $max_value = max([count($special_request_notification),count($birthday_notification)]);
           
           if($max_value == count($special_request_notification)   )
           {
              $paging = $special_request_notification;
           }
           elseif($max_value == count($birthday_notification))
           {
              $paging = $birthday_notification;
           }
           
                                    
           return view('user.Notification')->with(['special_request_notif'=>$special_request_notification,'paging'=>$paging,'birthday_notif'=>$birthday_notification,'obj'=>$this]);   
        }
        else{
            return redirect('login');
        }
    }
    
    public function addShift()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           return view('user.addShift');   
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function editShift()
    {
        if(Auth::check())
        {
           $data = Shift::find(Request::get('id'));
           
           if($data){
               
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                return view('user.editShift')->with(['data'=>$data]);
           }
           
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function allShifts()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $all_shift = Shift::where('status','0')->paginate($this->page_size,['*'],'all_shifts');
           return view('user.allShifts')->with(['all_shift'=>$all_shift]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function getBestDeptsData($month,$dept)
    {
        
        if($dept == 'room')
        {
            
                $value = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".$month."'   ")
                                    ->where('status','0')
                                    ->sum('amount');
                                    
                if($value == '')
                {
                    return 0;
                }
                else{
                    return $value;
                }
               // return $room;
                                    
        }
        else if($dept == 'drink')
        {
               $value =  SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".$month."'   ")
                                     ->where('status','0')
                                     ->first()->total;
                                     
                if($value == '')
                {
                    return 0;
                }
                else{
                    return $value;
                }
            
        }
        else if($dept == 'restuarant')
        {
               $value =  SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                             ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".$month."'   ")
                                             ->where('status','0')
                                             ->first()->total;
                if($value == '')
                {
                    return 0;
                }
                else{
                    return $value;
                }
                
            
        }
        else if($dept == 'pool')
        {
               $value =  PoolSales::where('status','0')
                                              ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".$month."'   ")
                                              ->sum('cost');
                                              
                if($value == '')
                {
                    return 0;
                }
                else{
                    return $value;
                }
            
        }
        
            
     
        
        
    }
    
    // Top 100 Customers
    
    public function top100Customers()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
               
                    
                         
                                       
                    $sales_room = SalesRoom::select('customer_id', DB::raw('sum(amount) as total'))
                                           ->whereNotNull('customer_id')
                                           ->where('customer_id','!=','')
                                           ->where('status','0')
                                           ->groupBy('customer_id')
                                           ->get()
                                           ->keyBy('total')
                                           ->toArray();
                                           
                  
            
                    $sales_drink = SalesDrink::select('customer_id', DB::raw('sum(price * qty) as total'))
                                           ->whereNotNull('customer_id')
                                           ->where('customer_id','!=','')
                                           ->where('status','0')
                                           ->groupBy('customer_id')
                                           ->get()
                                           ->keyBy('total')
                                           ->toArray();
                          
                    $sales_res = SalesRestuarant::select('customer_id', DB::raw('sum(price * qty) as total'))
                                           ->whereNotNull('customer_id')
                                           ->where('customer_id','!=','')
                                           ->where('status','0')
                                           ->groupBy('customer_id')
                                           ->get()
                                           ->keyBy('total')
                                           ->toArray();
                                           
                    
                                   
                    $sales_pool =  PoolSales::select('customer_id', DB::raw('sum(cost) as total'))
                                           ->whereNotNull('customer_id')
                                           ->where('customer_id','!=','')
                                           ->where('status','0')
                                           ->groupBy('customer_id')
                                           ->get()
                                           ->keyBy('total')
                                           ->toArray();                 
                                           
                                           
                    $data = array_merge($sales_room,$sales_drink,$sales_res,$sales_pool);
                    
                    
                                           
                    $top_100 = array_values(collect($sales_room)->sortByDesc('total')->take(100)->toArray());
                   
                                     
           
                    return view('user.top100customers')->with(['top_100'=>$top_100,'obj'=>$this]);
            
        }
    }
    
     //  customer activities
     
    public function customer_activities()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
            
            
            if(Request::get('date1') != null)
            {
                     $date = explode('-',Request::get('date1'));
                     $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                     $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
            
                     $sales_room = SalesRoom::whereNotNull('customer_id')
                                   ->where('status','0')
                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                   ->paginate($this->page_size,['*'],'activities')
                                   ->appends('date1',Request::get('date1'));
                                   
                                   
                     $sales_drink = SalesDrink::whereNotNull('customer_id')
                                   ->where('status','0')
                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                   ->paginate($this->page_size,['*'],'activities')
                                   ->appends('date1',Request::get('date1'));
                                   
                                   
                     $sales_res = SalesRestuarant::whereNotNull('customer_id')
                                   ->where('status','0')
                                   ->whereBetween('created_at',[$date[0],$date[1]])
                                  ->paginate($this->page_size,['*'],'activities')
                                  ->appends('date1',Request::get('date1'));
                                   
                                   
                    $sales_pool =  PoolSales::where('status','0')
                                            ->whereBetween('created_at',[$date[0],$date[1]])
                                            ->whereNotNull('customer_id')
                                            ->paginate($this->page_size,['*'],'activities')
                                            ->appends('date1',Request::get('date1'));
                                   
                           
            }
            else{
                
                    $sales_room = SalesRoom::whereNotNull('customer_id')
                                           ->where('status','0')
                                           ->paginate($this->page_size,['*'],'activities');
                                   
                                   
                    $sales_drink = SalesDrink::whereNotNull('customer_id')
                                             ->where('status','0')
                                             ->paginate($this->page_size,['*'],'activities');
                                   
                                   
                    $sales_res = SalesRestuarant::whereNotNull('customer_id')
                                                ->where('status','0')
                                                ->paginate($this->page_size,['*'],'activities');
                                   
                                   
                    $sales_pool =  PoolSales::where('status','0')
                                            ->whereNotNull('customer_id')
                                            ->paginate($this->page_size,['*'],'activities');
                                   
                
            }
            
            $max_value = max([count($sales_room),count($sales_drink),count($sales_res),count($sales_pool)]);
            
            if($max_value == count($sales_room)   )
            {
                $paging = $sales_room;
            }
            elseif($max_value == count($sales_drink))
            {
                $paging = $sales_drink;
            }
            elseif($max_value == count($sales_res))
            {
                $paging = $sales_res;
            }
            elseif($max_value == count($sales_pool))
            {
                $paging = $sales_pool;
            }
            
            return view('user.customer_activities')->with(['sales_room'=>$sales_room,'sales_drink'=>$sales_drink,'sales_res'=>$sales_res,'sales_pool'=>$sales_pool,'paging'=>$paging,'obj'=>$this]);
            
        }
    }
    
    // Get Income
    
    public function getIncome($value)
    {
          $room_sales = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."' and Month(created_at) = '".$value."'  ")
                                    ->where('status','0')
                                    ->sum('amount');
            
            $drink_sales = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."' and Month(created_at) = '".$value."'  ")
                                     ->where('status','0')
                                     ->first()->total;
            
            $res_sales = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->whereRaw("Year(created_at) = '".date('Y')."' and Month(created_at) = '".$value."'  ")
                                        ->where('status','0')
                                        ->first()->total;
            
            $pool_sales = PoolSales::where('status','0')
                                   ->whereRaw("Year(created_at) = '".date('Y')."' and Month(created_at) = '".$value."'  ")
                                   ->sum('cost');
        
            $overall_total = array_sum([$room_sales+$drink_sales+$pool_sales]);
        
            return $overall_total;
       
    }
    
    // Your Profile Page
    
    public function UserProfile()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           return view('user.user_profile');   
        }
        else{
            return redirect('login');
        }
    }
    
    //Loyalty Page
    
    public function  loyalty_page()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $data = CustomerLoyalty::all();
           $obj = '';
           if(count($data) > 0)
           {
               $obj = $data[0];
           }
           return view('user.loyalty_page')->with(['data'=>$obj]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    // Create a User Page
    public function createUserPage()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $states = States::where('country_id','160')->get();
           $state_id = '';
           foreach($states as $val)
           {
               $state_id.=$val->id.',';
           }
           $all_values = explode(',',$state_id);
           $cities = Cities::whereIn('state_id',$all_values)->get();
           return view('user.createUsers')->with(['states'=>$states,'cities'=>$cities]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
     // Customer List Page
    public function customerListPage()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           
           $customer = customer::where('status','0')
                               ->paginate($this->page_size,['*'],'customer_list');
                               
           return view('user.customer_list')->with(['customer_list'=>$customer]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    // View Customer Detail
    public function view_customer_detail()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           
           $customer = customer::find(Request::get('id'));
           
           $countries = countries::all();
                               
           return view('user.view_customer_detail')->with(['cus_detail'=>$customer,'countries'=>$countries]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    // Dashboard
    public function Dashboard()
    {
        if(Auth::check())
        {
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           //$success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           if(Auth::user()->dept == '7')
           {
               return redirect('adminDashboard');
           }
           else{
              return view('user.dashboard');
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    // All Users Page
    public function allUsers()
    {
        
        if(Auth::check() && Auth::user()->dept == '7' )
        { 
           $user = new UserController();
           $all_users = User::where('status','0')
                            ->orwhere('status','2')
                            ->orderby('id','desc')
                            ->paginate($this->page_size,['*'],'users');
            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken;
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           return view('user.allUsers')->with(['all_users'=>$all_users,'user'=>$user]);   
        }
        else{
            return redirect('login');
        }
        
        
    }
    
    // Edit User
    public function editUser()
    {
        $obj = User::find(Request::get('id'));
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
             // $success['msg'] = 'Delete Successful';
              $states = States::where('country_id','160')->get();
              $state_id = '';
              foreach($states as $val)
              {
                $state_id.=$val->id.',';
              }
              $all_values = explode(',',$state_id);
              $cities = Cities::whereIn('state_id',$all_values)->get();
                            
              $success['token'] =  Auth::user()->createToken('Laravel')->accessToken;
              Session::put('token',$success['token']);
              return view('user.editUsers')->with(['users'=>$obj,'states'=>$states,'cities'=>$cities]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    /* Edit Sold Food
    
    public function editSoldFood()
    {
        $obj = SalesRestuarant::find(Request::get('id'));
        
        if(Auth::check())
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              $food_types = Foodtype::where('status','0')->get();
              Session::put('token',$success['token']);
              return view('user.editSoldFood')->with(['Sales'=>$obj,'food_types'=>$food_types]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    */
    
    //add To Store
    
    public function addToStore()
    {
        
        if(Auth::check() )
        {
          
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
            
              $all_stock = DB::table('store')
                     ->select(DB::raw('itemName'))
                     ->where('status','0')
                     ->groupBy('itemName')
                     ->get();

              $admins = User::where('status','0')->where('dept','7')->get();
              Session::put('store_items',$all_stock);
              //dd($all_stock);
              return view('user.addToStore')->with(['admins'=>$admins]); 
                
        }   
        else{
            return redirect('login');
        }
        
    }
    
    //all Stock
    
    public function allStock()
    {
        
        if(Auth::check())
        {
          
             $user = Auth::user();
            
             $all_items = DB::table('store')->select(DB::raw('itemName, sum(qty) as qty,max(updated_at) as updated_at,max(id) as id'))
                                             ->where('status','0')
                                             ->groupBy('itemName')
                                             ->orderby('id','asc')
                                              ->paginate($this->page_size,['*'],'stock');

              $stock = new StoreController();
              
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              $user = new UserController();
              return view('user.allStock')->with(['all_items'=>$all_items,'user'=>$user,'stock'=>$stock]); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
     // Edit Store Page
    public function editStorePage()
    {
        $obj2 = Store::find(Request::get('id'));
        
        $obj = DB::table('store')->select(DB::raw('itemName,max(dept) as dept, sum(qty) as qty, max(id) as id'))
                                             ->where('status','0')
                                             ->where('itemName',$obj2->itemName)
                                             ->groupBy('itemName')
                                             ->get()[0];
        
        //dd($obj->itemName);
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $stock = new StoreController();
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editStore')->with(['store'=>$obj,'stock'=>$stock]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // add Room Type
    public function addRoomType()
    {
        //$obj = Room::find(Request::get('id'));
        
        if(Auth::check())
        {
          
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.addRoomType'); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // All Room Types
    public function allRoomType()
    {
        
        if(Auth::check())
        { 
           $all_items = RoomType::where('status','0')
                            ->orderby('id','desc')
                            ->paginate($this->page_size,['*'],'room_types');
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.allRoomTypes')->with(['all_items'=>$all_items,'user'=>$user]);   
        }
        else{
            return redirect('login');
        }
        
        
    }
    
    // Edit Room Types
    public function editRoomType()
    {
        $obj = RoomType::find(Request::get('id'));
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editRoomType')->with(['room_type'=>$obj]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // add Food Type
    public function addFoodType()
    {
        
        if(Auth::check())
        {
          
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.addFoodType'); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // All Food Type
    
    public function allFoodType()
    {
        if(Auth::check())
        { 
           if(Request::get('date1') != null)
           {
                $date = explode('-',Request::get('date1'));
                $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
                $all_items = Foodtype::where('status','0')
                                     ->whereBetween('created_at',[$date[0],$date[1]])
                                     ->paginate($this->page_size,['*'],'food_type');
                            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allFoodTypes')->with(['all_items'=>$all_items,'user'=>$user]);
           }
           else{
               
                $all_items = Foodtype::where('status','0')
                            ->paginate($this->page_size,['*'],'food_type');
                            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allFoodTypes')->with(['all_items'=>$all_items,'user'=>$user]);
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    // All Sold Food
    
    public function allSoldFood()
    {
        if(Auth::check())
        { 
           $all_items = SalesRestuarant::where('status','0')
                            ->paginate($this->page_size,['*'],'food_sales');
            
           $food_type = new FoodTypeController();
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.allSoldFood')->with(['all_items'=>$all_items,'user'=>$user,'food_type'=>$food_type]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function addHotelDetails()
    {
        if(Auth::check())
        { 
           
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           $data_2 = '';
           
           $data = hotelDetails::all();
           if(count($data) > 0)
           {
               $id = $data[0]->id;
               $data_2 = hotelDetails::find($id);
           }
           
           Session::put('token',$success['token']);
           return view('user.addHotelDetails')->with(['data'=>$data_2]);
           
        }
        else{
            return redirect('login');
        }
       
    }
    
    
    
    // Edit Food Type
    
    public function editFoodType()
    {
        $obj = Foodtype::find(Request::get('id'));
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editFoodtype')->with(['food_type'=>$obj]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    public function getNotificationCount()
    {
      
        $special_request_notification = count(SalesRoom::whereRaw("date(arrival_date) = '".date('Y-m-d',strtotime('+ 1 days'))."'")
                                                    ->WhereNotNull('special_request')
                                                    ->where('special_request','!=','')
                                                    ->paginate($this->page_size,['*'],'notification'));
                                    
        $logged_in_customers =  SalesRoom::where('action','0')
                                            ->get(['customer_id'])
                                            ->toArray();
                                    
        $birthday_notification = count(customer::whereRaw("month(birthday) = '".date('m')."'")
                                            ->whereRaw("day(birthday) = '".date('d')."'")
                                            ->WhereIn('id',$logged_in_customers)
                                            ->paginate($this->page_size,['*'],'notification'));
                                            
        return $special_request_notification + $birthday_notification;
        
        
    }
    
    
    // Shopping Cart Page
    
    public function ShoppingCartPage()
    {
        //$obj = Foodtype::find(Request::get('id'));
        
      //  $this->clearCart();
        
       // dd(Session::get('qty'));
        
        if(Auth::check())
        {  
          //$menu_obj = new MenuController(null);
          $rooms = SalesRoom::where('action','=','0')->get();
          return view('user.shopping-cart')->with(['menu_obj'=>$this,'rooms'=>$rooms,'obj'=>$this]);  
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
     // Receipts
    
    public function Receipts()
    {
      
        
        if(Auth::check())
        {  
            
          $obj_data = SalesRoom::where('similar_id',Request::get('similar_id'))->get()[0];
          
          $no_of_rooms = SalesRoom::where('similar_id',Request::get('similar_id'))->count();
          
          $room_nos = implode(',',SalesRoom::where('similar_id',Request::get('similar_id'))->pluck('room_no')->all());
          
          $customer_obj  =  customer::find($obj_data->customer_id);
          
         
        
                  
            
        $sales_drink = SalesDrink::whereNotNull('customer_id')
                                 ->where('customer_id','!=','')
                                 ->where('status','0')
                                 ->get();
                                         
                          
        $sales_res = SalesRestuarant::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->get();
                                           
                    
                                   
        $sales_pool =  PoolSales::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->get(); 
                                    
        $total =  PoolSales::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->sum('cost'); 
                                    
        $total +=  SalesDrink::select(DB::raw('(price * qty) as total'))
                             ->whereNotNull('customer_id')
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                             
        $total +=  SalesRestuarant::select(DB::raw('(price * qty) as total'))
                             ->whereNotNull('customer_id')
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                             
        $total+= SalesRoom::select(DB::raw('(amount * count(*))- amount_paid as total'))
                             ->whereNotNull('customer_id')
                             ->where('similar_id',Request::get('similar_id'))
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                                    
        $drink_obj = new DrinkController();
        
        $food_obj = new FoodTypeController();
        
        $hotel_details = '';
        
        if(count(hotelDetails::all()) > 0)
        {
            $hotel_details = hotelDetails::all()[0];
        }
        
        
          
        return view('receipts.receipts')->with(['obj_data'=>$obj_data,'hotel_details'=>$hotel_details,'invoice_no'=>Request::get('similar_id'),'total'=>$total,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj,'no_of_rooms'=>$no_of_rooms,'room_nos'=>$room_nos,'customer_obj'=>$customer_obj,'sales_drink'=>$sales_drink,'sales_res'=>$sales_res,'sales_pool'=>$sales_pool]);  
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    
    
    // Make Sales Restuarant
    
    public function makeSalesRestaurant()
    {
        if(Auth::check())
        { 
        
           // Session::put('type',null);
            // Session::put('cart',null);
            
            
           $main_course = Foodtype::where('status','0')
                            ->where('food_category','1')
                            ->paginate($this->page_size,['*'],'main_course');
            
           $starter = Foodtype::where('status','0')
                            ->where('food_category','2')
                            ->paginate($this->page_size,['*'],'starter');
            
           $special_food = Foodtype::where('status','0')
                            ->where('food_category','3')
                            ->paginate($this->page_size,['*'],'special_food');
            
           $soups  = Foodtype::where('status','0')
                            ->where('food_category','4')
                            ->paginate($this->page_size,['*'],'soups');
            
           $deserts  = Foodtype::where('status','0')
                            ->where('food_category','5')
                            ->paginate($this->page_size,['*'],'deserts');
            
           $chef_pick = Foodtype::where('status','0')
                            ->where('food_category','6')
                            ->paginate($this->page_size,['*'],'deserts');
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.makeSalesRestaurant')->with(['main_course'=>$main_course,'starter'=>$starter,'special_food'=>$special_food,'soups'=>$soups,'deserts'=>$deserts,'chef_pick'=>$chef_pick,'menu_obj'=>$this]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    // View All Sales Restuarant
    
    public function allSalesRestuarant()
    {
        if(Auth::check())
        { 
            
           if(Request::get('date1') != null)
           {
                $date = explode('-',Request::get('date1'));
                $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
               
                $Income = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->first()->total;
               
                $sales_total = SalesRestuarant::where('status','0')
                                         ->whereBetween('created_at',[$date[0],$date[1]])
                                         ->count();
               
                $all_items = SalesRestuarant::where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->paginate($this->page_size,['*'],'sales_res');
               
                $food_obj = new FoodTypeController();
            
                $drink_obj = new DrinkController();
                                    
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allSalesRestuarant')->with(['all_items'=>$all_items,'user'=>$user,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj,'Income'=>$Income,'sales_total'=>$sales_total]); 
           }
           else{
                    
               $all_items = SalesRestuarant::where('status','0')
                            ->paginate($this->page_size,['*'],'sales_res');
            
               $food_obj = new FoodTypeController();
                            
               $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
               $success['msg'] = 'Successful';
               Session::put('token',$success['token']);
               $user = new UserController();
               return view('user.allSalesRestuarant')->with(['all_items'=>$all_items,'user'=>$user,'food_obj'=>$food_obj]);   
               
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    // Edit Sales Restuarant
    
    public function editSalesRestuarant()
    {
        $obj = SalesRestuarant::find(Request::get('id'));
        
        $food_obj = new FoodTypeController();
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              $rooms = SalesRoom::where('action','=','0')->get();
              return view('user.editSalesRestuarant')->with(['food_sales'=>$obj,'food_obj'=>$food_obj,'rooms'=>$rooms,'obj'=>$this]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // Collect From Store 
    
    public function collectFromStore()
    {
        $all_items = Store::where('status','0')->get();
        
        $users = User::where('status','0')->get();
        
        $food_obj = new FoodTypeController();
        
        if(Auth::check())
        {
           
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.CollectStore')->with(['all_items'=>$all_items,'users'=>$users,'food_obj'=>$food_obj]); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // all Store Collections
    
    public function allStoreCollections()
    {
        $all_items = StoreCollections::where('status','0')
                                     ->paginate($this->page_size,['*'],'store_collections');
        
        $users = new UserController();
        
       // $food_obj = new FoodTypeController();
        
        if(Auth::check())
        {
           
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.allStoreCollections')->with(['all_items'=>$all_items,'user'=>$users]); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // sales Activity Report
    
    public function salesActivityReport()
    {
       
        if(Auth::check())
        {
           
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.salesActivityReport'); 
              
    
        }   
        else{
            return redirect('login');
        }
        
    }

        
    
    // edit Store Collections
    
    public function editStoreCollections()
    {
        $obj = StoreCollections::find(Request::get('id'));
        
        $all_items = Store::where('status','0')->get();
        
        $users = User::where('status','0')->get();
        
        $food_obj = new FoodTypeController();
        
        if(Auth::check() && Auth::user()->dept == '7')
        {
           if($obj)
           {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editStoreCollections')->with(['all_items'=>$all_items,'users'=>$users,'food_obj'=>$food_obj,'store_collect'=>$obj]); 
              
           }
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    public function getRoomInstance($id)
    {
        $obj = SalesRoom::find($id);
        
        return $obj;
    }
    
    // View all Room Details
    
    public function RoomDetails()
    {
        
        if(Auth::check())
        {
            $d='';$customer_details = '';
            if(Request::get('a')== null){
               $d = Session::get('sale_rm_id');  
                 $customer_id = $d->customer_id;
                 $customer_details = customer::find($customer_id);
                
                 //Session::put('customer_suggestions',$customer_details->last_name);
            }
            
              $customer_suggestions = customer::where('status','0')
                                                 ->get();
                                                 
              Session::put('customer_suggestions',$customer_suggestions);
            
              $room_details = RoomType::find(Request::get('id'));
              $user = Auth::user();
              
              $room_obj = new RoomTypeController();
              
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              $countries = countries::all();
              return view('user.roomDetails')->with(['room_details'=>$room_details,'room_obj'=>$room_obj,'d'=>$d,'countries'=>$countries,'customer_details'=>$customer_details]);  
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // Sell Rooms
    
    public function SellRooms()
    {
        
        if(Auth::check())
        {
              $room_type = RoomType::where('status','0')->orderby('id','desc')->paginate($this->page_size,['*'],'room_type');
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.makeSalesRooms')->with(['room_type'=>$room_type]);      
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // All Sold Rooms 
    
    public function allSoldRooms()
    {
        if(Auth::check())
        { 
            if(Request::get('date1') != null)
           {
                $date = explode('-',Request::get('date1'));
                $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
               
                $Income = SalesRoom::select(DB::raw('sum(amount) as total'))
                                        ->where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->first()->total;
               
                $sales_total = SalesRoom::where('status','0')
                                         ->whereBetween('created_at',[$date[0],$date[1]])
                                         ->count();
               
                $all_items = SalesRoom::where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->paginate($this->page_size,['*'],'sales_room');
               
                $room_obj = new RoomTypeController();
                                    
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allSoldRooms')->with(['all_items'=>$all_items,'user'=>$user,'obs'=>$this,'room_obj'=>$room_obj,'Income'=>$Income,'sales_total'=>$sales_total]); 
           }
           else{    
               
             
           
                 $all_items = DB::table('sales_room')->selectRaw('* ,(amount * count(*)) as total')
                                                     ->groupBy('similar_id')
                                                     ->where('status','0')
                                                     ->orderby('id','desc')
                                                     ->paginate($this->page_size,['*'],'sold_rooms');
                                       
                 
                 $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                 $success['msg'] = 'Successful';
                 Session::put('token',$success['token']);
                 $user = new UserController();
                 $room_obj = new RoomTypeController();
                 return view('user.allSoldRooms')->with(['all_items'=>$all_items,'obs'=>$this,'user'=>$user,'room_obj'=>$room_obj]);   
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function SendReceiptToCustomer()
    {
       
          $obj_data = SalesRoom::where('similar_id',Request::get('similar_id'))->get()[0];
          
          $no_of_rooms = SalesRoom::where('similar_id',Request::get('similar_id'))->count();
          
          $room_nos = implode(',',SalesRoom::where('similar_id',Request::get('similar_id'))->pluck('room_no')->all());
          
          $customer_obj  =  customer::find($obj_data->customer_id);
          
         
        
                  
            
        $sales_drink = SalesDrink::whereNotNull('customer_id')
                                 ->where('customer_id','!=','')
                                 ->where('status','0')
                                 ->get();
                                         
                          
        $sales_res = SalesRestuarant::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->get();
                                           
                    
                                   
        $sales_pool =  PoolSales::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->get(); 
                                    
        $total =  PoolSales::whereNotNull('customer_id')
                                    ->where('customer_id','!=','')
                                    ->where('status','0')
                                    ->sum('cost'); 
                                    
        $total +=  SalesDrink::select(DB::raw('(price * qty) as total'))
                             ->whereNotNull('customer_id')
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                             
        $total +=  SalesRestuarant::select(DB::raw('(price * qty) as total'))
                             ->whereNotNull('customer_id')
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                             
        $total+= SalesRoom::select(DB::raw('(amount * count(*))- amount_paid as total'))
                             ->whereNotNull('customer_id')
                             ->where('similar_id',Request::get('similar_id'))
                             ->where('customer_id','!=','')
                             ->where('status','0')
                             ->first()->total;
                                    
        $drink_obj = new DrinkController();
        
        $food_obj = new FoodTypeController();
        
        $hotel_details = '';
        
        if(count(hotelDetails::all()) > 0)
        {
            $hotel_details = hotelDetails::all()[0];
        }
        
        $data = ['obj_data'=>$obj_data,'hotel_details'=>$hotel_details,'invoice_no'=>Request::get('similar_id'),'total'=>$total,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj,'no_of_rooms'=>$no_of_rooms,'room_nos'=>$room_nos,'customer_obj'=>$customer_obj,'sales_drink'=>$sales_drink,'sales_res'=>$sales_res,'sales_pool'=>$sales_pool];
       
        $pdf = PDF::loadView('receipts', $data);
	    $pdf->save(public_path().'/Receipts/'.Request::get('similar_id').'.pdf');
	    
        
	    
	    $data = ['link'=>$this->url.'Receipts/'.Request::get('similar_id').'.pdf'];
        
       // $email = $obj->email;
        
    
        
        $subject = 'Payment Receipt For '.$customer_obj->first_name.' '.$customer_obj->last_name.' Invoice ID:'.Request::get('similar_id');
        
       
        
        $data2 = ['email'=>$customer_obj->email_address,'subject'=>$subject];
        
        
        
        Mail::send(['html'=>'mails.Receipt'], $data, function($message) use ($data2) {
              $message->to($data2['email'])->subject
            ($data2['subject']);
             $message->from($this->company_email,$this->company_name);
        });
        
        
          
       // return view('receipts.receipts')->with(['obj_data'=>$obj_data,'hotel_details'=>$hotel_details,'invoice_no'=>Request::get('similar_id'),'total'=>$total,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj,'no_of_rooms'=>$no_of_rooms,'room_nos'=>$room_nos,'customer_obj'=>$customer_obj,'sales_drink'=>$sales_drink,'sales_res'=>$sales_res,'sales_pool'=>$sales_pool]);  
            
       
        
       
        
    }
    
    // edit Sold Rooms
    
    public function editSoldRoom()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
              $obj = SalesRoom::find(Request::get('id'));
            
              Session::put('sale_rm_id',$obj);
            
              return redirect('room-detail?id='.$obj->room_id);
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // Add Pool Sales
    
    public function addPoolSales()
    {
        
        if(Auth::check())
        {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              $rooms = SalesRoom::where('action','=','0')->get();
              return view('user.addPoolSales')->with(['rooms'=>$rooms,'obj'=>$this]);         
        }   
        else{
            return redirect('login');
        }
        
    }
    
      // All Pool Sales 
    
    public function allPoolSales()
    {
        if(Auth::check())
        { 
            if(Request::get('date1') != null)
           {
                $date = explode('-',Request::get('date1'));
                $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
               
                $Income = PoolSales::select(DB::raw('sum(cost) as total'))
                                        ->where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->first()->total;
               
                $sales_total = PoolSales::where('status','0')
                                         ->whereBetween('created_at',[$date[0],$date[1]])
                                         ->count();
               
                $all_items = PoolSales::where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->paginate($this->page_size,['*'],'sales_res');
               
                $room_obj = new RoomTypeController();
                                    
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allPoolSales')->with(['all_items'=>$all_items,'user'=>$user,'room_obj'=>$room_obj,'Income'=>$Income,'sales_total'=>$sales_total]); 
           }
           else{
               
                $all_items = PoolSales::where('status','0')
                            ->orderby('id','desc')
                            ->paginate($this->page_size,['*'],'pool_sales');
                            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                $room_obj = new RoomTypeController();
                return view('user.allPoolSales')->with(['all_items'=>$all_items,'user'=>$user,'room_obj'=>$room_obj]);
               
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    // Edit Pool Sales
    
    public function editPoolSales()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
              $pool_sales = PoolSales::find(Request::get('id'));
              $user = Auth::user();
              $rooms = SalesRoom::where('action','=','0')->get();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editPoolSales')->with(['pool_sales'=>$pool_sales,'rooms'=>$rooms,'obj'=>$this]); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // add drink Type
    public function addDrinkType()
    {
        
        if(Auth::check())
        {
          
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.addDrinkType'); 
              
           
            
        }   
        else{
            return redirect('login');
        }
        
    }
    
    //all Drink types
    public function allDrinkTypes()
    {
        if(Auth::check())
        { 
           $all_items = DrinkType::where('status','0')
                            ->orderby('id','desc')
                            ->paginate($this->page_size,['*'],'drink_types');
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.allDrinkTypes')->with(['all_items'=>$all_items,'user'=>$user]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
     //all Room List
     
    public function allRoomList()
    {
        if(Auth::check())
        { 
           $all_items = RoomType::where('status','0')
                                ->orderby('id','desc')
                                ->paginate($this->page_size,['*'],'room_types');
                                
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.room_list')->with(['all_items'=>$all_items,'user'=>$user,'data'=>$this,'obj'=>$this]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    //Top 100 Rooms
     
    public function Top100Rooms()
    {
        if(Auth::check())
        { 
           
           $all_items = RoomOccupiedLog::select('room_no', DB::raw('count(*) as total'))
                                       ->groupBy('room_no')
                                       ->orderby('total','desc')
                                       ->take(100)
                                       ->paginate($this->page_size,['*'],'top_100_rooms');
                                
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           $room_type_object = new RoomTypeController();
           return view('user.top100rooms')->with(['all_items'=>$all_items,'user'=>$user,'obj'=>$this,'room_type_object'=>$room_type_object]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    //edit Drink types
    
    public function editDrinkType()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
              $drink_types = DrinkType::find(Request::get('id'));
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.editDrinkType')->with(['drink_type'=>$drink_types]); 
                  
        }   
        else{
            return redirect('login');
        }
        
    }
    
    // Make Sales Drinks
    
    public function makeSalesDrinks()
    {
        if(Auth::check())
        { 
           $all_items = DrinkType::where('status','0')
                            ->paginate($this->page_size,['*'],'drink_type');
                            
           $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
           $success['msg'] = 'Successful';
           Session::put('token',$success['token']);
           $user = new UserController();
           return view('user.makeSalesDrinks')->with(['all_items'=>$all_items,'user'=>$user,'menu_obj'=>$this]);   
        }
        else{
            return redirect('login');
        }
        
    }
    
    // View All Sales Drinks
    
    public function allSalesDrink()
    {
        if(Auth::check())
        { 
           
           if(Request::get('date1') != null)
           {
                $date = explode('-',Request::get('date1'));
                $date[0] = date('Y-m-d',strtotime(str_replace("/","-",$date[0])));
                $date[1] = date('Y-m-d',strtotime(str_replace("/","-",$date[1])));
               
                $Income = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                        ->where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->first()->total;
               
                $sales_total = SalesDrink::where('status','0')
                                         ->whereBetween('created_at',[$date[0],$date[1]])
                                         ->count();
               
                $all_items = SalesDrink::where('status','0')
                                        ->whereBetween('created_at',[$date[0],$date[1]])
                                        ->paginate($this->page_size,['*'],'sales_res');
               
                $food_obj = new FoodTypeController();
            
                $drink_obj = new DrinkController();
                                    
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allDrinkSales')->with(['all_items'=>$all_items,'user'=>$user,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj,'Income'=>$Income,'sales_total'=>$sales_total]); 
           }
           else{
               
                $all_items = SalesDrink::where('status','0')
                            ->paginate($this->page_size,['*'],'sales_drink');
               
              //  dd($all_items);
            
                $food_obj = new FoodTypeController();
            
                $drink_obj = new DrinkController();
                            
                $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
                $success['msg'] = 'Successful';
                Session::put('token',$success['token']);
                $user = new UserController();
                return view('user.allDrinkSales')->with(['all_items'=>$all_items,'user'=>$user,'food_obj'=>$food_obj,'drink_obj'=>$drink_obj]);  
           }
        }
        else{
            return redirect('login');
        }
        
    }
    
    // Edit Sales Drink
    
    public function editSalesDrink()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
            
              $sales_drink = SalesDrink::find(Request::get('id'));
              $drink_obj = new DrinkController();
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              $rooms = SalesRoom::where('action','=','0')->get();
              return view('user.editSalesDrink')->with(['drink_sales'=>$sales_drink,'drink_obj'=>$drink_obj,'rooms'=>$rooms,'obj'=>$this]); 
                  
        }   
        else{
            return redirect('login');
        }
        
    }
    
    public function profit_view()
    {
        if(Auth::check() && Auth::user()->dept == '7')
        {
              $user = Auth::user();
              $success['token'] =  $user->createToken('Laravel')->accessToken; 
              Session::put('token',$success['token']);
              return view('user.profit_view'); 
                  
        }   
        else{
            return redirect('login');
        }
        
    }
    
    public function addToCart()
    {
        if(Session::get('type') == null){
            Session::put('type',[]);
            Session::put('cart',[]);
            Session::put('qty',[]);
            
        }
        
        $type = Session::get('type');
        $cart = Session::get('cart');
        $qty = Session::get('qty');
        
        
        array_push($type,Request::get('type'));
        array_push($cart,Request::get('id'));
        array_push($qty,1);
        
        Session::put('type',$type);
        Session::put('cart',$cart);
        Session::put('qty',$qty);
        
        if(Session::get('item_count') == null)
        {
            Session::put('item_count',1);
        }
        else{
            Session::put('item_count',Session::get('item_count')+1);
        }
        
        
        
        $user = Auth::user();
        $success['token'] =  $user->createToken('Laravel')->accessToken; 
        Session::put('token',$success['token']);
        $success['msg']= 'Item Added';
        return $success['msg'];
        
    }
    
    public function removeFromCart()
    {
        $a=0;
        $type = Session::get('type');
        $cart1 = Session::get('cart');
        $qty = Session::get('qty');
        $x=0;
        
        foreach($type as $key=>$val)
        {
            $j=0;
            
            foreach($cart1 as $key1=>$cart)
            {
                if(isset($cart1[$a]))
                {
                    if($val == Request::get('type') && $cart1[$a] == Request::get('id'))
                    {
                   
                        $type[$a]=0;
                        $cart1[$a]=0;
                        $qty[$a] = 0;
                        $x++;
                        break;
                    }
                }
                
                $j++;
                
            }
            
            $a++;
            
        }
        
         
        if($x > 0){
            Session::put('type',$type);
            Session::put('cart',$cart1);
            Session::put('qty',$qty);
            Session::put('item_count',Session::get('item_count')-1);
        }
        echo 'Remove From Cart';
            
        
    }
    
    // Check If Item is in CaRT
    public function checkCart($type,$id)
    {
       
        if(Session::get('type')!=null)
        {
            $a=0;
            //$type = Session::get('type');
            $cart = Session::get('cart');
        
            foreach(Session::get('type') as $val)
            {
            
                foreach(Session::get('cart') as $cart)
                {
            
                    if($val == $type and $cart == $id)
                    {
                       return 1;
                       
                    }
                
                }
            
            }
            
            return 0;
        }
    }
    
    // Get Food item Details
    
    public function getFoodDetails($id){
        $obj = Foodtype::find($id);
        return $obj;
    }
    
    // Check Out
    public function checkOut()
    {
    
            
            $food_type = new FoodTypeController();
            
            $drink = new DrinkController();
            
            
            
            for($i=Request::get('min');$i<=Request::get('max');$i++){
                
                if(Request::get('food_'.$i) != null)
                {
                    $food_type->MakeSalesRestaurant(Request::get('food_'.$i),Request::get('price_'.$i),Request::get('qty_'.$i),Request::get('mode_of_payment'),Request::get('hotel_customer'));
                    
                }
                
                if(Request::get('drink_'.$i) != null)
                {
                    $drink->makeSalesDrink(Request::get('drink_'.$i),Request::get('price_'.$i),Request::get('qty_'.$i),Request::get('mode_of_payment'),Request::get('hotel_customer'));
                    
                }
            }
            
        
            $this->clearCart();
        
        $success['token'] =  Auth::user()->createToken('Laravel')->accessToken; 
        $success['msg'] = 'Successful';
        $success['url'] = Session::get('url');
        Session::put('token',$success['token']);
        return response()->json(['success'=>$success]);
        
      
        
    }
    
    // Remove From Cart shooping cart page
    
    public function clearCart()
    {
        Session::put('type',null);
        Session::put('cart',null);
        Session::put('qty',null);
        Session::put('item_count',null);
        
    }
    
    // Get Drink Details
    
    public function getDrinkDetails($id)
    {
        $obj = DrinkType::find($id);
        return $obj;
        
    }
    
    // Check if Room is available
    
    public function checkRoom($room_no,$room_id)
    {
        $obj = SalesRoom::where('room_id',$room_id)
                         ->where('room_no',$room_no)
                         ->where('status','0')
                         ->where('arrival_date',date('Y-m-d',strtotime($date)))
                         ->count();
        
       // return
        
        
        
    }
    
    // Get City
    
    public function getCity()
    {
        $state_id = States::where('name',Request::get('state'))->get()[0]->id;
            
        $cities = Cities::where('state_id',$state_id)->get();
        
        $value='<option value="" >Select</option>';
        
        foreach($cities as $val)
        {
            $value.= '<option>'.$val->name.'</option>';
        }
        
        if(count($cities) == 0)
        {
            $value.= '<option>'.Request::get('state').'</option>';
        }
        
        echo $value;
    }
    
      // Get Countries
    
    public function getStates()
    {
        $country_id = countries::where('name',Request::get('country_name'))->get()[0]->id;
        
        $states = States::where('country_id',$country_id)->get();
        
        
            
        //$cities = Cities::where('state_id',$state_id)->get();
        
        $value='<option>Select</option>';
        
        foreach($states as $val)
        {
            $value.= '<option>'.$val->name.'</option>';
        }
        
        if(count($states) == 0)
        {
            $value.= '<option>'.Request::get('country_name').'</option>';
        }
        
        echo $value;
    }
    
    // Add Quantity to  Cart
    
    public function addQty()
    {
       // Session::get('qty')[Request::get('key')] = Request::get('qty');
        $j = Session::get('qty');
        $j[Request::get('key')] = Request::get('qty');
        Session::put('qty',$j);
       // return $j[Request::get('key')];
           
    }
    
    // Get Customer Name
    
    public function getCustomerName($customer_id)
    {
        $obj = customer::find($customer_id);
        
        if($obj)
        {
            
            return $obj->first_name.' '.$obj->last_name;
        }
        
    }
    
    // Get Amount Owed 
    
    public function getAmountOwed($obj)
    {
        
        $total_spent_drinks = SalesDrink::select(DB::raw('sum(price * qty) as sum'))
                                        ->where('customer_id',$obj->customer_id)
                                        ->where('status','0')
                                        ->whereBetween('created_at',[$obj->arrival_date,$obj->leave_date])
                                        ->first()->sum;
                          
        $total_spent_restuarant = SalesRestuarant::select(DB::raw('sum(price * qty) as sum'))
                                                 ->where('customer_id',$obj->customer_id)
                                                 ->where('status','0')
                                                 ->whereBetween('created_at',[$obj->arrival_date,$obj->leave_date])
                                                 ->first()->sum;
                                                 
        $total_spent_pool = PoolSales::select(DB::raw('sum(cost) as sum'))
                                                 ->where('customer_id',$obj->customer_id)
                                                 ->where('status','0')
                                                 ->whereBetween('created_at',[$obj->arrival_date,$obj->leave_date])
                                                 ->first()->sum;
                                                
        return  ($total_spent_drinks + $total_spent_restuarant + $total_spent_pool + $obj->amount) - $obj->amount_paid;
        
        
    }
    
    
    // Get Customer First Name
    
    public function getCustomerFirstName($customer_id)
    {
        $obj = customer::find($customer_id);
        
        if($obj)
        {
            
            return $obj->first_name;
        }
        
    }
    
    // Get Room Details
    
    public function getRoomDetails($id)
    {
        $data = SalesRoom::where('room_id',$id)
                        ->where('action','0')
                        ->get();
                        
        if(count($data) > 0)
        {
           return $data[0]; 
        }
        
        return '';
        
        
    }
    
    // Add Condition in Batch
    
    public function AddRoomCondition_batch()
    {
        
        $room_no1 = Request::get('room_no');
        
        $condition = Request::get('room_condition_batch');
        
        $rm_no = [];
        
        $room_no = explode(',',$room_no1[0]);
    
        $obj = RoomCondition::whereIn('room_no',$room_no)
                            ->get();
                            
                            
        $value = Request::all();
                            
        if($condition == '4') //Checking if condition is maintenance you want to update
        {
            $rules = [
            
                
                
                'from' => 'required',
                
                'to'   => 'required',
                
                'remarks' => 'required|max:200'
                
                
            
         
            ];
        
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
               return response()->json(['error'=>$validator->errors()]);             
            
            }
            else{
                
                foreach($room_no as $val)
                {
                    $this->AddRoomCondition_batch2($condition,$val,Request::get('remarks'),Request::get('from'),Request::get('to'));
                }
                
                $success['msg'] = 'Successful';
                return response()->json(['success'=>$success]);
                
            }
            
        }
        else{
            
              foreach(Request::get('room_no') as $val)
              {
                            
                 $this->AddRoomCondition_batch1($condition,$val);
                 
              }
        }
        
    }
    
     // For Maintenance Condition.
    
    public function AddRoomCondition_batch2($condition,$room_no,$remarks,$from,$to)
    {
            $data = RoomCondition::where('room_no',$room_no)
                                ->get();
                                
            if(count($data) > 0)
            {
                    
                    $obj2 = RoomCondition::find($data[0]->id);
                    $obj2->status = $condition;
                    $obj2->remarks = $remarks;
                    $obj2->from_date = date('Y-m-d',strtotime($from));
                    $obj2->to_date = date('Y-m-d',strtotime($to));
                    $obj2->save();
                
                    $success['msg'] = 'Successful';
                    return response()->json(['success'=>$success]);
                    
                
            
            }
            else{
                
                     $obj2 = new RoomCondition();
                     $obj2->status = $condition;
                     $obj2->remarks = $remarks;
                     $obj2->from_date = date('Y-m-d',strtotime($from));
                     $obj2->to_date = date('Y-m-d',strtotime($to));
                     $obj2->room_no = $room_no;
                     $obj2->save();
                     
                     
                
                     $success['msg'] = 'Successful';
                     return response()->json(['success'=>$success]); 
                     
                 
                
            }
            
    }
    
    public function AddRoomCondition_batch1($condition,$room_no)
    {
        
            $data = RoomCondition::where('room_no',$room_no)
                                ->get();
                       
            if(count($data) > 0)
            {
                
                 $obj2 = RoomCondition::find($data[0]->id);
                 $obj2->status = $condition;
                 $obj2->save();
                 echo $obj2->room_no;

            }
            else{
                
                
                 $obj2 = new RoomCondition();
                 $obj2->status = $condition;
                 $obj2->room_no = $room_no;
                 $obj2->save();

            
            }
        
    }
    
    // Add Room Condition
    
    public function AddRoomCondition()
    {
        $room_no = Request::get('room_no');
        
        $condition = Request::get('condition');
        
        $obj = RoomCondition::where('room_no',$room_no)
                            ->get();
                            
        $value = Request::all();
                            
        if($condition == '4') //Checking if condition is maintenance you want to update
        {
            $rules = [
            
                
                
                'from' => 'required',
                
                'to'   => 'required',
                
                'remarks' => 'required|max:200'
                
                
            
         
            ];
        
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
               return response()->json(['error'=>$validator->errors()]);             
            
            }
            else{
                
                return $this->AddRoomCondition3($obj,$condition,$room_no,Request::get('remarks'),Request::get('from'),Request::get('to'));
            }
            
        }
        else{
                            
            $this->AddRoomCondition2($obj,$condition,$room_no);
        }
        
    }
    
    public function AddRoomCondition2($obj,$condition,$room_no)
    {
        
            if(count($obj) > 0 )
            {
                $obj2 = RoomCondition::find($obj[0]->id);
                $obj2->status = $condition;
                $obj2->save();
            }
            else{
            
                $obj2 = new RoomCondition();
                $obj2->status = $condition;
                $obj2->room_no = $room_no;
                $obj2->save();
            
            }
        
    }
    
    
    // For Maintenance Condition.
    
    public function AddRoomCondition3($obj,$condition,$room_no,$remarks,$from,$to)
    {
        
            if(count($obj) > 0 )
            {
                $obj2 = RoomCondition::find($obj[0]->id);
                $obj2->status = $condition;
                $obj2->remarks = $remarks;
                $obj2->from_date = date('Y-m-d',strtotime($from));
                $obj2->to_date = date('Y-m-d',strtotime($to));
                $obj2->save();
               
                $success['msg'] = 'Successful';
                return response()->json(['success'=>$success]); 
            
            }
            else{
            
                $obj2 = new RoomCondition();
                $obj2->status = $condition;
                $obj2->remarks = $remarks;
                $obj2->from_date = date('Y-m-d',strtotime($from));
                $obj2->to_date = date('Y-m-d',strtotime($to));
                $obj2->room_no = $room_no;
                $obj2->save();
                $success['msg'] = 'Successful';
                return response()->json(['success'=>$success]);  
                
            }
            
    }
    
    // Get Room Condition
    
    public function getRoomCondition($room_no)
    {
        $obj = RoomCondition::where('room_no',$room_no)
                            ->get();
                            
        if(count($obj) > 0 )
        {
            return $obj[0]->status;
        }
        
        return '';
        
    }
    
    // Assign Shift
    
    public function Assign_Shift()
    {
        $users = User::whereIn('dept',[2,3,4,5])
                      ->get();
                      
      
	    
        $j = 0;
                      
        foreach($users as $users_obj )
        {
            $j=0;
            while($j==0)
            {
                $shift_id = $this->pickShift();
                
                if($users_obj->shift_id !== $shift_id )
                {
                     $obs = User::find($users_obj->id);
                     $obs->shift_id = $shift_id;
                     $obs->status = 2;
                     $obs->save();
                     $j=1;
                }
            }
            
        }
        
       
    }
    
    // Generate Reports
    
    public function generateReports()
    {
         $minus_date = -5;
         
         
        
               $room_sales = SalesRoom::whereRaw("Year(created_at) = '".date('Y')."'  ")
                                    ->where('status','0')
                                    ->sum('amount');
            
               $drink_sales = SalesDrink::select(DB::raw('sum((qty*price)) as total'))
                                     ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                     ->where('status','0')
                                     ->first()->total;
            
               $res_sales = SalesRestuarant::select(DB::raw('sum((qty*price)) as total'))
                                        ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                        ->where('status','0')
                                        ->first()->total;
            
               $pool_sales = PoolSales::where('status','0')
                                   ->whereRaw("Year(created_at) = '".date('Y')."'  ")
                                   ->sum('cost');
                                              
               $room_employees =  User::where('dept','2')
                                      ->where('status','0')
                                      ->get();
            
               
               $expenses_room = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$room_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_room) > 0 )
                {
                    $expenses_room = $expenses_room->total_expenses;
                }
                else{
                    
                    $expenses_room = 0;
                }
                
               $drink_employees =  User::where('dept','4')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_drink = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$drink_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_drink) > 0 )
                {
                    $expenses_drink = $expenses_drink->total_expenses;
                }
                else{
                    
                    $expenses_drink = 0;
                }
                
               $restuarant_employees =  User::where('dept','3')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_restuarant = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$restuarant_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
                if(count($expenses_restuarant) > 0 )
                {
                    $expenses_restuarant = $expenses_restuarant->total_expenses;
                }
                else{
                    
                    $expenses_restuarant = 0;
                }
                
               $pool_employees =  User::where('dept','5')
                                      ->where('status','0')
                                      ->get();
                                                   
               $expenses_pool = DB::table('store_collections')->select(DB::raw('itemName, sum(qty * unitPrice) as total_expenses, max(id) as max_id '))
                                                   ->where('status','0')
                                                   ->whereIn('user_id',$pool_employees)
                                                   ->whereRaw("Year(created_at) = '".date('Y')."' and month(created_at) = '".date('m')."'   ")
                                                   ->groupBy('itemName')
                                                   ->first();
                                                   
               if(count($expenses_pool) > 0 )
                {
                    $expenses_pool = $expenses_pool->total_expenses;
                }
                else{
                    
                    $expenses_pool = 0;
                }
                                        
        
        PdfDoc::generate_pdf(['drink_sales'=>$drink_sales]);
    }
    
    public function createPDFReport()
    {
        
    }
    
    public function pickShift()
    {
        $shifts_id = Shift::inRandomOrder()->first()->id;
        
        return $shifts_id;
    }
    
    
    
}
