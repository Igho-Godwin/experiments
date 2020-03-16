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
                    
                    
                    <div>  
                       <div>
                          <h1>
                            Edit User
                          </h1>
                       </div>
                       <br>
                         
                        <form id='edit-userForm'  >
 
                              <!-- One "tab" for each step in the form: -->
                              <div id='error' style='color:red;'></div>
                              <br>
                              <div class="tab">Basic Details 1
                                  <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='firstName' name='firstName' placeholder="First name" title='First name' required='' value='{{$users->first_name}}' />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='lastName' name='lastName' placeholder="Last name" title='Last name' value='{{$users->last_name}}'  required=''>
                                        </div>
                                   </div>
                                  <br>
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Email Address" id='EmailAddress' name='EmailAddress' value='{{$users->email}}' title='Email Address'  required=''>
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Phone no" id='phoneNo' name='phoneNo' required='' value='{{$users->phone_no}}' title='Phone No' >
                                      </div>
                                  </div>
                           
                                   <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                                  
                                   <input type='text' id='id' name='id' value='{{Request::get("id")}}' class='hide' />
                       
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
                                                 <option value='1' @if($users->dept == '1') Selected @endif>Store</option>
                                                 <option value='2' @if($users->dept == '2') Selected @endif>Rooms</option>
                                                 <option value='3' @if($users->dept == '3') Selected @endif>Restaurant</option>
                                                 <option value='4' @if($users->dept == '4') Selected @endif>Bar</option>
                                                 <option value='5' @if($users->dept == '5') Selected @endif>Pool</option>
                                                 <option value='7' @if($users->dept == '7') Selected @endif>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                   <br>
                                </div>                   
                              <div class="tab">Basic Details 2
                                    <div class="form-row">
                                      <div class="col-sm-6">
                                         <select class='form-control selecti state js-example-basic-single' name='State' title='State'  data-live-search="true"  >
                                             <option value=''>Select State</option>
                                             @foreach($states as $val)
                                                <option @if($val->name == $users->state) Selected  @endif>{{$val->name}}</option>
                                             @endforeach
                                          </select>
                                      </div>
                                     <div class="col-sm-6">
                                         <select class='form-control js-example-basic-single' id='city' name='city' title='City'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option @if($val->name == $users->city) Selected  @endif>{{$val->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    <br>  
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                            <input type='text' name='date_Of_birth' class='form-control datepicker' placeholder='Date Of Birth' title='Date Of Birth' value='{{date("d-m-Y",strtotime($users->dateOfBirth))}}' />
                                       </div>
                                       <div class="col-sm-6">
                                          <select name='Gender' class='form-control' placeholder='Gender' title='Gender' >
                                            
                                               <option @if($users->Gender == 'Male') Selected  @endif>Male</option>
                                               <option @if($users->Gender == 'FeMale') Selected  @endif>FeMale</option>
                                           </select>
                                       </div>
                                    </div>
                                     <br>
                                </div>
                              <div class="tab">
                                   Educational Qualification 1
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                         <input type='text' name='certificate_1' class='form-control' placeholder='Degree/Certificate' title='Certificate'  value='{{$users->certificate_1}}' />
                                      </div>
                                      <div class="col-sm-6">
                                             <input type='text' name='school_1' class='form-control' placeholder='School' title='School'  value='{{$users->school_1}}' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-12">
                                      <input type='text' name='year_1' class='form-control' placeholder='Year' title='Year'  value='{{$users->year_1}}' />
                                   </div>
                                </div>
                                <br>
                              </div>
                              <div class="tab"> Educational Qualification 2
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                          <input type='text' name='certificate_2' class='form-control' placeholder='Degree/Certificate' title='Certificate'  value='{{$users->certificate_2}}' />
                                       </div>
                                       <div class="col-sm-6">
                                        <input type='text' name='school_2' class='form-control' placeholder='School' title='School'  value='{{$users->school_2}}'/>
                                       </div>
                                   </div>
                                    <br>
                                   <div class="form-row">
                                        <div class="col-sm-12">
                                            <input type='text' name='year_2' class='form-control' placeholder='Year' title='Year'  value='{{$users->year_2}}' />
                                        </div>
                                    </div>
                                    <br>
                                </div>
                               
                              <div class="tab"> Work Experience 1
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_1' class='form-control' placeholder='Organization' title='Organization'  value='{{$users->organization_1}}' />
                                     </div>
                                     <div class="col-sm-6">
                                       <input type='text' name='Field_OF_Work_1' class='form-control' value='{{$users->fieldOfWork_1}}' placeholder='Field Of Work' title='Field Of Work' />
                                     </div>
                                 </div>
                                  <br>
                                  <div class="form-row">
                                    <div class="col-sm-6">
                                        <input type='text' name='Designation_1' class='form-control' placeholder='Designation' title='Designation' value='{{$users->fieldOfWork_1}}' />
                                    </div>
                                   <div class="col-sm-6">
                                   
                                     <select class='form-control js-example-basic-single' name='Location_1' title='Location'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option @if($val->name == $users->city) Selected  @endif>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                                </div>
                                  <br>
                              </div>
                             <div class="tab"> Work Experience 2
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_2' class='form-control' placeholder='Organization' title='Organization' value='{{$users->organization_2}}' />
                                      </div>
                                      <div class="col-sm-6">
                                         <input type='text' name='Field_OF_Work_2' class='form-control' placeholder='Field Of  Work' title='Field Of Work' value='{{$users->fieldOfWork_2}}' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-6">
                                      <input type='text' name='Designation_2' class='form-control' placeholder='Designation' title='Designation'  value='{{$users->	designation_2}}' />
                                   </div>
                                   <div class="col-sm-6">
                                       <select class='form-control js-example-basic-single' name='Location_2' title='Location'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option @if($val->name == $users->city) Selected  @endif>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                                </div>
                                <br>
                             </div>
                              <div class="tab"> Reference
                                 <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='Reference_FullName' class='form-control' placeholder='Full Name' title='Full Name' value='{{$users->		ref_full_name}}'   />
                                     </div>
                                     <div class="col-sm-6">
                                        <input type='text' name='Reference_Address' class='form-control' placeholder='Address' title='Address' value='{{$users->ref_address}}' />
                                     </div>
                                 </div>
                                 <br>
                                <div class="form-row">
                                  
                                  <div class="col-sm-6">
                                     <select class='form-control js-example-basic-single state2' name='Reference_state' title='State'  data-live-search="true"  >
                                             <option value=''>Select State</option>
                                             @foreach($states as $val)
                                                <option @if($val->name == $users->state) Selected  @endif>{{$val->name}}</option>
                                             @endforeach
                                      </select>
                                      
                                  </div>
                                    
                                   <div class="col-sm-6">
                                       <select class='form-control js-example-basic-single ' id='city_ref' name='Reference_city' title='City'  data-live-search="true">
                                             <option value=''>Select City</option>
                                              @foreach($cities as $val)
                                                <option @if($val->name == $users->city) Selected  @endif>{{$val->name}}</option>
                                              @endforeach
                                        </select>
                                   </div>
                               </div>
                               <br>
                               <div class="form-row">
                                   <div class="col-sm-6">
                                      <select name='Reference_Gender' class='form-control' placeholder='Gender' title='Gender' >
                                          <option @if($users->Gender == 'Male') Selected  @endif>Male</option>
                                               <option @if($users->Gender == 'FeMale') Selected  @endif>FeMale</option>>
                                       </select>
                                   </div>
                                  <div class="col-sm-6">
                                     <input type='text' name='Reference_Phone_No' class='form-control' placeholder='Phone Number' title='Phone Number' value='{{$users->	ref_phone_no}}' />
                                  </div>
                               </div>
                               <br>
                            </div>
                              
                               <div style="overflow:auto;">
                                   <div style="float:right;">
                                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                      <button type="button" id="nextBtn" class='edit-user text-color-white' onclick="nextPrev(1)" style='background-color: #7f63f4;'>Next</button>
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
                       <form id='edit-userForm' >
                             
                              <div id='error' style='color:red;'></div>
                              <br>
                              <div class="tab">Basic Details 1
                                  <div class="form-row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='firstName' name='firstName' value='{{$users->first_name}}' placeholder="First name" title='First name' required=''>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id='lastName' name='lastName' placeholder="Last name" value='{{$users->last_name}}' title='Last name'  required=''>
                                        </div>
                                   </div>
                                  <br>
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Email Address" id='EmailAddress' value='{{$users->email}}' name='EmailAddress' title='Email Address'  required=''>
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" placeholder="Phone no" id='phoneNo' name='phoneNo' required='' value='{{$users->phone_no}}' title='Phone No' >
                                      </div>
                                  </div>
                           
                                   <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                       
                                   <br>
                       
                                   <div class="form-row">
                                      <div class="col-sm-6">
                                          <input type="password" class="form-control d" placeholder="Password" id='password' name='password'  title='password'>
                                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="password" class="form-control d" placeholder="Confirm Password" id='password_confirmation' name='password_confirmation'  title='Confirm password'>
                                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
                                      </div>
                                   </div>
                           
                                   <br>
                                   <div class="form-row">
                                       <div class="col-sm-6">
                                           <input type='file' class='d' name='picture' id='picture' placeholder='Employee Picture' />
                                       </div>
                                       <div class="col-sm-6">
                                           <select id='departments' name='departments' class='form-control' required='' title='Departments'>
                                                 <option value=''>Select Departments</option>
                                                 <option value='1' @if($users->dept == '1') Selected @endif>Store</option>
                                                 <option value='2' @if($users->dept == '2') Selected @endif>Rooms</option>
                                                 <option value='3' @if($users->dept == '3') Selected @endif>Restaurant</option>
                                                 <option value='4' @if($users->dept == '4') Selected @endif>Bar</option>
                                                 <option value='5' @if($users->dept == '5') Selected @endif>Pool</option>
                                                 <option value='7' @if($users->dept == '7') Selected @endif>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                   <br>
                                </div>                   
                              <div class="tab">Basic Details 2
                                    <div class="form-row">
                                      <div class="col-sm-6">
                                         <input type='text' name='city' title='City' class='form-control' placeholder='City' value='{{$users->city}}' />
                                      </div>
                                      <div class="col-sm-6">
                                        <input type='text' name='State' title='State' class='form-control' placeholder='State' value='{{$users->state}}' />
                                      </div>
                                    </div>
                                    <br>  
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                            <input type='text' name='date_Of_birth' class='form-control datepicker' placeholder='Date Of Birth' title='Date Of Birth' value='{{date("d-m-Y",strtotime($users->phone_no))}}' />
                                       </div>
                                       <div class="col-sm-6">
                                           <select name='Gender' class='form-control' placeholder='Gender' title='Gender' >
                                               <option @if($users->Gender == 'Male') Selected @endif>Male</option>
                                               <option @if($users->Gender == 'FeMale') Selected @endif>FeMale</option>
                                           </select>
                                       </div>
                                    </div>
                                     <br>
                                </div>
                              <div class="tab">
                                   Educational Qualification 1
                                  <div class="form-row">
                                      <div class="col-sm-6">
                                         <input type='text' name='certificate_1' class='form-control' placeholder='Degree/Certificate' title='Certificate' value='{{$users->certificate_1}}' />
                                      </div>
                                      <div class="col-sm-6">
                                             <input type='text' name='school_1' class='form-control' placeholder='School' title='School' value='{{$users->school_1}}' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-12">
                                      <input type='text' name='year_1' class='form-control' placeholder='Year' title='Year' value='{{$users->year_1}}' />
                                   </div>
                                </div>
                                <br>
                              </div>
                              <div class="tab"> Educational Qualification 2
                                    <div class="form-row">
                                       <div class="col-sm-6">
                                          <input type='text' name='certificate_2' class='form-control' placeholder='Degree/Certificate' title='Certificate' value='{{$users->certificate_2}}' />
                                       </div>
                                       <div class="col-sm-6">
                                        <input type='text' name='school_2' class='form-control' placeholder='School' title='School' value='{{$users->school_2}}'/>
                                       </div>
                                   </div>
                                    <br>
                                   <div class="form-row">
                                        <div class="col-sm-12">
                                            <input type='text' name='year_2' class='form-control' placeholder='Year' title='Year' value='{{$users->year_2}}' />
                                        </div>
                                    </div>
                                    <br>
                                </div>
                               
                              <div class="tab"> Work Experience 1
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_1' class='form-control' placeholder='Organization' title='Organization' value='{{$users->organization_1}}' />
                                     </div>
                                     <div class="col-sm-6">
                                       <input type='text' name='Field_OF_Work_1' class='form-control' placeholder='Field Of Work' title='Field Of Work'  value='{{$users->fieldOfWork_1}}' />
                                     </div>
                                 </div>
                                  <br>
                                  <div class="form-row">
                                    <div class="col-sm-6">
                                        <input type='text' name='Designation_1' class='form-control' placeholder='Designation' title='Designation' value='{{$users->designation_1}}' />
                                    </div>
                                   <div class="col-sm-6">
                                     <input type='text' name='Location_1' class='form-control' placeholder='Location' title='Location' value='{{$users->location_1}}'  />
                                   </div>
                                </div>
                                  <br>
                              </div>
                             <div class="tab"> Work Experience 2
                                  <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='organization_2' class='form-control' placeholder='Organization' title='Organization' value='{{$users->organization_2}}' />
                                      </div>
                                      <div class="col-sm-6">
                                         <input type='text' name='Field_OF_Work_2' class='form-control' placeholder='Field Of  Work' title='Field Of Work' value='{{$users->fieldOfWork_2}}' />
                                      </div>
                                  </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-6">
                                      <input type='text' name='Designation_2' class='form-control' placeholder='Designation' title='Designation' value='{{$users->designation_2}}' />
                                   </div>
                                   <div class="col-sm-6">
                                       <input type='text' name='Location_2' class='form-control' placeholder='Location' title='Location' value='{{$users->location_2}}' />
                                   </div>
                                </div>
                                <br>
                             </div>
                              <div class="tab"> Reference
                                 <div class="form-row">
                                     <div class="col-sm-6">
                                         <input type='text' name='Reference_FullName' class='form-control' placeholder='Full Name' title='Full Name' value='{{$users->ref_full_name}}' />
                                     </div>
                                     <div class="col-sm-6">
                                        <input type='text' name='Reference_Address' class='form-control' placeholder='Address' title='Address' value='{{$users->ref_address}}' />
                                     </div>
                                 </div>
                                 <br>
                                <div class="form-row">
                                   <div class="col-sm-6">
                                      <input type='text' name='Reference_city' class='form-control' placeholder='City' title='City' value='{{$users->ref_city}}' />
                                   </div>
                                  <div class="col-sm-6">
                                     <input type='text' name='Reference_state' class='form-control' placeholder='State' title='State' value='{{$users->ref_state}}' />
                                  </div>
                               </div>
                               <br>
                               <div class="form-row">
                                   <div class="col-sm-6">
                                      <select name='Reference_Gender' class='form-control' placeholder='Gender' title='Gender' >
                                          <option @if($users->Gender == 'Male') Selected @endif>Male</option>
                                          <option @if($users->Gender == 'FeMale') Selected @endif>FeMale</option>
                                       </select>
                                   </div>
                                  <div class="col-sm-6">
                                     <input type='text' name='Reference_Phone_No' class='form-control' placeholder='Phone Number' title='Phone Number' value='{{$users->ref_phone_no}}' />
                                  </div>
                               </div>
                               <br>
                            </div>
                              
                               <div style="overflow:auto;">
                                   <div style="float:right;">
                                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                      <button type="button" id="nextBtn" class='edit-user' onclick="nextPrev(1)">Next</button>
                                   </div>
                              </div>
                      
                              <div style="text-align:center;margin-top:40px;">
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
                                   <span class="step"></span>
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
  if ($('.edit-user').text() == 'Submit' && n!== -1) return false;
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
    if (y[i].value == "" && (!y[i].classList.contains('d')) ) {
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
