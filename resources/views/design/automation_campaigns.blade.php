@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
    @include('business.engage-clients.engage_clients_sidebar')

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-black mb-15" id="menu-toggle"><i class="fas fa-bars"></i></a>

                <div class="row mb-3 y-middle">
					<div class="col-6">
						<div class="page-heading">
							<label>Automation Email Alerts</label>
						</div>
					</div>
                    <div class="col-6">
                        <div class="text-right">
                            <button type="button" class="btn btn-red">Create Automation</button>
                        </div>
					</div>
                </div>

                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#All" role="tab" aria-selected="false">
                                            All
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Active" role="tab" aria-selected="false">
                                            Active
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Inactive" role="tab" aria-selected="false">
                                            Inactive
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content  text-muted">
                                    <div class="tab-pane active" id="All" role="tabpanel">
                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Reminders</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts mt-15 mb-15">
                                                    <label>24-hours appointment reminders</label>
                                                    <p>Notify members of their upcoming bookings & appointments</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>1-hour upcoming appointment reminder </label>
                                                    <p>Notify members of their upcoming bookings & appointments</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mt-15 text-right">
                                                    <button type="button" class="btn btn-black">Create New Reminder</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Client Booking Alerts</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Booking Confirmed. </label>
                                                    <p>Sent to clients when an appointment has been booked.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Booking Rescheduled</label>
                                                    <p>Sent to clients when the appointment start time or date is changed.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Booking cancelled by customer.  </label>
                                                    <p>Sent to clients when the appointment is cancelled.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Booking No-Show </label>
                                                    <p>Sent when clients don’t show to their appointment.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Good Impressions</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts mt-15 mb-15">
                                                    <label>Welcome New Clients</label>
                                                    <p>Sent to clients who have created a new profile.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Welcome to OmneBook</label>
                                                    <p>Email alert to </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Informs clients about your services and offerings </label>
                                                    <p>Gives your clients an opportunity to learn more about what you offer.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Informs how to register, book activities and more</label>
                                                    <p>Informs your clients on how to register for activities and book classes in-person and online.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Thank clients for visiting. </label>
                                                    <p>Thank clients for booking with you and ask for a review.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Wish Clients Happy Birthday</label>
                                                    <p>Surprise clients on their special day. Offer something special. A proven way to boost loyalty & retention.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Celebrate Milestones</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Celebrate Recurring Visits</label>
                                                    <p>Keep students engaged and make them feel special by congratulating them on repeat visits.</p>
                                                    <p>Visited 5 times.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Happy Anniversary</label>
                                                    <p>Give students congratulations when they hit their anniversary of their joining your programs & services.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Members</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts d-grid">
                                                    <label>Reminder to add billing details.</label>
                                                    <label>Card expiring this month. </label>
                                                    <label>Card expired.</label>
                                                    <label>Membership freeze confirmation</label>
                                                    <label>Membership termination confirmation</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Memberships</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts d-grid">
                                                    <label>Membership expiring soon.</label>
                                                    <label>Membership has expired</label>
                                                    <label>Sessions expiring soon </label>
                                                    <label>Sessions has expired</label>
                                                    <label>Out of Sessions </label>
                                                    <label>Trial Expired</label>
                                                    <label>1 Week expiration notification </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Payments</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts d-grid">
                                                    <label>Autopay Failed</label>
                                                    <label>Payment Receipt</label>
                                                    <label>Payment Refund</label>
                                                    <label>Auto-Pay Reminder</label>
                                                    <label>Disputed Payment </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                        </div>

                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Business Email </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts d-grid">
                                                    <label>Activity Cancelled</label>
                                                    <label>Activity Reinstated</label>
                                                    <label>Alert client membership expired</label>
                                                    <label>Alert client sessions expired</label>
                                                    <label>Alert client autopay failed </label>
                                                    <label>Alert client credit card expired </label>
                                                    <label>Booking Cancelled by Business</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="Active" role="tabpanel">
                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Reminders</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts mt-15 mb-15">
                                                    <label>24-hours appointment reminders</label>
                                                    <p>Notify members of their upcoming bookings & appointments</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>1-hour upcoming appointment reminder </label>
                                                    <p>Notify members of their upcoming bookings & appointments</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle font-green"></i>
                                                    <span>Active</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mt-15 text-right">
                                                    <button type="button" class="btn btn-black">Create New Reminder</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="Inactive" role="tabpanel">
                                        <div class="row y-middle">
                                            <div class="col-lg-12">
                                                <div class="campaigans-title mt-25">
                                                    <label>Celebrate Milestones</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Celebrate Recurring Visits</label>
                                                    <p>Keep students engaged and make them feel special by congratulating them on repeat visits.</p>
                                                    <p>Visited 5 times.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                            <div class="col-lg-9 col-md-9 col-7">
                                                <div class="all-alerts">
                                                    <label>Happy Anniversary</label>
                                                    <p>Give students congratulations when they hit their anniversary of their joining your programs & services.</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-4">
                                                <div class="text-right">
                                                    <i class="fas fa-circle"></i>
                                                    <span>Inactive</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-1">
                                                <div class="text-right">
                                                    <a href="http://dev.fitnessity.co/design/alerts_details"><i class="fas fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="border-bottom-grey"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</div>
<!-- /#wrapper -->


    @include('layouts.business.footer')

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#client_wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        function removeClassIfNecessary() {
            var div = document.getElementById('client_wrapper');
            if (window.innerWidth <= 768) { // Example breakpoint
                div.classList.remove('toggled');
            } else {
            div.classList.add('toggled');
            }
        }
        window.addEventListener('resize', removeClassIfNecessary);
        window.addEventListener('DOMContentLoaded', removeClassIfNecessary); // To handle initial load
    </script>

@endsection