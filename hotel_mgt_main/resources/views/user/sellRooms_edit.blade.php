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
                             Sell Rooms
                          </h1>
                       </div>
                       <br>
                       <form id='sell-roomForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='customer_name' name='customer_name' placeholder="Customer name" title='Customer name' required=''>
                         </div>
                         <div class="col-sm-6">
                             <select name='room_type' id='room_type' required='' title='Room Type' class='form-control' onchange='getRoomUnitPrice()'>
                                 <option value=''>Select</option>
                                 @foreach($room_type as $obj)
                                    <option value='{{$obj->id}}'>{{$obj->name}}</option>
                                 @endforeach
                             </select>
                         </div>
                      </div>
                      <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                            <input type="text" class="form-control" id='unit_price' name='unit_price' placeholder="Unit Price" title='Unit Price'  required='' readonly>
                         </div>
                          <div class="col-sm-6" style='margin-top:10px;'>
                            <input type="text" class="form-control" id='quantity' name='quantity' placeholder="Quantity"  onkeyup='total_payable()' onkeydown='total_payable()' title='Quantity'  required=''>
                         </div>
                      </div>
                      <div class="form-row">
                         <div class="col-sm-12" style='margin-top:10px;'>
                            <input type="text" class="form-control money" id='amount_payable' name='amount_payable' placeholder="Amount Payable" title='Amount Payable'  required='' readonly>
                         </div>
                      </div>
                          
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='sell-roomBtn' class='btn-primary padding-5px width-100percent' >
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
    
    
