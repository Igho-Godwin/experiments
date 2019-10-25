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
                             Edit Sales Drink
                          </h1>
                       </div>
                       <br>
                       <form id='edit-drinkSalesForm' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='drink_type' name='drink_type' placeholder="Drink Type" title='Drink Type' required='' value='{{$drink_obj->getDrinkName($drink_sales->item)}}'>
                         </div>
                         <div class="col-sm-6">
                             <input type="text" class="form-control" id='unit_price' name='unit_price' placeholder="Unit Price" title='Unit Price'  required=''  value='{{$drink_sales->price}}'>
                         </div>
                      </div>
                      <div class="form-row">
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <input type="number" class='form-control'  id='qty' name='qty'  title='Quantity' placeholder='Quantity' value='{{$drink_sales->qty}}' />
                         </div>
                         <div class="col-sm-6" style='margin-top:10px;'>
                             <select class='form-control' name='mode_of_payment' id='mode_of_payment' title='Mode Of payment'>
                                    <option value=''>Select</option>
                                    <option value='1' @if($drink_sales->mode_of_payment == '1') Selected @endif>POS</option>
                                    <option value='2' @if($drink_sales->mode_of_payment == '2') Selected @endif>CASH</option>
                                    <option value='3' @if($drink_sales->mode_of_payment == '3') Selected @endif>TRANSFER</option>
                             </select>
                         </div>
                      </div>
                      <br>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <select name='hotel_customer' class='form-control'>
                                <option value=''>Select An Hotel Customer</option>
                                @foreach($rooms as $val)
                                    <option value='{{$val->customer_id}}' @if($val->customer_id == $drink_sales->customer_id) Selected @endif>{{$obj->getCustomerName($val->customer_id)}}</option>
                                @endforeach
                             </select>
                         </div>
                      </div>
                          
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                           
                       <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                           
                        <input type="text" class="form-control hide" id='drink' name='drink' placeholder="Drink name" title='Drink name' required='' value='{{$drink_sales->item}}'>
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='edit-drinkSales' class='btn-primary padding-5px width-100percent' onclick='EditDrinkSales()' >
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
