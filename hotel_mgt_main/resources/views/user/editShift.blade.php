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
                             Edit Shift
                          </h1>
                       </div>
                       <br>
                       <form id='editShift-Form'>
                          <div id='error' style='color:red;'>
                           
                          </div>
                          <br>
                          <div class="form-row">
                             <div class='col-sm-12'>
                                <input type='text' name='shift_name' value='{{$data->shift_name}}' placeholder='Shift Name' class='form-control' title='Shift Name' />
                             </div>
                          </div>
                          <br>
                          <div class="form-row">
                         
                             <div class='col-sm-6' style='margin-bottom:20px;'>
                                <input type='text' class='form-control' name='from_time' title='From Time' value='{{date("H:i",strtotime($data->from_time))}}' placeholder='From Time e.g 06:45' />
                             </div>
                             
                             <div class='col-sm-6'>
                                <input type='text' class='form-control' name='to_time' title='To Time' value='{{date("H:i",strtotime($data->to_time))}}' placeholder='To Time e.g 17:45' />
                             </div>
                    
                          </div>
                          <br>
                          <div class='form-row'>
                              <select id='departments' name='departments' class='form-control' required='' title='Departments'>
                                 <option value=''>Select Departments</option>
                                 <option value='2' @if($data->dept == '2') Selected @endif>Rooms</option>
                                 <option value='3' @if($data->dept == '3') Selected @endif>Restaurant</option>
                                 <option value='4' @if($data->dept == '4') Selected @endif>Bar</option>
                                 <option value='5' @if($data->dept == '5') Selected @endif>Pool</option>
                              </select>
                          </div>
                       
                          <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                          
                          <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                       
                          <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                            <div class='row'>
                               <button type='button' id='edit-shift' class='btn-primary padding-5px width-100percent' >
                                 Edit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
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
