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
                <div class='row background-color-white padding-30px'  style='width:100%;'>
                    <div style='margin-left:auto;margin-right:auto;'>  
                       <div>
                          <h1>
                             Add Hotel Details
                          </h1>
                       </div>
                       <br>
                       <form id='addHotelDetailsForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id='hotel_name' name='hotel_name' value='@if($data != ''){{$data->hotel_name}}@endif' placeholder="Hotel name" title='Hotel name' required=''>
                         </div>
                      </div>
                      
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id='address' name='address' value='@if($data != ''){{$data->address}}@endif' placeholder="Hotel name" title='Address' required=''>
                         </div>
                      </div>
                      
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id='phone_no' name='phone_no' value='@if($data != ''){{$data->phone_no}}@endif' placeholder="Phone No" title='Phone No' required=''>
                         </div>
                      </div>
                      
                          
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                           
                       <div class="form-row">
                         <div class="col-sm-6">
                             <img id='image' name='image' src='@if($data != '')Hotel_logo/{{$data->logo}}@endif'  alt='Food' style='max-width:100%' />
                         </div>
                       </div>
                           
                       <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <input type="file"  id='image-logo' name='image1'  title='Picture' />
                         </div>
                       </div>
                       <br> 
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='addHotelDetailsBtn' class='btn-primary padding-5px width-100percent' >
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
  
    
          <script>  


// Get the Cropper.js instance after initialized

          
        </script>
