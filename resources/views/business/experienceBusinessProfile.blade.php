@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="empHistory" name="empHistory" method="post" action="{{route('addbusinessexperience')}}">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <div class="container-fluid p-0" id="detail-form1">
                    <div class="tab-hed">Tells us About Your Experience</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-right: 200px;">
                                <div class="col-md-12">
                                    <div class="his-hed">Employment History</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Company Name </label>
                                    <input type="text" name="frm_organisationname" id="frm_organisationname" placeholder="Organization name" class="form-control">
                                    <span class="error" id="b_organisationname"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Position </label>
                                    <input type="text" class="form-control" id="frm_position" name="frm_position" placeholder="Position">
                                    <span class="error" id="b_position"></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=" present_work_btn">
                                            <input type="checkbox" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1">
                                            <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
                                            <span>I Still Work Here</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6" id="dp1-position">
                                    <label for="email">From</label>
                                    <div class="special-date">
                                        <input type="text" class="form-control span2" name="frm_servicestart" placeholder="From" id="dp1" readonly="readonly">
                                        <span class="error" id="b_employmentfrom"></span>
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <script>
                                        $('#dp1').datepicker();

                                    </script>
                                </div>
                                <div class="form-group col-md-6" id="dp2-position">
                                    <label for="pwd">To</label>
                                    <div class="special-date">
                                        <input type="text" class="form-control" id="dp2" name="frm_serviceend" placeholder="To" readonly="readonly">
                                        <span class="error" id="b_employmentto"></span>
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <script>
                                        $('#dp2').datepicker();

                                    </script>
                                </div>
                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12">
                                    <div class="his-hed">Education Details</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Degree - Course</label>
                                    <input type="text" id="frm_course" name="frm_course" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)">
                                    <span class="error" id="b_degree"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">University - School</label>
                                    <input type="text" id="frm_university" name="frm_university" class="form-control frm_university" placeholder="University/School">
                                    <span class="error" id="b_university"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Year Graduated</label>
                                    <input id="passingyear" name="frm_passingyear" class="form-control" placeholder="Year graduated" type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" autocomplete="off">
                                    <span class="error" id="b_year"></span>
                                </div>
                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12">
                                    <div class="his-hed">Certification Details</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Name of Certification</label>

                                    <input type="text" id="certification" name="certification" class="form-control" placeholder="Name of Certification">
                                    <span class="error" id="b_certification"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Completion Date</label>
                                    <div class="special-date">
                                        <input type="text" class="form-control" id="completionyear" name="frm_passingdate" placeholder="Completion Date" autocomplete="off" readonly="readonly">
                                        <span class="error" id="b_certificateyear"></span>
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <script>
                                        $('#completionyear').datepicker();

                                    </script>
                                </div>
                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12">
                                    <div class="his-hed">Skills, Achievments And Awards</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Skill Type</label>
                                        <select name="skill_type" id="skiils_achievments_awards1" class="form-control my-select">
                                            <option value="">Select Item</option>
                                            <option value="Skills">Skills</option>
                                            <option value="Achievment">Achievments</option>
                                            <option value="Award">Awards</option>
                                        </select>
                                        <span class="error" id="b_skilltype"></span>
                                    </div>
                                    <div class="form-group" id="skillcompletionpicker-position">
                                        <label for="email">Completion Date</label>
                                        <div class="special-date">
                                            <input type="text" name="skillcompletion" class="form-control" id="skillcompletionpicker" placeholder="Completion Date" readonly="readonly" autocomplete="off">
                                            <span class="error" id="b_skillyear"></span>
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <script>
                                            $('#skillcompletionpicker').datepicker();

                                        </script>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Description</label>
                                    <textarea name="frm_skilldetail" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control"></textarea>
                                    <span class="error" id="b_skilldetail"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" onclick="location.href ='{{route('companyBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt2">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </section>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
