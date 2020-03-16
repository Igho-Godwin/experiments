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
                             Update Loyalty Details 
                          </h1>
                       </div>
                       <br>
                       
                       <form id='update-loyaltyForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                        <br>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='loyalty_value' name='loyalty_value' placeholder="Loyalty Value e.g 10" title='Loyalty Value' required='' value='@if($data != ""){{$data->loyalty_value}}@endif'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='number_of_visits' name='number_of_visits' placeholder="Number Of Visits" title='Number Of Visits'  required='' value='@if($data != ""){{$data->visit_number}}@endif'>
                         </div>
                      </div>
                      
                      @if($data != '')
                        
                            <input type='text' id='data' name='data' value='{{$data->id}}' class='hide' />
                            
                      @endif
                      
                      <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                           
                      <br>  
                       <div class="form-row">
                         <div class="col-sm-12">
                            <button type='button' id='update-loyaltyBtn' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                            </button>
                         </div>
                       </div>
                       
                       <br> 
                    
                       
                       
                       
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
