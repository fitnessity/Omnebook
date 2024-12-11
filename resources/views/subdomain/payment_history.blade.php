@inject('request', 'Illuminate\Http\Request')
@extends('subdomain.layouts.header')

@section('content')

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
														<th>Status</th>
														<th>Receipt</th>
													</tr>
												</thead>
												<tbody id="tbodydetail">
													@forelse($transactionDetail as $history)
														<tr>
															<td>{{ date('m/d/Y', strtotime($history['created_at'])) }}</td>
															<td>{!! (new App\Transaction($history))->item_description($business->id)['itemDescription'] !!}</td> 
															<td>{{(new App\Transaction($history))->item_type_terms() }}</td> 
															<td>{{(new App\Transaction($history))->getPmtMethod() }}</td> 
															<td>${{$history['amount']}}</td>
															<td>{{$history['qty']}}</td>
															<td>{!! (new App\Transaction($history))->getBookingStatus() !!}</td> 
															<td><a class="mailRecipt" data-behavior="ajax_html_modal" data-url="{{route('receiptmodel_sub',['orderId'=>$history['item_id'],'customer'=>$history['customer_id']])}}" data-item-type="{{(new App\Transaction($history))->item_type_terms() }}" data-modal-width="modal-70" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
															</td>
															</tr>
													    @empty 
														<tr> <td colspan="8">Payment History Is Not Available</td></tr>
                                       				@endforelse
												</tbody>
											</table>
											<div class="float-right">
												@if(!empty($transactionDetail))
													{{ @$transactionDetail->appends(['business_id' => request()->business_id])->links() }}
                                  				@endif
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="ajax_html_modal" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn-modal"></button>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '[data-behavior~=ajax_html_modal]', function(e){
		$("#modal-dialog").removeClass();
		$("#modal-dialog").addClass('modal-dialog modal-dialog-centered');
        var width = $(this).data('modal-width');
        var reload = $(this).data('reload');
        if(width == undefined){
            // width = 'modal-50';
        }
         var chkbackdrop  = $(this).attr('data-modal-chkBackdrop');            
        e.preventDefault()
        $.ajax({
            url: $(this).data('url'),
            success: function(html){
            	$('#ajax_html_modal .modal-body').html(html)
                $('#ajax_html_modal .modal-dialog').addClass(width);
                if(reload == 1 ){
                	$('#close-btn-modal').attr('onclick', 'window.location.reload()');
                }else{
                	$('#close-btn-modal').removeAttr('onclick');
                }
            	if(chkbackdrop == 1){
            		$('#ajax_html_modal').modal({ backdrop: 'static', keyboard: false });
            		$('#ajax_html_modal').modal('show')

        		}else{
                    $('#ajax_html_modal').modal('show')
        		}
            }
        })
    });
</script>
@endsection