<html>
    
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body style='padding-left:50px;padding-right:50px;padding-top:80px;font-style:bold;'>
        
       <div class='row' style='margin-bottom:50px;'>
           <div class='col-sm-12 text-center'>
              <img src='Hotel_logo/<?php echo e($hotel_details->logo); ?>'/>
           </div>
       </div>
        
       <div class='row'>
           <div class='col-sm-12'>
              <div style='float:left;'>
                <H1><?php echo e($hotel_details->hotel_name); ?></H1>
              </div>
              <div style='float:right;'><H3>INVOICE</H3></div>
           </div>
       </div>
       
       <div class='row'>
          <div class='col-sm-12'>
            <div style='float:left;'>
               <div><?php echo e($hotel_details->address); ?>,</div>
               <div><?php echo e($hotel_details->phone_no); ?></div>

            </div>
            <div style='float:right;'>
               <div>INOVICE NO. <?php echo e($invoice_no); ?>,</div>
               <div>DATE <?php echo e(date('F m, Y')); ?></div>
               <div>CUSTOMER ID <?php echo e($obj_data->customer_id); ?></div>
               <div><?php echo e($customer_obj->email_address); ?></div>
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
                         <span style='border-bottom: 1px dotted black;'><?php echo e(date('d-m-Y',strtotime($obj_data->arrival_date))); ?></span>
                      </div>
                      <div>
                         <span>Departure Date</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'><?php echo e(date('d-m-Y',strtotime($obj_data->leave_date))); ?></span>
                      </div>
                      <div>
                         <span>Total No. of days </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'><?php echo e($obj_data->no_of_days); ?></span>
                      </div>
                      <div>
                         <span>Rate per Day/room </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'>&#8358;<?php echo e(number_format($obj_data->room_rate)); ?></span>
                      </div>
                      
                      <div>
                         <span>Other</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'><?php echo e($obj_data->others); ?></span>
                      </div>
                      
                   </div>
                   
                   <div class='col-sm-4'>
                      <div>
                         <span>No. of Rooms </span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'><?php echo e($no_of_rooms); ?></span>
                      </div>
                      
                      <div>
                         <span>Room No.s</span>
                             &nbsp;
                         <span style='border-bottom: 1px dotted black;'><?php echo e($room_nos); ?></span>
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
                                    <span style='border-bottom: 1px dotted black;' ><?php echo e($customer_obj->first_name); ?> <?php echo e($customer_obj->last_name); ?></span>
                               </div>  
                               <div>
                                    <span style='border-bottom: 1px dotted black;' ><?php echo e($customer_obj->address); ?></span>
                               </div>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' ><?php echo e($customer_obj->city); ?> , <?php echo e($customer_obj->state); ?> , <?php echo e($customer_obj->country); ?></span>
                               </div>
                               <div>
                                    <span style='border-bottom: 1px dotted black;' ><?php echo e($customer_obj->phone_number); ?></span>
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
                        
                    <?php $__currentLoopData = $sales_drink; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <tr>
                            <td style='border:1px solid black;'><?php echo e(date('d-m-Y H:i:s',strtotime($dt->created_at))); ?></td>
                            <td style='border:1px solid black;'>Bought  <?php echo e($drink_obj->getDrinkName($dt->item)); ?> Drink</td>
                            <td style='border:1px solid black;'><?php echo e(number_format($dt->price)); ?></td>
                            <td style='border:1px solid black;'><?php echo e($dt->qty); ?></td>
                            <td style='border:1px solid black;'><?php echo e(number_format($dt->qty * $dt->price)); ?></td>
                        </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php $__currentLoopData = $sales_res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <tr>
                            <td style='border:1px solid black;'><?php echo e(date('d-m-Y H:i:s',strtotime($dt->created_at))); ?></td>
                            <td style='border:1px solid black;'>Bought  <?php echo e($food_obj->getFoodName($dt->item)); ?> Food</td>
                            <td style='border:1px solid black;'><?php echo e(number_format($dt->price)); ?></td>
                            <td style='border:1px solid black;'><?php echo e($dt->qty); ?></td>
                            <td style='border:1px solid black;'><?php echo e(number_format($dt->qty * $dt->price)); ?></td>
                        </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php $__currentLoopData = $sales_pool; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <tr>
                            <td style='border:1px solid black;'><?php echo e(date('d-m-Y H:i:s',strtotime($dt->created_at))); ?></td>
                            <td style='border:1px solid black;'>Made Use of the Pool</td>
                            <td style='border:1px solid black;'><?php echo e($dt->cost); ?></td>
                            <td style='border:1px solid black;'>____</td>
                            <td style='border:1px solid black;'><?php echo e($dt->cost); ?></td>
                        </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         
                        
                </table>
               
           </div>
           
       </div>
       
       <div class='row' style='margin-top:50px;margin-bottom:50px;'>
           <div class='col-sm-12'>
               <div class='float-left'>
                  <span style='border-bottom:1px solid black;'>Amount payed : &#8358;<?php echo e(number_format($obj_data->amount_paid)); ?></span>
                </div>
                <div class='float-right'>
                  <span style='border-bottom:1px solid black;'>Total For Payment: &#8358;<?php echo e(number_format($total)); ?></span>
                </div>
            </div>
       </div>
       
    </body>
</html><div><div>