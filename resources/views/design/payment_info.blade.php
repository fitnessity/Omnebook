@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Payment Information</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">Payment History</h4>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row">
									<div class="item-history ">
										<div class="table-responsive">
											<table id="historyTable" class="table mb-25" style="width: 100%">
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
															<td>06/30/2023</td>
															<td>1. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>cash</td>
															<td>$50</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1057/380" data-item-type="Membership" data-modal-width="1200px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>06/26/2023</td>
															<td>1. Spring Lake Day Camp (Summer Camp Full Day) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>visa ****4242</td>
															<td>$56.94</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1050/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
																																													<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>discover ****1113</td>
															<td>$91.1</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1035/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$150.73</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1029/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>06/20/2023</td>
															<td>1. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$95.21</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1027/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>05/24/2023</td>
															<td>1. Go Golfers (global acdamy) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>discover ****1113</td>
															<td>$10.39</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1011/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>05/11/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br>2. Love Tennis (Private Lessons 30 Min. (1 Person)) ,30 Minute Private (01 Pack)<br></td>
															<td>Membership</td>
															<td>visa ****4242</td>
															<td>$241.22</td>
															<td>2</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1009/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Aerobics (Solo Private Lessons) ,30 Minutes<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$10.39</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1008/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>mastercard ****3222</td>
															<td>$155.81</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1007/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
														<tr>
															<td>05/06/2023</td>
															<td>1. Summer Camp at Valor (Summer Camp Full Day (8:30 am to 3:00 pm)) ,1 Day Full Camp<br></td>
															<td>Membership</td>
															<td>mastercard ****8210</td>
															<td>$155.81</td>
															<td>1</td>
															<td>Refund | Void</td>
															<td><a class="mailRecipt" data-behavior="send_receipt" data-url="http://dev.fitnessity.co/receiptmodel/1006/720" data-item-type="Membership" data-modal-width="900px"><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
														</tr>
												</tbody>
											</table>
											<div class="float-right">
												<nav>
													<ul class="pagination">
														<li class="page-item">
															<a class="page-link" href="#" rel="prev" aria-label="« Previous">‹</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="http://dev.fitnessity.co/personal-profile/payment-info?page=1">1</a>
														</li>
														<li class="page-item active" aria-current="page">
															<span class="page-link">2</span>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">3</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">4</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">5</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
														</li>
													</ul>
												</nav>
											</div>
										</div>
									</div>
								</div>                                    
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!-- end col -->
				</div><!-- end row -->				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')

@endsection