<?php
	function timeSlotOption($lbl, $val) {
  		$start = "00:00"; 
  		$end = "23:30";

  		$tStart = strtotime($start);
  		$tEnd = strtotime($end);
  		$tNow = $tStart;
  
  		$startpm = "00:00";
  		$endpm = "11:30";
  		$html = '';
  		$html .= '<select name="'.$lbl.'[]" id="'.$lbl.'" class="'.$lbl.' form-control" required="required">';
  		while($tNow <= $tEnd){
   		if($val == date("H:i",$tNow)) {
      		$html .= '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';    
    		} else {
      			$html .= '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
    		}
    		$tNow = strtotime('+15 minutes',$tNow);
  		}
   		$html .= '</select>';
   		return $html;
	}
?>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="mb-10">
				<textarea name="notes" id="ckeditornotes">{!!@$note->note!!}</textarea>
			</div>
			<div  class="mb-10 displayChk0">
				<input type="checkbox" name="displayChk" id="displayChk" value="{{@$note->display_chk ?? 0 }}" @if(@$note->display_chk == 1 ) checked @endif >
				<label>Display During check-in and in the member portal</label>
			</div>
			<div class="row">
				<label>Set Reminder</label>
				<div class="col-md-6 col-6">
					<input type="text" name="due_date" id="due_date" class="form-control" value="" placeholder="mm/dd/yyyy">
				</div>

				<div class="col-md-6 col-6">
					{!! timeSlotOption('time',@$note->time ?? '') !!}
				</div>
			</div>

			<p class="err mt-10 font-red"></p>
			<label id="noteMessage" class="font-16"></label>
		</div>

		<button type="button" id="add-note" class="btn btn-primary btn-red">Add Note</button>
	</div>

<script type="text/javascript">
	let theEditor; var checkboxStatus;
	$(document).ready(function () {

	   ClassicEditor.create(document.querySelector("#ckeditornotes")).then(function(e) {
			e.ui.view.editable.element.style.height = "150px"
			theEditor = e;
		}).catch(function(e) {
			console.error(e)
		});

		$("#displayChk").change(function() {
         checkboxStatus = this.checked ? 1 : 0;
      });

      $('#add-note').click(function(){
      	if(theEditor.getData() != '' && $('#due_date').val() != '') {
      		var formdata = new FormData();
	      	formdata.append('id','{{@$note->id}}');
	      	formdata.append('notes',theEditor.getData());
	      	formdata.append('displayChk',checkboxStatus ?? 0);
	      	formdata.append('due_date',$('#due_date').val());
	      	formdata.append('time',$('#time').val());
	      	formdata.append('cid','{{$cusId}}');
	       	formdata.append('_token','{{csrf_token()}}')
	       	$.ajax({
	            url: '{{route('add_notes')}}',
	            type:'post',
	            dataType: 'json',
	            enctype: 'multipart/form-data',
	            data:formdata,
	            processData: false,
	            contentType: false,
	            headers: {'X-CSRF-TOKEN': $("#_token").val()},
	            success: function (response) { 
	            	$('#noteMessage').removeClass();
	               if(response.status == 200){
	                  $('#noteHtml').html('<p class="font-green font-16 text-center">'+response.message+'<p>');
	                  setTimeout(function() {
						        window.location.reload();
						   }, 2000);
	               }
	               else{
	             		$('#noteMessage').addClass('font-red font-16');
	             		$('#noteMessage').html(response.message).addClass('alert alert-danger alert-dismissible');
	               }
	            }
	      	});
	      }else{
	         $('#noteMessage').html('Please fill details like note and Due Date').addClass('font-red font-16 alert alert-danger alert-dismissible');
	      }
    	});
	});

	flatpickr("#due_date", {
      	altInput: true,
      	altFormat: "m/d/Y",
        dateFormat: "Y-m-d",
        defaultDate: "{{@$note->due_date ?? ''}}",
    });
</script>