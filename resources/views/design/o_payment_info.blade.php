@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/creditcard.css') }}">

<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Payment Information</h4>
                    </div>
					<div class="payment_info_section padding-1 white-bg border-radius1">
                        <div class="payment-info-block">
							<div class="purchase-history">
                                <div class="table-responsive">
                                    <table id="historyTable" class="table mb-0" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Sale Date </th>
                                                <th>Item Description </th>
                                                <th>Item Type</th>
                                                <th>Pay Method</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Refund/Void</th>
                                                <th>Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodydetail">
											<tr>
												<td>09/01/2023</td>
												<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
												<td>Membership</td>
												<td>visa ****4242</td>
												<td>$85.41</td>
												<td>1</td>
												<td>Refund | Void</td>
												<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1182/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
											</tr>
											<tr>
												<td>09/01/2023</td>
												<td>1. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br>2. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br>3. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br></td>
												<td>Membership</td>
												<td>discover ****1113</td>
												<td>$79.48</td>
												<td>3</td>
												<td>Refund | Void</td>
												<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1180/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a></td>
											</tr>
										</tbody>
                                    </table>
                                    <div class="float-right">
										<nav>
											<ul class="pagination">
												<li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
													<span class="page-link" aria-hidden="true">‹</span>
												</li>
												<li class="page-item active" aria-current="page">
													<span class="page-link">1</span>
												</li>
                                                <li class="page-item">
													<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=2">2</a>
												</li>
                                                <li class="page-item">
													<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=3">3</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=4">4</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=5">5</a>
												</li>
												
												<li class="page-item">
													<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=2" rel="next" aria-label="Next »">›</a>
												</li>
											</ul>
										</nav>
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
@include('layouts.footer')


<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<script src="{{ url('public/js/creditcard.js') }}"></script>


@endsection