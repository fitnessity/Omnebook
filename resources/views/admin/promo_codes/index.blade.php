@extends('admin.layouts.layout')
@section('content')

    <div id="systemMessage"></div>
    <p>
        <a href="{{route('promo_codes.create')}}" class="btn btn-success">Add New</a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <div class="table-responsive">
              <table id="promo_codes_list" class="table table-bordered table-striped {{ count($promoCodes) > 0 ? 'datatable' : '' }} table-hover ">
                <thead>
                    <tr>
                      <th>Title</th>
                      <th>Code</th>
                      <th>Discount</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($promoCodes) > 0)
                        @foreach($promoCodes as $i=>$value)
                          <tr id="item-{!! $value->id !!}">
                            <td><a href="\admin\promo_codes\edit\{{$value->id}}" title="Click to edit {{@$value->title}}">{{@$value->title}}</a></td>
                            <td>{{ $value->code}}</td>
                            <td>{{ $value->price_in == '$' ? '$'.@$value->price : @$value->price.'%' }}</td>
                            <td>{{ $value->status}}</td>
                            <td>
                              <a href="\admin\promo_codes\edit\{{$value->id}}" title="Click to edit {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              <a onclick="confirmDelete({{ $value->id }})" title="Click to delete {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<?php if(count($promoCodes)){?>

<script>

  $(function () {

     var oTable;
      oTable = $('#promo_codes_list').DataTable({
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
            if (status_clm == 'Yes'){
                return true;
            }
            return false;
        }else if(status == 'No') {
            if (status_clm == 'No'){
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

  });

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this Promo Code?")) {
            window.location.href = "/admin/promo_codes/delete/" + id;
        }
    }

</script>

<?php } ?>

@endsection