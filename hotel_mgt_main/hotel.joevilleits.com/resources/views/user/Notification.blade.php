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
                <div class='row background-color-white' style='width:100%;'>
                    
                    
                    <div style='margin-left:auto;margin-right:auto;'>  
                       <div class='col-sm-12' >
                          <h1>
                             Notifications
                          </h1>
                       </div>
                    </div>
                </div>
                <br>
                <div class='row' style='padding:20px;'>
                           <br>
                        @foreach($special_request_notif as $val)
                           <div class='col-sm-12' style='margin-bottom:30px;'>
                               <div style='padding:20px;max-width:100%;min-width:50%;border: 1px solid;padding: 10px;box-shadow: 5px 10px #b2beb5;'>
                                   <?php Session::put('sale_rm_id',$obj->getRoomInstance($val->id)); ?>
                                   Remember {{$obj->getCustomerName($val->customer_id)}} Special Request  <a href='room-detail?id={{$val->room_id}}'>Click me For more details</a>
                               </div>
                           </div>
                        @endforeach
                        
                        @foreach($birthday_notif as $val)
                        
                            <div class='col-sm-12' style='margin-bottom:10px;'>
                                <br>
                                <div style='padding:20px;max-width:100%;min-width:50%;border: 1px solid;padding: 10px;box-shadow: 5px 10px #b2beb5;'>
                                    Customer <a href='view_customer_detail?id={{$val->id}}'>{{$obj->getCustomerName($val->id)}}</a> Has a Birthday Today.
                                </div>
                            </div>
                            
                        @endforeach
                        
                        
                </div>
                <br>
                <div class='row'>
                    <div class='col-sm-12'>
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
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
