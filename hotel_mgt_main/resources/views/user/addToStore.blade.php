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
                <div class='row background-color-white padding-30px ' style='width:100%;'>
                    
                    
                    <div style='margin-left:auto;margin-right:auto;'>  
                       <div>
                          <h1>
                             Add to Store
                          </h1>
                       </div>
                       <br>
                       <form id='create-storeForm'>
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control tags" id='itemName' name='itemName' placeholder="Item name" title='Item name' required=''>
                         </div>
                         <div class="col-sm-6">
                             <input type="number" class="form-control" id='Quantity' name='Quantity' placeholder="Quantity" title='Quantity'  required=''>
                         </div>
                      </div>
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" placeholder="Unit Price" id='UnitPrice' name='UnitPrice' title='Unit Price'  required=''>
                         </div>
                      </div>
                      
                      <br>
                      
                      <select id='departments' name='departments' class='form-control' required='' title='Departments'>
                            <option value=''>Select Departments</option>
                    
                            <option value='2'>Rooms</option>
                            <option value='3'>Restaurant</option>
                            <option value='4'>Bar</option>
                            <option value='5'>Pool</option>
                            
                      </select>
                           
                      <input type='text' name='auth' id='auth' value='' class='hide'/>
                           
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='add-ToStore' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                         </div>
                      </div>
                   </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
                            <div class="modal fade" id="Authenticate-User-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                   <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Authenticate User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                        </button>
                                   </div>
                                   <div class="modal-body">
                                       <div id='error' style='color:red;'>
                                       </div>
                                       <form id='auth-Form'>
                                          <div class="form-row">
                                             <div class="col-sm-12">
                                                <select class='form-control' name='email'>
                                                    <option value=''>Select Admin</option>
                                                    @foreach($admins as $val)
                                                        <option value='{{$val->email}}'>{{$val->first_name}} {{$val->last_name}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                           </div>
                                           <br>
                                           <div class="form-row">
                                                <div class="col-sm-12">
                                                   <input type='password' name='password' id='password' class='form-control' placeholder='Password' value='' />
                                                </div>
                                           </div>
                                     
                                         <input type='text' id='id' value='' name='id' class='hide' />
                                       </form>
                                   </div>
                                   <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button id='validate-admin-login' type="button" class="btn btn-primary">Login &nbsp; <i class="fa fa-spinner fa-spin hide fa-spin1 " aria-hidden="true"></i></button>
                                   </div>
                                 </div>
                              </div>
                            </div>
        
        
        <!--**********************************
            Content body end
        ***********************************-->
        
             

     
    </div>
    
    @include('footer.footer')
    
    
    


    
