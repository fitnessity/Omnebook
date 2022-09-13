@extends('admin.layouts.layout')



@section('content')

      

    <div id="systemMessage"></div>




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
              <table id="slider_list" class="table table-bordered table-striped {{ count($contact) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>

                    <tr>

                      <th><input type="checkbox" id="checkAll"></th>

                      <th>Name</th>

                      <th>Email</th>

                      <th>Message</th>

                      <th>Action</th>

                    </tr>

                </thead>

                

                <tbody>

                    @if (count($contact) > 0)

                    <?php $i = 0 ?>

                        @foreach ($contact as $value)

                          <?php $i++ ?>

                            <tr id="item-{!! $value->id !!}">

                                <td><input type="checkbox" name="sliderIds[]" value="{{$value->id}}"></td>

                  <td>{{ $value->name}}</td>

                  <td>{{ $value->email}}</td>

                  <td>{{ $value->message}}</td>

                  <td>
                    
                      <a href="\admin\contactdelete\{{$value->id}}" title="Click to delete {{@$value->title}}" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>


                     <!-- @if(!$value->is_deleted)

                      <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Deactivate {{@$value->title}}"  class="delete-item btn btn-xs btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>

                      @elseif($value->is_deleted)

                      <a data-id="{!! $value->id !!}" href="javascript:void(0);" title="Click to Activate {{@$value->title}}"  class="active-item btn btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>

                      @endif-->

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

                    <button type="submit" id="submit_delete_slider" name="submit_delete_slider" class="btn btn-danger btn-xs" title="Deactivate Selected Plans" onclick="return confirm('Do you really want to deactivate selected Plans?');" value="1"><i class="fa fa-ban" aria-hidden="true"></i></button>

                    </th>

                    <th colspan="6"></th>

                </tfoot>

            </table>
            </div>

        {!! Form::close() !!}

        </div>

    </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

<?php if(count($contact)){?>

<script>



  $(function () {

     var oTable;

      oTable = $('#slider_list').DataTable({

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

        deleteSliderUrl: '{!! route('delete-slider') !!}',

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