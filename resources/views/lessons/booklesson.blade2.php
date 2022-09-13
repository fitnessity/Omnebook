    <!-- Modal content-->

  <?php $step_count=17;?>
  <?php $current_step=1;?>
<style type="text/css"> 
  #signupoption {display: none;}
  #chooseoption {display: block;}
</style>
    <?php if(@$selectedSportId > 0){ 
      $url = '/direct-hire?selected_sport='.$selectedSportId;
    } else { 
      $url = '/direct-hire';
    } ?>

    <div class="modal-content" id="chooseoption">
      <div class="modal-body login-pad">
        <div class="lesson_modal_content">
          <div class="pop-title">
            <h3>Booking Options</h3>
          </div>
          <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
          </button>
          <div class="signup">
            <div class="row">
              <div class="col-md-12">
                <div class="col-lg-12 signup-3row signup-new-3row">
                    <div class="signleft-3row">
                        <div class="new-signup-left-3row img1" style="">
                          <h2>HIRE A PROFESSIONAL</h2>
                          <button type="button" id="hire_professional">Select</button>
                        </div>          
                    </div>

                    <div class="signleft-3row">
                        <div class="new-signup-left-3row img2" style="">
                          <h2>BOOK A CLASS</h2>
                          <button type="button" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                        </div>          
                    </div>
                
                    <div class="signleft-3row">
                        <div class="new-signup-left-3row img3" style="">
                          <h2>BOOK AN ADVENTURE</h2>
                          <button type="button" onclick="window.location.href = '<?php echo $url; ?>'">Select</button>
                        </div>          
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-content" id="signupoption">

      <div class="modal-body login-pad">

        <div class="lesson_modal_content" id ="step_0">

        <div class="pop-title">
            <h3>OPTION IS YOURS</h3>
        </div>

        <button type="button" class="close modal-close clsbtn" data-dismiss="modal">

          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

        </button>

        <div class="signup">

           <div class="signup advance-search-popup">
           <p class="advance-para">CHOOOSE HOW YOU WOULD LIKE TO SEARCH AND HIRE A SERVICE PROVIDER</p>
          <div class="signleft">
            <h3>QUICK HIRE</h3>
            <p style="min-height: 210px;">Use the speedy Quick Hire search option to find a local service provider in under 5 minutes or less. Answer a few questions and have up to 20 local professionals that best match your requirements send you quotes by email within 24 to 48 hours. Read the quotes, respond if you like or hire the best provider for you.</p>
            <a href="javascript:void(0);" onClick="showStep('sport_select')">CONTINUE</a>
          </div>
        <div class="signright">
         <h3>DIRECT HIRE</h3>
            <p style="min-height: 210px;">Use the smart search filter option to pin point exactly what you want. Compare service providers side by side to find great lessons, classes, adventures, services, prices, personality type and more. Once you’re ready, hire that provider directly.</p>
            
            @if(@$selectedSportId > 0)
              <a href="/direct-hire?selected_sport={{ $selectedSportId }}">CONTINUE</a>
            @else
              <a href="/direct-hire">CONTINUE</a>
            @endif
            
        </div>
       
        </div>
         
        </div>

      </div>
      <form method="post" action="/lesson/getquotes" id="register-form">
        <!-- sports selection step starts  -->
      <div class="lesson_modal_content" id ="step_sport_select" style="display:none;">
      <input type="hidden" name="hire_type" value="quick">
            <div class="qh-step-bar">
              <div class="qh-step-bar-status"> </div>
            </div>
            <div class="modal-body login-pad">
              <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
                
                <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></h1></b></br></br><h1 class="qh-title">Let’s get started by asking you a few questions to help you find the service provider that matches what you are looking for.</h1>
                <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
              </div>
              <div class="qh-content-block">
   			 	
      			<div class='chkerror errcheck'></div>
                <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span>Choose your sport to get trained in</h3>
                <div class="clearfix"></div>
                <div class="row">
                <?php $total_left_sports = ceil(($totalSports+1)/2); 
                      $count = 0;
                ?>
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <input type="hidden" name="selectedSportId" id="selectedSportId" value="{{isset($selectedSportId) ? $selectedSportId : 0}}">
                  @foreach($sports_list as $key=>$value)
                    @if($count < $total_left_sports)  
                      <?php $count++; $value->printed = true; ?>
                      <div class="form-control">
                          <div class="btn-group" data-toggle="buttons">
                              @if(count($value->child) > 0)
                                <label class="btn disabled parentsport">
                                <span class="glyphicon glyphicon-ok"></span> </label>
                                <span class="qh-lbl"><?php echo $value->title ?></span>
                              @else
                                <label class="btn btn-primary" id="chk_{{$value->value}}">
                                <input type="radio" value="<?php echo $value->value ?>" class="chk" name="sport" autocomplete="off">
                                <span class="glyphicon glyphicon-ok"></span> </label>
                                <span class="qh-lbl"><?php echo $value->title ?></span>
                              @endif
                          </div>
                      </div>

                      @if(count($value->child) > 0)
                        @foreach($value->child as $key1=>$value1)
                          @if($count < $total_left_sports) 
                            <?php $count++; $value->child[$key1.'_printed'] = true; ?> 
                            <div class="form-control">
                              <div class="btn-group childsport" data-toggle="buttons">
                                  <label class="btn btn-primary" id="chk_{{$key1}}">
                                  <input type="radio" value="<?php echo $key1 ?>" class="chk" name="sport" autocomplete="off">
                                  <span class="glyphicon glyphicon-ok"></span> </label>
                                  <span class="qh-lbl"><?php echo $value1 ?></span>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @endif
                    @endif

                  @endforeach
                   
                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  
                  @foreach($sports_list as $key=>$value)
                    @if(@$value->printed != true)
                      <div class="form-control">
                          <div class="btn-group" data-toggle="buttons">
                              @if(count($value->child) > 0)
                                <label class="btn disabled parentsport">
                                <span class="glyphicon glyphicon-ok"></span> </label>
                                <span class="qh-lbl"><?php echo $value->title ?></span>
                              @else
                                <label class="btn btn-primary" id="chk_{{$value->value}}">
                                <input type="radio" value="<?php echo $value->value ?>" class="chk" name="sport" autocomplete="off">
                                <span class="glyphicon glyphicon-ok"></span> </label>
                                <span class="qh-lbl"><?php echo $value->title ?></span>
                              @endif
                          </div>
                      </div>
                      @endif

                      @if(count($value->child) > 0)
                        @foreach($value->child as $key1=>$value1) 
                          @if(@$value->child[$key1.'_printed'] != true)
                            <?php if(strpos($key1, 'printed') !== false) continue; ?>
                            <div class="form-control">
                              <div class="btn-group childsport" data-toggle="buttons">
                                  <label class="btn btn-primary" id="chk_{{$key1}}">
                                  <input type="radio" value="<?php echo $key1 ?>" class="chk" name="sport" autocomplete="off">
                                  <span class="glyphicon glyphicon-ok"></span> </label>
                                  <span class="qh-lbl"><?php echo $value1 ?></span>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      @endif
                    
                  @endforeach

                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" value="true" class="chk" name="sport" autocomplete="off" id="otherchk">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                       <span class="qh-lbl"><input type="text" name="othersports" id="sportval" placeholder="Others"/></span> </div>
                    </div>

                   </div>

                </div>
              </div>
              <div class="clearfix"></div>
                <div class="qh-next">
                  <a class="qh-continue" onClick="showStep('1')">continue</a>
                </div>
            </div>
          </div>

      


         <div class="lesson_modal_content" id ="step_1" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
             
              <div class="clearfix"></div>
              <div class="row">
              <div class='chkerror errcheck'></div>
                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span> <b>Choose how many quotes you would like to receive from local service providers.(Minimum of 5 and Maximum of 20)</b></h3>
                  <div class="form-control">
                  <span class="qh-lbl">
                    <input type="text" placeholder="Number of qoutes" id="qoutes" name="question[qoutes][answer]" />
                    </span>
                  </div>                 
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
              <button type="button" class="close qh-back" onClick="gobackStep('sport_select')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('2')">continue</a>
            </div>
          </div>
        </div>


          <div class="lesson_modal_content" id ="step_2" style="display:none;">
            <div class="qh-step-bar">
              <div class="qh-step-bar-status"> </div>
            </div>
            <div class="modal-body login-pad">
              <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
               <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
                <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
              </div>
              <div class="qh-content-block">
              <div class='chkerror errcheck'></div>
                <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>Who will be training?</b></h3>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">
                            <input type="checkbox" value="kid" class="chkwhome" value="kid" name="question[train_wants][answer][]" autocomplete="off">
                            <span class="glyphicon glyphicon-ok"></span> </label>
                            <span class="qh-lbl">For a kid</span>
                        </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" class="chkwhome" value="adult" name="question[train_wants][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">For an Adult</span> </div>
                    </div>
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">
                            <input type="checkbox" value="family" class="chkwhome" value="family" name="question[train_wants][answer][]" autocomplete="off">
                            <span class="glyphicon glyphicon-ok"></span> </label>
                            <span class="qh-lbl">For a Family</span>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" class="chkwhome" value="teen" name="question[train_wants][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">For a Teen</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" class="chkwhome" value="couple" name="question[train_wants][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">For a Couple</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" class="chkwhome" value="group" name="question[train_wants][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">A Group of us</span> </div>
                    </div>  
                   </div>

                </div>
              </div>
              <div class="clearfix"></div>
                <div class="qh-next">
                <button type="button" class="close qh-back"  onClick="gobackStep('1')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
                  <a class="qh-continue" onClick="showStep('3')">continue</a>
                </div>
            </div>
          </div>

        <div class="lesson_modal_content" id ="step_3"  style="display:none;">
          <!-- Modal content-->
          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>How skilled are you in this sport?</b></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio"  class="chkskill" value="never" name="question[skill][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Never Tried (Looking to start)</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio"  class="chkskill" value="intermediate" name="question[skill][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Intermediate (I have done this before)</span> </div>
                  </div>
                                   
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="true" class="chkskill" id="chkskillother" value="true" name="question[skill][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[skill][otheranswer]" id="otherskill" placeholder="Others"/></span> </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="beginner" class="chkskill"  name="question[skill][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Beginner (I have some experience)</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="advance" class="chkskill" name="question[skill][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Advanced (I have done this a lot before)</span> </div>
                  </div>
                 </div>
              </div>
            </div>
            <div class="qh-content-block">
                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span>Do you have any gear for this sport?</h3>
                  <div class="form-control">
                    <div class="btn-group qh-radio-blk" data-toggle="buttons">
                      <label class="btn btn-primary qh-radio-pri">
                        <input type="radio" value="false" id="chkgearf" name="question[gear][answer]" autocomplete="off"  checked="checked">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">No</span> 
                      
                         <label class="btn btn-primary qh-radio-pri">
                        <input type="radio" value="true" id="chkgeart" name="question[gear][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Yes</span>
                      </div>
                  </div>
                  <div class="form-control">
                    <span class="qh-lbl"><input type="text" placeholder="" id="othergear" name="question[gear][otheranswer]" id="otherkn"/>
                  </div>                 
                </div>
             </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back"  onClick="gobackStep('2')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('4')">continue</a>
            </div>
          </div>
        </div>


           <div class="lesson_modal_content" id ="step_4"  style="display:none;">
          <!-- Modal content-->
          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>How often do you workout ?</b></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="never" class="chkwork" name="question[work_out][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">I Never Work Out</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio"  value="few_time" class="chkwork" name="question[work_out][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">A Few Times in a Week</span> </div>
                  </div>
                                   
                  <!-- <div class="form-control">
                    <div class="btn-group qh-custom-select"><span class="qh-lbl">Your Gender</span>
                      <select class="selectpicker" name="question[personal_training][answer]" data-style="btn-primary" >
                        <option value="1">I m Flexible</option>
                        <option value="2">Lorem ipsum dolor</option>
                        <option value="3">Lorem ipsum dolor</option>
                        <option value="4">Lorem ipsum dolor</option>
                      </select>
                    </div>
                  </div> -->
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="been_while" class="chkwork" name="question[work_out][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Its Been a While</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="daily" class="chkwork" name="question[work_out][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Fitness is Part of My Daily Life</span> </div>
                  </div>

                  <!-- <div class="form-control">
                    <div class="btn-group qh-custom-select"><span class="qh-lbl">Your Age</span>
                      <select class="selectpicker" name="question[personal_training][answer]" data-style="btn-primary" >
                        <option value="1">I m Flexible</option>
                        <option value="2">Lorem ipsum dolor</option>
                        <option value="3">Lorem ipsum dolor</option>
                        <option value="4">Lorem ipsum dolor</option>
                      </select>
                      <div class="form-control">
                        <span class="qh-lbl"><input type="text" placeholder="" name="question[trainer_know][optionanswer]" id="otherkn"/>
                      </div>  
                    </div>
                  </div> -->
                 </div>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back"  onClick="gobackStep('3')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('5')">continue</a>
            </div>
          </div>
        </div>




        <div class="lesson_modal_content" id ="step_5" style="display:none;">

            <div class="qh-step-bar">
              <div class="qh-step-bar-status"> </div>
            </div>
            <div class="modal-body login-pad">
              <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
                <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
                <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
              </div>
              <div class="qh-content-block">
              <div class='chkerror errcheck'></div>
                <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>While you are learning your new sport, do you have any fitness goals?</b></h3>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">
                            <input type="checkbox" value="weight_loss" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                            <span class="glyphicon glyphicon-ok"></span> </label>
                            <span class="qh-lbl">Weight Loss</span>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary">
                            <input type="checkbox" value="weight_gain" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                            <span class="glyphicon glyphicon-ok"></span> </label>
                          <span class="qh-lbl">Weight Gain</span>
                        </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="firming_toning" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Firming & Toning</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="flexibility" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Flexibility</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="muscle_strength" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Increase Muscle Strength</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" name="question[goal][answer][]" class="chkgoal"  id="chkgoalother" value="true" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                       <span class="qh-lbl"><input type="text" name="question[goal][otheranswer]" id="othergl" placeholder="Others"/></span> </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="aerobics_fitness" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Aerobics Fitness</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="endurance_training" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Endurance Training</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="body_building" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Body Building</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="nutritions" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Nutrition</span> </div>
                    </div>
                    <div class="form-control">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" value="pre_post_natal" class="chkgoal" name="question[goal][answer][]" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                        <span class="qh-lbl">Pre/Post Natal</span> </div>
                    </div>
                  
                  
                   </div>
                </div>
              </div>
              <div class="clearfix"></div>
                <div class="qh-next">
                <button type="button" class="close qh-back"  onClick="gobackStep('4')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
                  <a class="qh-continue" onClick="showStep('6')">continue</a>
                </div>
            </div>
          </div>




          <div class="lesson_modal_content" id ="step_6" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>Where would you like to Train ?</b></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="home" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Home</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="office" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Office</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="outdoors" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Outdoors</span> </div>
                  </div>
                
                  
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="true" class="chktrain" id="chkothertrn" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[train_location][otheranswer]" id="othertrn" placeholder="Others"/></span> </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="gym" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Appartment Gym</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="studio" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Private Studio</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="recommended" class="chktrain" name="question[train_location][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">As recommended by Trainer</span> </div>
                  </div>
                
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('5')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('7')">continue</a>
            </div>
          </div>
        </div>

        <div class="lesson_modal_content" id ="step_7" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span> <b>Which type of professional personality works best for you ?</b></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="educator" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">An Educator & Teacher</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="lot_of_energy" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">A Lot Of Energy</span> </div>
                  </div>
                  
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="drill_sergeant" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">A Drill Sergeant</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="challenging" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Challenging</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="bootcamp" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Bootcamp</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="intermediated" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Intermediate</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="advanced" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Adavnced</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="pro" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Pro</span> </div>
                  </div>
                 
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="supportive" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Supportive, Soft And Nurturing</span> </div>
                  </div>

                  

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="tough_and_firm" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Tough And Firm</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="care_about_details" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Care About The Details</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="gentle" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Gentle</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="intense" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Intense</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="beginner" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Beginner</span> </div>
                  </div>

                  

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="true" id="chkotherbest" class="chkbest" name="question[best_work][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[best_work][otheranswer]" id="otherbest" placeholder="Others"/></span> </div>
                  </div>
                
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('6')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('8')">continue</a>
            </div>
          </div>
        </div>



        <div class="lesson_modal_content" id ="step_8" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>Do you have a gender preference ?</b></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="Male" class="chkgender" name="question[gender][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Male</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="no_preference" class="chkgender" name="question[gender][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">No Preference</span> </div>
                  </div>
                 
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="Female" class="chkgender" name="question[gender][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Female</span> </div>
                  </div>
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('7')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('9')">continue</a>
            </div>
          </div>
        </div>

        <!-- step 1 ends -->


        <!-- step 2 starts -->

        <div class="lesson_modal_content" id ="step_9"  style="display:none;">
        <!-- Modal content-->
          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
             <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>Select Age Range</b></h3>
              <input type="hidden" name="question[age]" >
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="2-4" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">2 - 4 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="8-12" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">8 - 12 years old</span> </div>
                  </div>
                  

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="18-22" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">18 - 22 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio"  value="31-40" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">31 - 40 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="51-60" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">51 - 60 years old</span> </div>
                  </div>
                
                  
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="true" id="chkoldother" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[age][otheranswer]" id="otherold" placeholder="Others"/></span> </div>
                  </div>

                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="5-7" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">5 - 7 years old</span> </div>
                  </div>


                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="13-17" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">13 - 17 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="23-30" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">23 - 30 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="41-50" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">41 - 50 years old</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="61-elder" class="chkold" name="question[age][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">61 or Elder</span> </div>
                  </div>

                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back"  onClick="gobackStep('8')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
             <a class="qh-continue" onClick="showStep('10')">continue</a>
            </div>
          </div>
        </div>


        <!-- step 2 ends --> 

        <!-- step 3 starts -->

      


        <!-- step 3 ends --> 

        <!-- step 4 starts -->

        <div class="lesson_modal_content" id ="step_10" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>How long are you interested in being trained ?</b></h3>
              <input type="hidden" name="question[train_interest]" value="train_interest">

              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="1day" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">1 Day</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="2weeks" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">2 Weeks</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="1month" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">1 Month</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="3month" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">3 Month</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="5month" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">5 Month</span> </div>
                  </div>
                
                  
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="true" id="chkintrother" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[train_interest][otheranswer]" id="otherintr" placeholder="Others"/></span> </div>
                  </div>

                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="1week" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">1 Week</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="3weeks" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">3 Weeks</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="2month" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">2 Month</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="4month" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">4 Month</span> </div>
                  </div>

                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="recommended" class="chkintr" name="question[train_interest][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">As recommended by Trainer</span> </div>
                  </div>

                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('9')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('11')">continue</a>
            </div>
          </div>

        </div>

        <!-- step 4 ends --> 

        <!-- step 5 starts -->

        <div class="lesson_modal_content" id ="step_11" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span class="qh-itschk"><i class="fa fa-check"></i></span> <b>What days are you available ?</b></h3>
              <input type="hidden" name="question[days_available]" >
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="monday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Monday</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="wednesday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Wednesday</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="friday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Friday</span> </div>
                  </div>
                <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="sunday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Sunday</span> </div>
                  </div>
                  
                  <!--<div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" placeholder="Others"/></span> </div>
                  </div>-->
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="tuesday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Tuesday</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="thursday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Thursday</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="saturday" class="chkdy" name="question[days_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Saturday</span> </div>
                  </div>
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('10')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('12')">continue</a>
            </div>
          </div>

        </div>

        <!-- step 5 ends --> 

        <!-- step 6 starts -->

        <div class="lesson_modal_content" id ="step_12" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
            <div class='chkerror errcheck'></div>
              <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>What time works best for you ?</b></h3>
              <input type="hidden" name="question[time_available]" >

              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="early_morning" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Early Morning ( Before 9am )</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="early_afternoon" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Early Afternoon ( Noon - 3pm )</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="evening" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Evening ( After 6pm )</span> </div>
                  </div>
                
                  
                  <!--<div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" placeholder="Others"/></span> </div>
                  </div>-->
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="morning" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Morning ( 9am - Noon )</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="late_afternoon" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Late Afternoon ( 3pm - 6pm )</span> </div>
                  </div>
                  
                 
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="checkbox" value="true" id="chktmother" class="chktm" name="question[time_available][answer][]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" name="question[time_available][otheranswer]" id="othertm"  placeholder="Others"/></span> </div>
                  </div>
                
                
                 </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
             <button type="button" class="close qh-back" onClick="gobackStep('11')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('13')">continue</a>
            </div>
          </div>


        </div>


          <div class="lesson_modal_content" id ="step_13" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
             
              <div class="clearfix"></div>
              <div class="row">
              <div class='chkerror errcheck'></div>
                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span></span><span><i class="fa fa-check"></i></span><b>Any medical issues ?</b></h3>
                  <div class="form-control">
                    <div class="btn-group qh-radio-blk" data-toggle="buttons">
                      <label class="btn btn-primary qh-radio-pri active">
                        <input type="radio" value="false" id="chkmedicalf" name="question[medical][answer]" autocomplete="off" checked="checked">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">No</span> 
                      
                         <label class="btn btn-primary qh-radio-pri">
                        <input type="radio" value="true" id="chkmedicaly" name="question[medical][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Yes</span>
                      </div>
                  </div>
                  <div class="form-control">
                    <textarea placeholder="Tell Us More" name="question[medical][otheranswer]" id="othermedical" class="qh-tell-us"></textarea>
                  </div>                 
                 
                </div>
              
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
              <button type="button" class="close qh-back" onClick="gobackStep('12')">
              <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('14')">continue</a>
            </div>
          </div>
          </div>
        </span>
        <!-- step 6 ends --> 

        <!-- step 7 starts -->

        <div class="lesson_modal_content" id ="step_14" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
             
              <div class="clearfix"></div>
              <div class="row">
                <div class='chkerror errcheck'></div>
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span><i class="fa fa-truck"></i></span><b>Are you willing to travel to the providers specified training location?(park, gym, etc.)</b></h3>

                 <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary active">
                        <input type="radio" value="notprefer" class="chkoccr" name="question[personal_train_occur][answer]" id="chkwilly" autocomplete="off" checked="checked">
                        <span class="glyphicon glyphicon-ok"  ></span> </label>
                      <span class="qh-lbl">-  I prefer not to travel</span> </div>
                  </div>
                  <div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" value="prefer" class="chkoccr" name="question[personal_train_occur][answer]" id="chkwill" autocomplete="off" >
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">-  I am willing to travel</span> </div>
                  </div>
                  
                  <div class="form-control">
                    <div class="btn-group qh-custom-select"> <span class="qh-lbl">I am willing to travel up to?</span>
                      <select class="selectpicker" name="question[travel_upto][answer]" id="selectMiles" data-style="btn-primary" >
                        <option value="1">1 Mile</option>
                        <option value="3">3 Miles</option>
                        <option value="5">5 Miles</option>
                        <option value="10">10 Miles</option>
                        <option value="15">15 Miles</option>
                        <option value="20">20 Miles</option>
                        <option value="30">30 Miles</option>
                      </select>
                    </div>
                  </div>
                  
                  <!--<div class="form-control">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                     <span class="qh-lbl"><input type="text" placeholder="Others"/></span> </div>
                  </div>--> 
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                  <h3 class="qh-step-title"><span><i class="fa fa-clock-o"></i></span>How soon do you want to start?</h3>
                  <div class="form-control">
                    <div class="btn-group qh-custom-select">
                      <select class="selectpicker" id="selectPerTra" onchange="showothertext();" name="question[personal_training][answer]" data-style="btn-primary" >
                        <option value="ASAP">Soon as possible</option>
                        <option value="Tomorrow">Tomorrow</option>
                        <option value="ThisWeek">This week </option>
                        <option value="ThisMonths">This month</option>
                        <option value="UpcomingTrip">Upcoming Trip</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-control" id="otherpertra" style="display:none;">
                    <div class="btn-group" data-toggle="buttons">
                      <span class="qh-lbl"><input type="text" name="question[personal_training][otheranswer]" id="otherpt"  placeholder="Others"/></span> 
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
              <button type="button" class="close qh-back" onClick="gobackStep('13')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('15')">continue</a>
            </div>
          </div>


        </div>


        <!-- step 7 ends --> 

        <!-- step 8 starts -->

        <div class="lesson_modal_content" id ="step_15" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
             
              <div class="clearfix"></div>
              <div class="row">
              <div class='chkerror errcheck'></div>
                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span><i class="fa fa-check"></i></span><b>Any important information the provider should be aware of? (Include Details)</b></h3>
                  <input type="hidden" name="question[trainer_know]" >
                  <div class="form-control">
                    <div class="btn-group qh-radio-blk" data-toggle="buttons">
                      <label class="btn btn-primary qh-radio-pri active">
                        <input type="radio" value="false" id="chknwn" name="question[trainer_know][answer]" autocomplete="off" checked="checked">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">No</span> 
                      
                         <label class="btn btn-primary qh-radio-pri">
                        <input type="radio" value="true" id="chknwy" name="question[trainer_know][answer]" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">Yes</span>
                      </div>
                  </div>
                  <div class="form-control">
                    <textarea placeholder="Tell Us More" name="question[trainer_know][otheranswer]" id="otherkn" class="qh-tell-us"></textarea>
                  </div>                 
                 
                </div>
              
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="qh-next">
              <button type="button" class="close qh-back" onClick="gobackStep('14')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <a class="qh-continue" onClick="showStep('16')">continue</a>
            </div>
          </div>


        </div>
  

        <!-- step 8 ends --> 

        <!-- step 9 starts -->

        <div class="lesson_modal_content" id ="step_16" style="display:none;">

          <div class="qh-step-bar">
            <div class="qh-step-bar-status"> </div>
          </div>
          <div class="modal-body login-pad">
            <div class="qh-step-title"> <span class="qh-info"><i class="fa fa-info"></i></span>
              <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++." of ".$step_count;?></b></h1>
              <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/> </button>
            </div>
            <div class="qh-content-block">
             
              <div class="clearfix"></div>
              <div class="row">
              <div class='chkerror errcheck'></div>
                <div class="col-md-8 col-sm-12 col-xs-12 qh-steps-form">
                 <h3 class="qh-step-title"><span><i class="fa fa-map-marker"></i></span><b>Enter the desired zip code.  We locate the top service provider’s closest to you.</b> </h3>
                 <div class="form-control">
                    <div class="btn-group extra-mrgn-smbtm" data-toggle="buttons">
                        <span class="qh-lbl"><input type="text" id="chkzip" name="zipcode" placeholder="10982" required/></span>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- <h3 class="qh-step-title"><span><i class="fa fa-map-pin"></i></span>Tell us more about yourself</h3> -->
                  <div class="form-control">
                    <!-- <div class="btn-group extra-mrgn-btm" data-toggle="buttons">
                      <label class="btn btn-primary qh-radio-pri active">
                        <input type="radio" name="notificationby"  class="chkqt" value="email_text" autocomplete="off" required checked="checked">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">I want quotes by email & text messsage</span> 
                      </div> -->
                   <div class="btn-group " data-toggle="buttons" style="display:none;">
                         <label class="btn btn-primary qh-radio-pri">
                        <input type="radio" name="notificationby" class="chkqt" value="email" autocomplete="off" checked="checked">
                        <span class="glyphicon glyphicon-ok"></span> </label>
                      <span class="qh-lbl">I want quotes by email only</span>
                      </div>
                    <div class="btn-group " data-toggle="buttons">
                        <h3 class="qh-step-title"><i>You will be notified by an email when businesses post their quotes</i></h3>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center qh-btm-text">
                <p><b>By clicking Get Quotes you agree to the <a href="/terms-condition ">Fitnessity Terms of service</a> and <a href="/privacy-policy"> Privacy Policy.</a></b>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                  </p><p><b> Learn the Fitnessity Hiring Policy and the risk of continuing to work with or hiring a professional outside of the Fitnessity platform. Learn about the Fitnessity Quality Control Team</b></p>
                </div>
              <p><b>Contact us if you have any question & concerns</b></p>
            </div>
            <div class="qh-next">
              <button type="button" class="close qh-back" onClick="gobackStep('15')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button>
              <button class="qh-continue" id="sub" >get quotes</button>
            </div>
          </div>
        </div>
       <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
        </form>
        <!-- step 9 ends --> 
      </div>
      <style type="text/css">
      	.errcheck { color:red;font-size:16px;}
      </style>
    </div>

  <script>
      $('#chkzip').keyup(function(){
        $(".chkerror").text("");

        if(!$.isNumeric(this.value)){
          $(".chkerror").text("*Invalid Zipcode Number");
          $("#sub").attr("disabled", true);
          return false;
        }else if($.isNumeric(this.value) && this.value > 999999 || this.value <= 000000 || this.value <= 999) {
          $(".chkerror").text("*Please provide valid zipe code between 6 digit");
          $("#sub").attr("disabled", true);
          return false;
        }else {
          $("#sub").attr("disabled", false);
        }
    });
  </script>
  <script>
      
      $(document).on("ajaxComplete", function(){
  
        $('#hire_professional').on('click', function(){
          $('#signupoption').css('display','block');
          $('#chooseoption').css('display','none');
        });

        $('.modal').on('hidden.bs.modal', function () {
          $('#signupoption').css('display','none');
        })

        var selectedSportId = $("#selectedSportId").val();
        if(selectedSportId != '' && selectedSportId > 0) {
          $('#chk_'+selectedSportId).click();
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

        // if(pre_selected_sports){
        //     $(".chk").unbind("click");
        //     $(".chk").parent().find('.active').removeClass('active');
        //     $(".otherchk").unbind("click");
        //     $('input:radio[name=sport][value=<?php echo @$selectedSportId; ?>]').click();  
        // } 
          
      });
</script>
<script type="text/javascript">
    function gobackStep(divname) {
        $('.lesson_modal_content').hide();
        $('#step_'+divname).show();
    }
    function showothertext()
    {
      if($('#selectPerTra :selected').val() == 'Other')
              {
                $('#otherpertra').show();
              }
            else
            {
               $('#otherpertra').hide();

            }
    }
    function showStep(divname) {
        
        if(divname !== 'sport_select'){

             var chk = $("input:radio[class='chk']");
             var chkother = $("input:radio[id='otherchk']");
             
             var chkwhome = $("input:checkbox[class='chkwhome']");

             var chkskill = $("input:radio[class='chkskill']");
             var chkskillother = $("input:radio[id='chkskillother']");

             var chkgearf = $("input:radio[id='chkgearf']");
             var chkgeart = $("input:radio[id='chkgeart']");

             var chkwork = $("input:radio[class='chkwork']");

             var chkgoal = $("input:checkbox[class='chkgoal']");
             var chkgoalother = $("input:checkbox[id='chkgoalother']");
             
             var chktrain = $("input:checkbox[class='chktrain']");
             var chktrainother = $("input:checkbox[id='chkothertrn']");

             var chkbest = $("input:checkbox[class='chkbest']");
             var chkotherbest = $("input:checkbox[id='chkotherbest']");

             var chkgender = $("input:radio[class='chkgender']");


             var chkold = $("input:radio[class='chkold']");
             var chkoldother = $("input:radio[id='chkoldother']");
             

             var chkintr = $("input:radio[class='chkintr']");
             var chkintrother = $("input:radio[id='chkintrother']");
             
             var chkday = $("input:checkbox[class='chkdy']");
             
             var chktm = $("input:checkbox[class='chktm']");
             var chktmother = $("input:checkbox[id='chktmother']");
             
             var chkmedicalf = $("input:radio[id='chkmedicalf']");
             var chkmedicaly = $("input:radio[id='chkmedicaly']");


             var chknwy = $("input:radio[id='chknwy']");
             var chknwn = $("input:radio[id='chknwn']");

             var chkqt = $("input:radio[class='chkqt']");

             var chkoccr = $("input:radio[class='chkoccr']");

             var chkwill = $('#chwill');
             var chkwilly = $("input:radio[id='chkwilly']");



             
            $(".chkerror").text("");

            /*========    Sports Modal Validation start ========*/
            if(chk.is(":checked") && divname == 1){
                if(chkother.is(":checked")){
                   if($('#sportval').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chk.is(":checked") && divname == 1) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Sports Modal Validation END ========*/

            /*========    Sports Modal Validation start ========*/
            if(divname == 2){

                if(!$.isNumeric($('#qoutes').val())){
                     $(".chkerror").text("*Please fill digits between Minimum 5 or Maximum 20");
                    return false;
                }

                if($('#qoutes').val() == ''){
                    $(".chkerror").text("*Please fill the option");
                    return false;
                }else if($('#qoutes').val() < 5 || $('#qoutes').val() > 20){
                    $(".chkerror").text("*Minimum 5 and Maximum 20");
                    return false;
                }
            }
            /*========    Sports Modal Validation END ========*/


            /*========    To Whome Modal Validation start ========*/
            if(!chkwhome.is(":checked") && divname == 3) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }


            /*========    To Whome Modal Validation END ========*/


            /*========    Skill Modal Validation start ========*/
            if(chkskill.is(":checked") && divname == 4){
                if(chkskillother.is(":checked")){
                   if($('#otherskill').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chkskill.is(":checked") && divname == 4) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }

            if(!chkgearf.is(":checked") && !chkgeart.is(":checked") && divname == 4) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }else if(chkgeart.is(":checked")) {
                if($('#othergear').val() == ''){
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }
            /*========    Skill  Modal Validation END ========*/


            /*========    Work out  Modal Validation start ========*/
            if(!chkwork.is(":checked") && divname == 5) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    work out Modal Validation END ========*/

            /*========    Goal Modal Validation start ========*/
            if(chkgoal.is(":checked") && divname == 6){
                if(chkgoalother.is(":checked")){
                   if($('#othergl').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chkgoal.is(":checked") && divname == 6) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Goal Modal Validation END ========*/


             /*========    where train Modal Validation start ========*/
            if(chktrain.is(":checked") && divname == 7){
                if(chktrainother.is(":checked")){
                   if($('#othertrn').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chktrain.is(":checked") && divname == 7) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    where train Modal Validation END ========*/



            /*========    best Modal Validation start ========*/
            if(chkbest.is(":checked") && divname == 8){
                if(chkotherbest.is(":checked")){
                   if($('#otherbest').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chkbest.is(":checked") && divname == 8) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    best Modal Validation END ========*/

            /*========    gender  Modal Validation start ========*/
            if(!chkgender.is(":checked") && divname == 9) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    wgender Modal Validation END ========*/

            /*========    old Modal Validation start ========*/
            if(chkold.is(":checked") && divname == 10){
                if(chkoldother.is(":checked")){
                   if($('#otherold').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chkold.is(":checked") && divname == 10) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    old Modal Validation END ========*/


            /*========    old Modal Validation start ========*/
            if(chkintr.is(":checked") && divname == 11){
                if(chkintrother.is(":checked")){
                   if($('#otherintr').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chkintr.is(":checked") && divname == 11) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    old Modal Validation END ========*/

            /*========    gender  Modal Validation start ========*/
            if(!chkday.is(":checked") && divname == 12) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    wgender Modal Validation END ========*/


            /*========    Time Modal Validation start ========*/
            if(chktm.is(":checked") && divname == 13){
                if(chktmother.is(":checked")){
                   if($('#othertm').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chktm.is(":checked") && divname == 13) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            /*========    Time Modal Validation END ========*/

            /*========    medical Modal Validation END ========*/

            if(!chkmedicalf.is(":checked") && !chkmedicaly.is(":checked") && divname == 14) {
                
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }else if(chkmedicaly.is(":checked")) {

                if($('#othermedical').val() == ''){
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }

            /*========    medical Modal Validation END ========*/
              if(chktm.is(":checked") && divname == 13){
                if(chktmother.is(":checked")){
                   if($('#othertm').val() == ''){
                       $(".chkerror").text("*Please fill other option");
                       return false;
                   }
                }

            }else if(!chktm.is(":checked") && divname == 13) {
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }

            /*========    Personal Training Modal Validation END ========*/

            if(!chkoccr.is(":checked") &&  divname == 15) {
                
                $(".chkerror").text("*Please select atleast one option");
                return false;
            } 
            else if(chkwill.is(":checked")) {
                
                if($('#selectMiles :selected').val() == ''){
                    $(".chkerror").text("*Please select the option");
                    return false;
                 
                }
            }

            /*========    Personal Training Modal Validation END ========*/


             /*========    trainer know Modal Validation END ========*/

            if(!chknwn.is(":checked") && !chknwy.is(":checked") && divname == 16) 
            {
                
                $(".chkerror").text("*Please select atleast one option");
                return false;
            }
            else if(chknwy.is(":checked")) 
            {

                if($('#otherkn').val() == '')
                {
                    $(".chkerror").text("*Please select fill the option");
                    return false;
                }
            }
            

            /*========    trainer know Modal Validation END ========*/
            
        }
          $('.lesson_modal_content').hide();
          $('#step_'+divname).show();
          
    }
</script>