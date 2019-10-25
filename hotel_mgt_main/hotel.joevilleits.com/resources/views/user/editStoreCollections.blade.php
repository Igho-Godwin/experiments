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
                             Edit Store Collection
                          </h1>
                       </div>
                       <br>
                       <form id='edit-storeCollectForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <select name='Item_name' class='form-control' id='Item_name' required='' title='Item name'>
                                 <option value=''>Select</option>
                                 @foreach($all_items as $obj1)
                                    <option value='{{$obj1->id}}' @if($store_collect->item_name == $obj1->id) Selected @endif>{{$obj1->itemName}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-sm-6">
                             <input type="number" class="form-control" id='quantity' name='quantity' placeholder="Quantity" title='Quantity'  required='' value='{{$store_collect->qty}}'>
                         </div>
                      </div>
                      <div class="form-row">
                         <div class="col-sm-12" style='margin-top:10px;'>
                             <select name='users' id='users' required='' title='Users' class='form-control'>
                                 <option value=''>Select</option>
                                 @foreach($users as $obj)
                                    <option value='{{$obj->id}}' @if($store_collect->user_id == $obj->id) Selected @endif>{{$obj->first_name}} {{$obj->last_name}}</option>
                                 @endforeach
                             </select>
                         </div>
                      </div>
                          
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                           
                       <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='edit-storeCollectBtn' class='btn-primary padding-5px width-100percent' >
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
