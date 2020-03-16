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
                <div class='row background-color-white ' style='width:50%;margin-left:auto;margin-right:auto'>
                    
                    
                    <div class='col-sm-12'>  
                       <div>
                          <h1 style='display:block;'>
                             Profit View
                          </h1>
                       </div>
                       <br>
                       
                    </div>
                    <div class='col-sm-12' >
                   
                        <form id='create-drinkType' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control input-daterange-datepicker" id='date1' name='date1' placeholder="Date" title='Date' required=''>
                             
                             <br />
                             
                             <button type='button' id='edit-drinkSales' class='btn-primary padding-5px width-100percent' onclick='GetProfit()' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                            
                         </div>
                      </div>
                   
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                   </form>
                   
                    </div>
                    
                      <div class='col-sm-12' style='padding-top:50px;'>
                       <table class='table table-striped' width='100' style='background-color:black;'>
                           <tr>
                               <td><b>Department</b></td>
                               <td><b> Total</b></td>
                           </tr>
                           <tr>
                                <td>Total Restaurant Sales</td>
                                <td>&#8358;<span id='Restaurant-Sales'></span></td>
                           </tr>
                           <tr>
                                <td>Total Drink Sales</td>
                                <td>&#8358;<span id='drink-Sales'></span></td>
                           </tr>
                           <tr>
                                <td>Pool Sales</td>
                                <td>&#8358;<span id='pool-Sales'></span></td>
                           </tr>
                           <tr>
                                <td>Room Sales</td>
                                <td>&#8358;<span id='room-Sales'></span></td>
                           </tr>
                           <tr>
                                <td>Stock</td>
                                <td>&#8358;<span id='stock'></span></td>
                           </tr>
                           <tr>
                                <td>Overall Total</td>
                                <td>&#8358;<span id='overall-total'></span></td>
                           </tr>
                           <tr>
                                <td>Profit/Loss</td>
                                <td>&#8358;<span id='profit-total'></span></td>
                           </tr>
                        
                       </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
