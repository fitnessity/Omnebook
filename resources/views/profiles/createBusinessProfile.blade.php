@extends('layouts.profile')

@section('content')

<div class="profile-div">
  <div class="container">
    <div class="row"> 
    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        	<div class="signup-block">
            	<h1>Create Your Profile</h1>
                <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p>
            </div>
            <div class="steps-block">
	            <div class="line-process"></div>
	            	<div class="row">
	                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="step-active pull-left step_1">1</span>
	                    </div>
	                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps"><span class="step_2">2</span>
	                    </div>
	                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right"><span class="pull-right step_3">3</span>
	                    </div>
	                </div>
	        </div>
		    <!-- step 1 starts -->
		    <form  id="frmregister" method="post" action="/profile/saveProfileHistory">
		    	<input type="hidden" name="_token" value="{{csrf_token()}}">
		    	<input type="hidden" name="selected_experience_level" id="selected_experience_level" value="">
		    	<div id="singup_step_1" class="singup_steps">
			    	<div class="step-block1">
			          <h1 class="text-center">Experience & Education</h1>
			          <div class="signup-block">
			            <h3>Rate your Experience Level</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
			                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			                    	<div class="sgnup-rates signup-rates">
			                    		<label name="level" style="display: none;" value="entry_level">entry_level</label>
			                        	<span><i class="fa fa-star"></i></span>
			                            <div class="clearfix"></div>
			                            <h3>ENTRY LEVEL</h3>
			                            <p>Senectus et netus et malesuada fames ac turpis </p>
			                        </div>
			                    </div>

			                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			                    	<div class="sgnup-rates signup-rates">
			                        	<label name="level" style="display: none;" value="intermediate">intermediate</label>
			                        	<span><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
			                            <div class="clearfix"></div>
			                            <h3>INTERMEDIATE</h3>
			                            <p>Senectus et netus et malesuada fames ac turpis </p>
			                        </div>
			                    </div>

			                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			                    	<div class="sgnup-rates signup-rates">
			                        	<label name="level" style="display: none;" value="expert">expert</label>
			                        	<span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
			                            <div class="clearfix"></div>
			                            <h3>Expert</h3>
			                            <p>Senectus et netus et malesuada fames ac turpis </p>
			                        </div>
			                    </div>
			                </div>
			            </div>
				      </div>
				    </div>

				    <div class="step-block1">
			          <h1>Tell Us Something About You</h1>
			          <div class="signup-block">
			            <div class="sgnup-rates mrgn-md-top">
			                <textarea name="about_me" rows="7" maxlength="200" style="width:100%;">{{ @$ProfessionalDetail->about_me }}</textarea>
			            </div>
			            <h6>(upto 200 words are allowed)</h6>
			          </div>
			        </div>

			        <div class="step-block1">
			          <h1>Tell Us Something About Your Business</h1>
			          <div class="signup-block">
			            <div class="sgnup-rates mrgn-md-top">
			                <textarea name="about_business" rows="7" maxlength="200" style="width:100%;">{{ @$ProfessionalDetail->about_business }}</textarea>
			            </div>
			            <h6>(upto 200 words are allowed)</h6>
			          </div>
			        </div>

				    <div class="step-block1">
			          <h1>Training Details</h1>
			          <div class="signup-block">
			          	<p>&nbsp;</p>
			            <h3 class="step2-title">Are you a facility or a freelancer ?</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                        <div class="btn-group" data-toggle="buttons">
			                            <label class="btn btn-primary">
			                            <input type="radio" class="chk" value="facility" name="professional_type" autocomplete="off">
			                            <span class="glyphicon glyphicon-ok"></span> </label>
			                            Facility
			                        </div>
			                    </div>
			                    
			                  </div>
			                  
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary active">
			                          <input type="radio" class="chk" value="freelancer" name="professional_type" autocomplete="off" checked="">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                          Freelancer
			                        </div>
			                    </div>
			                      
			                   </div>
			                </div>
			            </div>
			          	<p>&nbsp;</p>
			            <h3 class="step2-title">To whom you provide training ?</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                        <div class="btn-group" data-toggle="buttons">
			                            <label class="btn btn-primary">
			                            <input type="checkbox" class="chkwhome" value="kid" name="train_to[]" autocomplete="off">
			                            <span class="glyphicon glyphicon-ok"></span> </label>
			                            Kid
			                        </div>
			                    </div>
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary">
			                          <input type="checkbox" class="chkwhome" value="adult" name="train_to[]" autocomplete="off">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                        	Adult
			                       </div>
			                    </div>
			                  </div>
			                  
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary">
			                          <input type="checkbox" class="chkwhome" value="teen" name="train_to[]" autocomplete="off">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                          Teen
			                        </div>
			                    </div>
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary">
			                          <input type="checkbox" class="chkwhome" value="group" name="train_to[]" autocomplete="off">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                          A Group
			                        </div>
			                    </div>  
			                   </div>
			                </div>
			            </div>
			            <p>&nbsp;</p>
			            <h3 class="step2-title">Describe your personality as a trainer ?</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                        <div class="btn-group" data-toggle="buttons">
			                            <label class="btn btn-primary">
			                            <input type="checkbox" class="chkwhome" value="drill-sergeant" name="personality[]" autocomplete="off">
			                            <span class="glyphicon glyphicon-ok"></span> </label>
			                            Drill Sergeant
			                        </div>
			                    </div>
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary">
			                          <input type="checkbox" class="chkwhome" value="educator" name="personality[]" autocomplete="off">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                        	An Educator or Teacher
			                       </div>
			                    </div>
			                  </div>
			                  
			                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
			                    <div class="form-control">
			                      <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-primary">
			                          <input type="checkbox" class="chkwhome" value="supportive" name="personality[]" autocomplete="off">
			                          <span class="glyphicon glyphicon-ok"></span> </label>
			                          A Supportive, Nurturing Coach
			                        </div>
			                    </div>
			                   </div>
			                </div>
			            </div>
			            <p>&nbsp;</p>
			            <h3 class="step2-title">On which days you are available ?</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
				                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="monday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Monday
				                      </div>
				                  </div>
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="wednesday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Wednesday
				                      </div>
				                  </div>
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="friday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Friday
				                      </div>
				                  </div>
				                <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="sunday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Sunday
				                     </div>
				                  </div>
				                </div>
				                
				                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="tuesday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Tuesday
				                      </div>
				                  </div>
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="thursday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Thursday
				                     </div>
				                  </div>
				                  <div class="form-control">
				                    <div class="btn-group" data-toggle="buttons">
				                      <label class="btn btn-primary">
				                        <input type="checkbox" value="saturday" class="chkdy" name="availability[]" autocomplete="off">
				                        <span class="glyphicon glyphicon-ok"></span> </label>
				                      	Saturday
				                     </div>
				                  </div>
				                 </div>
				              </div>
			            </div>

			            <p>&nbsp;</p>
			            <h3 class="step2-title">Are you willing to travel ?</h3>
			            <div class="sgnup-rates mrgn-md-top">
			            	<div class="row">
				                <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
				                	<div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
					                  <div class="form-control">
					                    <div class="btn-group" data-toggle="buttons">
					                      <label class="btn btn-primary willing_to_travel">
					                        <input type="radio" value="yes" class="chkdy" name="willing_to_travel" autocomplete="off">
					                        <span class="glyphicon glyphicon-ok"></span> </label>
					                      	Yes
					                      </div>
					                  </div>
					                </div>
					                <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
					                  <div class="form-control">
					                    <div class="btn-group" data-toggle="buttons">
					                      <label class="btn btn-primary willing_to_travel active">
					                        <input type="radio" value="no" class="chkdy" name="willing_to_travel" autocomplete="off" checked="">
					                        <span class="glyphicon glyphicon-ok"></span> </label>
					                      	No
					                      </div>
					                  </div>
				                  	</div>
				                </div>

				                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
				                	<div class="form-control">
				                	<span class="travel_miles_div" style="display: none;">
							                    <div class="select-style">
							                      <select class="selectpicker" name="travel_miles">
							                      	<option value="1" selected>1 Mile</option>
							                      	<option value="3">3 Miles</option>
							                      	<option value="5">5 Miles</option>
							                      	<option value="10">10 Miles</option>
							                      	<option value="15">15 Miles</option>
							                      	<option value="20">20 Miles</option>
							                      </select>
							                    </div>
							                  
							                  How much distance you willing to travel from your zipcode ?
						            </span>
						            </div>
				                </div>
				              </div>
			            </div>
				      </div>				      
				    </div>

			        <div class="step-block1">
			          <h1>EMPLOYEMENT HISTORY</h1>
			          <div class="signup-block">
			            <div class="row">
			              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			              	<h3 class="step2-title">Add your employment history</h3>
			                <p>Senectus et netus et malesuada fames ac turpis egestas Senectus et netus et malesuada fames ac turpis egestasSenectus et netus et malesuada fames ac turpis egestas </p>
			              </div>
			              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			              	<span class="user-img" style="overflow:inherit;">
			              		<i class="fa fa-briefcase"></i>
			              		<!-- <a href="javascript:void();" class="add_sngp" id="add_sngp" data-toggle="modal" data-target="#addEmployementHistory">+</a> -->
			              		<a href="#" class="add_sngp" id="add_sngp">+</a>
			              	</span>
			              </div>

			              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				              	<div class="table-responsive">
				                	<table class="table add_education" id="employement_history_table" cellpadding="0" cellspacingg="0" border="0">
				                    	<thead>
				                        	<tr>
				                            	<th>Organization</th>
				                                <th>Position</th>
				                                <th>From</th>
				                                <th>To</th>
				                                <th>Action</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	<tr id="history_0">				                            	
				                            </tr>
				                        </tbody>
				                    </table>
				                </div>
				            </div>

			              <!-- Modal -->
						    <div class="modal fade" id="addEmployementHistory" role="dialog">
						    
						    <input type="hidden" name="editrowcount" id="editrowcount" value="">
						      <div class="modal-dialog modal-lg">
						        <!-- Modal content-->
						        <div class="modal-content">
						          <div class="modal-body login-pad">
						            <div class="pop-title employe-title">
						              <h3>EMPLOYEMENT HISTORY</h3>
						            </div>
						            <button type="button" class="close modal-close" data-dismiss="modal">
						        		<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
						        	</button>
						        	
						            <div class="signup">
						            	<div id='systemMessage_history'></div>
						                <div class="emplouyee-form">
								            <input type="text" name="frm_organization" placeholder="Organization name" />
								            <input type="text" name="frm_position" placeholder="Position" />
								            <div class="qh-steps-form">
							                  <div class="form-control">
							                    <div class="btn-group" data-toggle="buttons">
							                      <label class="btn btn-primary present_work_btn">
							                        <input type="checkbox" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1">
							                        <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
							                        <span class="glyphicon glyphicon-ok"></span>
							                      </label>
							                      <span class="qh-lbl qh-lbl2">Presently working here</span> </div>
							                  </div>
							                </div>
								            <input type="text" name="frm_servicestart" class="span2" placeholder="From" id="dp1" >
								            <input type="text" name="frm_serviceend" class="span2" placeholder="To" id="dp2" >
						              		<button type="button" id="submit_employement_history">SUBMIT</button>
						              	</div>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>
			            </div>
			          </div>
			        </div>

			        <div class="step-block1">
			          <h1>Education</h1>
			          <div class="signup-block">
			            <div class="row">
			              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			              	<div class="table-responsive">
			                	<table class="table add_education" id="education_table" cellpadding="0" cellspacing="0" border="0">
			                    	<thead>
			                        	<tr>
			                            	<th>Degree/Course</th>
			                                <th>University/School</th>
			                                <th>Year graduated/projected graduation</th>
			                                <th>Action</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	<tr id="education_0">				                            	
				                        </tr>
			                        </tbody>
			                    </table>
			                </div>
			              </div>

			              <!-- Education Modal -->
						    <div class="modal fade" id="addEducation" role="dialog">
							    <input type="hidden" name="editrowcount_education" id="editrowcount_education" value="">
							      <div class="modal-dialog modal-lg">
							        <!-- Modal content-->
							        <div class="modal-content">
							          <div class="modal-body login-pad">
							            <div class="pop-title employe-title">
							              <h3>Education Details</h3>
							            </div>
							            <button type="button" class="close modal-close" data-dismiss="modal">
							        		<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
							        	</button>
							            <div class="signup">
							            	<div id='systemMessage_education'></div>
							                <div class="emplouyee-form">
									            <input type="text" name="frm_course" placeholder="Degree/Course (Obtained or Seeking)" />
									            <input type="text" name="frm_university" placeholder="University/School" />
									            <input type="text" name="frm_passingyear" placeholder="Year graduated/projected graduation" id="passingyear">
							              		<button type="button" id="submit_education">SUBMIT</button>
							              	</div>
							            </div>
							          </div>
							        </div>
							     </div>
						    </div>
						    <!-- Education Modal -->

			            </div>
			            <button class="upload-pic" id="add_education" type="button">ADD EDUCATION</button>
			          </div>
			        </div>

			        <div class="step-block1">
			          <h1>CERTIFICATE</h1>
			          <div class="signup-block">
			            <div class="row">
			              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			              	<h3 class="step2-title">Add your certification & Achievement</h3>
			                <p>Senectus et netus et malesuada fames ac turpis egestas Senectus et netus et malesuada fames ac turpis egestasSenectus et netus et malesuada fames ac turpis egestas </p>
			              </div>
			              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			              	<span class="user-img" style="overflow:inherit;">
			              		<i class="fa fa-shield"></i>
			              		<a href="#" class="add_sngp" id="add_certificate">+</a>
			              	</span>
			              </div>

			              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				              	<div class="table-responsive">
				                	<table class="table add_education" id="certificate_table" cellpadding="0" cellspacing="0" border="0">
				                    	<thead>
				                        	<tr>
				                            	<th>Name of Certification</th>
				                                <th>Completion Date</th>
				                                <th>Action</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        	<tr id="certificate_0">				                            	
				                            </tr>
				                        </tbody>
				                    </table>
				                </div>
				            </div>

				            <!-- Modal -->
						    <div class="modal fade" id="addCertificate" role="dialog">
						    <input type="hidden" name="editrowcount_certificate" id="editrowcount_certificate" value="">
						      <div class="modal-dialog modal-lg">
						        <!-- Modal content-->
						        <div class="modal-content">
						          <div class="modal-body login-pad">
						            <div class="pop-title employe-title">
						              <h3>Certications</h3>
						            </div>
						            <button type="button" class="close modal-close" data-dismiss="modal">
							        	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
							        </button>
						            <div class="signup">
						            	<div id='systemMessage_certificate'></div>
						                <div class="emplouyee-form">
								            <input type="text" name="frm_certificatetitle" placeholder="Name of Certification"/>
								            <input type="text" name="frm_certificatecompletion" placeholder="Completion Date" id="certificatecompletion" />
						              		<button type="button" id="submit_certificate">SUBMIT</button>
						              	</div>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>

			            </div>
			          </div>
			        </div>

			        <div class="step-block1">
			          <h1 class="text-right">lorem ipsum dolor</h1>
			          <div class="signup-block signup-block1">
			            <h3>What are the main services offer to the clients ?</h3>
			              <div class="row">

			                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center service-icon">
			                	<span class="user-img" style="overflow:inherit;">
			                		<i class="fa fa-briefcase"></i>
			                		<a href="#" class="add_sngp" id="add_service">+</a>
			                	</span>
			                </div>
			                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 text-left ">
			                  <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
			                  	<!-- <a href="#" class="start-over" id="add_service">START OVER
			                  		<i class="fa fa-angle-right"></i>
			                  	</a> -->
			                </div>

			                <div class="modal fade" id="addService" role="dialog">
						      <input type="hidden" name="editrowcount_service" id="editrowcount_service" value="">
						      <div class="modal-dialog modal-lg">
						        <!-- Modal content-->
						        <div class="modal-content">
						          <div class="modal-body login-pad">
						            <div class="pop-title employe-title">
						              <h3>Services</h3>
						            </div>
						            <button type="button" class="close modal-close" data-dismiss="modal">
							        	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
							        </button>
						            <div class="signup">
						            	<div id='systemMessage_service'></div>            	
						                <div class="emplouyee-form">
								            <div class="select-style review-select2">
				                            	<select name="frm_servicesport" id="frm_servicesport" class="selectpicker">
				                            		{!! $sports_select !!}
				                            	</select>
				                            </div>
				                            <input type="text" name="frm_servicetitle" id="frm_servicetitle" placeholder="Name of Service"/>
								            <input type="text" name="frm_serviceprice" id="frm_serviceprice" value="$"/>
								            <textarea name="frm_servicedesc" id="frm_servicedesc" placeholder="Description"></textarea>
						              		<button type="button" id="submit_service">SUBMIT</button>
						              	</div>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>

			              </div>
			          </div>
			        </div>

			        <div class="step-block1">
			          <!-- <h1>Services</h1> -->
			          <div class="services-block">
			          	<input type="hidden" name="total_service" id="total_service" value="0">
			            <div class="row"  id="service_div">			              
			            </div>
			          </div>
			        </div>

			        <div class="step-block1">
			         	<button type="submit" class="button-nxt button-next">Save & Continue<i class="fa fa-angle-double-right"></i></button>
			        </div>
		    	</div>
		    </form>

		    <!-- step 1 ends -->

        </div>

        @include('includes.sidebar_signup')

    </div>
    

  </div>

