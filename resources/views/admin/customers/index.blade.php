@extends('admin.layouts.layout')
@section('content')

<div id="systemMessage"></div>
<div class="panel panel-default">
	<div class="panel-heading"> List </div>
    <div class="panel-body">
			<table border="0" cellspacing="5" cellpadding="5" style="float: right;">
				<tbody>
          <tr>
						<td>
              <select id="status" name="status" class="form-control">
              <option value="0">Show All</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
              </select>
          	</td>
					</tr>
				</tbody>
			</table>
      <br><br>
			{!! Form::open(array('id' => 'editCustomerDetails')) !!}
        <div class="table-responsive">
          <table id="customers_list" class="table table-bordered table-striped {{ count($allCustomers) > 0 ? 'datatable' : '' }} table-hover ">
            <thead>
              <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Profile Pic</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Status</th>
                <th></th>
                <th>Fitnessity Fee</th>
                <th>Action</th>
                <th style="display: none;">Activated</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($allCustomers as $key=>$value)
                  <tr>
                    <td><input type="checkbox" name="customerIds[]" value="{{$value->id}}"></td>
                    <td>
                      <center>
                        @if($value->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$value->profile_pic))
                          <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB150').$value->profile_pic; ?>" height="70px" width="70px"/>

                        @endif
                      </center>
                    </td>
                    <td><a href="\admin\users\view\{{$value->id}}" title="Click to View user">{{$value->firstname}}  {{$value->lastname}}</a></td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->phone_number}}</td>
                    <td>{{$value->gender}}</td>
                    <td>
                      <!-- {{$value->status}} -->
                      @if($value->status == "draft")
                        <?php $class = "booking-openall-text" ?>
                      @elseif($value->status == "approved")
                        <?php $class = "booking-booked-text" ?>
                      @endif
                      <span class="<?=$class?>"><?php echo ucfirst($value->status); ?></span>
                    </td>
                    <td>
                      <a href="{{route('admin_user_login_as', ['id' => $value->id])}}">Login</a>
                    </td>
                    <td>
                      <input class="fitness-fee-ad" type="text" name="fitness_fee" id="fitness_fee{{$value->id}}" value="{{$value->fitnessity_fee}}"> %
                      <button type="button" class="btn btn-primary fitness-fee-sp" data-id="{{$value->id}}">Update</button>
                    </td>
                    <td>
                      <a href="\admin\users\view\{{$value->id}}" title="Click to view user profile" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      <a href="\admin\users\edit\{{$value->id}}" title="Click to edit user" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td style="display: none;">{{$value->activated}}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <th>
                <button type="submit" id="submit_delete_customers" name="submit_delete_customers" class="btn btn-danger btn-xs" title="Delete Selected Customers" onclick="return confirm('Do you really want to delete selected customers?');" value="1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </th>
                <th colspan="7"></th>
              </tfoot>
          </table>
          </div>

         {!! Form::close() !!}

        </div>

      </div>

<?php if(count($allCustomers)){?>

<script>

$(document).ready(function (){
	var table = $('#customers_list').DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "aoColumnDefs": [
        {
           bSortable: false,
           aTargets: [ -2,-8,-9]
        }
        // {
        //     "targets": [ 2 ],
        //     "visible": false,
        //     "searchable": false
        // }
      ],
      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
      "iDisplayLength": 20,
      "language": {
        "emptyTable": "No Customer Found.",
        "zeroRecords": "No Customer Found.",
        "searchPlaceholder" : "Name/Email"
      },
       'aaSorting': [[2, 'asc']]
    });
	
  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var status = $('#status').val();
        var status_clm = parseInt( data[8] ) || 0; 
        if ( ( status == 0 ) ||
             ( status == 1 && status_clm == 1 ) ||
             ( status == 2 && status_clm == 0 ) )
        {
            return true;
        }
        return false;
    }
  );
  $('#status').on('change', function (e) {
      table.draw();
  });
  $('#checkAll').on('click', function(){
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });


  $('.fitness-fee-sp').on('click', function(){ 
    var uid = $(this).attr('data-id');
    var fitness_fee = $('#fitness_fee'+uid).val();

    $.ajax({
            url: "user/update_fee/",
            type: "POST",
            data:{
                _token: '{{csrf_token()}}', 
                fitness_fee: $('#fitness_fee'+uid ).val() ? $('#fitness_fee'+uid).val() : '15',
                uid: uid
            },
            success:function(response) {
                location.reload()
            },
        });
  });
  
});

</script>

<?php } ?>

@endsection