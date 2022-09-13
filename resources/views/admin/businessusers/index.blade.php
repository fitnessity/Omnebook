@extends('admin.layouts.layout')



@section('content')



    <div id="systemMessage"></div>



    <div class="panel panel-default">



        <div class="panel-heading">

            List

        </div>

        <div class="panel-body">

          <div class="row">

            

            <div class="col-md-2 manage_professionals" style="float:right;">

              <select id="filter-select" name="filter-select" class="form-control">

                <option value="Yes">Active</option>

                <option value="No">Inactive</option>

                <option value="Approved" class="booking-booked-text">Approved</option>

                <option value="Rejected" class="booking-rejected-text">Rejected</option>

                <option value="Under Fitnessity Review" class="booking-pending-text">Under Fitnessity Review</option>

              </select>



            </div>

            <div class="col-md-2 manage_professionals" style="float:right;">

              <select id="filter-user-type" name="filter-user-type" class="form-control">

                  <option value="">All Business User</option>

                @foreach ($businessType as $bkey => $bval)

                  <option value="{{ $bval }}">{{ $bval }}</option>

                @endforeach

              </select>



            </div>

            <!-- <div class="col-md-2" style="float:right;">

              <input type="text" name="filter-title" id="filter-title" class="form-control">

            </div> -->

          </div>

        </div>

        <div class="panel-body">

            <!-- {!! Form::open(array('route' => 'delete-professionals', 'id' => 'professionallist')) !!} -->

             {!! Form::open(array('id' => 'professionallist')) !!}

            <input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

            <div class="table-responsive">
              <table id="professional_list" class="table table-bordered table-striped {{ count($professionals) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>

                    <tr>

                      <th style="text-align:right;" class="manage_business_checkbox"><input type="checkbox" id="checkAll"></th>

                      <th>Profile Pic</th>

                      <th>Name</th>

                      <th>Email</th>

                      <th>Profession Type</th>

                      <th>Company Name</th>                      

                      <th>Phone Number</th>                      

                      <th>Address</th>

                      <th>City</th>

                      <th>State</th>

                      <th>Status</th>

                      <th>Is Active</th>

                      <th>Action</th>

                    </tr>

                </thead>

                

                <tbody>

                    @if (count($professionals) > 0)

                        @foreach ($professionals as $value)

                            <tr id="item-{!! $value->id !!}">

                                <td style="text-align:center;"><input type="checkbox" name="professionalIds[]" value="{{$value->id}}" class="prof_ids"></td>

                                <td>

                                  <center>

                                    @if($value->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$value->profile_pic))

                                      <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB150').$value->profile_pic; ?>" height="70px" width="70px"/>

                                    @endif

                                  </center>

                                </td>

                                <td><a href="\admin\businessusers\view\{{$value->id}}" title="Click to view{{@$value->title}}">{{ $value->firstname . " ". $value->lastname}}</a></td>

                                <td>{{ $value->email}}</td>

                                <td>{{ ucfirst(@$value['ProfessionalDetail']['professional_type']) }}</td>

                                <td>{{@$value->company_name}}</td>

                                <td>{{ $value->phone_number}}</td>

                                

                                <td>{{ $value->address}}</td>

                                <td>@if(isset($value->cities->city_name)) {{ $value->cities->city_name }} @endif</td>

                                <td>@if(isset($value->states->state_name)) {{ $value->states->state_name }} @endif</td>

                                <td id="currentBookingStatus-{{ $value->id }}">

                                <?php $title = '' ?>

                                @if($value->status == "review_pending")

                                  <span class="booking-pending-text">Under Fitnessity Review</span>

                                @elseif($value->status == "rejected")

                                <span class="booking-rejected-text desc-popover" data-container="body" data-toggle="popover" data-title="Profile Rejected" data-placement="bottom" data-content="{{ $value->rejected_reason }}" data-original-title=""><?php echo ucfirst($value->status); ?></span>

                                @else

                                    @if($value->status == "draft")

                                      <?php $class = "booking-openall-text" ?>

                                    @elseif($value->status == "approved")

                                      <?php $class = "booking-booked-text" ?>

                                    @endif

                                    <span class="<?=$class?>"><?php echo ucfirst($value->status); ?></span>

                                @endif

                                </td>

                                <td>

                                @if($value->is_deleted == 0)

                                  <span class="booking-booked-text">Yes</span>

                                @else

                                  <span class="booking-rejected-text">No</span>

                                @endif

                                </td>

                                <td nowrap>

                                <a href="\admin\businessusers\view\{{$value->id}}" title="Click to view user profile" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                @if($value->status == 'review_pending') 

                                  <span id="actionBtnContainer-{{ $value->id }}">

                                    <a href="javascript:void(0);" data-id="{{ $value->id }}" data-status="approved" title="Click to Approve Professional" class="professional-current-status btn btn-xs btn-primary"><i class="fa fa-check" aria-hidden="true"></i></a>

                                    <a href="javascript:void(0);" data-title="{{ $value->firstname . ''. $value->lastname }}"  data-id="{{ $value->id }}" data-status="rejected" title="Click to Reject Professional" class="professional-current-status btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>

                                  </span>

                                @endif                                  

                                </td>

                                </tr>

                          @endforeach

                    @else

                        <tr>

                            <td colspan="9">no record found</td>

                        </tr>

                    @endif

                </tbody>

                <tfoot>

                  <th style="text-align:center">

                    <button type="submit" id="submit_approve_professional" name="submit_approve_professional" class="btn btn-primary btn-xs" title="Approve Selected Professionals" onclick="return confirm('Are you Sure want to Approve selected Professionals ?');" value="1"><i class="fa fa-check" aria-hidden="true"></i></button>

                    <button id="submit_delete_professional" name="submit_delete_professional" class="btn btn-danger btn-xs"  onclick="return confirm('Are you Sure want to Delete selected Professionals ?');" title="Delete Selected Professionals" value="1"><i class="fa fa-trash" aria-hidden="true"></i></button>

                  </th>

                  <th colspan="6"></th>

              </tfoot>

            </table>

            </div>
            {!! Form::close() !!}

        </div>

    </div>

    

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

