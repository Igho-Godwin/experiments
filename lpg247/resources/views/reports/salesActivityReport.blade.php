<html>
    <head></head>
    <body style='padding-left:300px;padding-right:300px;padding-top:80px;'>
        <div style='background-color:#00027C;color:white;padding:10px;text-align:center;font-size:24px;'>Sales Activity Report</div>
        <div style='text-align:center;font-size:13px;'><strong>For {{date('F Y')}}</strong></div>
        <div style='margin-top:20px;'>
            <div style='float:left;width:50%;font-size:13px;'>
                <div>Salesperson: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>Joseph</div></div>
                <br>
                <div>Department: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>Room</div></div>
            </div>
            <div style='float:right;width:50%;font-size:13px;'>
                <div style='float:right;'>
                    <div>Shift Name: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>Morning Shift</div></div>
                    <br>
                    <div>Date: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>{{date('d-m-Y H:i:s')}}</div></div>
                </div>
            </div>
            <div>
                <div style='padding-top:80px;'>
                    <table style='width:100%;'>
                        <tr style='background-color:#E3E3E3;'>
                            <td style='border:1px solid black;'><strong>Item Name</strong></td>
                            <td style='border:1px solid black;'><strong>Price</strong></td>
                            <td style='border:1px solid black;'><strong>Expenditure</strong></td>
                        </tr>
                        
                        @if($drinks_sales != '')
                        
                            @foreach($drinks_sales as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->item}}</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->price * $item->qty}}</strong></td>
                                    <td style='border:1px solid black;'><strong>____</strong></td>
                                </tr>
                            @endforeach
                            
                        @endif
                            
                        @if($drinks_expenditure != '')
                        
                            @foreach($drinks_expenditure as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->itemName}}</strong></td>
                                    <td style='border:1px solid black;'><strong>____</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->total_expenses}}/strong></td>
                                </tr>
                            @endforeach
                            
                        @endif
                                
                        
                        @if($food_sales != '')
                        
                            @foreach($food_sales as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->item}}</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->price * $item->qty}}</strong></td>
                                    <td style='border:1px solid black;'><strong>_____</strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                        
                       @if($food_expenditure != '')
                        
                            @foreach($drinks_expenditure as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->itemName}}</strong></td>
                                    <td style='border:1px solid black;'><strong>____</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->total_expenses}}/strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                       
                       @if($room_sales != '')
                        
                            @foreach($room_sales as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->room_no}}</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->amount_paid}}</strong></td>
                                    <td style='border:1px solid black;'><strong>_____</strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                       
                       @if($room_expenditure != '')
                        
                            @foreach($room_expenditure as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>{{$item->itemName}}</strong></td>
                                    <td style='border:1px solid black;'><strong>____</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->total_expenses}}/strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                       
                       @if($pool_sales != '')
                        
                            @foreach($pool_sales as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>A Pool Sale</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->cost}}</strong></td>
                                    <td style='border:1px solid black;'><strong>_____</strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                       
                       @if($pool_expenditure != '')
                        
                            @foreach($pool_expenditure as $item)
                                <tr>
                                    <td style='border:1px solid black;'><strong>A Pool Expenditure</strong></td>
                                    <td style='border:1px solid black;'><strong>____</strong></td>
                                    <td style='border:1px solid black;'><strong>{{$item->total_expenses}}/strong></td>
                                </tr>
                            @endforeach
                            
                       @endif
                        
                        
                        
                        
                        
                    </table>
                </div>
            </div>
            <div style='padding-top:120px;'>
                <div style='float:left;width:50%;font-size:13px;'>
                    <div>Total Sales: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>&#8358;{{number_format({{$total_sales}})}}</div></div>
                </div>
                <div style='float:right;width:50%;font-size:13px;'>
                    <div>Total Expenditure: <div style='text-decoration:underline;display:inline-block;min-width:30%;'>&#8358;{{number_format($total_expenditure)}}</div></div>
                </div>
            </div>
        </div>
    </body>
</html>