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
                <div class='row background-color-white padding-30px' style='width:80%;'>
                    
                    
                    <div style='margin-left:auto;margin-right:auto;'>  
                       <div>
                          <h1>
                             Add Room Type
                          </h1>
                       </div>
                       <br>
                       <form id='create-roomType'>
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control" id='roomName' name='roomName' placeholder="Room name" title='Room name' required=''>
                         </div>
                        
                      </div>
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" placeholder="Unit Price" id='UnitPrice' name='UnitPrice' title='Unit Price'  required=''>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" placeholder="Discounted Price" id='DiscountedPrice' name='DiscountedPrice' title='Discounted Price'  required=''>
                         </div>
                      </div>
                           
                      <br>
                           
                      <div class="form-row">
                         <div class="col-sm-12">
                             <span>Add Room Numbers:</span>
                             <br>
                             <br>
                             <input type="text" id='tags-input' name='room_number' class='form-control' value="" data-role="tagsinput" />
                         </div>
                      </div>
                      
                      <br>
                           
                      <div class="form-row">
                         <div class="col-sm-12">
                             <span>Add Amenities:</span>
                             <br>
                             <br>
                             <div class='row'>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='tv' value='1' /> &nbsp; Plasma TV with Cable 
                                </div>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='bed' value='2' /> &nbsp; King Size Bed 
                                </div>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='breakfast' value='3' /> &nbsp; Breakfast Included 
                                </div>
                             </div>
                          </div>
                          <div class='col-sm-12'>
                             <br/>
                              <div class='row'>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='tub' value='4' /> &nbsp; Shower and Tub  
                                </div>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='ac' value='5' /> &nbsp; Air conditioning
                                </div>
                                <div class='col-sm-4'>
                                    <input type='checkbox' name='smoking' value='6' /> &nbsp; Smoking Allowed 
                                </div>
                             </div>
                          </div>
                          
                      </div>
                           
                               
                      <br>
                           
                       <div class="form-row">
                         <div class="col-sm-6">
                             <img id='image' onclick='croppers(1)' src='images/default-pic.png' alt='Food' style='max-width:100%' />
                         </div>
                       </div>
                           
                       <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <input type="file"  id='image-room' name='image-room'  title='Picture' />
                         </div>
                       </div>
                           
                       <br> 
                           
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                            <div class='row'>
                               <button type='button' id='add-roomType' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                               </button>
                             </div>
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
