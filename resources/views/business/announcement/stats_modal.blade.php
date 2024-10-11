<div class="row">
	<div class="col-lg-12">
		<h4 class="card-title mb-10 flex-grow-1">{{$announcement->title}}</h4>
	</div>
</div>


<div class="card box-border shadow-none">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="card-title mb-10 flex-grow-1">Performance Summary</h4>
			</div>
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<div class="card box-border">
							<div class="card-body text-center">
								<p>Sent</p>
								<div>
									<label>{{$announcement->announcementContactCustomerList()->sum('is_sent_email')}}</label>
								</div>
								<div>
									<label>@if($announcement->announcement_status == 'Sent') {{$announcement->bounced_email}}  @else 0 @endif Bounced</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card box-border">
							<div class="card-body text-center">
		    					<div class="row">
									<div class="col-lg-6">
										<p>Opened</p>
										<div>
				    						<label>{{$announcement->opened_cus_per}}%</label>
				    					</div>
				    					<div>
				    						<label>{{$announcement->announcementContactCustomerList()->sum('is_opened_email')}}</label>
				    					</div>
									</div>
									<div class="col-lg-6">
										<p>Unsubscribed</p>
										<div>
			    							<label>{{$announcement->unsubcribed_cus_per}}%</label>
			    						</div>
			    						<div>
			    							<label>{{$announcement->announcementContactCustomerList()->sum('is_unsubscribed_email')}}</label>
			    						</div>
									</div>
		    					</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
  