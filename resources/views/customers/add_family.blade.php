@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                        	<div class="row mb-3">
								<div class="col-12">
									<div class="page-heading">
										<label>Add Family or Friends</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-body">
											<div class="live-preview">
												<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="accordionnestingExample1">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">Add</button>
														</h2>
														<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
															<div class="accordion-body">
																<form name="frm_family" id="frm_family" action="{{Route('addFamilyMemberCustomer')}}"  method="post"  autocomplete="off" >
													                @csrf
													                <input type="hidden" name="business_id" value="{{$companyId}}">
													                <input type="hidden" name="parent_cus_id" value="{{$parent_cus_id}}">
																	<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2" id="addFamilyBlock">
																		@if(count($UserFamilyDetails) > 0)	
																			@foreach($UserFamilyDetails as $fam_cnt=>$family)
																				<div class="accordion-item shadow">
																					<h2 class="accordion-header" id="accordionnesting2Example{{$fam_cnt}}">
																						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse{{$fam_cnt}}" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse{{$fam_cnt}}">
																							<div class="container-fluid nopadding">
				                                                                                <div class="row">
				                                                                                    <div class="col-lg-6 col-md-6 col-8">{{$family->full_name}}</div>
				                                                                                    <div class="col-lg-6 col-md-6 col-4">
				                                                                                        <div class="multiple-options">
				                                                                                            <div class="setting-icon">
				                                                                                                <i class="ri-more-fill"></i>
				                                                                                                <ul>
				                                                                                                    <li><a href="#" onclick="deleteMember('{{$family->id}}')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
				                                                                                                </ul>
				                                                                                            </div>
				                                                                                        </div>
				                                                                                    </div>
				                                                                                </div>
				                                                                            </div>
																						</button>
																					</h2>
																					<div id="accor_nesting2Examplecollapse{{$fam_cnt}}" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example{{$fam_cnt}}" data-bs-parent="#accordionnesting2">
																						<div class="accordion-body">
																							<div class="container-fluid nopadding">
																								<div class="row">
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<input type="hidden" name="cus_id[{{$fam_cnt}}]" id="cus_id[{{$fam_cnt}}]"  value="{{$family->id}}">
																											<input type="text" name="fname[{{$fam_cnt}}]" id="fname[{{$fam_cnt}}]" placeholder="First Name" class="form-control" required="required" value="{{$family->fname}}" >
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<input type="text" name="lname[{{$fam_cnt}}]" id="lname[{{$fam_cnt}}]" placeholder="Last Name" class="form-control" required="required" value="{{$family->lname}}" >
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											 <select name="gender[{{$fam_cnt}}]" id="gender[{{$fam_cnt}}]" class="form-control" required="required" >
																												<option value="" hidden="">Select Gender</option>
																												<option value="Male" @if(strtolower($family->gender)=='male') selected @endif >Male</option>
																												<option value="Female" @if(strtolower($family->gender)=='female') selected @endif>Female</option>
																											</select>
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<input type="email" name="email[{{$fam_cnt}}]" id="email[{{$fam_cnt}}]" value="{{$family->email}}" placeholder="Email" class="form-control" required="required">
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<select name="relationship[{{$fam_cnt}}]" id="relationship[{{$fam_cnt}}]" class="form-select" required="required">
																												<option value="" hidden="">Select Relationship</option>
																												<option value="Brother" @if($family->relationship=='Brother') selected @endif>Brother</option>
																												<option value="Sister" @if($family->relationship=='Sister') selected @endif>Sister</option>
																												<option value="Father" @if($family->relationship=='Father') selected @endif>Father</option>
																												<option value="Mother" @if($family->relationship=='Mother') selected @endif>Mother</option>
																												<option value="Wife" @if($family->relationship=='Wife') selected @endif>Wife</option>
																												<option value="Husband" @if($family->relationship=='Husband') selected @endif>Husband</option>
																												<option value="Son" @if($family->relationship=='Son') selected @endif>Son</option>
																												<option value="Daughter" @if($family->relationship=='Daughter') selected @endif>Daughter</option>
																												<option value="Friend" @if($family->relationship=='Friend') selected @endif>Friend</option>
																											</select>
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<div class="input-group">
																												<input type="text" value="{{date('m/d/Y',strtotime($family->birthdate))}}" name="birthdate[{{$fam_cnt}}]" id="birthdate" class="form-control border-0 dash-filter-picker width-flatpiker flatpiker-with-border flatpickr-input active flatpickr-date{{$fam_cnt}}" data-dynamic-id ="{{$fam_cnt}}" placeholder="Birthdate">
																											</div>
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<input type="text" name="mobile[{{$fam_cnt}}]" value="{{$family->phone_number}}" id="mobile{{$fam_cnt}}" data-behaviour="text-phone" placeholder="Mobile" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57">
																										</div>
																									</div>
																									
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group mb-15">
																											<input type="text" name="emergency_contact[{{$fam_cnt}}]" id="emergency_contact{{$fam_cnt}}" value="{{$family->emergency_contact}}"  data-behaviour="text-phone" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
																											<input type="hidden" name="removed_family[{{$fam_cnt}}]" id="removed_family{{$fam_cnt}}" value="{{$family->id}}">
																										</div>
																									</div>
																									<div class="col-lg-4 col-md-6 col-sm-6">
																										<div class="form-group check-box-info">
																											<input class="check-box-primary-account check-box{{$fam_cnt}}" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder[{{$fam_cnt}}]" value="1"@if($resultDate->format('Y-m-d') <= $family->birthdate) disabled @elseif($family->primary_account == 1) checked @endif>
																											<label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<input type="hidden" name="family_count" id="family_count" value="{{$fam_cnt}}" />
																			@endforeach
																		@else
																			<div class="accordion-item shadow">
																				<h2 class="accordion-header" id="accordionnesting2Example0">
																					<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse0" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse0">
																						<div class="container-fluid nopadding">
			                                                                                <div class="row">
			                                                                                    <div class="col-lg-6 col-md-6 col-8">Add Family or Friends</div>
			                                                                                    <div class="col-lg-6 col-md-6 col-4">
			                                                                                        <div class="multiple-options">
			                                                                                            <div class="setting-icon">
			                                                                                                <i class="ri-more-fill"></i>
			                                                                                                <ul>
			                                                                                                    <li><a href="#" onclick="deleteMember()"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
			                                                                                                </ul>
			                                                                                            </div>
			                                                                                        </div>
			                                                                                    </div>
			                                                                                </div>
			                                                                            </div>
																					</button>
																				</h2>
																				<div id="accor_nesting2Examplecollapse0" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example0" data-bs-parent="#accordionnesting2">
																					<div class="accordion-body">
																						<div class="container-fluid nopadding">
																							<div class="row">
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<input type="hidden" name="cus_id[0]" id="cus_id[0]"  value="">
																										<input type="text" name="fname[0]" id="fname[0]" placeholder="First Name" class="form-control" required="required" value="" >
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<input type="text" name="lname[0]" id="lname[0]" placeholder="Last Name" class="form-control" required="required" value="" >
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										 <select name="gender[0]" id="gender[0]" class="form-control" required="required" >
																											<option value="" hidden="">Select Gender</option>
																											<option value="Male">Male</option>
																											<option value="Female">Female</option>
																										</select>
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<input type="email" name="email[0]" id="email[0]" value="" placeholder="Email" class="form-control" required="required">
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<select name="relationship[0]" id="relationship[0]" class="form-select" required="required">
																											<option value="" hidden="">Select Relationship</option>
																											<option value="Brother">Brother</option>
																											<option value="Sister">Sister</option>
																											<option value="Father">Father</option>
																											<option value="Mother">Mother</option>
																											<option value="Wife">Wife</option>
																											<option value="Husband">Husband</option>
																											<option value="Son">Son</option>
																											<option value="Daughter">Daughter</option>
																											<option value="Friend">Friend</option>
																										</select>
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<div class="input-group">
																											<input type="text" value="" data-dynamic-id ="0" name="birthdate[0]" id="birthdate" class="form-control border-0 dash-filter-picker width-flatpiker flatpiker-with-border flatpickr-input active flatpickr-date0" placeholder="Birthdate">
																										</div>
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<input type="text" name="mobile[0]" value="" id="mobile0" data-behaviour="text-phone" placeholder="Mobile" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57">
																									</div>
																								</div>
																								
																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group mb-15">
																										<input type="text" name="emergency_contact[0]" id="emergency_contact0" data-behaviour="text-phone" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
																										<input type="hidden" name="removed_family[0]" id="removed_family0" value="">
																									</div>
																								</div>

																								<div class="col-lg-4 col-md-6 col-sm-6">
																									<div class="form-group check-box-info">
																										<input class="check-box-primary-account check-box0" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder[0]" value="1">
																										<label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
		                    												<input type="hidden" name="family_count" id="family_count" value="0" />
																		@endif
																	</div>
																	<div class="container-fluid nopadding">
																		<div class="row">
																			<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																				<div class="form-group mt-10">
																					<a class="addmore_addfamily">+ Add More</a>
																				</div>
																			</div>
																			<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																				<input type="hidden" name="previous_family_count" id="previous_family_count" value="{{count($UserFamilyDetails)}}" />
																				<input type="submit" name="btn_family" id="btn_family" value="Submit" class="btn btn-red float-end mt-10">
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<a href="{{route('business_customer_show',['business_id' => $companyId, 'id' =>$parent_cus_id ])}}" class="btn btn-red float-end mt-10">Back</a>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
								</div>
							</div>
						</div> <!-- end .h-100-->
                  	</div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')

