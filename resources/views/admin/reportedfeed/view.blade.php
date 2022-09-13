@extends('admin.layouts.layout')

@section('content') 
<div id="systemMessage"></div>
<div class="row">
        <div class="col-md-4">

        <!-- Reported by Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <?php
              if(@$reportedFeedDetail['reportedBy']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.@$reportedFeedDetail['reportedBy']['profile_pic'])) {
                  echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$reportedFeedDetail['reportedBy']['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              else {
                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              ?>

            <h3 class="profile-username text-center">{{ @$reportedFeedDetail['reportedBy']['firstname'] }} {{ @$reportedFeedDetail['reportedBy']['lastname'] }} (Reported By)</h3>

            <p class="text-center">{{ $reportedFeedDetail['reportedBy']['role'] }}</p>

            <ul class="list-group list-group-unbordered">
              
              <li class="list-group-item">
                <b>Email :</b> <a class="pull-right">@if($reportedFeedDetail['reportedBy']['email'] != "") {{ $reportedFeedDetail['reportedBy']['email'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Phone :</b> <a class="pull-right">@if($reportedFeedDetail['reportedBy']['phone_number'] != "") {{ $reportedFeedDetail['reportedBy']['phone_number'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Gender :</b> <a class="pull-right">@if($reportedFeedDetail['reportedBy']['gender'] != "") {{ $reportedFeedDetail['reportedBy']['gender'] }} @else - @endif</a>
              </li>
              <li class="list-group-item" style="border-bottom: none !important;">
                <b>Address :</b> <a class="pull-right">
                @if(isset($reportedFeedDetail['reportedBy']['address'])) {{ $reportedFeedDetail['reportedBy']['address'] }} @else - @endif
                    <br>
                  @if(isset($reportedFeedDetail['reportedBy']['city'])) {{ @$reportedFeedDetail['reportedBy']->cities->city_name }}, @endif <br>
                  @if(isset($reportedFeedDetail['reportedBy']['state'])) {{ @$reportedFeedDetail['reportedBy']->states->state_name }}, @endif 
                  @if(isset($reportedFeedDetail['reportedBy']['zipcode'])) {{ $reportedFeedDetail['reportedBy']['zipcode'] }} @endif
                  <br>
                  @if(isset($reportedFeedDetail['reportedBy']['country'])) {{ @$reportedFeedDetail['reportedBy']->countries->country }}  @endif</a>
              </li>
            </ul>

          </div>
        </div>

        <!-- Post Owner -->
        @if(count($postOwnerDetails) > 0)
        <div class="box box-danger">
          <div class="box-body box-profile">
            <?php
              if($postOwnerDetails['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$postOwnerDetails['profile_pic'])) {
                  echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$postOwnerDetails['profile_pic'].'" class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              else {
                  echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png"  class="profile-user-img img-responsive img-circle" style="height:180px;width:250px"/>';
              }
              ?>

            <h3 class="profile-username text-center">{{ $postOwnerDetails['firstname'] }} {{ $postOwnerDetails['lastname'] }} ({{$postOwnerDetails->ownerType}})</h3>

            <p class="text-center">{{ $postOwnerDetails['role'] }}</p>

            <ul class="list-group list-group-unbordered">
              
              <li class="list-group-item">
                <b>Email :</b> <a class="pull-right">@if($postOwnerDetails['email'] != "") {{ $postOwnerDetails['email'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Phone :</b> <a class="pull-right">@if($postOwnerDetails['phone_number'] != "") {{ $postOwnerDetails['phone_number'] }} @else - @endif</a>
              </li>
              <li class="list-group-item">
                <b>Gender :</b> <a class="pull-right">@if($postOwnerDetails['gender'] != "") {{ $postOwnerDetails['gender'] }} @else - @endif</a>
              </li>
              
              <li class="list-group-item" style="border-bottom: none !important;">
                <b>Address :</b> <a class="pull-right">
                @if(isset($postOwnerDetails['address'])) {{ $postOwnerDetails['address'] }} @else - @endif
                    <br>
                  @if(isset($postOwnerDetails['city'])) {{ @$postOwnerDetails->cities->city_name }}, @endif <br>
                  @if(isset($postOwnerDetails['state'])) {{ @$postOwnerDetails->states->state_name }}, @endif 
                  @if(isset($postOwnerDetails['zipcode'])) {{ $postOwnerDetails['zipcode'] }} @endif
                  <br>
                  @if(isset($postOwnerDetails['country'])) {{ @$postOwnerDetails->countries->country }}  @endif</a>
              </li>
            </ul>

          </div>
        </div>
        @endif
        </div>
        
     
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Report Notes</a></li>
            </ul>
            <div class="tab-content">
              <div class="row">
                <div class="nw-user-detail-block">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
                      
                      <h3 class="nw-user-nm" style="width:65% !important;text-transform: capitalize;">Report Notes : </h3>
                      <h4><span>{{ $reportedFeedDetail->report_notes }}</span>
                      </h4>
                      <h3 class="nw-user-nm" style="width:65% !important;text-transform: capitalize;">Reported Date : </h3>
                      <h4><span>{{ date("m/d/Y", strtotime($reportedFeedDetail['created_at'])) }}</span>
                      </h4>
                       <!-- <h4>
                          <span>Report Notes : </span>
                          <span>{{ $reportedFeedDetail->report_notes }}</span>
                      </h4>
                      <h4>
                          <span>Reported Date : </span>
                          <span>{{ date("m/d/Y", strtotime($reportedFeedDetail['created_at'])) }}</span>
                      </h4> -->
                    </div>
                </div>
                <!--<div class="nw-user-detail-line"></div>-->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>

        <div class="col-md-4"></div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Reported Post Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="row">
                <div class="nw-user-detail-block">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">

                        @if ($reportedFeedDetail)
                            @if ($reportedFeedDetail->reportedComment)
                              <h3 class="nw-user-nm" style="width:65% !important;text-transform: capitalize;">Below comment is reported.</h3>
                              <h4>
                                <span>{!! getReportedFeedHtmlByType($reportedFeedDetail->reportedFeed,$reportedFeedDetail->reportedComment,$reportedFeedDetail->commentOwner->firstname." ".$reportedFeedDetail->commentOwner->lastname) !!}
                                </span>
                              </h4>
                            @else
                              <h3 class="nw-user-nm" style="width:65% !important;text-transform: capitalize;">Below Post is reported.</h3>
                              <h4>
                                <span>{!! getReportedFeedHtmlByType($reportedFeedDetail->reportedFeed, null) !!} 
                                </span>
                              </h4>
                            @endif
                            <div class="clearfix"></div>
                          @endif
                    </div>
                </div>
                <!--<div class="nw-user-detail-line"></div>-->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>

<!-- Return Link -->
<div class="row">
  <div class="col-md-12">
    <div class="box-footer text-center">          
     <a href="\admin\reportedfeeds" class="btn btn-primary"><i class="fa fa-fw fa-mail-reply"></i> Return</a>
     <a data-id="{!! $reportedFeedDetail->id !!}" href="javascript:void(0);" title="Click to Delete Reported Post/Comment"  class="delete-item btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>
    <a data-id="{!! $reportedFeedDetail->id !!}" href="javascript:void(0);" title="Click to Allow Reported Post/Comment"  class="allow-item btn btn-info"><i class="fa fa-check" aria-hidden="true"></i></a>
    </div>
  </div>
</div>

</div>  
<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
<script>
 var moduleConfig = {
        deletePlanUrl: '{!! route('delete-reportedfeed') !!}',
        allowFeedUrl: '{!! route('allow-reportedfeed') !!}'        
    };

  jQuery('.delete-item').on('click', function()
  {
    deletePlan(this);
  });

  jQuery('.allow-item').on('click', function()
  {
    allowReportedFeed(this);
  });

  function deletePlan(element)
{
  var status    = confirm("Deleting this post will delete all it's content and comments. If this post is shared then those shares post will be deleted too. Are you sure you want to delete this post?"),
      elementId = jQuery(element).data('id');

  if(status == false)
  {
    return false;
  }

  jQuery.ajax({
    url: moduleConfig.deletePlanUrl,
    type: 'POST',
    dataType: 'JSON',
    data: {
      'id': elementId,
      '_token': jQuery("#ajaxToken").val()
    },
    success: function(data)
    {
      if(data.status == true)
      {
        showSystemMessages('#systemMessage', 'success', 'Deleted Post Successfully!');
        setTimeout(function(){
          window.location.replace('/admin/reportedfeeds');
        },1500);
      } else {
        alert('Unable to Delete the Post.');
      }
    },
    error: function(data)
    {
      showSystemMessages('#systemMessage', 'danger', 'Unable to Delete the Post.');
    }
  });
}

function  allowReportedFeed(element)
{
  var status    = confirm("Are you sure you want to allow this post? "),
      elementId = jQuery(element).data('id');

  if(status == false)
  {
    return false;
  }

  jQuery.ajax({
    url: moduleConfig.allowFeedUrl,
    type: 'POST',
    dataType: 'JSON',
    data: {
      'id': elementId,
      '_token': jQuery("#ajaxToken").val()
    },
    success: function(data)
    {
      if(data.status == true)
      {
        showSystemMessages('#systemMessage', 'success', 'Allowed Post Successfully!');
        setTimeout(function(){
          window.location.replace('/admin/reportedfeeds');
        },1500);
      } else {
        alert('Unable to Allow Post');
      }
    },
    error: function(data)
    {
      showSystemMessages('#systemMessage', 'danger', 'Unable to Allow Post');
    }
  });
}
</script>
@endsection