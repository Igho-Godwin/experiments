<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\SubAccounts;
use App\Models\Distance;
use App\Models\Review;
use Illuminate\Validation\Rule; 
use Request;
use Validator;
use Hash;
use DB;
use Session;
use Auth;
use Image;

use App\Models\Cities;
use App\Models\States;
use App\Models\Countries;
use App\Models\MajorMarketer;

class MarketersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index()
    {
        $states = States::where('country_id',160)
                        ->pluck('id');
                        
        $cities = Cities::whereIn('state_id',$states)
                        ->orderby('name','asc')
                        ->get();
     
        return view('allMarketers')->with(['cities'=>$cities]);
    }
    
    
    public function allMarketersOrdersPage()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_category == 1)
            {
                try{
            
                    $marketer_obj = new MarketersController();
                    return view('user.marketer.allOrders')->with(['marketer_obj'=>$marketer_obj]);
            
                }
                catch(\Exception $e)
                {
                    return response()->json(['error'=>$e->getMessage()],502);
                }
            
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
    
    }
    
    public function relatedMarketers()
    {
        
         $obj = SubAccounts::find(Request::get('id'));
         
         $ip = $_SERVER['REMOTE_ADDR'];
        
         $related_marketers = SubAccounts::where('sub_accounts.active',1)
                                         ->where('sub_accounts.id','!=',Request::get('id'))
                                        ->orwhere('sub_accounts.user_id',$obj->user_id)
                                        ->orwhere('sub_accounts.city',$obj->city)
                                         ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                                         ->leftJoin('review', 'review.marketer_id', '=', 'sub_accounts.id')
                                         ->join('distance', 'distance.user_id', '=', 'sub_accounts.id')
                                         ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery')
                                         ->selectRaw('CEILING(avg(review.star_rating)) as star_rating')
                                         ->orderby('distance.distance','asc')
                                         ->inRandomOrder()
                                         ->groupBy('sub_accounts.id')
                                         ->get()
                                         ->take(10);
                              
        return response()->json(['related_marketers'=>$related_marketers],200);
        
    }
    
    public function marketerProfile()
    {
        $obj = SubAccounts::where('sub_accounts.id',Request::get('marketer_id'))
                          ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                          ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery','users.about_company')
                          ->first();
                          
                          
        $reviews = Review::where('review.marketer_id',Request::get('marketer_id'))
                          ->leftJoin('users', 'review.email', '=', 'users.email')
                          ->select('review.*', 'users.picture')
                          ->paginate(1,['*'],'reviews')
                          ->appends('marketer_id',Request::get('marketer_id'));
                          
        $review_no = Review::where('review.marketer_id',Request::get('marketer_id'))            
                          ->leftJoin('users', 'review.email', '=', 'users.email')
                          ->select('review.*', 'users.picture')
                          ->count();
                          
        $rating = ceil(Review::where('review.marketer_id',Request::get('marketer_id'))            
                          ->leftJoin('users', 'review.email', '=', 'users.email')
                          ->select('review.*', 'users.picture')
                          ->sum('star_rating')/$review_no);
                          
        $MarketerClass_obj = new MarketersController();
        
        
        if($obj)
        {
           return view('MarketerProfile')->with(['marketer_obj'=>$obj,'reviews'=>$reviews,'MarketerClass_obj'=>$MarketerClass_obj,'rating'=>$rating,'review_no'=>$review_no]); 
        }
        else{
            return redirect('allMarketers');
        }
        
        
    }
    
    public function createMajorMarketerPage()
    {
        if(Auth::guard('admin')->check())
        {
            $states = States::where('country_id',160)
                        ->pluck('id');
                        
            $cities = Cities::whereIn('state_id',$states)
                        ->orderby('name','asc')
                        ->get();
                        
            return view('admin.createMajorMarketer')->with(['cities'=>$cities]);
        }
        else{
            return redirect('/');
        }
    }
    
    public function createMajorMarketer()
    {
        try{
            
            $value = Request::all();
        
            $rules = [
 
                'marketer_name' => ['required','max:100',Rule::unique('major_marketer')->where(function($query) {
                  $query->where('active', '=', 1);})],
                'address' => 'required|max:255',
                'marketer_logo' => 'required',
                'city_of_location' => 'required|max:50',
                
            
            ];
         
          
            $validator = Validator::make($value,$rules);
        
            if($validator->fails()){
            
                return response()->json(['error'=>$validator->errors()],400);   
            }
            else{
                
                $obj = new MajorMarketer();
                
                if(Request::get('marketer_logo') != null)
                {
                    $img = Request::get('marketer_logo');
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $filename= time().'.png';
                    $myfile = fopen(public_path().'/MajorMarketerLogo/'.$filename, "w");
                    file_put_contents(public_path().'/MajorMarketerLogo/'.$filename, $data);
                        
                    $obj->marketer_logo = 'MajorMarketerLogo/'.$filename;
                        
                }
                
                
                $obj->marketer_name = Request::get('marketer_name');
                $obj->address = Request::get('address');
                $obj->city_of_location = Request::get('city_of_location');
                $obj->save();
                
                return response()->json(['success'=>True],200); 
            
            }
            
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
    
    public function fitImage($image,$width,$height)
    {
        if($image != null or $image != '' )
        {
         
            $img = Image::make($image);
                                
            $img->fit($width,$height);
                                 
            $img->stream('png', 70);
                                 
            $type = 'png';
  
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
        
            return $base64;
        
        }
    }
    
    public function filterMarketerByCity($ip)
    {
        if(Request::get('last_id') == null and Request::get('last_id') == '' )
        {
            
                $users =    SubAccounts::where('active',1)
                                       ->where('distance.ip_address',$ip)
                                       ->where('sub_accounts.city',Request::get('city'))
                                       ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                                       ->leftJoin('review', 'review.marketer_id', '=', 'sub_accounts.id')
                                       ->join('distance', 'distance.user_id', '=', 'sub_accounts.id')
                                       ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery')
                                       ->selectRaw('CEILING(avg(review.star_rating)) as star_rating')
                                       ->orderby('distance.distance','asc')
                                       ->groupBy('sub_accounts.id')
                                       ->get();
                                       
                return $users;
                
            }
            else{
                
                $last_id  = explode(',',Request::get('last_id'));
            
                $users = SubAccounts::where('active',1)
                                       ->where('distance.ip_address',$ip)
                                       ->where('sub_accounts.city',Request::get('city'))
                                       ->whereNotIn('sub_accounts.id',$last_id)
                                       ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                                       ->leftJoin('review', 'review.marketer_id', '=', 'sub_accounts.id')
                                       ->join('distance', 'distance.user_id', '=', 'sub_accounts.id')
                                       ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery')
                                        ->selectRaw('CEILING(avg(review.star_rating)) as star_rating')
                                       ->orderby('distance.distance','asc')
                                       ->groupBy('sub_accounts.id')
                                       ->get();
                                       
                return $users;
            
            }
    }
    
    
    
   
    public function getMarketers()
    {
        header('Access-Control-Allow-Origin: *'); 
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if(Request::get('city') != null)
        {
            
            $users = $this->filterMarketerByCity($ip);
            return response()->json(['users'=>$users],200);
            
            
        }
        else{
            
           
            try{
        
                $users = SubAccounts::where('active',1)
                            ->get();
            }
            catch(\Exception $e)
            {
                return response()->json(['error'=>$e->getMessage()],502);
            }
                     
            if(Request::get('last_id') != null or Request::get('last_id') != '' )
            {
                $last_id = explode(',',Request::get('last_id'));
            
                $users = SubAccounts::where('active',1)
                                ->whereNotIn('id',$last_id)
                                ->get();
          
            }
                     
            $id = [];
        
            $distance2  = [];
        
                     
            foreach($users as $obj)
            {
        
                $distance = $this->haversineGreatCircleDistance(
                Request::get('address'), $obj->address);
             
                $distance = explode(' ',$distance)[0];
       
                $distance = str_replace( ',', '', $distance );
           
            
                $distance2[$obj->id] = $distance;
    
            }
        
        
            asort($distance2);
        
            $i=0;$new=[];
        
            foreach($distance2 as $key=>$val)
            {
                $i++;
                $new[$key] = $val;
            
                if($i == 20)
                {
                    break;
                }
            
            }
        
            foreach($new as $key => $d)
            {
            
            
                $val = Distance::where('ip_address',$ip)->where('user_id',$key)->first();
            
                if(isset($val))
                {
                
                    if($val->distance !== $d )
                    {
                    
                        $obj = Distance::find($val->id);
                         $obj->distance = $d;
                        $obj->save();
                    
                    }
               
                }
                else{
                
                     $obj = new Distance();
                     
                     $obj->distance = $d;
                     
                     $obj->user_id = $key;
                     
                     $obj->ip_address = $ip;
                     
                     $obj->save();
                
                }
            
            }
        
        

        
            if(Request::get('last_id') != null and Request::get('last_id') != '' )
            {
            
                $users =    SubAccounts::where('active',1)
                                    ->whereIn('sub_accounts.id',array_keys($new))
                                    ->where('distance.ip_address',$ip)
                                    ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                                    ->leftJoin('review', 'review.marketer_id', '=', 'sub_accounts.id')
                                    ->join('distance', 'distance.user_id', '=', 'sub_accounts.id')
                                    ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery')
                                    ->selectRaw('CEILING(avg(review.star_rating)) as star_rating')
                                    ->orderby('distance.distance','asc')
                                    ->groupBy('sub_accounts.id')
                                    ->get();
            }
            else{
            
                $users = SubAccounts::where('sub_accounts.active',1)
                                    ->whereIn('sub_accounts.id',array_keys($new))
                                    
                                    ->where('distance.ip_address',$ip)
                                    ->join('users', 'users.id', '=', 'sub_accounts.user_id')
                                    ->leftJoin('review', 'review.marketer_id', '=', 'sub_accounts.id')
                                    ->join('distance', 'distance.user_id', '=', 'sub_accounts.id')
                                    ->select('sub_accounts.*', 'users.picture','users.fullName','users.cost_of_delivery')
                                    ->selectRaw('CEILING(avg(review.star_rating)) as star_rating')
                                    ->orderBy('distance.distance','asc')
                                    ->groupBy('sub_accounts.id')
                                    ->get();
            
            }
       
            return response()->json(['users'=>$users],200);
            
        }
        
    }
    
    function getDistance()
    {
       $result =  $this->haversineGreatCircleDistance(Request::get('address'),Request::get('address2'));
       
       $result = explode(' ',$result)[0];
       
       $result = ((double) str_replace( ',', '', $result ));
       
       return response()->json(['distance'=>$result],200);
       
    }
    
    function haversineGreatCircleDistance($address,$address2)
    {
       $json = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?key=AIzaSyCPJNYpRGMzD_dQp4jOHU_OwMoZ09vXzcU&origins='.urlencode($address).'&destinations='.urlencode($address2).'&mode=driving&sensor=false');
       
       $details = json_decode($json, TRUE);
       
       if(isset($details['rows'][0]['elements'][0]['distance']['text']))
       {
            return $details['rows'][0]['elements'][0]['distance']['text'];
       }
    }
    
    /*
    
    // Get longitude and latitude from address
    
    public function getLong($address)
    {
        $address = $address;
        $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAuu9GetiJLX_rn_EMDEvjdg3Z6UwqhQQE&address=".urlencode($address);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson);

        if ($response->status == 'OK') {
           $latitude = $response->results[0]->geometry->location->lat;
           $longitude = $response->results[0]->geometry->location->lng;

          return [$latitude,$longitude];
          
        } 
        else {
             echo $response->status;
             var_dump($response);
          } 
    }
    
    */
    
    public function getUserData()
    {
        $obj = User::find(Request::get('user_id'));
        
        return response()->json(['users'=>$obj],200);
        
    }
    
    
  

    

    
}