<?php if(count($professionals)){?>

<script>

 $( ".desc-popover" ).hover(

                  function() {

                      $( this ).popover('show');

                  }, function() {

                      $( this ).popover('hide');

                  }

            );

  

@if(count($professionals))

  $(function () {

    var table = $('#professional_list').DataTable(

     {

      "paging": true,

      "lengthChange": true,

      "searching": true,

      "ordering": true,

      "aoColumnDefs": [

        {

           bSortable: false,

           aTargets: [ -1,-12,-13]

        }],

      "info": true,

      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],

      "iDisplayLength": 20,

      'aaSorting': [[2, 'asc']],

      "autoWidth": false,

      "language": {

        "searchPlaceholder" : "Name/Email/CompanyName"

      }

    });



    $.fn.dataTable.ext.search.push(

    function( settings, data, dataIndex ) 

    {

        var status              = $('#filter-select').val(),

            status_clm          =  data[11],

            profileStatusArray  = ['Approved', 'Rejected', 'Under Fitnessity Review'];



        var user_type           = $('#filter-user-type').val(),

            user_type_clm       =  data[4];



        if(jQuery.inArray(status, profileStatusArray) !== -1)

        {

          status_clm = data[10];

        }

        

        if(user_type == ''){



          if (status == status_clm)

          {

              return true;

          }



        } else {



          if (status == status_clm && user_type == user_type_clm)

          {

              return true;

          }



        }      

        

        return false;

    }

  );



  table.draw();



  $('#filter-select').on('change', function (e) {

      table.draw();

  });



  $('#filter-user-type').on('change', function (e) {

      table.draw();

  });



  });



 

@endif

  var moduleConfig = {

         approveProfUrl: '{!! route('approve-professional') !!}',

         deleteProfUrl: '{!! route('delete-professionals') !!}',

         rejectProfUrl: '{!! route('reject-professional') !!}'

    };



  jQuery(document).ready(function()

  {

      jQuery('.addToolTip').tooltip();   



      jQuery(document).on('click', '.professional-current-status', function(event)

      {

          changeProfessionalStatus(this);

      });



      // $("#professionallist").submit(function(e){

      //   e.preventDefault();

      // });

      // jQuery('#submit_approve_professional').on('click', function()

      // {

        

      //     if(checkifchecked()) {

      //       approveProfessional();

      //     }

      // });

      // jQuery('#submit_delete_professional').on('click', function()

      // {

      //     if(checkifchecked()) {

      //       deleteProfessional();

      //     }

      // });



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

            jQuery("#actionBtnContainer-" + userId).hide();

            jQuery("#currentBookingStatus-" + userId).html('<span class="booking-rejected-text">Rejected</span>');

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

          jQuery("#actionBtnContainer-" + userId).hide();

          jQuery("#currentBookingStatus-" + userId).html('<span class="booking-booked-text">Approved</span>');

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

  function checkifchecked()

  {

          var checked = false;

          $(".prof_ids").each(function() {

            if(this.checked) {

              checked = true;

            }

          });

          if(!checked) {

            showSystemMessages('#systemMessage', 'danger', 'Please select at least one professional.');

            return false;

          }



          return true;

  }



function approveProfessional()

{

  var formData = $("#professionallist").serialize();

  console.log(formData.professionalIds);

  console.log(formData);

  if(!confirm("Are you Sure want to Approve selected Professionals ?"))

  {

    return false;

  }



  jQuery.ajax({

    url: moduleConfig.approveProfUrl,

    type: 'POST',

    dataType: 'JSON',

    data: formData,

    success: function(data)

    {

      if(data.status == true)

      {

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



function deleteProfessional()

{

  var formData = $("#professionallist").serialize();

  



  if(!confirm("Are you Sure want to Delete selected Professionals ?"))

  {

    return false;

  }



  jQuery.ajax({

    url: moduleConfig.deleteProfUrl,

    type: 'POST',

    dataType: 'JSON',

    data: formData,

    success: function(data)

    {

      if(data.status == true)

      {

        showSystemMessages('#systemMessage', 'success', 'Professionals Deleted Successfully!');

      }else {

        showSystemMessages('#systemMessage', 'danger', 'Some error occured while deleting Professionals');

      }

    },

    error: function(data)

    {

      showSystemMessages('#systemMessage', 'danger', 'Some error occured while deleting Professionals');

    }

  });

}



</script>

<?php } ?>

@endsection