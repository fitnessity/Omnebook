@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	@include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="tab-hed ">Add Family or Friends</div>
					</div>
				</div>
                <!--<div class="tab-hed">Manage Customers</div>-->
                <hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
            </div>
            <div class="add_family_section padding-1 white-bg border-radius1">
	            <form name="frm_family" id="frm_family" action="{{Route('addFamilyMemberCustomer')}}"  method="post"  autocomplete="off" >
	                @csrf
	                <input type="hidden" name="business_id" value="{{$companyId}}">
	                <input type="hidden" name="parent_cus_id" value="{{$parent_cus_id}}">
	                <div class="addfmaily_block">

	                    <div class="addfmaily_content">

	                        <div class="row">
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12" style="padding-bottom:10px">
	                                @if(session()->has('success'))
	                                <div class="alert alert-success fade in alert-dismissible show">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
	                                        <span aria-hidden="true" style="font-size:20px">×</span>
	                                    </button> {{ session()->get('success') }}
	                                </div>
	                                @elseif(session()->has('error'))
	                                <div class="alert alert-danger fade in alert-dismissible show">
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
	                                        <span aria-hidden="true" style="font-size:20px">×</span>
	                                    </button> {{ session()->get('error') }}
	                                </div>
	                                @endif
	                            </div>
	                        </div>

	                        @php
	                        $fam_cnt=0;
	                        @endphp
	                        @if(count($UserFamilyDetails)>0)

	                        @foreach($UserFamilyDetails as $family)
	                        @php 
	                            $mobile_num = $family->mobile;
	                            if (preg_match('/()-/', $mobile_num)){ 
	                                $mobile = $mobile_num;
	                            }else{
	                                $mobile = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $mobile_num);
	                            }

	                            $emergency_contact_num = $family->emergency_contact;
	                            if (preg_match('/()-/', $emergency_contact_num)){
	                                $emergency_contact = $emergency_contact_num;
	                            }else{
	                                $emergency_contact = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $emergency_contact_num);
	                            }@endphp
	                        <div class="row" id="familydiv{{$fam_cnt}}">	
	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="hidden" name="cus_id[{{$fam_cnt}}]" id="cus_id[{{$fam_cnt}}]"  value="{{$family->id}}">
	                                    <input type="text" name="fname[{{$fam_cnt}}]" id="fname[{{$fam_cnt}}]" placeholder="First Name" class="form-control" required="required" value="{{$family->fname}}" >
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="lname[{{$fam_cnt}}]" id="lname[{{$fam_cnt}}]" placeholder="Last Name" class="form-control" required="required" value="{{$family->lname}}" >
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <select name="gender[{{$fam_cnt}}]" id="gender[{{$fam_cnt}}]" class="form-control" required="required" >
	                                        <option value="" hidden>Select Gender</option>
	                                        <option @if(strtolower($family->gender)=='male') selected @endif value="Male">Male</option>
	                                        <option @if(strtolower($family->gender)=='female') selected @endif value="Female">Female</option>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="email" name="email[{{$fam_cnt}}]" id="email[{{$fam_cnt}}]" placeholder="Email" class="form-control" value="{{$family->email}}">
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <select name="relationship[{{$fam_cnt}}]" id="relationship[{{$fam_cnt}}]" class="form-control" required="required" >
	                                        <option value="" hidden>Select Relationship</option>
	                                        <option @if($family->relationship=='Brother') selected @endif  value="Brother">Brother</option>
	                                        <option @if($family->relationship=='Sister') selected @endif  value="Sister">Sister</option>
	                                        <option @if($family->relationship=='Father') selected @endif  value="Father">Father</option>
	                                        <option @if($family->relationship=='Mother') selected @endif  value="Mother">Mother</option>
	                                        <option @if($family->relationship=='Wife') selected @endif  value="Wife">Wife</option>
	                                        <option @if($family->relationship=='Husband') selected @endif  value="Husband">Husband</option>
	                                        <option @if($family->relationship=='Son') selected @endif  value="Son">Son</option>
	                                        <option @if($family->relationship=='Daughter') selected @endif  value="Daughter">Daughter</option>
											<option @if($family->relationship=='Friend') selected @endif  value="Friend">Friend</option>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group dob">
	                                    <label>mm/dd/yyyy</label>
	                                    <input type="text" name="birthdate[{{$fam_cnt}}]" id="birthdate[{{$fam_cnt}}]" placeholder="Birthday" class="form-control birthdate_{{$fam_cnt}} dobcustomerfamily" value="{{date('m/d/Y',strtotime('$family->birthdate'))}}" required="required" maxlength="10" data-behavior="datepicker">
										<script type="text/javascript">
											/*$('.birthdatezebra_'+{{$fam_cnt}}).Zebra_DatePicker({
												format: 'm-d-Y',
												default_position: 'below'
											});*/
											 $( document ).ready(function() {
												$(".birthdate_{{$fam_cnt}}").keyup(function(){
											      	if ($(this).val().length == 2){
											          	$(this).val($(this).val() + "/");
											      	}else if ($(this).val().length == 5){
											          	$(this).val($(this).val() + "/");
											      	}
											  	});
		                                    });
										</script>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="mobile[{{$fam_cnt}}]" id="mobile{{$fam_cnt}}" placeholder="Mobile" class="form-control" value="{{$mobile}}" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  onkeyup="changeformate('mobile{{$fam_cnt}}')">
	                                </div>
	                            </div>
	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="emergency_contact[{{$fam_cnt}}]" id="emergency_contact{{$fam_cnt}}" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="{{$emergency_contact}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate('emergency_contact{{$fam_cnt}}')">
	                                    <input type="hidden" name="removed_family[{{$fam_cnt}}]" id="removed_family{{$fam_cnt}}" value="" >
	                                </div>
	                            </div>
	                            <div style="border-bottom:1px #999999 solid;margin-bottom:10px;text-align: right;" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <i class="fas fa-trash delete-icon" data-del="{{$family->id}}" id="fmldlt"></i></div>
	                        </div>
	                        @php
	                        $fam_cnt++;
	                        @endphp
	                        @endforeach
	                        @else
	                        <div class="row" id="familydiv{{$fam_cnt}}" >
	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="fname[{{$fam_cnt}}]" id="fname[{{$fam_cnt}}]" placeholder="First Name" class="form-control" required="required" onkeypress='return event.charCode >= 65 && event.charCode <= 120'>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="lname[{{$fam_cnt}}]" id="lname[{{$fam_cnt}}]" placeholder="Last Name" class="form-control" required="required" onkeypress='return event.charCode >= 65 && event.charCode <= 120'>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <select name="gender[{{$fam_cnt}}]" id="gender[{{$fam_cnt}}]" class="form-control" required="required" >
	                                        <option value="" hidden>Select Gender</option>
	                                        <option value="Male">Male</option>
	                                        <option value="Female">Female</option>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="email" name="email[{{$fam_cnt}}]" id="email[{{$fam_cnt}}]" placeholder="Email" class="form-control">
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <select name="relationship[{{$fam_cnt}}]" id="relationship[{{$fam_cnt}}]" class="form-control" required="required" >
	                                        <option value="" hidden>Select Relationship</option>
	                                        <option>Brother</option>
	                                        <option>Sister</option>
	                                        <option>Father</option>
	                                        <option>Mother</option>
	                                        <option>Wife</option>
	                                        <option>Husband</option>
	                                        <option>Son</option>
	                                        <option>Daughter</option>
	                                        <option>Friend</option>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group dob">
	                                    <label>mm/dd/yyyy</label>
	                                    <input type="text"  name="birthdate[{{$fam_cnt}}]" id="birthdate[{{$fam_cnt}}]" placeholder="Birthday" class=" form-control birthdate_{{$fam_cnt}}" required="required" maxlength="10" data-behavior="datepicker">
	                                    <script type="text/javascript" >
		                                    /*$('.birthdatezebra_'+{{$fam_cnt}}).Zebra_DatePicker({
		                                        format: 'm-d-Y',
		                                        default_position: 'below'
		                                    });*/
		                                    $( document ).ready(function() {
												$(".birthdate_{{$fam_cnt}}").keyup(function(){
											      	if ($(this).val().length == 2){
											          	$(this).val($(this).val() + "/");
											      	}else if ($(this).val().length == 5){
											          	$(this).val($(this).val() + "/");
											      	}
											  	});
		                                    });
		                                    
		                                </script>
	                                </div>
	                            </div>

	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="number" name="mobile[{{$fam_cnt}}]" id="mobile{{$fam_cnt}}" placeholder="Mobile" maxlength="14" class="form-control" required="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  onkeyup="changeformate('mobile{{$fam_cnt}}')">
	                                </div>
	                            </div>
	                            
	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12">
	                                <div class="form-group">
	                                    <input type="text" name="emergency_contact[{{$fam_cnt}}]" id="emergency_contact[{{$fam_cnt}}]" maxlength="14" placeholder="Emergency Contact Number" class="form-control" required="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  onkeyup="changeformate('emergency_contact[{{$fam_cnt}}]')" >										
	                                    <input type="text" name="removed_family[{{$fam_cnt}}]" id="removed_family{{$fam_cnt}}" value="" />
	                                </div>
	                            </div>
	                        </div> 
	                        @endif
	                    </div>
	                </div>
	                <div class="form-group">
	                    <a class="addmore_addfamily">+ Add More</a>
	                </div>
	                <div class="col-md-12 text-center p-0">
	                    <input type="hidden" name="previous_family_count" id="previous_family_count" value="{{count($UserFamilyDetails)}}" />
	                    <input type="hidden" name="family_count" id="family_count" value="{{$fam_cnt}}" />
	                    <input type="submit" name="btn_family" id="btn_family" value="Submit" class="btn-nxt">
	                </div>
	            </form>
	        </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="{{ url('public/js/custom.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>

    

