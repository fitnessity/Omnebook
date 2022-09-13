@extends('admin.layouts.layout')

@section('content')  

     <div class="panel panel-default">
        <div class="panel-heading">
          Edit
        </div>
        <div class="panel-body">
          <div class="row">
                    <!-- end flash-message -->
              {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'editCustomerDetails')) !!}
              <div class="col-md-6">
                <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">                  
                  <?php
                    if($customerDetails['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$customerDetails['profile_pic'])) {
                      echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$customerDetails['profile_pic'].'" height="100" id="display_user_profile_pic" />';
                    }
                    else {
                      echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  height="100" id="display_user_profile_pic" />';
                    }
                    ?>
                    <br>
                  <label for="admin_image">Image</label>
                  <input type="file" name="profile_pic" id="frm_profile_pic" class="form-control" onchange="validateImage()">
                </div>

                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="firstname">First Name</label> <span class="color-red">*</span>
                  <input type="text" class="form-control" id="frm_firstname" name="firstname" placeholder="First Name" value="@if(isset($customerDetails['firstname'])){{ $customerDetails['firstname'] }}@else - @endif">
                 
                </div>
                <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                  <label for="lastname">Last Name</label> <span class="color-red">*</span>
                  <input type="text" class="form-control" id="frm_lastname" name="lastname" placeholder="Last Name" value="@if(isset($customerDetails['lastname'])){{ $customerDetails['lastname'] }}@else - @endif">
                  
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="frm_email" placeholder="Email" value="@if(isset($customerDetails['email'])){{ $customerDetails['email'] }}@else - @endif" disabled="disabled">
                 
                 
                </div>
                <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                  <label for="phone_number">Phone Number</label> <span class="color-red">*</span>
                  <!-- <input type="text" class="form-control" id="frm_phone_number" name="phone_number" placeholder="(XXX) XXX XXX" value="@if(isset($customerDetails['phone_number'])){{ $customerDetails['phone_number'] }}@else - @endif" maxlength="10"> -->

                  <input type="text" name="phone_number" required placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number',$customerDetails['phone_number']) }}">
                </div>
               
               <div class="form-group">
                <?php $gender = array ('' => '','Male' => 'Male', 'Female' => 'Female'); ?>
                  <label>Select Gender</label> <span class="color-red">*</span>
                   {!! Form::select('gender', ['' => 'Select Gender'] +$gender, $customerDetails['gender'], ['class' => 'form-control', 'id' => 'frm_gender', 'name' => 'gender']) !!}
                </div>

               <div class="form-group {{ $errors->has('activated') ? ' has-error' : '' }}">
                 {!! Form::label('activated', 'Is Active?', ['class' => 'control-label']) !!}
                    <div>
                        <label>{!! Form::radio('activated', 1, $customerDetails['activated'] ? true : false) !!} Yes</label>
                    </div>
                    <div>
                      <label>{!! Form::radio('activated', 0, !($customerDetails['activated']) ? true : false) !!} No</label>
                    </div>
               </div>
                
              </div>
              <div class="col-md-6">
                <div class="form-group" style="height:85px;"></div>
                
                <div class="form-group">
                  <label for="address">Address</label> <span class="color-red">*</span>
                  <input type="text" class="form-control" id="frm_address" name="address" placeholder="Address" rows="5" value="{{ $customerDetails['address'] }}">
                </div>

                 <div class="form-group">
                  <label for="country">Country</label>
                  <input type="hidden" name="country" id="frm_country">
                   {!! Form::select('country_dd', ['' => 'Select'] +$countries,$customerDetails['country'],array('id'=>'frm_country_dd', 'class' => 'form-control', 'name' => 'country','disabled' => true));!!} 
                </div>

                <div class="form-group">
                  <label for="state">State</label> <span class="color-red">*</span>
                  {!! Form::select('state', ['' => 'Select State'] +$states,$customerDetails['state'],array('id'=>'frm_state', 'class' => 'form-control', 'name' => 'state'));!!}
                </div>

                <div class="form-group">
                  <label for="city">City</label> <span class="color-red">*</span>
                  {!! Form::select('city', ['' => 'Select City'] +$cities,$customerDetails['city'],array('id'=>'frm_city', 'class' => 'form-control', 'name' => 'city'));!!} 
                </div>
                
                <div class="form-group">
                  <label for="zipcode">Zipcode</label> <span class="color-red">*</span>
                  <input type="text" class="form-control" id="frm_zipcode" name="zipcode" placeholder="Zipcode" value="{{ $customerDetails['zipcode'] }}">
                </div>

                 <div class="form-group">
                    <label for="about_me">About me</label> <span class="color-red">*</span>
                    <textarea class="form-control" placeholder="Tell Us Somthing About You..." name="about_me" rows="7" maxlength="500">@if(isset($customerDetails['about_me'])) {!! $customerDetails['about_me'] !!} @endif</textarea>
                </div>
              </div>

              <div class="col-md-12">
              <div class="box-footer text-center">
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                <button type="submit" id="submit_profiledetail" class="btn btn-primary" onclick="$('#editCustomerDetails').submit();">Submit</button>
                    
                <a href="/admin/customers" class="btn btn-danger ">Cancel</a>
                    
                <!-- <a href="/admin/deactivateCustomer/{{ $customerDetails['id'] }}" class="btn btn-warning" onclick="return confirm('Do you really want to deactivate this customer?');"><i class="fa fa-fw fa-warning"></i> Deactivate Customer</a>
                    &nbsp;&nbsp; -->
                <!-- <a href="/admin/customer/delete/{{ $customerDetails['id'] }}" class="btn btn-danger " onclick="return confirm('Do you really want to delete this customer?');"><i class="fa fa-fw fa-times-circle"></i> Delete Customer</a> -->
                  
              </div>
              </div>
              
            {!! Form::close() !!}
         
          </div>
        </div>
     </div>

  <script>
    $(function () {
        // for mobile no.
        $('[data-mask]').inputmask()
    })
    function validateImage() 
    {
        var formData = new FormData();
     
        var file = document.getElementById("frm_profile_pic").files[0];
     
        formData.append("Filedata", file);
        var t = file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
            alert('Please select a valid image file');
            document.getElementById("frm_profile_pic").value = '';
            return false;
        }
        if (file.size > 1000000) {
            alert('Please Upload picture less than 1MB size');
            document.getElementById("frm_profile_pic").value = '';
            return false;
        }
        return true;
    }
    
    $('#editCustomerDetails').submit(function(e) {
        e.preventDefault();

        // check for validation
        $('#editCustomerDetails').validate({
          rules: {
            company_name: {
              required: true
            },
            firstname: {
              required: true
            },
            lastname: {
              required: true
            },
            gender: {
              required: true
            },
             phone_number: {
               // phoneUS: true,
               required:true,
               // maxlength:10
             },
            address: {
              required: true
            },
            city: {
              required: true
            },
            state: {
              required: true
            },
            zipcode: {
              required: true,
            },
            about_me:{
              required: true,
            },

          },
          messages: {
            company_name: {
              required: "Provide a company name",
            },
            firstname: {
              required: "Provide a first name",
            },
            lastname: {
              required: "Provide a last name",
            },
            gender: {
              required: "Select a Gender",
            },
            phone_number: {
                // phoneUS: "Phone number format is invalid. Please enter phone in format of (XXX) XXX XXX55",
             },
            address: {
              required: "Provide an adderess",
            },
            city: {
              required: "Provide a city",
            },
            state: {
              required: "Provide a state",
            },
            zipcode: {
              required: "Provide a zipcode",
            },
            about_me:{
              required: "Provide about me",
            },
          },
        submitHandler: saveProfileDetail
        });
    });

    // add US phone number validation
    $(document).ready(function(){
      
      jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                //phone_number = phone_number.replace(phonecode, ""); 
                return this.optional(element) || phone_number.length > 9 &&
                        phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
        }, "Please specify a valid phone number");
      });

    function saveProfileDetail()
    {
      if ($('#editCustomerDetails').valid()) {
       $('form#editCustomerDetails').unbind().submit(); 
      }
    }
    
    $('#frm_country_dd').change(function(){
        var country_code = $('#frm_country_dd').val();    
        if(country_code){
            $.ajax({
               type:"GET",
               url:"{{url('/get-state-list')}}?country_code="+country_code,
               success:function(res){               
                if(res){
                    $("#frm_state").empty();
                    $("#frm_state").append('<option>Select</option>');
                    $.each(res,function(key,value){
                        $("#frm_state").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                   $("#frm_state").empty();
                }
               }
            });
        }else{
            $("#frm_state").empty();
            $("#frm_city").empty();
        }
    });
    $('#frm_state').on('change',function(){
        var state_id = $(this).val();    
        if(state_id){
            $.ajax({
               type:"GET",
               // url: '/get-city-list/'+state_id,
               url:"{{url('/get-city-list')}}?state_id="+state_id,
               success:function(res){               
                if(res){
                    $("#frm_city").empty();
                    $.each(res,function(key,value){
                        $("#frm_city").append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                   $("#frm_city").empty();
                }
               }
            });
        }else{
            $("#frm_city").empty();
        }        
    });

   </script>
   
@endsection