		 

		  

		<script type="text/javascript" src="/AdminLTE/plugins/bootstrap-slider/bootstrap-slider.js"></script>

		<link rel="stylesheet" type="text/css" href="/AdminLTE/plugins/bootstrap-slider/slider.css">

			<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>

			<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"></link>

			<link rel="stylesheet" href="/public/js/select/select.css"/>

			<?php

		

		            $levelOfExp = [];

		

		            $whoIsTraining = '';

		

		            $gender = '';

		

		            $personality = '';

		

		            $availability_days = [];

		

		            $selected_location = '';

		

		            $selected_location_lat = '';

		

		            $selected_location_lng = '';

		

		            $filter_review_star = '';

		

		            $miles_radius_filter = 0;

		?>

		

		  {!! Form::open(array('id' => 'frmsearchCategory', 'url' => 'direct-hire', 'method' => 'post')) !!}

		

		    

			<div class="direct-hire-sidebar">

				<div class="reset-filter" style="text-align: center;">

					<a href="javascript:void();" onclick="refreshPage();">

		

		                RESET ALL FILTERS 

						<i class="fa fa-filter" aria-hidden="true"></i>

					</a>

				</div>

				<!-- <div class="reset-filter"> -->

				<a href="javascript:void(0);" class="filter-btn myfilter2" style="width: 100%; text-align: center;">

		

		                CLICK TO APPLY FILTERS

		

		            </a>

				<!-- </div> -->

				<br>

					<div class="special-offer" style="margin-top: 5%;">

						<h2>CHOOSE SERVICE TYPE</h2>

						<ul class="direct-categories">

							<?php

		

		                if(Session::has('professional_type'))

		

		                {

		

		                    $professional_type = Session::get('professional_type');

		

		                } else {

		

		                    $professional_type = '1';

		

		                }

					

		            ?>	<select name="professional_type[]" multiple id="professional_type"  class="myfilter">

							<?php foreach ($businessType as $bkey => $bval) { ?>

								<option value="{{$bkey}}">{{$bval['type']}}</option>

							<?php } ?>

							</select>

							

							</ul>

						</div>

						<div class="choose-sport">

							<?php 

		

		            $selected_sport = '';

		

		            if(Session::has('selected_sport'))

		

		                $selected_sport = Session::get('selected_sport');

		

		        ?>

							<input type="hidden" name="_token" id="search_token" value="{{csrf_token()}}">

							

									<hr style="height: 0; border: 0;border-top: 1px solid #989797;margin-top: -15px;">

										{{--  <p data-toggle="collapse" data-target="#demo">CHOOSE ACTIVITY 

											<i class="fa fa-angle-down" aria-hidden="true" style="margin-top: 5px;"></i>

										</p>  --}}
								<div class="select-style">			
				                     <select name="selected_sport" id="frm_servicesport" class="form-control selectpicker myfilter">

				                      {!! $sports_select !!}

				                      </select>
                      			</div>
										<!--  <ul id="demo" class="collapse"> 

		

		                @if(count($sports) > 0)

		

		                

											<?php $display_count = 10; ?>

		

		                    @foreach($sports as $index => $sport_detail)

		

		                        @if($display_count == 0)

		

		                            

											<?php break; ?>

		

		                        @endif

		

		                        

											<?php $display_count--; ?>

											<li>

												<span> {{ $index }} </span>

												<div class="choose-sportlist">

		

		                        @if(is_array($sport_detail))

		

		                        @foreach($sport_detail as $sport)

		

		                            

													<?php $class = ''; ?>

		

		                            @if($sport->value == $selected_sport)

		

		                                

													<?php $class = 'active'; ?>

		

		                            @endif

		

		

		

		                            @if(count($sport->child) > 0)

		

		                                

													<p class="parentsport">{{ $sport->title }}</p>

		

		                            @else

		

		                                

													<a href="javascript:void(0);" class="sports_selection {{$class}}" id="{{ $sport->value }}">{{ $sport->title }}</a>

		

		                            @endif

		

		

		

		                            @if(count($sport->child) > 0)

		

		                                @foreach($sport->child as $child_sports_key=>$child_sports_val)

		

		                                    

													<?php $child_class = ''; ?>

		

		                                    @if($child_sports_key == $selected_sport)

		

		                                        

													<?php $child_class = 'active'; ?>

		

		                                    @endif

		

		                                    

													<a href="javascript:void(0);" class="sports_selection childsport {{$child_class}}" id="{{ $child_sports_key }}">{{ $child_sports_val }}</a>

		

		                                @endforeach

		

		                            @endif

		

		

		

		                        @endforeach

		

		                         @endif

		

		                        

												</div>

											</li>

		

		                    @endforeach

		

		                @endif     

		

		            

										</ul>-->							

                                        <div class="special-offer">

											<h2>Location</h2>

											<div class="view special-offer">

												<input id="pac-input" type="text" class="location-control myfilter" name="location" placeholder="search by country, city, state, zip" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif" />

												<script>

		

		                google.maps.event.addDomListener(window, 'load', initialize);

		

		                function initialize() {

		

		                    var options = {

		

		                      types: ['(cities)'],

		

		                      componentRestrictions: {country: "US"}

		

		                    };

		

		                    var input = document.getElementById('pac-input');

		

		                    var autocomplete = new google.maps.places.Autocomplete(input, options);

		

		                    autocomplete.addListener('place_changed', function () {

		

		                        var place = autocomplete.getPlace();

		

		                        if(place.formatted_address == undefined){

		

		                            $("#selected_location").val('');

		

		                            $("#selected_location_lat").val('');

		

		                            $("#selected_location_lng").val('');

		

		                            $("#miles_radius_filter").slider("disable");

		

		                        } else {

		

		                            $("#selected_location").val(place.formatted_address);

		

		                            $("#selected_location_lat").val(place.geometry['location'].lat());

		

		                            $("#selected_location_lng").val(place.geometry['location'].lng()); 

		

		                            $("#miles_radius_filter").slider("enable");  

		

		                            $(".miles_radius_filter_error").html('');  

		

		                        }

		

		

		

		                    });

		

		                }

		

		

		

		                $('#pac-input').keyup(function() {

		

		                    if($('#pac-input').val() == ''){

		

		                        $("#selected_location").val('');

		

		                        $("#selected_location_lat").val('');

		

		                        $("#selected_location_lng").val('');

		

		                        $("#miles_radius_filter").slider("disable");

		

		                        // $("#miles_radius_filter").slider({precision: 1,value: 0});

		

		                        $(".miles_radius_filter_error").html('');

		

		                    }

		

		                })

		

		                    

		

		                </script>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Activity For</h2>

												<select id="activity_for" multiple name="activity_for[]" class="myfilter" >

		                         @foreach (@$activity as $pkey => $pval)

		                          

													<?php $pkey = str_replace(' ','_',strtolower($pkey)); ?>

													<option value='{{$pkey}}'> {{$pval}}</option>

		                        @endforeach

		                        

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Activity Type</h2>

												<select id="activity_type" multiple name="activity_type[]" class="myfilter" >

		                          @foreach (@$programType as $pkey => $pval)

		                         

													<?php $pkey = str_replace(' ','_',strtolower($pkey)); ?>

													<option value='{{$pkey}}'> {{$pval}}</option>

		                        @endforeach

		                        

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Age Range</h2>

												<select id="age_range" multiple  name="age_range[]" class="myfilter" >

		                @foreach (@$ageRange as $arkey => $arval)

		                    

													<?php $arkey = str_replace(' ','_',strtolower($arkey)); ?>

													<option value='{{$arkey}}'> {{$arval}}</option>

		                @endforeach

		                        

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Preferred Language</h2>

												<select id="categ" multiple name="language[]" class="myfilter" >

		                        @foreach(@$alllanguages as  $language)

								    <option value="{{$language}}" >{{$language}}</option>

		                        @endforeach 

		                      

												</select>

											</div>

										</div>

										<div class="special-offer">

											<h2>Preference</h2>

											<div class="select-style">

												<select class="selectpicker" name="gender" class="myfilter">

													<option values="Male">Male</option>

													<option values="Female">Female</option>

													<option values="">Any</option>

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Activity Experience</h2>

												<select id="activity_exp" name="activity_exp[]" multiple  class="myfilter" >

		                           @foreach (@$pFocuses as $pfkey => $pfval)

		                          

													<?php $pfkey = str_replace(' ','_',strtolower($pfkey)); ?>

													<option value='{{$pfkey}}'> {{$pfval}}</option>

		                        @endforeach

		                        

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Personality & Habits</h2>

												<select id="personality_habit" multiple name="personality_habit[]"  class="myfilter" >

													<option>An Educator & Teacher</option>

													<option>A lot of energy </option>

													<option>A drill sergeant </option>

													<option>Inspiring</option>

													<option>Motivational</option>

													<option>Supportive, Soft and Nurturing </option>

													<option>Tough and Firm </option>

													<option>Detail oriented</option>

													<option >Gentle</option>

													<option>Intense </option>

													<option>Calls a spade a spade</option>

													<option>Likes to talk</option>

													<option>Punctual</option>

													<option>Organized</option>

													<option>Stern</option>

													<option>Friendly & outgoing </option>

													<option>Other</option>

													<option >Any</option>

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Fitness Goals</h2>

												<select id="fitness_goal" multiple name="fitness_goal[]"  class="myfilter" >

													<option>No Preference</option>

				<?php $fitness_goals_array = array('Weight Loss','Firming & Toning','Increase Strenght','Endurance Training','Nutritions','Weight Gain','Flexibilty','Aerobics Fitness','Body Building','Pre/Post Natal','Other'); ?>

                        

                        @foreach($fitness_goals_array as $fga)

            <?php $key = str_replace(' ','_',strtolower($fga)); ?>

                        <option value="{{$key}}">{{$fga}}</option>

                        @endforeach

													<option >Any</option>

												</select>

											</div>

										</div>

										<div class="special-offer">

											<div class="multiples">

												<h2>Activity Location</h2>

												<select id="activity_location" name="activity_location[]" multiple  class="myfilter" >

		                          @foreach (@$serviceLocation as $slkey => $slval)

										<?php $slkey = str_replace(' ','_',strtolower($slkey)) ;?>

										<option value='{{$slkey}}'>{{$slval}}</option>

		                        @endforeach

		                        

												</select>

											</div>

										</div>

										<!-- Modal -->

										<div class="modal fade" id="viewAllSports" role="dialog">

											<div class="modal-dialog modal-lg">

												<!-- Modal content-->

												<div class="modal-content">

													<div class="modal-body login-pad">

														<div class="pop-title employe-title">

															<h3>CHOOSE SPORT</h3>

														</div>

														<button type="button" class="close modal-close" data-dismiss="modal">

															<img src="

																<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

															</button>

															<div class="signup">

																<div id='systemMessage_detail'></div>

																<div class="emplouyee-form">

																	<ul>

		

		                                @if(count($sports) > 0)

		

		                                    @foreach($sports as $index => $sport_detail)

		

		                                        

																		<li>

																			<span> {{ $index }} </span>

																			<div class="choose-sportlist">

		

		                                        @if(is_array($sport_detail))

		

		                                        @foreach($sport_detail as $sport)

		

		                                            

																				<?php $class = ''; ?>

		

		                                            @if($sport->value == $selected_sport)

		

		                                                

																				<?php $class = 'active'; ?>

		

		                                            @endif

		

		

		

		                                            @if(count($sport->child) > 0)

		

		                                                

																				<p class="parentsport">{{ $sport->title }}</p>

		

		                                            @else

		

		                                                

																				<a href="javascript:void(0);" class="sports_selection {{$class}}" id="{{ $sport->value }}">{{ $sport->title }}</a>

		

		                                            @endif

		

		

		

		                                            @if(count($sport->child) > 0)

		

		                                                @foreach($sport->child as $child_sports_key=>$child_sports_val)

		

		                                                    

																				<?php $child_class = ''; ?>

		

		                                                    @if($child_sports_key == $selected_sport)

		

		                                                        

																				<?php $child_class = 'active'; ?>

		

		                                                    @endif

		

		                                                    

																				<a href="javascript:void(0);" class="sports_selection childsport {{$child_class}}" id="{{ $child_sports_key }}">{{ $child_sports_val }}</a>

		

		                                                @endforeach

		

		                                            @endif

		

		

		

		                                        @endforeach

		

		                                        @endif

		

		                                        

																			</div>

																		</li>

		

		                                    @endforeach

		

		                                @endif     

		

		                            

																	</ul>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

											<!-- Modal -->

										</div>





										<?php

		

		

		            if(Session::has('who_is_training'))

		

		            {

		

		                $whoIsTraining = Session::get('who_is_training');

		

		            }

		

		

		

		            if(Session::has('gender'))

		

		            {

		

		                $gender = Session::get('gender');

		

		            }

		

		

		

		            if(Session::has('level_of_experience'))

		

		            {

		

		                $levelOfExp = Session::get('level_of_experience');

		

		            }

		

		

		

		            if(Session::has('personality'))

		

		            {

		

		                $personality = Session::get('personality');

		

		            }

		

		

		

		            if(Session::has('availability_days'))

		

		            {

		

		                $availability_days = Session::get('availability_days');

		

		            }

		

		

		

		            if(Session::has('selected_location'))

		

		            {

		

		                $selected_location = Session::get('selected_location');

		

		            }

		

		

		

		            if(Session::has('selected_location_lat'))

		

		            {

		

		                $selected_location_lat = Session::get('selected_location_lat');

		

		            }

		

		

		

		            if(Session::has('selected_location_lng'))

		

		            {

		

		                $selected_location_lng = Session::get('selected_location_lng');

		

		            }

		

		

		

		            if(Session::has('filter_review_star'))

		

		            {

		

		                $filter_review_star = Session::get('filter_review_star');

		

		            }

		

		

		

		            if(Session::has('miles_radius_filter'))

		

		            {

		

		                $miles_radius_filter = Session::get('miles_radius_filter');

		

		            }

		

		

		

		        ?>  

		

		

		

		      

		        

		

		    {!! Form::close() !!}

		

		    

										<a href="javascript:void(0)" class="filter-btn myfilter2" style="width: 100%; text-align: center;margin-top: -11px;">

		

		        SEARCH

		

		    </a>

										<div class="reset-filter" style="text-align: center;">

											<a href="javascript:void();" onclick="refreshPage();">

		

		            RESET ALL FILTERS 

												<i class="fa fa-filter" aria-hidden="true"></i>

											</a>

										</div>

									</div>



