@extends('admin.layouts.layout')



@section('content')

  <!-- Content Wrapper. Contains page content -->

 

    <div id="systemMessage"></div>

    @if(count($newsletter_modules_list) > 0)

     <p>

        <a href="{!! route('send-newsletter-email') !!}" class="btn btn-success">Send Email</a>

    </p>

    @endif

    <div class="panel panel-default">



      <div class="panel-heading">

          List

      </div>



      <div class="panel-body">

        {!! Form::open(array('id' => 'editNewsletterDetails')) !!}

       <div class="table-responsive">
         <table id="module_list" class="table table-bordered table-striped {{ count($newsletter_modules_list) > 0 ? 'datatable' : '' }} table-hover ">

          <thead>

          <tr>

            <th><input type="checkbox" id="checkAll"></th>

            <th>Name</th>

            <th>Email</th>

            <th>Action</th>

          </tr>

          </thead>

          <tbody>

          <?php $i = 0 ?>

          @if (count($newsletter_modules_list) > 0)  

            @foreach ($newsletter_modules_list as $key=>$value)

            <?php $i++ ?>

            <tr>

              <td><input type="checkbox" name="newsletterIds[]" value="{{$value->id}}"></td>

              <td>{{@$value->name}}</td>

              <td>{{@$value->email}}</td>

              <td><a href="\admin\newsletters\delete\{{$value->id}}" title="Click to delete {{@$value->name}}" onclick="return confirm('Do you really want to delete newsletters?');" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></td>

            </tr>

            @endforeach

            @else

                <tr>

                    <td colspan="4">no record found</td>

                </tr>

              @endif

          </tbody>

          @if(count($newsletter_modules_list) > 0)

           <tfoot>

              <th>

                <button type="submit" id="submit_delete_newsletter" name="submit_delete_newsletter" class="btn btn-danger btn-xs" title="Delete Selected newsletter" onclick="return confirm('Do you really want to delete selected newsletter?');" value="1"><i class="fa fa-trash" aria-hidden="true"></i></button>

              </th>

              <th colspan="3"></th>

            </tfoot>

            @endif

       </table>
       </div>

       {!! Form::close() !!}

      </div>

     </div> 

<?php if(count($newsletter_modules_list)){?>

<script>

  $(function () {

     var table = $('#module_list').DataTable({

      "paging": true,

      "ordering": true,

      "info": true,

      "aoColumnDefs": [

        {

           bSortable: false,

           aTargets: [ -1,-4 ]

        }

      ],

      'aaSorting': [[1, 'asc']],

      "lengthMenu": [[10, 20, 50, 100, -1], [10, 20, 50, 100, "All"]],

      "iDisplayLength": 20,

      "language": {

        "emptyTable": "No Records Found.",

        "zeroRecords": "No Records Found",

        "searchPlaceholder" : "Name/Email"

      }

    });



     $('#checkAll').on('click', function(){

      // Get all rows with search applied

      var rows = table.rows({ 'search': 'applied' }).nodes();

      // Check/uncheck checkboxes for all rows in the table

      $('input[type="checkbox"]', rows).prop('checked', this.checked);

   });

  });

</script>

<?php } ?>

@endsection