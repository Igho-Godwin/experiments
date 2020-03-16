@include('header.header')
<style>
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
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
                <div class='row background-color-white padding-30px padding-left-30percent' style='width:100%;'>
                    
                    
                    <div draggable='false'>  
                       <div>
                          <h1>
                            Create A User
                          </h1>
                       </div>
                       <br>
                        
                        <form id='create-userForm'  >
 
                              <!-- One "tab" for each step in the form: -->
                              <div id='error' style='color:red;'></div>
                              <br>
                              <div class="tab">Basic Details 1
                                  <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='firstName' name='firstName' placeholder="First name" title='First name' required=''>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='lastName' name='lastName' placeholder="Last name" title='Last name'  required=''>
                                        </div>
                                   </div>
                                  <br>
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Email Address" id='EmailAddress' name='EmailAddress' title='Email Address'  required=''>
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Phone no" id='phoneNo' name='phoneNo' required='' title='Phone No' >
                                      </div>
                                  </div>
                           
                                   <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                                   <br>
                       
                                   <div class="form-row">
                                      <div class="col-sm-6">
                                          <input type="password" class="form-control" placeholder="Password" id='password' name='password' required='' title='password'>
                                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="password" class="form-control" placeholder="Confirm Password" id='password_confirmation' name='password_confirmation' required='' title='Confirm password'>
                                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
                                      </div>
                                   </div>
                           
                                   <br>
                                   <div class="form-row">
                                       <div class="col-sm-6">
                                           <input type='file' name='picture' id='picture' placeholder='Employee Picture' />
                                       </div>
                                       <div class="col-sm-6">
                                           <select id='departments' name='departments' class='form-control' required='' title='Departments'>
                                                 <option value=''>Select Departments</option>
                                                 <option value='1'>Store</option>
                                                 <option value='2'>Rooms</option>
                                                 <option value='3'>Restaurant</option>
                                                 <option value='4'>Bar</option>
                                                 <option value='5'>Pool</option>
                                                 <option value='7'>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                   <br>
                                </div>                   
                              <div class="tab">Basic Details 2
                                    <div class="form-row">
                                      <div class="col-sm-6">
                                         <select class='form-control js-example-basic-single state' name='State' title='State'  data-live-search="true"  >
                                             <option value=''>Select State</option>
                                             @foreach($states as $val)
                                                <option>{{$val->name}}</option>
                                             @endforeach
                                          </select>
                                      </div>
                                     <div class="col-sm-6" style='padding-left:5px;'>
                                         <select class='form-control city js-example-basic-single' name='city' title='City'  data-live-search="true" id='city'>
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option>{{$val->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    <br>  
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                            <input type='text' name='date_Of_birth' class='form-control datepicker' placeholder='Date Of Birth' title='Date Of Birth' />
                                       </div>
                                       <div class="col-sm-6">
                                          <select name='Gender' class='form-control' placeholder='Gender' title='Gender' >
                                               <option value=''>Select</option>
                                               <option>Male</option>
                                               <option>FeMale</option>
                                           </select>
                                       </div>
                                    </div>
                                     <br>
                                </div>
                              <div class="tab">
                                   Educational Qualification 1
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                         <input type='text' name='certificate_1' class='form-control' placeholder='Degree/Certificate' title='Certificate' />
                                      </div>
                                      <div class="col-sm-6">
                                             <input type='text' name='school_1' class='form-control' placeholder='School' title='School' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-12">
                                      <input type='text' name='year_1' class='form-control' placeholder='Year' title='Year' />
                                   </div>
                                </div>
                                <br>
                              </div>
                              <div class="tab"> Educational Qualification 2
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                          <input type='text' name='certificate_2' class='form-control' placeholder='Degree/Certificate' title='Certificate' />
                                       </div>
                                       <div class="col-sm-6">
                                        <input type='text' name='school_2' class='form-control' placeholder='School' title='School'/>
                                       </div>
                                   </div>
                                    <br>
                                   <div class="form-row">
                                        <div class="col-sm-12">
                                            <input type='text' name='year_2' class='form-control' placeholder='Year' title='Year' />
                                        </div>
                                    </div>
                                    <br>
                                </div>
                               
                              <div class="tab"> Work Experience 1
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_1' class='form-control' placeholder='Organization' title='Organization' />
                                     </div>
                                     <div class="col-sm-6">
                                       <input type='text' name='Field_OF_Work_1' class='form-control' placeholder='Field Of Work' title='Field Of Work' />
                                     </div>
                                 </div>
                                  <br>
                                  <div class="form-row">
                                    <div class="col-sm-6">
                                        <input type='text' name='Designation_1' class='form-control' placeholder='Designation' title='Designation' />
                                    </div>
                                   <div class="col-sm-6">
                                   
                                     <select class='form-control js-example-basic-single' name='Location_1' title='Location'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                                </div>
                                  <br>
                              </div>
                             <div class="tab"> Work Experience 2
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_2' class='form-control' placeholder='Organization' title='Organization' />
                                      </div>
                                      <div class="col-sm-6">
                                         <input type='text' name='Field_OF_Work_2' class='form-control' placeholder='Field Of  Work' title='Field Of Work' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-6">
                                      <input type='text' name='Designation_2' class='form-control' placeholder='Designation' title='Designation' />
                                   </div>
                                   <div class="col-sm-6">
                                       <select class='form-control js-example-basic-single' name='Location_2' title='Location'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                                </div>
                                <br>
                             </div>
                              <div class="tab"> Reference
                                 <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='Reference_FullName' class='form-control' placeholder='Full Name' title='Full Name' />
                                     </div>
                                     <div class="col-sm-6">
                                        <input type='text' name='Reference_Address' class='form-control' placeholder='Address' title='Address' />
                                     </div>
                                 </div>
                                 <br>
                                <div class="form-row">
                                  
                                  <div class="col-sm-6">
                                     <select class='form-control js-example-basic-singlestate2' name='Reference_state' title='State'  data-live-search="true"  >
                                             <option value=''>Select State</option>
                                             @foreach($states as $val)
                                                <option>{{$val->name}}</option>
                                             @endforeach
                                      </select>
                                      
                                  </div>
                                    
                                   <div class="col-sm-6">
                                       <select class='form-control js-example-basic-single  city2' name='Reference_city' title='City' id='city_ref'  data-live-search="true" >
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                               </div>
                               <br>
                               <div class="form-row">
                                   <div class="col-sm-6">
                                      <select name='Reference_Gender' class='form-control' placeholder='Gender' title='Gender' >
                                          <option value=''>Select</option>
                                          <option>Male</option>
                                          <option>FeMale</option>
                                       </select>
                                   </div>
                                  <div class="col-sm-6">
                                     <input type='text' name='Reference_Phone_No' class='form-control' placeholder='Phone Number' title='Phone Number' />
                                  </div>
                               </div>
                               <br>
                            </div>
                              
                               <div style="overflow:auto;">
                                   <div style="float:right;">
                                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                      <button type="button" id="nextBtn" class='add-user text-color-white' onclick="nextPrev(1)" style='background-color: #7f63f4;'>Next</button>
                                   </div>
                              </div>
                              <!-- Circles which indicates the steps of the form: -->
                              <div style="text-align:center;margin-top:40px;">
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                              </div>
                        </form>
                       <!--
                       <form id='create-userForm'>
         
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='city' class='form-control' placeholder='City' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='StateOfOrigin' class='form-control' placeholder='StateOfOriin' />
                         </div>
                      </div>
                       <br>  
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='dateOfbirth' class='form-control' placeholder='Date Of Birth' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='Gender' class='form-control' placeholder='Gender' />
                         </div>
                      </div>
                      <br>
                      Educational Qualification 1
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='certificate1' class='form-control' placeholder='Degree/Certificate' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='school1' class='form-control' placeholder='School' />
                         </div>
                      </div>
                      <br>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type='text' name='Year1' class='form-control' placeholder='Year' />
                         </div>
                      </div>
                      <br>
                      Educational Qualification 2
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='certificate2' class='form-control' placeholder='Degree/Certificate' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='school2' class='form-control' placeholder='School' />
                         </div>
                      </div>
                      <br>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type='text' name='Year2' class='form-control' placeholder='Year' />
                         </div>
                      </div>
                      
                      <br>
                      Work Experience 1
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='Organization' class='form-control' placeholder='Organization' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='FieldOFWork' class='form-control' placeholder='Field Of Work' />
                         </div>
                      </div>
                      <br>
                      <div class="form-row">
                        <div class="col-sm-6">
                             <input type='text' name='Designation' class='form-control' placeholder='Designation' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='Location' class='form-control' placeholder='Location' />
                         </div>
                      </div>
                           
                      <br>
                           
                      Work Experience 2
                      <div class="form-row">
                         <div class="col-sm-6">
                             <input type='text' name='Organization' class='form-control' placeholder='Organization' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='FieldOFWork' class='form-control' placeholder='Field Of Work' />
                         </div>
                      </div>
                      <br>
                      <div class="form-row">
                        <div class="col-sm-6">
                             <input type='text' name='Designation' class='form-control' placeholder='Designation' />
                         </div>
                         <div class="col-sm-6">
                             <input type='text' name='Location' class='form-control' placeholder='Location' />
                         </div>
                      </div> 
                      <div class="form-row">
                         <div class="col-sm-12">
                             <input type='text' name='Year2' class='form-control' placeholder='Year' />
                         </div>
                      </div>
                    
                      <br>
                      <div class="form-row">
                         <div class="col-sm-12">
                             <textarea name='address' rows='5' cols='50' class='form-control' placeholder='Address'></textarea>
                         </div>
                      </div>
                           
                        <br>    
                    
                       
                       <br>
                       
                       <div class="form-row">
                         <div class="col-sm-12">
                             <button type='button' id='add-user' class='btn-primary padding-5px width-100percent' >
                                 Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                             </button>
                         </div>
                      </div>
                   </form>
                       -->
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
   

     
    </div>
    
    @include('footer.footer')
    
    
    
    <script>
       var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if ($('.add-user').text() == 'Submit' && n!== -1) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
    </script>
