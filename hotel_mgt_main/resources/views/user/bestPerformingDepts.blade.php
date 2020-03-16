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
                        Best Performing Departments
                      </h1>
                   </div>
                   <br>
                   <div class='col-sm-12' style='margin-bottom:50x;'>
                       <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
      google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([

['{{date('Y')}}', 


        
       'Room',

          

          


        
       'Restuarant',

          

          


        
       'Pool',

          

          


        
       'Bar'

          
          ],

['Jan',

{{$obj->getBestDeptsData('01','room')}},

{{$obj->getBestDeptsData('01','restuarant')}},

{{$obj->getBestDeptsData('01','pool')}},

{{$obj->getBestDeptsData('01','drink')}}




          

          
          ] , ['Feb',



{{$obj->getBestDeptsData('02','room')}},

{{$obj->getBestDeptsData('02','restuarant')}},

{{$obj->getBestDeptsData('02','pool')}},

{{$obj->getBestDeptsData('02','drink')}}
          

          
          ],

          ['Mar',



{{$obj->getBestDeptsData('03','room')}},

{{$obj->getBestDeptsData('03','restuarant')}},

{{$obj->getBestDeptsData('03','pool')}},

{{$obj->getBestDeptsData('03','drink')}}

          

          
          ],

           ['Apr',



{{$obj->getBestDeptsData('04','room')}},

{{$obj->getBestDeptsData('04','restuarant')}},

{{$obj->getBestDeptsData('04','pool')}},

{{$obj->getBestDeptsData('04','drink')}}

          

          
          ],

           ['May',




        
    {{$obj->getBestDeptsData('05','room')}},

{{$obj->getBestDeptsData('05','restuarant')}},

{{$obj->getBestDeptsData('05','pool')}},

{{$obj->getBestDeptsData('05','drink')}}


          

          
          ],

             ['Jun',



{{$obj->getBestDeptsData('06','room')}},

{{$obj->getBestDeptsData('06','restuarant')}},

{{$obj->getBestDeptsData('06','pool')}},

{{$obj->getBestDeptsData('06','drink')}}


          

          
          ],

            ['Jul',




        
       {{$obj->getBestDeptsData('07','room')}},

{{$obj->getBestDeptsData('07','restuarant')}},

{{$obj->getBestDeptsData('07','pool')}},

{{$obj->getBestDeptsData('07','drink')}}


          

          
          ],

            ['Aug',


{{$obj->getBestDeptsData('08','room')}},

{{$obj->getBestDeptsData('08','restuarant')}},

{{$obj->getBestDeptsData('08','pool')}},

{{$obj->getBestDeptsData('08','drink')}}

          

          
          ],


            ['Sep',



{{$obj->getBestDeptsData('09','room')}},

{{$obj->getBestDeptsData('09','restuarant')}},

{{$obj->getBestDeptsData('09','pool')}},

{{$obj->getBestDeptsData('09','drink')}}


          

          
          ],

            ['Oct',


{{$obj->getBestDeptsData('10','room')}},

{{$obj->getBestDeptsData('10','restuarant')}},

{{$obj->getBestDeptsData('10','pool')}},

{{$obj->getBestDeptsData('10','drink')}}

          

          
          ],

            ['Nov',


{{$obj->getBestDeptsData('11','room')}},

{{$obj->getBestDeptsData('11','restuarant')}},

{{$obj->getBestDeptsData('11','pool')}},

{{$obj->getBestDeptsData('11','drink')}}


          

          
          ],

            ['Dec',


{{$obj->getBestDeptsData('12','room')}},

{{$obj->getBestDeptsData('12','restuarant')}},

{{$obj->getBestDeptsData('12','pool')}},

{{$obj->getBestDeptsData('12','drink')}}


          

          
          ]






    

    
          
        ]);

        var options = {
          chart: {
            title: 'Departmental Performance For The Year {{date('Y')}} based on Income',
            subtitle: 'Departments',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    
      }
        
        </script>
<div class='col-sm-12' style='margin-bottom:50px;'>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>
                   </div>
                    <br>
                    
                        <div class='col-sm-12 text-center' >
                   
                        <form action='bestPerformingDepts' style='display:inline-block' enctype="multipart/form-data">
                        <div id='error' style='color:red;'>
                           
                        </div>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type="text" class="form-control input-daterange-datepicker" id='date1' name='date1' placeholder="Date" title='Date' required=''>
                             
                             <br />
                             
                             <button type='submit'  class='btn-primary padding-5px width-100percent'  >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                            
                         </div>
                      </div>
                   
                       <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                   </form>
                   
                    </div>
                    
          
                    <div class="col-sm-12">
                        
                        @if(Request::get('date1') == null)
                             <H3 style='margin-bottom:50px;'>Data For This Month </H3>
                        @else
                            <H3>Data For date between {{Request::get('date1')}} </H3>
                        @endif
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style='width:100%;'>
                                    <thead>
                                        <tr>
                                       
                                            <th>Department</th>
                                            <th>Income</th>
                                            <th>Expenses</th>
                                            <th>Profit/Loss</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                            <tr>
                                                <td>Room</td>
                                                <td>&#8358;{{number_format($Income['room'])}}</td>
                                                <td>&#8358;{{number_format($Expenses['room'])}}</td>
                                                <td>&#8358;{{number_format($Income['room'] - $Expenses['room'])}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Bar</td>
                                                <td>&#8358;{{number_format($Income['bar'])}}</td>
                                                <td>&#8358;{{number_format($Expenses['bar'])}}</td>
                                                <td>&#8358;{{number_format($Income['bar'] - $Expenses['bar'])}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Pool</td>
                                                <td>&#8358;{{number_format($Income['pool'])}}</td>
                                                <td>&#8358;{{number_format($Expenses['pool'])}}</td>
                                                <td>&#8358;{{number_format($Income['pool'] - $Expenses['pool'])}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Restuarant</td>
                                                <td>&#8358;{{number_format($Income['restuarant'])}}</td>
                                                <td>&#8358;{{number_format($Expenses['restuarant'])}}</td>
                                                <td>&#8358;{{number_format($Income['restuarant'] - $Expenses['restuarant'])}}</td>
                                            </tr>
                                                
                                     
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Department</th>
                                            <th>Income</th>
                                            <th>Expenses</th>
                                            <th>Profit/Loss</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                    
                                <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                    
                               
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
    
    
    
  