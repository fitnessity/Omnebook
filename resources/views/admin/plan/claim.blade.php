@extends('admin.layouts.layout')
@section('content')

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Upload File for Business Claim</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <label>Choose File: </label>
              <input type="file" name="file" id="file" onchange="readURL(this)" />
              <p class='err' style="color:red;padding-top:10px;"></p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="upload-csv" class="btn btn-primary">Upload File</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModal2Label">Repeated Data</h4>
        </div>
        <div class="modal-body" style=" height: 65vh;overflow-y: auto;">
          <table id="myTable" class="table">
              
          </table>
          <p id="myp"></p>
          <table id="myTable2" class="table">
              
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

          <!--<button type="button" id="ignore-csv" class="btn btn-secondary" data-dismiss="modal">Add New</button>-->
          <button type="button" id="replace-csv" class="btn btn-primary">Replace</button>
        </div>
      </div>
    </div>
  </div>

  <div id="systemMessage"></div>
  <p>
    <!-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Upload CSV</a> -->
  </p>
  <div class="panel panel-default">
    <div class="panel-heading">  List of Business </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="plan_list" class="table table-bordered table-striped {{ count($claims) > 0 ? 'datatable' : '' }} table-hover ">
          <thead>
              <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Business Name</th>
                <th>Email</th>
                <th>Claimed User</th>
                <th>Website</th>
                <th>Phone Number</th>
                <th>Location</th>
                <th>Address</th>
                <th>Activity</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @if (count($claims) > 0)
                @foreach ($claims as $value)
                  <tr id="item-{!! $value->id !!}">
                    <td><input type="checkbox" name="planIds[]" value="{{$value->id}}"></td>
                    <td>{{ $value->dba_business_name}}</td>
                    <td>{{ $value->email}}</td>
                    <td>{{ $value->company_user_name}}</td>
                    <td>{{ $value->website}}</td>
                    <td>{{ $value->contact_number}}</td>
                     <td>{{ $value->location}}</td>
                    <td>{{ $value->address}}</td>
                    <td>
                      <a class="btn btn-success-red btn-sp" href="{{route('add_activity',['id'=>$value->id])}}"> Add </a>
                      <a class="btn btn-success-red" href="{{route('list_activity',['id'=>$value->id])}}">List</a>
                    </td>
                    <td><a href="{{route('business_delete',['id'=>$value->id])}}" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="8">no record found</td>
                </tr>
              @endif
          </tbody>
          <!-- <tfoot>-->
          <!--    <th>-->
          <!--    <button type="submit" id="submit_delete_plans" name="submit_delete_plans" class="btn btn-danger btn-xs" title="Deactivate Selected Plans" onclick="return confirm('Do you really want to deactivate selected Plans?');" value="1"><i class="fa fa-ban" aria-hidden="true"></i></button>-->
          <!--    </th>-->
          <!--    <th colspan="6"></th>-->
          <!--</tfoot>-->
        </table>
      </div>
    </div>
  </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
<script>
  var profile_pic_var = '';
  var ext = '';
  function readURL(input) {
    //  $('.err').html('')
    //console.log("FFFffff")
    if (input.files && input.files[0]) {
      const name = input.files[0].name;
      const lastDot = name.lastIndexOf('.');
      const fileName = name.substring(0, lastDot);
      ext = name.substring(lastDot + 1);
      //console.log(ext)
      var reader = new FileReader();
      reader.onload = function (e) {
      };
      profile_pic_var = input.files[0];
      reader.readAsDataURL(input.files[0]);
    }
  }  
