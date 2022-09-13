@extends('admin.layouts.layout')



@section('content')



    <section class="content">

     <div class="box box-default">

        <div class="box-body">

          <div class="row">

              <!-- end flash-message -->

              {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfileDetail')) !!}

              <div class="col-md-6">

                <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }}">                  

                  <?php

                    if($UserProfileDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$UserProfileDetail['profile_pic'])) {

                      echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic'].'" height="137" id="display_user_profile_pic" />';

                    }

                    else {

                      echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  height="137" id="display_user_profile_pic" />';

                    }

                    ?>

                    <br>

                  <label for="admin_image">Profile Pic</label>

                  <input type="file" name="profile_pic" id="frm_profile_pic" class="form-control" onchange="validateImage()" >

                  @if($errors->has('profile_pic'))

                  <p class="help-block">

                        {{ $errors->first('profile_pic') }}

                  </p>

                @endif

                </div>

                <div class="form-group">

                  <label for="firstname">First Name</label> <span class="color-red">*</span>

                  <input type="text" class="form-control" id="frm_firstname" name="firstname" placeholder="First Name" value="@if(isset($UserProfileDetail['firstname'])){{ $UserProfileDetail['firstname'] }}@else - @endif" required>

                </div>

                <div class="form-group">

                  <label for="lastname">Last Name</label> <span class="color-red">*</span>

                  <input type="text" class="form-control" id="frm_lastname" name="lastname" placeholder="Last Name" value="@if(isset($UserProfileDetail['lastname'])){{ $UserProfileDetail['lastname'] }}@else - @endif" required>

                </div>

                <div class="form-group">

                  <label for="email">Email</label> <span class="color-red">*</span>

                  <input type="email" class="form-control" name="email" id="frm_email" placeholder="Email" value="@if(isset($UserProfileDetail['email'])){{ $UserProfileDetail['email'] }}@else - @endif" disabled="disabled" required>

                </div>                

                <div class="form-group">

                  <label for="phone_number">Phone Number</label> <span class="color-red">*</span>

                  <input type="text" class="form-control" id="frm_phone_number" name="phone_number" placeholder="Phone Number" value="@if(isset($UserProfileDetail['phone_number'])){{ $UserProfileDetail['phone_number'] }}@else - @endif" maxlength="10" required>

                </div>

                <div class="form-group">

                  <label for="new_password">New Password</label>

                  <input type="password" class="form-control" id="frm_new_password" name="new_password" placeholder="New Password" minlength="8">

                </div>

                <div class="form-group">

                  <label for="confirm_password">Confirm Password</label>

                  <input type="password" class="form-control" id="frm_confirm_password" name="confirm_password" placeholder="Confirm Password" minlength="8">

                </div>               

              </div>

              <div class="col-md-6">

                <div class="form-group edit_profile_useless" style="height:122px"> </div>                

                  <div class="form-group">

                  <?php $gender = array ('' => '','Male' => 'Male', 'Female' => 'Female'); ?>

                    <label>Gender</label> <span class="color-red">*</span>

                     {!! Form::select('gender', ['' => 'Select Gender'] +$gender, $UserProfileDetail['gender'], ['class' => 'form-control', 'id' => 'frm_gender', 'name' => 'gender']) !!}

                  </div>

                

                  <div class="form-group">

                    <label for="address">Address</label> <span class="color-red">*</span>

                    <input type="text" class="form-control" id="frm_address" name="address" placeholder="Address" rows="5" value="{{ $UserProfileDetail['address'] }}" required>

                  </div>

                  <div class="form-group">

                    <label for="state">State</label> <span class="color-red">*</span>

                    {!! Form::select('state', ['' => 'Select State'] +$states,$UserProfileDetail['state'],array('id'=>'frm_state', 'class' => 'form-control', 'name' => 'state'));!!}

                  </div>

                  <div class="form-group">

                    <label for="city">City</label> <span class="color-red">*</span>

                    {!! Form::select('city', ['' => 'Select city'] +$cities,$UserProfileDetail['city'],array('id'=>'frm_city', 'class' => 'form-control', 'name' => 'city'));!!} 

                  </div>

                  <div class="form-group">

                    <label for="country">Country</label> <span class="color-red">*</span>

                    <input type="hidden" name="country" id="frm_country">

                     {!! Form::select('country_dd', ['' => 'Select Country'] +$countries,$UserProfileDetail['country'],array('id'=>'frm_country_dd', 'class' => 'form-control', 'name' => 'country', 'disabled' => 'disabled'));!!} 

                  </div>

                  

                  <div class="form-group">

                    <label for="zipcode">Zipcode</label> <span class="color-red">*</span>

                    <input type="text" class="form-control" id="frm_zipcode" name="zipcode" placeholder="Zipcode" value="{{ $UserProfileDetail['zipcode'] }}">

                  </div>



              </div>



              <div class="col-md-12">

              <div class="box-footer text-center">

                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">                

                <button type="submit" id="submit_profiledetail" class="btn btn-primary" onclick="$('#frmeditProfileDetail').submit();">Submit</button>

                <a href="/admin/dashboard" class="btn btn-danger ">Cancel</a>

              </div>

              </div>

              

            {!! Form::close() !!}

         

          </div>

        </div>

     </div>

    </section>



  <script>

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

  

    $('#frmeditProfileDetail').submit(function(e) {

        e.preventDefault();



        // check for validation

        $('#frmeditProfileDetail').validate({

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

              required:true,

              phoneUS: true,

              maxlength:10

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

              required: true

            },

            new_password:{

              // required:true,

              minlength:8

            },

            confirm_password:{

              // required:true,

              minlength:8,

              equalTo:"#frm_new_password"

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

              required: "Provide a Phone Number",

              phoneUS: "Phone number format is invalid. Please enter phone in format of (XXX) XXX XXX",

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

            new_password:{

              // required:"Provide a password",

            },

            confirm_password:{

              // required:"Repeat your password",

              minlength:"Enter at least 8 characters",

              equalTo:"Enter the same password as above"

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

      if ($('#frmeditProfileDetail').valid()) {

       $('form#frmeditProfileDetail').unbind().submit(); 

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