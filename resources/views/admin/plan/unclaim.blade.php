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
    <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Upload CSV</a>
    <a href="{{route('manual_add_unclaim_business')}}" class="btn btn-success">Manual Upload</a>
  </p>

  <div class="reviewerro" id="reviewerro"></div>
  <div class="panel panel-default">
    <div class="panel-heading">  List of Business </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="plan_list" class="table table-bordered table-striped {{ count($claims) > 0 ? 'datatable' : '' }} table-hover ">
          <thead>
              <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>Business Name</th>
                <th>Location</th>
                <th>Email</th>
                <th>Website</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Status</th>
                <th>Activity</th>
                <th>Send Email</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @if (count($claims) > 0)
              <?php $i = 0; ?>
                  @foreach ($claims as $value)
                    <?php $cid= $value->id;
                      $email = '';
                      if($email == $value->business_email){
                        $emailval= "empty";
                      }else{
                        $emailval= $value->business_email;
                      }
                        $i++; 
                    
                    ?>
                      <tr id="item-{!! $value->id !!}">
                        <td><input type="checkbox" name="planIds[]" value="{{$value->id}}"></td>
                        <td>{{ $value->public_company_name}}</td>
                        <td>{{ $value->location}}</td>
                        <td>{{ $value->business_email}}</td>
                        <td>{{ $value->website}}</td>
                        <td>{{ $value->business_phone}}</td>
                        <td>{{ $value->company_address() }}</td>
                        <td>@if($value->is_verified == 1) Verfied @else Unclaimed @endif</td>
                        <td><a class="btn btn-success-red btn-sp" href="{{route('add_activity',['id'=>$value->id])}}">Add</a><a class="btn btn-success-red" href="{{route('list_activity',['id'=>$value->id])}}">List</a></td>
                        <td> 
                          <a class="btn btn-success-red btn-sp" onclick="send_email({{$cid}},'{{$emailval}}');">Send Email</a>
                        </td>
                        <td> 
                          <a href="{{route('edit_unclaim',['id'=>$value->id])}}" title="Click to Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                          <a href="{{route('claim_delete',['id'=>$value->id])}}" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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


   function send_email(cid,email){
        if(email != "empty"){
          $.ajax({
            url: "{{route('sendemail')}}",
            xhrFields: {
                withCredentials: true
            },
            type: 'get',
            data:{
              cid:cid,
            },
            success: function (response) {
                // $('.reviewerro').html('');
                // $('.reviewerro').css('display','block');
                if(response == 'success'){
                    //$('.reviewerro').html('Email Successfully Sent..');
                  alert('Email Successfully Sent..');
                }else{
                    //$('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                  alert("Can't Mail on this Address. Plese Check your Email..");
                }
              }
          });
        }else{
          alert('Email Id Is Not Provided..');
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