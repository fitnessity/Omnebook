@extends('admin.layouts.layout')



@section('content')

      

    <div id="systemMessage"></div>

    <p>

        <a href="{!! route('create-new-activity-slider') !!}" class="btn btn-success">Add New</a>

    </p>



    <div class="panel panel-default">



        <div class="panel-heading">

            List

        </div>

        <div class="panel-body">

       
            <div class="table-responsive">
              <table id="slider_list" class="table table-bordered table-striped {{ count($sliders) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>

                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Action</th>

                    </tr>

                </thead>

                

                <tbody>

                    @if (count($sliders) > 0)

                    <?php $i = 0 ?>

                        @foreach ($sliders as $value)

                          <?php $i++ ?>

                            <tr id="item-{!! $value->id !!}">


                                <td><img src="{{ asset('public/uploads/slider/thumb/'.$value->image) }}" width="150" height="auto" /></td>

                                <td><a href="\admin\activity-slider\edit\{{$value->id}}" title="Click to edit {{@$value->title}}">{{@$value->title}}</a></td>

                  <td>

                      <a href="\admin\activity-slider\edit\{{$value->id}}" title="Click to edit {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                      <a href="\admin\activity-slider\delete\{{$value->id}}" title="Click to delete {{@$value->title}}" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>

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

<?php if(count($sliders)){?>

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

<?php } ?>

@endsection