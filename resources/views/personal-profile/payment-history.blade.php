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
											@forelse($transactionDetail as $history )
                                                <tr>
                                                    <td>{{date('m/d/Y',strtotime($history->created_at))}}</td>
                                                    <td>{!!$history->item_description()['itemDescription']!!}</td>
                                                    <td>{{$history->item_type_terms()}}</td>
                                                    <td>{{$history->getPmtMethod()}}</td>
                                                    <td>${{$history->amount}}</td>
                                                    <td>{{$history->item_description()['qty']}}</td>
                                                    <td>Refund | Void</td>
                                                    <td><a  class="mailRecipt" data-behavior="send_receipt"  data-item-type="{{$history->item_type_terms()}}" data-modal-width="900px" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @empty 
                                            @endforelse
										</tbody>
                                    </table>
                                    <div class="float-right">
                                        @if(!empty($transactionDetail))
                                        {{ @$transactionDetail->links() }}
                                        @endif
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