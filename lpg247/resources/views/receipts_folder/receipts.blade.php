<html>
    
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body style='padding-left:50px;padding-right:50px;padding-top:80px;font-style:bold;'>
        
       <div class='row' style='margin-bottom:50px;'>
           <div class='col-sm-12 text-center'>
              <img src='Hotel_logo/{{$hotel_details->logo}}'/>
           </div>
       </div>
        
       <div class='row'>
           <div class='col-sm-12'>
              <div style='float:left;'>
                <H1>{{$hotel_details->hotel_name}}</H1>
              </div>
              <div style='float:right;'><H3>INVOICE</H3></div>
           </div>
       </div>
       
       <div class='row'>
          <div class='col-sm-12'>
            <div style='float:left;'>
               <div>{{$hotel_details->address}},</div>
               <div>{{$hotel_details->phone_no}}</div>

            </div>
            <div style='float:right;'>
               <div>INOVICE NO. {{$invoice_no}},</div>
               <div>DATE {{date('F m, Y')}}</div>
               <div>CUSTOMER ID {{$obj_data->customer_id}}</div>
               <div>{{$customer_obj->email_address}}</div>
            </div>
          </div>
       </div>
       
       <div class='row' style='margin-top:50px;'>
           <div class='col-sm-12'>
               <div class='row'>
                   <div class='col-sm-4'>
                      <div>
                         <span>Arrival Date</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{date('d-m-Y',strtotime($obj_data->arrival_date))}}</span>
                      </div>
                      <div>
                         <span>Departure Date</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{date('d-m-Y',strtotime($obj_data->leave_date))}}</span>
                      </div>
                      <div>
                         <span>Total No. of days </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{$obj_data->no_of_days}}</span>
                      </div>
                      <div>
                         <span>Rate per Day/room </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>&#8358;{{number_format($obj_data->room_rate)}}</span>
                      </div>
                      
                      <div>
                         <span>Other</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{$obj_data->others}}</span>
                      </div>
                      
                   </div>
                   
                   <div class='col-sm-4'>
                      <div>
                         <span>No. of Rooms </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{$no_of_rooms}}</span>
                      </div>
                      
                      <div>
                         <span>Room No.s</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>{{$room_nos}}</span>
                      </div>
                      
                   </div>
                   
                   <div class='col-sm-4'>
                       <div class='row'>
                           <div class='col-sm-3'>
                               BILL TO
                           </div>
                           <div class='col-sm-9'>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' ></span>
                               </div>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' >{{$customer_obj->first_name}} {{$customer_obj->last_name}}</span>
                               </div>  
                               <div>
                                    <span style='border-bottom: 1px dotted black;' >{{$customer_obj->address}}</span>
                               </div>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' >{{$customer_obj->city}} , {{$customer_obj->state}} , {{$customer_obj->country}}</span>
                               </div>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' >{{$customer_obj->phone_number}}</span>
                               </div>
                           </div>
                     </div>
                     
                   </div>
               
           </div>
       </div>
       </div>
       
       <div class='row' style='margin-top:20px;'>
           
           <div class='col-sm-12'>
    
                <table style='width:100%;'>
                    
                    <tr style='text-transform:uppercase;background-color:#E3F4FD;'>
                       <td style='border:1px solid black;text-align:center;'>Date</td>
                       <td style='border:1px solid black;text-align:center;'>Services</td>
                       <td style='border:1px solid black;'>Charged Amount</td>
                       <td style='border:1px solid black;text-align:center;'>Qty</td>
                       <td style='border:1px solid black;text-align:center;'>Line Total</td>
                    </tr>
                        
                    @foreach($sales_drink as $dt)
                    
                        <tr>
                            <td style='border:1px solid black;'>{{date('d-m-Y H:i:s',strtotime($dt->created_at))}}</td>
                            <td style='border:1px solid black;'>Bought  {{$drink_obj->getDrinkName($dt->item)}} Drink</td>
                            <td style='border:1px solid black;'>{{number_format($dt->price)}}</td>
                            <td style='border:1px solid black;'>{{$dt->qty}}</td>
                            <td style='border:1px solid black;'>{{number_format($dt->qty * $dt->price)}}</td>
                        </tr>
                        
                    @endforeach
                    
                    @foreach($sales_res as $dt)
                    
                        <tr>
                            <td style='border:1px solid black;'>{{date('d-m-Y H:i:s',strtotime($dt->created_at))}}</td>
                            <td style='border:1px solid black;'>Bought  {{$food_obj->getFoodName($dt->item)}} Food</td>
                            <td style='border:1px solid black;'>{{number_format($dt->price)}}</td>
                            <td style='border:1px solid black;'>{{$dt->qty}}</td>
                            <td style='border:1px solid black;'>{{number_format($dt->qty * $dt->price)}}</td>
                        </tr>
                        
                    @endforeach
                    
                    @foreach($sales_pool as $dt)
                    
                        <tr>
                            <td style='border:1px solid black;'>{{date('d-m-Y H:i:s',strtotime($dt->created_at))}}</td>
                            <td style='border:1px solid black;'>Made Use of the Pool</td>
                            <td style='border:1px solid black;'>{{$dt->cost}}</td>
                            <td style='border:1px solid black;'>____</td>
                            <td style='border:1px solid black;'>{{$dt->cost}}</td>
                        </tr>
                        
                    @endforeach
                         
                        
                </table>
               
           </div>
           
       </div>
       
       <div class='row' style='margin-top:50px;margin-bottom:50px;'>
           <div class='col-sm-12'>
               <div class='float-left'>
                  <span style='border-bottom:1px solid black;'>Amount payed : &#8358;{{number_format($obj_data->amount_paid)}}</span>
                </div>
                <div class='float-right'>
                  <span style='border-bottom:1px solid black;'>Total For Payment: &#8358;{{number_format($total)}}</span>
                </div>
            </div>
       </div>
       
    </body>
</html><div><div>