<script type="text/javascript">

	$(document).ready(function() {

		$(document).on('focus','.flatpickr-input',function(e){
	        //jQuery.noConflict();
	        var id = $(this).attr('data-dynamic-id');
	        flatpickr('.flatpickr-date'+id,{
	            dateFormat: "m/d/Y",
		    	maxDate: "today",
	        });
	        var date = $('.flatpickr-date'+id).val();
	        var age = calculateAge(date);
	        if (age < 18) {
                $('.check-box'+id).prop('disabled', true);
                if ($('.check-box'+id).is(':checked')) {
                    $('.check-box'+id).prop('checked', false);
                }
            } else {
               $('.check-box'+id).prop('disabled', false);
            }

	    });
	});

	function calculateAge(dateStr) {
        var birthDate = new Date(dateStr);
        var currentDate = new Date();
        var age = currentDate.getFullYear() - birthDate.getFullYear();
        var monthDiff = currentDate.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }


	function deleteMember(id) {
		if(id == undefined){
			window.location.reload();
		}else{
			var _token = $("input[name='_token']").val();
	        $.ajax({
	            type: 'POST',
	            url: '{{route("removefamilyCustomer")}}',
	            data: {
	                _token: _token,
	                id: id
	            },
	            success: function (data) {
	                window.location.reload();
	            }
	        });
		}
	}

	$('.addmore_addfamily').click(function(e){
		var cnt = $('#family_count').val();
		cnt++;
		var data = '';
		$('#family_count').val(cnt);
		data +='<div class="accordion-item shadow"> <h2 class="accordion-header" id="accordionnesting2Example'+cnt+'"> <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse'+cnt+'" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse'+cnt+'"> <div class="container-fluid nopadding"> <div class="row"> <div class="col-lg-6 col-md-6 col-8">Add Family or Friends</div> <div class="col-lg-6 col-md-6 col-4"> <div class="multiple-options"> <div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a href="#" onclick="deleteMember()"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li> </ul> </div> </div> </div> </div> </div> </button> </h2> <div id="accor_nesting2Examplecollapse'+cnt+'" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example'+cnt+'" data-bs-parent="#accordionnesting2"> <div class="accordion-body"> <div class="container-fluid nopadding"> <div class="row"> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <input type="hidden" name="cus_id[' + cnt + ']" id="cus_id[' + cnt + ']" value=""> <input type="text" name="fname[' + cnt + ']" id="fname[' + cnt + ']" placeholder="First Name" class="form-control" required="required" value="" > </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <input type="text" name="lname[' + cnt + ']" id="lname[' + cnt + ']" placeholder="Last Name" class="form-control" required="required" value="" > </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <select name="gender[' + cnt + ']" id="gender[' + cnt + ']" class="form-control" required="required" > <option value="" hidden="">Select Gender</option> <option value="Male">Male</option> <option value="Female">Female</option> </select> </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <input type="email" name="email[' + cnt + ']" id="email[' + cnt + ']" value="" placeholder="Email" class="form-control" required="required"> </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <select name="relationship[' + cnt + ']" id="relationship[' + cnt + ']" class="form-select" required="required"> <option value="" hidden="">Select Relationship</option> <option value="Brother">Brother</option> <option value="Sister">Sister</option> <option value="Father">Father</option> <option value="Mother">Mother</option> <option value="Wife">Wife</option> <option value="Husband">Husband</option> <option value="Son">Son</option> <option value="Daughter">Daughter</option> <option value="Friend">Friend</option> </select> </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <div class="input-group"> <input type="text" value="" name="birthdate[' + cnt + ']" id="birthdate" data-dynamic-id ="'+cnt+'" class="form-control border-0 dash-filter-picker width-flatpiker flatpiker-with-border flatpickr-input active flatpickr-date'+cnt+'" placeholder="Birthdate"> </div> </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <input type="text" name="mobile[' + cnt + ']" value="" id="mobile'+cnt+'" data-behaviour="text-phone" placeholder="Mobile" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"> </div> </div> <div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group mb-15"> <input type="text" name="emergency_contact[' + cnt + ']" id="emergency_contact'+cnt+'" data-behaviour="text-phone" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 && event.charCode <= 57"> <input type="hidden" name="removed_family[' + cnt + ']" id="removed_family'+cnt+'" value=""> </div> </div><div class="col-lg-4 col-md-6 col-sm-6"> <div class="form-group check-box-info"><input class="check-box-primary-account check-box'+cnt+'" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder[' + cnt + ']" value="1"> <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label></div> </div> </div> </div> </div> </div></div>';
		$('#accordionnesting2').append(data);
	});

		
</script>
@endsection
