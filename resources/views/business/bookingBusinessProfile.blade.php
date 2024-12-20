@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="bookinginfo" name="bookinginfo" method="post" >
                <div class="container-fluid p-0" id="bookings1">
                    <div class="tab-hed">Booking Info</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="booking_info_section">

                                    <div class="bookings-block">

                                        <nav>

                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link" data-toggle="tab" href="#activity-schedule">Activity Schedule</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#account-info">Client Account Info.</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#pending">Pending</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#quotes">Quotes</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#completed">Completed</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#cancelled">Cancelled</a>

                                                <a class="nav-item nav-link active" data-toggle="tab" href="#checkout">Checkout</a>
                                            </div>

                                        </nav>

                                        <div class="tab-content" id="nav-tabContent">

                                            <div class="tab-pane" id="activity-schedule">
                                                <div class="activity-schedule-section">

                                                    <div class="showentrie_block1 col-md-12">
                                                        <div class="showentries_date_block">
                                                            <div class="show_block">
                                                                <label for="">Show</label>
                                                                <select name="" id="" class="form-control">
                                                                    <option value="">10</option>
                                                                    <option value="">25</option>
                                                                    <option value="">50</option>
                                                                    <option value="">All</option>
                                                                </select>
                                                                <label for="">Entries</label>
                                                            </div>
                                                            <div class="date_block special-date">
                                                                <label for="">Date:</label>
                                                                <input type="text" class="form-control span2" name="frm_servicestart" placeholder="dd/mm/yyyy" id="dateactivity" readonly="readonly">
                                                                <i class="fa fa-calendar"></i>
                                                                <script>
                                                                    $('#dateactivity').datepicker();

                                                                </script>
                                                            </div>

                                                        </div>

                                                        <div class="show_block">
                                                            <a class="submit-btn" data-toggle="modal" data-target="#myModal">Add New Client</a>
                                                        </div>

                                                        <div class="search_block">
                                                            <label for="">Search:</label>
                                                            <input type="search" name="" id="" placeholder="Search for client to check in" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 threediv-date">
                                                        <p><span>Date:</span> Wednesday, April 07 2021</p>
                                                        <p><span>Time:</span> 9:00 am - 10:00am</p>
                                                        <p><span>Duration:</span> 1h</p>
                                                    </div>

                                                    <div class="table-responsive activity-table">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Booking #</th>
                                                                    <th>Client Name</th>
                                                                    <th>Price</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Remaining</th>
                                                                    <th>Expiration Date</th>
                                                                    <th>Check In</th>
                                                                    <th>Receipt</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="fa fa-times" style="color:red;"></i>1</td>
                                                                    <td>3001</td>
                                                                    <td>Darryl Phipps</td>
                                                                    <td>$1,200</td>
                                                                    <td>20 Session Pack</td>
                                                                    <td>20/20</td>
                                                                    <td>07/06/2021</td>
                                                                    <td><input type="checkbox" id="" name=""></td>
                                                                    <td><img class="report-img" data-toggle="modal" data-target="#myModalreport" src="{{ url('public/img/report.png') }}"></td>
                                                                    <td>
                                                                        <a href="#" class="btn-nxt">Purchase</a>
                                                                        <a href="#" class="btn-nxt" data-toggle="modal" data-target="#myModalaccount1">View Account</a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div id="myModalaccount1" class="modal viewaccount-block" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lisaaccount">
                                                                    <img src="{{ url('public/img/lisa.png') }}">
                                                                    <h3>Lisa Santana <a href="#">View Profile</a></h3>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 rightaccount">
                                                                    <div class="modal-body">
                                                                        <h3>Personal Details</h3>
                                                                        <h3>Customer Since: <span>04/01/2021</span></h3>
                                                                        <h3>Last Visited: <span>04/07/2021</span></h3>
                                                                        <h3>Email: <span>lisasantanta@yopmail.com</span></h3>
                                                                        <h3>Birthday: <span>00/00/0000</span></h3>
                                                                        <h3>Age: <span>30 yrs.,10 mon.</span></h3>
                                                                        <h3>Gender: <span>Female</span></h3>
                                                                        <h3>Emergency Conact Information</h3>
                                                                        <p>Name: Frank Santana</p>
                                                                        <p>Relationship: Brother</p>
                                                                        <p>Number: 555-555-5555</p>
                                                                        <p>Email: franksantana@yopmail.com</p>
                                                                        <h3>Family Members Connected (1)</h3>
                                                                        <p>Eric Santana: husband (38yrs 4mon.)</p>
                                                                        <h3>Terms of Service</h3>
                                                                        <p>Covid-19 Protocols agreed on 10/10/2021</p>
                                                                        <p>Liability Waiver agreed on 10/10/2021</p>
                                                                        <p>Contract Terms agreed on 10/10/2021</p>
                                                                        <h3>Billing Information</h3>
                                                                        <p>CC ending in ****9045</p>

                                                                        <div class="noteclient-block">
                                                                            <label>Notes About Client</label>
                                                                            <textarea rows="7" cols="5" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 leftaccount">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Booking & Purchase Details</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h3>Current & Active Bookings</h3>
                                                                        <div class="boxes_arts">
                                                                            <div class="middleboxes" id="middle1">
                                                                                <p>
                                                                                    <span></span>
                                                                                    <span><img src="{{ url('public/img/report.png') }}"></span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING #</span>
                                                                                    <span>3004</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL PRICE</span>
                                                                                    <span>$1,200</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PAYMENT TYPE:</span>
                                                                                    <span>15 Sessions</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL REMAINING:</span>
                                                                                    <span>14/15</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PROGRAM NAME:</span>
                                                                                    <span>Kickboxing for Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>EXPIRATION DATE:</span>
                                                                                    <span>06/1/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DATE BOOKED</span>
                                                                                    <span>04/07/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>RESERVED DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING TIME:</span>
                                                                                    <span>12:00 PM EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKED BY:</span>
                                                                                    <span>Darryl Phipps</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN TIME:</span>
                                                                                    <span>12:15pm EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY TYPE:</span>
                                                                                    <span>Kickboxing</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>SERVICE TYPE:</span>
                                                                                    <span>Personal Training</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY LOCATION:</span>
                                                                                    <span>Place of business</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DURATION:</span>
                                                                                    <span>1 Hour</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GREAT FOR:</span>
                                                                                    <span>Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GROUP SIZE:</span>
                                                                                    <span>2</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>WHO IS PARTICIPATING?</span>
                                                                                    <span>Me (18+) <br>Lisa (18+)</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="foterboxes">
                                                                                <div class="viewmore_links">
                                                                                    <a id="viewmore1">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                    <a id="viewless1">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="boxes_arts">
                                                                            <div class="middleboxes" id="middle2">
                                                                                <p>
                                                                                    <span></span>
                                                                                    <span><img src="{{ url('public/img/report.png') }}"></span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING #</span>
                                                                                    <span>4500</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL PRICE</span>
                                                                                    <span>$1,200</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PAYMENT TYPE:</span>
                                                                                    <span>15 Sessions</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL REMAINING:</span>
                                                                                    <span>10/15</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PROGRAM NAME:</span>
                                                                                    <span>Kickboxing for Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>EXPIRATION DATE:</span>
                                                                                    <span>06/1/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DATE BOOKED</span>
                                                                                    <span>04/07/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>RESERVED DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING TIME:</span>
                                                                                    <span>12:00 PM EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKED BY:</span>
                                                                                    <span>Darryl Phipps</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN TIME:</span>
                                                                                    <span>12:15pm EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY TYPE:</span>
                                                                                    <span>Kickboxing</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>SERVICE TYPE:</span>
                                                                                    <span>Personal Training</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY LOCATION:</span>
                                                                                    <span>Place of business</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DURATION:</span>
                                                                                    <span>1 Hour</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GREAT FOR:</span>
                                                                                    <span>Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GROUP SIZE:</span>
                                                                                    <span>2</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>WHO IS PARTICIPATING?</span>
                                                                                    <span>Me (18+) <br>Lisa (18+)</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="foterboxes">
                                                                                <div class="viewmore_links">
                                                                                    <a id="viewmore2">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                    <a id="viewless2">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="boxes_arts">
                                                                            <div class="middleboxes" id="middle3">
                                                                                <p>
                                                                                    <span></span>
                                                                                    <span><img src="{{ url('public/img/report.png') }}"></span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING #</span>
                                                                                    <span>4500</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL PRICE</span>
                                                                                    <span>$1,200</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PAYMENT TYPE:</span>
                                                                                    <span>15 Sessions</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>TOTAL REMAINING:</span>
                                                                                    <span>10/15</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>PROGRAM NAME:</span>
                                                                                    <span>Kickboxing for Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>EXPIRATION DATE:</span>
                                                                                    <span>06/1/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DATE BOOKED</span>
                                                                                    <span>04/07/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>RESERVED DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKING TIME:</span>
                                                                                    <span>12:00 PM EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>BOOKED BY:</span>
                                                                                    <span>Darryl Phipps</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN DATE:</span>
                                                                                    <span>04/10/2021</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>CHECK IN TIME:</span>
                                                                                    <span>12:15pm EST</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY TYPE:</span>
                                                                                    <span>Kickboxing</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>SERVICE TYPE:</span>
                                                                                    <span>Personal Training</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>ACTIVITY LOCATION:</span>
                                                                                    <span>Place of business</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>DURATION:</span>
                                                                                    <span>1 Hour</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GREAT FOR:</span>
                                                                                    <span>Adults</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>GROUP SIZE:</span>
                                                                                    <span>2</span>
                                                                                </p>
                                                                                <p>
                                                                                    <span>WHO IS PARTICIPATING?</span>
                                                                                    <span>Me (18+) <br>Lisa (18+)</span>
                                                                                </p>
                                                                            </div>
                                                                            <div class="foterboxes">
                                                                                <div class="viewmore_links">
                                                                                    <a id="viewmore3">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                    <a id="viewless3">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="myModalreport" class="modal booking-report" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blackright">
                                                                    <div class="modal-body">
                                                                        <h3><img src="{{ url('public/img/volar.png') }}">Valor Mixed Martial Arts</h3>
                                                                        <div class="formlisa">
                                                                            <h4>Lisa Santana</h4>
                                                                            <div class="form-group">
                                                                                <label>Email Receipt</label>
                                                                                <input type="search" name="" id="" placeholder="youremail@abc.com" class="form-control">
                                                                            </div>
                                                                            <input type="submit" class="sendemail-btn" value="Send Email Receipt">
                                                                        </div>
                                                                        <div class="powerdeblock">
                                                                            Powered By <img src="{{ url('public/images/logo_new.png') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 leftblock">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Booking Receipt</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h4><span>1.</span> BOOKING# <span>3808</span></h4>
                                                                        <h4>TOTAL PRICE <span>$1,200</span></h4>
                                                                        <h4>PAYMENT TYPE: <span>15 Sessions</span></h4>
                                                                        <h4>PROGRAM NAME: <span>Kickboxing for Adults</span></h4>
                                                                        <h4>EXPIRATION DATE: <span>06/1/2021</span></h4>
                                                                        <h4>DATE BOOKED: <span>04/07/2021</span></h4>
                                                                        <h4>RESERVED DATE: <span> 04/10/2021</span></h4>
                                                                        <h4>BOOKING TIME: <span>12:00 PM EST</span></h4>
                                                                        <h4>BOOKED BY: <span>Darryl Phipps</span></h4>
                                                                        <h4>CHECK IN DATE: <span>None</span></h4>
                                                                        <h4>CHECK IN TIME: <span>None</span></h4>
                                                                        <h4>ACTIVITY TYPE: <span>Kickboxing</span></h4>
                                                                        <h4>SERVICE TYPE: <span>Personal Training</span></h4>
                                                                        <h4>ACTIVITY LOCATION: <span>On Location</span></h4>
                                                                        <h4>DURATION: <span>1 Hour</span></h4>
                                                                        <h4>GREAT FOR: <span>Adults</span></h4>
                                                                        <h4>GROUP SIZE: <span>2</span></h4>
                                                                        <h4>WHO IS PARTICIPATING? <span>Me (18+) <br> Lisa (18+)</span></h4>
                                                                        <div class="bggrey"></div>
                                                                        <h3>Sub-total <span>$1200</span></h3>
                                                                        <h3>Taxes & Service Fee’s <span>$200</span></h3>
                                                                        <h3>Grand Total <span>$1400</span></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="account-info">
                                                <div class="client-account-section">

                                                    <div class="showentrie_block1 col-md-12">

                                                        <div class="show_block">
                                                            <a class="submit-btn" data-toggle="modal" data-target="#myModal">Add New Client</a>
                                                        </div>

                                                        <div class="search_block">
                                                            <label for="">Search:</label>
                                                            <input type="search" name="" id="" placeholder="Search for client" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="table-responsive activity-table">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>Birthday</th>
                                                                    <th>Age</th>
                                                                    <th>Family</th>
                                                                    <th>Booking History</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>A</td>
                                                                    <td>Adam Burgman</td>
                                                                    <td>09/12/1070</td>
                                                                    <td>62</td>
                                                                    <td><a href="">View</a></td>
                                                                    <td><a href="">View</a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="pending">
                                                <h4>Pending</h4>
                                            </div>

                                            <div class="tab-pane" id="quotes">
                                                <h4>Quotes</h4>
                                            </div>

                                            <div class="tab-pane" id="completed">
                                                <h4>Completed</h4>
                                            </div>

                                            <div class="tab-pane" id="cancelled">
                                                <h4>Cancelled</h4>
                                            </div>

                                            <div class="tab-pane in active" id="checkout">

                                                <div class="showentrie_block col-md-12">

                                                    <div class="showentries_date_block">

                                                        <div class="show_block">
                                                            <input type="text" name="" id="" class="form-control" placeholder="Select which client is making a purchase?">
                                                            <a class="submit-btn" data-toggle="modal" data-target="#myModal">Add New Client</a>
                                                        </div>

                                                    </div>

                                                    <div class="bookings-walksale-block">

                                                        <div class="col-md-6 col-sm-12 col-xs-12">

                                                            <div class="walkinsale-block">

                                                                <div class="clientname">
                                                                    <b>Client Name:</b> Lisa Santana or Walk-In-Sale
                                                                </div>

                                                                <div class="clientcategory">
                                                                    <select name="clientservice" id="clientservice" multiple>
                                                                        <option value="" hidden>Select Service Catagory</option>
                                                                        <option value="0">Service Catagory1</option>
                                                                        <option value="1">Service Catagory2</option>
                                                                        <option value="2">Service Catagory3</option>
                                                                        <option value="3">Service Catagory4</option>
                                                                        <option value="4">Service Catagory5</option>
                                                                        <option value="5">Service Catagory6</option>
                                                                    </select>

                                                                    <select name="clientprograme" id="clientprograme" multiple>
                                                                        <option value="" hidden>Select Program Name</option>
                                                                        <option value="0">Program Name1</option>
                                                                        <option value="1">Program Name2</option>
                                                                        <option value="2">Program Name3</option>
                                                                        <option value="3">Program Name4</option>
                                                                        <option value="4">Program Name5</option>
                                                                        <option value="5">Program Name6</option>
                                                                    </select>

                                                                    <script>
                                                                        var p = new SlimSelect({
                                                                            select: '#clientservice'
                                                                        });
                                                                        var p = new SlimSelect({
                                                                            select: '#clientprograme'
                                                                        });

                                                                    </script>
                                                                </div>

                                                                <div class="priceblock-client">

                                                                    <div class="form-group">
                                                                        <label>Price</label>
                                                                        <input type="text" name="" id="" value="$1200.00" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Discount</label>
                                                                        <input type="text" name="" id="" class="form-control">
                                                                        <select name="amount" id="amount" multiple>
                                                                            <option value="" hidden>Amount</option>
                                                                            <option value="0">Dollar</option>
                                                                        </select>
                                                                        <script>
                                                                            var p = new SlimSelect({
                                                                                select: '#amount'
                                                                            });

                                                                        </script>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Participant Count</label>
                                                                        <select name="count" id="count" multiple>
                                                                            <option value="" hidden>Select</option>
                                                                            <option value="0">Count 1</option>
                                                                            <option value="0">Count 2</option>
                                                                            <option value="0">Count 3</option>
                                                                        </select>
                                                                        <script>
                                                                            var p = new SlimSelect({
                                                                                select: '#count'
                                                                            });

                                                                        </script>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Who's Participanting?</label>
                                                                        <select name="participanting" id="participanting" multiple>
                                                                            <option value="" hidden>Select</option>
                                                                            <option value="0">Participanting 1</option>
                                                                            <option value="0">Participanting 2</option>
                                                                            <option value="0">Participanting 3</option>
                                                                        </select>
                                                                        <script>
                                                                            var p = new SlimSelect({
                                                                                select: '#participanting'
                                                                            });

                                                                        </script>
                                                                    </div>

                                                                    <hr>

                                                                    <h3>Detail Summary</h3>

                                                                    <div class="participants-two">
                                                                        <span>Participants</span>
                                                                        <span>2</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <span>Subtotal</span>
                                                                        <span>$1200.00</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <span>Discount</span>
                                                                        <span>$0.00</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <span>Tax No Tax</span>
                                                                        <span>$54.00</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <span>Service Fee</span>
                                                                        <span>12%</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <span>Total</span>
                                                                        <span>$1.398</span>
                                                                    </div>

                                                                    <div class="participants-two">
                                                                        <a href="#" class="addticket">Add To Ticket</a>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6 col-sm-12 col-xs-12">

                                                            <div class="ticket-itemsblock">

                                                                <h2>Ticket Items</h2>

                                                                <div class="itembox">

                                                                    <h4>Item 1</h4>

                                                                    <p>
                                                                        <span>Service Catagory:</span>
                                                                        <span>Class</span>
                                                                    </p>

                                                                    <p>
                                                                        <span>Program Name:</span>
                                                                        <span>Kickboxing for Adults</span>
                                                                    </p>

                                                                    <p>
                                                                        <span>Who's Participating</span>
                                                                        <span>Lisa Santana (30), Eric Santana (45)</span>
                                                                    </p>

                                                                    <p>
                                                                        <span>Participants</span>
                                                                        <span>2</span>
                                                                    </p>

                                                                    <h3>
                                                                        <span>Subtotal</span>
                                                                        <span>$1200.00</span>
                                                                    </h3>

                                                                    <h3>
                                                                        <span>Discount</span>
                                                                        <span>$0.00</span>
                                                                    </h3>

                                                                    <h3>
                                                                        <span>Taxes & Service Fee</span>
                                                                        <span>$198.00</span>
                                                                    </h3>

                                                                    <h3>
                                                                        <span>Total</span>
                                                                        <span>$1,398</span>
                                                                    </h3>

                                                                </div>

                                                                <div class="total-boxes">
                                                                    <div class="totalbox">
                                                                        <h5>Sub Total</h5>
                                                                        <h4>$1200</h4>
                                                                    </div>
                                                                    <div class="totalbox">
                                                                        <h5>Discounts</h5>
                                                                        <h4>$0.00</h4>
                                                                    </div>
                                                                    <div class="totalbox">
                                                                        <h5>Tax & Service Fee</h5>
                                                                        <h4>$198.00</h4>
                                                                    </div>
                                                                    <div class="totalbox">
                                                                        <h5>Grand Total</h5>
                                                                        <h4>$1,398</h4>
                                                                    </div>
                                                                </div>

                                                                <div class="paymentmethod">
                                                                    <p>Select Payment Method</p>
                                                                    <a href="#">CC (Input Card)</a>
                                                                    <a href="#">CC (Stored Card)</a>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div id="myModal" class="modal addclient-modal" role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 leftblock">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>STEP 1 OF 5</p>
                                                            <form>
                                                                <div class="form-group pleftright">
                                                                    <input type="text" name="" id="" class="form-control" placeholder="First Name">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="text" name="" id="" class="form-control" placeholder="Last Name">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="text" name="" id="" class="form-control" placeholder="User Name">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="email" name="" id="" class="form-control" placeholder="Email Address">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="number" name="" id="" class="form-control" placeholder="Phone">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="password" name="" id="" class="form-control" placeholder="Password">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <input type="password" name="" id="" class="form-control" placeholder="Confirm Password">
                                                                </div>
                                                                <div class="form-group pleftright">
                                                                    <label for="agree">
                                                                        <input type="checkbox" id="agree" name=""> <span>I AGREE TO OMNEBOOK <b> TERMS OF SERVICE</b> AND <b> PRIVACY POLICY</b></span>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <input type="submit" name="" id="" value="CREATE ACCOUNT" class="submit-btn">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blackright">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3>Search For Client On Omnebook</h3>
                                                            <p>*Your client could already have a profile on Omnebook*</p>
                                                            <form>
                                                                <div class="form-group">
                                                                    <input type="search" name="" id="" class="searchbox">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="col-md-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" onclick="location.href='{{route('servicesBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn-nxt" id="book-nxt1">Continue <i class="fa fa-arrow-right"></i></button>
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
