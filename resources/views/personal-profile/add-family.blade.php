@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<style type="text/css">
   .dob label {
        background-color: lightblue;
        padding: 8px;
        color: white;
        margin-right: -3px;
        z-index: 999999;
        position: relative;
        float:left;
        border-top:solid 1px #000;
        border-bottom:solid 1px #000;
        border-left:solid 1px #000;
    }
    .dob input {
        padding: 10px 10px 10px 10px !important;
        width: 240px;
        border: solid 1px lightgray;
        border-radius: 20px;
    }
</style>
<?php 
    $today =date('m-d-Y') ;
?>

<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">

        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Manage Accounts</h4>
                    </div>
                   
                    <div class="row">
						<div class="col-md-12">
							<div class="main-box-white">
			                    <h4 class="page-title">Select Account To Manage</h4>
								<div class="main-box-body">
									<div class="user0imgs @if(!Storage::disk('s3')->exists(Auth::user()->profile_pic)) set-text @endif">
										<div class="dot-settings p-relative">
											<div class="settings-options">
												<div class="more-settings-optns">
													<i class="fas fa-ellipsis-h"></i>
													<ul>
														<li>
															<a class="edit-family" href="{{route('user-profile')}}"><i class="fas fa-edit"></i> Edit</a>
														</li>
														
														<li>
					                                        <a class="view-booikng" href="{{route('personal.orders.index')}}"> <i class="fas fa-info"></i> Booking Info</a>
														</li>
													
														<li>
															<a href="{{route('paymentinfo')}}" >
															<i class="fas fa-money-check"></i> Payment History</a>
														</li>
													</ul>
												</div>
											</div>

											@if(Storage::disk('s3')->exists(Auth::user()->profile_pic))
												<img src="{{Storage::URL(Auth::user()->profile_pic)}}">
											@else
												<div class="no-img-text">
													<p class="character">{{Auth::user()->first_letter}}</p>
												</div>
											@endif
											<span>{{Auth::user()->full_name}}</span>
										</div>								
									</div>

									@foreach($UserFamilyDetails as $family)
										@php $type =  $family->parent_cus_id != '' ? 'customer' : 'user';  @endphp
										<div class="user0imgs @if(!Storage::disk('s3')->exists(@$family->profile_pic)) set-text @endif">
											<div class="dot-settings p-relative">
												<div class="d-grid">
													@if(Storage::disk('s3')->exists(@$family->profile_pic))
														<img src="{{ Storage::URL(@$family->profile_pic)}}">
													@else
														<div class="no-img-text">
															<p class="character">{{$family->first_letter}}</p>
														</div>
													@endif
													<span>{{$family->full_name}}</span>
												</div>
												<div class="settings-options">
													<div class="more-settings-optns">
														<i class="fas fa-ellipsis-h"></i>
														<ul>
															<li>
																<a class="edit-family" href="#" data-behavior="ajax_html_modal" data-url="{{route('showFamilyMember' ,['id'=>$family->id ,'type' =>$type])}}" data-modal-width="1200px">
																<i class="fas fa-edit"></i> Edit</a>
															</li>
															@if( $type == 'customer')
																<li>
							                                        <a class="view-booikng" href="{{route('personal.family_members.index',['customerId'=>$family->id])}}"> <i class="fas fa-info"></i> Booking Info</a>
																</li>
															@endif
															<!-- <li>
																<a data-behavior="ajax_html_modal" data-url="{{route('payment_history' ,['id'=>$family->id ,'type' =>$type])}}" data-modal-width="1200px">
																<i class="fas fa-money-check"></i> Payment History</a>
															</li> -->
															<li>
																@if( $type == 'user')
						                                            <a class="delete-family" data-href="{{route('removefamily' ,['id'=>$family->id,'type' =>$type])}}" data-method="get"> <i class="fas fa-trash-alt"></i> Delete</a>
						                                        @else
						                                            <a class="delete-family" data-href="{{ route('business_customer_delete',['business_id' =>$family->business_id, 'id'=>$family->id]) }}" data-method="delete"> <i class="fas fa-trash-alt"></i> Delete</a>
						                                        @endif
															</li>
														</ul>
													</div>
												</div>
												
											</div>								
										</div>
									@endforeach
									
									<a data-behavior="ajax_html_modal" data-url="{{route('showFamilyMember')}}" data-modal-width="1200px">
										<div class="user0imgs plus-set">
											<div class="plus-add-family">
												<i class="fas fa-plus"></i>
											</div>
											<span>Add Family</span>
										</div>
									</a>
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

<script>
    $('.delete-family').on('click',function(e){
        let text = "Are You sure to delete this member?";
        if (confirm(text) == true) {
            $.ajax({
                url: $(this).data('href'),
                type: $(this).data('method'),
                data:{
                	_token: '{{csrf_token()}}',
                },
                success:function(data){
                    alert('Deleted successfully');
                    location.reload();
                }
            });
        }
    });
</script>

@endsection