</script>
<script>
  $(document).ready(function(){
      console.log('called')
      var repeat_data1;
      $('#ignore-csv').click(function(){
        myData("ignore")
      })
       
      $('#replace-csv').click(function(){
        myData("replace")
      })
       
      function myData(val){
        var formdata = new FormData();
        console.log($('input[name="selected_ids"]:checked'))
        var searchIDs = $("#myTable input:checkbox:checked").map(function(){
          return $(this).val();
        }).get(); // <----
        console.log(searchIDs);
        formdata.append('datas',JSON.stringify(repeat_data1));
        formdata.append('searchIDs',JSON.stringify(searchIDs));
        formdata.append('ignore_replace',val);
        formdata.append('_token','{{csrf_token()}}')
        $.ajax({
          url:'/admin/ignore-replace-claimbusiness',
          type:'post',
          dataType: 'json',
          enctype: 'application/json',
          data:formdata,
          processData: false,
          contentType: false,
          headers: {'X-CSRF-TOKEN': $("#_token").val()},
          beforeSend: function () {
             $('.loader').show();
          },
          complete: function () {
             $('.loader').hide();
          },
          success: function (response) { 
            if(response.status == 200){
              //window.location.reload();
              $('#exampleModal2').modal('hide');
              showSystemMessages('#systemMessage', 'success', 'File import successfully');
              setTimeout(function(){
                  window.location.reload();
              },2000)
              window.location.reload(); 
             //console.log(response.status);
            }
          }
        })
      }
           
      $('#upload-csv').click(function(){
          if(profile_pic_var == ''){
              showSystemMessages('#systemMessage', 'danger', 'Select file to upload.');
          }
          else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
              showSystemMessages('#systemMessage', 'danger', 'File format is not supported.');
              $('.err').html('File format is not supported.')
          }
          else{
              var formdata = new FormData();
              formdata.append('import_file',profile_pic_var);
               formdata.append('_token','{{csrf_token()}}')
               $.ajax({
                    url:'/admin/import-claimbusiness',
                    type:'post',
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    data:formdata,
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $("#_token").val()},
                     beforeSend: function () {
                       $('.loader').show();
                     },
                     complete: function () {
                       $('.loader').hide();
                     },
                    success: function (response) { 
                        console.log("myresponse")
                        console.log(response)
                        console.log("myresponse")
                        if(response.status == 200){
                            //window.location.reload();
                            $('#exampleModal').modal('hide');
                            if(response.repeat_data.length == 0 && response.not_repeat_data.length == 0)
                               showSystemMessages('#systemMessage', 'success', response.message);
                            console.log(response.repeat_data.length)
                            if(response.repeat_data.length == 0 && response.not_repeat_data.length == 0){
                            setTimeout(function(){
                                window.location.reload();
                            },2000)
                            }
                            else{
                                repeat_data1 = response.repeat_data;
                               var not_repeat_data1 = response.not_repeat_data;
                               if(response.repeat_data.length == 0){
                                   $('#replace-csv').hide()
                               }
                              $('#file').val('');
                              var str='';
                              str = str+'<thead><tr> <td>S. No</td><td></td><td>Business Name</td><td>Activity</td><td>Location</td><td>Website</td><td>Phone</td><td>Address</td></tr></thead><tbody>'
                              for(var i=0;i<response.repeat_data.length;i++){
                                  str = str+'<tr><td>'+(i+1)+'</td><td><input type="checkbox" name="selected_ids[]" value="'+i+'" /></td><td>'+response.repeat_data[i][0]+'</td><td>'+response.repeat_data[i][1]+'</td><td>'+response.repeat_data[i][2]+'</td><td>'+response.repeat_data[i][3]+'</td><td>'+response.repeat_data[i][4]+'</td><td>'+response.repeat_data[i][5]+'</td></tr>'
                                  if((i+1) == response.repeat_data.length){
                                      str = str+'</tbody>';
                                  }
                                  
                              }
                              if(response.not_repeat_data.length != 0){
                                  $('#myp').html("Following Business is already available and it can not uplaoad")
                              var str2='';
                              str2 = str2+'<thead><tr> <td>S. No</td><td></td><td>Business Name</td><td>Activity</td><td>Location</td><td>Website</td><td>Phone</td><td>Address</td></tr></thead><tbody>'
                                  for(var i=0;i<response.not_repeat_data.length;i++){
                                      str2 = str2+'<tr><td>'+(i+1)+'</td><td><input type="checkbox" name="selected_ids[]" value="'+i+'" /></td><td>'+response.not_repeat_data[i][0]+'</td><td>'+response.not_repeat_data[i][1]+'</td><td>'+response.not_repeat_data[i][2]+'</td><td>'+response.not_repeat_data[i][3]+'</td><td>'+response.not_repeat_data[i][4]+'</td><td>'+response.not_repeat_data[i][5]+'</td></tr>'
                                      if((i+1) == response.not_repeat_data.length){
                                          str2 = str2+'</tbody>';
                                      }
                                      
                                  }
                                  $('#myTable2').html(str2);
                              }
                              $('#myTable').html(str);
                              $('#exampleModal').modal('hide');
                              $('#exampleModal2').modal('show');
                            }
                        }
                        else{
                            showSystemMessages('#systemMessage', 'danger', response.message);
                            $('#file').val('')
                            $('#exampleModal').modal('hide');
                        }
                        //console.log(response.status);
                    }
               
              });
          }
      })
  });
</script>

<?php if(count($claims)){?>
<script>
$(document).ready(function (){
  /*alert('hii');*/
  var table = $('#plan_list').DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "aoColumnDefs": [
        {
           bSortable: false,
           aTargets: [ -1,-7]
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
        "emptyTable": "No Business Found.",
        "zeroRecords": "No Business Found."
        /*"searchPlaceholder" : "Name/Email"*/
      },
       'aaSorting': [[2, 'asc']]
    });

  $('#status').on('change', function (e) {
      table.draw();
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