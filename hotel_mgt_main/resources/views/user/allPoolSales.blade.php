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
                <div class='row background-color-white width-100percent padding-5px'>
                   <div class='padding-30px padding-left-30percent'>
                      <h1>
                        All Pool Sales
                      </h1>
                   </div>
                    <br>
                    <div class="col-sm-12">
                        <br>
                          <div style='width:50%;margin-left:auto;margin-right:auto;'>
                            
                         
                            <form id='search-form' action='allPoolSales' method='get' >
                                    <div id='error' style='color:red;'>
                           
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control input-daterange-datepicker" id='date1' name='date1' value='{{Request::get("date1")}}' placeholder="Date" title='Date' required=''>
                             
                                            <br />
                                        </div>
                                        <div class='col-sm-6'>
                                            
                                            <button type='submit' id='' class='btn padding-5px text-center' style='height:50px;background-color:#337ab7;color:white;' onclick='GetProfit()' >
                                                Search &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                                            </button>
                            
                                        </div>
                                    </div>
                   
                       
                            </form>
                            
                   
                            <div>
                              @if(isset($Income))
                                Income : &#8358;{{number_format($Income)}} &nbsp; &nbsp; number of Sales : {{$sales_total}} 
                              @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Cost</th>
                                            <th>Added By</th>
                                            <th>Registration Date</th>
                                            <th class='ed'>Edit</th>
                                            <th class='ed'>delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_items as $data)
                                           <tr>
                                              <td>{{$data->customer_name}}</td>
                                              <td>&#8358;{{number_format($data->cost)}}</td>
                                              <td>{{$user->getName($data->added_by)}}</td>
                                              <td>{{date('d-m-Y H:i:s',strtotime($data->updated_at))}}</td>
                                              <td class='ed'>
                                                <a href='editPoolSales?id={{$data->id}}'>Edit</a>   
                                              </td>
                                              <td class='ed'>
                                                  <a href='#' onClick='deletePoolSales({{$data->id}})'>Delete</a> 
                                              </td>
                                           </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Cost</th>
                                            <th>Added By</th>
                                            <th>Registration Date</th>
                                            <th class='ed'>Edit</th>
                                            <th class='ed'>delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                    
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                    
                                <div class='pull-right'>
                                    @if($all_items !=null && count($all_items) > 0)
                                            {{$all_items->links()}}
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
    
  