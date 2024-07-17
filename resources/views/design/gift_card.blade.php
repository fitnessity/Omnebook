@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12">
                        <a href="http://dev.fitnessity.co/design/manage_gift_card" class="btn btn-black mb-3">Back</a>
                    </div>
                    <div class="col-xxl-4 col-lg-4">
                        <div class="card card-height-100">
                            <div class="card-body">
                                <div class="mb-35">
                                    <p class="mb-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                    <p class="mb-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                </div>
                                <div class="gift-processing mb-35">
                                    <h1 class="mb-15">The Processing fee applies.</h1>
                                    <form action="">
                                        <div class="mb-3">
								            <label class="form-label">Gift Card Name</label>
									        <input type="text" class="form-control" id="giftnameInput">
									    </div>  
                                        <div class="mb-3">
								            <label class="form-label">Description</label>
									        <input type="text" class="form-control" id="Description">
									    </div>  
                                        <div class="mb-3">
								            <label class="form-label">Price</label>
									        <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                <input type="text" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1">
                                            </div>
									    </div>  
                                        <div class="mb-3">
								            <label class="form-label">Value</label>
									        <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                <input type="text" class="form-control" placeholder="Value" aria-label="Value" aria-describedby="basic-addon1">
                                            </div>
									    </div>  
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-3">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>

                                    <p class="mb-3"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-xxl-6 col-lg-6 col-md-6 col-sm-7">
                                        <div class="gift-card-block mb-35">
											<div class="gift-cards-content" style="background-image: url(http://dev.fitnessity.co/public/dashboard-design/images/gift-card-2.jpg);">
                                                <div class="row">
                                                    <div class="col-lg-6 col-6">
                                                        <div class="giftcard-title">
                                                            <label>Gift Card</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-6">
                                                        <div class="gift-price text-right d-grid">
                                                            <label>Price</label>
                                                            <span>$100.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="gift-name">
                                                            <span>Gift Card Name</span>
                                                            <p>All services & Products</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-6">
                                                        <div class="giftcard-footer">
                                                            <label>Valor Mixed Martial Arts</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-6">
                                                        <div class="gift-expire text-right d-grid">
                                                            <label>Expires after</label>
                                                            <span>Never</span>
                                                        </div>
                                                    </div>
                                                </div>
		                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row y-middle">
                                    <div class="col-xxl-7 col-lg-7 col-sm-7">
                                        <label class="fs-15">Expires after</label>
                                    </div>
                                    <div class="col-xxl-5 col-lg-5 col-sm-5">
                                        <select class="form-select">
											<option value="1"> 6 months from purchase </option>
											<option value="2"> 9 months from purchase </option>
                                            <option value="3"> 12 months from purchase </option>
                                            <option value="4" selected> Never </option>
										</select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom-grey mt-15 mb-15"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="" class="edit-card-design w-100 d-block" data-bs-toggle="modal" data-bs-target="#exampleModal"> 
                                            <div class="gift-edit-card d-inline">
                                                <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-2.jpg">
                                            </div>
                                            <span class="">Edit Card Design</span>
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom-grey mt-15 mb-15"></div>
                                    </div>
                                    <div class="col-xxl-12 col-lg-12">
                                        <label class="fs-15">Valid for</label>
                                    </div>
                                    <div class="col-xxl-12 col-lg-12">
                                        <div class="gift-card-valid">
                                            <span>All services & products</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom-grey mt-15 mb-15"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-red mr-10">Save</button>
                                            <button type="button" class="btn btn-black">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-70 modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Gift Card Design</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio w-100">
                                <input type="radio" name="radio" checked>
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                    <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-1.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-2.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-3.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-4.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-5.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-6.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-7.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-8.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-9.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-10.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-11.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="gift-card-radio-buttons">
                            <label class="gift-custom-radio  w-100">
                                <input type="radio" name="radio" >
                                <span class="gift-btn"><i class="las la-check"></i>
                                    <div class="hobbies-icon">
                                        <img src="http://dev.fitnessity.co/public/dashboard-design/images/gift-card-12.jpg">
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Save</button>
            </div>
        </div>
    </div>
</div>




    @include('layouts.business.footer')

@endsection