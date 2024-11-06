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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<!-- Then load CKEditor from CDN -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.1.0/ckeditor.min.js"></script> -->
<script src="{{asset('/public/dashboard-design/ckeditor/ckeditor5.js')}}"></script>
	<div class="row">
		<div class="">
			<div class="card-body add-note-reminder">
				<ul class="nav nav-pills nav-justified mb-3" role="tablist">
					<li class="nav-item">
						<a class="nav-link waves-effect waves-light active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
							Add Notes
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link waves-effect waves-light" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab">
							Reminder
						</a>
					</li>
				</ul>
				
				<div class="tab-content text-muted">
					<div class="tab-pane active" id="pill-justified-home-1" role="tabpanel">
						<form id="addNoteForm">
							@csrf
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="mb-10">
									<lable >Title</lable>
									<input type="text" name="title" id="note-title" class="form-control" value="{{ isset($note) && $note->type === 'add_notes' ? $note->title : '' }}" 
									placeholder="Title">
									
									<div class="text-danger" id="error-title"></div>
								</div>
								{{-- <input type="hidden" name="notes_id" value="{{ !empty($note) ? $note->id : '' }}"> --}}
								<input type="hidden" name="notes_id" value="{{ isset($note) && $note->type === 'add_notes' ? $note->id : '' }}">

								<div class="mb-10" id="contracttermdiv" style="display:block">
									<lable>Notes</lable>
									{{-- <textarea name="notes" id="ckeditor-classic">{!!@$note->note!!}</textarea> --}}
									<textarea name="notes" id="ckeditor-classic">
										{!! isset($note) && $note->type === 'add_notes' ? $note->note : '' !!}
									</textarea>
									<div class="text-danger" id="error-notes"></div>

								</div>

								<div class="mb-10 displayChk0">
									<input type="checkbox" name="displayChk" id="displayChk" value="{{ isset($note) && $note->type === 'add_notes' ? $note->display_chk : 0 }}" 
									@if(isset($note) && $note->type === 'add_notes' && $note->display_chk == 1) checked @endif>
									{{-- <label>Display During check-in and in the member portal</label> --}}
									<label>Send a note to the client to review.</label>
								</div>
								<!-- <div class="row">
									<label>Set Reminder</label>
									<div class="col-md-6 col-6">
										<input type="text" name="due_date" id="due_date" class="form-control" value="" placeholder="mm/dd/yyyy">
										<div class="text-danger" id="error-due_date"></div>
									</div>

									<div class="col-md-6 col-6">
										{!! timeSlotOption('time',@$note->time ?? '') !!}
									</div>
								</div> -->

								<p class="err mt-10 font-red"></p>
								<label id="noteMessage" class="font-16"></label>
							</div>
							<button type="submit" id="add-note" class="btn btn-primary btn-red f-right"> {{ @$note ? "Update" : "Add" }} Regular </button>
							@if (session('success'))
							<div class="alert alert-success mt-3">
								{{ session('success') }}
							</div>
							@endif
						</form>
					</div>
					<div class="tab-pane" id="pill-justified-profile-1" role="tabpanel">
						<form id="addremainderNoteForm">
							@csrf
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="mb-10">
									<lable >Title</lable>
									<input type="text" name="title" id="note-title" class="form-control" value="{{ isset($note) && $note->type === 'add_remainder' ? $note->title : '' }}" placeholder="Title">
									<div class="text-danger" id="error-title"></div>
								</div>
								<input type="hidden" name="notes_id" value="{{ isset($note) && $note->type === 'add_remainder' ? $note->id : '' }}">

								<div class="mb-10" id="contracttermdiv" style="display:block">
									<lable>Notes</lable>
									{{-- <textarea name="notes" id="ckeditor-classictwo">{!!@$note->note!!}</textarea> --}}
									<textarea name="notes" id="ckeditor-classictwo">{!! isset($note) && $note->type === 'add_remainder' ? $note->note : '' !!}</textarea> 

									<div class="text-danger" id="error-notes"></div>

								</div>

								<div class="mb-10 displayChk0">
									<input type="checkbox" name="displayChk" id="displayChk" value="{{ isset($note) && $note->type === 'add_remainder' ? $note->display_chk : 0 }}" 
									@if(isset($note) && $note->type === 'add_remainder' && $note->display_chk == 1) checked @endif>
									{{-- <label>Display During check-in and in the member portal</label> --}}
									<label>Send a note to the client to review.</label>
								</div>
								<div class="row">
									<label>Set Reminder</label>
									<div class="col-md-6 col-6">
										<input type="text" name="due_date" id="due_date" class="form-control" value="" placeholder="mm/dd/yyyy">
										<div class="text-danger" id="error-due_date"></div>
									</div>

									<div class="col-md-6 col-6">
										{!! timeSlotOption('time',@$note->time ?? '') !!}
									</div>
								</div>

								<p class="err mt-10 font-red"></p>
								<label id="noteMessageRemainder" class="font-16"></label>

							</div>
							<button type="submit" id="add-remainder" class="btn btn-primary btn-red f-right"> {{ isset($note) && $note->type === 'add_remainder' ? "Update" : "Add" }} Reminder</button>
							@if (session('success'))
							<div class="alert alert-success mt-3">
								{{ session('success') }}
							</div>
							@endif
						</form>
					</div>
				</div>
			</div>
		</div>
		{{-- <form action="{{route('add_notes')}}" method="POST"> --}}
			<!-- <form id="addNoteForm">
			@csrf
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="mb-10">
					<lable >Title</lable>
					<input type="text" name="title" id="note-title" class="form-control" value="{{@$note->title}}" placeholder="Title">
					<div class="text-danger" id="error-title"></div>
				</div>
				<input type="hidden" value="{{ !empty($note) ? $note->id : '' }}">

				<div class="mb-10" id="contracttermdiv" style="display:block">
					<lable>Notes</lable>
					<textarea name="notes" id="ckeditor-classic">{!!@$note->note!!}</textarea>
		            <div class="text-danger" id="error-notes"></div>

				</div>

				<div class="mb-10 displayChk0">
					<input type="checkbox" name="displayChk" id="displayChk" value="{{@$note->display_chk ?? 0 }}" @if(@$note->display_chk == 1 ) checked @endif >
					{{-- <label>Display During check-in and in the member portal</label> --}}
					<label>Send a note to the client to review.</label>
				</div>
				<div class="row">
					<label>Set Reminder</label>
					<div class="col-md-6 col-6">
						<input type="text" name="due_date" id="due_date" class="form-control" value="" placeholder="mm/dd/yyyy">
						<div class="text-danger" id="error-due_date"></div>
					</div>

					<div class="col-md-6 col-6">
						{!! timeSlotOption('time',@$note->time ?? '') !!}
					</div>
				</div>

				<p class="err mt-10 font-red"></p>
				<label id="noteMessage" class="font-16"></label>
			</div>
		<button type="submit" id="add-note" class="btn btn-primary btn-red"> {{ @$note ? "Update" : "Add" }} Note</button>
			@if (session('success'))
			<div class="alert alert-success mt-3">
				{{ session('success') }}
			</div>
			@endif
		</form> -->
	</div>
	{{-- <script src="{{url('/public/dashboard-design/ckeditor/ckeditor.js')}}"></script>
	<script src="{{url('/public/dashboard-design/ckeditor/form-editor.init.js')}}"></script> --}}
	{{-- <script src="{{url('/public/dashboard-design/ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    
    <!-- Then load CKEditor from CDN -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.1.0/ckeditor.min.js"></script>
	 --}}
	 {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> --}}

	{{-- <script type="text/javascript">
        CKEDITOR.replace("ckeditor-classic");
    </script> --}}
	<script src="{{asset('/public/dashboard-design/ckeditor/ckeditor5.js')}}"></script>
	<script>
		CKEDITOR.ClassicEditor.create(document.getElementById("ckeditor-classic"), {
		   toolbar: {
				items: [
					'exportPDF','exportWord', '|',
					'findAndReplace', 'selectAll', '|',
					'heading', '|',
					'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
					'bulletedList', 'numberedList', 'todoList', '|',
					'outdent', 'indent', '|',
					'undo', 'redo',
					'-',
					'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
					'alignment', '|',
					'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
					'specialCharacters', 'horizontalLine', 'pageBreak', '|',
					'textPartLanguage', '|',
					'sourceEditing'
				],
				shouldNotGroupWhenFull: true
			},
			list: {
				properties: {
					styles: true,
					startIndex: true,
					reversed: true
				}
			},
			heading: {
				options: [
					{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
					{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
					{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
					{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
					{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
					{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
					{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
				]
			},
			placeholder: '',
			fontFamily: {
				options: [
					'default',
					'Arial, Helvetica, sans-serif',
					'Courier New, Courier, monospace',
					'Georgia, serif',
					'Lucida Sans Unicode, Lucida Grande, sans-serif',
					'Tahoma, Geneva, sans-serif',
					'Times New Roman, Times, serif',
					'Trebuchet MS, Helvetica, sans-serif',
					'Verdana, Geneva, sans-serif'
				],
				supportAllValues: true
			},
			fontSize: {
				options: [ 10, 12, 14, 'default', 18, 20, 22 ],
				supportAllValues: true
			},
			htmlSupport: {
				allow: [
					{
						name: /.*/,
						attributes: true,
						classes: true,
						styles: true
					}
				]
			},
			htmlEmbed: {
				showPreviews: true
			},
			link: {
				decorators: {
					addTargetToExternalLinks: true,
					defaultProtocol: 'https://',
					toggleDownloadable: {
						mode: 'manual',
						label: 'Downloadable',
						attributes: {
							download: 'file'
						}
					}
				}
			},
			mention: {
				feeds: [
					{
						marker: '@',
						feed: [
							'@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
							'@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
							'@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
							'@sugar', '@sweet', '@topping', '@wafer'
						],
						minimumCharacters: 1
					}
				]
			},
			removePlugins: [
				'CKBox',
				'CKFinder',
				'EasyImage',
				'RealTimeCollaborativeComments',
				'RealTimeCollaborativeTrackChanges',
				'RealTimeCollaborativeRevisionHistory',
				'PresenceList',
				'Comments',
				'TrackChanges',
				'TrackChangesData',
				'RevisionHistory',
				'Pagination',
				'WProofreader',
				'MathType'
			]
		});
	</script>
	<script>
		CKEDITOR.ClassicEditor.create(document.getElementById("ckeditor-classictwo"), {
		   toolbar: {
				items: [
					'exportPDF','exportWord', '|',
					'findAndReplace', 'selectAll', '|',
					'heading', '|',
					'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
					'bulletedList', 'numberedList', 'todoList', '|',
					'outdent', 'indent', '|',
					'undo', 'redo',
					'-',
					'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
					'alignment', '|',
					'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
					'specialCharacters', 'horizontalLine', 'pageBreak', '|',
					'textPartLanguage', '|',
					'sourceEditing'
				],
				shouldNotGroupWhenFull: true
			},
			list: {
				properties: {
					styles: true,
					startIndex: true,
					reversed: true
				}
			},
			heading: {
				options: [
					{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
					{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
					{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
					{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
					{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
					{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
					{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
				]
			},
			placeholder: '',
			fontFamily: {
				options: [
					'default',
					'Arial, Helvetica, sans-serif',
					'Courier New, Courier, monospace',
					'Georgia, serif',
					'Lucida Sans Unicode, Lucida Grande, sans-serif',
					'Tahoma, Geneva, sans-serif',
					'Times New Roman, Times, serif',
					'Trebuchet MS, Helvetica, sans-serif',
					'Verdana, Geneva, sans-serif'
				],
				supportAllValues: true
			},
			fontSize: {
				options: [ 10, 12, 14, 'default', 18, 20, 22 ],
				supportAllValues: true
			},
			htmlSupport: {
				allow: [
					{
						name: /.*/,
						attributes: true,
						classes: true,
						styles: true
					}
				]
			},
			htmlEmbed: {
				showPreviews: true
			},
			link: {
				decorators: {
					addTargetToExternalLinks: true,
					defaultProtocol: 'https://',
					toggleDownloadable: {
						mode: 'manual',
						label: 'Downloadable',
						attributes: {
							download: 'file'
						}
					}
				}
			},
			mention: {
				feeds: [
					{
						marker: '@',
						feed: [
							'@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
							'@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
							'@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
							'@sugar', '@sweet', '@topping', '@wafer'
						],
						minimumCharacters: 1
					}
				]
			},
			removePlugins: [
				'CKBox',
				'CKFinder',
				'EasyImage',
				'RealTimeCollaborativeComments',
				'RealTimeCollaborativeTrackChanges',
				'RealTimeCollaborativeRevisionHistory',
				'PresenceList',
				'Comments',
				'TrackChanges',
				'TrackChangesData',
				'RevisionHistory',
				'Pagination',
				'WProofreader',
				'MathType'
			]
		});
	</script>
	<script type="text/javascript">
		var checkboxStatus;
		$(document).ready(function () {
			// let theEditor;
			// ClassicEditor.create(document.querySelector("#ckeditor-classic")).then(function(e) {
			// 	e.ui.view.editable.element.style.height = "150px"
			// 	theEditor = e;
			// }).catch(function(e) {
			// 	console.error(e)
			// });			
			
			$("#displayChk").change(function() {
				checkboxStatus = this.checked ? 1 : 0;
			});
			
			// $('#add-note').click(function(){
			// 	// var theEditor = CKEDITOR.instances.ckeditor-classic.getData();
			// 	// alert($('#ckeditor-classic').val());
			// 	// alert(theEditor);
			// 	if(theEditor != '' && $('#due_date').val() != '' && $('#note-title').val()) {
			// 		var formdata = new FormData();
			// 		formdata.append('id','{{@$note->id}}');
			// 		formdata.append('title',$('#note-title').val());
			// 		formdata.append('notes',theEditor);
			// 		formdata.append('displayChk',checkboxStatus ?? 0);
			// 		formdata.append('due_date',$('#due_date').val());
			// 		formdata.append('time',$('#time').val());
			// 		formdata.append('cid','{{$cusId}}');
			// 		formdata.append('_token','{{csrf_token()}}')
			// 		$.ajax({
			// 			url: '{{route('add_notes')}}',
			// 			type:'post',
			// 			dataType: 'json',
			// 			enctype: 'multipart/form-data',
			// 			data:formdata,
			// 			processData: false,
			// 			contentType: false,
			// 			headers: {'X-CSRF-TOKEN': $("#_token").val()},
			// 			success: function (response) { 
			// 				$('#noteMessage').removeClass();
			// 			if(response.status == 200){
			// 				$('#noteHtml').html('<p class="font-green font-16 text-center">'+response.message+'<p>');
			// 				setTimeout(function() {
			// 							window.location.reload();
			// 					}, 1500);
			// 			}
			// 			else{
			// 					$('#noteMessage').addClass('font-red font-16');
			// 					$('#noteMessage').html(response.message).addClass('alert alert-danger alert-dismissible');
			// 			}
			// 			}
			// 		});
			// 	}else{
			// 		$('#noteMessage').html('Please fill details like note and Due Date and Title').addClass('font-red font-16 alert alert-danger alert-dismissible');
			// 	}
			// });
		});

		flatpickr("#due_date", {
			altInput: true,
			altFormat: "m/d/Y",
			dateFormat: "Y-m-d",
			defaultDate: "{{@$note->due_date ?? ''}}",
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#addNoteForm').on('submit', function(event) {
				event.preventDefault(); // Prevent the default form submission

				let formData = $(this).serialize(); // Serialize form data
				$.ajax({
					url: "{{ route('add_notes') }}", // Your route for handling the form
					method: 'POST',
					data: formData,
					success: function(data) {
						// Clear previous error messages
						$('#error-title').text('');
						$('#error-notes').text('');
						$('#error-due_date').text('');
						$('#error-time').text('');

						// Check if the request was successful
						if (data.status === 200) {
							$('#noteMessage').text(data.message).removeClass('text-danger').addClass('text-success');
							// console.log(data.message);
							// Optionally close the modal here if needed
							// $('#notes').modal('hide');
							// $('#noteMessage').text(data.message).removeClass('text-danger').addClass('text-success');
							setTimeout(function() {
								$('#noteMessage').text(''); // Clear the success message
								$('#notes').modal('hide');  // Close the modal
								window.location.reload();
							}, 3000); 
						} else {
							// Show validation errors
							if (data.errors) {
								for (let key in data.errors) {
									$('#error-' + key).text(data.errors[key][0]); // Show the first error message
								}
							}
						}
					},
					error: function(xhr) {
						// Handle general AJAX errors here
						console.error(xhr.responseText);
					}
				});
			});
		});
	</script>
	