@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')


    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <a href="http://dev.fitnessity.co/business/68/orders/create?book_id=0" class="btn btn-black mb-3">Back</a>
                </div>
                <div class="col-xxl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column gift-cards-tab nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-manage-gift-tab" data-bs-toggle="pill" href="#v-pills-manage-gift" role="tab" aria-controls="v-pills-manage-gift" aria-selected="true">Manage Gift Cards</a>
                                        <a class="nav-link mb-2" id="v-pills-purchased-tab" data-bs-toggle="pill" href="#v-pills-purchased" role="tab" aria-controls="v-pills-purchased" aria-selected="false">Purchased</a>
                                        <a class="nav-link mb-2" id="v-pills-purchased-method-tab" data-bs-toggle="pill" href="#v-pills-purchased-method" role="tab" aria-controls="v-pills-purchased-method" aria-selected="false">Purchase Method</a>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-manage-gift" role="tabpanel" aria-labelledby="v-pills-manage-gift-tab">
                                            <!-- <div class="d-flex mb-2 align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift1.png" alt="" class="avatar-sm rounded-circle">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="list-title fs-15 mb-1">Christmas</h5>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <span class="float-right">$100.00</span>
                                                </div>
                                            </div>
                                            <div class="border-bottom-grey"></div> -->
                                            <div class="card text-grey card-border">
                                                <div class="card-body">
                                                    <div class="pt-100 pb-100 text-center h-455">
                                                        <label class="fs-15">No Gift Cards Created Yet</label>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                                    </div>
                                                    <div class="set-gift-btn">
                                                        <a class="btn-gift-card-add" href="http://dev.fitnessity.co/design/gift_card">+</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-purchased" role="tabpanel" aria-labelledby="v-pills-purchased-tab">
                                            <div class="card text-grey card-border">
                                                <div class="card-body">
                                                    <div class="pt-100 pb-100 text-center">
                                                        <label class="fs-15">No active gift cards</label>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-purchased-method" role="tabpanel" aria-labelledby="v-pills-purchased-method-tab">
                                            <div class="card text-grey card-border">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0 flex-grow-1">Online</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <p>Allow clients to purchase Gift Cards instantly and at any time through Fitnessity by activating Mobile Payments.</p>
                                                        <p>Once activated, you'll be able to sell Gift Cards online from your Fitnessity Profile and in person through the checkout tab.</p>
                                                    </div>
                                                    <div class="purchase-method">
                                                        <ul class="list-arrow-circle">
                                                            <li>
                                                                <label>Convenience</label>
                                                                <p>Client can order your Gift Cards anytime. So you can make sales even outside your regular working hours.</p>
                                                            </li>
                                                            <li>
                                                                <label>Time-saving</label>
                                                                <p>Can be purchased by clients in just a few clicks.</p>
                                                            </li>
                                                            <li>
                                                                <label>Delivered immediately</label>
                                                                <p>Once payment is authorized, the Gift Card is automatically sent to the client via email and available to them in app.</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--  end col -->
                            </div>
                            <!--end row-->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div>
        </div>
    </div>
</div>

    @include('layouts.business.footer')

@endsection