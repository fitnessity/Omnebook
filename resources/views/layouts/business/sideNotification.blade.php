<div class="col-auto layout-rightside-col">
    <div class="overlay"></div>
    <div class="layout-rightside">
        <div class="card h-100 rounded-0">
            <div class="card-body p-0">
                <div class="p-3 p-relative">
                    <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                    <a href="javascript:void(0)" class="fa fa-times notification-close" onclick="$('.layout-rightside-col').removeClass('d-block');"></a>
                </div>
                <div class="p-3 pt-0 recent-activity-scroll">
                    <div class="acitivity-timeline acitivity-main">
                        @foreach($todayBooking as $tb)
                            <div class="acitivity-item d-flex  mb-5">
                                <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                    <div class="avatar-title bg-soft-success text-success rounded-circle shadow">
                                        <i class="ri-shopping-cart-2-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 lh-base">{{$tb->booking->order_id}}</h6>
                                    <p class="text-muted mb-1"><b>Activity : </b>{{@$tb->business_services->program_name}} </p>
                                    <p class="text-muted mb-1"><b>Price : </b> ${{@$tb->subtotal + $tb->getperoderprice() }}</p>
                                    <small class="mb-0 text-muted">{{date('H:i A' ,strtotime($tb->created_at))}} Today</small>
                                </div>
                            </div>
                        @endforeach

                        @foreach($notificationAry as $nd)
                            <div class="acitivity-item d-flex mb-5">
                                <div class="flex-shrink-0">
                                    @if( $nd['image'] != '')
                                        <img src="{{$nd['image']}}" alt="Fitnessity" class="avatar-xs rounded-circle acitivity-avatar shadow" />
                                    @else
                                        <div class="avatar-xsmall">
                                           <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$nd['fl']}}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3 mb-10">
                                    <h6 class="mb-1 lh-base">{{$nd['title']}}</h6>
                                    <p class="text-muted mb-2 fst-italic">{!!$nd['text'] !!}</p>
                                    <small class="mb-0 text-muted">{{$nd['date']}}</small>
                                </div>
                            </div>
                        @endforeach

                        @if(count($notificationAry) == 0 && count($todayBooking) == 0)
                           <p class="mb-3">Not Available</p>
                        @endif
                    </div>
                </div>
                <div class="p-3 mt-2">
                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top Booked Memberships
                    </h6>
                    @if(count($topBookedCategories) > 0)
                        <div class="row mb-10">
                            <div class="col-md-6 col-6">
								<span class="font-weight-600 color-grey"> Category Name</span>
							</div>
                            <div class="col-md-6 col-6">
                                <div class="row">
                                    <div class="col-md-5 col-5">
										<span class="font-weight-600 color-grey">Paid</span>
									</div>
                                    <div class="col-md-7 col-7">
										<span class="font-weight-600 color-grey">Booked</span>
									</div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            @foreach(@$topBookedCategories as $i=> $tbc)
                                @if($i< 10)
                                <div class="col-md-6 col-6">
                                    <span class="text-muted">{{$i+1}}. {{$tbc['name']}} </span>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <span class="text-muted">${{$tbc['paid']}}</span>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <span class="text-muted">{{$tbc['booked']}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <span>No Categories Available </span>
                    @endif
                </div>

                <div class="p-3">
                    <h6 class="text-muted mb-3 text-uppercase fw-semibold">Recent activity reviews</h6>
                    
                    @foreach($services as $service)
                        @php  
                            $rating =0;
                            $reviews_count = App\BusinessServiceReview::where('service_id', $service->id)->count();
                            $reviews_sum = App\BusinessServiceReview::where('service_id', $service->id)->sum('rating'); 
                            $rating = $reviews_count != 0 ? round($reviews_sum/$reviews_count,2) : 0;
                        @endphp
                        <h6 class="text-muted mb-3 fw-semibold mt-5">{{$service->program_name}} activity reviews</h6>
                        <div class="bg-light px-3 py-2 rounded-2 mb-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="fs-16 align-middle text-warning">
                                        @for($i= 1;$i<=$rating;$i++)
                                            @if($i>5)
                                                @break(0);
                                            @endif
                                            <i class="ri-star-fill"></i>
                                        @endfor

                                        @if(5-$rating > 0)
                                            @for($i= 1;$i<=5-$rating;$i++)
                                                @if($rating - $i == 0.5)
                                                    <i class="ri-star-half-fill"></i>
                                                @endif
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <h6 class="mb-0">{{$rating}} out of 5</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                    <div class="card-body">
                        {{-- <img src="" alt="Fitnessity"> --}}
                        <div class="mt-4">
                            <h5>Refer Another Provider</h5>
                            <p class="text-muted lh-base"> Get a Free Month membership for each provider you refer and they claim or create a business account with Fitnessity</p>
                            <button type="button" class="btn btn-red">Invite Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card-->
    </div> <!-- end .rightbar-->
</div> <!-- end col -->



