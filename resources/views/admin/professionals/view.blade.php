@extends('admin.layouts.layout')

@section('content') 

<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php
                if($professional['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$professional['profile_pic'])) {
                    echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$professional['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:230px"/>';
                }
                else {
                    echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:230px"/>';
                }
                ?>

              <h3 class="profile-username text-center"><?php echo ucfirst($professional['firstname']).' '.ucfirst($professional['lastname']); ?></h3>
              <h4 class="text-center">
                @if($professional['status'] == "review_pending")
                  <span class="booking-pending-text">Under Fitnessity Review</span>
                @else
                @if($professional['status'] == "draft")
                  <?php $class = "booking-openall-text" ?>
                @elseif($professional['status'] == "approved")
                  <?php $class = "booking-booked-text" ?>
                @elseif($professional['status'] == "rejected")
                  <?php $class = "booking-rejected-text" ?>
                @endif
                  <span class="<?=$class?>"><?php echo ucfirst($professional['status']); ?></span>
                @endif
              </h4>
              <p class="text-center booking-rejected-text">
                @if($professional['status'] == "rejected")
                  ( {{ $professional['rejected_reason'] }} )
                @endif
              </p>

              <p class="text-muted text-center">&nbsp;</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
              <p class="text-muted">
                @if(isset($professional['city'])) {{ $professional->cities->city_name }}, @endif 
                @if(isset($professional['state'])) {{ $professional->states->state_name }} @endif 
                @if(isset($professional['zipcode'])) {{ $professional['zipcode'] }} @endif
              </p>
              <hr>
              <strong>Profession Type: </strong>
              <p class="text-muted">  
                @if(isset($professional->ProfessionalDetail->professional_type))
                  {{ ucwords($professional->ProfessionalDetail-> professional_type )}}
                @else &nbsp;&nbsp;-
                @endif
              </p>
              <hr>
                <strong>Experience Level: </strong>
                <p class="text-muted">  
                @if(isset($professional->ProfessionalDetail->experience_level))
                  {{ ucwords($professional->ProfessionalDetail->experience_level )}}
                @else &nbsp;&nbsp;-
                @endif
              </p>
              <hr>
                <strong>Provides training to: </strong>
                <p class="text-muted">  
                  @if(isset($professional->ProfessionalDetail->train_to))
                    {{ ucwords(str_replace(",", ", ", $professional->ProfessionalDetail->train_to )) }} 
                   @else &nbsp;&nbsp;- 
                  @endif
                </p>
              <hr>
                <strong>Availability: </strong>
                <p class="text-muted">  
                  @if(isset($professional->ProfessionalDetail->availability))
                    {{ ucwords(str_replace(",", ", ", $professional->ProfessionalDetail->availability)) }}
                  @else &nbsp;&nbsp;-  
                  @endif  
                </p>
              <hr>
                <strong>Willing To Travel: </strong>
                <p class="text-muted">  
                  @if(isset($professional->ProfessionalDetail->willing_to_travel))
                  {{ ucwords(str_replace(",", ", ", $professional->ProfessionalDetail->willing_to_travel)) }}
                  @if($professional->ProfessionalDetail->willing_to_travel && isset($professional->ProfessionalDetail->travel_miles))
                    , {{ $professional->ProfessionalDetail->travel_miles }} Miles
                  @endif
                  @else No
                  @endif
                  <br>
                  @if(isset($professional->ProfessionalDetail->travel_times)) {{ ucfirst($professional->ProfessionalDetail->travel_times) }}@endif
                </p>
              <hr>
                <strong>Languages: </strong>
                <p class="text-muted">  
                    @if(isset($professional->ProfessionalDetail->languages))
                        {{ ucwords(str_replace(",", ", ", $professional->ProfessionalDetail->languages)) }}
                    @else - @endif
                </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#work-history-tab" data-toggle="tab">Work History</a></li>
              <li><a href="#education-tab" data-toggle="tab">Education</a></li>
              <li><a href="#certification-tab" data-toggle="tab">Certification</a></li>
              <li><a href="#services-tab" data-toggle="tab">Services</a></li>
            </ul>
            <div class="tab-content">

               <div class="active tab-pane" id="profile">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name :</label>
                    <div class="col-sm-10 toppadding7"> {{ $professional['firstname'] }} {{ $professional['lastname'] }} </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Gender :</label>
                    <div class="col-sm-10 toppadding7"> @if($professional['gender'] != "") {{ $professional['gender'] }} @else - @endif</div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email :</label>
                    <div class="col-sm-10 toppadding7"> @if($professional['email'] != "") {{ $professional['email'] }} @else - @endif</div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Phone :</label>
                    <div class="col-sm-10 toppadding7"> @if($professional['phone_number'] != "") {{ $professional['phone_number'] }} @else - @endif</div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Address :</label>
                    <div class="col-sm-10 toppadding7">
                        @if(isset($professional['address'])) {{ $professional['address'] }} @else - @endif
                      <br>
                    @if(isset($professional['city'])) {{ $professional->cities->city_name }}, @endif 
                    @if(isset($professional['state'])) {{ $professional->states->state_name }} @endif 
                    @if(isset($professional['zipcode'])) {{ $professional['zipcode'] }} @endif
                    <br>
                    @if(isset($professional['country'])) {{ $professional->countries->country }}  @endif
                </div>
                  </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">About :</label>
                  <div class="col-sm-10 toppadding7">
                      @if(isset($professional->ProfessionalDetail->about_me)) {!! nl2br($professional->ProfessionalDetail->about_me) !!} @else - @endif    
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">About Business :</label>
                  <div class="col-sm-10 toppadding7">
                      @if(isset($professional->ProfessionalDetail->about_business)) {!! nl2br($professional->ProfessionalDetail->about_business) !!} @else - @endif    
                  </div>
                </div>

                </form>
              </div>

              <div class="tab-pane" id="work-history-tab">
                @if(isset($professional->employmenthistory) && count($professional->employmenthistory))
                  
                  <div class="job_listing">
                    <div class="row">
                      <div class="nw-user-detail-sumry">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry profiledetail">
                          <h3>Experience</h3>
                          <div class="clearfix"></div>
                          @foreach($professional->employmenthistory as $employmenthistory)
                          <span class="timenplace border-rgt">
                            {{ date('d M, Y', strtotime($employmenthistory['service_start'])) }} -
                            @if($employmenthistory['is_present'] == 1)
                                Till Date
                            @else
                              {{ date('d M, Y', strtotime($employmenthistory['service_end'])) }}
                            @endif
                          </span><br>
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
                  <div class="col-md-12 text-center text-bold">No Work History Found !</div>
                @endif
              </div>
              <div class="tab-pane" id="education-tab">
                @if(isset($professional->education) && count($professional->education))
                  @foreach($professional->education as $education)
                    <div class="job_listing">
                      <div class="row">
                      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                          <div class="jb-title">
                            <h3> {{ ucwords($education['course']) }}</h3>
                          </div>
                          <p>{{ ucwords($education['university']) }}</p>
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
                  <div class="col-md-12 text-center text-bold">No Education Found !</div>
                @endif
              </div>

              <div class="tab-pane" id="certification-tab">
                @if(isset($professional->certification) && count($professional->certification))
                  @foreach($professional->certification as $certification)
                    <div class="job_listing">
                      <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                          <div class="jb-title">
                            <h3>{{ ucwords($certification['title']) }}</h3>
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
                  <div class="col-md-12 text-center text-bold">No Certification Found !</div>
                @endif
              </div>

              <div class="tab-pane" id="services-tab">

                @if(isset($professional->service) && count($professional->service))
                  @foreach($professional->service as $service)
                    @if(isset($sports_names[$service['sport']]))
                    <div class="job_listing">
                      <div class="row">
                      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                          <div class="jb-title">
                            <h1>{{ ucwords($sports_names[$service['sport']]) }}</h1>
                          </div>
                          <p> {{  ucwords($service['title']) }}</p>
                          <p> {{ $service['price'] }}</p>
                          <p> {{ ucwords($service['servicedesc']) }}</p>
                          <div class="job_post_dtls">
                          </div>
                        </div>
                      </div>
                  </div>
                  @endif
                @endforeach
              @else
                <div class="col-md-12 text-center text-bold">No Services Found !</div>
              @endif
              </div>

            <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center">          

                <span id="currentBookingStatus">
                  @if($professional->status == 'review_pending') 
                    <span id="actionBtnContainer-{{ $professional->id }}">
                      <a href="javascript:void(0);" data-id="{{ $professional->id }}" data-status="approved" title="Click to Approve Professional" class="professional-current-status btn btn-success"><i class="fa fa-check" aria-hidden="true"> Approve</i></a>

                      <a href="javascript:void(0);" data-title="{{ $professional->firstname . " ". $professional->lastname }}"  data-id="{{ $professional->id }}" data-status="rejected" title="Click to Reject Professional" class="professional-current-status btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Reject</a>
                    </span>
                  @endif
                </span>
                <a href="\admin\professionals" class="btn btn-primary"><i class="fa fa-fw fa-mail-reply"></i>
                   Return
                </a>
              </div>
            </div>
          </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>

<!-- Modal Box-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject Professional <span id="professionalName"></span></h4>
      </div>
      <div class="modal-body">
        <p>
          Provide Reason to Reject Professional
          <hr>
          <textarea name="reason" class="form-control" id="reason"></textarea>
        </p>
        <center>

        <input type="hidden" name="reject_professional_id" id="rejectProfessionalId" value="0"> 
          <button id="rejectProfessional" onclick="rejectProfessionalWithReason();"  class="btn btn-primary">Reject Professional</button>
        </center>
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>


<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">      
<script type="text/javascript">

var moduleConfig = {
         approveProfUrl: '{!! route('approve-professional') !!}',
         deleteProfUrl: '{!! route('delete-professionals') !!}',
         rejectProfUrl: '{!! route('reject-professional') !!}'
    };


jQuery(document).on('click', '.professional-current-status', function(event)
{
  changeProfessionalStatus(this);
});

 function changeProfessionalStatus(element)
  {
    var userId      = jQuery(element).attr('data-id'),
        userStatus  = jQuery(element).attr('data-status');
    
    if(userStatus == "approved")
    {
      approveSingleProfessionals(userId, userStatus);
    }
    
    if(userStatus == "rejected")
    {
      var userTitle = jQuery(element).attr('data-title');

      jQuery("#professionalName").html(userTitle);

      jQuery("#rejectProfessionalId").val(userId);
      jQuery("#myModal").modal('show');
    }
  }

  function rejectProfessionalWithReason()
  {
    var userId          = jQuery("#rejectProfessionalId").val(),
        rejectionReason = jQuery("#reason").val();

      if(userId == 0)
      {
        return;
      }

      if(rejectionReason.length < 1) 
      {
        alert("Please Provide Rejection Reason to Continue.");
        jQuery("#reason").focus();
        return;
      }

      jQuery('#myModal').modal('hide');
      
      var token = jQuery("#ajaxToken").val();

      jQuery.ajax({
        url: moduleConfig.rejectProfUrl,
        type: 'POST',
        dataType: 'JSON',
        data: {
            'professionalId':     userId,
            'userReason':         rejectionReason,
            '_token':             token
        },
        success: function(data)
        {
          if(data.status == true)
          {
            jQuery("#currentBookingStatus").html('<span class="btn btn-danger disabled">Profile Rejected</span>');
            showSystemMessages('#systemMessage', 'success', 'Rejected Professionals Successfully!');
          }else {
            showSystemMessages('#systemMessage', 'danger', 'Some error occured while rejecting Professionals');
          }
        },
        error: function(data)
        {
          showSystemMessages('#systemMessage', 'success', 'Some error occured while approving Professionals');
        }
      });
  }
  function approveSingleProfessionals(userId, userStatus)
  {
    var token = jQuery("#ajaxToken").val();

    jQuery.ajax({
      url: moduleConfig.approveProfUrl,
      type: 'POST',
      dataType: 'JSON',
      data: {
          'professionalIds':    userId,
          'userStatus':         userStatus,
          'singleProfessional': true, 
          '_token':             token
      },
      success: function(data)
      {
        if(data.status == true)
        {
          jQuery("#currentBookingStatus").html('<span class="btn btn-success disabled">Profile Approved</span>');
          showSystemMessages('#systemMessage', 'success', 'Approved Professionals Successfully!');
        }else {
          showSystemMessages('#systemMessage', 'danger', 'Some error occured while approving Professionals');
        }
      },
      error: function(data)
      {
        showSystemMessages('#systemMessage', 'success', 'Some error occured while approving Professionals');
      }
    });

  }
</script>    
@endsection