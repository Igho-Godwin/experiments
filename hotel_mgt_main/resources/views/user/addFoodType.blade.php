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
                             Add Food Type
                          </h1>
                       </div>
                       <br>
                       <form id='create-foodType' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='food_name' name='food_name' placeholder="Food name" title='Food name' required=''>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='unit_price' name='unit_price' placeholder="Unit Price" title='Unit Price'  required=''>
                         </div>
                      </div>
                      <div class="form-row">
                         <div class="col-sm-12" style='margin-top:10px;'>
                             <select name='food_category' required='' class='form-control'  title='Food Category' >
                                 <option value=''>Select Food Category</option>
                                 <option value='1'>Main Course (Hot dishes) </option>
                                 <option value='2'>Starter</option>
                                 <option value='3'>Special Food</option>
                                 <option value='4'>Soups and Salad (Side Dishes)</option>
                                 <option value='5'>Deserts</option>
                                 <option value='6'>Chef's Pick of the day</option>
                             </select>
                         </div>
                      </div>
                 
                          
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                       <br>
                           
                       <div class="form-row">
                         <div class="col-sm-6">
                             <img id='image' src='images/default-pic.png' alt='Food' style='max-width:100%' />
                         </div>
                       </div>
                           
                       <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <input type="file"  id='image-food' name='image1'  title='Picture' />
                         </div>
                       </div>
                       <br> 
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='add-foodType' class='btn-primary padding-5px width-100percent' >
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
