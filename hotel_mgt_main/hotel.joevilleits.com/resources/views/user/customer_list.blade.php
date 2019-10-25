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
                        Customer List
                      </h1>
                   </div>
                    <br>
          
                    <div class="col-sm-12">
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                            <th>Customer name</th>
                                            <th>Phone No</th>
                                            <th>View All Details</th>
                                          
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($customer_list as $data)
                                        
                                           
                                            <tr>
                                                <td>{{$data->first_name}} {{$data->last_name}}</td>
                                                <td>{{$data->phone_number}}</td>
                                                <td>
                                                    <a href='view_customer_detail?id={{$data->id}}' >View more Details</a>
                                                </td>
                                              
                                            </tr>

                                                
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Customer name</th>
                                            <th>Phone No</th>
                                            <th>View All Details</th>
                                           
                                        </tr>
                                    </tfoot>
                                </table>
                                    
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                <div class='pull-right'>
                                    @if($customer_list !=null && count($customer_list) > 0)
                                            {{$customer_list->links()}}
                                    @endif
                                </div>  
                                

                                </div>
                            </div>
                        </div>
                        <div></div>
                    </div>
      

                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
      
     
    </div>
    
    @include('footer.footer')
    
    
    
  