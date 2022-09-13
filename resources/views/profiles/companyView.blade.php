@inject('request', 'Illuminate\Http\Request')
@extends('layouts.profile')

@section('content')
<style>
  table.dp_monthpicker.dp_body td {
    padding: 15px !important;
}
  .Zebra_DatePicker .dp_body .dp_selected {
    background: #f53b49 !important;
    color: #fff !important;ava
}
  .Zebra_DatePicker .dp_daypicker th {
    background: #f53b49 !important;
    cursor: text;
    font-weight: 700;
    color: #fff !important;
}
  input#frm1_birthday{
    padding-right: 0px !important;
  }
  .Zebra_DatePicker{
    width: 100% !important;
  }
  button.Zebra_DatePicker_Icon {
    display: none !important;
}

    .lbl{

        float:left;

    }
    .Zebra_DatePicker_Icon_Wrapper{
        width:150px !important;
    }

</style>

<div class="business-offer-main">
    <?php 
       $loggedinUser = Auth::user(); 
       $customerName = $loggedinUser->firstname.' '.$loggedinUser->lastname;
       $profilePicture = $loggedinUser->profile_pic;
    ?>

    @include('includes.sidebar_profile_left',array ('customerName' => $customerName,'profilePicture' => $profilePicture))

  <div class="business-middle viewcmpny-sec">

    <div class="network_block nw-profile_block">
       
      @if(Auth::user()->status == "rejected")
        <div class="flash-message" style="margin-bottom:15px;">
            <p class="alert alert-danger"><?php echo nl2br(Auth::user()->rejected_reason); ?></p>
        </div>
      @endif
     
      <div class="row">

        <div class="nw-user-detail-block">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <div class="nw-user-img">
              <?php
              if($company['logo'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$company['logo'])) {
                echo '<img id="mine" src="'.Config::get('constants.USER_IMAGE_THUMB').$company['logo'].'" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile display_user_profile_pic_view_profile1"/>';
              }
              else {
                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile display_user_profile_pic_view_profile1" />';
              }
              ?>
              @can('profile_edit_access')
                <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editServicePic" title="Click here to change picture"><i class="fa fa-camera"></i></a>
              @endcan
            </div>
            <button class="nw-view-profile">View profile as</button>
          </div>
          
          <div class="modal fade" id="editServicePic" role="dialog">
              {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile')) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-dialog modal-lg">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-body login-pad">
                      <div class="pop-title employe-title">
                        <h3>EDIT COMPANY LOGO</h3>
                      </div>
                      <button type="button" class="close modal-close" data-dismiss="modal">
                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/close.jpg" height="70" width="34"/>
                      </button>
                    
                      <div class="signup">
                        <div id='systemMessage'></div>
                        <div class="emplouyee-form">
                          <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">
                          <button type="submit" id="submit_profilepic">Submit</button>
                        </div>
                      </div>
                  </div>
                  </div>
                </div>
              {!! Form::close() !!}

          </div>

          
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
            <h1 class="nw-user-nm">{{ $company['first_name']." ".$company['last_name'] }}

            @if(in_array(Auth::user()->status, array("draft", "rejected")))
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="float:right;">
                <form action="/profile/sendProfileToReview/submit_review" method="POST" onclick="return confirm('Are you sure to submit your profile to Fitnessity Review Process ?')">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button class="nw-view-profile">Submit Profile To Review</button>
                </form>
              </div>
            @endif
            </h1>
            <div class="nw-user-edit">
              
                <div class="nw-dtl-edit">
                  <span class="nw-label">Company Name:</span>
                  <span id="display_user_company">{{ $company['company_name'] }}</span>
                </div>
                
                <div class="nw-dtl-edit">
                  <span class="nw-label">Company Representative Name:</span>
                  <span id="display_user_company">{{ $company['first_name'].' '.$company['last_name'] }}</span>
                </div>
                
                <div class="nw-dtl-edit">
                <span class="nw-label">EIN Number:</span>
                <span id="display_user_name">{{$company->ein_number}}</span>
              </div>
              
              <div class="nw-dtl-edit">
                <span class="nw-label">Establishment Year:</span>
                <span id="display_user_name">{{$company->establishment_year}}</span>
              </div>
              
              <div class="nw-dtl-edit">
                <span class="nw-label">Address:</span>
                <span id="display_user_gender">{{$company->address}}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">City : </span>
                <span>{{$company->city}}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">State : </span>
                <span>{{$company->state}} </span>
              </div>
              
               <div class="nw-dtl-edit">
                <span class="nw-label">Business User tag:</span>
                <span id="display_user_name">{{$company->business_user_tag}}</span>
              </div>
              
              <div class="nw-dtl-edit">
                <span class="nw-label">Zip Code:</span>
                <span id="display_user_name">{{$company->zip_code}}</span>
              </div>
              

            
          </div>
          
          
          </div>
          
          <div class="busines-offer-list busines-off-profile-list">
              <div class="job_block">
                  <ul id="myTab_1" class="job_topic">
                      <li class="active"><a href="#tab_employment_history" data-toggle="tab" >Work History</a></li>
                      <li><a href="#tab_education" data-toggle="tab" >Education</a></li>
                      <li><a href="#tab_certification" data-toggle="tab" >Certification</a></li>
                      <li><a href="#tab_services" data-toggle="tab" >Services</a></li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">  
                        
                         <!-- employment history section -  starts -->

      
        
          <div id="tab_employment_history" class="tab-pane active in fade job_listing_block">
                
                <div class="job_listing">
                  
                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Profession Type:</h4> @if(isset($ProfessionalDetail->professional_type)) {{ ucfirst($ProfessionalDetail->professional_type) }} @else - @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Experience Level:</h4> <?php 
                        if(!empty($ProfessionalDetail->experience_level)){ 
                        $d = json_decode($ProfessionalDetail->experience_level);
                            foreach($d as $experience_level)
                            {
                            echo ucfirst(str_replace('_',' ',$experience_level)).", ";
                            }
                        }
                        else {
                        echo "-"; 
                        } ?>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Provides training to:</h4>
                        @if(isset($ProfessionalDetail->train_to))
                         <?php $train_to = json_decode($ProfessionalDetail->train_to); 
                        $i=1;
                      // echo gettype($train_to);
                       if($train_to != null){
                        foreach($train_to as  $av){
                          echo str_replace('_',' ',$av).", ";
                        }
                       }
                        ?>
                          
                        @else - @endif
                      </div>
                    </div>
                  </div>

                  <!--<div class="row">-->
                  <!--  <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">-->
                  <!--    <span></span>-->
                  <!--  </div>-->
                    <!--<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">-->
                    <!--  <div class="job_post_dtls">-->
                    <!--    <h4>Availability:</h4>-->
                        @if(isset($ProfessionalDetail->availability))
                         <?php 
                         //$availability = json_decode($ProfessionalDetail->availability); 
                        // $i=1;
                        // foreach($availability as $k => $av){
                        //   if($i % 2 == 0)
                        //   {echo ucfirst(str_replace('_',' ',$k))."-".$av."<br>";}
                        //   else{echo ucfirst(str_replace('_',' ',$k))."-".$av."  -  ";}
                        //   $i++;
                        // }
                        ?>
                        @else - @endif
                  <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Willing To Travel:</h4>
                        @if(isset($ProfessionalDetail->willing_to_travel)) {{ ucfirst($ProfessionalDetail->willing_to_travel) }}
                        @if(isset($ProfessionalDetail->travel_miles)) , {{ $ProfessionalDetail->travel_miles }} Miles @endif
                        @else No
                        @endif
                        <br>
                        @if(isset($ProfessionalDetail->travel_times)) {{ ucfirst($ProfessionalDetail->travel_times) }}@endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Languages :</h4>
                        @if(isset($ProfessionalDetail->languages))
                            <?php $languages = json_decode(@$ProfessionalDetail->languages); 
                        $i=1;
                        if($languages != null){
                        foreach(@$languages as  $av){
                          echo $av.", ";
                        }
                        }
                            ?>
                        @else - @endif
                      </div>
                    </div>
                  </div>
                </div>

              <div class="nw-user-detail-line2"></div>
                
                     @if($employmenthistories != null && count($employmenthistories) > 0)
                <div class="job_listing">
                  <div class="row">
                    <div class="nw-user-detail-sumry">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry profiledetail">
                        <h1>Experience</h1>
                        <div class="clearfix"></div>
                        @foreach($employmenthistories as $employmenthistory)
                        <span class="timenplace border-rgt">
                          {{ date('d M, Y', strtotime($employmenthistory['service_start'])) }} -
                          @if($employmenthistory['is_present'] == 1)
                              Till Date
                          @else
                            {{ date('d M, Y', strtotime($employmenthistory['service_end'])) }}
                          @endif
                        </span>
                        <span class="timenplace">{{ $employmenthistory['organization'] }}</span>
                        <div class="clearfix"></div>
                        <p>{{ $employmenthistory['position'] }}</p>
                        <div class="clearfix" style="padding-bottom:20px"></div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
            @else
              <div class="job_listing">                
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      No Employeement History Found
                    </div>
                </div>
              </div>

            @endif

          </div>

          <!-- employment history section -  ends -->

          <!-- education section -  starts -->

          <div id="tab_education" class="tab-pane fade job_listing_block">
                @if($educations !=null && count($educations) > 0)
                @foreach($educations as $education)

                  <div class="job_listing">
                    <div class="row">
                      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                        <div class="jb-title">
                          <h1>{{ $education['course'] }}</h1>
                        </div>
                        <p>{{ $education['university'] }}</p>
                        <div class="job_post_dtls">
                          <a href="javascript:void(0);" style="text-decoration: none;">
                            <i class="fa fa-calendar"></i>
                            {{ date('d M, Y', strtotime($education['passing_year'])) }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                @endforeach
              @else

                <div class="job_listing">                
                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      No record found
                    </div>
                  </div>
                </div>

              @endif        
          </div>

          <!-- education section -  ends -->

          <!-- certification section -  starts -->          

          <div id="tab_certification" class="tab-pane fade job_listing_block">

            @if($certifications != null && count($certifications) > 0)
              @foreach($certifications as $certification)

                <div class="job_listing">
                  <div class="row">
<!--                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>-->
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                      <div class="jb-title">
                        <h1>{{ $certification['title'] }}</h1>
                      </div>
                      <p></p>
                      <div class="job_post_dtls">
                        <a href="javascript:void(0);" style="text-decoration: none;">
                          <i class="fa fa-calendar"></i>
                          {{ date('d M, Y', strtotime($certification['completion_date'])) }}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

              @endforeach
            @else

              <div class="job_listing">                
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      No record found
                    </div>
                </div>
              </div>

            @endif


          </div>

          <!-- certification section -  ends -->

          <!-- services section -  starts -->          

          <div id="tab_services" class="tab-pane fade job_listing_block">

                @if($services != null && count($services) > 0)

              @foreach($services as $service)
                {{--@if(isset($sports_names[$service['sport']]))--}}

                <div class="job_listing">
                  <div class="row">
<!--                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                      <div class="jb-title">
                        <h1>
                          <?php
                              if($service['image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$service['image'])) {
                                echo '<img src="'.Config::get('constants.SERVICE_IMAGE_THUMB').$service['image'].'"  id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile" style="width: 75px;height: 75px"/>';
                              }
                              else {
                                 echo '<img src="'.url('/').'/public/images/offer1.jpg" height="75" width="75" />';
                              }
                            ?>
                            {{ @$service['sport_name'] }}
                          </h1>
                      </div>
                      <div class="col-md-12" style="padding-left: 0px;">
                        <div class="col-md-6" style="padding-left: 0px;">
                          <p><b>Activity Name: </b>{{ @$service['sport_name'] }}</p>
                          <p><b>Price: </b>${{ $service['price'] }}</p>
                          <p><b>Description: </b>{{ $service['servicedesc'] }}</p>

                          @if(isset($serviceType[$service['servicetype']]))
                            <p><b>Service Type: </b>{{ $serviceType[$service['servicetype']] }}</p>
                          @endif
                          @if(isset($programType[$service['programtype']]))
                            <p><b>Program Type: </b>{{ $programType[$service['programtype']] }}</p>
                          @endif
                          @if(isset($ageRange[$service['agerange']]))
                            <p><b>Age Range: </b>{{ $ageRange[$service['agerange']] }}</p>
                          @endif
                          @if(isset($programFor[$service['programfor']]))
                            <p><b>Program is for: </b> {{ $programFor[$service['programfor']] }}</p>
                          @endif
                          @if(isset($expLevel[$service['experience_level']]))
                            <p><b>Experience Level: </b> {{ $expLevel[$service['experience_level']] }}</p>
                          @endif
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            @if(isset($numberOfPeople[$service['numberofpeople']]))
                              <p><b>Number of People: </b>{{ $numberOfPeople[$service['numberofpeople']] }}</p>
                            @endif
                            @if($service['servicelocation'] != '' && $service['servicelocation'] != null && $service['servicelocation'] != 'null')
                              <p><b>Place: </b>
                              <?php $c = count((array)(json_decode($service['servicelocation']))); ?>
                              @foreach((json_decode($service['servicelocation'])) as $key1=>$val)
                              {!! str_replace('_', ' ', $val) !!}
                               @if($c != ($key1+1))
                              <span>, </span>
                              @endif
                              @endforeach
                             {{--   @if(@$service['servicelocation'] == "indoor")
                              {{ @$serviceLocation[@$service['servicelocation']] }}</p>
                              @else
                              Outdoors({{$serviceLocation['outdoors'][$service['servicelocation']] }})
                              @endif  --}}
                            @endif
                            @if(isset($pFocuses[$service['focuses']]))
                              <p><b>Program Focuses On: </b> {{ $pFocuses[$service['focuses']] }}</p>
                            @endif
                            @if(isset($specialDeals[$service['specialdeals']]))
                              <p><b>Special Deals: </b> {{ $specialDeals[$service['specialdeals']] }}</p>
                            @endif
                            @if(isset($servicePriceOption[$service['servicepriceoption']]))
                              <p><b>Service Price Options: </b> {{ $servicePriceOption[$service['servicepriceoption']] }}</p>
                            @endif
                            @if(isset($duration[$service['duration']]))
                              <p><b>Duration: </b> {{ $duration[$service['duration']] }}</p>
                            @endif
                            
                            <!-- <p> {{ $service['profile_pic'] }}</p> -->
                            @if($service['terms_conditions'] != '')
                              <p><b>Terms & Conditions: </b> {{ $service['terms_conditions'] }}</p>
                            @endif
                        </div>
                      </div>
                      <div class="job_post_dtls">
                      </div>
                    </div>
                  </div>
                </div>
              {{--  @endif--}}
              @endforeach
            @else

              <div class="job_listing">                
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      No record found
                    </div>
                </div>
              </div>

            @endif
         
          </div>

          <!-- services section -  ends -->

        </div>
                        
              </div>
          </div>
          </div>
        </div>
          
</div>
</div>
@include('includes.sidebar_profile_right')
</div>
  
<script src="/public/js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function(){
        $('#display_user_profile_pic').attr('src',$('#mine').attr('src'))
        $('.username').html("{{'@'.$company->business_user_tag}}")
        $('#intro-user').html("{{$company->about_company}}")
        $('.coemail').attr('href',"{{'mailto:'.$company->email}}")
        $('.cophone').attr('href',"{{'tel:'.$company->contact_number}}")
        $('.coaddress').attr('href',"{{'http://maps.google.com/?q='.$company->address}}")
        $('#frmeditProfile').submit(function(e) {
      e.preventDefault();
      $('#frmeditProfile').validate({
          rules: {
              profile_pic: {
               required: true,
               accept: "image/*"   
              },
          },
          messages: {
              profile_pic: {
                  required: "Upload a company logo",
                  accept: "Please upload an image"
              },
          }
      });
      if(!$('#frmeditProfile').valid()) {
          return false;
      }
      var inputData = new FormData($(this)[0]);
      inputData.append('company_id',"{{$company->id}}")
      $.ajax({
        url:'/profile/editCompanyPicture',
        type:'POST',
        dataType: 'json',
        data:inputData,
        processData:false,
        contentType:false,
        beforeSend: function () {
          $('#submit_profilepic').prop('disabled', true);
        },
        complete: function () {
          $('#submit_profilepic').prop('disabled', false);
        },
        success: function (response) {                      
              if (response.type == 'success') {
                  window.location.reload()
                  // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);
                  // $("#display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                  // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                  $(".display_user_profile_pic_view_profile1").each(function(){
                    $(this).attr("src", response.returndata.profile_pic);
                  });
                  
                  $('#editServicePic').modal('hide');
              }else {
                  showSystemMessages('#systemMessage', response.type, response.msg);
              }
          }
      });
    });
    })
</script>
@endsection