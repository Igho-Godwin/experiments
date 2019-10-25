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
                   <div class='padding-30px padding-left-38percent'>
                      <h1>
                        All Users
                      </h1>
                   </div>
                    <br>
                    <div class="col-sm-12">
                        <div class='row'>
                            @foreach($all_users as $data)
                                <div class='col-sm-4 margin-bottom-20'>
                                    <div class='text-center'>
                                        <img src='@if($data->picture == '')images/default-pic.png @else user_pic/{{$data->picture}} @endif' class='border-radius-50 ' width='200' height='200' />
                                    </div>
                                    <div class='text-center'>
                                        {{$data->first_name}} &nbsp; {{$data->last_name}}
                                    </div>
                                    <div class='text-center'>
                                        {{$user->getDeptName($data->dept)}} Department
                                    </div>
                                    <div class='text-center'>
                                        <a href='editUser?id={{$data->id}}'> Edit </a> | <a href='#' onClick='deleteUser({{$data->id}})'>Delete</a> | <a id='sus-{{$data->id}}' href='#' onClick='suspendUser({{$data->id}})'>
                                            @if($data->status == '2')
                                                Un-Suspend
                                            @else 
                                                 Suspend
                                            @endif
                                            </a>
                                    </div>
                                 
                                </div>
                            @endforeach
                            
                            <div class='col-sm-12'>
                               <div class='pull-right'>
                                   @if($all_users !=null && count($all_users) > 0)
                                       {{$all_users->links()}}
                                   @endif
                               </div>
                            </div>
                            
                            <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                 <!--
                                <div class="table-responsive">
                                   
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Dept</th>
                                            <th>Added By</th>
                                            <th>Registration Date</th>
                                            <th>Edit</th>
                                            <th>delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_users as $data)
                                           <tr>
                                              <td>{{$data->first_name}}</td>
                                              <td>{{$data->last_name}}</td>
                                              <td>{{$data->email}}</td>
                                              <td>{{$data->phone_no}}</td>
                                              <td>{{$data->dept}}</td>
                                              <td>{{$user->getName($data->added_by)}}</td>
                                              <td>{{date('d-m-Y H:i:s',strtotime($data->created_at))}}</td>
                                              <td>
                                                <a href='editUser?id={{$data->id}}'>Edit</a>   
                                              </td>
                                              <td>
                                                  <a href='#' onClick='deleteUser({{$data->id}})'>Delete</a> 
                                              </td>
                                           </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone No</th>
                                            <th>Dept</th>
                                            <th>Registration Date</th>
                                            <th>Edit</th>
                                            <th>delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                   
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                    
                                <div class='pull-right'>
                                    @if($all_users !=null && count($all_users) > 0)
                                            {{$all_users->links()}}
                                    @endif
                                </div>
                                 -->
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
    
  