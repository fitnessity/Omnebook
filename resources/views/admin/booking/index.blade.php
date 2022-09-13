@extends('admin.layouts.layout')



@section('content')

    

    <div id="systemMessage"></div>

    

    <div class="panel panel-default">



        <div class="panel-heading">

            List

        </div>



        <div class="panel-body">

        <div class="table-responsive">
          <table border="0" cellspacing="5" cellpadding="5" style="float: right;">

          <tbody><tr>

              <td>

              <!-- {!! Form::select('status', [

                 'All' => 'Show All',

                 'Open to All' => 'Open to All',

                 'Confirmation Pending' => 'Confirmation Pending',

                 'Booked' => 'Booked',

                 'Rejected' => 'Rejected'], null, (['class' => 'form-control','id' => 'status'])

              ) !!} -->

              <select id="status" name="status" class="form-control bookings_page">

              <option value="All">Show All</option>

              <option value="Open to All" class="boking-openall-text">Open to All</option>

              <option value="Confirmation Pending" class="booking-pending-text">Confirmation Pending</option>

              <option value="Booked" class="booking-booked-text">Booked</option>

              <option value="Rejected" class="booking-rejected-text">Rejected</option>

              </select>



              </td>

          </tr></tbody></table>

          <br><br>



            <table id="bookings_list" class="table table-bordered table-striped {{ count($bookings) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>

                    <tr>

                      <th>#</th>

                      <th>Booking Type</th>

                      <th>Customer Name</th>

                      <th>Customer Email</th>

                      <th>Business Name</th>

                      <th>Business Email</th>

                      <th>Sports</th>

                      <th>Status</th>

                      <th>Created Date</th>

                      <th>Action</th>

                    </tr>

                </thead>

                

                <tbody>

                @if (count($bookings) > 0)

                <?php $j = 0 ?>

                    @foreach ($bookings as $value)

                      <?php $j++ ?>

                  <tr id="item-{!! $value->id !!}">

                  <td>{{$j}}</td>

                  <td>{{ $value->booking_type }}</td>

                  <td>{{ @$value->user['firstname'].' '.@$value->user['lastname'] }}</td>

                  <td>{{ @$value->user['email'] }}</td>

                  <td>{{ @$value->businessuser['firstname'].' '.@$value->businessuser['lastname'] }}</td>

                  <td>{{ @$value->businessuser['email'] }}</td>

                  <td>{{ @$sportsList[$value->UserBookingDetail['sport']] }}</td>

                  <td>

                    @if($value->status == "confirmed") <span class="booking-booked-text">Booked</span>

                    @elseif($value->status == "rejected") <span class="booking-rejected-text"> Rejected </span>

                    @elseif($value->business_id != null && $value->status == "requested")  <span class="booking-pending-text">Confirmation Pending</span>

                    @elseif($value->business_id == null && $value->status == "requested") <span class="boking-openall-text"> Open to All </span>

                    @endif

                  </td>

                  <!-- <td>{{ date('m/d/Y', strtotime($value->created_at)) }}</td> -->

                  <td><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($value->created_at)); ?> </td>

                  <td>

                   @if($value->booking_type == "direct")

                    <a href="\admin\bookings\directHireDetails\{{$value->id}}" title="Click for more details" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>

                   @else

                    <a href="\admin\bookings\quickHireDetails\{{$value->id}}" title="Click for more details" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>

                   @endif 

                  </td>

                  </tr>

                    @endforeach

                @else

                    <tr>

                        <td colspan="10">no record found</td>

                    </tr>

                @endif

                </tbody>

            </table>
        </div>

        </div>

    </div>



<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

<?php if(count($bookings)){?>

<script>

$(document).ready(function (){



     var table = $('#bookings_list').DataTable({

      "paging": true,

      "ordering": true,

      "info": true,

      "aoColumnDefs": [

        {

           bSortable: false,

           aTargets: [ -1,-10 ]

        }

      ],

      'aaSorting': [],

      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],

      "iDisplayLength": 20,

      "language": {

        "emptyTable": "No Records Found.",

        "zeroRecords": "No Records Found.",

        "searchPlaceholder" : "Name/Email/Sports"

      }

    });



  $.fn.dataTable.ext.search.push(

    function( settings, data, dataIndex ) {

        var status = $('#status').val();

        

        var status_clm = data[7]; 



        if ( ( status == 'All' ) ||

             ( status == 'Open to All' && $.trim(status_clm) == 'Open to All' ) ||

             ( status == 'Confirmation Pending' && $.trim(status_clm) == 'Confirmation Pending' ) ||

             ( status == 'Booked' && $.trim(status_clm) == 'Booked' ) ||

             ( status == 'Rejected' && $.trim(status_clm) == 'Rejected' ) )

        {

            return true;

        }

        return false;

    }

  );



  $('#status').on('change', function (e) {

      table.draw();

  });

});

</script>

<?php } ?>

@endsection