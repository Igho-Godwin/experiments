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
                   <div class='padding-30px ' >
                      <h1>
                        All Shifts
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
                                            <th>Shift Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Registration Date</th>
                                            <th class='ed'>Edit</th>
                                            <th class='ed'>delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_shift as $data)
                                           <tr>
                                              <td>{{$data->shift_name}}</td>
                                              <td>{{date('H:i',strtotime($data->from_time))}}</td>
                                              <td>{{date('H:i',strtotime($data->to_time))}}</td>
                                              <td>{{date('d-m-Y H:i:s',strtotime($data->updated_at))}}</td>
                                              <td class='ed'>
                                                <a href='editShiftTime?id={{$data->id}}'>Edit</a>   
                                              </td>
                                              <td class='ed'>
                                                  <a href='#' onClick='deleteShift({{$data->id}})'>Delete</a> 
                                              </td>
                                           </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                           <th>Shift Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Registration Date</th>
                                            <th class='ed'>Edit</th>
                                            <th class='ed'>delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                    
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                    
                                <div class='pull-right'>
                                    @if($all_shift !=null && count($all_shift) > 0)
                                            {{$all_shift->links()}}
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
    
  