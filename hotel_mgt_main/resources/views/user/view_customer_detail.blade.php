@include('header.header')

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
                    
                    
                    <div>  
                       <div>
                          <h1>
                             Customer Details
                          </h1>
                       </div>
                       <br>
                       
                       <form id='edit-customerForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                        <br>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='first_name' name='first_name' placeholder="First Name" title='First Name' required='' value='{{$cus_detail->first_name}}'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='last_name' name='last_name' placeholder="Last Name" title='Last Name'  required='' value='{{$cus_detail->last_name}}'>
                         </div>
                      </div>
                           <br>
                       <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='birthday' name='birthday' placeholder="Birthday" title='Birthday' required='' value='{{date('m-d',strtotime($cus_detail->birthday))}}'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='phone_number' name='phone_number' placeholder="Phone Number" title='Phone Number'  required='' value='{{$cus_detail->phone_number}}'>
                         </div>
                      </div>
                      <br>
                       <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='email_address' name='email_address' placeholder="Email Address" title='Email Address' required='' value='{{$cus_detail->email_address}}'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='address' name='address' placeholder="Address" title='Address'  required='' value='{{$cus_detail->address}}'>
                         </div>
                      </div>
                      <br>
                       <div class="form-row">
                         <div class="col-sm-6">
                               <select class='form-control country js-example-basic-single'   name='country' title='Country' style='width:100%;'    id='country'>
                                    <option value=''>Select Country</option>
                                        @foreach($countries as $val)
                                            <option  @if($cus_detail->country == $val->name) Selected  @endif >{{$val->name}}</option>
                                        @endforeach
                               </select>
                         </div>
                         <div class="col-sm-6">
                             <select class='form-control selecti js-example-basic-single'  id='states' name='state' title='State'  data-live-search="true" style='width:100%;'  >
                                  <option>{{$cus_detail->state}}</option>
                                  <option value=''>Select State</option>
                             </select>
                         </div>
                      </div>
                      <br>
                       <div class="form-row">
                         <div class="col-sm-6">
                            <select class='form-control city js-example-basic-single'  name='city' title='City'  data-live-search="true" id='city' style='width:100%;'>
                                <option>{{$cus_detail->city}}</option>
                                <option value=''>Select City</option>
                            </select>
                         </div>
                         <div class="col-sm-6">
                              <select name='customer_type' id='customer_type' class='form-control js-example-basic-single' style='width:100%;'  >
                                        
								    <option value=''>Select Customer Type</option>
								    <option value='1' @if($cus_detail!=='') @if($cus_detail->customer_type == '1') Selected @endif @endif>Individual</option>
								    <option value='2' @if($cus_detail!=='')@if($cus_detail->customer_type == '2') Selected @endif @endif>Company</option>
								    <option value='3' @if($cus_detail!=='')@if($cus_detail->customer_type == '3') Selected @endif @endif>Group</option>
								    <option value='4' @if($cus_detail!=='')@if($cus_detail->customer_type == '4') Selected @endif @endif>Travel Agent</option>
								    
							  </select>
                         </div>
                      </div>
                      <br>  
                       <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id='discount' name='discount' placeholder="Discount" title='Discount' required='' value='{{$cus_detail->discount}}'>
                         </div>
                       </div>
                           
                     
                       <br> 
                    
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                           
                       <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='edit-customer' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                         </div>
                      </div>
                   </form>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
