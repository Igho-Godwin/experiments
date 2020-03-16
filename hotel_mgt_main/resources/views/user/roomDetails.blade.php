

@include('header.header')

<link rel='stylesheet' href='css/pearl-hotel.css' />

<link rel='stylesheet' href='css/form-dropdown.css' />

<link rel='stylesheet' href='css/default-color.css' />

<style>

.room-detail .booking-form .form .field.rooms {
    z-index: 0;
    position: relative;
}

input[type=radio]:not(:checked) {
    left: 0;
    opacity: inherit;
    position: relative;
}

</style>



<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('header.nav-header')
        
        @include('sidebar.sidebar')

        

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
                <div class='row background-color-white padding-30px padding-left-30percent' style='width:100%;'>
                 
                          <h1>
                            Room Details
                          </h1>
                    </div>
                  
   <!--Start Content-->
	<div class="content">
	
		<!--Start Rooms-->
			<div class="room-detail">
				<div class="container">
					<div class="row">
						
						<div class="col-md-8">
						
							<div id="hotel-view" class="owl-carousel owl-theme">
								<div class="item"><img src="room_type_pic/{{$room_details->picture}}" alt=""></div>
							</div>
							
							
							<div class="what-include">
					           @if($room_details->tv != 0)
                                
                                  <div class="include-sec text-center">
									<img src="imgs/icon-led.png" class='img-responsive' alt="" style='display:inline-block'>
									<span class='break-word'>TV LCD</span>
								  </div>
                                
                               @endif
                                
                               @if($room_details->breakfast != 0)
                                
                                  <div class="include-sec text-center">
									   <img src="imgs/icon-cup.png" class='img-responsive' alt="" style='display:inline-block'>
									   <span class='break-word'>Breakfast</span>
								  </div>
                                
                               @endif
                                
                               @if($room_details->ac != 0)
                                
                                  <div class="include-sec text-center">
									<img src="imgs/icon-ac.png" class='img-responsive' alt="" style='display:inline-block'>
									<span class='break-word'>Cool AC</span>
								</div>
                                
                               @endif
                                
				               @if($room_details->tub != 0)
                                
                                  <div class="include-sec text-center">
									<img src="imgs/icon-ac.png" class='img-responsive' alt="" style='display:inline-block'>
									<span class='break-word'>Tub</span>
								</div>
                                
                               @endif
                                
                               @if($room_details->bed != 0)
                                
                                  <div class="include-sec text-center">
									<img src="imgs/icon-ac.png" class='img-responsive' alt="" style='display:inline-block'>
									<span class='break-word'>Bed</span>
								</div>
                                
                               @endif
                                
                               @if($room_details->smoking != 0)
                                
                                  <div class="include-sec text-center">
									<img src="imgs/icon-ac.png" class='img-responsive' alt="" style='display:inline-block'>
									<span class='break-word'>Smoking</span>
								</div>
                                
                               @endif
								
							
								
							</div>
                            
                            <div class="what-include">
					
								
								
							</div>
							
                            <!--
							
							<div class="room-descrip">
								<h5>Room Description</h5>
								<p>Semper ac dolor vitae accumsan. interdum hendrerit lacinia. Etiam eget urna augue. Aenean posuere pharetra tortor eu sodales. Aenean vitae facilisis ligula.
								<br/><br/>
								Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean vitae facilisis ligula. Quisque dictum neque in lectus cursus congue. Phasellus sodales condimentum rutrum.</p>
							</div>
							
							<div class="room-descrip">
								<h5>Room Overview</h5>
								<p>Semper ac dolor vitae accumsan. interdum hendrerit lacinia. Etiam eget urna augue. Aenean posuere pharetra tortor eu sodales. Aenean vitae facilisis ligula.</p>
							</div>
							
							
							<div class="room-overview">
								<div class="detail"><span><strong>Bed:</strong> Queen</span></div>
								<div class="detail light-gray"><span><strong>Occupancy:</strong> 2 Persons</span></div>
								<div class="detail"><span><strong>Ensuite Bathroom:</strong> Yes</span></div>
								<div class="detail light-gray"><span><strong>Free Airport Pickup:</strong> Yes</span></div>
								<div class="detail"><span><strong>Breakfast Included:</strong> Yes (Continental)</span></div>
								<div class="detail light-gray"><span><strong>Free Internet:</strong> Yes</span></div>
								<div class="detail"><span><strong>Gym Access:</strong> 24/7</span></div>
							</div>
							
                            -->
						
						</div>
						
						
						<div class="col-md-4">
						
							<div class="booking-form">
							    
							    <form class='reserve-form'>
                                
								
								<div class="rating">
									<i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i>
								</div>
								
								<div class="price">
									<span id='price' class="hide">{{$room_details->unitPrice}}</span>
                                    <span id='dis-price' class="hide">{{$room_details->discounted_price}}</span>
									<span>Room From Per Night</span>
									<span class="amount amt" style='display:inline-block;max-width:90%;word-wrap:break-word;font-size:40px;'>&#8358;{{number_format($room_details->unitPrice)}}</span>
                                    <span class="amount amount2 hide" style='font-size:40px;'>&#8358;{{number_format($room_details->discounted_price)}}</span>
                                    <span style='font-size:10px;'>View Discounted Price &nbsp; <input type='checkbox' id='discount-toggle' /></span>
                                    
									
								</div>
								
								
								<div class="form">
								    <div id='error' class='warning text-color-white' >
                                        
                                    </div>
                                    <br>
                                    
                                    <div style='margin-bottom:10px;'>
                                        <select name='customer_type' id='customer_type' class='form-control js-example-basic-single' style='width:100%;'  >
                                        
								             <option value=''>Select Customer Type</option>
								             <option value='1' @if($customer_details!=='') @if($customer_details->customer_type == '1') Selected @endif @endif>Individual</option>
								             <option value='2' @if($customer_details!=='')@if($customer_details->customer_type == '2') Selected @endif @endif>Company</option>
								             <option value='3' @if($customer_details!=='')@if($customer_details->customer_type == '3') Selected @endif @endif>Group</option>
								             <option value='4' @if($customer_details!=='')@if($customer_details->customer_type == '4') Selected @endif @endif>Travel Agent</option>
								        </select>
								    </div>
                             
								    <input type="text" id="firstname" class='form-control'  placeholder="First Name" onClick="" name="first_name" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->first_name}}@endif" />		
								    
								    <input type="text" id="lastname" class='form-control'  placeholder="Last Name" onClick="" name="last_name" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->last_name}}@endif" />	
								    
								    <input type="number" id="others" class='form-control'  placeholder="Others" onClick="" name="others" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->others}}@endif" />	
								    
								    <div  style='margin-bottom: 20px;'>
								   
								            <fieldset>
                                                <legend style='color:white;font-size:12px;'>Birthday</legend>
								                    <div style='margin-bottom: 10px;'>
								                        <select name='birth_month' class='form-control js-example-basic-single' style='width:80%;'  >
								                             <option value=''>Select Birth Month</option>
								                             <option value='01' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '01' ) Selected @endif @endif>January</option>
								                             <option value='02' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '02' ) Selected @endif @endif>Feburary</option>
								                             <option value='03' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '03' ) Selected @endif @endif>March</option>
								                             <option value='04' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '04' ) Selected @endif @endif>April</option>
								                             <option value='05' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '05' ) Selected @endif @endif>May</option>
								                             <option value='06' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '06' ) Selected @endif @endif>June</option>
								                             <option value='07' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '07' ) Selected @endif @endif>July</option>
								                             <option value='08' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '08' ) Selected @endif @endif>August</option>
								                             <option value='09' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '09' ) Selected @endif @endif>September</option>
								                             <option value='10' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '10' ) Selected @endif @endif>October</option>
								                             <option value='11' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '11' ) Selected @endif @endif>November</option>
								                             <option value='12' @if($customer_details!=='')@if(explode('-',$customer_details->birthday)[1] == '12' ) Selected @endif @endif>December</option>
								                        </select>
								                    </div>
								                    
								                    <div>
								                   
								                       <select name='birth_day' class='form-control js-example-basic-single' style='width:80%;'   >
								                            <option value=''>Select Birth Day</option>
								                            <?php for($i=1;$i<=31;$i++){ $h=''; ?>
								                            <?php 
								                            
								                                  if($customer_details!=='')
								                                  {
								                                     if($customer_details->birthday[2] == $i)
								                                     {
								                                         $h='Selected';
								                                     }
								                                  }
								                            ?>
								                            <?php echo"<option ".$h.">".$i."</option>"; ?>
								                            <?php } ?>
								                       </select>
								                       
								                    </div>
								                    
								             </fieldset>
								    </div>
								    
								    <input type="text" id="phone_number" class='form-control'  placeholder="Phone Number" onClick="" name="phone_number" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->phone_number}}@endif" />
								    
								    <input type="text" id="email_address" class='form-control'  placeholder="Email Address" onClick="" name="email_address" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->email_address}}@endif" />
								    
								    <input type="text" id="address" class='form-control'  placeholder="Address" onClick="" name="address" style='margin-bottom: 10px;' value="@if($customer_details!==''){{$customer_details->address}}@endif" />
								    
								    <div style='margin-bottom: 10px;'>
                                            <select class='form-control country js-example-basic-single'   name='country' title='Country' style='width:100%;'    id='country'>
                                                 <option value=''>Select Country</option>
                                                @foreach($countries as $val)
                                                    <option @if($customer_details!=='') @if($customer_details->country == $val->name) Selected  @endif @endif>{{$val->name}}</option>
                                                @endforeach
                                            </select>
								    </div>
								    
								    <div style='margin-bottom: 10px;'>
								        <select class='form-control selecti js-example-basic-single'  id='states' name='State' title='State'  data-live-search="true" style='width:100%;'  >
                                             <option>{{$customer_details->state}}</option>
                                             <option value=''>Select State</option>
                                             
                                        </select>
                                    </div>
                                    
                                    <div style='margin-bottom: 10px;'>
                                        <select class='form-control city js-example-basic-single'  name='city' title='City'  data-live-search="true" id='city' style='width:100%;'>
                                             <option>{{$customer_details->city}}</option>
                                             <option value=''>Select City</option>
                                        </select>
                                    </div>
                                  
									<div class="field">
										<input type="text" id="datepicker" class='datepicker check_in'  placeholder="Check in Date" onClick="" name="checkinDate" value="@if($d=='')Choose A Date @else {{date('d-m-Y',strtotime($d->arrival_date))}} @endif" onblur="if(this.value == '') { this.value='Choose A Date'}" onfocus="if (this.value == 'Choose A Date') {this.value=''}"/>		
									</div>
                                    
                                    <input type='text' class='hide' name='room_id' id='room_id' value='{{$room_details->id}}' />
                                    
                                    <input type='text' class='hide' name='amount' id='amount' value='' />
									
									<div class="field">
										<input type="text" id="datepicker2" class='check_out datepicker'  placeholder="Check Out Date" onChange='getAvailableRooms()' name="checkoutDate" value="@if($d=='')Choose A Date @else {{date('d-m-Y',strtotime($d->leave_date))}} @endif" onblur="if(this.value == '') { this.value='Choose A Date'}" onfocus="if (this.value == 'Choose A Date') {this.value=''}"/>		
									</div>
                                    
                                    
									<div class="field rooms">
										<select class="form-control" id="available_room" name="available_room[]" title='Available Rooms' >
											<option value="">Available Rooms</option>
										</select>
									</div>
									
									<div class="field rooms">
										<select class="form-control" id="unavailable_rooms" name="unavailable_rooms" title='Un Available Rooms'>
                                            <option value="">Unavailable Rooms</option>
										</select>
									</div>
									
									<div style='margin-bottom:10px;'>
									    <textarea class='form-control' name='special_request' placeholder='Special Request'>{{$d->special_request}}</textarea>
									</div>
                                    
                                    <div class="field rooms">
                                        <select class='form-control' name='mode_of_payment' id='mode_of_payment' >
                                            <option value=''>Mode of Payment</option>
                                            <option value='1' @if($d!=='')@if($d->mode_of_payment == 1)Selected @endif @endif>POS</option>
                                            <option value='2' @if($d!=='') @if($d->mode_of_payment == 2)Selected @endif @endif>CASH</option>
                                            <option value='3' @if($d!=='') @if($d->mode_of_payment == 3)Selected @endif @endif>TRANSFER</option>
                                        </select>
                                    </div>
                                    
                                    <div >
                                        <div class='pull-left' style='color:white;'> <input type="radio" name="action" class='@if($d=='') ac1 @endif' value="0"> Check In </div>
                                        <div class='pull-right' style='color:white;'> <input type="radio" name="action" class='@if($d=='') ac1 @endif' value="1"> Reserve</div>
                                    </div>
                                    <BR>
                                    <div class='reserved hide' style='margin-top:20px;'>
                                        <select name='medium_of_contact' class='form-control js-example-basic-single' style='width:100%;'>
                                            <option value=''>Select Medium Of Contact For Reservation </option>
                                            <option>Email</option>
                                            <option>Website</option>
                                            <option>Telephone</option>
                                            <option>Travel Agent</option> 
                                        </select>
                                    </div>
                                  
									
                                    @if($d != '')
                                         <a  class="availability" onclick='editSoldRoom()'>Edit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i></a>
									  
                                    @else
                                         <a  class="availability avail hide" style='margin-top:20px;' onclick='sellRoom()'><span id='save-data'>Save</span> &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i></a>
                                    @endif
									 <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
										
								</div>
                                
                             
									
								<span id='rm-no' class='hide'>@if($d != ''){{$d->room_no}}@endif</span>
										
								<div class="clear"></div>
								</form>
							</div>
						
						</div>
						

					</div>
				</div>
			</div>
		<!--End Rooms-->
		
	</div>	
   <!--End Content-->
			<!-- .row end -->
                    
                    
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
 
    @include('footer.footer')
    
 

   @if($d != '')
                                
                                  <script>
                                    
                                          getAvailableRooms();
                                    
                                
                                      
                                     
                                  </script>
                                
                                @endif
