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
                             Add Pool Sales
                          </h1>
                       </div>
                       <br>
                       <form id='create-PoolSales'>
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='customer_name' name='customer_name' placeholder="Customer Name" title='Customer Name' required=''>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='cost' name='cost' placeholder="Cost" title='Cost'  required=''>
                         </div>
                         <div class="col-sm-12" style='margin-top:20px;'>
                              <select name='hotel_customer' class='form-control'>
                                 <option value=''>Select An Hotel Customer</option>
                                 @foreach($rooms as $val)
                                    <option value='{{$val->customer_id}}'>{{$obj->getCustomerName($val->customer_id)}}</option>
                                 @endforeach
                             </select>
                         </div>
                      </div>
                       
                       
                           
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='add-PoolSales' class='btn-primary padding-5px width-100percent' >
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
