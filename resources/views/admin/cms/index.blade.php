@extends('admin.layouts.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
 
    <div id="systemMessage"></div>

    <div class="panel panel-default">

      <div class="panel-heading">
          List
      </div>

      <div class="panel-body">
 
       <table id="module_list" class="table table-bordered table-striped {{ count($cms_modules_list) > 0 ? 'datatable' : '' }} table-hover ">
          <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Alias</th>
            <!--<th>Content</th>-->
            <th>Banner Image</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <?php $i = 1 ?>
          @foreach ($cms_modules_list as $key=>$value)
          
          <tr>
            <td>{{$i}}</td>
            <td><a href="\admin\cms\edit\{{$value->id}}" title="Click to edit {{@$value->content_title}}">{{@$value->content_title}}</a></td>
            <td>{{@$value->content_alias}}</td>
            <td>@if($value->banner_image)
                  <img src="{{ asset('public/uploads/cms/'.$value->banner_image) }}" height="70px" width="70px">
                @endif</td>
            <td><a href="\admin\cms\edit\{{$value->id}}" title="Click to edit {{@$value->content_title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></td>
          </tr>
          <?php $i++ ?>
          @endforeach

          </tbody>
       </table>
      </div>
<?php if(count($cms_modules_list)){?>
<script>
  $(function () {
     $('#module_list').DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "aoColumnDefs": [
        {
           bSortable: false,
           aTargets: [ -1,-2,-4]
        }
      ],
      'aaSorting': [[1, 'asc']],
      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],
      "iDisplayLength": 20,
      "language": {
        "emptyTable": "No Records Found.",
        "zeroRecords": "No Records Found",
        "searchPlaceholder" : "Title"
      }
    });
  });
</script>
<?php } ?>
@endsection
