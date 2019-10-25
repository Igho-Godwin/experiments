@include('header.header')

<style>

.room-detail .booking-form .form .field.rooms {
    z-index: 0;
    position: relative;
}

input[type=radio]:not(:checked) {
    left: 0;
    opacity: inherit;
    position: relative;
}

</style>
 

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
                <div class='row background-color-white width-100percent padding-5px'>
                   <div class='padding-30px padding-left-30percent'>
                      <h1>
                        Customer Activities
                      </h1>
                   </div>
                    <br>
                    
                   
                    <div style='width:50%;margin-bottom:50px;margin-left:25%;'>
                        
                        <form action='customer_activities' enctype="multipart/form-data">
                        
                             <input type="text" class="form-control input-daterange-datepicker" id='date1' name='date1' placeholder="Date" title='Date' required=''>
                             
                             <br />
                             
                             <button type='submit' id='' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                        </form>
                            
                    </div>
                      
                      <br>
          
                    <div class="col-sm-12">
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Activity</th>
                                            <th>Amount Spent</th>
                                            <th>Date</th>
                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($sales_room as $data)
                                        
                                            <?php $i++; ?>
                                            <tr>
                                               
                                                <td>{{$obj->getCustomerName($data->customer_id)}}</td>
                                                <td>Room Booking</td>
                                                <td>&#8358;{{number_format($data->amount)}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->created_at))}}</td>
                                                
                                               
                                            </tr>
                                                
                                        @endforeach
                                        
                                         @foreach($sales_drink as $data)
                                        
                                           
                                            <tr>
                                               
                                                <td>{{$obj->getCustomerName($data->customer_id)}}</td>
                                                <td>Bought Drinks</td>
                                                <td>&#8358;{{number_format($data->price * $data->qty)}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->created_at))}}</td>
                                                
                                               
                                            </tr>
                                                
                                        @endforeach
                                        
                                         @foreach($sales_res as $data)
                                        
                                           
                                            <tr>
                                               
                                                <td>{{$obj->getCustomerName($data->customer_id)}}</td>
                                                <td>Bought Food</td>
                                                <td>&#8358;{{number_format($data->price * $data->qty)}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->created_at))}}</td>
                                                
                                               
                                            </tr>
                                                
                                       
                                        @endforeach
                                        
                                        @foreach($sales_pool as $data)
                                        
                                           
                                            <tr>
                                               
                                                <td>{{$obj->getCustomerName($data->customer_id)}}</td>
                                                <td>Pool payment</td>
                                                <td>&#8358;{{number_format($data->cost)}}</td>
                                                <td>{{date('d-m-Y',strtotime($data->created_at))}}</td>
                                                
                                               
                                            </tr>
                                                
                                       
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Activity</th>
                                            <th>Amount Spent</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                    
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                    
                                <div class='pull-right'>
                                      @if($paging !=null && count($paging) > 0)
                                            {{$paging->links()}}
                                      @endif
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
      

                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
      
     
    </div>
    
    @include('footer.footer')
    
    
    
  