<script>		

		      /*$(".sports_selection").on("click", function()

		

		      {

		

		            $("#selected_sport").val(this.id);

		

		            $('#frmsearchCategory').submit();

		

		      });*/

		

		    

		

		

		

		function submitForm()

		

		{   

		

		    var selectedSport = jQuery("li > .choose-sportlist .sports_selection.active").attr('id');

		

		

		

		    $("#selected_sport").val(selectedSport);

		

		    $('#frmsearchCategory').submit();

		

		}

		

		

		

		function submitProfessionType(professionType)

		

		{   

		

		    $("#professional_type").val(professionType);

		

		    submitForm();

		

		}

		

		

		

		$('.signup-rates').click(function() {

		

		    $(this).toggleClass('active');

		

		

		

		    if($(this).hasClass( "active" ).toString() == 'true'){

		

		        $(this).find("input[type='checkbox']").prop('checked', true);

		

		    } else {

		

		        $(this).find("input[type='checkbox']").prop('checked', false);

		

		    }

		

		});

		

		

		

		function filterReviewStar(filter_stars){

		

		    $('.business-star').find(".start-list").removeClass('active');

		

		    $('.filter-star-'+filter_stars).addClass('active');

		

		    $("#filter_review_star").val(filter_stars);

		

		}

		

		

		

		function refreshPage(){

		

		    window.location.href = '/direct-hire';

		

		}

		

		</script>

									<script>

		  $(document).ready(function() {

		     var  categ= new SlimSelect({

		    select: '#categ'

		  });

		  var  categ= new SlimSelect({

		    select: '#activity_type'

		  });

		  var  categ= new SlimSelect({

		    select: '#activity_for'

		  });

		  var  categ= new SlimSelect({

		    select: '#age_range'

		  });

		  var  categ= new SlimSelect({

		    select: '#activity_exp'

		  });

		  var  categ= new SlimSelect({

		    select: '#personality_habit'

		  });

		  var  categ= new SlimSelect({

		    select: '#fitness_goal'

		  });

		  var  categ= new SlimSelect({

		    select: '#activity_location'

		  });

		  var  categ= new SlimSelect({

		    select: '#professional_type'

		  });

		  })

		  </script>