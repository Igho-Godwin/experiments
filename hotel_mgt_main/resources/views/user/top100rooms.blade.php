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
                        Top 100 Rooms
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
                                            <th>Position</th>
                                            <th>Room No</th>
                                            <th>Room Type</th>
                                            <th>Number Of Times Occupied</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; ?>
                                        @foreach($all_items as $data)
                                        
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->room_no}}</td>
                                                <td>{{$room_type_object->getRoomType($data->room_no)}}</td>
                                                <td>{{$data->total}}</td>
                                                
                                               
                                            </tr>
                                                
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Position</th>
                                            <th>Room No</th>
                                            <th>Room Type</th>
                                            <th>Number Of Times Occupied</th>
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
    
    
    
  