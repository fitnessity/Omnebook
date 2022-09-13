@extends('admin.layouts.layout')



@section('content')  

    

    <div id="systemMessage"></div>



      <div class="panel panel-default">



        <div class="panel-heading">

            List

        </div>



        <div class="panel-body">

         {!! Form::open(array('route' => 'delete-reportedfeeds', 'id' => 'reportedFeedlist')) !!}

          <div class="table-responsive">
            <table id="reportedfeed_list" class="table table-bordered table-striped {{ count($reportedFeeds) > 0 ? 'datatable' : '' }} table-hover ">

              <thead>

              <tr>

                <th><input type="checkbox" id="checkAll"></th>

                <th>Post Title</th>

                <th>Post Owner Name</th>

                <th>Comment</th>

                <th>Commented By</th>

                <th>Reported By</th>

                <th>Report Notes</th>

                <th>Reported Date</th>

                <th>Action</th>

              </tr>

              </thead>

              <tbody>

               @if (count($reportedFeeds) > 0)  

              @foreach ($reportedFeeds as $value)

              <tr id="item-{!! $value->id !!}">

                <td><input type="checkbox" name="reportedFeedIds[]" value="{{$value->id}}"></td>

                 <td>@if ($value->reportedFeed)

                        <span title="{{@$value->reportedFeed->content}}">

                        {{ str_limit($value->reportedFeed->content, 50)}}

                        </span>

                      @endif

                  </td>

                  <td>{{ $value->feedOwner->firstname." ".$value->feedOwner->lastname}}</td>

                  @if ($value->reportedComment)

                  <td><span title="{{@$value->reportedComment->content}}">

                    {{ str_limit($value->reportedComment->content,50)}}

                    </span>

                  </td>

                  <td>{{ $value->commentOwner->firstname." ".$value->commentOwner->lastname}}</td>

                  @else

                  <td>-</td>

                  <td>-</td>

                  @endif

                  

                   <td>{{ $value->reportedBy->firstname." ".$value->reportedBy->lastname }}</td>

                      <td> <span title="{{@$value->report_notes}}">{{@ str_limit($value->report_notes,50)}}</span></td>

                   <td><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($value->created_at)); ?></td>

                  

                  <td>

                      <a href="\admin\reportedfeeds\view\{{$value->id}}" title="Click to view {{@$$value->report_notes}}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>

                      @if(!$value->is_deleted)

                      <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Delete {{@$value->report_notes}}"  class="delete-item btn btn-xs btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>

                      @endif

                      <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Allow {{@$value->report_notes}}"  class="allow-item btn btn-xs btn-info"><i class="fa fa-check" aria-hidden="true"></i></a>

                  </td>

              </tr>

              @endforeach

              @else

                  <tr>

                      <td colspan="9">no record found</td>

                  </tr>

              @endif



              </tbody>

              @if (count($reportedFeeds) > 0)

                 <tfoot>

                    <th colspan="2">

                    <button type="submit" id="submit_delete_reportedfeeds" name="submit_delete_reportedfeeds" class="btn btn-danger btn-xs" title="Delete Selected Posts" onclick="return confirm('Deleting these post will delete all it\'s content and comments. If any of post is shared then those shares post will be deleted too. Are you sure you want to delete these selected post?');" value="1"><i class="fa fa-ban" aria-hidden="true"></i></button>

                     <button type="submit" id="submit_allow_reportedfeeds" name="submit_delete_reportedfeeds" class="btn btn-info btn-xs" title="Allow Selected Posts" onclick="return confirm('Are you sure you want to allow these selected post?');" value="2"><i class="fa fa-check" aria-hidden="true"></i></button>

                    </th>

                    <th colspan="5"></th>

                </tfoot>

                 @endif

          </table>
          </div>

      

         {!! Form::close() !!}

        </div>

      </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

<script>

 var moduleConfig = {

        deletePlanUrl: '{!! route('delete-reportedfeed') !!}',

        allowFeedUrl: '{!! route('allow-reportedfeed') !!}'        

    };

@if(count($reportedFeeds))

$(document).ready(function (){



  var table = $('#reportedfeed_list').DataTable({

      "paging": true,

      "ordering": true,

      "info": true,

      "aoColumnDefs": [

        {

           bSortable: false,

           aTargets: [ -1,-9]

        }

      ],

      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],

      "iDisplayLength": 20,

      "language": {

        "emptyTable": "No Records Found.",

        "zeroRecords": "No Records Found."

      },

       'aaSorting': [[1, 'asc']]

    });



  $.fn.dataTable.ext.search.push(

    function( settings, data, dataIndex ) {

        return true;

    }

  );



  // $('#status').on('change', function (e) {

  //     table.draw();

  // });



  $('#checkAll').on('click', function(){

      // Get all rows with search applied

      var rows = table.rows({ 'search': 'applied' }).nodes();

      // Check/uncheck checkboxes for all rows in the table

      $('input[type="checkbox"]', rows).prop('checked', this.checked);

   });

});

@endif

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

        jQuery("#item-" + elementId ).remove();

        if(jQuery("tbody").children('tr').length == 0){

          jQuery("tbody").append('<tr><td colspan="9">no record found</td></tr>');

          jQuery("#reportedfeed_list_info").hide();

          jQuery("#reportedfeed_list_paginate").hide();

          jQuery("tfoot").hide();

        }

        showSystemMessages('#systemMessage', 'success', 'Deleted Post Successfully!');

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

        jQuery("#item-" + elementId ).remove();

        if(jQuery("tbody").children('tr').length == 0){

          jQuery("tbody").append('<tr><td colspan="9">no record found</td></tr>');

          jQuery("#reportedfeed_list_info").hide();

          jQuery("#reportedfeed_list_paginate").hide();

          jQuery("tfoot").hide();

        }

        showSystemMessages('#systemMessage', 'success', 'Allowed Post Successfully!');

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