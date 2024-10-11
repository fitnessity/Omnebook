@extends('admin.layouts.layout')
@section('content') 
<div id="systemMessage"></div>
   
    <div class="panel panel-default">
        <div class="panel-heading">
            List
        </div>

        <div class="panel-body">
            <div class="table-responsive">
              	<table id="activitygetstartedfast_list" class="table table-bordered table-striped {{ count($getstarted) > 0 ? 'datatable' : '' }} table-hover ">
	                <thead>
	                    <tr>
	                      <th><input type="checkbox" id="checkAll"></th>
	                      <th>Image</th>
	                      <th>Title</th>
	                      <th>Small Text</th>
	                      <th>Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @if (count($getstarted) > 0)
	                    <?php $i = 0 ?>
	                        @foreach ($getstarted as $value)
	                          <?php $i++ ?>
	                            <tr id="item-{!! $value->id !!}">
	                                <td><input type="checkbox" name="activitygetstartedfastIds[]" value="{{$value->id}}"></td>
	                                <td><img src="{{ asset('public/uploads/discover/thumb/'.$value->image) }}" width="150" height="auto" /></td>
	                                <td><a href="\admin\plans\edit\{{$value->id}}" title="Click to edit {{$value->title}}">{{$value->title}}</a></td>
					                <td>{{ $value->small_text}}</td>
	                  				<td>
				                       <a href="\admin\activity-get-started-fast\edit\{{$value->id}}" title="Click to edit {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	                  				</td>
	                            </tr>
	                        @endforeach
	                    @else
	                        <tr>
	                            <td colspan="8">no record found</td>
	                        </tr>
	                    @endif
	                </tbody>
            	</table>
            </div>
        </div>
    </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
<?php if(count($getstarted)){?>

<script>

	$(function () {

	     var oTable;
	      oTable = $('#activitygetstartedfast_list').DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
	      "aoColumnDefs": [
	        {
	           bSortable: false,
	           aTargets: [ -1,-7]
	        }],

	      "info": true,
	      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
	      "iDisplayLength": 20,
	      "autoWidth": false,
	      'aaSorting': [[1, 'asc']],
	      "language": {
	        "searchPlaceholder" : "Title/Description"
	      }

	    });

	    $.fn.dataTable.ext.search.push(
	    function( settings, data, dataIndex ) 
	    {
	        var status = $('#filter-select').val(),
	        status_clm =  data[5];
	        if(status == 'Yes') {
				if (status_clm == 'Yes')
	            {
	                return true;
	            }
	            return false;
	        } else if(status == 'No') {
	          if (status_clm == 'No')
	            {
	                return true;
	            }
	            return false;
	        } else {
	          	return true;
	        }
	    });

	    $('#filter-select').on('change', function (e) {
	      console.log('change');
	        oTable.draw();
	    });


	    jQuery('#checkAll').on('click', function()
	    {
	        // Get all rows with search applied
	        var rows = oTable.rows({ 'search': 'applied' }).nodes();
	        console.log(rows);
	        // Check/uncheck checkboxes for all rows in the table
	        jQuery('input[type="checkbox"]', rows).prop('checked', this.checked);
	    });
	});



</script>

<?php } ?>

@endsection