@extends('admin.layouts.layout')
@section('content')
    <div id="systemMessage"></div>
    <p>
        <a href="{!! route('create-new-getstarted') !!}" class="btn btn-success">Add New</a>
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
                  <option value="Yes">Active</option>
                  <option value="No">Inactive</option>
              </select>
            </div>

            <!-- <div class="col-md-2" style="float:right;">
              <input type="text" name="filter-title" id="filter-title" class="form-control">
            </div> -->

          </div>
        </div>

        <div class="panel-body">

        {!! Form::open(array('route' => 'delete-plans', 'id' => 'planlist')) !!}

            <div class="table-responsive">
              <table id="online_list" class="table table-bordered table-striped {{ count($getstarted) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>
                    <tr>
                      <!-- <th><input type="checkbox" id="checkAll"></th> -->
                      <th>Image</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($getstarted) > 0)
                    <?php $i = 0 ?>
                        @foreach ($getstarted as $value)
                          <?php $i++ ?>
                            <tr id="item-{!! $value->id !!}">
                               <!--  <td><input type="checkbox" name="onlineIds[]" value="{{$value->id}}"></td> -->
                                <td><img src="{{ asset('public/uploads/getstarted/thumb/'.$value->image) }}" width="150" height="auto" /></td>
                                <td>{{ $value->title}}</td>
                              
                                <td>
                                  <a href="\admin\getstarted\edit\{{$value->id}}" title="Click to edit {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                  <a href="\admin\getstarted\delete\{{$value->id}}" title="Click to delete {{@$value->title}}" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">no record found</td>
                        </tr>
                    @endif
                </tbody>


                 <tfoot>

                    <th>

                    <button type="submit" id="submit_delete_online" name="submit_delete_online" class="btn btn-danger btn-xs" title="Deactivate Selected Plans" onclick="return confirm('Do you really want to deactivate selected Plans?');" value="1"><i class="fa fa-ban" aria-hidden="true"></i></button>

                    </th>

                    <th colspan="6"></th>

                </tfoot>

            </table>
            </div>

        {!! Form::close() !!}

        </div>

    </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

<?php if(count($getstarted)){?>

<script>



  $(function () {

     var oTable;

      oTable = $('#online_list').DataTable({

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

        var status              = $('#filter-select').val(),

            status_clm          =  data[5];

        

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



  var moduleConfig = {

        deleteSliderUrl: '{!! route('delete-online') !!}',

        //deactivatePlanUrl: '{!! route('deactivate-plan') !!}',

        //activatePlanUrl: '{!! route('activate-plan') !!}'

  };



  jQuery(document).ready(function()

  {

      jQuery('.delete-item').on('click', function()

      {

          deletePlan(this);

      });



      jQuery('.active-item').on('click', function()

      {

            activePlan(this);

      });

  });



  function deletePlan(element)

  {

    var status    = confirm("Are you Sure want to Deactivate Membership Plan ?"),

        elementId = jQuery(element).data('id');



    if(status == false)

    {

      return false;

    }



    jQuery.ajax({

      url: moduleConfig.deactivatePlanUrl,

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

          jQuery("#item-" + elementId ).find(".is_deleted_column").html('No');

          setTimeout(function(){

               window.location.reload(1);

            }, 2000);

          showSystemMessages('#systemMessage', 'success', 'Deactivated Membership Plan Successfully!');

        }

      },

      error: function(data)

      {

        showSystemMessages('#systemMessage', 'danger', 'Unable to Deactivated Membership Plan');

      }

    });

  }



  function activePlan(element)

  {

    var status    = confirm("Are you Sure want to Activate Membership Plan ?"),

        elementId = jQuery(element).data('id');



    if(status == false)

    {

      return false;

    }



    jQuery.ajax({

      url: moduleConfig.activatePlanUrl,

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

          jQuery("#item-" + elementId ).find(".is_deleted_column").html('No');

          setTimeout(function(){

               window.location.reload(1);

            }, 2000);

          showSystemMessages('#systemMessage', 'success', 'Activated Membership Plan Successfully!');

        }

      },

      error: function(data)

      {

        showSystemMessages('#systemMessage', 'danger', 'Unable to Activated Membership Plan');

      }

    });

  }

</script>

<?php } ?>

@endsection