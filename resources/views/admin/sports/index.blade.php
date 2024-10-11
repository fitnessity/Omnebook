@extends('admin.layouts.layout')
@section('content')
    <div id="systemMessage"></div>
    <p>
        <a href="{!! route('create-new-sport') !!}" class="btn btn-success">Add New</a>
    </p>
    <div class="panel panel-default">
      <div class="panel-heading">
          List
      </div>
      <div class="panel-body">
          <div class="row">
            <div class="col-md-2" style="float:right;">
              <select id="filter-select" name="filter-select" class="form-control">
                <option value="All">Show All</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
            <!-- <div class="col-md-2" style="float:right;">
              <input type="text" name="filter-title" id="filter-title" class="form-control">
            </div> -->
          </div>
        </div>
      <div class="panel-body">
       <div class="table-responsive">
         <table id="module_list" class="table table-bordered table-striped {{ count($sports_list) > 0 ? 'datatable' : '' }} table-hover ">
          <thead>
          <tr>
          	<th>#</th>
            <th>Sports Title</th>
            <th>Parent Sport</th>
            <th>Category</th>
            <th>Booking Option</th>
            <th>Image</th>
            <th>Action</th>
            <th style="display: none;"></th>
          </tr>
          </thead>
          <tbody>
          @foreach ($sports_list as $key=>$value)
          	@if($value->is_deleted==0)
          		<tr id="item-{{$value->id}}">
            		<td></td>
            		<td><a href="\admin\sports\edit\{{$value->id}}" title="Click to edit {{@$value->sport_name}}">{{@$value->sport_name}}</a></td>
            		<td>
            			@if($value->parent_sport_id > 0)
                        <a href="\admin\sports\edit\{{$value->parent_sport_id}}" title="Click to edit {{@$value->sport_name}}">{{@$sportsName[$value->parent_sport_id]}}</a>
                        @endif
            		</td>
            		<td>
						      <?php 
                    if($value->category_id){
                      $cat_arr = explode(",",@$value->category_id); 
                        foreach ($cat_arr as $cat_key => $cat_value) {
                          $cat_arr[$cat_key] = $sportCats[$cat_value];
                        }
                      echo implode(", ",@$cat_arr);
                    }
                  ?>
            		</td>
            		<td>
                		{{$value->booking_option}}
           			</td>
            		<td>
                  <center>
                    @if($value->image != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'sports'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$value->image))
                      <img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB').$value->image; ?>" height="70px" width="70px"/>
                    @endif
                  </center>
            		</td>
            		<td>
                  <a href="\admin\sports\edit\{{$value->id}}" title="Click to edit {{@$value->sport_name}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Deactivate {{@$value->sport_name}}" class="delete-item btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
            
						      <?php /*?>@if(!$value->is_deleted)
                        <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Deactivate {{@$value->sport_name}}"  class="delete-item btn btn-xs btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>
                        @elseif($value->is_deleted)
                        <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Activate {{@$value->sport_name}}"  class="active-item btn btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                        @endif<?php */?>
            		</td>
                @if($value->is_deleted)
                <td style="display: none;" id="status-{!! $value->id !!}">Deleted</td>
                @else
                <td style="display: none;" id="status-{!! $value->id !!}"></td>
                @endif
          		</tr>
                @endif
          	@endforeach
          </tbody>
       </table>
       </div>
       <input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
      </div>
     </div>
<?php if(count($sports_list)){?>

<script>
  $(function () {
     var table = $('#module_list').DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "aoColumnDefs": [
        {
           bSortable: false,
           aTargets: [ -2,-3,-7 ]
        }
      ],
      'aaSorting': [[1, 'asc']],
      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
      "iDisplayLength": 20,
      "language": {
        "emptyTable": "No Records Found.",
        "zeroRecords": "No Records Found",
        "searchPlaceholder" : "Title/Category"
      }
    });
    $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) 
    {
        var status              = $('#filter-select').val(),
            status_clm          =  data[6],
            profileStatusArray  = ['Active', 'All'];
        if(jQuery.inArray(status, profileStatusArray) !== -1)
        {
          status_clm = data[6];
		}
        if(status == 'Active') {
            if (status_clm == '')
            {
                return true;
            }
            return false;
        } else if(status == 'Inactive') {
          if (status_clm == 'Deleted')
            {
                return true;
            }
            return false;
        } else {
            return true;

        }
    }
  );

  table.draw();
  $('#filter-select').on('change', function (e) {
      table.draw();
  });
  table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
  var moduleConfig = {
      deactivateSportUrl: '{!! route('deactivate-sport') !!}',
      activateSportUrl: '{!! route('activate-sport') !!}'
  };

  $('.delete-item').on('click', function()
  {
        deleteSport(this);
  });
  function deleteSport(element)
  {
    var status    = confirm("Are you Sure want to Delete this Sport ?"),
        elementId = jQuery(element).data('id');

    if(status == false)
    {
      return false;
    }
    jQuery.ajax({
      url: moduleConfig.deactivateSportUrl,
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
          jQuery("#item-" + elementId ).find(".delete-item").hide();
          jQuery("#status-" + elementId ).append('Deleted');
          setTimeout(function(){
             window.location.reload(1);
          }, 2000);
          showSystemMessages('#systemMessage', 'success', 'Sport Successfully Deactivated!');
        } else {
          showSystemMessages('#systemMessage', 'danger', data.msg);
        }
      },
      error: function(data)
      {
        showSystemMessages('#systemMessage', 'danger', 'Unable to Deactivated Sport');
      }
    });
  }
  $('.active-item').on('click', function()
  {
        activeSport(this);
  });
  function activeSport(element)
  {
    var status    = confirm("Are you Sure want to Activate this Sport ?"),
       elementId = jQuery(element).data('id');
    if(status == false)
    {
      return false;
    }
    jQuery.ajax({
      url: moduleConfig.activateSportUrl,
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
          jQuery("#item-" + elementId ).find(".active-item").hide();
          jQuery("#status-" + elementId ).append('Deleted');
          setTimeout(function(){
             window.location.reload(1);
          }, 2000);
          showSystemMessages('#systemMessage', 'success', 'Sport Successfully Activated!');
        } else {
          showSystemMessages('#systemMessage', 'danger', data.msg);
        }
      },
      error: function(data)
      {
        showSystemMessages('#systemMessage', 'danger', 'Unable to Activated Sport');
      }
    });
  }

  $("#parent_sport_id").change(function () {
        if(this.value == ''){
          $(".categories_picker").css("display", "block");
        } else{
          $(".categories_picker").css("display", "none");
        }
    });
  });

</script>
<?php } ?>
@endsection

