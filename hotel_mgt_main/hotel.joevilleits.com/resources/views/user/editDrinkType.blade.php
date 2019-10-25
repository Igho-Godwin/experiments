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
                             Edit Drink Type
                          </h1>
                       </div>
                       <br>
                       <form id='edit-drinkTypeForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='drink_type' name='drink_type' placeholder="Drink Types" title='Drink Types' required='' value='{{$drink_type->drink_type}}'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='unit_price' name='unit_price' placeholder="Unit Price" title='Unit Price'  required='' value='{{$drink_type->unit_price}}'>
                         </div>
                      </div>
                           <br>
                           
                       <div class="form-row">
                         <div class="col-sm-6">
                             <img id='image' src='drink_type/{{$drink_type->picture}}' alt='Food' style='max-width:100%' />
                         </div>
                       </div>
                           
                       <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <input type="file"  id='image-drink' name='image1'  title='Picture' />
                         </div>
                       </div>
                       <br> 
                    
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                           
                       <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='edit-drinkTypeBtn' class='btn-primary padding-5px width-100percent' >
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
