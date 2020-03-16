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
                             Edit Store
                          </h1>
                       </div>
                       <br>
                       <form id='edit-storeForm'>
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control tags" id='itemName' name='itemName' value='{{$store->itemName}}' placeholder="Item name" title='Item name' required=''>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='Quantity' name='Quantity' value='{{$store->qty}}' placeholder="Quantity" title='Quantity'  required=''>
                         </div>
                      </div>
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" placeholder="Unit Price" id='UnitPrice' name='UnitPrice' value='{{$stock->getLatestUnitPrice($store->id)}}' title='Unit Price'  required=''>
                         </div>
                      </div>
                      
                       <br>
                      
                      <select id='departments' name='departments' class='form-control' required='' title='Departments'>
                            <option value=''>Select Departments</option>
                            
                    
                            <option value='2' @if($store->dept == '2') Selected @endif>Rooms</option>
                            <option value='3' @if($store->dept == '3') Selected @endif>Restaurant</option>
                            <option value='4' @if($store->dept == '4') Selected @endif>Bar</option>
                            <option value='5' @if($store->dept == '5') Selected @endif>Pool</option>
                            
                      </select>
                           
                      <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                           
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='edit-Stock' class='btn-primary padding-5px width-100percent' >
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