</div>

<script>

    $(document).ready(function(){

    	$(".singup_steps").hide();
    	$("#singup_step_1").show();
        $("#frm_serviceprice").keydown(function(e) {
            var field=this;
            setTimeout(function () {
                if(field.value.indexOf('$') !== 0) {
                    $(field).val('$');
                } 
            }, 1);
        });

    	/*** employment history form process - starts ***/

    	$("#addEmployementHistory").on("hidden.bs.modal", function(){
            removeFormValues('addEmployementHistory');
        });

     	// open employement history form 
        $("#add_sngp").click(function() {
        	$('#addEmployementHistory').modal('show');
        });

        // save employement history form
        $("#submit_employement_history").click(function() {

        	// check validations
        	if(!validateFormEmploymentHistory()) {
        		return false;
        	}

        	// check if form is open in edit mode
        	var editrowcount = $("#addEmployementHistory").find("input[name='editrowcount']").val();
        	if(editrowcount != "") {

        		$("#addEmployementHistory").find("input").each(function() {
		    		var form_element_name = $(this).attr('name').split("_");
		    		form_element_name = form_element_name[1];
		    		$("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
		    	});
        	}
        	else {

        		var last_row_id = $("#employement_history_table > tbody > tr:last-child").closest('tr').attr('id');
        		var last_row_count = last_row_id.split("_");
        		employement_history_count = parseInt(last_row_count[1]) + 1;
	        	var newrow = '<tr id="history_'+employement_history_count+'">'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="organization[]" value="'+$("input:text[name='frm_organization']").val()+'" class="noborder" title="organization" readonly>'
	        				+  '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="position[]" value="'+$("input:text[name='frm_position']").val()+'" class="noborder"  title="position" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="hidden" name="ispresent[]" value="'+$("#frm_ispresent").val()+'" class="noborder" title="ispresent">'
	        				+ '<input type="text" name="servicestart[]" value="'+$("input:text[name='frm_servicestart']").val()+'" class="noborder"  title="servicestart" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="serviceend[]" value="'+$("input:text[name='frm_serviceend']").val()+'" class="noborder"  title="serviceend" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle" align="center">'
	        				+ '		<a href="javascript:editHistory('+employement_history_count+')"><i class="fa fa-pencil-square"></i></a>'
	        				+ '		<a href="javascript:deleteRow(\'history_'+employement_history_count+'\')"><i class="fa fa-trash"></i></a>'
	        				+ '</td>'
	        				+ '</tr>';

	        	$("#employement_history_table > tbody:last-child").append(newrow);
        	}        	

        	// remove form field values
        	removeFormValues('addEmployementHistory');
        	$('#addEmployementHistory').modal('hide');
        });

        /*** education form process - starts ***/
    	$("#addEducation").on("hidden.bs.modal", function(){
            removeFormValues('addEducation');
        });

     	// open education form 
        $("#add_education").click(function() {
        	$('#addEducation').modal('show');
        });

        // save education form
        $("#submit_education").click(function() {

        	// check validations
        	if(!validateFormEducation()) {
        		return false;
        	}

        	// check if form is open in edit mode
        	var editrowcount = $("#addEducation").find("input[name='editrowcount_education']").val();
        	if(editrowcount != "") {

        		$("#addEducation").find("input").each(function() {
		    		var form_element_name = $(this).attr('name').split("_");
		    		form_element_name = form_element_name[1];
		    		$("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
		    	});
        	}
        	else {

        		var last_row_id = $("#education_table > tbody > tr:last-child").closest('tr').attr('id');
        		var last_row_count = last_row_id.split("_");
        		education_count = parseInt(last_row_count[1]) + 1;
	        	var newrow = '<tr id="education_'+education_count+'">'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="course[]" value="'+$("input:text[name='frm_course']").val()+'" class="noborder" title="course" readonly>'
	        				+  '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="university[]" value="'+$("input:text[name='frm_university']").val()+'" class="noborder"  title="university" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="passingyear[]" value="'+$("input:text[name='frm_passingyear']").val()+'" class="noborder"  title="passingyear" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle" align="center">'
	        				+ '		<a href="javascript:editEducation('+education_count+')"><i class="fa fa-pencil-square"></i></a>'
	        				+ '		<a href="javascript:deleteRow(\'education_'+education_count+'\')"><i class="fa fa-trash"></i></a>'
	        				+ '</td>'
	        				+ '</tr>';

	        	$("#education_table > tbody:last-child").append(newrow);
        	}        	

        	// remove form field values
        	removeFormValues('addEducation');
        	$('#addEducation').modal('hide');
        });

        /*** certification form process - starts ***/
    	$("#addCertificate").on("hidden.bs.modal", function(){
            removeFormValues('addCertificate');
        });

     	// open certification form 
        $("#add_certificate").click(function() {
        	$('#addCertificate').modal('show');
        });

        // save certificate form
        $("#submit_certificate").click(function() {

        	// check validations
        	if(!validateFormCertificate()) {
        		return false;
        	}

        	// check if form is open in edit mode
        	var editrowcount = $("#addCertificate").find("input[name='editrowcount_certificate']").val();
        	if(editrowcount != "") {

        		$("#addCertificate").find("input").each(function() {
		    		var form_element_name = $(this).attr('name').split("_");
		    		form_element_name = form_element_name[1];
		    		$("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
		    	});
        	}
        	else {

        		var last_row_id = $("#certificate_table > tbody > tr:last-child").closest('tr').attr('id');
        		var last_row_count = last_row_id.split("_");
        		certificate_count = parseInt(last_row_count[1]) + 1;
	        	var newrow = '<tr id="certificate_'+certificate_count+'">'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="certificatetitle[]" value="'+$("input:text[name='frm_certificatetitle']").val()+'" class="noborder" title="certificatetitle" readonly>'
	        				+  '</td>'
	        				+ '<td valign="middle">' 
	        				+ '<input type="text" name="certificatecompletion[]" value="'+$("input:text[name='frm_certificatecompletion']").val()+'" class="noborder"  title="certificatecompletion" readonly>'
	        				+ '</td>'
	        				+ '<td valign="middle" align="center">'
	        				+ '		<a href="javascript:editCertificate('+certificate_count+')"><i class="fa fa-pencil-square"></i></a>'
	        				+ '		<a href="javascript:deleteRow(\'certificate_'+certificate_count+'\')"><i class="fa fa-trash"></i></a>'
	        				+ '</td>'
	        				+ '</tr>';

	        	$("#certificate_table > tbody:last-child").append(newrow);
        	}        	

        	// remove form field values
        	removeFormValues('addCertificate');
        	$('#addCertificate').modal('hide');
        });

        /*** services form process - starts ***/
    	$("#addService").on("hidden.bs.modal", function(){
            removeFormValues('addService');
        });

     	// open service form 
        $("#add_service").click(function() {
        	$('#addService').modal('show');
        });

        // save service form
        $("#submit_service").click(function() {

        	// check validations
        	if(!validateFormService()) {
        		return false;
        	}

        	// check if form is open in edit mode
        	var editrowcount = $("#addService").find("input[name='editrowcount_service']").val();
        	if(editrowcount != "") {
        		var selected_id = $("#"+editrowcount).find("input[name='service_id[]']").val();
        		if(selected_id > 0) {
        			if($("#edited_service_id").val() == "")
        				$("#edited_service_id").val(selected_id);
        			else
        				$("#edited_service_id").val($("#edited_service_id").val() +","+ selected_id);
        		}
        		$("#addService").find("input").each(function() {
		    		var form_element_name = $(this).attr('name').split("_");
		    		form_element_name = form_element_name[1];
		    		$("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
		    	});
		    	$("#"+editrowcount).find("input[title='servicesport']").val($("#frm_servicesport").val());
		    	$("#"+editrowcount).find("input[title='servicedesc']").val($("#frm_servicedesc").val());
		    	$("#"+editrowcount).find(".display_servicesport").html($("#frm_servicesport option:selected").text());
		    	$("#"+editrowcount).find(".display_servicetitle").html('<strong>' + $("#frm_servicetitle").val() + ' (' +$("#frm_serviceprice").val() + ')' + '</strong>');
		    	$("#"+editrowcount).find(".display_servicedesc").html($("#frm_servicedesc").val().substr(0,50)+"...");
        	}
        	else {
        		var last_row_count = $("total_service").val();
        		service_count = parseInt(last_row_count) + 1;
        		$("total_service").val(service_count);
		        var newrow = '<div id="service_'+service_count+'">'
		        			+ '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">'
				            + '	<div class="services-list">'
				            + '	<a href="javascript:editService('+service_count+')" class="decoration-none">'
				            + '		<span class="srv-list-icon">'
				            + '			<i class="fa fa-briefcase"></i>'
				            + '		</span>'
				            + '		</a>'
				            + '		<div class="clearfix"></div>'
				            + '		<h3>'
				            + '		<input type="hidden" name="servicesport[]" value="'+$("#frm_servicesport").val()+'" title="servicesport">'
				            + '	<a href="javascript:editService('+service_count+')" class="decoration-none">'
				            + ' 	<span class="display_servicesport">'
				            + 		$("#frm_servicesport option:selected").text()
				            + '		</span>' 
				            + '	</a>'
				            + '	<a href="javascript:deleteRow(\'service_'+service_count+'\')" title="Delete this detail" class="delete_icon"><i class="fa fa-trash"></i></a>'
				            + '	</h3>'
				            + '		<div class="clearfix"></div>'
				            + '		<input type="hidden" name="servicetitle[]" value="'+$("#frm_servicetitle").val()+'" title="servicetitle">'
				            + '		<p class="display_servicetitle">'+'<strong>'+ $("#frm_servicetitle").val() + ' ('+ $("#frm_serviceprice").val() +')' + '</p>' + '</strong>'
				            + '		<div class="clearfix"></div>'
				            + '		<input type="hidden" name="serviceprice[]" value="'+$("input:text[name='frm_serviceprice']").val()+'" title="serviceprice">'
				            + '		<div class="clearfix"></div>'
				            + '		<input type="hidden" name="servicedesc[]" value="'+$("#frm_servicedesc").val()+'" title="servicedesc">'
				            + '		<p class="display_servicedesc">'+ $("#frm_servicedesc").val().substr(0,50) +'...</p>'
				            + '	</div>'
				            + '</div>';

		        $("#service_div:last-child").append(newrow);
		    }

        	// remove form field values
        	removeFormValues('addService');
        	$('#addService').modal('hide');
        });

		$(".button-back").click(function() {
			var steps_div_id = $(this).closest('div[class="singup_steps"]').attr("id");
			var step_id = steps_div_id.split("_");
			var current_step = step_id[2];
			var next_step = parseInt(current_step) - 1;

			$("#singup_step_"+current_step).fadeOut(function () {
			  $("#singup_step_"+next_step).fadeIn(1000);
			});

			$('.steps').find('.step_'+next_step).addClass("step-active");
		});

		$(".signup-rates").click(function() {
			$(".signup-rates").removeClass('active');
			var label_value = $(this).find('label').html();
			$(this).addClass('active');
			$('#selected_experience_level').val(label_value);
		});

		$("label.present_work_btn").click(function() {
			$("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
			changeDateBasedonPresent();
		});
    });

	function changeDateBasedonPresent()
	{
		if($("#frm_ispresentcheck").attr("checked")) {
				$("#frm_ispresent").val("1");
				$("#dp2").val("Till Date");
				$("#dp2").attr("disabled", true);	
			}else {
				$("#frm_ispresent").val("0");
				$("#dp2").val("");
				$("#dp2").attr("disabled", false);
			}
	}

	function validateFormEmploymentHistory()
	{
		var msg = '';
		var returnVal;
		returnVal = true;

		if($("input:text[name='frm_organization']").val() == "") {
			msg += '<br>Enter Organization';
			returnVal = false;
		}
		if($("input:text[name='frm_position']").val() == "") {
			msg += '<br>Enter Position';
			returnVal = false;
		}
		if($("input:text[name='frm_servicestart']").val() == "") {
			msg += '<br>Enter Service start date';
			returnVal = false;
		}
		if(!$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() == "") {
			msg += '<br>Enter Service end date';
			returnVal = false;
		}
		if($("input:text[name='frm_servicestart']").val() != "" && !$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() != "") {
			var selected_startDate = $("input:text[name='frm_servicestart']").val().split("-");
			var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
			var selected_endDate = $("input:text[name='frm_serviceend']").val().split("-");
			var endDate = new Date(selected_endDate[2], selected_endDate[1]-1, selected_endDate[0]);
			if (startDate.valueOf() > endDate.valueOf()) {
				msg += '<br>The from-date can not be greater then the to-date';
				returnVal = false;
			}
		}
		if(!returnVal) {
			showSystemMessages('#systemMessage_history', 'danger', msg);
			return false;
		}
		return true;		
	}

	function validateFormEducation()
	{
		var msg = '';
		var returnVal;
		returnVal = true;
		if($("input:text[name='frm_course']").val() == "") {
			msg += '<br>Enter Course';
			returnVal = false;
		}
		if($("input:text[name='frm_university']").val() == "") {
			msg += '<br>Enter University';
			returnVal = false;
		}
		if($("input:text[name='passingyear']").val() == "") {
			msg += '<br>Enter Passing year';
			returnVal = false;
		}
		if(!returnVal) {
			showSystemMessages('#systemMessage_education', 'danger', msg);
			return false;
		}
		return true;		
	}

	function validateFormCertificate()
	{
		var msg = '';
		var returnVal;
		returnVal = true;
		if($("input:text[name='frm_certificatetitle']").val() == "") {
			msg += '<br>Enter Name of certification';
			returnVal = false;
		}
		if($("input:text[name='frm_certificatecompletion']").val() == "") {
			msg += '<br>Enter Completion date';
			returnVal = false;
		}
		if(!returnVal) {
			showSystemMessages('#systemMessage_certificate', 'danger', msg);
			return false;
		}
		return true;		
	}

	function validateFormService()
	{
		var msg = '';
		var returnVal;
		returnVal = true;
		if($("select[name='frm_servicesport']").val() == "") {
			msg += '<br>Select Sport';
			returnVal = false;
		}
		if($("input:text[name='frm_servicetitle']").val() == "") {
			msg += '<br>Enter Name of service';
			returnVal = false;
		}
		if($("input:text[name='frm_serviceprice']").val() == "") {
			msg += '<br>Enter Price for service';
			returnVal = false;
		}else {
                    var price = $("input:text[name='frm_serviceprice']").val();
                    var valid = /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{0,2})?$/.test(price);                    
                    if(!valid) {
                        msg += '<br>Enter proper Price for service';
			returnVal = false;
                    }
                }
		if($("input:text[name='frm_servicedesc']").val() == "") {
			msg += '<br>Enter Description';
			returnVal = false;
		}
		if(!returnVal) {
			showSystemMessages('#systemMessage_service', 'danger', msg);
			return false;
		}
		return true;		
	}

	function editHistory(rowcount)
    {
    	$("#history_"+rowcount).find("input").each(function() {
    		var form_element_name = $(this).attr('title');
    		$("#addEmployementHistory").find("input[name='frm_"+form_element_name+"']").val($(this).val());
    	});

    	if($("#frm_ispresent").val() == "1") {
    		$("#frm_ispresentcheck").attr("checked",true);
    		$("label.present_work_btn").addClass('active');
    		changeDateBasedonPresent();
    	}else {
    		$("#frm_ispresentcheck").attr("checked",false);
    	}
    	
    	$("#addEmployementHistory").find("input[id='editrowcount']").val("history_"+rowcount);
    	$('#addEmployementHistory').modal('show');
    }

    function editEducation(rowcount)
    {
    	$("#education_"+rowcount).find("input").each(function() {
    		var form_element_name = $(this).attr('title');
    		$("#addEducation").find("input[name='frm_"+form_element_name+"']").val($(this).val());
    	});
    	$("#addEducation").find("input[id='editrowcount_education']").val("education_"+rowcount);
    	$('#addEducation').modal('show');
    }

    function editCertificate(rowcount)
    {
    	$("#certificate_"+rowcount).find("input").each(function() {
    		var form_element_name = $(this).attr('title');
    		$("#addCertificate").find("input[name='frm_"+form_element_name+"']").val($(this).val());
    	});
    	$("#addCertificate").find("input[id='editrowcount_certificate']").val("certificate_"+rowcount);
    	$('#addCertificate').modal('show');
    }

    function editService(rowcount)
    {
    	$("#service_"+rowcount).find("input").each(function() {
    		var form_element_name = $(this).attr('title');
    		if(form_element_name == "servicedesc")
    			$("#addService").find("#frm_servicedesc").val($(this).val());
    		else if(form_element_name == "servicesport")
    			$("#addService").find("#frm_servicesport").val($(this).val());
    		else
    			$("#addService").find("input[name='frm_"+form_element_name+"']").val($(this).val());
    	});
    	$("#addService").find("input[id='editrowcount_service']").val("service_"+rowcount);
    	$('#addService').modal('show');
    }

    function deleteRow(rowid)
    {
    	$("#"+rowid).remove();
    }        

    function removeFormValues(modalName)
    {
    	var modalElement = $('#'+modalName).find("input");
    	modalElement.each(function() {
    		$(this).val('');
    	});
    	if(modalName == "addEmployementHistory") {
    		$("#systemMessage_history").html('');
    		$("#frm_ispresentcheck").attr("checked",false);
    		$("label.present_work_btn").removeClass('active');
    		$("#dp2").val("");
			$("#dp2").attr("disabled", false);
    	}
    	else if(modalName == "addEducation") {
    		$("#systemMessage_education").html('');
    	}    	
    	else if(modalName == "addCertificate") {
    		$("#systemMessage_certificate").html('');
    	}
    	else if(modalName == "addService") {
    		$("#frm_servicedesc").val('');
    		$("#frm_servicesport").val('');
    		$("#systemMessage_service").html('');
    	}
    }

    $("label.btn").click(function() {
              // find clicked button radio option name
              var radio_option = $(this).find('input[type=radio]');
              if ($(radio_option).is(':radio')) {
                var radio_option_name = $(radio_option).attr('name');
                // make all other options to null
                $('input[type=radio][name="'+radio_option_name+'"]').each(function() {
                  $(this).closest('label.btn').removeClass('active');
                });
                // make current selection active
                $(this).addClass('active');
              }              
        });    

    $(".willing_to_travel").click(function() {
    	var willing_to_travel_radio = $(this).find('input[type=radio]');  
    	var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     

    	if(willing_to_travel_val == 'yes'){
    		$('.travel_miles_div').show();
    	} else {
			$('.travel_miles_div').hide();
			$('.selectpicker').val('1');
    	}
    	
    });    
    
</script>	

<script>
		if (top.location != location) {
		    top.location.href = document.location.href ;
		}
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'dd-mm-yyyy'
			}).on('changeDate', function(ev){
					var selected_enddate = $('#dp2').val().split("-");
					var endDate = new Date(selected_enddate[2], selected_enddate[1]-1, selected_enddate[0]);
					console.log(ev.date +"--"+endDate +"--"+ ev.date.valueOf() +"--"+ endDate.valueOf());
					if (ev.date.valueOf() > endDate.valueOf()){	console.log(ev.date.valueOf());
						showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
					} else {
						$('#systemMessage_history').html('');
						// startDate = new Date(ev.date);
					}
					$('#dp1').datepicker('hide');
			});
			$('#dp2').datepicker({
				format: 'dd-mm-yyyy'
			}).on('changeDate', function(ev){
					var selected_startDate = $('#dp1').val().split("-");
					var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
					console.log(startDate +"--"+ev.date +"--"+ startDate.valueOf() +"--"+ ev.date.valueOf());
					if (startDate.valueOf() > ev.date.valueOf()){ console.log(ev.date.valueOf());
						showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
					} else {
						$('#systemMessage_history').html('');
						// startDate = new Date(ev.date);
					}
					$('#dp2').datepicker('hide');
			});
			$('#passingyear').datepicker({
				format: 'dd-mm-yyyy'
			});
			$('#certificatecompletion').datepicker({
				format: 'dd-mm-yyyy'
			});
			
			
			// $('#dp3').datepicker();
			// $('#dp3').datepicker();
			// $('#dpYears').datepicker();
			// $('#dpMonths').datepicker();
			
			
			// var startDate = new Date(2012,1,20);
			// var endDate = new Date(2012,1,25);
			// $('#dp4').datepicker()
			// 	.on('changeDate', function(ev){
			// 		if (ev.date.valueOf() > endDate.valueOf()){
			// 			$('#alert').show().find('strong').text('The start date can not be greater then the end date');
			// 		} else {
			// 			$('#alert').hide();
			// 			startDate = new Date(ev.date);
			// 			$('#startDate').text($('#dp4').data('date'));
			// 		}
			// 		$('#dp4').datepicker('hide');
			// 	});
			// $('#dp5').datepicker()
			// 	.on('changeDate', function(ev){
			// 		if (ev.date.valueOf() < startDate.valueOf()){
			// 			$('#alert').show().find('strong').text('The end date can not be less then the start date');
			// 		} else {
			// 			$('#alert').hide();
			// 			endDate = new Date(ev.date);
			// 			$('#endDate').text($('#dp5').data('date'));
			// 		}
			// 		$('#dp5').datepicker('hide');
			// 	});

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>

@endsection