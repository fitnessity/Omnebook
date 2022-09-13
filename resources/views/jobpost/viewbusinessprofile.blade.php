<div class="business-offer-main">

    <div class="network_block nw-profile_block">

      <div class="row">
        <div class="nw-user-detail-block">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <div class="nw-user-img">
              <?php
              if($UserProfileDetail['logo'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$UserProfileDetail['logo'])) {
                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['logo'].'" width="254" height="275" id="display_user_profile_pic" />';
              }
              else {
                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
              }
              ?>
            </div>
            <?php 
              if(isset($UserProfileDetail['follows']) && count($UserProfileDetail['follows']) > 0 ){ ?>
                <button class="btn common-btn follow" id="{{ @$UserProfileDetail['follows'][0]['follower_id'] }}">Unfollow</button>
            <?php } else { ?>
                <button class="btn common-btn follow" id="{{ $UserProfileDetail['id'] }}">Follow</button>  
            <?php } ?>
            <span id="userFavourite_{{$UserProfileDetail['id']}}" style="padding-left: 25px;">
                @if(isset($UserProfileDetail['favourites']) && count($UserProfileDetail['favourites']) > 0 )
                <a onclick="favourite({{ $UserProfileDetail['id'] }},'unfavourite');" class="removefavourite_{{$UserProfileDetail['id']}}" ><i class="fa fa-star fav-star"></i></a>
                @else
                &nbsp;<a onclick="favourite({{ $UserProfileDetail['id'] }},'favourite');" class="makefavourite_{{$UserProfileDetail['id']}}"><i class="fa fa-star-o unfav-star"></i></a>
                @endif
            </span>
            <!-- <button class="btn common-btn">Favorites</button> -->
            <div id="follow-msg">Error</div>
          </div>

          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail profiledetail">
            <h1 class="nw-user-nm">{{ $UserProfileDetail['first_name']." ".$UserProfileDetail['last_name'] }}</h1>
            
            <div class="nw-user-edit profiledetail">
              <div class="nw-dtl-edit">
                <span class="nw-label">Company Name:</span>
                <span id="display_user_company">{{ $UserProfileDetail['company_name'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Company Representative Name:</span>
                <span id="display_user_name">{{ $UserProfileDetail['first_name'] }} {{ $UserProfileDetail['last_name']}}</span>
              </div>
              <!--<div class="nw-dtl-edit">-->
              <!--  <span class="nw-label">Gender:</span>-->
              <!--  <span id="display_user_name">{{ $UserProfileDetail['gender'] }}</span>-->
              <!--</div>-->
              <div class="nw-dtl-edit">
                <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $UserProfileDetail['contact_number'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Address :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                  {{ $UserProfileDetail['address'] }}
                  <br>
                  {{ $UserProfileDetail['cities']['city_name'] }}, {{ $UserProfileDetail['states']['state_name'] }} {{ $UserProfileDetail['zipcode'] }}
                  <br>
                  {{ $UserProfileDetail['countries']['country_name'] }}                  
                  <div class="clearfix"></div>
                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                </span>
              </div>

              <div class="nw-dtl-edit">
                <span class="nw-label">About Company :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                   @if(isset($UserProfileDetail['ProfessionalDetail']->about_company)) {!! nl2br(ucfirst($UserProfileDetail['ProfessionalDetail']->about_company)) !!} @else - @endif
                </span>
              </div>

              <!-- <div class="nw-dtl-edit">-->
              <!--  <span class="nw-label">About Business :  </span>-->
              <!--  <span class="nw-detail-txt" id="display_user_address">-->
              <!--     @if(isset($UserProfileDetail['ProfessionalDetail']->about_business)) {!! nl2br(ucfirst($UserProfileDetail['ProfessionalDetail']->about_business)) !!} @else - @endif-->
              <!--  </span>-->
              <!--</div> -->
                  
            </div>
          </div>
          <div class="nw-user-detail-line"></div>
        </div>
      </div>
      <div class="clearfix"></div>

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

          <?php $ProfessionalDetail = $UserProfileDetail['ProfessionalDetail'];?>

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
                        <h4>Experience Level:</h4> <?php if(!empty($ProfessionalDetail->experience_level)){ 
                        $d = json_decode($ProfessionalDetail->experience_level);
                        foreach($d as $experience_level){
                        echo ucfirst($experience_level).", ";
                        } }else { echo "-"; } ?>
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

                  <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                      <span></span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                      <div class="job_post_dtls">
                        <h4>Availability:</h4>
                        @if(isset($ProfessionalDetail->availability))
                        <?php $availability = json_decode($ProfessionalDetail->availability); 
                        $i=1;
                        // foreach($availability as $k => $av){
                        //   if($i % 2 == 0)
                        //   {echo ucfirst(str_replace('_',' ',$k))."-".$av."<br>";}
                        //   else{echo ucfirst(str_replace('_',' ',$k))."-".$av."  -  ";}
                        //   $i++;
                        // }
                        ?>
                          
                        @else - @endif
                      </div>
                    </div>
                  </div>

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
                          <?php $languages = json_decode($ProfessionalDetail->languages);
                          if(!empty($languages)){
                            $i=1;
                        foreach($languages as  $av){
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

            <?php $employmenthistories = $UserProfileDetail['employmenthistory']; ?>

            @if($employmenthistories !=null  && count($employmenthistories) > 0)
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

            <?php $educations = $UserProfileDetail['education']; ?>

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

            <?php $certifications = $UserProfileDetail['certification']; ?>

            @if($certifications !=null && count($certifications) > 0)
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

            <?php $services = $UserProfileDetail['service']; ?>

            @if($services != null && count($services) > 0)
              @foreach($services as $service)
                @if(isset($sports_names[$service['sport']]))

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
                          {{ @$sports_names[$service['sport']] }}
                          </h1>
                      </div>
                      <div class="col-md-12" style="padding-left: 0px;">
                        <div class="col-md-6" style="padding-left: 0px;">
                          <p><b>Title: </b>{{ $service['title'] }}</p>
                          <p><b>Price: </b>{{ $service['price'] }}</p>
                          <p><b>Description: </b>{{ $service['servicedesc'] }}</p>

                          @if(isset($businessType[$service['servicetype']]))
                            <p><b>Service Type: </b>{{ $businessType[$service['servicetype']] }}</p>
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
                            <p><b>Experience Level: </b> {{ json_decode($service['experience_level']) }}</p>
                          @endif
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                            @if(isset($numberOfPeople[$service['numberofpeople']]))
                              <p><b>Number of People: </b>{{ $numberOfPeople[$service['numberofpeople']] }}</p>
                            @endif
                            @if($service['servicelocation'] != '')
                              <p><b>Place: </b>
                             {{--   @if($service['servicelocation'] == "indoor")
                              {{ $serviceLocation[$service['servicelocation']] }}</p>
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
                @endif
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

    <div class="row"></div>

    </div>

</div>
@include('includes.followers_script')
