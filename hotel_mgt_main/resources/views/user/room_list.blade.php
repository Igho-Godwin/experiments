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
                        All Room Types
                      </h1>
                   </div>
                    <br>
                   
                  <div class='col-sm-6' style='margin-top:100px;margin-bottom:60px;'  >
                            <form id='batch_update_form' >
                                
                                <fieldset>
                                    <legend>Batch Update</legend>
                                    <div class='col-sm-6'>
                                        <select name='room_no[]' id='batch_room' class='form-control'   multiple>
                                            
                                             @foreach($all_items as $data)
                                        
                                                 @foreach(explode(',',$data->room_numbers) as $val)
                                            
                                                     <option value='{{$val}}' >{{$val}}</option>
                                            
                                                 @endforeach
                                                
                                             @endforeach
                                        
                                        </select>
                                    </div>
                                
                                    <div class='col-sm-6'>
                           
                                        <select name='room_condition_batch' id='batch_condition' class='room-condition-batch form-control'   >
                                            <option value='0'  style='background-color:green;color:white;'>Clean</option>
                                            <option value='1'  style='background-color:red;color:white;' >Dirty</option>
                                            <option  value='2'  style='background-color:#A52A2A;color:white;' >Occupied</option>
                                            <option value='3'  style='background-color:yellow;color:black;' >Reserved</option>
                                            <option value='4'  style='background-color:blue;color:white;' >Maintenance</option>
                                        </select>
                                    </div>
                                </fieldset>
                               
                            </form>
                        </div>
                        
                                            <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary hide" id='batch_btn' data-toggle="modal" data-target="#myModal_batch">
  Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModal_batch">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Maintenance Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <div class='row' style='padding:5px;padding-right:10px;'>
                <form id='maintenance_form_batch' autocomplete='off' >
                        
                        <div class='col-sm-12' id='error_batch' style='color:red;'>
                            
                        </div>
        
                        <div class='col-sm-12' align='center' style='margin-bottom:20px;'><b>Duration:</b></div>
                        
                        <div class='col-sm-6'>
                            <input type='text' name='from' class='datepicker form-control' placeholder='From' style='display:inline!important'  />
                        </div>
                        <div class='col-sm-6'>
                            <input type='text' name='to' class='datepicker form-control' placeholder='To' style='display:inline!important'  />
                            <input type='text' name='room_condition_batch' value='4' class='hide' />
                            <input type='text' id='rmn_no' name='room_no[]' value='' class='hide' />
                        </div>
                        
                        <div class='col-sm-12'>
                            <textarea class='form-control' name='remarks' style='margin-top:20px;' placeholder='Remarks' ></textarea>
                            <div class='pull-left' style='margin-top:20px;'>
                                <button type='button' class='btn btn-primary' onclick='updateMaintenance_batch()'>Save <i id='spin-batch' class="fa fa-spinner fa-spin hide" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    
                </form>
           </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger clse" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
                    
                    
                        <br>
                    <div class="col-sm-12">
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                            <th>Room No</th>
                                            <th>Room Category</th>
                                            <th>Unit Price</th>
                                            <th>Occupied By</th>
                                            <th>Check In Date</th>
                                            <th>Check Out Date</th>
                                            <th>Added By</th>
                                            <th>Room Status</th>
                                            <th>Entry Date</th>
                                            <th class='ed'>Edit</th>
                                            <th class='ed'>delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_items as $data)
                                        
                                            @foreach(explode(',',$data->room_numbers) as $val)
                                            
                                                <?php $room_details = $obj->getRoomDetails($data->id); ?>
                                            
                                                <tr>
                                                    <td>{{$val}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{number_format($data->unitPrice)}}</td>
                                                    <td>
                                                        @if($room_details != '')
                                                            {{$obj->getCustomerFirstName($room_details->customer_id)}}
                                                        @endif    
                                                        </td>
                                                    <td>
                                                        @if($room_details != '')
                                                            {{date('d-m-Y',strtotime($room_details->arrival_date))}}
                                                        @endif        
                                                    </td>
                                                    <td>
                                                        @if($room_details != '')
                                                            {{date('d-m-Y',strtotime($room_details->leave_date))}}
                                                        @endif    
                                                    </td>
                                                    <td>{{$user->getName($data->added_by)}}</td>
                                                    <td>
                                                        <style>
                                                             .occupied{
                                                                /*margin: 40px;*/
                                                              /*  background: #A52A2A; */
                                                            }
                                                            
                                           </style>
                                                        
                                                        <?php $room_condition = $obj->getRoomCondition($val); ?>
                                                        
                                                        <select name='room_condition' id='b-{{$val}}' class='form-control room-condition' data-id='{{$val}}' 
                                                           
                                                           @if($room_condition == '0' or $room_condition == ''  )
                                                             
                                                                    style='background-color:green;color:white;'
                                                            
                                                           @elseif($room_condition == '1' or $room_condition == '')
                                                                
                                                                   style='background-color:red;color:white;'
                                                                   
                                                           @elseif($room_condition == '2' or $room_condition == '')
                                                           
                                                                   style='background-color:#A52A2A;color:white;'
                                                                   
                                                           @elseif($room_condition == '3' or $room_condition == '')
                                                           
                                                                   style='background-color:yellow;color:black;'
                                                                   
                                                           @elseif($room_condition == '4' or $room_condition == '')
                                                           
                                                                   style='background-color:blue;color:white;' 
                                                                
                                                           @endif
                                                        
                                                        >
                                                            <option value='0' @if($room_condition == '0' or $room_condition == ''  ) Selected @endif style='background-color:green;color:white;'>Clean</option>
                                                            <option value='1' @if($room_condition == '1') Selected @endif style='background-color:red;color:white;' >Dirty</option>
                                                            <option class='occupied' value='2' @if($room_condition == '2') Selected @endif style='background-color:#A52A2A;color:white;' >Occupied</option>
                                                            <option value='3' @if($room_condition == '3') Selected @endif style='background-color:yellow;color:black;' >Reserved</option>
                                                            <option value='4' @if($room_condition == '4') Selected @endif style='background-color:blue;color:white;' >Maintenance</option>
                                                        </select>
                                                        
                                                    </td>
                                                    <td>{{date('d-m-Y H:i:s',strtotime($data->updated_at))}}</td>
                                                    <td class='ed'>
                                                        <a href='editRoom_ty?id={{$data->id}}'>Edit</a>   
                                                    </td>
                                                    <td class='ed'>
                                                        <a href='#' onClick='deleteStock({{$data->id}})'>Delete</a> 
                                                    </td>
                                                </tr>
                                                
                                                              
                    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary hide" id='btn-{{$val}}' data-toggle="modal" data-target="#myModal{{$val}}">
  Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModal{{$val}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Maintenance Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <div class='row' style='padding:5px;padding-right:10px;'>
                <form id='maintenance_form{{$val}}' autocomplete='off' >
                        
                        <div class='col-sm-12' id='error{{$val}}' style='color:red;'>
                            
                        </div>
        
                        <div class='col-sm-12' align='center' style='margin-bottom:20px;'><b>Duration:</b></div>
                        
                        <div class='col-sm-6'>
                            <input type='text' name='from' class='datepicker form-control' placeholder='From' style='display:inline!important'  />
                        </div>
                        <div class='col-sm-6'>
                            <input type='text' name='to' class='datepicker form-control' placeholder='To' style='display:inline!important'  />
                            <input type='text' name='condition' value='4' class='hide' />
                            <input type='text' name='room_no' value='{{$val}}' class='hide' />
                        </div>
                        
                        <div class='col-sm-12'>
                            <textarea class='form-control' name='remarks' style='margin-top:20px;' placeholder='Remarks' ></textarea>
                            <div class='pull-left' style='margin-top:20px;'>
                                <button type='button' class='btn btn-primary' onclick='updateMaintenance({{$val}})'>Save <i id='spin-{{$val}}' class="fa fa-spinner fa-spin hide" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    
                </form>
           </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger clse" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
                                                
                                            @endforeach
                                            
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                             <th>Room No</th>
                                            <th>Room Category</th>
                                            <th>Unit Price</th>
                                            <th>Occupied By</th>
                                            <th>Check In Date</th>
                                            <th>Check Out Date</th>
                                            <th>Added By</th>
                                            <th>Room Status</th>
                                            <th>Entry Date</th>
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
    
    
    
  