<script>
  
    $(document).ready(function () {   
        $(".birthdatezebra").Zebra_DatePicker({ format: "m-d-Y" });
        $(".birthdatezebra").Zebra_DatePicker({
            format: "m-d-Y",
            onSelect: function() {
                $(this).change();
                /*alert($(this).val());*/
            }
        });
    });    

         

        $(".addmore_addfamily").click(function () {
            var cnt = $('#family_count').val();
            if(cnt == 0){
                cnt = parseInt(cnt) + parseInt(1);
            }
            var mobileid = "\'mobile" + cnt + "\'";
            var emerconid = "\'emergency_contact" + cnt + "\'";
            var str = '<div class="addfmaily_content mt-3">' +
                    '<div class="row" id="familydiv' + cnt + '"><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><input type="text" name="fname[' + cnt + ']" id="fname[' + cnt + ']" placeholder="First Name" class="form-control" required="required"></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><input type="text" name="lname[' + cnt + ']" id="lname[' + cnt + ']" placeholder="Last Name" class="form-control" required="required"></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><select name="gender[' + cnt + ']" id="gender[' + cnt + ']" class="form-control" required="required" ><option value="" hidden>Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><input type="email" name="email[' + cnt + ']" id="email[' + cnt + ']" placeholder="Email" class="form-control"></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><select name="relationship[' + cnt + ']" id="relationship[' + cnt + ']" class="form-control" required="required" ><option value="" hidden>Select Relationship</option><option>Brother</option><option>Sister</option><option>Father</option><option>Mother</option><option>Wife</option><option>Husband</option><option>Son</option><option>Daughter</option><option>Friend</option></select></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group dob"><label>mm/dd/yyyy</label><input  required="required"  type="text" name="birthdate[' + cnt + ']" id="birthdate[' + cnt + ']"  placeholder="Birthday" class="form-control birthdate_' + cnt + '" value="" maxlength="10" data-behavior="datepicker"></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><input type="text" name="mobile[' + cnt + ']" id="mobile' + cnt + '" placeholder="Mobile" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate('+mobileid+')"></div></div><div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12"><div class="form-group"><input type="text" name="emergency_contact[' + cnt + ']" id="emergency_contact' + cnt + '" placeholder="Emergency Contact Number" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate('+emerconid+')"><input type="text" name="removed_family[' + cnt + ']" id="removed_family' + cnt + '" value="" /></div></div><div style="border-bottom:1px #999999 solid;margin-bottom:10px;text-align: right;" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><i class="fas fa-trash delete-icon deleterem" data-del="' + cnt + '"></i></div></div></div>';
            cnt = parseInt(cnt) + parseInt(1);
            $('#family_count').val(cnt);
            $(".addfmaily_block").append(str);
           /* $( ".birthdate" ).datepicker();*/

            /*$('.birthdatezebra_'+cnt).Zebra_DatePicker({
                format: 'm/d/Y',
                default_position: 'below'
            });*/

           	/*$('.birthdate_'+cnt).keyup(function() {
			   alert('yahoooo0');
			});*/

	        $( document ).ready(function() {
	        	/*alert('doc')*/;
	        	/*$('body').on("keyup",'.birthdate_'+cnt, function(){
	        		alert('birthdate_');
			        //console.log('keyed');
			    });*/

				$('.birthdate_'+cnt).keyup(function(){
					alert('birthdate_');
			      	if ($(this).val().length == 2){
			          	$(this).val($(this).val() + "/");
			      	}else if ($(this).val().length == 5){
			          	$(this).val($(this).val() + "/");
			      	}
			  	});
			});

            $(".birthdatezebra").Zebra_DatePicker({ format: "m/d/Y" });
            $(".birthdatezebra").Zebra_DatePicker({
                format: "m-d-Y",
                onSelect: function() {
                    $(this).change();
                    /*alert($(this).val());*/
                }
            });
        });
    //});


    $(document).on("click", '.delete-icon', function (event) {
        var rm = $(this).attr("data-del");
        //alert(rm);
        /*var fld='removed_family'+rm;
         document.getElementById(fld).value='delete';
         var did="#familydiv"+rm;
         $(did).hide();*/

        var _token = $("input[name='_token']").val();
        $.ajax({
            type: 'POST',
            url: '{{route("removefamilyCustomer")}}',
            data: {
                _token: _token,
                rm: rm
            },
            success: function (data) {
                alert("Delete Family Member");
                window.location.reload();
                //$(".edit_profile_section").load(location.href + " .edit_profile_section");
            }
        });
    });

    function changeformate(idname) {
        /*$('#b_contact').val();*/
        var con = $('#'+idname+'').val();
        var curchr = con.length;
        if (curchr == 3) {
            $('#'+idname+'').val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $('#'+idname+'').val(con + "-");
        }
    }

</script>

@endsection
