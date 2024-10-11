@if(count($plans) && isset($plans))
						<?php
						$sr = 0;
						$plans = $plans->toArray();
						$boxcount = round(count($plans)/2);
						$indexcount = 0;
						?>
						@for($i=1; $i<=$boxcount;$i++)							
								<div class="membership-block">
									<div class="row">
										<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 membership-left">
								            <h1>FITNESSITY 
												PROFESSIONALs <br/>
												( Freelancers )
											</h1>
											<p> Membership 
												option only 1 or 
												more employees
											</p>
											<div class="clearfix"></div>
											<a href="#" class="learn-more">learn more <i class="fa fa-angle-right"></i></a>
								        </div>
								        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 box-shadow">
								        	<div class="row"> 
								        		@for($j=$indexcount; $j<2; $j++) 
									            	<div class="membership-plan mbsp1">
									                    <h3>{{ $plans[$j]['title'] }} <br/>
															BOOKING</h3>
														<div class="price">
															<span><i>$</i>{{ $plans[$j]['price_per_month'] }} </span>
														</div>
														<p>{{ $plans[$j]['description'] }}</p>
														<div class="clearfix"></div>
														
														<a href="javascript:void(0);" class="add_plans" id="plan_{{ $plans[$j]['id'] }}">Add Plans</a>
														<a href="javascript:void(0);" class="added_plans" id="plan_{{ $plans[$j]['id'] }}">Plan Added</a>
									                </div>
									                <?php $indexcount = $j; ?>
									            @endfor
								            </div>
								        </div>
									</div>
								</div>							
						@endfor						
					@endif